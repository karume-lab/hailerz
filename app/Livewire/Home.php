<?php

namespace App\Livewire;

use App\Models\Talent;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $featuredTalent = Talent::where('is_featured', true)
            ->where('status', 'active')
            ->take(6)
            ->get();

        return view('livewire.home', [
            'featuredTalent' => $featuredTalent,
        ])->layout('components.layouts.app');
    }
}
