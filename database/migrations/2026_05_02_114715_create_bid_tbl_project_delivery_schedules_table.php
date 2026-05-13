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
        Schema::create('bid_tbl_project_delivery_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('bid_tbl_projects')->cascadeOnDelete();
            $table->string('description');
            $table->string('schedule');
            $table->double('amount')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->tinyInteger(1)->default();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_project_delivery_schedules');
    }
};
