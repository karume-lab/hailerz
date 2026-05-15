<?php

namespace App\Models;

use App\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $primary_image_url
 * @property string|null $bio
 * @property string|null $location
 * @property string|null $country
 * @property float|null $starting_price
 * @property bool $is_featured
 */
class Talent extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, SoftDeletes, Cacheable;

    protected $table = 'talents';
    protected $guarded = [];
    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->hasMedia('primary_image')) {
            return $this->getFirstMediaUrl('primary_image', 'thumb');
        }

        if (!empty($this->primary_image_url)) {
            return $this->primary_image_url;
        }

        $name = str_replace(' ', '+', $this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=400";
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->hasMedia('primary_image')) {
            return $this->getFirstMediaUrl('primary_image', 'optimized');
        }

        if (!empty($this->primary_image_url)) {
            return $this->primary_image_url;
        }

        $name = str_replace(' ', '+', $this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=223757&color=ffffff&size=800";
    }

    protected function casts(): array
    {
        return [
            'starting_price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_frozen' => 'boolean',
            'has_signed_agreement' => 'boolean',
            'agreement_signed_at' => 'datetime',
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

    public function gallery(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(GalleryItem::class, 'galleryable');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400)
            ->sharpen(10)
            ->format('webp');

        $this->addMediaConversion('optimized')
            ->width(1200)
            ->height(800)
            ->withResponsiveImages()
            ->format('webp');
    }
}
