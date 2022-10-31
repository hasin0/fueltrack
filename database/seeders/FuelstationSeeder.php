<?php

namespace Database\Seeders;

use App\Models\Fuelstation;
use Illuminate\Database\Seeder;

class FuelstationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $fuelstation=[


            'Petrolcam',
            'Total',
            'NNPC',
            'forte Oils',
            'AA-rano',
           

         ];//);
         foreach ($fuelstation as $fuelstations) {
            Fuelstation::create(['name' => $fuelstations]);
       }

        //
    }
}
