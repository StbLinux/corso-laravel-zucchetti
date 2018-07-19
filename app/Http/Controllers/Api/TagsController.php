<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function show(Tag $tag, TagRepository $tagRepo)
    {
        return $tagRepo->getPaginatedPostsForTag($tag, 15);
    }
}
