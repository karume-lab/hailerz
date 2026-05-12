<?php

namespace App\Models;

use App\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Cacheable;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'author',
        'image_url',
        'subtitle',
        'content',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'content' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
