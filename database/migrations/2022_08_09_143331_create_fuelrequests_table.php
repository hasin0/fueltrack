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
            //  $table->unsignedBigInteger('vehicles_id')->index();  	present_km
              $table->integer('present_km')->nullable();
              $table->integer('ltr_collected')->nullable();
              $table->integer('previous_km')->nullable();
              $table->integer('amount')->nullable();
              $table->integer('km_covered')->nullable();//->nullable()->change();

              $table->integer('AVG_KM/LTR')->nullable();
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
