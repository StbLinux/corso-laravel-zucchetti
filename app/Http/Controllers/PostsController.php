<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::with('comments.user', 'user', 'category', 'tags')->latest();

        if ($year = request('year')) {
            $posts->whereYear('created_at', $year);
        }

        if ($month = request('month')) {
            $posts->whereMonth('created_at', Carbon::parse($month)->month);
        }

        $posts = $posts->paginate(15);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments.user', 'user', 'category', 'tags');

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create')->withPost(new Post);
    }

    public function store(PostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.show', $post)->withSuccess('The post was created.');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostRequest $request)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        $post->tags()->sync($request->tags);

        return redirect()->route('posts.show', $post)->withNotice('The post was updated.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/')->withError('The post was deleted.');
    }
}
