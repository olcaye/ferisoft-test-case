<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug) {

        $category = Category::where('slug', $slug)->where('is_active', 1)->firstOrFail();

        $posts = $category->posts()->where('status',1)->latest()->paginate(10);

        return view('categories.show', compact('category', 'posts'));
    }
}
