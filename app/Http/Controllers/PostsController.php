<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;

class PostsController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->middleware('auth')->except('index', 'show');
        $this->postRepo = $postRepo;
    }

    public function index(Request $request)
    {
        $posts = $this->postRepo->getAllPaginated($request, 15);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post = $this->postRepo->loadWithRelations($post);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create')->withPost(new Post);
    }

    public function store(PostRequest $request)
    {
        $post = $this->postRepo->createPostFrom($request);

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

        $post = $this->postRepo->updatePostFrom($post, $request);

        return redirect()->route('posts.show', $post)->withNotice('The post was updated.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postRepo->deletePost($post);

        return redirect('/')->withError('The post was deleted.');
    }
}
