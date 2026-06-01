<?php

namespace App\Livewire\Public;

use App\Models\EventRegistration;
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

        $registrations = EventRegistration::query()
            ->where('pass_type', 'exhibitor')
            ->where('payment_status', 'confirmed')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('company_name', 'like', '%'.$this->search.'%')
                        ->orWhere('company_description', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->sort === 'latest', fn ($query) => $query->orderByDesc('created_at'))
            ->when($this->sort === 'name', fn ($query) => $query->orderBy('company_name'))
            ->paginate($perPage * $this->getPage(), page: 1);

        return view('livewire.public.events-directory', [
            'registrations' => $registrations,
        ]);
    }
}
