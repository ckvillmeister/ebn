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
        Schema::create('bid_tbl_default_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upload_type_id')->constrained('bid_tbl_default_upload_types')->cascadeOnDelete();
            $table->string('image_url');
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bid_tbl_default_uploads');
    }
};
