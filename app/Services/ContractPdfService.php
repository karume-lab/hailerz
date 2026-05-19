<?php

namespace App\Services;

use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ContractPdfService
{
    /**
     * Generate the initial contract PDF and save the source HTML.
     */
    public function generate(Contract $contract, string $type, string $partyA, string $partyB, string $contentHtml): string
    {
        // 1. Ensure the directory exists
        if (!Storage::disk('local')->exists('contracts')) {
            Storage::disk('local')->makeDirectory('contracts');
        }

        // 2. Clean the parameters for file name
        $typeClean = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\s]/', '', $type));
        $partyAClean = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\s]/', '', $partyA));
        $partyBClean = str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\s]/', '', $partyB));
        $timestamp = now()->format('d_m_y_H_i_s');
        $filename = "{$typeClean}_{$partyAClean}_vs_{$partyBClean}_{$timestamp}.pdf";
        $filePath = 'contracts/' . $filename;

        // 3. Save the source HTML content for future re-generation / appending
        Storage::disk('local')->put("contracts/{$contract->id}_source.html", $contentHtml);

        // 4. Generate the PDF
        // Apply compression options via Dompdf configurations
        $pdf = Pdf::loadHTML($contentHtml)
            ->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->setOption([
                'enable_font_subsetting' => true, // Compresses the file footprint by only including characters used
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => false, // cPanel performance & safety
                'defaultMediaType' => 'print',
            ]);

        // Save PDF to local storage
        Storage::disk('local')->put($filePath, $pdf->output());

        // 5. Update Contract details
        $contract->update([
            'file_path' => $filePath,
        ]);
        
        $contract->update([
            'file_hash' => $contract->calculateHash(),
        ]);

        return $filePath;
    }

    /**
     * Append the Certificate of Completion to the PDF and finalize it.
     */
    public function appendCertificateOfCompletion(Contract $contract): string
    {
        // 1. Fetch original HTML content
        $sourcePath = "contracts/{$contract->id}_source.html";
        if (!Storage::disk('local')->exists($sourcePath)) {
            throw new \Exception("Original contract HTML content not found.");
        }
        $originalHtml = Storage::disk('local')->get($sourcePath);

        // 2. Render the Certificate of Completion HTML
        $signatures = $contract->signatures()->orderBy('signed_at', 'asc')->get();
        $certificateHtml = view('pdf.contract_certificate', [
            'contract' => $contract,
            'signatures' => $signatures,
        ])->render();

        // 3. Append Certificate to the Original HTML using page-break-before style
        $combinedHtml = $originalHtml . "\n" . $certificateHtml;

        // 4. Generate the final PDF
        $pdf = Pdf::loadHTML($combinedHtml)
            ->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->setOption([
                'enable_font_subsetting' => true,
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => false,
                'defaultMediaType' => 'print',
            ]);

        // 5. Overwrite the PDF in local storage
        Storage::disk('local')->put($contract->file_path, $pdf->output());

        // 6. Recalculate hash and update status
        $contract->update([
            'file_hash' => $contract->calculateHash(),
            'status' => 'executed',
        ]);

        return $contract->file_path;
    }
}
