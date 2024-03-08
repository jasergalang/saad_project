<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->foreignId('property_id')->primary()->constrained('properties')->onDelete('cascade');
            $table->boolean('balcony');
            $table->boolean('gym');
            $table->boolean('pool');
            $table->boolean('parking');
            $table->boolean('security');
            $table->boolean('pets_allowed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenities');
    }
}
