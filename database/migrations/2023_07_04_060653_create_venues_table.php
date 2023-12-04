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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('categories')->nullable();
            $table->string('amenities')->nullable();
            $table->string('images')->nullable();
            $table->string('location')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->date('start_time')->nullable();
            $table->date('end_time')->nullable();
            $table->string('slot_booking')->nullable();
            $table->string('charge_per_slot')->nullable();
            $table->string('available_days')->nullable();
            $table->string('exclude_dates')->nullable();
            $table->string('overwrite_default')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
