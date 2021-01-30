<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Exchange extends Model
{
    use HasFactory;
    use Rateable;

    protected $fillable = [
        'movie1_id',
        'user1_id',
        'movie2_id',
        'user2_id',
        'return1',
        'return2',
        'rating_for_first',
        'rating_for_second',
        'visible',
    ];

    /**
     * Gets exchange author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function first_user(){
        return $this->belongsTo(User::class,'user1_id','id');
    }

    /**
     * Gets the offered movie from the author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function first_movie(){
        return $this->belongsTo(Movie::class,'movie1_id','id');
    }

    /**
     * Gets the second user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function second_user(){
        return $this->belongsTo(User::class,'user2_id','id');
    }

    /**
     * Gets the movie offered from the second user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function second_movie(){
        return $this->belongsTo(Movie::class,'movie2_id','id');
    }
}
