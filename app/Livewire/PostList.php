<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::where('is_published', true)
                ->latest()
                ->paginate(12),
        ])->layout('components.layouts.app');
    }
}
