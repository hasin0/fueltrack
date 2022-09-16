<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'vehicle-list',
            'vehicle-create',
            'vehicle-edit',
            'vehicle-delete',


           'fuelrequests-list',
        //    |fuelrequests-create|fuelrequests-edit|fuelrequests-delete', ['only' => ['index','show']]);

           'fuelrequests-create',
           'fuelrequests-edit',
           'fuelrequests-delete',
           'fuelrequests-AdminStatus',
           'fuelrequests-HodStatus',
           'fuelrequests-FSAStatus',
           'vehicle-vehicleStatus',











         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
        //
    }
}
