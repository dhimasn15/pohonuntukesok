<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularCampaigns = Campaign::where('status', 'active')
            ->with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('popularCampaigns'));
    }
}