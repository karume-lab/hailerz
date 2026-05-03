<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use App\Models\Talent;
use App\Models\Category;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Premium Talent Booking Agency')]
class Home extends Component
{
    public string $search = '';

    // Contact form
    public string $contactName = '';
    public string $contactEmail = '';
    public string $contactMessage = '';
    public bool $contactSent = false;

    public function searchTalent()
    {
        return $this->redirectRoute('talent.directory', ['search' => $this->search], navigate: true);
    }

    protected array $rules = [
        'contactName'    => 'required|string|max:255',
        'contactEmail'   => 'required|email|max:255',
        'contactMessage' => 'required|string|min:10',
    ];

    protected array $messages = [
        'contactName.required'    => 'Please enter your name.',
        'contactEmail.required'   => 'Please enter a valid email address.',
        'contactMessage.required' => 'Please write a message.',
        'contactMessage.min'      => 'Your message should be at least 10 characters.',
    ];

    public function submitContact(): void
    {
        $this->validate();

        // Log the submission; swap for Mail::to() once an email driver is configured
        Log::info('Home contact form submission', [
            'name'    => $this->contactName,
            'email'   => $this->contactEmail,
            'message' => $this->contactMessage,
        ]);

        $this->reset('contactName', 'contactEmail', 'contactMessage');
        $this->contactSent = true;
    }

    public function render()
    {
        $featuredTalents = Talent::where('is_featured', true)
            ->where('status', 'active')
            ->with('category')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $categories = Category::withCount(['talents' => function($query) {
            $query->where('status', 'active');
        }])
        ->with(['talents' => function($query) {
            $query->where('status', 'active')->limit(1);
        }])
        ->get()
        ->map(function($category) {
            $category->default_image = match($category->slug) {
                'musicians' => asset('images/home/musicians.webp'),
                'djs' => asset('images/home/djs.webp'),
                'speakers' => asset('images/home/speakers.webp'),
                'comedians' => asset('images/home/comedians.webp'),
                'dancers' => asset('images/categories/dancers.webp'),
                'artists' => asset('images/categories/artists.webp'),
                'poets' => asset('images/categories/poets.webp'),
                'content-creators' => asset('images/categories/content-creators.webp'),
                'mcs' => asset('images/categories/mcs.webp'),
                'variety-artists' => asset('images/categories/variety-artists.webp'),
                default => asset('images/home/specialty.webp'),
            };
            return $category;
        });

        return view('livewire.public.home', [
            'featuredTalents' => $featuredTalents,
            'categories'      => $categories,
        ]);
    }
}
