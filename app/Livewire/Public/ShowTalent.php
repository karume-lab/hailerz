<?php

namespace App\Livewire\Public;

use App\Models\Talent;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ShowTalent extends Component
{
    public Talent $talent;

    public function mount(string $slug)
    {
        $this->talent = Talent::with('gallery')->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.show-talent')
            ->title('Book ' . $this->talent->name . ' | Hailerz')
            ->layout('components.layouts.app', [
                'ogTitle' => $this->talent->name . ' | Premium Talent',
                'ogDescription' => Str::limit(strip_tags($this->talent->bio), 150),
                'ogImage' => $this->talent->primary_image_url ?: $this->talent->getFirstMediaUrl('primary_image'),
            ]);
    }
}
