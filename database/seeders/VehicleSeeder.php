<?php

namespace Database\Seeders;

use App\Models\department;
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

       // $department = department::all()->pluck('id')->toArray();
        // foreach(DB::table('departments')->get() as $department) { DB::table('vehicles')->insert(['department_id' => $department->id]); }

        DB::table('vehicles')->insert([
            //admin

            [
                'name'=>'toyota',
                'model'=>'coroller',
                'plate_no'=>'wesd34',
                'tag_no'=>'34',
                'fueltank'=>'45',
                'status'=>'active',
                'department_id' =>department::all()//->id




            ],


            //driver

            [
                'name'=>'Benz',
                'model'=>'Gwagon',
                'plate_no'=>'sdwe23',
                'tag_no'=>'12',
                'fueltank'=>'56',
                'status'=>'active',
                'department_id' =>department::all()//->id

            ],

            //HOD


            [
                'name'=>'toyota',
                'model'=>'mazda',
                'plate_no'=>'ers34',
                'tag_no'=>'90',
                'fueltank'=>'78',
                'status'=>'active',
               // 'department_id'=>'3',
               'department_id' =>department::all()

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
