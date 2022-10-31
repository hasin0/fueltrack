<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelrequests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->index();
            //  $table->unsignedBigInteger('vehicles_id')->index();
              $table->integer('present_km');
              $table->integer('last_fuel_qty');
              $table->integer('last_km');
              $table->integer('last_km_when_fueling');
              $table->integer('km_used');//->nullable()->change();

              $table->integer('liters_km');
              $table->enum('HOD_approval',['active','inactive'])->default('inactive');
              $table->enum('Admin_approval',['active','inactive'])->default('inactive');
              $table->string('order_number')->unique();

              $table->enum('Fuel_station_approval',['issued','Notissued'])->default('Notissued');

              //$table->unsignedBigInteger('user_id');

            //   $table->SoftDeletes();











             $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');


             // $table->foreign('vehicles_id')->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuelrequests');
    }

    
}
