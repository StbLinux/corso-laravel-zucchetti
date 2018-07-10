<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // appartiene (ha) 1+ Post // posts() // belongsToMany
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
