<?php

namespace App\Livewire\Public;

use App\Models\Talent;
use Illuminate\Support\Str;
use Livewire\Component;

class ShowTalent extends Component
{
    public Talent $talent;

    public function mount(string $slug)
    {
        $this->talent = Talent::with('galleryItems')->where('slug', $slug)
            ->where('status', 'active')->where('has_signed_agreement', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.show-talent')
            ->title('Book '.$this->talent->name.' | Hailerz')
            ->layout('components.layouts.app', [
                'ogTitle' => $this->talent->name.' | Premium Talent',
                'ogDescription' => Str::limit(strip_tags($this->talent->bio), 150),
                'ogImage' => route('og.talent', ['slug' => $this->talent->slug, 'v' => $this->talent->updated_at?->timestamp]),
            ]);
    }
}
