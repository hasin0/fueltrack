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

class AdminController extends Controller
{
    //

    public function admin()
    {
        return view('backend.layouts.index');

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
