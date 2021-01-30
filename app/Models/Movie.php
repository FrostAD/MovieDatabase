<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Movie extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Rateable;
    use Searchable;
    use SoftDeletes;

    const SEARCHABLE_FIELDS = ['id','title'];

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
        'user_id',
        'title',
        'published',
        'rating',
        'rating_imbd',
        'archived',
        'timespan',
        'description',
        'poster',
        'country_produced',
        'trailer',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'rating' => 'double',
        'rating_imbd' => 'double',
        'archived' => 'boolean',
    ];
    protected $dates = [
        'published',
    ];

    /**
     * Set the directory for saving new images
     * @param $value
     */
    public function setPosterAttribute($value)
    {
        $attribute_name = "poster";
        $disk = "public";
        $destination_path = "img/movies";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    /**
     *Delete the image when the movie is deleted
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($obj) {
            \Storage::disk('public')->delete($obj->image);
        });
    }

    /**
     * Returns imbd rating for selected movie
     * @param $title
     * @return string|string[]
     */
    public static function findByTitle_imbd($title)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb-internet-movie-database-unofficial.p.rapidapi.com/film/" . rawurlencode($title),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: imdb-internet-movie-database-unofficial.p.rapidapi.com",
                "x-rapidapi-key: e1e35729f3msh632c29a6ed8fce5p120306jsn15147069dd8b"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $res = explode(",", $response);
            // dd($res);
            //TODO find if is possible to get awards
            $res = explode(":", $res[4]);
            $value = str_replace('"', "", $res[1]);
            return $value;
        }
    }

    /**
     * Gets all genres for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(\App\Models\Genre::class);
    }

    /**
     * Gets all actors for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actors()
    {
        return $this->belongsToMany(\App\Models\Actor::class);
    }

    /**
     * Gets all producers for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function producers()
    {
        return $this->belongsToMany(\App\Models\Producer::class);
    }

    /**
     * Gets all musicians for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function musicians()
    {
        return $this->belongsToMany(\App\Models\Musician::class);
    }

    /**
     * Gets all studios for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function studios()
    {
        return $this->belongsToMany(\App\Models\Studio::class);
    }

    /**
     * Gets all screenwriters for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function screenwritters()
    {
        return $this->belongsToMany(\App\Models\Screenwritter::class);
    }

    /**
     * Gets movie author(uploader)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Gets all comments for selected movie
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable')->whereNull('parent_id');
    }

    /**
     * Gets all users which have the selected movie in their watchlist
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function watchlist_users()
    {
        return $this->belongsToMany(User::class, 'watchlist', 'movie_id', 'user_id');
    }

    /**
     * Gets all users which have the selected movie in their wishlist
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist_users()
    {
        return $this->belongsToMany(User::class, 'wishlist', 'movie_id', 'user_id');
    }
}
