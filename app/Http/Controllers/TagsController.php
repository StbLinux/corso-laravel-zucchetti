<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            return $query->where('tag_id', $tag->id);
        })->with('comments.user', 'user', 'category', 'tags')->latest()->paginate(15);

        return view('tags.show', compact('tag', 'posts'));
    }
}
