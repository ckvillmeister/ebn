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
        Schema::create('bid_tbl_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_reference_no', 30);
            $table->string('project_identification_no', 30);
            $table->string('project_name');
            $table->double('project_cost');
            $table->enum('project_type', ['Government', 'Private']);

            $table->string('agency_name')->nullable();
            $table->string('agency_logo_url')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_no', 20)->nullable();

            $table->string('nature_of_work', 500)->nullable();
            $table->string('bidder_role_desc', 500)->nullable();
            $table->string('bidder_role_percent', 20)->nullable();

            $table->date('date_awarded')->nullable();
            $table->date('date_started')->nullable();
            $table->date('date_of_completion')->nullable();

            $table->double('percent_accomplishment_planned')->nullable();
            $table->double('percent_accomplishment_actual')->nullable();

            $table->string('value', 500)->nullable();

            $table->date('bid_securing_declaration_date')->nullable();
            $table->date('omnibus_sworn_statement_date')->nullable();

            $table->string('fc_proponent', 200);
            $table->string('fc_warranty_calendar_days', 20)->nullable();
            $table->string('fc_product_to_be_supplied', 1000)->nullable();
            $table->string('fc_warranty')->nullable();

            $table->timestamps();

            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_projects');
    }
};
