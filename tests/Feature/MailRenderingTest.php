<?php

namespace Tests\Feature;

use App\Mail\ContractSignatureRequestMail;
use App\Mail\ContractSignedMail;
use App\Models\Contract;
use App\Models\ContractSignature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MailRenderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_contract_signed_mail_renders_successfully(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('contracts/test_agreement.pdf', 'dummy content');

        $contract = Contract::create([
            'status' => 'signed',
            'file_path' => 'contracts/test_agreement.pdf',
            'version' => '1.0',
        ]);

        $mail = new ContractSignedMail($contract);

        // Ensure rendering does not throw "No hint path defined for [mail]"
        $html = $mail->render();

        $this->assertStringContainsString('Document Fully Signed', $html);
        $this->assertStringContainsString('test_agreement.pdf', $html);
        $this->assertStringContainsString($contract->file_hash, $html);
    }

    public function test_contract_signature_request_mail_renders_successfully(): void
    {
        Storage::fake('local');

        $contract = Contract::create([
            'status' => 'pending',
            'file_path' => 'contracts/test_agreement.pdf',
            'version' => '1.0',
        ]);

        $signature = ContractSignature::create([
            'contract_id' => $contract->id,
            'signer_role' => 'Talent',
            'signer_identifier' => 'talent@example.com',
        ]);

        $mail = new ContractSignatureRequestMail($contract, $signature, 'https://example.com/sign');

        // Ensure rendering does not throw "No hint path defined for [mail]"
        $html = $mail->render();

        $this->assertStringContainsString('Signature Required', $html);
        $this->assertStringContainsString('test_agreement.pdf', $html);
        $this->assertStringContainsString('Review &amp; Sign Document', $html);
    }
}
