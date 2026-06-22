<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailTemplate::updateOrCreate(
            ['name' => 'Application Received'],
            [
                'subject' => 'Application for Talent Representation: {{artist_name}}',
                'body' => '<p>Thank you for your interest in joining the Hailerz talent network.</p><p>We are currently reviewing your professional profile and performance assets against our current roster requirements and client needs.</p><p>If your profile is a strong fit, you will receive a formal representation contract to review and sign. Once countersigned, your profile will go live on our platform and become available for booking by our premium clients.</p><p>Regards,<br>Hailerz Talent Management</p>',
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Inquiry Submitted'],
            [
                'subject' => 'Booking Inquiry Received: {{event_type}}',
                'body' => '<p>Thank you for submitting your booking inquiry.</p><p>A senior booking agent has been assigned to your request and is currently reviewing your event specifications and budget requirements. We prioritize providing comprehensive, tailored proposals that ensure the perfect alignment between talent and event DNA.</p><p>You can expect a formal proposal or a request for a briefing call within 24 business hours.</p><p>Best regards,<br>Hailerz Agency Team</p>',
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Talent Application Approved'],
            [
                'subject' => 'Welcome to Hailerz Talent Network',
                'body' => '<p>Congratulations! We are thrilled to welcome you to the Hailerz Talent Network.</p><p>Your application has been approved. A representative will be in touch shortly to finalize your onboarding process and get your profile live.</p><p>Welcome aboard!<br>Hailerz Talent Management</p>',
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Talent Application Rejected'],
            [
                'subject' => 'Update on Your Talent Application',
                'body' => '<p>Thank you for applying to join the Hailerz talent network.</p><p>After careful review, we regret to inform you that we are not moving forward with your application at this time. We will keep your information on file for future opportunities.</p><p>Best of luck in your career.<br>Hailerz Talent Management</p>',
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Staffing Inquiry Reply'],
            [
                'subject' => 'Regarding Your Staffing Inquiry',
                'body' => '<p>Hello,</p><p>Thank you for reaching out to us regarding your staffing needs.</p><p>Our team is reviewing your requirements and will provide a tailored staffing solution shortly.</p><p>Best regards,<br>Hailerz Staffing Team</p>',
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Event Registration Confirmation'],
            [
                'subject' => 'Registration Confirmed: {{event_name}}',
                'body' => '<p>Your registration for the upcoming event has been confirmed.</p><p>We look forward to seeing you there! Additional details and the agenda will be shared as the date approaches.</p><p>Best,<br>Hailerz Events</p>',
            ]
        );

        EmailTemplate::updateOrCreate(
            ['name' => 'Contract Available'],
            [
                'subject' => 'Action Required: Your Contract is Ready',
                'body' => '<p>Your contract for the upcoming engagement is now available for review and signature.</p><p>Please log in to your portal to review the terms and sign the agreement at your earliest convenience.</p><p>Thank you,<br>Hailerz Legal Team</p>',
            ]
        );
    }
}
