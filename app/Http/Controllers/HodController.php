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


class HodController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:fuelrequests-list|fuelrequests-create|fuelrequests-edit|fuelrequests-delete', ['only' => ['index','show']]);
         $this->middleware('permission:fuelrequests-create', ['only' => ['create','store']]);
         $this->middleware('permission:fuelrequests-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:fuelrequests-delete', ['only' => ['destroy']]);
         $this->middleware('permission:fuelrequests-HodStatus', ['only' => ['HodStatus']]);



    }




    public function dashboard()
{
    $user = auth()->user();
    $departmentId = $user->department_id;

    // Fuel requests made by the HOD
    $fuelrequest = fuelrequest::where(['user_id' => auth()->user()->id])->get();

    // All fuel requests for the HOD's department
    $fuelrequestC = fuelrequest::where('department_id', $user->department_id)->get();


  $departmentTotalLitersCollected = fuelrequest::where('department_id', $departmentId)->sum('ltr_collected');
 $departmentTotalAmountSpent = fuelrequest::where('department_id', $departmentId)->sum('amount');


    // Department-wise fuel data
    $departmentFuelData = fuelrequest::where('department_id', $departmentId)
        ->select('department_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(ltr_collected) as total_liters'))
        ->groupBy('department_id')
        ->first();

    // Vehicle-wise fuel data for the department
    $vehicleFuelData = Vehicle::where('department_id', $departmentId)
    ->with(['fuelrequests' => function ($query) {
        $query->select('vehicle_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(ltr_collected) as total_liters'), 'fuelrequest_vehicle.vehicle_id as pivot_vehicle_id', 'fuelrequest_vehicle.fuelrequest_id as pivot_fuelrequest_id');
        $query->groupBy('vehicle_id', 'pivot_vehicle_id', 'pivot_fuelrequest_id'); // Group by all selected columns
    }])
    ->get();


    return view('HOD.layouts.index', [
        'user' => $user,
        'fuelrequest' => $fuelrequest,
        'fuelrequestC' => $fuelrequestC,
        'departmentFuelData' => $departmentFuelData,
        'departmentTotalLitersCollected' => $departmentTotalLitersCollected,
        'departmentTotalAmountSpent' => $departmentTotalAmountSpent,


        'fuelDataByVehicle' => $vehicleFuelData,
    ]);
}











//     public function dashboard()
//     {
//        // return 'HOD dashboard';
//      $user=auth()->user();
//      $departmentId = $user->department_id;


//      //$user=User::where('department_id',$user->department_id)->with(['fuelrequests','department'])->get();

//      $fuelrequestC=fuelrequest::where('department_id',$user->department_id)->get();//with(['fuelrequests','department'])->get();
//     //dd($fuelrequest);

//     $fuelrequest = fuelrequest::where(['user_id'=>auth()->user()->id])->get();//->with(['vehicles','user'])->get();


//      // Department-wise fuel data
//      $departmentFuelData = fuelrequest::where('department_id', $departmentId)
//      ->select('department_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(ltr_collected) as total_liters'))
//      ->groupBy('department_id')
//      ->first(); // Get a single result for the department



//         // Vehicle-wise fuel data
//         $vehicleFuelData = Vehicle::where('department_id', $departmentId)
//             ->with(['fuelrequests' => function ($query) {
//                 $query->select('vehicle_id', DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(ltr_collected) as total_liters'));
//                 $query->groupBy('vehicle_id');
//             }])
//             ->get();


//     // $user=Vehicle::where('department_id',$user->department_id)->count();

//       // $department_id = Auth::user()->department_id; //get the id of the department that
//     //    dd($user->count());

//        return view('HOD.layouts.index')->with(  [
//         'user' => $user,
//         'fuelDataByVehicle' => $vehicleFuelData,
//         'departmentFuelData' => $departmentFuelData, // Pass department data to the view
//         // ... other data you need for the view
//         // ... other data you need for the view
// ])->with('fuelrequest',$fuelrequest)->with('fuelrequestC',$fuelrequestC);

//     }



    public function userAccount(){
        $user=Auth::user();
        return view('HOD.layouts.users.profile',compact('user'));
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


        return view('HOD.layouts.users.userPasswordChange');//,compact('user'));
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
