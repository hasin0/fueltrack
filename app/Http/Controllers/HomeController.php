<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::user()->hasRole('Admin')) {
                  // return view('backend.layouts.index');
                  return redirect()->route('admin');

        }elseif (Auth::user()->hasRole('HOD')) {
            return redirect()->route('HOD');


        }elseif (Auth::user()->hasRole('Driver')) {
            return redirect()->route('Driver');

    }elseif (Auth::user()->hasRole('FuelStationAttender')) {
        return redirect()->route('FuelStationAttender');

}
    else {
        return view('404');
    }

        //return view('home');

      // return view('backend.layouts.index');
      // redirect()->route(auth()->user()->role);

    }


    // public function HOD()
    // {

    //     return view('HOD.layouts.index');//, function ($view) {

    //     //});

    // }





}
