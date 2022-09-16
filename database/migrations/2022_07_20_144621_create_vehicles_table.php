<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('plate_no')->unique();
            $table->string('tag_no')->unique();
            //  $table->string('department');
            // $table->unsignedBigInteger('department_id')->index();



            $table->integer('fueltank');
          //  $table->unsignedBigInteger('user_id');
            $table->enum('status',['active','inactive'])->default('inactive');

            $table->timestamps();
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('CASCADE')->onUpdate('CASCADE');;

           // $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
