<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    //  return view('welcome');
    return redirect()->route('login');

});

//Auth::routes(['register'=>false]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//AdminDashbord
Route::group(['prefix'=>'admin','middleware'=>['role:Admin','auth']],function(){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('admin');



    //Vehicles
    Route::resource('/vehicle',\App\Http\Controllers\VehicleController::class);

    Route::post('vehicle_status',[\App\Http\Controllers\VehicleController::class,'vehicleStatus'])->name('vehicle.status');



 //users
 Route::resource('/users',\App\Http\Controllers\UserController::class);

 Route::post('user_status',[\App\Http\Controllers\UserController::class,'userStatus'])->name('user.status');

//View Page

Route::get('usersreports',[\App\Http\Controllers\UserController::class,'report'])->name('user.report');

Route::post('usersreports',[\App\Http\Controllers\UserController::class,'report'])->name('user.report');




Route::get('fuelrequestreports',[\App\Http\Controllers\FuelrequestController::class,'report'])->name('fuelrequests.report');

Route::post('fuelrequestreports',[\App\Http\Controllers\FuelrequestController::class,'report'])->name('fuelrequests.report');

// Route::get('ViewPages', 'ViewController@index');
// Route::post('ViewPages', 'ViewController@index');


    //fuelstation
    Route::resource('/fuelstation',\App\Http\Controllers\FuelstationController::class);

 //fuelrequest
 Route::resource('/fuelrequests',\App\Http\Controllers\FuelrequestController::class);

 Route::post('Admin_approval',[\App\Http\Controllers\FuelrequestController::class,'AdminStatus'])->name('admin.status');

 Route::post('HOD_approval',[\App\Http\Controllers\FuelrequestController::class,'HodStatus'])->name('hod.status');

 Route::post('Fuel_station_approval',[\App\Http\Controllers\FuelrequestController::class,'FSAStatus'])->name('FSA.status');



 Route::resource('roles', RoleController::class);
 //Route::resource('users', UserController::class);


 Route::get('/profile', [App\Http\Controllers\AdminController::class, 'userAccount'])->name('admin.profile');
//  admin-profile

 Route::post('/profile/account/{id}', [App\Http\Controllers\AdminController::class, 'updateAccount'])->name('update.profile');

 Route::get('change-password',  [App\Http\Controllers\AdminController::class, 'changePassword'])->name('change.password.form');
 Route::post('change-password',[App\Http\Controllers\AdminController::class, 'changPasswordStore'])->name('change.password');


});


// HOD ROUTE

Route::group(['prefix'=>'HOD','middleware' => ['role:HOD']], function () {
    //
    Route::get('/HOD', [App\Http\Controllers\HodController::class, 'dashboard'])->middleware(['auth'])->name('HOD');

    Route::get('/profile', [App\Http\Controllers\HodController::class, 'userAccount'])->name('hod.profile');


    Route::post('/profile/account/{id}', [App\Http\Controllers\HodController::class, 'updateAccount'])->name('update.profile');

    Route::get('change-password',  [App\Http\Controllers\HodController::class, 'changePassword'])->name('HOD.change.password.form');
    Route::post('change-password',[App\Http\Controllers\HodController::class, 'changPasswordStore'])->name('change.password');





    //Route::get('/fuelrequests', [App\Http\Controllers\HodController::class, 'index'])->middleware(['auth'])->name('HOD');

   Route::resource('/HOD-fuelrequests',\App\Http\Controllers\HOD\FuelrequestController::class);
    Route::post('HOD_approval',[\App\Http\Controllers\HOD\FuelrequestController::class,'HodStatus'])->name('hod.status');


});










// Driver. ROUTE

Route::group(['prefix'=>'Driver','middleware' => ['role:Driver']], function () {
    //
    Route::get('/Driver', [App\Http\Controllers\DriverController::class, 'dashboard'])->middleware(['auth'])->name('Driver');

    Route::get('/profile', [App\Http\Controllers\DriverController::class, 'userAccount'])->name('Driver.profile');


    Route::post('/profile/account/{id}', [App\Http\Controllers\DriverController::class, 'updateAccount'])->name('update.profile');

    Route::get('change-password',  [App\Http\Controllers\DriverController::class, 'changePassword'])->name('Driver.change.password.form');
    Route::post('change-password',[App\Http\Controllers\DriverController::class, 'changPasswordStore'])->name('Driver.change.password');





    //Route::get('/fuelrequests', [App\Http\Controllers\HodController::class, 'index'])->middleware(['auth'])->name('HOD');

   Route::resource('/Driver-fuelrequests',\App\Http\Controllers\Driver\FuelrequestController::class);


//    Route::resource('/HOD-fuelrequests',\App\Http\Controllers\HOD\FuelrequestController::class);




});





// fuelattender. ROUTE

Route::group(['prefix'=>'fuelattender','middleware' => ['role:FuelStationAttender']], function () {
    //
    Route::get('/fuelattender', [App\Http\Controllers\FuelStationAttenderController::class, 'dashboard'])->middleware(['auth'])->name('FuelStationAttender');

    Route::get('/profile', [App\Http\Controllers\FuelStationAttenderController::class, 'userAccount'])->name('FuelStationAttender.profile');


    Route::post('/profile/account/{id}', [App\Http\Controllers\FuelStationAttenderController::class, 'updateAccount'])->name('update.profile');

    Route::get('change-password',  [App\Http\Controllers\FuelStationAttenderController::class, 'changePassword'])->name('FuelStationAttender.change.password.form');
    Route::post('change-password',[App\Http\Controllers\FuelStationAttenderController::class, 'changPasswordStore'])->name('FuelStationAttender.change.password');





    //Route::get('/fuelrequests', [App\Http\Controllers\HodController::class, 'index'])->middleware(['auth'])->name('HOD');

   Route::resource('/fuelattender-fuelrequests',\App\Http\Controllers\Fuelattender\FuelrequestController::class,['only' => ['index']]);

   Route::post('FuelStationAttender_approval',[\App\Http\Controllers\Fuelattender\FuelrequestController::class,'fuelattenderStatus'])->name('fuelattender.status');

//    Route::resource('/HOD-fuelrequests',\App\Http\Controllers\HOD\FuelrequestController::class);




});




// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     // Route::resource('users', UserController::class);
//     // Route::resource('products', ProductController::class);
// });



require __DIR__.'/auth.php';


