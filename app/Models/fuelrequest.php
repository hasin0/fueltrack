<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class fuelrequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable=['present_km','last_fuel_qty','last_km',
    'last_km_when_fueling','km_used',
     'user_id','liters_km',
     'HOD_approval',
     'Admin_approval',
     'order_number','
     Fuel_station_approval',
     'Fuel_station'];


     public function vehicles(){


        return $this->belongsToMany(Vehicle::class,'fuelrequest_vehicles','fuelrequest_id','vehicle_id');
        //'vehicles','requestfuel','driver_id'
    }



    public function users(){


        return $this->hasMany(User::class,'user_id');
       // return $this->belongsToMany(drivers::class,'drivers','requestfuel','vehicle_id');

    }

}









// $table->id();
//             $table->timestamps();
//             $table->unsignedBigInteger('user_id')->index();
//             //  $table->unsignedBigInteger('vehicles_id')->index();
//               $table->integer('present_km');
//               $table->integer('last_fuel_qty');
//               $table->integer('last_km');
//               $table->integer('last_km_when_fueling');
//               $table->integer('km_used');//->nullable()->change();

//               $table->integer('liters_km');
//               $table->enum('HOD_approval',['active','inactive'])->default('inactive');
//               $table->enum('Admin_approval',['active','inactive'])->default('inactive');
//               $table->string('order_number')->unique();

//               $table->enum('Fuel_station_approval',['issued','Notissued'])->default('Notissued');

//               $table->string('Fuel_station')->unique();
