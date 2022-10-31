<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\fuelrequest;
use App\Models\department;

use Spatie\Permission\Traits\HasRoles;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles;

    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'sap',

        'photo',
      //  'role',
        'status',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }



    public function fuelrequests()
  {

  //  return $this->belongsTo(User::class);

      return $this->hasMany(fuelrequest::class);


    //return $this->hasOne(User::class);


  }

  public function department()
  {
    return $this->belongsTo(department::class);
  }



  public function fuelstation()
  {
    return $this->belongsTo(Fuelstation::class);
  }





  public function roles()
  {
      return $this->belongsToMany(Role::class);
  }


}
