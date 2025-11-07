<?php
// app/Http/Controllers/BlogController.php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::published()->with('user')->latest('published_at');

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->byCategory($request->category);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->paginate(9);
        $featuredPost = BlogPost::published()->featured()->latest('published_at')->first();
        $categories = BlogPost::published()->distinct()->pluck('category');
        $popularPosts = BlogPost::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('blog.index', compact('posts', 'featuredPost', 'categories', 'popularPosts'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        
        // Increment view count
        $post->increment('view_count');

        $relatedPosts = BlogPost::published()
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show posts by category
     */
    public function category($category)
    {
        $posts = BlogPost::published()
            ->byCategory($category)
            ->latest('published_at')
            ->paginate(9);

        $categories = BlogPost::published()->distinct()->pluck('category');
        $popularPosts = BlogPost::published()->orderBy('view_count', 'desc')->take(5)->get();

        return view('blog.category', compact('posts', 'category', 'categories', 'popularPosts'));
    }

    // Hapus method-method lainnya yang tidak digunakan
    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function edit($id)
    {
        abort(404);
    }

    public function update(Request $request, $id)
    {
        abort(404);
    }

    public function destroy($id)
    {
        abort(404);
    }
}