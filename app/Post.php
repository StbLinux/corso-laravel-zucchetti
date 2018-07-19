<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \Spiritix\LadaCache\Database\LadaCacheTrait;

    protected $guarded = [];

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


    public function getCoverAttribute($cover)
    {
        return '/storage/' . (($cover) ?? 'covers/default.jpg'); //null coalescence operator
    }

    // setters = mutators - modifica un dato prima di essere salvato nel db
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = $this->makeSlugFrom($title);
    }

    public function setCoverAttribute($cover)
    {
        $this->attributes['cover'] = $cover->store('covers');
    }

    private function makeSlugFrom($title)
    {
        $slug = str_slug($title);

        // trova posts con lo stesso slug,
        // se 0 ritorna slug
        // se >0 ritorna num+1

        return $slug;
    }

    public function tagLinks()
    {
        // $tagLinks = [];

        // foreach ($this->tags as $tag) {
        //     $tagLinks[] = "<a href='" . route('tags.show', $tag) .  "'>#" . $tag->name .  '</a>';
        // }
        // return join(', ', $tagLinks);

        return $this->tags->map(function ($tag) {
            return "<a href='" . route('tags.show', $tag) .  "'>#" . $tag->name .  '</a>';
        })->implode(', ');
    }
}
