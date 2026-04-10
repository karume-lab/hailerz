<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $table = 'talents';

    protected $fillable = [
        'name',
        'category',
        'min_fee',
        'target_markets',
        'is_virtual_ready',
        'headshot_path',
        'rider_path',
        'bio',
    ];

    protected $casts = [
        'target_markets' => 'array',
        'is_virtual_ready' => 'boolean',
    ];
}
