<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Livewire\Component;

class ShowResource extends Component
{
    public $slug;
    public $post;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.show-resource')
            ->layout('components.layouts.app', [
                'title' => $this->post->title . ' — Resources',
                'description' => $this->post->subtitle,
                'ogImage' => route('og.resource', ['slug' => $this->post->slug, 'v' => $this->post->updated_at?->timestamp]),
            ]);
    }
}
