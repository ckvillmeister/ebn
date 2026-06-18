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
        Schema::create('bid_tbl_document_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('bid_tbl_projects')->cascadeOnDelete();
            $table->integer('attachment_type');
            $table->enum('category', ['AOGPC', 'SLCC'])->nullable();
            $table->string('image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_document_attachments');
    }
};
