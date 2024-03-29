<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use willvincent\Rateable\Rateable;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use CrudTrait;
    use HasRoles;
    use Searchable;
    use SoftDeletes;

    const SEARCHABLE_FIELDS = ['id','name'];

    public function toSearchableArray()
    {
        return $this->only(self::SEARCHABLE_FIELDS);
    }

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


    /**
     * Gets all movies related to this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movies()
    {
        return $this->hasMany(\App\Models\Movie::class);
    }

    /**
     * Gets all events created by this user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events_author(){
        return $this->hasMany(Event::class);
    }

    /**
     * Gets all events in which the current user is sign up(as author + member)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events(){
        return $this->belongsToMany(Event::class,'event_user');
    }

    /**
     * Gets all movies which are in the current user watchlist
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function watchlist(){
        return $this->belongsToMany(Movie::class,'watchlist','user_id','movie_id');
    }

    /**
     * Gets all movies which are in the current user wishlist
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist(){
        return $this->belongsToMany(Movie::class,'wishlist','user_id','movie_id');
    }
}
