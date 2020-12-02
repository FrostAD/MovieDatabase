<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'born_date',
        'born_place',
        'description',
        'movie_id',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'id');
        //(Actor has many movies 'column name in movies')  movie_id == id (from movies)
    }
    public $timestamps = false;
}
