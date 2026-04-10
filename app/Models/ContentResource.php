<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentResource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'content',
        'file_path',
        'is_published',
    ];
}