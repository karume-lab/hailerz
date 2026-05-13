<?php

namespace App\Livewire\Public;

use App\Models\Submission;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Mail\TalentSubmissionMail;
use App\Mail\AdminTalentSubmissionNotification;
use Illuminate\Support\Facades\Mail;


#[Layout('components.layouts.app')]
#[Title('Join Our Roster - Talent Submissions | Hailerz')]
class JoinTalent extends Component
{
    public int $currentStep = 1;
    public bool $isSubmitted = false;

    #[Validate('accepted', message: 'Please confirm that the information provided is accurate.')]
    public bool $is_accurate = false;

    // Artist Information
    #[Validate('required|string|in:individual,group')]
    public string $talent_type = 'individual';

    public ?int $member_count = null;

    #[Validate('required|string|max:255')]
    public string $artist_name = ''; // Act/Group Name

    #[Validate('required|string|max:255')]
    public string $real_name = ''; // Contact Person Name

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

    public function nextStep(): void
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'talent_type' => 'required|string|in:individual,group',
                'member_count' => 'required_if:talent_type,group|nullable|integer|min:2',
                'artist_name' => 'required|string|max:255',
                'real_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'location' => 'required|string|max:255',
                'profile_photo_url' => 'required|url|max:255',
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'category' => 'required|string|max:100',
                'years_active' => 'required|string|max:100',
                'min_rate' => 'required|numeric|min:0',
                'max_rate' => 'required|numeric|min:0',
                'bio' => 'required|string|min:200|max:5000',
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'gallery.*.url' => 'nullable|url|max:255',
            ]);
        }

        $this->currentStep++;
    }

    public function previousStep(): void
    {
        $this->currentStep--;
    }

    public function submit(): void
    {
        $this->validate();

        $submission = Submission::create([
            'talent_type'       => $this->talent_type,
            'member_count'      => $this->member_count,
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
            Mail::to(config('mail.from.address'))->send(new AdminTalentSubmissionNotification($submission));
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
