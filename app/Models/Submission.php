<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'artist_name',
        'email',
        'phone',
        'location',
        'genre',
        'category',
        'epk_link',
        'instagram_url',
        'spotify_url',
        'youtube_url',
        'bio',
        'years_experience',
        'minimum_fee',
        'has_management',
        'management_contact',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'has_management' => 'boolean',
        ];
    }

    public function gallery()
    {
        return $this->morphMany(GalleryItem::class, 'galleryable');
    }
}
