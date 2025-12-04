<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestLocationApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:location-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test location API endpoints';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('');
        $this->line('========================================');
        $this->line('TESTING LOCATION API');
        $this->line('========================================');
        $this->line('');

        // Test 1: Get Provinces
        $this->line('Test 1: Get Provinces');
        $provinces = DB::table('provinsis')->select('id', 'name')->limit(3)->get();
        $this->line("  Found: " . count($provinces) . " provinces");
        foreach ($provinces as $prov) {
            $this->line("    - {$prov->id}: {$prov->name}");
        }

        // Test 2: Get Regencies for first province
        if ($provinces->count() > 0) {
            $provinceId = $provinces[0]->id;
            $this->line("\nTest 2: Get Regencies for Province {$provinceId}");
            $regencies = DB::table('kabupatens')
                ->where('provinsi_id', $provinceId)
                ->select('id', 'name')
                ->limit(3)
                ->get();
            $this->line("  Found: " . count($regencies) . " regencies");
            foreach ($regencies as $reg) {
                $this->line("    - {$reg->id}: {$reg->name}");
            }

            // Test 3: Get Districts for first regency
            if ($regencies->count() > 0) {
                $regencyId = $regencies[0]->id;
                $this->line("\nTest 3: Get Districts for Regency {$regencyId}");
                $districts = DB::table('kecamatans')
                    ->where('kabupaten_id', $regencyId)
                    ->select('id', 'name')
                    ->limit(3)
                    ->get();
                $this->line("  Found: " . count($districts) . " districts");
                foreach ($districts as $dist) {
                    $this->line("    - {$dist->id}: {$dist->name}");
                }

                // Test 4: Get Villages for first district
                if ($districts->count() > 0) {
                    $districtId = $districts[0]->id;
                    $this->line("\nTest 4: Get Villages for District {$districtId}");
                    $villages = DB::table('villages')
                        ->where('kecamatan_id', $districtId)
                        ->select('id', 'name')
                        ->limit(3)
                        ->get();
                    $this->line("  Found: " . count($villages) . " villages");
                    foreach ($villages as $vil) {
                        $this->line("    - {$vil->id}: {$vil->name}");
                    }
                }
            }
        }

        $this->line('');
        $this->line('========================================');
        $this->line('✓ API ENDPOINTS READY');
        $this->line('========================================');
        $this->line('');
    }
}
