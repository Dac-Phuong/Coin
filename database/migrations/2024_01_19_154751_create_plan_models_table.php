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
        Schema::create('plan_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('number_date')->default(0);
            $table->decimal('discount', 10, 2)->default(0); 
            $table->timestamp('from_date')->nullable(); 
            $table->timestamp('to_date')->nullable(); 
            $table->timestamp('end_date')->nullable();
            $table->integer('package_type')->default(0);
            $table->integer('type_date')->default(0);
            $table->decimal('min_deposit', 10, 2)->default(0); 
            $table->decimal('max_deposit', 10, 2)->default(0);
            $table->tinyInteger('status')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_models');
    }
};
