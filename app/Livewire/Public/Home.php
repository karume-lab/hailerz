<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use App\Models\Talent;
use App\Models\Category;
use App\Models\Faq;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Premium Talent Booking Agency')]
class Home extends Component
{
    public string $search = '';

    // Contact form
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $subject = '';
    public string $message = '';
    public bool $contactSent = false;

    public function searchTalent()
    {
        return $this->redirectRoute('talent.directory', ['search' => $this->search], navigate: true);
    }

    protected array $rules = [
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|max:255',
        'phone'      => 'nullable|string|max:20',
        'subject'    => 'required|string|max:255',
        'message'    => 'required|string|min:10',
    ];

    protected array $messages = [
        'first_name.required' => 'Please enter your first name.',
        'last_name.required'  => 'Please enter your last name.',
        'email.required'      => 'Please enter a valid email address.',
        'subject.required'    => 'Please select a subject.',
        'message.required'    => 'Please write a message.',
        'message.min'         => 'Your message should be at least 10 characters.',
    ];

    public function submitContact(): void
    {
        $this->validate();

        Log::info('Home contact form submission', [
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'subject'    => $this->subject,
            'message'    => $this->message,
        ]);

        $this->reset('first_name', 'last_name', 'email', 'phone', 'subject', 'message');
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

        $categories = Category::withCount(['talents' => function ($query) {
            $query->where('status', 'active');
        }])
            ->with(['talents' => function ($query) {
                $query->where('status', 'active')->limit(1);
            }])
            ->get()
            ->filter(function ($category) {
                return file_exists(public_path("images/home/{$category->slug}.webp"));
            })
            ->map(function ($category) {
                $category->default_image = asset("images/home/{$category->slug}.webp");
                return $category;
            });

        $faqs = Faq::where('is_published', true)
            ->orderBy('sort_order')
            ->get();
            
        return view('livewire.public.home', [
            'featuredTalents' => $featuredTalents,
            'categories'      => $categories,
            'faqs'            => $faqs,
        ]);
    }
}
