@extends('HOD.layouts.master')

@section('title','E-SHOP || Fuel Requests Create')

@section('main-contents')

<div class="card">
    <h5 class="card-header">Request Fuels</h5>
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

        <form method="post" action="{{route('HOD-fuelrequests.store')}}">
            {{csrf_field()}}

            <div class="form-group">
                <label for="present_km" class="col-form-label">Present KM <span class="text-danger">*</span></label>
                <input id="present_km" type="number" name="present_km" placeholder="Enter Present KM"  value="{{old('present_km')}}" class="form-control">
                @error('present_km')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ltr_collected" class="col-form-label">Liters Collected <span class="text-danger">*</span></label>
                <input id="ltr_collected" type="number" name="ltr_collected" placeholder="Enter Liters Collected"  value="{{old('ltr_collected')}}" class="form-control">
                @error('ltr_collected')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="previous_km" class="col-form-label">Previous KM Reading <span class="text-danger">*</span></label>
                <input id="previous_km" type="number" name="previous_km" placeholder="Enter Previous KM Reading"  value="{{old('previous_km')}}" class="form-control">
                @error('previous_km')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="vehicle_id">Vehicle Name & Fuel Tank</label>
                <select name="vehicle_id" class="form-control">
                    <option value="">--Select Vehicle--</option>
                    @foreach($vehicle as $vehicles)
                        <option value="{{$vehicles->id}}">Car-Tag :{{$vehicles->tag_no}} fueltankLiters:{{$vehicles->fueltank}} Department:{{$vehicles->department->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fuelstation_id">Fuel Station</label>
                <select name="fuelstation_id" class="form-control">
                    <option value="">--Select Fuel Station--</option>
                    @foreach($fuelstation as $fuelstations)
                        <option value="{{$fuelstations->id}}"> {{$fuelstations->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
