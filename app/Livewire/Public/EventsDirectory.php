<?php

namespace App\Livewire\Public;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Event Directory')]
class EventsDirectory extends Component
{
    use WithPagination;

    #[Url(history: true, except: '')]
    public string $search = '';

    #[Url(history: true, except: 'name')]
    public string $sort = 'name';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSort()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sort']);
        $this->resetPage();
    }

    public function loadMore()
    {
        $this->setPage($this->getPage() + 1);
    }

    public function render()
    {
        $perPage = 12;

        $directoryEvents = Event::query()
            ->where('status', 'published')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%')
                        ->orWhere('location', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->sort === 'latest', fn ($query) => $query->orderByDesc('created_at'))
            ->when($this->sort === 'name', fn ($query) => $query->orderBy('title'))
            ->paginate($perPage * $this->getPage(), page: 1);

        return view('livewire.public.events-directory', [
            'directoryEvents' => $directoryEvents,
        ]);
    }
}
