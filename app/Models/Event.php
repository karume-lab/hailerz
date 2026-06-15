<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::saving(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'exhibitor_price' => 'decimal:2',
            'attendee_price' => 'decimal:2',
            'demographics' => 'array',
            'universities' => 'array',
        ];
    }
}
