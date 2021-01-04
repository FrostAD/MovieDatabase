<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'date',
        'capacity',
        'current_cappacity',
        'location',
        'description',
        'movie_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'movie_id' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];


    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function user()
    {
        //TODO after model::class is the local foreign key and then is the reference key(key of the model in this case User)
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }

    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
}
