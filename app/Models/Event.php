<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

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
