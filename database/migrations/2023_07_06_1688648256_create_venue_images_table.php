<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('venue_images', function (Blueprint $table) {
    		$table->bigIncrements('id');
    		$table->integer('venue_id');
    		$table->text('image')->nullable();
    		$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('venue_images');
    }
};