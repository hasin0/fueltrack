<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Mail\FuelrequestMail;
use Illuminate\Http\Request;

use App\Models\fuelrequest;
use App\Models\Vehicle;
use App\Models\department;
use App\Models\Fuelstation;

use App\Models\Role;
use Auth;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Mail;


class FuelrequestController extends Controller
{
    //
    public function index()
    {

            //$user=auth()->user();
            $user=auth()->user();



        //  $user=User::where('department_id',$user->department_id)->whereHas(
        //     'roles', function($q){
        //         $q->where('name', 'HOD');
        //     }
        // )->get('email');


            

        
        
        //get();//('roles')
   
        //    $user = User::whereHas(
        //     'roles', function($q){
        //         $q->where('name', 'HOD');
        //     }
        // )->get();
           // $role=Role::with('users')->where('department_id',$user->department_id)->get();
            

            // $get_hod_for_the_user = vw_user_roleuser_role::where('department_id', $get_user_department)->where('role_id', '=', 4)->pluck('name','user_id');
        //   return  $user->role;

          //  $user=User::where('department_id',$user->department_id)->get();
          //  
        // for the whole department count for HODs
        //   $fuelrequest=fuelrequest::where('department_id',$user->department_id)->get();//with(['fuelrequests','department'])->get();
        //$user = User::role('HOD')->get();
        // $user = User::where('department_id', $user->department_id)->where('role_id', '=', 2)->pluck('name');
    //    dd($user);

           

       

        // $department=department::where('id',$user->department_id)->get();
        //dd($department);


        // $brand=Brand::get();

          // indiviual fuelrequest only

$fuelrequest = fuelrequest::where(['user_id'=>auth()->user()->id])->with(['fuelstation'])->get();

     //$user=User::where('department_id',$user->department_id)->with(['fuelrequests','department'])->get();


    //  $user=User::where('department_id',$user->department_id)->with(['fuelrequests','department'])->get();

    //   dd($fuelrequest);
    //  $fuelrequest = fuelrequest::find(1);
    //  returnss$fuelrequest;

    // $fuelrequest = fuelrequest::find(1);

    // $fuelrequest->vehicles();

    //  foreach ($fuelrequest->vehicles as $veH  ) {

    //   return  $veH->department_id; //- $fuelrequest['liters_km'];


    //     # code...
    // }

    //user->department_id;


     //return  $fuelrequest->vehicles();//->attach($vehicle);


     //return $fuelrequest->vehicle;
     // $fuelrequest;







    //   $fuelrequest=fuelrequest::orderBy('id','DESC')->paginate(10);

        //  dd($vehicle);
        return view('Driver.layouts.fuelrequests.index')->with('fuelrequest',$fuelrequest);//->with('fuelrequestC',$fuelrequestC);
        //
    }




    // public function AdminStatus(Request $request)
    // {

    //     //dd($request->all());

    //     if ($request->mode == 'true') {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Admin_approval'=>'active']);
    //         # code...
    //     }
    //     else {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Admin_approval'=>'inactive']);

    //         # code...
    //     }

    //     return response()->json(['msg'=>'Successfully updated status','status'=>true]);


    // }





    // public function HodStatus(Request $request)
    // {

    //     //dd($request->all());

    //     if ($request->mode == 'true') {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['HOD_approval'=>'active']);
    //         # code...
    //     }
    //     else {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['HOD_approval'=>'inactive']);

    //         # code...
    //     }

    //     return response()->json(['msg'=>'Successfully updated status','status'=>true]);


    // }





    // public function FSAStatus(Request $request)
    // {

    //     //dd($request->all());

    //     if ($request->mode == 'true') {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Fuel_station_approval'=>'issued']);
    //         # code...
    //     }
    //     else {
    //         DB::table('fuelrequests')->where('id', $request->id)->update(['Fuel_station_approval'=>'Notissued']);

    //         # code...
    //     }

    //     return response()->json(['msg'=>'Successfully updated status','status'=>true]);


    // }


































    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $user=auth()->user();

        $department=department::where('id',$user->department_id)->get();

        $fuelstation=Fuelstation::select('id','name')->get();//where('status','active')->get();
        // dd($fuelstation);

        // $brand=Brand::get();
         $vehicle=Vehicle::where('department_id',$user->department_id)->get();
            //    dd($vehicle);


        return view('Driver.layouts.fuelrequests.create')->with('fuelstation',$fuelstation)->with('vehicle',$vehicle)->with('department',$department);;//->with('brands',$brand);;

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
            //'vehicle_id'=>'exists:vehicles,id,fueltank|required',
            'department_id'=>'required',
           // 'vehicle_id'=>'exists:vehicles,id|required',

