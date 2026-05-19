<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Livewire\Attributes\Url;
use Livewire\Component;

class Resources extends Component
{
    #[Url]
    public $tab = 'blog';

    #[Url]
    public $category = 'All';

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->category = 'All';
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $query = Post::where('is_published', true);

        if ($this->tab === 'blog') {
            if ($this->category !== 'All') {
                $query->where('category', $this->category);
            } else {
                $query->whereNotIn('category', ['Video', 'Gallery']);
            }
        } elseif ($this->tab === 'videos') {
            $query->where('category', 'Video');
        } elseif ($this->tab === 'gallery') {
            $query->where('category', 'Gallery');
        }

        $posts = $query->orderBy('published_at', 'desc')->get();

        return view('livewire.public.resources', [
            'posts' => $posts,
        ]);
    }
}
