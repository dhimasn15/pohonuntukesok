<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Get campaign detail with current donation data
     */
    public function show($id)
    {
        try {
            $campaign = Campaign::findOrFail($id);
            
            // Get total donations
            $totalDonations = DB::table('donations')
                ->where('campaign_id', $id)
                ->where('status', 'completed')
                ->sum('amount');
            
            // Calculate progress
            $fundingGoal = $campaign->target_trees * $campaign->tree_price;
            $progressPercentage = $fundingGoal > 0 ? min(100, round(($totalDonations / $fundingGoal) * 100, 2)) : 0;
            
            // Calculate current trees
            $currentTrees = $campaign->tree_price > 0 ? floor($totalDonations / $campaign->tree_price) : 0;
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $campaign->id,
                    'title' => $campaign->title,
                    'target_trees' => $campaign->target_trees,
                    'tree_price' => $campaign->tree_price,
                    'current_trees' => $currentTrees,
                    'total_donations' => $totalDonations,
                    'funding_goal' => $fundingGoal,
                    'progress_percentage' => $progressPercentage,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Campaign not found'
            ], 404);
        }
    }

    /**
     * Get donations for a campaign with pagination
     */
    public function getDonations($campaignId, Request $request)
    {
        try {
            $offset = $request->query('offset', 0);
            $limit = $request->query('limit', 10);

            $donations = DB::table('donations')
                ->where('campaign_id', $campaignId)
                ->where('status', 'completed')
                ->join('users', 'donations.user_id', '=', 'users.id')
                ->select(
                    'donations.id',
                    'donations.amount',
                    'donations.created_at',
                    'donations.message',
                    'users.id as user_id',
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.avatar as user_avatar'
                )
                ->orderBy('donations.created_at', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();

            return response()->json([
                'status' => 'success',
                'donations' => $donations,
                'count' => $donations->count(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get recent donations (untuk highlight section)
     */
    public function getRecentDonations($campaignId, Request $request)
    {
        try {
            $limit = $request->query('limit', 5);

            $recentDonations = DB::table('donations')
                ->where('campaign_id', $campaignId)
                ->where('status', 'completed')
                ->join('users', 'donations.user_id', '=', 'users.id')
                ->select(
                    'donations.id',
                    'donations.amount',
                    'donations.created_at',
                    'users.name as user_name',
                    'users.avatar as user_avatar'
                )
                ->orderBy('donations.created_at', 'desc')
                ->limit($limit)
                ->get();

            return response()->json([
                'status' => 'success',
                'donations' => $recentDonations,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get donation statistics
     */
    public function getDonationStats($campaignId)
    {
        try {
            $campaign = Campaign::findOrFail($campaignId);

            $totalDonations = DB::table('donations')
                ->where('campaign_id', $campaignId)
                ->where('status', 'completed')
                ->sum('amount');

            $totalDonors = DB::table('donations')
                ->where('campaign_id', $campaignId)
                ->where('status', 'completed')
                ->distinct('user_id')
                ->count('user_id');

            $averageDonation = $totalDonors > 0 
                ? floor($totalDonations / $totalDonors)
                : 0;

            $fundingGoal = $campaign->target_trees * $campaign->tree_price;
            $progressPercentage = $fundingGoal > 0 
                ? min(100, round(($totalDonations / $fundingGoal) * 100, 2))
                : 0;

            return response()->json([
                'status' => 'success',
                'stats' => [
                    'total_donations' => $totalDonations,
                    'total_donors' => $totalDonors,
                    'average_donation' => $averageDonation,
                    'progress_percentage' => $progressPercentage,
                    'funding_goal' => $fundingGoal,
                    'trees_collected' => $campaign->tree_price > 0 
                        ? floor($totalDonations / $campaign->tree_price)
                        : 0,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
