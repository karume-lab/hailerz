<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Livewire\Component;

class Resources extends Component
{
    public $tab = 'blog';
    public $category = 'All';

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $query = Post::where('is_published', true);

        if ($this->category !== 'All') {
            $query->where('category', $this->category);
        }

        $posts = $query->orderBy('published_at', 'desc')->get();

        return view('livewire.public.resources', [
            'posts' => $posts
        ]);
    }
}
