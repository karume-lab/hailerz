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
#[Title('Join Our Roster - Talent Submissions | Hailerz')]
class JoinTalent extends Component
{
    public bool $isSubmitted = false;

    // Artist Information
    #[Validate('required|string|max:255')]
    public string $artist_name = '';

    #[Validate('required|string|max:255')]
    public string $real_name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:20')]
    public string $phone = '';

    #[Validate('required|string|max:255')]
    public string $location = '';

    #[Validate('required|url|max:255')]
    public string $profile_photo_url = '';

    // Professional Details
    #[Validate('required|string|max:100')]
    public string $category = '';

    #[Validate('nullable|string|max:100')]
    public string $genre = '';

    #[Validate('required|string|max:100')]
    public string $years_active = '';

    #[Validate('required|numeric|min:0')]
    public $min_rate;

    #[Validate('required|numeric|min:0')]
    public $max_rate;

    // Online Presence
    #[Validate('nullable|url|max:255')]
    public string $website_url = '';

    #[Validate('nullable|string|max:255')]
    public string $instagram_handle = '';

    #[Validate('nullable|string|max:255')]
    public string $facebook_url = '';

    #[Validate('nullable|string|max:255')]
    public string $youtube_channel = '';

    #[Validate('nullable|string|max:255')]
    public string $tiktok_handle = '';

    // Experience & Credentials


    #[Validate('nullable|string|max:2000')]
    public string $notable_clients = '';

    #[Validate('nullable|string|max:2000')]
    public string $press_features = '';

    // Additional Information
    #[Validate('required|string|min:200|max:5000')]
    public string $bio = '';



    #[Validate('nullable|string')]
    public string $source = '';

    // Gallery Items
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

    public function submit(): void
    {
        $this->validate();

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
            'notable_clients'   => $this->notable_clients,
            'press_features'    => $this->press_features,
            'bio'               => $this->bio,
            'source'            => $this->source,
            'status'            => 'pending',
        ]);

        foreach ($this->gallery as $item) {
            if (!empty($item['url'])) {
                $submission->gallery()->create($item);
            }
        }

        try {
            Mail::to($submission->email)->send(new TalentSubmissionMail($submission));
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
