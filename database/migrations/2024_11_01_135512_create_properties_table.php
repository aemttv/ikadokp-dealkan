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
        Schema::create('Listing', function (Blueprint $table) {
            $table->id('listingID')->primary();
            $table->string('title');
            $table->integer('agentID');
            $table->integer('transaksiID');
            $table->integer('ownershipID');
            $table->integer('listingType');
            $table->integer('sertifikatType');
            $table->integer('kondisiType');
            $table->integer('komisi');
            $table->string('vendorName');
            $table->string('VendorPhone');
            $table->string('alamat');
            $table->integer('lantai');
            $table->integer('lokasiID');
            $table->integer('orientasiID');;
            $table->integer('posisiID');
            $table->bigInteger('hargaJual');
            $table->integer('luasTanah');
            $table->integer('luasBangunan');
            $table->integer('dimPanjang');
            $table->integer('dimLebar');
            $table->integer('ktUtama');
            $table->integer('ktLain')->nullable()->default(0);
            $table->integer('kmUtama');
            $table->integer('kmLain')->nullable()->default(0);
            $table->integer('carport');
            $table->string('deskripsi');
            $table->integer('kondisiPerabotanID');
            $table->integer('listrikID');
            $table->text('image_main');
            $table->text('image_second')->nullable();
            $table->text('image_third')->nullable();
            $table->integer('isPrimary')->default(0);
            $table->text('link_drive')->default('-');
            $table->integer('statusListing')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Listing');
    }
};
