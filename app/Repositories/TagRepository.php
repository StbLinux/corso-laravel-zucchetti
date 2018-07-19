<?php

namespace App\Repositories;

use App\Tag;
use App\Post;

class TagRepository
{
    public function getPaginatedPostsForTag(Tag $tag, $howMany = 15)
    {
        return Post::whereHas('tags', function ($query) use ($tag) {
            return $query->where('tag_id', $tag->id);
        })->with('comments.user', 'user', 'category', 'tags')->latest()->paginate($howMany);
    }
}
