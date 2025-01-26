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
        Schema::create('fsmr_info', function (Blueprint $table) {
            $table->id();
            $table->string('app_no');
            $table->string('establishment_name')->nullable();
            $table->string('establishment_address')->nullable();
            $table->string('occupancy')->nullable();
            $table->string('no_of_floors')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('processed_by')->nullable();
            $table->date('date_processed')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('building_use')->nullable();
            $table->string('service_availed')->nullable();
            $table->string('fps_manufacturer')->nullable();
            $table->string('fps_model')->nullable();
            $table->string('fps_circuit')->nullable();
            $table->string('eer_manufacturer')->nullable();
            $table->string('eer_hardware')->nullable();
            $table->string('eer_remarks')->nullable();
            $table->date('fss_inspection_date')->nullable();
            $table->string('fss_unit')->nullable();
            $table->string('fss_frequency')->nullable();
            $table->string('fss_report')->nullable();
            $table->string('fss_remarks')->nullable();
            $table->integer('technician')->nullable();
            $table->integer('inspector')->nullable();
            $table->integer('manager')->nullable();
            $table->integer('contractor')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fsmr_info');
    }
};
