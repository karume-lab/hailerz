<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'website_url',
        'instagram_handle',
        'facebook_url',
        'youtube_channel',
        'tiktok_handle',
        'notable_venues',
        'notable_clients',
        'press_features',
        'bio',
        'motivation',
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

    public function gallery()
    {
        return $this->morphMany(GalleryItem::class, 'galleryable');
    }
}
