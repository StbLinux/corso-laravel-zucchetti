<?php

namespace App\Repositories;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostRepository
{
    public function getAllPaginated(Request $request, $howMany = 15)
    {
        $posts = Post::with('comments.user', 'user', 'category', 'tags')->latest();

        if ($year = $request->get('year')) {
            $posts->whereYear('created_at', $year);
        }

        if ($month = $request->get('month')) {
            $posts->whereMonth('created_at', Carbon::parse($month)->month);
        }

        $posts = $posts->paginate($howMany);

        return $posts;
    }

    public function createPostFrom(Request $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        $post->tags()->sync($request->tags);

        return $post;
    }

    public function updatePostFrom(Post $post, Request $request)
    {
        $post->update($request->validated());

        $post->tags()->sync($request->tags);

        return $post;
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        return $post;
    }

    public function loadWithRelations(Post $post)
    {
        return $post->load('comments.user', 'user', 'category', 'tags');
    }
}
