<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'timespan',
        'description',
        'published_at',
        'genres',
        'poster',
        'producer',
        'music',
        'studio',
        'country',
        'trailer',
    ];

    public $timestamps = false;
}
