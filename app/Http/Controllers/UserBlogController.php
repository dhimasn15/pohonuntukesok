<?php
// app/Http/Controllers/UserBlogController.php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserBlogController extends Controller
{
    /**
     * Display user's blog posts
     */
    public function index(Request $request)
    {
        $posts = BlogPost::where('user_id', auth()->id())
                        ->latest()
                        ->paginate(10);

        return view('blog.my-posts', compact('posts'));
    }

    /**
     * Show the form for creating a new blog post
     */
     public function create()
    {
        $categories = [
            'Tips & Edukasi',
            'Kampanye',
            'Berita',
            'Lingkungan',
            'Komunitas',
            'Teknologi',
            'Inspirasi',
            'Pengalaman Pribadi'
        ];

        return view('blog.user.create', compact('categories')); // Update path view
    }

    public function uploadImage(Request $request)
{
    if ($request->hasFile('upload')) {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        $request->file('upload')->storeAs('blog/content', $fileName, 'public');

        $url = Storage::url('blog/content/' . $fileName);
        
        return response()->json([
            'fileName' => $fileName,
            'uploaded' => 1,
            'url' => $url
        ]);
    }

    return response()->json([
        'uploaded' => 0,
        'error' => ['message' => 'Upload failed']
    ]);
}
    /**
     * Store a newly created blog post
     */
    public function store(Request $request)
    {
        $request->validate([
    'title' => 'required|max:255',
    'excerpt' => 'required|max:500',
    'content' => 'required',
    'category' => 'required',
    'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'author_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
    'author_name' => 'required|max:100',
    'tags' => 'nullable|string|max:255',
    'reading_time' => 'nullable|integer|min:1|max:60',
    'status' => 'required|in:draft,published'
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
        $post->user_id = auth()->id();

        // Jika user publish post, butuh approval admin
        if ($request->status === 'published') {
            $post->approval_status = 'pending';
            $post->published_at = now(); // Tetap set published_at, tapi status pending
        } else {
            $post->approval_status = 'pending';
        }

        if ($request->has('tags')) {
            $post->tags = array_map('trim', explode(',', $request->tags));
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

        $message = $request->status === 'published' 
            ? 'Post berhasil dibuat dan menunggu persetujuan admin!' 
            : 'Post berhasil disimpan sebagai draft!';

        return redirect()->route('user.blog.index')
            ->with('success', $message);
    }

    /**
     * Show the form for editing the specified blog post
     */
    public function edit(BlogPost $blog)
    {
        // Check if user can edit this post
        if (!$blog->canEdit(auth()->user())) {
            abort(403);
        }

        $categories = [
            'Tips & Edukasi',
            'Kampanye',
            'Berita',
            'Lingkungan',
            'Komunitas',
            'Teknologi',
            'Inspirasi',
            'Pengalaman Pribadi'
        ];

        return view('blog.user.edit', compact('blog', 'categories')); // Update path view
    }

    /**
     * Update the specified blog post
     */
    public function update(Request $request, BlogPost $blog)
    {
        // Check if user can edit this post
        if (!$blog->canEdit(auth()->user())) {
            abort(403);
        }

       $request->validate([
    'title' => 'required|max:255',
    'excerpt' => 'required|max:500',
    'content' => 'required',
    'category' => 'required',
    'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'author_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
    'author_name' => 'required|max:100',
    'tags' => 'nullable|string|max:255',
    'reading_time' => 'nullable|integer|min:1|max:60',
    'status' => 'required|in:draft,published'
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
        
        // Jika status berubah dari draft ke published, butuh approval ulang
        if ($blog->status === 'draft' && $request->status === 'published') {
            $blog->approval_status = 'pending';
            $blog->published_at = now();
        }
        
        $blog->status = $request->status;

        if ($request->has('tags')) {
            $blog->tags = array_map('trim', explode(',', $request->tags));
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

        $message = $request->status === 'published' 
            ? 'Post berhasil diperbarui dan menunggu persetujuan admin!' 
            : 'Post berhasil diperbarui!';

        return redirect()->route('user.blog.index')
            ->with('success', $message);
    }

    /**
     * Remove the specified blog post
     */
    public function destroy(BlogPost $blog)
    {
        // Check if user can delete this post
        if (!$blog->canEdit(auth()->user())) {
            abort(403);
        }

        // Delete images
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        if ($blog->author_avatar) {
            Storage::disk('public')->delete($blog->author_avatar);
        }

        $blog->delete();

        return redirect()->route('user.blog.index')
            ->with('success', 'Post berhasil dihapus!');
    }
}