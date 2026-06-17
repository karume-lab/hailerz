<?php

namespace App\Http\Controllers;

use App\Mail\AdminBookingNotification;
use App\Mail\AdminStaffingInquiryNotification;
use App\Mail\AdminTalentSubmissionNotification;
use App\Mail\BookingConfirmationMail;
use App\Mail\ContractSignatureRequestMail;
use App\Mail\ContractSignedMail;
use App\Mail\StaffingInquiryReply;
use App\Mail\TalentAgreementMail;
use App\Mail\TalentFrozenMail;
use App\Mail\TalentSubmissionMail;
use App\Models\Contract;
use App\Models\ContractSignature;
use App\Models\Inquiry;
use App\Models\StaffingInquiry;
use App\Models\Submission;
use App\Models\Talent;
use Barryvdh\DomPDF\Facade\Pdf;

class PreviewController extends Controller
{
    /**
     * Enforce local environment access check.
     */
    public function __construct()
    {
        if (! app()->environment('local')) {
            abort(403, 'Testing endpoints are only available in the local environment.');
        }
    }

    /**
     * Preview Dashboard Hub
     */
    public function index()
    {
        return view('previews.index');
    }

    /**
     * PDF Previewer Page
     */
    public function pdfs()
    {
        return view('previews.pdfs');
    }

    /**
     * Email Previewer Page
     */
    public function emails()
    {
        return view('previews.emails');
    }

    /**
     * View and Stream a PDF Template
     */
    public function viewPdf($type)
    {
        $html = '';

        if ($type === 'talent-representation-agreement') {
            $talent = $this->getMockTalent();
            $contract = $this->getMockContract();

            $signatures = collect([
                (object) [
                    'signer_role' => 'Agency Representative',
                    'signer_identifier' => 'Jane Admin',
                    'signed_at' => now(),
                    'ip_address' => '192.168.1.55',
                    'token_id' => 'tok_abcd1234',
                    'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
                ],
                (object) [
                    'signer_role' => 'Artist / Act',
                    'signer_identifier' => $talent->name,
                    'signed_at' => now(),
                    'ip_address' => '10.0.0.4',
                    'token_id' => 'tok_efgh5678',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                ],
            ]);

            $contentHtml = view('pdf.talent-representation-agreement', compact('talent'))->render();
            $certHtml = view('pdf.contract_certificate', compact('contract', 'signatures'))->render();

            if (str_contains(strtolower($contentHtml), '</body>')) {
                $pos = strripos($contentHtml, '</body>');
                $html = substr_replace($contentHtml, "\n".$certHtml."\n", $pos, 0);
            } else {
                $html = $contentHtml."\n".$certHtml;
            }

        } elseif ($type === 'booking-inquiry') {
            $inquiry = $this->getMockInquiry();
            $html = view("pdf.{$type}", compact('inquiry'))->render();
        } elseif ($type === 'talent-submission') {
            $submission = $this->getMockSubmission();
            $html = view("pdf.{$type}", compact('submission'))->render();
        } else {
            abort(404, 'PDF template not found');
        }

        return Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->stream("{$type}.pdf");
    }

    /**
     * View compiled HTML of an Email template
     */
    public function viewEmail($template)
    {
        switch ($template) {
            case 'booking-confirmation':
                $inquiry = $this->getMockInquiry();

                return (new BookingConfirmationMail($inquiry))->render();

            case 'contract-signature-request':
                $contract = $this->getMockContract();
                $signature = $this->getMockContractSignature();
                $signedUrl = route('contracts.show', ['contract' => 1]);

                return (new ContractSignatureRequestMail($contract, $signature, $signedUrl))->render();

            case 'contract-signed':
                $contract = $this->getMockContract();

                return (new ContractSignedMail($contract))->render();

            case 'talent-agreement':
                $talent = $this->getMockTalent();
                $signedUrl = route('contracts.show', ['contract' => 1]);

                return (new TalentAgreementMail($talent, $signedUrl))->render();

            case 'talent-frozen':
                $talent = $this->getMockTalent();

                return (new TalentFrozenMail($talent))->render();

            case 'talent-submission':
                $submission = $this->getMockSubmission();

                return (new TalentSubmissionMail($submission))->render();

            case 'admin-booking-notification':
                $inquiry = $this->getMockInquiry();

                return (new AdminBookingNotification($inquiry))->render();

            case 'admin-staffing-inquiry-notification':
                $staffing = $this->getMockStaffingInquiry();

                return (new AdminStaffingInquiryNotification($staffing))->render();

            case 'admin-talent-submission-notification':
                $submission = $this->getMockSubmission();

                return (new AdminTalentSubmissionNotification($submission))->render();

            case 'staffing-inquiry-reply':
                $replyMessage = "Dear Jane,\n\nThank you for reaching out to Hailerz. We have processed your staffing inquiry and would love to assist you. Our representative will call you shortly.\n\nBest regards,\nThe Hailerz Team";

                return (new StaffingInquiryReply($replyMessage))->render();

            default:
                abort(404, 'Email template not found');
        }
    }

