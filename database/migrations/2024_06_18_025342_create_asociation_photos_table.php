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
        Schema::create('asociation_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asociation_id');
            $table->foreign('asociation_id')->references('id')->on('asociaciones')->onDelete('cascade');
            $table->text('path_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asociation_photos');
    }
};
