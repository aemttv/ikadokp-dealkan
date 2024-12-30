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
        Schema::create('primary_listing', function (Blueprint $table) {
            $table->id('primaryID')->primary();
            $table->integer('agentID');
            $table->string('title');
            $table->string('link_drive');
            $table->string('deskripsi');
            $table->text('image_main');
            $table->text('image_second')->nullable();
            $table->text('image_third')->nullable();
            $table->integer('statusListing')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_listing');
    }
};
