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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('slug')->nullable();
            $table->text('product_image')->nullable();
            $table->integer('rating')->nullable();
            $table->text('review')->nullable();
            $table->string('brand')->nullable();
            $table->text('purchase_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
