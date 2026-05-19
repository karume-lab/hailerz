<?php

namespace App\Http\Controllers;

use App\Mail\ContractExecutedMail;
use App\Mail\ContractSignatureRequestMail;
use App\Models\Contract;
use App\Models\ContractSignature;
use App\Services\ContractPdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    protected ContractPdfService $pdfService;

    public function __construct(ContractPdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Display the contract viewing and signing interface.
     */
    public function show(Request $request, Contract $contract)
    {
        // 1. Verify URL cryptographic signature
        if (! $request->hasValidSignature()) {
            abort(403, 'This signature link is invalid or has expired.');
        }

        $role = $request->query('role');
        $email = $request->query('email');

        // 2. Validate that the signer is indeed on this contract
        /** @var ContractSignature|null $signature */
        $signature = $contract->signatures()
            ->where('signer_role', $role)
            ->where('signer_identifier', $email)
            ->first();

        if (! $signature) {
            abort(404, 'Signer record not found for this contract.');
        }

        // 3. Return view with contract and signer details
        return view('contracts.show', [
            'contract' => $contract,
            'signature' => $signature,
            'role' => $role,
            'email' => $email,
        ]);
    }

    /**
     * Process the signature submission.
     */
    public function sign(Request $request, Contract $contract)
    {
        // 1. Verify URL cryptographic signature
        if (! $request->hasValidSignature()) {
            abort(403, 'This signature link is invalid or has expired.');
        }

        $role = $request->query('role');
        $email = $request->query('email');

        // 2. Locate the signer's record
        /** @var ContractSignature $signature */
        $signature = $contract->signatures()
            ->where('signer_role', $role)
            ->where('signer_identifier', $email)
            ->firstOrFail();

        if ($signature->signed_at) {
            return redirect()->back()->with('info', 'You have already signed this document.');
        }

        if (in_array($contract->status, ['executed', 'voided'])) {
            abort(400, 'This contract is closed and cannot be signed.');
        }

        // 3. Validate signature and ESIGN consent
        $request->validate([
            'esign_consent' => 'required|accepted',
            'signer_name' => 'required|string|max:255',
        ]);

        // 4. Capture audit details and update signature
        $signature->update([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'token_id' => 'SIG_'.strtoupper(Str::random(16)).'_'.hash('crc32b', $email),
            'signed_at' => now(),
        ]);

        // 5. Update contract status to 'in_review' if it was 'pending'
        if ($contract->status === 'pending') {
            $contract->update(['status' => 'in_review']);
        }

        // 6. Check if more signatures are needed
        if ($contract->isFullySigned()) {
            // All signatures received -> Finalize & Append Certificate of Completion
            $this->pdfService->appendCertificateOfCompletion($contract);

            // Queue completion emails to all signers
            /** @var ContractSignature $sig */
            foreach ($contract->signatures as $sig) {
                Mail::to($sig->signer_identifier)->queue(new ContractExecutedMail($contract));
            }

            return redirect()->back()->with('success', 'Document successfully executed! A copy of the final agreement has been sent to your email.');
        } else {
            // Find next pending signer and email them
            /** @var ContractSignature|null $nextSignature */
            $nextSignature = $contract->signatures()
                ->whereNull('signed_at')
                ->orderBy('id', 'asc')
                ->first();

            if ($nextSignature) {
                $signedUrl = URL::signedRoute('contracts.show', [
                    'contract' => $contract->id,
                    'role' => $nextSignature->signer_role,
                    'email' => $nextSignature->signer_identifier,
                ]);

                Mail::to($nextSignature->signer_identifier)->queue(
                    new ContractSignatureRequestMail($contract, $nextSignature, $signedUrl)
                );
            }

            return redirect()->back()->with('success', 'Thank you. Your signature has been recorded. The document will now route to the next signatory.');
        }
    }

    /**
     * Signer rejects draft and requests revision.
     */
    public function requestRevision(Request $request, Contract $contract)
    {
        // 1. Verify URL cryptographic signature
        if (! $request->hasValidSignature()) {
            abort(403, 'This signature link is invalid or has expired.');
        }

        $role = $request->query('role');
        $email = $request->query('email');

        // Verify signer
        /** @var ContractSignature $signature */
        $signature = $contract->signatures()
            ->where('signer_role', $role)
            ->where('signer_identifier', $email)
            ->firstOrFail();

        $request->validate([
            'revision_notes' => 'required|string|min:10',
        ]);

        // 2. Lock down: Mark contract as voided to freeze signatures
        $contract->update(['status' => 'voided']);

        // Log the revision request details in system logs or database logs
        Log::info('Contract revision requested. Document voided.', [
            'contract_id' => $contract->id,
            'signer_role' => $role,
            'signer_identifier' => $email,
            'revision_notes' => $request->input('revision_notes'),
            'ip_address' => $request->ip(),
        ]);

        // Queue notification to admin/owner
        // (Assuming admin email config exists)
        $adminEmail = config('app.admin_email') ?? 'admin@hailerz.com';
        // Mail::to($adminEmail)->queue(new ContractRevisionRequestedMail($contract, $signature, $request->input('revision_notes')));

        return redirect()->back()->with('info', 'Revision requested. This draft has been locked and voided.');
    }

    /**
     * Admin publishes a new revised version (e.g. v1.1) of a voided contract.
     */
    public function publishNewVersion(Request $request, Contract $oldContract)
    {
        // Require auth if applicable, or admin middleware.
        $request->validate([
            'content_html' => 'required|string',
            'type' => 'required|string',
            'party_a' => 'required|string',
            'party_b' => 'required|string',
        ]);

        // 1. Ensure the old contract is voided
        if ($oldContract->status !== 'voided') {
            $oldContract->update(['status' => 'voided']);
        }

        // 2. Calculate new version string
        $oldVersion = $oldContract->version;
        $parts = explode('.', $oldVersion);
        if (count($parts) === 2 && is_numeric($parts[0]) && is_numeric($parts[1])) {
            $newVersion = $parts[0].'.'.($parts[1] + 1);
        } else {
            $newVersion = '1.1';
        }

        // 3. Create the new Contract version record
        $newContract = Contract::create([
            'booking_id' => $oldContract->booking_id,
            'status' => 'pending',
            'version' => $newVersion,
        ]);

        // 4. Recreate the signature requirements (cloned from old contract roles)
        /** @var ContractSignature $oldSig */
        foreach ($oldContract->signatures as $oldSig) {
            ContractSignature::create([
                'contract_id' => $newContract->id,
                'signer_role' => $oldSig->signer_role,
                'signer_identifier' => $oldSig->signer_identifier,
                'token_id' => null,
                'ip_address' => null,
                'user_agent' => null,
                'signed_at' => null,
            ]);
        }

        // 5. Generate new PDF file
        $this->pdfService->generate(
            $newContract,
            $request->input('type'),
            $request->input('party_a'),
            $request->input('party_b'),
            $request->input('content_html')
        );

        // 6. Route signing link to the first signer
        /** @var ContractSignature|null $firstSignature */
        $firstSignature = $newContract->signatures()->orderBy('id', 'asc')->first();
        if ($firstSignature) {
            $signedUrl = URL::signedRoute('contracts.show', [
                'contract' => $newContract->id,
                'role' => $firstSignature->signer_role,
                'email' => $firstSignature->signer_identifier,
            ]);

            Mail::to($firstSignature->signer_identifier)->queue(
                new ContractSignatureRequestMail($newContract, $firstSignature, $signedUrl)
            );
        }

        return response()->json([
            'success' => true,
            'message' => "Published version {$newVersion} and sent to first signer.",
            'contract_id' => $newContract->id,
        ]);
    }

    /**
     * Securely download or stream the contract PDF.
     */
    public function download(Request $request, Contract $contract)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'This signature link is invalid or has expired.');
        }

        if (! Storage::disk('local')->exists($contract->file_path)) {
            abort(404, 'Contract PDF file not found.');
        }

        $absolutePath = Storage::disk('local')->path($contract->file_path);

        return response()->file($absolutePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.basename($contract->file_path).'"',
        ]);
    }
}
