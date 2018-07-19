<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

    // ha 1+ Post // posts() // hasMany
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
