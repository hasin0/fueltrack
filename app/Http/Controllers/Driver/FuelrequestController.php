<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Mail\FuelrequestMail;
use Illuminate\Http\Request;

use App\Models\fuelrequest;
use App\Models\Vehicle;
use App\Models\department;
use App\Models\Fuelstation;
use App\Models\Setting; // Import the Setting model

use App\Models\Role;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Mail;


class FuelrequestController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:fuelrequests-list|fuelrequests-create|fuelrequests-edit|fuelrequests-delete', ['only' => ['index','show']]);
        $this->middleware('permission:fuelrequests-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:fuelrequests-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = auth()->user();
        $fuelrequest = fuelrequest::where(['user_id'=>auth()->user()->id])->with(['fuelstation'])->get();
        return view('Driver.layouts.fuelrequests.index')->with('fuelrequest',$fuelrequest);
    }

    public function create()
    {
        $user = auth()->user();
        $department = department::where('id',$user->department_id)->get();
        $fuelstation = Fuelstation::select('id','name')->get();
        $vehicle = Vehicle::where('department_id',$user->department_id)->get();
        return view('Driver.layouts.fuelrequests.create')->with('fuelstation',$fuelstation)->with('vehicle',$vehicle)->with('department',$department);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'present_km' => 'numeric|required',
            'ltr_collected' => 'numeric|required',
            'previous_km' => 'numeric|required',
            'vehicle_id' => 'required',
            'fuelstation_id' => 'required',
        ]);

        $data = $request->all();
        $data['order_number'] = 'ORD-'.strtoupper(Str::random(10));
        $data['department_id'] = auth()->user()->department_id;
        $data['user_id'] = auth()->id();
        $data['fuelstation_id'] = $request->fuelstation_id;

        // Calculate km_covered and AVG_KM/LTR
        $data['km_covered'] = $data['present_km'] - $data['previous_km'];
        $data['AVG_KM/LTR'] = $data['km_covered'] / $data['ltr_collected'];

        // Get the global fuel price
        $fuelPrice = Setting::where('key', 'fuel_price')->first();
        $price = $fuelPrice ? $fuelPrice->value : 0; // Use 0 if price is not set

        // Calculate amount
        $data['amount'] = $data['ltr_collected'] * $price;

        $vehicle = $data['vehicle_id'];

        $data = fuelrequest::create($data);
        $data->vehicles()->attach($vehicle);

        if ($data) {
            // Send email notifications to HOD and Admin (optional)
            $user = auth()->user();
            $userEmail = User::where('department_id', $user->department_id)
                ->whereHas('roles', function($q){
                    $q->whereIn('name', ['HOD', 'Admin']);
                })
                ->get('email');

            // Mail::to($userEmail)->send(new FuelrequestMail($data));

            return redirect()->route('Driver-fuelrequests.index', ['parameterKey' => 'success']);
        } else {
            return redirect()->back()->withErrors('Something went wrong')->withInput();
        }
    }

    public function edit($id)
    {
        $user = auth()->user();
        $vehicle = Vehicle::where('department_id', $user->department_id)->get();
        $fuelstation = Fuelstation::select('id','name')->get();
        $fuelrequests = fuelrequest::findOrFail($id);

        if ($fuelrequests) {
            return view('Driver.layouts.fuelrequests.edit', compact('fuelstation', 'fuelrequests', 'vehicle'));
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function update(Request $request, $id)
    {
        $fuelrequests = fuelrequest::findOrFail($id);

        $this->validate($request, [
            'present_km' => 'numeric|required',
            'ltr_collected' => 'numeric|required',
            'previous_km' => 'numeric|required',
            'vehicle_id' => 'required',
            'fuelstation_id' => 'required',
            // 'department_id'=> 'required',
        ]);

        $data = $request->all();
        $vehicle = $data['vehicle_id'];
        $data['department_id'] = auth()->user()->department_id;



        // Calculate km_covered and AVG_KM/LTR
        $data['km_covered'] = $data['present_km'] - $data['previous_km'];
        $data['AVG_KM/LTR'] = $data['km_covered'] / $data['ltr_collected'];

        // Get the global fuel price
        $fuelPrice = Setting::where('key', 'fuel_price')->first();
        $price = $fuelPrice ? $fuelPrice->value : 0; // Use 0 if price is not set

        // Calculate amount
        $data['amount'] = $data['ltr_collected'] * $price;

        $fuelrequestss = $fuelrequests->fill($data)->save();
        $fuelrequestss = $fuelrequests->vehicles()->sync($vehicle);

        if ($fuelrequestss) {
            return redirect()->route('Driver-fuelrequests.index', ['parameterKey' => 'success']);
        } else {
            return redirect()->back()->withErrors('Something went wrong')->withInput();
        }
    }

    public function destroy($id)
    {
        $data = fuelrequest::findOrFail($id);
        $data = $data->delete();
        if ($data) {
            request()->session()->flash('success', 'Fuel request successfully deleted');
        } else {
            request()->session()->flash('error', 'Error occurred while deleting fuel request');
        }
        return redirect()->route('Driver-fuelrequests.index');
    }
}
