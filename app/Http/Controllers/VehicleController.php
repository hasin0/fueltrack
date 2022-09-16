<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\Vehicle;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    function __construct()
    {
         $this->middleware('permission:vehicle-list|vehicle-create|vehicle-edit|vehicle-delete', ['only' => ['index','show']]);
         $this->middleware('permission:vehicle-create', ['only' => ['create','store']]);
         $this->middleware('permission:vehicle-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vehicle-delete', ['only' => ['destroy']]);
         $this->middleware('permission:vehicle-vehicleStatus', ['only' => ['vehicleStatus']]);

    }







    public function index()
    {
       // $vehicle = Vehicle::with(['User'])->get();
       // dd($vehicle);


    $vehicle = Vehicle::with(['fuelrequests'])->get();
    //    dd($vehicle);


        $vehicle=Vehicle::orderBy('id','DESC')->paginate(10);


    // $vehicle = Vehicle::find(1);

    // return $vehicle->department->id;

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
        $department=department::all();

       // dd($department);

        return view('backend.layouts.vehicles.create')->with('department',$department);;;
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
            'department_id'=>'required',




         ]);
         $data=$request->all();

         $data['department_id']=$request->department_id;

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

        //dd($request->all());

        if ($request->mode == 'true') {
            DB::table('vehicles')->where('id', $request->id)->update(['status'=>'active']);
            # code...
        }
        else {
            DB::table('vehicles')->where('id', $request->id)->update(['status'=>'inactive']);

            # code...
        }

        return response()->json(['msg'=>'Successfully updated status','status'=>true]);

        // $vehicle = Vehicle::find($request->vehicle_id);

        // $vehicle->status = $request->status;
        // dd($vehicle);
        // $vehicle->save();

        // return response()->json(['success'=>'Status change successfully.']);
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
        $vehicle=Vehicle::findOrFail($id);
        if ($vehicle) {

            return view('backend.layouts.vehicles.edit')->with('vehicle',$vehicle);

            # code...

        }
        else {
            return back()->with('error','data not found');
        }
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

        $vehicle=vehicle::findOrFail($id);
        $this->validate($request,[
            'name'=>'string|required',
            'model'=>'string|required',
            'plate_no'=>'string|required',
            'tag_no'=>'string|required',
            'fueltank'=>'numeric|required',
            'name'=>'string|required',
            'status'=>'required|in:active,inactive',
            'department_id'=>'required',

        ]);
        $data=$request->all();
        // $slug=Str::slug($request->title);
        // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
        // $data['slug']=$slug;
        // return $slug;
        $status=$vehicle->fill($data)->save();
        if($status){
            request()->session()->flash('success','Banner successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating banner');
        }
        return redirect()->route('vehicle.index');
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
        $vehicle=vehicle::findOrFail($id);
        $status=$vehicle->delete();
        if($status){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{

            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('vehicle.index');
        //
    }
}
