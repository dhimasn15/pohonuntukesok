<?php
// app/Http/Controllers/CampaignController.php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('user')
            ->latest()
            ->paginate(12);

        return view('kampanye', compact('campaigns'));
    }

    public function create()
    {
        return view('buat');
    }

    public function store(Request $request)
    {
        // Debug: log semua data yang diterima
        Log::info('Form data received:', $request->all());
        Log::info('Files received:', $request->files->all());

        // Validasi
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string|max:255',
            'tree_type' => 'required|string|max:255',
            'target_trees' => 'required|integer|min:10',
            'tree_price' => 'required|numeric|min:5000',
            'campaign_duration' => 'required|integer|min:7|max:365',
            'planting_date' => 'required|date',
            'planting_method' => 'required|string',
            'benefits' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);
        
        try {
            DB::beginTransaction();
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('campaigns', 'public');
            } else {
                $imagePath = null;
            }

            // Create campaign
            $campaign = Campaign::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'location' => $validated['location'],
                'tree_type' => $validated['tree_type'],
                'target_trees' => $validated['target_trees'],
                'tree_price' => $validated['tree_price'],
                'campaign_duration' => $validated['campaign_duration'],
                'planting_date' => $validated['planting_date'],
                'planting_method' => $validated['planting_method'],
                'benefits' => $validated['benefits'],
                'image' => $imagePath,
                'status' => 'active',
                'current_trees' => 0,
                'total_donors' => 0,
                'user_id' => Auth::id()
            ]);

            DB::commit();

            return redirect()->route('kampanye')
                ->with('success', 'Kampanye berhasil dibuat! Terima kasih atas kontribusi Anda untuk lingkungan.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating campaign: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat membuat kampanye. Silakan coba lagi.']);
        }

        Log::info('Validation passed:', $validated);

        DB::beginTransaction();
        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('campaigns', 'public');
                $validated['image'] = $imagePath;
                Log::info('Image uploaded to:', [$imagePath]);
            }

            // Tambahkan field default
            $validated['user_id'] = Auth::id();
            $validated['status'] = 'active';
            $validated['current_trees'] = 0;
            $validated['total_donors'] = 0;

            Log::info('Final data to save:', $validated);

            // Create campaign
            $campaign = Campaign::create($validated);
            
            Log::info('Campaign created with ID:', [$campaign->id]);

            DB::commit();
            
            return redirect()->route('kampanye')
                ->with('success', 'Kampanye berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating campaign: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat kampanye: ' . $e->getMessage());
        }
    }

    public function show(Campaign $campaign)
    {
        return view('kampanye-detail', compact('campaign'));
    }
}