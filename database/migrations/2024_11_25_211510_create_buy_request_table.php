<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */ public function up()
    {
        Schema::create('buy_requests', function (Blueprint $table) {
            $table->increments('requestID'); // Incremental primary key
            $table->string('buyerName'); // Not null
            $table->unsignedInteger('listingID')->nullable()->default(0); // Not null
            $table->unsignedInteger('agentID'); // Not null
            $table->unsignedInteger('transaksiID'); // Not null
            $table->unsignedInteger('listingType')->nullable(); // Can be null
            $table->unsignedInteger('lokasiID')->nullable(); // Can be null
            $table->bigInteger('hargaJualMin')->nullable(); // Can be null
            $table->bigInteger('hargaJualMax')->nullable(); // Can be null
            $table->unsignedInteger('luasTanahMin')->nullable(); // Can be null
            $table->unsignedInteger('luasTanahMax')->nullable(); // Can be null
            $table->unsignedInteger('luasBangunanMin')->nullable(); // Can be null
            $table->unsignedInteger('luasBangunanMax')->nullable(); // Can be null
            $table->unsignedInteger('kamar_tidur')->nullable(); // Can be null
            $table->unsignedInteger('kamar_mandi')->nullable(); // Can be null
            $table->integer('isActive')->default(1);
            $table->integer('isMatched')->default(0);
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_request');
    }
};
