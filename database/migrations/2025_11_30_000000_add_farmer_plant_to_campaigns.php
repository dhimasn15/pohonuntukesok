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
            // Add foreign key to farmer_plants
            $table->foreignId('farmer_plant_id')->nullable()->constrained('farmer_plants')->onDelete('set null');
            // Track how many trees from this farmer plant were used
            $table->integer('trees_from_farmer')->default(0);
        });

        // Create table to track farmer plant stock changes
        Schema::create('farmer_plant_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->constrained()->onDelete('cascade');
            $table->foreignId('farmer_plant_id')->constrained('farmer_plants')->onDelete('cascade');
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('donation_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('quantity'); // berapa pohon yang dipesan
            $table->integer('remaining_stock'); // stok tersisa setelah order
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_plant_orders');
        
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['farmer_plant_id']);
            $table->dropColumn(['farmer_plant_id', 'trees_from_farmer']);
        });
    }
};
