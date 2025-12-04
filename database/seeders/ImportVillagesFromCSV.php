<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportVillagesFromCSV extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing villages
        DB::table('villages')->truncate();
        
        $csvFile = database_path('seeders/villages.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("CSV file not found: {$csvFile}");
            return;
        }
        
        $handle = fopen($csvFile, 'r');
        if (!$handle) {
            $this->command->error("Could not open CSV file");
            return;
        }
        
        $batch = [];
        $batchSize = 500; // Insert 500 records at a time
        $count = 0;
        
        $this->command->info('Importing villages from CSV...');
        
        while (($line = fgetcsv($handle)) !== false) {
            if (count($line) < 3) continue; // Skip invalid rows
            
            $villageId = trim($line[0]);
            $kecamatanId = trim($line[1]);
            $villageName = trim($line[2]);
            
            // Skip if any field is empty
            if (empty($villageId) || empty($kecamatanId) || empty($villageName)) {
                continue;
            }
            
            $batch[] = [
                'id' => $villageId,
                'kecamatan_id' => $kecamatanId,
                'name' => $villageName,
            ];
            
            $count++;
            
            // Insert batch when size reached
            if (count($batch) >= $batchSize) {
                DB::table('villages')->insert($batch);
                $this->command->info("Inserted {$count} villages...");
                $batch = [];
            }
        }
        
        // Insert remaining records
        if (!empty($batch)) {
            DB::table('villages')->insert($batch);
        }
        
        fclose($handle);
        
        $this->command->info("✓ Successfully imported {$count} villages!");
        
        // Show statistics
        $totalVillages = DB::table('villages')->count();
        $distinctDistricts = DB::table('villages')->distinct('kecamatan_id')->count('kecamatan_id');
        
        $this->command->info("Total villages in database: {$totalVillages}");
        $this->command->info("Distinct districts: {$distinctDistricts}");
    }
}
