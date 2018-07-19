<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;

class PostsController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->middleware('jwt.auth')->except('index', 'show');
        $this->postRepo = $postRepo;
    }

    public function index(Request $request)
    {
        return $this->postRepo->getAllPaginated($request, 15);
    }

    public function store(PostRequest $request)
    {
        return $this->postRepo->createPostFrom($request);
    }

    public function show(Post $post) //dependency injection - dependecy resolution
    {
        return $this->postRepo->loadWithRelations($post);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        return $this->postRepo->updatePostFrom($post, $request);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        return $this->postRepo->deletePost($post);
    }
}
