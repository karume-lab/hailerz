<?php

namespace App\Livewire\Public;

use App\Helpers\CurrencyHelper;
use App\Mail\AdminTalentSubmissionNotification;
use App\Mail\TalentSubmissionMail;
use App\Models\Submission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

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

    #[Validate('required_if:talent_type,group|nullable|integer|min:2')]
    public ?int $member_count = null;

    #[Validate('required|string|max:255')]
    public string $artist_name = ''; // Act/Group Name

    #[Validate('required|string|max:255')]
    public string $real_name = ''; // Person Name

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:20')]
    public string $phone = '';

    #[Validate('required|string|max:255')]
    public string $location = '';

    #[Validate('required|string')]
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

    #[Validate('nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/', message: 'Please enter only the Instagram username (e.g. yourusername), not a full link.')]
    public string $instagram_handle = '';

    #[Validate('nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/', message: 'Please enter only the Facebook username (e.g. yourusername), not a full link.')]
    public string $facebook_url = '';

    #[Validate('nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/', message: 'Please enter only the YouTube channel handle/name (e.g. yourchannel), not a full link.')]
    public string $youtube_channel = '';

    #[Validate('nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/', message: 'Please enter only the TikTok username (e.g. yourusername), not a full link.')]
    public string $tiktok_handle = '';

    // Additional Information
    #[Validate('required|string|min:200|max:5000')]
    public string $bio = '';

    #[Validate('nullable|string')]
    public string $source = '';

    // Gallery Items
    #[Validate([
        'gallery.*.media_type' => 'nullable|string|in:link,image',
        'gallery.*.url' => 'nullable|string',
        'gallery.*.title' => 'nullable|string|max:255',
        'gallery.*.description' => 'nullable|string|max:1000',
    ])]
    public array $gallery = [];

    public function updated($propertyName): void
    {
        if ($this->getErrorBag()->has($propertyName)) {
            $this->validateOnly($propertyName);
        }
    }

    public function addGalleryItem(): void
    {
        $this->gallery[] = [
            'media_type' => 'link',
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
                'profile_photo_url' => 'required|string',
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
                'website_url' => 'nullable|url|max:255',
                'instagram_handle' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/',
                'facebook_url' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/',
                'youtube_channel' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/',
                'tiktok_handle' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9._@-]+$/',
                'gallery.*.media_type' => 'nullable|string|in:link,image',
                'gallery.*.url' => 'nullable|string',
                'gallery.*.title' => 'nullable|string|max:255',
                'gallery.*.description' => 'nullable|string|max:1000',
            ], [
                'instagram_handle.regex' => 'Please enter only the Instagram username (e.g. yourusername), not a full link.',
                'facebook_url.regex' => 'Please enter only the Facebook username (e.g. yourusername), not a full link.',
                'youtube_channel.regex' => 'Please enter only the YouTube channel handle/name (e.g. yourchannel), not a full link.',
                'tiktok_handle.regex' => 'Please enter only the TikTok username (e.g. yourusername), not a full link.',
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
            'talent_type' => $this->talent_type,
            'member_count' => $this->member_count,
            'artist_name' => $this->artist_name,
            'real_name' => $this->real_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
            'profile_photo_url' => $this->profile_photo_url,
            'category' => $this->category,
            'genre' => $this->genre,
            'years_active' => $this->years_active,
            'min_rate' => $this->min_rate,
            'max_rate' => $this->max_rate,
            'website_url' => $this->website_url,
            'instagram_handle' => ! empty($this->instagram_handle) ? 'https://instagram.com/'.trim(ltrim($this->instagram_handle, '@')) : null,
            'facebook_url' => ! empty($this->facebook_url) ? 'https://facebook.com/'.trim(ltrim($this->facebook_url, '@')) : null,
            'youtube_channel' => ! empty($this->youtube_channel) ? 'https://youtube.com/@'.trim(ltrim($this->youtube_channel, '@')) : null,
            'tiktok_handle' => ! empty($this->tiktok_handle) ? 'https://tiktok.com/@'.trim(ltrim($this->tiktok_handle, '@')) : null,
            'bio' => $this->bio,
            'source' => $this->source,
            'status' => 'pending',
            'currency' => CurrencyHelper::getUserCurrency(),
        ]);

        foreach ($this->gallery as $item) {
            if (! empty($item['url'])) {
                $submission->gallery()->create($item);
            }
        }

        try {
            Mail::to($submission->email)->send(new TalentSubmissionMail($submission));
            Mail::to(config('mail.from.address'))->send(new AdminTalentSubmissionNotification($submission));
        } catch (\Exception $e) {
            Log::error('Mail sending failed: '.$e->getMessage());
        }

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.public.join-talent');
    }
}
