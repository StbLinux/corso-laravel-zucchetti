<?php

namespace App\Repositories;

use App\Post;
use App\Category;

class CategoryRepository
{
    public function getPaginatedPostsForCategory(Category $category, $howMany = 15)
    {
        return Post::where('category_id', $category->id)->with('comments.user', 'user', 'category', 'tags')
        ->latest()
        ->paginate($howMany);
    }
}
