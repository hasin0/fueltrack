<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fuelrequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
       // return 'HOD dashboard';
     $user=auth()->user();
     $departmentId = $user->department_id;
     $userId  = $user->id;

     //$user=User::where('department_id',$user->department_id)->with(['fuelrequests','department'])->get();

     $fuelrequestC=fuelrequest::where('department_id',$user->department_id)->get();//with(['fuelrequests','department'])->get();
    //dd($fuelrequest);

    $fuelrequest = fuelrequest::where(['user_id'=>auth()->user()->id])->get();//->with(['vehicles','user'])->get();


    $totalLitersCollected = fuelrequest::where('user_id', $userId)->sum('ltr_collected');
    $totalAmountSpent = fuelrequest::where('user_id', $userId)->sum('amount');



    // Department-wise fuel data (same as in HodController)
    // $departmentFuelData = fuelrequest::where('department_id', $departmentId)
    // ->select('department_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(ltr_collected) as total_liters'))
    // ->groupBy('department_id')
    // ->first();

 // Vehicle-wise fuel data for the DRIVER ONLY
 $vehicleFuelData = Vehicle::whereHas('fuelrequests', function ($query) use ($userId ) {
    $query->where('user_id', $userId );
})
->with(['fuelrequests' => function ($query) use ($userId ) {
    $query->select('vehicle_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(ltr_collected) as total_liters'), 'fuelrequest_vehicle.vehicle_id as pivot_vehicle_id', 'fuelrequest_vehicle.fuelrequest_id as pivot_fuelrequest_id')
          ->where('user_id', $userId ); // Filter by driver's ID
    $query->groupBy('vehicle_id', 'pivot_vehicle_id', 'pivot_fuelrequest_id');
}])
->get();




    // $user=Vehicle::where('department_id',$user->department_id)->count();

      // $department_id = Auth::user()->department_id; //get the id of the department that
    //    dd($user->count());

    return view('Driver.layouts.index', [
        'user' => $user,
        'fuelrequest' => $fuelrequest,
        'fuelrequestC' => $fuelrequestC,
        // 'departmentFuelData' => $departmentFuelData,
        'fuelDataByVehicle' => $vehicleFuelData,
        'totalLitersCollected' => $totalLitersCollected,
        'totalAmountSpent' => $totalAmountSpent,
    ]);
    }



    public function userAccount(){
        $user=Auth::user();
        return view('Driver.layouts.users.profile',compact('user'));
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

// return $request->all();

//         $hashpassword=Auth::user()->password;

//         if ($request->oldpassword==null && $request->newpassword==null) {
//             User::where('id',$id)->update(['name'=>$request->name,'phone'=>$request->phone]);


//         }
//         else {
//             if (\Hash::check($request->oldpassword,$hashpassword)) {

//                 if (!\Hash::check($request->newpassword, $hashpassword)) {

//                     User::where('id',$id)->update(['name'=>$request->name,'phone'=>$request->phone,'password'=>$request->newpassword]);


//                     return back()->with('sucess','account successfully updated');
//                     # code...
//                 }
//                 else {
//                     return back()->with('error','account not successfully updated');
//                 }


//                 # code...($hash)
//             }
//             else {
//                 return back()->with('error','old password does not match ');
//             }
//         }








    }


    public function changePassword(){


        return view('Driver.layouts.users.userPasswordChange');//,compact('user'));
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
