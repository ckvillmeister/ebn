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
        Schema::create('bid_tbl_project_te_requirement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                ->constrained('bid_tbl_projects')
                ->cascadeOnDelete();

            $table->foreignId('tool_equipment_id')
                ->constrained('bid_tbl_tools_and_equipments')
                ->cascadeOnDelete();

            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
