<?php

namespace App\Http\Controllers;

use App\Models\fuelrequest;
use App\Models\Vehicle;
use App\Models\User;

use Illuminate\Http\Request;


class FuelrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//         $fuelrequest = fuelrequest::with(['User'])->get();
//    dd($fuelrequest);



        $fuelrequest=fuelrequest::orderBy('id','DESC')->paginate(10);

        //  dd($vehicle);
         return view('backend.layouts.fuelrequests.index')->with('fuelrequest',$fuelrequest);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $brand=Brand::get();
         $vehicle=Vehicle::where('status','active')->get();

        return view('backend.layouts.fuelrequests.create')->with('vehicle',$vehicle);//->with('brands',$brand);;

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request->all();

        // 'user_id','',
        // '',
        // '',
        // 'order_number','
        // ',


        $this->validate($request,[
            'present_km'=>'numeric|required',
            'liters_km'=>'numeric|required',

            'last_fuel_qty'=>'numeric|required',
            'last_km'=>'numeric|required',
            'last_km_when_fueling'=>'last_km_when_fueling|required',
            'fueltank'=>'numeric|required',
            'km_used'=>'numeric|required',
            'HOD_approval'=>'required|in:active,inactive',
            'Admin_approval'=>'required|in:active,inactive',
            'Fuel_station_approval'=>'required|in:active,inactive',

            'Fuel_station'=>'required',




         ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
