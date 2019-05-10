<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::all();
        return $categories->toJson();
    }
}
