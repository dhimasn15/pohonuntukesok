<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationApiController extends Controller
{
    /**
     * Get all provinces
     */
    public function getProvinces()
    {
        try {
            $provinces = DB::table('provinsis')
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get()
                ->toArray();
            
            return response()->json($provinces);
        } catch (\Exception $e) {
            \Log::error('Error fetching provinces: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    /**
     * Get regencies by province ID
     */
    public function getRegencies($provinceId)
    {
        try {
            $regencies = DB::table('kabupatens')
                ->where('provinsi_id', $provinceId)
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get()
                ->toArray();
            
            return response()->json($regencies);
        } catch (\Exception $e) {
            \Log::error('Error fetching regencies: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    /**
     * Get districts by regency ID
     */
    public function getDistricts($regencyId)
    {
        try {
            $districts = DB::table('kecamatans')
                ->where('kabupaten_id', $regencyId)
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get()
                ->toArray();
            
            return response()->json($districts);
        } catch (\Exception $e) {
            \Log::error('Error fetching districts: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    /**
     * Get villages by district ID
     */
    public function getVillages(Request $request)
    {
        $districtId = $request->query('district_id');
        
        if (!$districtId) {
            return response()->json([], 400);
        }
        
        try {
            $villages = DB::table('villages')
                ->where('kecamatan_id', $districtId)
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get()
                ->toArray();
            
            return response()->json($villages);
        } catch (\Exception $e) {
            \Log::error('Error fetching villages: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }
}
