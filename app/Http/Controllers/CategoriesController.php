<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
    public function show(Category $category, CategoryRepository $categoryRepo)
    {
        $posts = $categoryRepo->getPaginatedPostsForCategory($category, 15);

        return view('categories.show', compact('category', 'posts'));
    }
}
