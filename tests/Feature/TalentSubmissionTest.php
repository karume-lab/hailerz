<?php

namespace Tests\Feature;

use App\Livewire\Public\JoinTalent;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TalentSubmissionTest extends TestCase
{
    use RefreshDatabase;

    private array $validStep1 = [
        'talent_type' => 'individual',
        'artist_name' => 'Test Artist',
        'real_name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+2348030000000',
        'location' => 'Lagos, Nigeria',
        'profile_photo_url' => 'https://example.com/photo.jpg',
    ];

    private array $validStep2 = [
        'category' => 'Musicians',
        'genre' => 'Afrobeats',
        'years_active' => '5 years',
        'min_rate' => 1000,
        'max_rate' => 5000,
        'bio' => 'John Doe is a premier multi-instrumentalist based in Lagos, having performed with top-tier afrobeat icons globally. This biography is deliberately lengthy to exceed the minimum two hundred character requirement of the submission form.',
    ];

    public function test_social_fields_reject_full_urls_during_step_3_validation(): void
    {
        // 1. Enter valid step 1 and step 2
        $comp = Livewire::test(JoinTalent::class);

        foreach ($this->validStep1 as $k => $v) {
            $comp->set($k, $v);
        }
        $comp->call('nextStep');
        $this->assertEquals(2, $comp->get('currentStep'));

        foreach ($this->validStep2 as $k => $v) {
            $comp->set($k, $v);
        }
        $comp->call('nextStep');
        $this->assertEquals(3, $comp->get('currentStep'));

        // 2. Set full URLs in handle fields (should fail)
        $comp->set('instagram_handle', 'https://instagram.com/myhandle')
            ->set('facebook_url', 'http://facebook.com/myhandle')
            ->set('youtube_channel', 'www.youtube.com/mychannel')
            ->set('tiktok_handle', 'tiktok.com/@myhandle')
            ->call('nextStep');

        // Validation should fail and we must remain on step 3
        $this->assertEquals(3, $comp->get('currentStep'));
        $comp->assertHasErrors([
            'instagram_handle' => 'regex',
            'facebook_url' => 'regex',
            'youtube_channel' => 'regex',
            'tiktok_handle' => 'regex',
        ]);
    }

    public function test_valid_handles_are_accepted_and_prepended_on_submit(): void
    {
        $comp = Livewire::test(JoinTalent::class);

        // Step 1
        foreach ($this->validStep1 as $k => $v) {
            $comp->set($k, $v);
        }
        $comp->call('nextStep');

        // Step 2
        foreach ($this->validStep2 as $k => $v) {
            $comp->set($k, $v);
        }
        $comp->call('nextStep');

        // Step 3 (set usernames, one with leading @ and one without)
        $comp->set('instagram_handle', 'john_ig')
            ->set('facebook_url', 'john_fb')
            ->set('youtube_channel', '@john_yt')
            ->set('tiktok_handle', 'john_tt')
            ->set('website_url', 'https://john.com')
            ->call('nextStep');

        // Should successfully transition to Step 4 (Review)
        $this->assertEquals(4, $comp->get('currentStep'));
        $comp->assertHasNoErrors();

        // Step 4: Accept and Submit
        $comp->set('is_accurate', true)
            ->call('submit');

        $comp->assertHasNoErrors();
        $this->assertTrue($comp->get('isSubmitted'));

        // Assert submission has been created in the database with prepended URLs
        $this->assertDatabaseHas('submissions', [
            'artist_name' => 'Test Artist',
            'instagram_handle' => 'https://instagram.com/john_ig',
            'facebook_url' => 'https://facebook.com/john_fb',
            'youtube_channel' => 'https://youtube.com/@john_yt',
            'tiktok_handle' => 'https://tiktok.com/@john_tt',
            'website_url' => 'https://john.com',
        ]);
    }
}
