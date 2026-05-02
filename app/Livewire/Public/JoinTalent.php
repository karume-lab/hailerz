<?php

namespace App\Livewire\Public;

use App\Models\Submission;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Mail\TalentSubmissionMail;
use Illuminate\Support\Facades\Mail;


#[Layout('components.layouts.app')]
#[Title('Join Our Talent | Hailerz')]
class JoinTalent extends Component
{
    public int $currentStep = 1;
    public bool $isSubmitted = false;

    // Step 1: Artist Information
    #[Validate('required|string|max:255')]
    public string $artist_name = '';

    #[Validate('required|string|max:255')]
    public string $real_name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:20')]
    public string $phone = '';

    #[Validate('required|string|max:255')]
    public string $location = ''; // City, State

    #[Validate('required|url|max:255')]
    public string $profile_photo_url = '';

    // Step 2: Professional Details
    #[Validate('required|string|max:100')]
    public string $category = '';

    #[Validate('nullable|string|max:100')]
    public string $genre = '';

    #[Validate('required|string|max:100')]
    public string $years_active = '';

    #[Validate('required|numeric|min:0')]
    public $min_rate;

    #[Validate('required|numeric|gt:min_rate')]
    public $max_rate;

    // Step 3: Online Presence
    #[Validate('nullable|url|max:255')]
    public string $website_url = '';

    #[Validate('nullable|url|max:255')]
    public string $instagram_handle = '';

    #[Validate('nullable|url|max:255')]
    public string $facebook_url = '';

    #[Validate('nullable|url|max:255')]
    public string $youtube_channel = '';

    #[Validate('nullable|url|max:255')]
    public string $tiktok_handle = '';

    // Step 4: Experience & Credentials
    #[Validate('nullable|string|max:2000')]
    public string $notable_venues = '';

    #[Validate('nullable|string|max:2000')]
    public string $notable_clients = '';

    #[Validate('nullable|string|max:2000')]
    public string $press_features = '';

    // Step 5: Additional Information
    #[Validate('required|string|min:200|max:5000')]
    public string $bio = '';

    #[Validate('required|string|max:2000')]
    public string $motivation = '';

    #[Validate('nullable|string')]
    public string $source = '';

    // Gallery Items (PRESERVED)
    public array $gallery = [];

    public function addGalleryItem(): void
    {
        $this->gallery[] = [
            'url' => '',
            'title' => '',
            'description' => '',
        ];
    }

    public function removeGalleryItem(int $index): void
    {
        unset($this->gallery[$index]);
        $this->gallery = array_values($this->gallery);
    }

    public function nextStep(): void
    {
        match ($this->currentStep) {
            1 => $this->validate([
                'artist_name'       => 'required|string|max:255',
                'real_name'         => 'required|string|max:255',
                'email'             => 'required|email|max:255',
                'phone'             => 'required|string|max:20',
                'location'          => 'required|string|max:255',
                'profile_photo_url' => 'required|url|max:255',
            ]),
            2 => $this->validate([
                'category'     => 'required|string|max:100',
                'years_active' => 'required|string|max:100',
                'min_rate'     => 'required|numeric|min:0',
                'max_rate'     => 'required|numeric|gt:min_rate',
            ]),
            3 => $this->validate([
                'website_url'      => 'nullable|url|max:255',
                'instagram_handle' => 'nullable|url|max:255',
                'facebook_url'     => 'nullable|url|max:255',
                'youtube_channel'  => 'nullable|url|max:255',
                'tiktok_handle'    => 'nullable|url|max:255',
            ]),
            4 => $this->validate([
                'gallery.*.url' => 'required|url|max:255',
                'gallery.*.title' => 'nullable|string|max:255',
            ]),
            default => null,
        };

        $this->currentStep++;
    }

    public function previousStep(): void
    {
        $this->currentStep--;
    }

    public function submit(): void
    {
        $this->validate([
            'bio'        => 'required|string|min:200|max:5000',
            'motivation' => 'required|string|max:2000',
        ]);

        $submission = Submission::create([
            'artist_name'       => $this->artist_name,
            'real_name'         => $this->real_name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'location'          => $this->location,
            'profile_photo_url' => $this->profile_photo_url,
            'category'          => $this->category,
            'genre'             => $this->genre,
            'years_active'      => $this->years_active,
            'min_rate'          => $this->min_rate,
            'max_rate'          => $this->max_rate,
            'website_url'       => $this->website_url,
            'instagram_handle'  => $this->instagram_handle,
            'facebook_url'      => $this->facebook_url,
            'youtube_channel'   => $this->youtube_channel,
            'tiktok_handle'     => $this->tiktok_handle,
            'notable_venues'    => $this->notable_venues,
            'notable_clients'   => $this->notable_clients,
            'press_features'    => $this->press_features,
            'bio'               => $this->bio,
            'motivation'        => $this->motivation,
            'source'            => $this->source,
            'status'            => 'pending',
        ]);

        foreach ($this->gallery as $item) {
            if (!empty($item['url'])) {
                $submission->gallery()->create($item);
            }
        }

        try {
            \Illuminate\Support\Facades\Log::info('Attempting to send talent application email to: ' . $submission->email);
            Mail::to($submission->email)->send(new TalentSubmissionMail($submission));
            \Illuminate\Support\Facades\Log::info('Talent application email sent successfully.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
        }

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.public.join-talent');
    }
}
