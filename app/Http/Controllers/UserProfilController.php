<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost; // gunakan BlogPost (sesuai view)
use App\Models\Donation; // ...added

class UserProfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Daftar post user (untuk tabel/pagination)
        $userPostsPaginated = BlogPost::where('user_id', $user->id)->latest()->paginate(10);

        // Koleksi semua post user (ringkasan/statistik)
        $userPosts = BlogPost::where('user_id', $user->id)->latest()->get();

        // Total views (hanya hitungan pada post yang published)
        $totalViews = BlogPost::where('user_id', $user->id)
            ->where('status', 'published')
            ->sum('view_count');

        // Count published posts
        $publishedPosts = BlogPost::where('user_id', $user->id)
            ->where('status', 'published')
            ->count();

        // Recent activities: gabungkan created & updated events (mirip dengan view)
        $createdEvents = BlogPost::where('user_id', $user->id)
            ->select('title', 'created_at')
            ->orderByDesc('created_at')
            ->take(8)
            ->get()
            ->map(function($p){
                return (object)[
                    'description' => 'Membuat posting: '.($p->title ?? '—'),
                    'created_at' => $p->created_at,
                ];
            });

        $updatedEvents = BlogPost::where('user_id', $user->id)
            ->select('title', 'updated_at')
            ->whereColumn('updated_at', '!=', 'created_at')
            ->orderByDesc('updated_at')
            ->take(8)
            ->get()
            ->map(function($p){
                return (object)[
                    'description' => 'Memperbarui posting: '.($p->title ?? '—'),
                    'created_at' => $p->updated_at,
                ];
            });

        $recentActivities = $createdEvents->concat($updatedEvents)
            ->sortByDesc('created_at')
            ->values()
            ->take(8);

        // Popular posts (published)
        $popularUserPosts = BlogPost::where('user_id', $user->id)
            ->where('status', 'published')
            ->orderByDesc('view_count')
            ->take(5)
            ->get();

        // --- New: donation data for profile ---
        $donations = Donation::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        $donationsTotal = Donation::where('user_id', $user->id)->sum('amount');

        return view('profil-user', [
            'userPosts' => $userPosts,
            'userPostsPaginated' => $userPostsPaginated,
            'totalViews' => $totalViews,
            'publishedPosts' => $publishedPosts,
            'recentActivities' => $recentActivities,
            'popularUserPosts' => $popularUserPosts,
            // new variables:
            'donations' => $donations,
            'donationsTotal' => $donationsTotal,
        ]);
    }
}