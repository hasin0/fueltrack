<?php

namespace App\Http\Controllers\HOD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuelrequest;
use App\Models\Vehicle;
use App\Models\department;
use App\Models\Fuelstation;
use App\Models\Setting; // Import the Setting model

use App\Mail\FuelrequestMail;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FuelrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:fuelrequests-list|fuelrequests-create|fuelrequests-edit|fuelrequests-delete', ['only' => ['index','show']]);
        $this->middleware('permission:fuelrequests-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:fuelrequests-delete', ['only' => ['destroy']]);
        $this->middleware('permission:fuelrequests-HodStatus', ['only' => ['HodStatus']]);
    }

    public function index()
    {
        $user = auth()->user();
        $fuelrequest = fuelrequest::where('department_id', $user->department_id)
                                    ->with(['vehicles', 'fuelstation', 'user']) // Eager load relationships
                                    ->get();
        return view('HOD.layouts.fuelrequests.index', compact('fuelrequest'));
    }

    public function HodStatus(Request $request)
    {
        $user = auth()->user();
        if ($request->mode == 'true') {
            $data = fuelrequest::find($request->id);
            $data->HOD_approval = 'active';
            $data->save();

            $userEmail = User::role('Admin')->get('email');
            Mail::to($userEmail)->send(new FuelrequestMail($data));
        } else {
            DB::table('fuelrequests')->where('id', $request->id)->update(['HOD_approval'=>'inactive']);
        }

        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }

    public function create()
    {
        $user = auth()->user();
        $department = department::where('id', $user->department_id)->get();
        $fuelstation = Fuelstation::all();
        $vehicle = Vehicle::where('department_id', $user->department_id)->get();
        return view('HOD.layouts.fuelrequests.create', compact('fuelstation', 'vehicle', 'department'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'present_km' => 'numeric|required',
            'ltr_collected' => 'numeric|required',
            'previous_km' => 'numeric|required',
            'vehicle_id' => 'required',
            'fuelstation_id' => 'required',
        ]);

        $data = $request->all();
        $data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
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
            return redirect()->route('HOD-fuelrequests.index', ['parameterKey' => 'success']);
        } else {
            return redirect()->back()->withErrors('Something went wrong')->withInput();
        }
    }

    public function edit($id)
    {
        $user = auth()->user();
        $userDepartmentId =auth()->user()->department_id;

        $vehicle = DB::select("SELECT vehicles.*, departments.name AS department_name FROM vehicles
                        JOIN departments ON vehicles.department_id = departments.id
                        WHERE vehicles.department_id = ?", [$userDepartmentId]);

        $fuelrequests = fuelrequest::findOrFail($id);
        $fuelstation = Fuelstation::all();

        if ($fuelrequests) {
            return view('HOD.layouts.fuelrequests.edit', compact('fuelrequests', 'vehicle', 'fuelstation'));
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
        ]);

        $data = $request->all();
        $vehicle = $data['vehicle_id'];

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
            return redirect()->route('HOD-fuelrequests.index', ['parameterKey' => 'success']);
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
        return redirect()->route('HOD-fuelrequests.index');
    }
}
