<?php

namespace App\Http\Controllers;

use App\Models\fuelrequest;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Str;

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



        $fuelrequest = fuelrequest::with(['vehicles'])->get();
 dd($fuelrequest);


//     $fuelrequest=fuelrequest::find(4);

//     $vehicle=Vehicle::find(6);

//   return  $vehicle->fuelrequests()->attach($fuelrequest);




       // $fuelrequest=fuelrequest::orderBy('id','DESC')->paginate(10);

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
        // $vehicle=Vehicle::where('status','active')->get();

        return view('backend.layouts.fuelrequests.create');//->with('vehicle',$vehicle);//->with('brands',$brand);;

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
            'last_km_when_fueling'=>'numeric|required',
            'vehicle_id'=>'exists:vehicles,id,fueltank|required',               'vehicle_id'=>'exists:vehicles,id|required',
           // 'vehicle_id'=>'exists:vehicles,id|required',

            'km_used'=>'numeric|required',
            'HOD_approval'=>'required|in:active,inactive',
            'Admin_approval'=>'required|in:active,inactive',
            'Fuel_station_approval'=>'required|in:issued,Notissued',

            'Fuel_station'=>'required',




         ]);

         $data['order_number']='ORD-'.strtoupper(Str::random(10));

         $data=$request->all();
         $data['user_id']=auth()->id();
         $data['order_number']='ORD-'.strtoupper(Str::random(10));




         $data['km_used']=$data['last_km']+$data['liters_km'];

         //
       //  $vehicle=Vehicle::where('status','active')->get();




         $data=fuelrequest::create($data);
        // $data->vehicles()->sync($data['vehicle_id']);

        $data=$data['vehicle_id']->vehicles()->attach($data);

        dd($data);






         if ($data) {
            return redirect()->route('fuelrequests.index', ['parameterKey' => 'success']);
            # code...
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }

         $data->vehicles()->attach(request('vehicles'));






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
