<?php

namespace App\Livewire\Public;

use App\Models\Submission;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
#[Title('Join Our Talent | Hailerz')]
class JoinTalent extends Component
{
    public int $currentStep = 1;
    public bool $isSubmitted = false;

    // Step 1: Identity
    #[Validate('required|string|max:255')]
    public string $artist_name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:20')]
    public string $phone = '';

    #[Validate('nullable|string|max:255')]
    public string $location = '';

    #[Validate('required|string|max:100')]
    public string $genre = '';

    #[Validate('required|string|max:100')]
    public string $category = '';

    // Step 2: Media & Presence
    #[Validate('required|url|max:255')]
    public string $epk_link = '';

    #[Validate('nullable|url|max:255')]
    public string $instagram_url = '';

    #[Validate('nullable|url|max:255')]
    public string $spotify_url = '';

    #[Validate('nullable|url|max:255')]
    public string $youtube_url = '';

    // Step 3: Background & Fees
    #[Validate('required|string|min:50|max:1000')]
    public string $bio = '';

    #[Validate('required|integer|min:0|max:50')]
    public int $years_experience = 0;

    #[Validate('nullable|string|max:100')]
    public string $minimum_fee = '';

    #[Validate('boolean')]
    public bool $has_management = false;

    #[Validate('nullable|string|max:255')]
    public string $management_contact = '';

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
        match ($this->currentStep) {
            1 => $this->validate([
                'artist_name' => 'required|string|max:255',
                'email'       => 'required|email|max:255',
                'phone'       => 'nullable|string|max:20',
                'location'    => 'nullable|string|max:255',
                'genre'       => 'required|string|max:100',
                'category'    => 'required|string|max:100',
            ]),
            2 => $this->validate([
                'epk_link'      => 'required|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'spotify_url'   => 'nullable|url|max:255',
                'youtube_url'   => 'nullable|url|max:255',
                'gallery.*.url' => 'required|url|max:255',
                'gallery.*.title' => 'nullable|string|max:255',
                'gallery.*.description' => 'nullable|string|max:1000',
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
            'bio'                => 'required|string|min:50|max:1000',
            'years_experience'   => 'required|integer|min:0|max:50',
            'minimum_fee'        => 'nullable|string|max:100',
            'has_management'     => 'boolean',
            'management_contact' => 'nullable|string|max:255',
        ]);

        $submission = Submission::create([
            'artist_name'        => $this->artist_name,
            'email'              => $this->email,
            'phone'              => $this->phone,
            'location'           => $this->location,
            'genre'              => $this->genre,
            'category'           => $this->category,
            'epk_link'           => $this->epk_link,
            'instagram_url'      => $this->instagram_url,
            'spotify_url'        => $this->spotify_url,
            'youtube_url'        => $this->youtube_url,
            'bio'                => $this->bio,
            'years_experience'   => $this->years_experience,
            'minimum_fee'        => $this->minimum_fee,
            'has_management'     => $this->has_management,
            'management_contact' => $this->management_contact,
            'status'             => 'pending',
        ]);

        foreach ($this->gallery as $item) {
            if (!empty($item['url'])) {
                $submission->gallery()->create($item);
            }
        }

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.public.join-talent');
    }
}
