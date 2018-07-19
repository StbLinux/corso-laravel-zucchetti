<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
    public function show(Category $category, CategoryRepository $categoryRepo)
    {
        return $categoryRepo->getPaginatedPostsForCategory($category, 15);
    }
}
