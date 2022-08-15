<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelrequestVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelrequest_vehicle', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('vehicle_id')->index();
            $table->unsignedBigInteger('fuelrequest_id')->index();

           // $table->unique(['fuelrequest_id','vehicle_id']);


            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('fuelrequest_id')->references('id')->on('fuelrequests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuelrequest_vehicle');
    }
}
