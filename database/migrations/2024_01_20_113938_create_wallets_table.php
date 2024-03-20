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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_address_tron')->nullable();
            $table->string('wallet_address_bsc')->nullable();
            $table->string('status')->default(0);
            $table->unsignedBigInteger('plan_id');
            // key
            $table->foreign('plan_id')->references('id')->on('plan_models')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
