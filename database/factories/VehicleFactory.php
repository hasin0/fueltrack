<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Vehicle::class;





    public function definition()
    {
        return [

            // 'name'=>'toyota',
            //     'model'=>'coroller',
            //     'plate_no'=>'wesd34',
            //     'tag_no'=>'34',
            //     'fueltank'=>'45',
            //     'status'=>'active',
            //     'department'=>'ICT
            // //

            'name' => $this->faker->randomElement(['toyota','benz','BMW']),
            'model' => $this->faker->randomElement(['corola','Gwagon','Xseries']),

     'plate_no' => $this->faker->unique()->e164PhoneNumber(),

     'fueltank' => $this->faker->numberBetween(10,100),

     //'email_verified_at' => now(),
     //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
     //'remember_token' => Str::random(10),
     //'phone'=>$this->faker->phoneNumber,
     'tag_no'=>$this->faker->unique()->numberBetween(1000,2000),

     //'photo'=>$this->faker->imageUrl('60','60'),
     //'role'=>$this->faker->randomElement(),
     'status'=>$this->faker->randomElement(['active','inactive']),
     'department' => $this->faker->randomElement(['IT','ADMIN','HR','HSE','GED','MECHANICAL','ELECTRICAL']),

        ];
    }
}

// return [
//     'name' => $this->faker->name(),
//     'email' => $this->faker->unique()->safeEmail(),
//     'email_verified_at' => now(),
//     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//     'remember_token' => Str::random(10),
//     'phone'=>$this->faker->phoneNumber,
//     'sap'=>$this->faker->unique()->numberBetween(1000,2000),

//     'photo'=>$this->faker->imageUrl('60','60'),
//     'role'=>$this->faker->randomElement(['Admin','HOD','Driver']),
//     'status'=>$this->faker->randomElement(['active','inactive']),
//     'department' => $this->faker->randomElement(),

// ];
