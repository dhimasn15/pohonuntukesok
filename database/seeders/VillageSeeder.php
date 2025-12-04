<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "\n Loading data kelurahan...\n";
        
        // Check if villages.json exists in database/json directory
        $villageJsonPath = database_path('json/villages.json');
        
        if (file_exists($villageJsonPath)) {
            $villages = json_decode(File::get($villageJsonPath), true);
            
            if (!empty($villages)) {
                // Clear existing data
                DB::table('villages')->truncate();
                
                // Insert in chunks untuk performa lebih baik
                $chunks = array_chunk($villages, 500);
                $totalInserted = 0;
                
                foreach ($chunks as $chunk) {
                    DB::table('villages')->insert($chunk);
                    $totalInserted += count($chunk);
                }
                
                echo " Success.... Villages ({$totalInserted})\n\n";
            } else {
                echo " Warning: villages.json is empty\n\n";
            }
        } else {
            echo " Info: Silakan download data kelurahan dari sumber berikut:\n";
            echo " - https://davidaprilio.github.io/api-daerah-indonesia/\n";
            echo " - atau gunakan API Public yang menyediakan data kelurahan Indonesia\n";
            echo " - File harus diletakkan di: database/json/villages.json\n";
            echo " - Format JSON harus: [{\"id\": 1, \"kecamatan_id\": 1, \"name\": \"Kelurahan Name\"}, ...]\n\n";
        }
    }
}
