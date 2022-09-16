<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;

    protected $fillable=['id','name'];



    public function vehicle()
{

    return $this->belongsToMany(Vehicle::class);
}


public function fuelrequest()
{

    return $this->belongsToMany(fuelrequest::class);
}



public function user()
{

    return $this->belongsToMany(User::class);
}

}
