<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('vehicles')->insert([
            //admin

            [
                'name'=>'toyota',
                'model'=>'coroller',
                'plate_no'=>'wesd34',
                'tag_no'=>'34',
                'fueltank'=>'45',
                'status'=>'active',
                'department'=>'ICT',




            ],


            //driver

            [
                'name'=>'Benz',
                'model'=>'Gwagon',
                'plate_no'=>'sdwe23',
                'tag_no'=>'12',
                'fueltank'=>'56',
                'status'=>'active',
                'department'=>'ADMIN',

            ],

            //HOD


            [
                'name'=>'toyota',
                'model'=>'mazda',
                'plate_no'=>'ers34',
                'tag_no'=>'90',
                'fueltank'=>'78',
                'status'=>'active',
                'department'=>'WAREHOUSE',

            ]
         ]);

        //
    }
}

// Full texts
// id
// name
// model
// plate_no
// tag_no
// department
// fueltank
// status
