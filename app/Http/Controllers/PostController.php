<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        $posts = Post::where('status', 1)->when($categoryId, function ($query) use ($categoryId) {
            return $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        })
            ->latest()
            ->paginate(10);


        $categories = Category::where('is_active', 1)->get();

        return view('posts.index', compact('posts', 'categories', 'categoryId'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->firstOrFail();


        // sadece kayitli kullanicilar gorebilir bu postu
        if ($post->isRegisteredOnly() && !Auth::check()) {
            abort(403, 'Goruntulemek icin giris yapin');
        }

        return view('posts.show', compact('post'));
    }
}
