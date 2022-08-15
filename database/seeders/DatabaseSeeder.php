<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        \App\Models\User::factory(10)->create();
       // \App\Models\Vehicle::factory(10)->create();
      $this->call(VehicleSeeder::class);
           \App\Models\Vehicle::factory(10)->create();



    }
}
