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
        Schema::create('fsmr_extinguishers_equipment', function (Blueprint $table) {
            $table->id();
            $table->integer('fsmr_id');
            $table->string('item');
            $table->string('quantity');
            $table->integer('available');
            $table->integer('required');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fsmr_extinguishers_equipment');
    }
};
