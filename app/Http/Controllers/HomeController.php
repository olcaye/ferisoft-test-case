<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $categoryId = $request->query('category');

        $posts = Post::where('status',1)->when($categoryId, function($query) use($categoryId) {
           return $query->whereHas('categories', function($q) use($categoryId) {
               $q->where('categories.id', $categoryId);
           });
        })
            ->latest()
            ->take(10)
            ->get();


        $categories = Category::where('is_active', 1)->get();

        return view('home', compact('posts', 'categories', 'categoryId'));
    }
}
