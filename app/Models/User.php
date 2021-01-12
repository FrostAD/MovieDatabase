<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;
use willvincent\Rateable\Rateable;

// <---------------------- and this one

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this
    //TODO is it needed rateable
//    use Rateable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'rating',
        'rating_post',
        'rating_exchange',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movies()
    {
        return $this->hasMany(\App\Models\Movie::class);
    }
    public function events(){
        return $this->belongsToMany(Event::class,'event_user');
    }
    //not tested
    public function watchlist(){
        return $this->belongsToMany(Movie::class,'watchlist','user_id','movie_id');
    }
    // end not tested
}