    /* --- Mock Helpers --- */

    private function getMockInquiry()
    {
        $inquiry = Inquiry::first() ?? new Inquiry([
            'id' => 555,
            'first_name' => 'Bruno',
            'last_name' => 'Mars',
            'email' => 'bruno@example.com',
            'phone' => '+254704150182',
            'company' => 'Mars Productions',
            'event_type' => 'Other',
            'event_date' => now()->addMonth(),
            'event_time' => '17:07',
            'venue_name' => 'Eko Hotel & Suites',
            'city' => 'Nairobi',
            'state' => 'Nairobi County',
            'expected_guests' => 225,
            'performance_duration' => '3+ Hours',
            'talent_category' => 'DJs',
            'preferred_genre' => 'Afrobeats',
            'budget_range' => 'Under $1,000',
            'additional_details' => 'Please provide top tier audio systems.',
            'created_at' => now(),
        ]);

        return $inquiry;
    }

    private function getMockSubmission()
    {
        $submission = Submission::first() ?? new Submission([
            'id' => 1,
            'status' => 'pending',
            'artist_name' => 'Bando',
            'real_name' => 'Bando Rando',
            'email' => 'rumzkurama@gmail.com',
            'phone' => '+254704150182',
            'location' => 'Nairobi, Kenya',
            'profile_photo_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoYkjSfI-cZkivuGghR4OPNWVq5C7txT1z6A&s',
            'category' => 'DJs',
            'genre' => 'Afrobeat',
            'period_active' => '5 years',
            'min_rate' => '100',
            'max_rate' => '200',
            'currency' => 'USD',
            'bio' => 'I am strong! I am strong! I am strong! I am strong! I am strong! I am strong! I am strong! I am strong! I am strong!',
            'instagram_handle' => 'bandobandz',
            'website_url' => 'https://bandobandz.com',
            'facebook_url' => null,
            'youtube_channel' => 'bandobandz',
            'tiktok_handle' => null,
            'notable_clients' => null,
            'created_at' => now(),
        ]);

        $submission->setRelation('gallery', collect([]));

        return $submission;
    }

    private function getMockTalent()
    {
        return Talent::first() ?? new Talent([
            'name' => 'Bando',
            'email' => 'rumzkurama@gmail.com',
            'location' => 'Nairobi, Kenya',
        ]);
    }

    private function getMockContract()
    {
        return Contract::first() ?? new Contract([
            'id' => 'CTR-10001',
            'version' => '1.0',
            'status' => 'signed',
            'file_path' => 'private/contracts/demo.pdf',
            'file_hash' => '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',
        ]);
    }

    private function getMockContractSignature()
    {
        return ContractSignature::first() ?? new ContractSignature([
            'signer_role' => 'Artist / Act',
            'signer_identifier' => 'Bando',
            'token_id' => 'tok_efgh5678',
            'ip_address' => '10.0.0.4',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'signed_at' => now(),
        ]);
    }

    private function getMockStaffingInquiry()
    {
        return StaffingInquiry::first() ?? new StaffingInquiry([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '+234 800 111 2222',
            'company' => 'Staffing Corp',
            'needs' => 'We need 5 bartenders and 2 hostesses for a corporate event.',
            'status' => 'pending',
        ]);
    }
}
