<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vehicle=Vehicle::orderBy('id','DESC')->paginate(10);

       //  dd($vehicle);
        return view('backend.layouts.vehicles.index')->with('vehicles',$vehicle);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.layouts.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

         //return $request->all();

         $this->validate($request,[
            'name'=>'string|required',
            'model'=>'string|required',
            'plate_no'=>'string|required',
            'tag_no'=>'string|required',
            'fueltank'=>'numeric|required',
            'name'=>'string|required',
            'status'=>'required|in:active,inactive',
            'department'=>'required',




         ]);
         $data=$request->all();

         $status=Vehicle::create($data);

         if ($status) {
            return redirect()->route('vehicle.index', ['parameterKey' => 'success']);
            # code...
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }



    }


    public function vehicleStatus(Request $request)
    {

        dd($request->all());
        $vehicle = Vehicle::find($request->vehicle_id);

        $vehicle->status = $request->status;
        dd($vehicle);
        $vehicle->save();

        return response()->json(['success'=>'Status change successfully.']);
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
