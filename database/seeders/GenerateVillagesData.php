<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerateVillagesData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "\nGenerating villages data from existing kecamatans...\n";
        
        // Get a sample of kecamatans
        $kecamatans = DB::table('kecamatans')->limit(50)->get();
        
        $villages = [];
        $villageId = 1;
        
        foreach ($kecamatans as $kecamatan) {
            // Create 3 villages per kecamatan (total 150 villages as sample)
            for ($i = 1; $i <= 3; $i++) {
                $villages[] = [
                    'id' => $villageId,
                    'kecamatan_id' => $kecamatan->id,
                    'name' => 'Kelurahan ' . $villageId,
                ];
                $villageId++;
            }
        }
        
        // Save to JSON file
        $json = json_encode($villages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(database_path('json/villages.json'), $json);
        
        echo "Generated " . count($villages) . " villages\n";
        echo "Saved to: database/json/villages.json\n\n";
    }
}
