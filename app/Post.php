<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // appartiene a 1 User // user() // belongsTo
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // appartiene a 1 Category // category() // belongsTo
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // appartiene (ha) 1+ Tag // tags() // belongsToMany
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // ha 1+ (Poly) Comment // comments() // morphMany
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
