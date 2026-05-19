<?php

namespace App\Livewire\Public;

use App\Mail\AdminStaffingInquiryNotification;
use App\Models\Category;
use App\Models\StaffingInquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Event Staffing | Hailerz')]
class Staffing extends Component
{
    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone = '';

    public string $company = '';

    public string $needs = '';

    public bool $requestSent = false;

    protected array $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'needs' => 'required|string|min:10',
    ];

    public function submitRequest(): void
    {
        $this->validate();

        $inquiry = StaffingInquiry::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'needs' => $this->needs,
        ]);

        Log::info('Staffing inquiry submitted', $inquiry->toArray());

        // Send email to admin
        try {
            Mail::to(config('mail.from.address'))->send(new AdminStaffingInquiryNotification($inquiry));
        } catch (\Exception $e) {
            Log::error('Failed to send staffing inquiry email', ['error' => $e->getMessage()]);
        }

        $this->reset(['first_name', 'last_name', 'email', 'phone', 'company', 'needs']);
        $this->requestSent = true;
    }

    public function updated($propertyName): void
    {
        if ($this->getErrorBag()->has($propertyName)) {
            $this->validateOnly($propertyName);
        }
    }

    public function render()
    {
        $categories = Category::where('is_professional', true)
            ->where('is_active', true)
            ->withCount(['talents' => function ($query) {
                $query->where('status', 'active');
            }])
            ->with(['talents' => function ($query) {
                $query->where('status', 'active')->limit(1);
            }])
            ->get()
            ->map(function ($category) {
                // Use a default image if one exists for the slug, otherwise it will fall back to talent photo or placeholder
                $path = "images/home/{$category->slug}.webp";
                $category->default_image = file_exists(public_path($path))
                    ? asset($path)
                    : asset('images/placeholder-category.webp');

                return $category;
            });

        return view('livewire.public.staffing', [
            'professionalCategories' => $categories,
        ]);
    }
}
