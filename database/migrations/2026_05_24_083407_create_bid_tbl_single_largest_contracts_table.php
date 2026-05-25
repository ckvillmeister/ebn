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
        Schema::create('bid_tbl_single_largest_contracts', function (Blueprint $table) {

            $table->id();
            $table->foreignId('project_id')
                ->constrained('bid_tbl_projects')
                ->cascadeOnDelete();
            $table->string('name_of_contract');
            $table->double('project_cost', 15, 2)->default(0);
            $table->enum('project_type', ['Government', 'Private']);
            $table->string('owner_name');
            $table->string('address');
            $table->string('telephone_no')->nullable();
            $table->string('nature_of_work')->nullable();
            $table->string('bidder_role_description')->nullable();
            $table->string('bidder_role_percentage')->nullable();
            $table->double('amount_of_award', 15, 2)->default(0);
            $table->double('amount_of_completion', 15, 2)->default(0);
            $table->string('duration')->nullable();
            $table->date('date_awarded')->nullable();
            $table->date('contract_effectivity')->nullable();
            $table->date('date_completed')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_single_largest_contracts');
    }
};
