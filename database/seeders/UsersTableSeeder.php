<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //admin

            [
                'name'=>'hassan',
                'phone'=>'081223322',
                'photo'=>'photo',

                'email'=>'Admin@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'Admin',
                'status'=>'active',
                'department'=>'admin',

            ],


            //driver

            [
                'name'=>'hassan driver',
                'phone'=>'08122332213',
                'photo'=>'photo',

                'email'=>'driver@gmail.com',
                'password'=>Hash::make('2222'),
                'role'=>'Driver',
                'status'=>'active',
                'department'=>'Driver',

            ],

            //HOD


            [
                'name'=>'HOD hassan',
                'phone'=>'081223322123',
                'photo'=>'photo',

                'email'=>'Hod@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'HOD',
                'status'=>'active',
                'department'=>'IT',

            ]
            ]);

        //
    }


}
