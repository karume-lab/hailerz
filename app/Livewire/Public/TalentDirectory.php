<?php

namespace App\Livewire\Public;

use App\Models\Talent;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Roster Directory')]
class TalentDirectory extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public ?int $category_id = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $talents = Talent::query()
            ->where('status', 'active')
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->category_id, fn ($query) => $query->where('category_id', $this->category_id))
            ->with(['category', 'media'])
            ->orderBy('name')
            ->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('livewire.public.talent-directory', [
            'talents' => $talents,
            'categories' => $categories,
        ]);
    }
}
