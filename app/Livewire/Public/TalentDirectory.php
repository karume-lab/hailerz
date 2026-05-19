<?php

namespace App\Livewire\Public;

use App\Models\Category;
use App\Models\Talent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Talent Directory')]
class TalentDirectory extends Component
{
    use WithPagination;

    #[Url(history: true, except: '')]
    public string $search = '';

    #[Url(history: true, except: '')]
    public string $category = '';

    #[Url(history: true, except: null)]
    public ?int $category_id = null;

    #[Url(history: true, except: null)]
    public ?int $min_price = null;

    #[Url(history: true, except: null)]
    public ?int $max_price = null;

    #[Url(history: true, except: 'name')]
    public string $sort = 'name';

    #[Url(history: true, except: '')]
    public string $event = '';

    #[Url(history: true, except: '')]
    public string $location = '';

    #[Url(history: true, except: '')]
    public string $genre = '';

    #[Url(history: true, except: '')]
    public string $country = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryId()
    {
        $this->resetPage();
    }

    public function updatedMinPrice()
    {
        $this->resetPage();
    }

    public function updatedMaxPrice()
    {
        $this->resetPage();
    }

    public function updatedSort()
    {
        $this->resetPage();
    }

    public function updatedCountry()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'category_id', 'min_price', 'max_price', 'sort', 'location', 'genre', 'event', 'country']);
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->setPage($this->getPage() + 1);
    }

    public function render()
    {
        $perPage = 12;

        $talents = Talent::query()
            ->where('status', 'active')
            ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->category, fn ($query) => $query->whereHas('category', fn ($q) => $q->where('slug', $this->category)))
            ->when($this->event, fn ($query) => $query->where('bio', 'like', '%'.str_replace('_', ' ', $this->event).'%'))
            ->when($this->location, fn ($query) => $query->where('location', 'like', '%'.$this->location.'%'))
            ->when($this->country, fn ($query) => $query->where('country', $this->country))
            ->when($this->genre, fn ($query) => $query->where('genre', $this->genre))
            ->when($this->category_id, fn ($query) => $query->where('category_id', $this->category_id))
            ->when($this->min_price, fn ($query) => $query->where('starting_price', '>=', $this->min_price))
            ->when($this->max_price, fn ($query) => $query->where('starting_price', '<=', $this->max_price))
            ->with(['category', 'media'])
            ->when($this->sort === 'price_asc', fn ($query) => $query->orderBy('starting_price', 'asc'))
            ->when($this->sort === 'price_desc', fn ($query) => $query->orderBy('starting_price', 'desc'))
            ->when($this->sort === 'latest', fn ($query) => $query->orderByDesc('created_at'))
            ->when($this->sort === 'name', fn ($query) => $query->orderBy('name'))
            ->paginate($perPage * $this->getPage(), page: 1);

        $categories = Category::orderBy('name')->get();
        $locations = Talent::where('status', 'active')->whereNotNull('location')->distinct()->pluck('location')->sort();
        $genres = Talent::where('status', 'active')->whereNotNull('genre')->distinct()->pluck('genre')->sort();
        $countries = Talent::where('status', 'active')->whereNotNull('country')->distinct()->pluck('country')->sort();

        return view('livewire.public.talent-directory', [
            'talents' => $talents,
            'categories' => $categories,
            'locations' => $locations,
            'genres' => $genres,
            'countries' => $countries,
        ]);
    }
}
