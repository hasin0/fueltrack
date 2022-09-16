<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   protected $redirectTo = RouteServiceProvider::HOME;


//    public function redirectTo() {
//     $role = Auth::user()->role;
//     switch ($role) {
//       case 'Admin':
//         return view('backend.layouts.roles.index');
//         break;
//       case 'HOD':
//         return view('backend.layouts.index');
//         break;

//       case 'Driver':
//             return view('backend.layouts.index');
//             break;


//       default:
//         return '/home';
//       break;
//     }
//   }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function credentials(Request $request)
    {
        return ['email'=>$request->email,'password'=>$request->password,'status'=>'active','role'=>'admin'];

    }
}
