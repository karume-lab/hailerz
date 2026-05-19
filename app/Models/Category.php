<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $default_image
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'popular_genres' => 'array',
    ];

    public function talents(): HasMany
    {
        return $this->hasMany(Talent::class);
    }
}
