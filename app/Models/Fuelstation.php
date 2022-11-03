<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuelstation extends Model
{
    use HasFactory;


    #
    protected $fillable=['name','user_id'];



public function fuelrequest()
{

    return $this->hasMany(fuelrequest::class,'fuelstation_id');
}


public function user()
{

    return $this->belongsTo(User::class);
}



}
