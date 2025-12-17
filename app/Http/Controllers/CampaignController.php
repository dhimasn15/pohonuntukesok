<?php
// app/Http/Controllers/CampaignController.php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('donations')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        // Tambahkan data progress ke setiap campaign
        foreach ($campaigns as $campaign) {
            $campaign->progress_data = $this->calculateCampaignProgress($campaign);
            $campaign->days_left = $this->calculateDaysLeft($campaign);
        }
        
        return view('kampanye', compact('campaigns'));
    }

    private function calculateCampaignProgress($campaign)
    {
        $totalDonations = DB::table('donations')
            ->where('campaign_id', $campaign->id)
            ->where('status', 'completed')
            ->sum('amount');
        
        $treePrice = $campaign->tree_price ?? 100000;
        $fundingGoal = $campaign->target_trees * $treePrice;
        $progressPercentage = $fundingGoal > 0 ? min(100, round(($totalDonations / $fundingGoal) * 100, 2)) : 0;
        
        return [
            'total_donations' => $totalDonations,
            'progress_percentage' => $progressPercentage,
            'funding_goal' => $fundingGoal,
            'current_trees' => $treePrice > 0 ? floor($totalDonations / $treePrice) : 0,
            'total_donors' => DB::table('donations')
                ->where('campaign_id', $campaign->id)
                ->where('status', 'completed')
                ->distinct('user_id')
                ->count('user_id')
        ];
    }
    
    private function calculateDaysLeft($campaign)
    {
        if (!$campaign->end_date) {
            return 0;
        }
        
        $endDate = \Carbon\Carbon::parse($campaign->end_date);
        $now = \Carbon\Carbon::now();
        
        return max(0, $now->diffInDays($endDate, false));
    }

    public function create()
    {
        // Fetch farmer plants dari farmer yang approved dengan stok > 0
        $farmerPlants = DB::table('farmer_plants')
            ->join('farmers', 'farmer_plants.farmer_id', '=', 'farmers.id')
            ->where('farmers.status', 'approved')
            ->where('farmer_plants.status', 'tersedia')
            ->where('farmer_plants.stok', '>', 0)
            ->select('farmer_plants.*', 'farmers.nama_lengkap')
            ->orderBy('farmer_plants.jenis_tanaman')
            ->get();

        return view('buat', compact('farmerPlants'));
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
            'province_id' => 'nullable|numeric',
            'regency_id' => 'nullable|numeric',
            'district_id' => 'nullable|numeric',
            'village_id' => 'nullable|numeric',
            'tree_type' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                $exists = DB::table('farmer_plants')
                    ->join('farmers', 'farmer_plants.farmer_id', '=', 'farmers.id')
                    ->where('farmers.status', 'approved')
                    ->where('farmer_plants.status', 'tersedia')
                    ->where('farmer_plants.jenis_tanaman', $value)
                    ->where('farmer_plants.stok', '>', 0)
                    ->exists();
                
                if (!$exists) {
                    $fail('Jenis pohon yang dipilih tidak tersedia atau stok habis. Silakan pilih jenis pohon lain.');
                }
            }],
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

            // Get farmer plant yang dipilih
            $farmerPlant = DB::table('farmer_plants')
                ->join('farmers', 'farmer_plants.farmer_id', '=', 'farmers.id')
                ->where('farmers.status', 'approved')
                ->where('farmer_plants.status', 'tersedia')
                ->where('farmer_plants.jenis_tanaman', $validated['tree_type'])
                ->where('farmer_plants.stok', '>', 0)
                ->select('farmer_plants.id', 'farmer_plants.farmer_id', 'farmer_plants.stok')
                ->first();

            // Create campaign
            $campaign = Campaign::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'location' => $validated['location'],
                'province_id' => $validated['province_id'] ?? null,
                'regency_id' => $validated['regency_id'] ?? null,
                'district_id' => $validated['district_id'] ?? null,
                'village_id' => $validated['village_id'] ?? null,
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
                'user_id' => Auth::id(),
                'farmer_plant_id' => $farmerPlant->id ?? null,
                'trees_from_farmer' => 0
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

    /**
     * Get campaign data for progress update (API)
     */
    public function getCampaignData($campaignId)
    {
        try {
            $campaign = Campaign::select([
                'id',
                'title',
                'current_trees',
                'target_trees',
                'total_donors',
                'progress_percentage'
            ])->findOrFail($campaignId);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $campaign->id,
                    'title' => $campaign->title,
                    'current_trees' => $campaign->current_trees,
                    'target_trees' => $campaign->target_trees,
                    'total_donors' => $campaign->total_donors,
                    'progress_percentage' => $campaign->progress_percentage,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Campaign tidak ditemukan',
            ], 404);
        }
    }
}