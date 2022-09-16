<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\department;
use Illuminate\Support\Facades\DB;



class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $departments=[


            'Admin',
            'IT',
            'HR',
            'HSE',
            'Batching plant',
            'Legal',
            'Logistic',
            'Security',
            'GED',
            'Mechanical',
            'Process',
            'Electrical',
            'Marine',
            'Chemical',
            'Warehouse',
            'Marketing',
            'Clinc',


         ];//);
         foreach ($departments as $departments) {
            department::create(['name' => $departments]);
       }


    }
}
