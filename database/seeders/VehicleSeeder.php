<?php

namespace Database\Seeders;

use App\Models\department;
use App\Models\Vehicle;
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

       $departments = department::all();
       $departmentCount = $departments->count();
       foreach ($departments as $department) {
        for ($i = 1; $i <= 25; $i++) { // Create 25 cars for each department
            $plateNo = 'ABC' . $i . '-' . $department->id; // Append department ID as a unique identifier
            $tagNo = 'TAG' . $i;
            $fueltank = rand(50, 70); // Generate a random fuel tank value between 50 and 70

            Vehicle::create([
                'name' => 'Car ' . $i,
                'model' => 'Model ' . $i,
                'plate_no' => $plateNo,
                'tag_no' => $tagNo,
                'fueltank' => $fueltank,
                'status' => 'active',
                'department_id' => $department->id,
            ]);
        }
    }

        // foreach(DB::table('departments')->get() as $department) { DB::table('vehicles')->insert(['department_id' => $department->id]); }

        //
        // foreach ($department as $department) {
        //     for ($i = 1; $i <= 25; $i++) { // Create 10 cars for each department


        //         $plateNo = 'ABC' . $i . '-' . $department->id; // Append department ID as a unique identifier
        //         $tagNo = 'TAG' . $i;
        //         $fueltank = rand(50, 70); // Generate a random fuel tank value between 50 and 70


        //         Vehicle::create([
        //             'name' => 'Car ' . $i,
        //             'model' => 'Model ' . $i,
        //             'plate_no' => $plateNo,
        //             'tag_no' => $tagNo,
        //             'fueltank' => $fueltank,
        //             'status' => 'active',
        //             'department_id' => $department->id,
        //         ]);
        //     }
        // }
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
