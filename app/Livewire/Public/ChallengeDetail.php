<?php

namespace App\Livewire\Public;

use App\Models\Challenge;
use App\Models\ChallengeComment;
use App\Models\ChallengeInteraction;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ChallengeDetail extends Component
{
    public Challenge $challenge;

    public string $newComment = '';

    public function mount($slug)
    {
        $this->challenge = Challenge::where('slug', $slug)->with(['comments.user', 'interactions'])->firstOrFail();
    }

    public function toggleLike()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $existing = ChallengeInteraction::where('user_id', auth()->id())
            ->where('challenge_id', $this->challenge->id)
            ->where('type', 'like')
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            ChallengeInteraction::create([
                'user_id' => auth()->id(),
                'challenge_id' => $this->challenge->id,
                'type' => 'like',
            ]);
        }

        $this->challenge->load('interactions');
    }

    public function postComment()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $this->validate(['newComment' => 'required|string|max:1000']);

        ChallengeComment::create([
            'challenge_id' => $this->challenge->id,
            'user_id' => auth()->id(),
            'body' => $this->newComment,
        ]);

        $this->newComment = '';
        $this->challenge->load('comments.user');
    }

    public function render()
    {
        return view('livewire.public.challenge-detail')
            ->title("Hailerz | {$this->challenge->title}");
    }
}
