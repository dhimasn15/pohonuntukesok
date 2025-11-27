<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Get user's posts
        $userPosts = $user->posts;
        
        // Calculate total views
        $totalViews = $userPosts->sum('views');
        
        // Count published posts
        $publishedPosts = $userPosts->where('status', 'published')->count();
        
        // Get recent activities (latest posts)
        $recentActivities = $user->posts()
            ->latest()
            ->take(5)
            ->get();
        
        // Get popular posts (most viewed)
        $popularUserPosts = $user->posts()
            ->orderBy('views', 'desc')
            ->take(5) // ambil 5 postingan paling populer
            ->get();
        
        return view('profil-user', [
            'userPosts' => $userPosts,
            'totalViews' => $totalViews,
            'publishedPosts' => $publishedPosts,
            'recentActivities' => $recentActivities,
            'popularUserPosts' => $popularUserPosts, 
         ]);
    }
}