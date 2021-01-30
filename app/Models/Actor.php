<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
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
        'born_date',
        'born_place',
        'description',
        'image',
        'archived',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'archived' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'born_date',
    ];

    /**
     * Set the directory for saving new images
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "img/actors";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    /**
     *Delete the image when the actor is deleted
     */
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($obj) {
            \Storage::disk('public')->delete($obj->image);
        });
    }


    /**
     * Gets all movies related to this actor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movies()
    {
        return $this->belongsToMany(\App\Models\Movie::class);
    }
}
