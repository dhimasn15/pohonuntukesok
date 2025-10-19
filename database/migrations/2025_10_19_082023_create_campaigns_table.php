<?php
// database/migrations/2024_01_01_000000_create_campaigns_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->string('location');
            $table->string('tree_type');
            $table->integer('target_trees');
            $table->decimal('tree_price', 15, 2);
            $table->integer('campaign_duration');
            $table->date('planting_date');
            $table->string('planting_method');
            $table->text('benefits')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('pending');
            $table->integer('current_trees')->default(0);
            $table->integer('total_donors')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};