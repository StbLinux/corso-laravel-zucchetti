<?php

namespace App\Observers;

use App\Post;
use App\Events\PostWasUpdated;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    public function updated(Post $post)
    {
        event(new PostWasUpdated($post->load('user')));
    }

    public function deleting(Post $post)
    {
        $post->tags()->sync([]);

        if ($post->cover !== '/storage/covers/default.jpg') {
            Storage::delete(str_replace('/storage/', '', $post->cover));
        }
    }
}
