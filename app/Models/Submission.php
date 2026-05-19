<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read Collection<int, GalleryItem> $gallery
 */
class Submission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'artist_name',
        'real_name',
        'email',
        'phone',
        'location',
        'profile_photo_url',
        'category',
        'genre',
        'years_active',
        'min_rate',
        'max_rate',
        'currency',
        'website_url',
        'instagram_handle',
        'facebook_url',
        'youtube_channel',
        'tiktok_handle',

        'notable_clients',
        'press_features',
        'bio',

        'source',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'min_rate' => 'decimal:2',
            'max_rate' => 'decimal:2',
        ];
    }

    /**
     * @return MorphMany<GalleryItem, $this>
     */
    public function gallery()
    {
        return $this->morphMany(GalleryItem::class, 'galleryable');
    }
}
