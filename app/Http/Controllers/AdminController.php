<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Farmer;
use App\Models\Campaign;
use App\Models\FarmerPlant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_farmers' => Farmer::count(),
            'pending_farmers' => Farmer::where('status', 'pending')->count(),
            'approved_farmers' => Farmer::where('status', 'approved')->count(),
            'total_campaigns' => Campaign::count(),
            'active_campaigns' => Campaign::where('status', 'active')->count(),
            'total_plants' => FarmerPlant::sum('stok'),
        ];

        // Data untuk charts
        $farmersByStatus = Farmer::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $campaignsByStatus = Campaign::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $recentFarmers = Farmer::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentCampaigns = Campaign::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats', 
            'farmersByStatus', 
            'campaignsByStatus',
            'recentFarmers',
            'recentCampaigns'
        ));
    }

    // Kelola Petani
    public function manageFarmers()
    {
        $pendingFarmers = Farmer::where('status', 'pending')
            ->with('user')
            ->get();
            
        $approvedFarmers = Farmer::where('status', 'approved')
            ->with('user')
            ->get();
            
        $rejectedFarmers = Farmer::where('status', 'rejected')
            ->with('user')
            ->get();

        return view('admin.petani', compact(
            'pendingFarmers', 
            'approvedFarmers', 
            'rejectedFarmers'
        ));
    }

    // Setujui Petani
    public function approveFarmer($id)
    {
        $farmer = Farmer::findOrFail($id);
        
        $farmer->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Petani berhasil disetujui!');
    }

    // Tolak Petani
    public function rejectFarmer(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|min:10',
        ]);

        $farmer = Farmer::findOrFail($id);
        
        $farmer->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Petani berhasil ditolak!');
    }

    // Kelola User
    public function manageUsers()
    {
        $users = User::with('farmer')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users', compact('users'));
    }

    // Toggle Status User
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "User berhasil $status!");
    }

    // Kelola Kampanye
    public function manageCampaigns()
    {
        $campaigns = Campaign::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.kampanye', compact('campaigns'));
    }
}