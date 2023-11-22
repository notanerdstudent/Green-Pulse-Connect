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
        Schema::create('business_listings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();;
            $table->string('name')->nullable();;
            $table->text('details')->nullable();;
            $table->text('slug')->nullable();;
            $table->text('location')->nullable();;
            $table->string('website')->nullable();;
            $table->string('email')->nullable();;
            $table->integer('is_offline')->nullable();;
            $table->integer('phone')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_listings');
    }
};
