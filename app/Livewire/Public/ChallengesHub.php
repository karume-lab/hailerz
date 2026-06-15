<?php

namespace App\Livewire\Public;

use App\Models\Challenge;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Hailerz | Creative Sprints & Challenges')]
class ChallengesHub extends Component
{
    use WithPagination;

    public $selectedFilter = 'all';

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->resetPage();
    }

    public function render()
    {
        $query = Challenge::withCount(['comments', 'interactions']);

        if ($this->selectedFilter === 'active') {
            $query->where('end_date', '>=', Carbon::now());
        } elseif ($this->selectedFilter === 'archived') {
            $query->where('end_date', '<', Carbon::now());
        } elseif (preg_match('/^[0-9]{4}-[0-9]{2}$/', $this->selectedFilter)) {
            [$year, $month] = explode('-', $this->selectedFilter);
            $query->whereYear('start_date', $year)->whereMonth('start_date', $month);
        }

        return view('livewire.public.challenges-hub', [
            'challenges' => $query->latest()->paginate(9),
            'availableMonths' => Challenge::selectRaw('YEAR(start_date) year, MONTH(start_date) month')
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->get(),
        ]);
    }
}
