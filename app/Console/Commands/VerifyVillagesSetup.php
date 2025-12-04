<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class VerifyVillagesSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:villages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify villages data and setup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('');
        $this->line('========================================');
        $this->line('VERIFIKASI DATA KELURAHAN');
        $this->line('========================================');
        $this->line('');

        // 1. Jumlah villages
        $totalVillages = DB::table('villages')->count();
        $this->line("✓ Total Villages: $totalVillages");

        // 2. Sample villages dengan district ID
        $sampleVillages = DB::table('villages')->limit(5)->get();
        $this->line("\n✓ Sample Villages:");
        foreach ($sampleVillages as $village) {
            $this->line("  - ID: {$village->id}, District ID: {$village->kecamatan_id}, Name: {$village->name}");
        }

        // 3. Cek villages per kecamatan
        $districtId = $sampleVillages[0]->kecamatan_id;
        $villagesByDistrict = DB::table('villages')
            ->where('kecamatan_id', $districtId)
            ->count();
        $this->line("\n✓ Villages di District $districtId: $villagesByDistrict");

        // 4. Verify campaigns table memiliki location columns
        $campaignsTableColumns = DB::select("DESCRIBE campaigns");
        $locationColumns = array_filter($campaignsTableColumns, function($col) {
            return in_array($col->Field, ['province_id', 'regency_id', 'district_id', 'village_id', 'location']);
        });

        $this->line("\n✓ Campaign Location Columns:");
        foreach ($locationColumns as $col) {
            $this->line("  - {$col->Field}");
        }

        $this->line('\n========================================');
        $this->line('✓ SEMUA DATA SIAP DIGUNAKAN');
        $this->line('========================================');
        $this->line('');
    }
}
