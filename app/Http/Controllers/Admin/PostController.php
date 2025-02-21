<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('categories', 'user')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|unique:posts,title',
            'content'         => 'required',
            'status'          => 'required|boolean',
            'categories'      => 'required|array',
            'registered_only' => 'nullable|boolean',
        ]);

        $post = Post::create([
            'title'           => $request->input('title'),
            'slug'            => Str::slug($request->input('title')),
            'content'         => $request->input('content'),
            'status'          => $request->input('status'),
            'registered_only' => $request->input('registered_only') ?? 0,
            'user_id'         => auth()->id(),
        ]);

        $post->categories()->attach($request->input('categories'));

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'           => 'required|unique:posts,title,' . $post->id,
            'content'         => 'required',
            'status'          => 'required|boolean',
            'categories'      => 'required|array',
            'registered_only' => 'nullable|boolean',
        ]);

        $post->update([
            'title'           => $request->input('title'),
            'slug'            => Str::slug($request->input('title')),
            'content'         => $request->input('content'),
            'status'          => $request->input('status'),
            'registered_only' => $request->input('registered_only') ?? 0,
        ]);

        $post->categories()->sync($request->input('categories'));

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
