<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToFuelrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fuelrequests', function (Blueprint $table) {
            //
            $table->decimal('price', 8, 2)->nullable()->after('amount'); // Adjust precision and scale as needed

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
            $table->dropColumn('price');

        });
    }
}
