<?php
// app/Http/Controllers/Admin/BlogController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBlog extends Controller
{
   public function index()
    {
        $posts = BlogPost::with(['user', 'approvedBy'])->latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show posts pending approval
     */
    public function pending()
    {
        $posts = BlogPost::pendingApproval()
                        ->with('user')
                        ->latest()
                        ->paginate(10);

        return view('admin.blog.pending', compact('posts'));
    }

    /**
     * Approve a blog post
     */
    public function approve(BlogPost $blog)
    {
        $blog->approve(auth()->user());

        return redirect()->route('admin.blog.pending')
            ->with('success', 'Post berhasil disetujui dan dipublikasikan!');
    }

    /**
     * Reject a blog post
     */
    public function reject(Request $request, BlogPost $blog)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $blog->reject(auth()->user(), $request->rejection_reason);

        return redirect()->route('admin.blog.pending')
            ->with('success', 'Post berhasil ditolak!');
    }

    /**
     * Show rejection form
     */
    public function showRejectForm(BlogPost $blog)
    {
        return view('admin.blog.reject', compact('blog'));
    }

    public function create()
    {
        $categories = [
            'Tips & Edukasi',
            'Kampanye',
            'Berita',
            'Lingkungan',
            'Komunitas',
            'Teknologi',
            'Inspirasi'
        ];

        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required|max:500',
            'content' => 'required',
            'category' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'author_name' => 'required',
            'author_avatar' => 'nullable|image|max:1024',
            'tags' => 'nullable|string',
            'reading_time' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean'
        ]);

        $post = new BlogPost();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title) . '-' . Str::random(6);
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->author_name = $request->author_name;
        $post->reading_time = $request->reading_time ?? ceil(str_word_count(strip_tags($request->content)) / 200);
        $post->status = $request->status;
        $post->is_featured = $request->has('is_featured');
        $post->user_id = auth()->id();

        if ($request->has('tags')) {
            $post->tags = array_map('trim', explode(',', $request->tags));
        }

        if ($request->status === 'published') {
            $post->published_at = now();
        }

        // Upload featured image
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog/images', 'public');
            $post->featured_image = $path;
        }

        // Upload author avatar
        if ($request->hasFile('author_avatar')) {
            $path = $request->file('author_avatar')->store('blog/avatars', 'public');
            $post->author_avatar = $path;
        }

        $post->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post berhasil dibuat!');
    }

    public function edit(BlogPost $blog)
    {
        $categories = [
            'Tips & Edukasi',
            'Kampanye',
            'Berita',
            'Lingkungan',
            'Komunitas',
            'Teknologi',
            'Inspirasi'
        ];

        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required|max:500',
            'content' => 'required',
            'category' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'author_name' => 'required',
            'author_avatar' => 'nullable|image|max:1024',
            'tags' => 'nullable|string',
            'reading_time' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean'
        ]);

        $blog->title = $request->title;
        
        // Generate new slug if title changed
        if ($blog->isDirty('title')) {
            $blog->slug = Str::slug($request->title) . '-' . Str::random(6);
        }
        
        $blog->excerpt = $request->excerpt;
        $blog->content = $request->content;
        $blog->category = $request->category;
        $blog->author_name = $request->author_name;
        $blog->reading_time = $request->reading_time ?? ceil(str_word_count(strip_tags($request->content)) / 200);
        $blog->status = $request->status;
        $blog->is_featured = $request->has('is_featured');

        if ($request->has('tags')) {
            $blog->tags = array_map('trim', explode(',', $request->tags));
        }

        // Set published_at if status changed to published
        if ($blog->isDirty('status') && $request->status === 'published' && !$blog->published_at) {
            $blog->published_at = now();
        }

        // Update featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            
            $path = $request->file('featured_image')->store('blog/images', 'public');
            $blog->featured_image = $path;
        }

        // Update author avatar
        if ($request->hasFile('author_avatar')) {
            // Delete old avatar
            if ($blog->author_avatar) {
                Storage::disk('public')->delete($blog->author_avatar);
            }
            
            $path = $request->file('author_avatar')->store('blog/avatars', 'public');
            $blog->author_avatar = $path;
        }

        $blog->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post berhasil diperbarui!');
    }

    public function destroy(BlogPost $blog)
    {
        // Delete images
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        if ($blog->author_avatar) {
            Storage::disk('public')->delete($blog->author_avatar);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post berhasil dihapus!');
    }

    public function toggleFeatured(BlogPost $blog)
    {
        $blog->is_featured = !$blog->is_featured;
        $blog->save();

        $message = $blog->is_featured ? 'ditambahkan ke featured' : 'dihapus dari featured';
        
        return back()->with('success', "Post berhasil $message!");
    }
}