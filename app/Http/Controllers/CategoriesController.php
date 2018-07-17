<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->with('comments.user', 'user', 'category', 'tags')->latest()->paginate(15);

        return view('categories.show', compact('category', 'posts'));
    }
}
