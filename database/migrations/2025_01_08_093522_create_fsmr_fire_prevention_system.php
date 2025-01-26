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
        Schema::create('fsmr_fire_prevention_system', function (Blueprint $table) {
            $table->integer('fsmr_id');
            $table->integer('item_id');
            $table->string('item_count')->nullable();
            $table->string('circuit')->nullable();
            $table->string('item_tested_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fsmr_fire_prevention_system');
    }
};
