<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;


    protected $fillable=['name','model','plate_no','tag_no','fueltank', 'department_id'];
    //protected $fillable=['name','model','plate_no','tag_no','fueltank', 'user_id','department'];







    public function user()
    {
        return $this->belongsToMany(User::class);
    }


    public function fuelrequests()
    {
        return $this->belongsToMany(fuelrequest::class);//->withTimestamps();
    }



    public function department()
  {
    return $this->belongsTo(department::class);
  }





}
