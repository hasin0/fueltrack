<?php

use App\Http\Controllers\VehicleController;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('welcome');
});

//Auth::routes(['register'=>false]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//AdminDashbord
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('admin');



    //Vehicles
    Route::resource('/vehicle',\App\Http\Controllers\VehicleController::class);

    Route::post('vehicle_status',[\App\Http\Controllers\VehicleController::class,'vehicleStatus'])->name('vehicle.status');



 //users
 Route::resource('/users',\App\Http\Controllers\UserController::class);

 Route::post('user_status',[\App\Http\Controllers\UserController::class,'userStatus'])->name('user.status');




 //fuelrequest
 Route::resource('/fuelrequests',\App\Http\Controllers\FuelrequestController::class);

 Route::post('Admin_approval',[\App\Http\Controllers\FuelrequestController::class,'AdminStatus'])->name('admin.status');

 Route::post('HOD_approval',[\App\Http\Controllers\FuelrequestController::class,'HodStatus'])->name('hod.status');

 Route::post('Fuel_station_approval',[\App\Http\Controllers\FuelrequestController::class,'FSAStatus'])->name('FSA.status');



});





require __DIR__.'/auth.php';


