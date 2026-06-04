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
        Schema::create('bid_tbl_all_ongoing_projects', function (Blueprint $table) {

            $table->id();
            // $table->foreignId('project_id')
            //     ->constrained('bid_tbl_projects')
            //     ->cascadeOnDelete();
            $table->string('name_of_contract');
            $table->double('project_cost', 15, 2)->default(0);
            $table->enum('project_type', ['Government', 'Private']);
            $table->string('owner_name');
            $table->string('address');
            $table->string('telephone_no')->nullable();
            $table->string('nature_of_work')->nullable();
            $table->string('bidder_role_description')->nullable();
            $table->string('bidder_role_percentage')->nullable();
            $table->date('date_awarded')->nullable();
            $table->date('date_started')->nullable();
            $table->date('date_of_completion')->nullable();
            $table->string('planned_percentage')->nullable();
            $table->string('actual_percentage')->nullable();
            $table->string('outstanding_works')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_all_ongoing_projects');
    }
};
