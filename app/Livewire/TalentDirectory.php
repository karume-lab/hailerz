<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Talent;
use Livewire\Component;
use Livewire\WithPagination;

class TalentDirectory extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryId = null;
    public $location = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null],
        'location' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryId()
    {
        $this->resetPage();
    }

    public function updatedLocation()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Talent::query()
            ->where('status', 'active')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->categoryId, fn($q) => $q->where('category_id', $this->categoryId))
            ->when($this->location, fn($q) => $q->where('location', 'like', '%' . $this->location . '%'))
            ->orderBy('is_featured', 'desc')
            ->orderBy('name', 'asc');

        return view('livewire.talent-directory', [
            'talents' => $query->paginate(12),
            'categories' => Category::where('is_active', true)->get(),
        ])->layout('components.layouts.app');
    }
}
