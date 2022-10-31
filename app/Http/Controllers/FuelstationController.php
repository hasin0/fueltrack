<?php

namespace App\Http\Controllers;

use App\Models\Fuelstation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class FuelstationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
       // $fuelstation = fuelstation::with(['User'])->get();
       // dd($fuelstation);


 $fuelstation = Fuelstation::with(['user'])->get();
    //    dd($fuelstation);


        // $fuelstation=Fuelstation::orderBy('id','DESC')->paginate(10);


    // $fuelstation = fuelstation::find(1);

    // return $fuelstation->department->id;

        //  dd($fuelstation);
        return view('backend.layouts.fuelstations.index')->with('fuelstation',$fuelstation);
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
        $user=auth()->user();


        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'FuelStationAttender');
            }
        )->get();

        // $users=User::whereHas('roles',function($q){
        //     $q->where('name','FuelStationAttender');
        // });


        return view('backend.layouts.fuelstations.create')->with('users',$users);;;
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
            // 'status'=>'required|in:active,inactive',
            'user_id'=>'nullable',




         ]);
         $data=$request->all();

         $data['user_id']=$request->user_id;

         $status=Fuelstation::create($data);

         if ($status) {
            return redirect()->route('fuelstation.index', ['parameterKey' => 'success']);
            # code...
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }



    }


    public function fuelstationStatus(Request $request)
    {

        //dd($request->all());

        if ($request->mode == 'true') {
            DB::table('fuelstations')->where('id', $request->id)->update(['status'=>'active']);
            # code...
        }
        else {
            DB::table('fuelstations')->where('id', $request->id)->update(['status'=>'inactive']);

            # code...
        }

        return response()->json(['msg'=>'Successfully updated status','status'=>true]);

        // $fuelstation = fuelstation::find($request->fuelstation_id);

        // $fuelstation->status = $request->status;
        // dd($fuelstation);
        // $fuelstation->save();

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
        $fuelstation=Fuelstation::findOrFail($id);

        
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'FuelStationAttender');
            }
        )->get();


        if ($fuelstation) {

            return view('backend.layouts.fuelstations.edit')->with('users',$users)->with('fuelstation',$fuelstation);

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

        $fuelstation=Fuelstation::findOrFail($id);
        $this->validate($request,[
            'name'=>'string|required',
            // 'status'=>'required|in:active,inactive',
            'user_id'=>'nullable',

        ]);
        $data=$request->all();
        // $slug=Str::slug($request->title);
        // $count=Banner::where('slug',$slug)->count();
        // if($count>0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // }
        // $data['slug']=$slug;
        // return $slug;
        $status=$fuelstation->fill($data)->save();
        if($status){
            request()->session()->flash('success','Banner successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred while updating banner');
        }
        return redirect()->route('fuelstation.index');
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
        $fuelstation=Fuelstation::findOrFail($id);
        $status=$fuelstation->delete();
        if($status){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{

            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('fuelstation.index');
        //
    }
}
