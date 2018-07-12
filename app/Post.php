<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    // protected $fillable = [];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // protected $casts = [
    //     'emailed_at' => 'datetime',
    //     'altraProp' => 'int',
    // ];

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

    // getters - accessors - modifica un dato prima di essere restituito all'utente
    // public function getTitleAttribute($title)
    // {
    //     return strtoupper($title);
    // }

    // setters = mutators - modifica un dato prima di essere salvato nel db
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = $this->makeSlugFrom($title);
    }

    private function makeSlugFrom($title)
    {
        $slug = str_slug($title);

        // trova posts con lo stesso slug,
        // se 0 riturna slug
        // se >0 ritorna num+1

        return $slug;
    }
}
