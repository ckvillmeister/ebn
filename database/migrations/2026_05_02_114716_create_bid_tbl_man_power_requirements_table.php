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
        Schema::create('bid_tbl_man_power_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('bid_tbl_projects')->cascadeOnDelete();
            $table->foreignId('man_power_type_id')->constrained('bid_tbl_man_power_types')->cascadeOnDelete();
            $table->integer('quantity');
            $table->string('task', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_man_power_requirements');
    }
};
