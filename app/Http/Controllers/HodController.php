<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fuelrequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class HodController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:fuelrequests-list|fuelrequests-create|fuelrequests-edit|fuelrequests-delete', ['only' => ['index','show']]);
         $this->middleware('permission:fuelrequests-create', ['only' => ['create','store']]);
         $this->middleware('permission:fuelrequests-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:fuelrequests-delete', ['only' => ['destroy']]);
         $this->middleware('permission:fuelrequests-HodStatus', ['only' => ['HodStatus']]);



    }

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

       return view('HOD.layouts.index')->with('user',$user)->with('fuelrequest',$fuelrequest)->with('fuelrequestC',$fuelrequestC);

    }



//     public function index()
//     {
//     //     $tasks = Task::with("type", "city", "operator")
//     //  ->whereCityId($city->id)->whereTypeId($type->id)->get();

//            $vehicle=Vehicle::all();
//            $user=Auth::user();
//            //dd($user);
//         //$fuelrequest=fuelrequest::where('vehicle_id','active')->get();//limit(3)->orderBy('id','DESC')->get();

// //    $fuelrequest =DB::table('fuelrequests')
// //    ->join('vehicles','department_id', '=', 'vehicles.department_id')
// //    ->join('users','users.id', '=', 'fuelrequests.user_id')
// //    ->join('departments','departments.name', '=','departments.name')

// //    ->select('users.*','fuelrequests.*','vehicles.*','departments.*')
// //    ->where('users.id', '=', 1)

// //    ->first();





//     $fuelrequest =fuelrequest::with(['vehicles','user'])->get();//whereVehicleId($vehicle->id)->whereUserId($user->id)->get();

//     // $fuelrequest=DB::table('fuelrequests')->select('id','vehicle_id')->get();//where('id')->get();

// // dd($fuelrequest);






//         return view('HOD.layouts.fuelrequests.index')->with('fuelrequest',$fuelrequest);
//         //
//     }



//     public function create()
//     {

//         // $brand=Brand::get();
//          $vehicle=Vehicle::where('status','active')->get();
//                // dd($vehicle);


//         return view('HOD.layouts.fuelrequests.create')->with('vehicle',$vehicle);//->with('brands',$brand);;

//         //
//     }



//     public function store(Request $request)
//     {
//        // return $request->all();

//         // 'user_id','',
//         // '',
//         // '',
//         // 'order_number','
//         // ',


//         $this->validate($request,[
//             'present_km'=>'numeric|required',
//             'liters_km'=>'numeric|required',

//             'last_fuel_qty'=>'numeric|required',
//             'last_km'=>'numeric|required',
//             'last_km_when_fueling'=>'numeric|required',
//             //'vehicle_id'=>'exists:vehicles,id,fueltank|required',
//                //'vehicle_id'=>'exists:vehicles,id|required',
//            // 'vehicle_id'=>'exists:vehicles,id|required',

//             'km_used'=>'numeric|required',
//             // 'HOD_approval'=>'required|in:active,inactive',
//             // 'Admin_approval'=>'required|in:active,inactive',
//             // 'Fuel_station_approval'=>'required|in:issued,Notissued',

//             'Fuel_station'=>'required',
//          ]);

//          $data['order_number']='ORD-'.strtoupper(Str::random(10));

//          $data=$request->all();
//          $data['user_id']=auth()->id();
//          $data['order_number']='ORD-'.strtoupper(Str::random(10));




//          $data['km_used']=$data['last_km']+$data['liters_km'];

//          //





//          $vehicle=$data['vehicle_id'];










//          $data=fuelrequest::create($data);

//      $data->vehicles()->attach($vehicle);









//          if ($data) {
//             return redirect()->route('fuelrequests.index', ['parameterKey' => 'success']);
//             # code...
//          }else {
//             return redirect()->back()->withErrors('someting went wrong')->withInput();
//          }







//     }



















}
