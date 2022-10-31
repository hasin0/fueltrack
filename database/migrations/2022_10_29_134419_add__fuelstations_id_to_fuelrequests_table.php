<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFuelstationsIdToFuelrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fuelrequests', function (Blueprint $table) {

            $table->unsignedBigInteger('fuelstation_id')->index();
            $table->foreign('fuelstation_id')->references('id')->on('fuelstations')->onDelete('CASCADE')->onUpdate('CASCADE');;

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fuelrequests', function (Blueprint $table) {
            //
        });
    }
}