            'km_used'=>'numeric|required',
            // 'HOD_approval'=>'required|in:active,inactive',
            // 'Admin_approval'=>'required|in:active,inactive',
            // 'Fuel_station_approval'=>'required|in:issued,Notissued',

            'fuelstation_id'=>'required',
         ]);


         $data=$request->all();
        //  dd($data);
         $data['order_number']='ORD-'.strtoupper(Str::random(10));
        //  $data['department_id']=$data->department_id;
        $data['department_id']=$request->department_id;

         $data['user_id']=auth()->id();

        //  $data['order_number']='ORD-'.strtoupper(Str::random(10));

        $data['fuelstation_id']=$request->fuelstation_id;



         $data['km_used']=$data['last_km']+$data['liters_km'];

         //





         $vehicle=$data['vehicle_id'];








        // $userEmail = Auth::user()->email; //get the id of the department that loggedin
         //dd($data);
                 

         $user=auth()->user();


         $userEmail=User::where('department_id',$user->department_id)->whereHas(
            'roles', function($q){
                $q->where('name', 'HOD','Admin');
            }
        )->get('email');


        

            $userAdmin=User::role('Admin')->get();


         $data=fuelrequest::create($data);

     $data->vehicles()->attach($vehicle);

     

    //   Mail::to($userEmail,$userAdmin)->
    //   send(new FuelrequestMail($data) );//->cc($userAdmin);

      Mail::to($userEmail)
    ->cc($userAdmin)
    // ->bcc($evenMoreUsers)
    ->send(new FuelrequestMail($data));
      
            // dd('mail is sent');


    //  foreach ($data->vehicles as $veH  ) {

    //   return  $veH->fueltank - $data['liters_km'];


    //     # code...
    // }







         if ($data) {
           
            return redirect()->route('Driver-fuelrequests.index', ['parameterKey' => 'success']);
            # code...
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }







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
        $vehicle=Vehicle::where('status','active')->get();

        $fuelstation=Fuelstation::select('id','name')->get();//where('status','active')->get();


        $fuelrequests=fuelrequest::findOrFail($id);
        if ($fuelrequests) {

            return view('Driver.layouts.fuelrequests.edit')->with('fuelstation',$fuelstation)->with('fuelrequests',$fuelrequests)->with('vehicle',$vehicle);

            # code...

        }
        else {
            return back()->with('error','data not found');
        }
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
        $fuelrequests=fuelrequest::findOrFail($id);

        $this->validate($request,[
            'present_km'=>'numeric|required',
            'liters_km'=>'numeric|required',

            'last_fuel_qty'=>'numeric|required',
            'last_km'=>'numeric|required',
            'last_km_when_fueling'=>'numeric|required',
            //'vehicle_id'=>'exists:vehicles,id,fueltank|required',
               //'vehicle_id'=>'exists:vehicles,id|required',
           // 'vehicle_id'=>'exists:vehicles,id|required',

            'km_used'=>'numeric|required',
            // 'HOD_approval'=>'required|in:active,inactive',
            // 'Admin_approval'=>'required|in:active,inactive',
            // 'Fuel_station_approval'=>'required|in:issued,Notissued',

            'Fuel_station'=>'required',
         ]);

         $data=$request->all();


        //  $data['order_number']='ORD-'.strtoupper(Str::random(10));

        //  //$data=$request->all();
        //  $data['user_id']=auth()->id();
        //  $data['order_number']='ORD-'.strtoupper(Str::random(10));




        //  $data['km_used']=$data['last_km']+$data['liters_km'];

        //  //





          $vehicle=$data['vehicle_id'];










        // $data=fuelrequest::create($data);


    // $data->vehicles()->detach($vehicle);


    //  foreach ($data->vehicles as $veH  ) {

    //   return  $veH->fueltank - $data['liters_km'];


    //     # code...
    // }
    $fuelrequestss=$fuelrequests->fill($data)->save();
    $fuelrequestss=$fuelrequests->vehicles()->sync($vehicle);

    // $fuelrequestss->vehicles()->sync($vehicle);



         if ($fuelrequestss) {
            return redirect()->route('Driver-fuelrequests.index', ['parameterKey' => 'success']);
            # code...
         }else {
            return redirect()->back()->withErrors('someting went wrong')->withInput();
         }

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

        $data=fuelrequest::findOrFail($id);
        $data=$data->delete();
        if($data){
            request()->session()->flash('success','Banner successfully deleted');
        }
        else{

            request()->session()->flash('error','Error occurred while deleting banner');
        }
        return redirect()->route('Driver-fuelrequests.index');
    }
}
