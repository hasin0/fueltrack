<?php

namespace App\Http\Controllers;

use App\Models\Fuelstation;
use App\Models\User;
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
        $fuelstation = Fuelstation::with(['user.roles'])->get();
        return view('backend.layouts.fuelstations.index', compact('fuelstation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'fuelstation-attender');
            }
        )->get();


        return view('backend.layouts.fuelstations.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'user_id' => 'nullable',
        ]);

        $data = $request->all();
        $data['user_id'] = $request->user_id;

        $status = Fuelstation::create($data);

        if ($status) {
            return redirect()->route('fuelstation.index')->with('success', 'Fuel Station successfully created');
        } else {
            return redirect()->back()->withErrors('Something went wrong')->withInput();
        }
    }

    /**
     * Update the fuel station status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fuelstationStatus(Request $request)
    {
        $fuelstation = Fuelstation::findOrFail($request->id);
        $fuelstation->status = $request->mode == 'true' ? 'active' : 'inactive';
        $fuelstation->save();

        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fuelstation = Fuelstation::findOrFail($id);

        $users = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'fuelstation-attender');
            }
        )->get();

        if ($fuelstation) {
            return view('backend.layouts.fuelstations.edit', compact('users', 'fuelstation'));
        } else {
            return back()->with('error', 'Data not found');
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
        $fuelstation = Fuelstation::findOrFail($id);

        $this->validate($request, [
            'name' => 'string|required',
            'user_id' => 'nullable',
        ]);

        $data = $request->all();
        $status = $fuelstation->fill($data)->save();

        if ($status) {
            return redirect()->route('fuelstation.index')->with('success', 'Fuel Station successfully updated');
        } else {
            return redirect()->back()->with('error', 'Error occurred while updating Fuel Station');
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
        $fuelstation = Fuelstation::findOrFail($id);
        $status = $fuelstation->delete();

        if ($status) {
            return redirect()->route('fuelstation.index')->with('success', 'Fuel Station successfully deleted');
        } else {
            return redirect()->route('fuelstation.index')->with('error', 'Error occurred while deleting Fuel Station');
        }
    }
}
