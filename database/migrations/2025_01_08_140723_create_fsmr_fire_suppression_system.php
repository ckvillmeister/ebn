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
        Schema::create('fsmr_fire_suppression_system', function (Blueprint $table) {
            $table->integer('fsmr_id');
            $table->integer('checklist_id');
            $table->integer('status');
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fsmr_fire_suppression_system');
    }
};
