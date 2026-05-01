<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Talent extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, SoftDeletes;

    protected $table = 'talents';
    protected $guarded = [];
    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->primary_image_url) {
            return $this->primary_image_url;
        }

        $mediaUrl = $this->getFirstMediaUrl('primary_image', 'thumb');
        if ($mediaUrl) {
            return $mediaUrl;
        }

        // Fallback to initials avatar when no image is available
        $name = str_replace(' ', '+', $this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=400";
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if (!empty($this->primary_image_url)) {
            return $this->primary_image_url;
        }

        if ($this->hasMedia('primary_image')) {
            return $this->getFirstMediaUrl('primary_image', 'optimized') ?: $this->getFirstMediaUrl('primary_image');
        }

        // Bulletproof fallback
        $name = str_replace(' ', '+', $this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=800";
    }

    protected function casts(): array
    {
        return [
            'starting_price' => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('primary_image')
            ->singleFile();

        $this->addMediaCollection('gallery');
    }

    public function galleryItems(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(GalleryItem::class, 'galleryable');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->width(1200)
            ->height(800)
            ->withResponsiveImages();
    }
}
