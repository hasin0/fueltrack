<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;


class SettingController extends Controller
{

    public function edit()
    {
        $fuelPrice = Setting::where('key', 'fuel_price')->first();
        return view('backend.layouts.settings.edit', compact('fuelPrice'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'fuel_price' => 'required|numeric',
        ]);

        Setting::updateOrCreate(
            ['key' => 'fuel_price'],
            ['value' => $request->fuel_price]
        );

        return redirect()->back()->with('success', 'Fuel price updated successfully!');
    }
}
