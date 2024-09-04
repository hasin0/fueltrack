<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\fuelrequest;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\department;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function admin()
    {
         $totalFuelAmount = fuelrequest::sum('amount');
        $totalLitersCollected = fuelrequest::sum('ltr_collected');
        $averageKmPerLiter = fuelrequest::avg('AVG_KM/LTR');

        // Get the department with the highest fuel consumption
        $highestConsumptionDept = fuelrequest::select('department_id', DB::raw('SUM(ltr_collected) as total_consumption'))
            ->groupBy('department_id')
            ->orderBy('total_consumption', 'desc')
            ->with('department')
            ->first();

        // Total number of vehicles
        $totalVehicles = Vehicle::count();

        // Vehicle with the highest fuel requests
        $vehicleWithHighestRequests = DB::table('fuelrequests')
        ->join('fuelrequest_vehicle', 'fuelrequests.id', '=', 'fuelrequest_vehicle.fuelrequest_id')
        ->join('vehicles', 'fuelrequest_vehicle.vehicle_id', '=', 'vehicles.id') // Join the vehicles table
        ->select('vehicles.name as vehicle_name', DB::raw('COUNT(*) as request_count')) // Select vehicle name
        ->groupBy('fuelrequest_vehicle.vehicle_id', 'vehicles.name') // Group by vehicle_id and name
        ->orderBy('request_count', 'desc')
        ->first();





        return view('backend.layouts.index', compact(
            'totalFuelAmount',
            'totalLitersCollected',
            'averageKmPerLiter',
            'highestConsumptionDept',
            'totalVehicles',
            'vehicleWithHighestRequests'
        ));
    }



    public function userAccount(){
        $profile=Auth::user();
        return view('backend.layouts.users.profile',compact('profile'));
    }


    public function updateAccount(Request $request, $id)
    {

        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();

    }

















    public function changePassword(){


        return view('backend.layouts.users.changePassword');//,compact('user'));
    }




    public function changPasswordStore(Request $request)
    {
        $request->validate([
            // 'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back();


        // return redirect()->route('user.account')->with('success','Password successfully changed');
    }






}
