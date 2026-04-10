<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['artist_name', 'email', 'epk_link', 'status'];
}
