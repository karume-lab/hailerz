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
    }
}
