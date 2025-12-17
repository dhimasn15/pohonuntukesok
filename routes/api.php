<?php

Route::post('/campaigns/progress', function (Request $request) {
    $campaignIds = $request->input('campaign_ids', []);
    
    $campaigns = Campaign::whereIn('id', $campaignIds)->get();
    
    $data = $campaigns->map(function ($campaign) {
        $totalDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'completed')
            ->sum('amount');
        
        $treePrice = $campaign->tree_price ?? 100000;
        $fundingGoal = $campaign->target_trees * $treePrice;
        $progressPercentage = $fundingGoal > 0 ? min(100, round(($totalDonations / $fundingGoal) * 100, 2)) : 0;
        $currentTrees = $treePrice > 0 ? floor($totalDonations / $treePrice) : 0;
        
        $totalDonors = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'completed')
            ->distinct('user_id')
            ->count('user_id');
        
        return [
            'id' => $campaign->id,
            'progress_percentage' => $progressPercentage,
            'current_amount' => $totalDonations,
            'formatted_amount' => 'Rp ' . number_format($totalDonations, 0, ',', '.'),
            'formatted_goal' => 'Rp ' . number_format($fundingGoal, 0, ',', '.'),
            'current_trees' => $currentTrees,
            'current_trees_formatted' => number_format($currentTrees),
            'target_trees' => $campaign->target_trees,
            'total_donors' => $totalDonors,
            'total_donors_formatted' => number_format($totalDonors)
        ];
    });
    
    return response()->json($data);
});

Route::get('/campaigns/{id}/progress', function ($id) {
    $campaign = Campaign::findOrFail($id);
    
    $totalDonations = Donation::where('campaign_id', $campaign->id)
        ->where('status', 'completed')
        ->sum('amount');
    
    $treePrice = $campaign->tree_price ?? 100000;
    $fundingGoal = $campaign->target_trees * $treePrice;
    $progressPercentage = $fundingGoal > 0 ? min(100, round(($totalDonations / $fundingGoal) * 100, 2)) : 0;
    $currentTrees = $treePrice > 0 ? floor($totalDonations / $treePrice) : 0;
    
    $totalDonors = Donation::where('campaign_id', $campaign->id)
        ->where('status', 'completed')
        ->distinct('user_id')
        ->count('user_id');
    
    return response()->json([
        'id' => $campaign->id,
        'progress_percentage' => $progressPercentage,
        'formatted_amount' => 'Rp ' . number_format($totalDonations, 0, ',', '.'),
        'formatted_goal' => 'Rp ' . number_format($fundingGoal, 0, ',', '.'),
        'current_trees_formatted' => number_format($currentTrees),
        'total_donors_formatted' => number_format($totalDonors)
    ]);
});