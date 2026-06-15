<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Challenge extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'prize_pool' => 'decimal:2',
            'demographics' => 'array',
            'universities' => 'array',
        ];
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($challenge) {
            if (empty($challenge->slug)) {
                $challenge->slug = Str::slug($challenge->title).'-'.time();
            }
        });
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ChallengeComment::class)->latest();
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(ChallengeInteraction::class);
    }

    public function likes(): HasMany
    {
        return $this->interactions()->where('type', 'like');
    }
}
