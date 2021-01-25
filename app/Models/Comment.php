<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function replies()
    {
        return $this->hasMany(\App\Models\Comment::class, 'parent_id');
    }
}
