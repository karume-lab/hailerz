<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class GalleryItem extends Model
{
    protected $fillable = [
        'galleryable_id',
        'galleryable_type',
        'url',
        'title',
        'description',
        'sort_order',
    ];

    public function galleryable(): MorphTo
    {
        return $this->morphTo();
    }
}
