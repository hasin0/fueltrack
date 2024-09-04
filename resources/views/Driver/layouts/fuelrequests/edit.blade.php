@extends('Driver.layouts.master')

@section('title','E-SHOP || Fuel Requests Edit')

@section('main-contents')

<div class="card">
    <h5 class="card-header">Edit Fuel Request</h5>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('Driver-fuelrequests.update', $fuelrequests->id) }}">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="present_km" class="col-form-label">Present KM <span class="text-danger">*</span></label>
                <input id="present_km" type="number" name="present_km" placeholder="Enter Present KM"  value="{{ old('present_km', $fuelrequests->present_km) }}" class="form-control">
                @error('present_km')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ltr_collected" class="col-form-label">Liters Collected <span class="text-danger">*</span></label>
                <input id="ltr_collected" type="number" name="ltr_collected" placeholder="Enter Liters Collected"  value="{{ old('ltr_collected', $fuelrequests->ltr_collected) }}" class="form-control">
                @error('ltr_collected')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="previous_km" class="col-form-label">Previous KM Reading <span class="text-danger">*</span></label>
                <input id="previous_km" type="number" name="previous_km" placeholder="Enter Previous KM Reading"  value="{{ old('previous_km', $fuelrequests->previous_km) }}" class="form-control">
                @error('previous_km')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicle_id">Vehicle Name & Fuel Tank</label>
                <select name="vehicle_id" class="form-control">
                    <option value="">--Select Vehicle--</option>
                    @foreach($vehicle as $vehicles)
                        <option value="{{$vehicles->id}}" {{ (old('vehicle_id', $fuelrequests->vehicle_id) == $vehicles->id) ? 'selected' : '' }}>
                            Car-Tag :{{$vehicles->tag_no}} fueltankLiters:{{$vehicles->fueltank}} Department:{{$vehicles->department->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fuelstation_id">Fuel Station</label>
                <select name="fuelstation_id" class="form-control">
                    <option value="">--Select Fuel Station--</option>
                    @foreach($fuelstation as $fuelstations)
                        <option value="{{$fuelstations->id}}" {{ (old('fuelstation_id', $fuelrequests->fuelstation_id) == $fuelstations->id) ? 'selected' : '' }}>
                            {{$fuelstations->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection
