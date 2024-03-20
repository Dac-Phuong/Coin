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
        Schema::create('investor_with_plants', function (Blueprint $table) {
            $table->id();
            $table->string('name_coin');
            $table->string('amount')->default(0);
            $table->string('total_amount')->default(0);
            $table->integer('type_payment')->default(0);
            $table->integer('number_days')->default(0);
            $table->integer('status')->default(0);
            $table->decimal('profit', 10, 2)->default(0); 
            $table->decimal('calculate_money', 10, 4)->default(0); 
            $table->integer('total_last_seconds')->default(0);
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedBigInteger('wallet_id');
            $table->timestamps();
            // key
            $table->foreign('plan_id')->references('id')->on('plan_models')->onDelete('cascade');
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_with_plants');
    }
};
