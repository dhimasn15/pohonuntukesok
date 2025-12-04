<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestVillagesAPI extends Command
{
    protected $signature = 'test:villages-api';
    protected $description = 'Test villages API endpoint directly';

    public function handle()
    {
        $this->info('Testing Villages API...');
        
        // Test 1: Get all villages count
        $totalCount = DB::table('villages')->count();
        $this->info("Total villages in DB: {$totalCount}");
        
        // Test 2: Get villages for specific kecamatan
        $districtId = 1101010;
        $villages = DB::table('villages')
            ->where('kecamatan_id', $districtId)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();
        
        $this->info("Villages for kecamatan {$districtId}: " . count($villages));
        foreach ($villages as $village) {
            $this->line("  - {$village->name} (ID: {$village->id})");
        }
        
        // Test 3: Test the API endpoint response format
        $this->info("\nAPI Response Format:");
        $this->line(json_encode($villages, JSON_PRETTY_PRINT));
    }
}
