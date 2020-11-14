<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'timespan',
        'description',
        'published_at',
        'genres',
        'poster',
    ];

    public $timestamps = false;
}
