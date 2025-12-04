<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            // Add location reference columns if they don't exist
            if (!Schema::hasColumn('campaigns', 'province_id')) {
                $table->unsignedBigInteger('province_id')->nullable()->after('location');
            }
            if (!Schema::hasColumn('campaigns', 'regency_id')) {
                $table->unsignedBigInteger('regency_id')->nullable()->after('province_id');
            }
            if (!Schema::hasColumn('campaigns', 'district_id')) {
                $table->unsignedBigInteger('district_id')->nullable()->after('regency_id');
            }
            if (!Schema::hasColumn('campaigns', 'village_id')) {
                $table->unsignedBigInteger('village_id')->nullable()->after('district_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['province_id', 'regency_id', 'district_id', 'village_id']);
        });
    }
};
