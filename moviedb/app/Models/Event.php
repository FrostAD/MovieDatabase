<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'movie_id',
        'name',
        'date',
        'capacity',
        'location',
        'description',
    ];

    public $timestamps = false;

    public function movie()
    {
        return $this->hasOne('App\Models\Movie');
    }
}
