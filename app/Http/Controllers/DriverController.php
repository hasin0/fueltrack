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

     //$user=User::where('department_id',$user->department_id)->with(['fuelrequests','department'])->get();

     $fuelrequestC=fuelrequest::where('department_id',$user->department_id)->get();//with(['fuelrequests','department'])->get();
    //dd($fuelrequest);

    $fuelrequest = fuelrequest::where(['user_id'=>auth()->user()->id])->get();//->with(['vehicles','user'])->get();


    // $user=Vehicle::where('department_id',$user->department_id)->count();

      // $department_id = Auth::user()->department_id; //get the id of the department that
    //    dd($user->count());

       return view('Driver.layouts.index')->with('user',$user)->with('fuelrequest',$fuelrequest)->with('fuelrequestC',$fuelrequestC);

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
