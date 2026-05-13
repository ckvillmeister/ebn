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
        Schema::create('bid_tbl_net_financial_contracting_capacity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('bid_tbl_projects')->cascadeOnDelete();
            $table->string('name');
            $table->year('year');
            $table->double('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_net_financial_contracting_capacities');
    }
};
