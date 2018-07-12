<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments.user', 'user', 'category', 'tags')->latest()->paginate(15);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments.user', 'user', 'category', 'tags');

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $postData = $request->only('title', 'category_id', 'preview', 'body');
        $postData['user_id'] = auth()->id();

        $post = Post::create($postData);
        // $post = Post::forceCreate($postData);

        $post->tags()->sync($request->tags);

        return $post;
    }
}
