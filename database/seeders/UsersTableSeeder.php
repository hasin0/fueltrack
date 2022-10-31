<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     //admin

        //     [
        //         'name'=>'hassan',
        //         'phone'=>'081223322',
        //         'photo'=>'photo',
        //         'sap'=>'3445',


        //         'email'=>'Admin@gmail.com',
        //         'password'=>Hash::make('1111'),
        //         'role'=>'Admin',
        //         'status'=>'active',
        //         'department'=>'admin',

        //     ],


        //     //driver

        //     [
        //         'name'=>'hassan driver',
        //         'phone'=>'08122332213',
        //         'photo'=>'photo',
        //         'sap'=>'3634',


        //         'email'=>'driver@gmail.com',
        //         'password'=>Hash::make('2222'),
        //         'role'=>'Driver',
        //         'status'=>'active',
        //         'department'=>'Driver',

        //     ],

        //     //HOD


        //     [
        //         'name'=>'HOD hassan',
        //         'phone'=>'081223322123',
        //         'photo'=>'photo',
        //         'sap'=>'3212',


        //         'email'=>'Hod@gmail.com',
        //         'password'=>Hash::make('1111'),
        //         'role'=>'HOD',
        //         'status'=>'active',
        //         'department'=>'IT',

        //     ]
        //     ]);

        //

        $user = User::create([
            'name' => 'hassan Savani',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1111'),
              'phone'=>'081223322123',
                'photo'=>'photo',
                'sap'=>'3212',
                'status'=>'active',
                'department_id'=>1,
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->givePermissionTo($permissions);

        $user->assignRole([$role->id]);











    }


}
