@extends('HOD.layouts.master')

@section('title','E-SHOP || fuelrequests Create')

@section('main-contents')

<div class="card">
    <h5 class="card-header">Requestfuels</h5>
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
          <label for="inputTitle" class="col-form-label">present_km <span class="text-danger">*</span></label>
        <input id="inputTitle" type="number" name="present_km" placeholder="Enter present_km"  value="{{old('present_km')}}" class="form-control">
        @error('present_km')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">last_fuel_qty <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="last_fuel_qty" placeholder="Enter last_fuel_qty"  value="{{old('last_fuel_qty')}}" class="form-control">
          @error('last_fuel_qty')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="inputTitle" class="col-form-label">last_km <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="last_km" placeholder="Enter last_km"  value="{{old('last_km')}}" class="form-control">
          @error('last_km')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="inputTitle" class="col-form-label">last_km_when_fueling <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="last_km_when_fueling" placeholder="Enter last_km_when_fueling"  value="{{old('last_km_when_fueling')}}" class="form-control">
          @error('last_km_when_fueling')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>


          <div class="form-group">
            <label for="inputTitle" class="col-form-label">km_used <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="km_used" placeholder="Enter last_km_when_fueling"  value="{{old('km_used')}}" class="form-control">
          @error('km_used')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>



          <div class="form-group">
            <label for="inputTitle" class="col-form-label">liters_km <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="liters_km" placeholder="Enter liters_km"  value="{{old('liters_km')}}" class="form-control">
          @error('liters_km')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>













          <div class="form-group">
            <label for="vehicle_id">VehicleName & FuelTank</label>
            {{-- {{$brands}} --}}

            <select name="vehicle_id" class="form-control">
                <option value="">--Select vehicle--</option>
               {{-- @foreach(\App\Models\Vehicle::where('status','active')->get() as $vehicles) --}}
               @foreach($vehicle as $vehicles )
                <option value="{{$vehicles->id}}">Car-Tag :{{$vehicles->tag_no}} fueltankLiters:{{$vehicles->fueltank}} Department:{{$vehicles->department->name}}</option>
               @endforeach
            </select>
          </div>










          <div class="form-group">
            <label for="department_id">department</label>
            {{-- {{$brands}} --}}

            <select name="department_id" class="form-control">
                {{-- <option value="">--Select vehicle--</option> --}}
               {{-- @foreach(\App\Models\Vehicle::where('status','active')->get() as $vehicles) --}}
               @foreach($department as $department )
                <option value="{{$department->id}}"> {{$department->name}}</option>
               @endforeach
            </select>
          </div>










          {{-- <div class="form-group">
            <label for="department" class="col-form-label">Department <span class="text-danger">*</span></label>
            <select name="department" class="form-control">
                <option value="Admin">Admin</option>
                <option value="IT">IT</option>
                <option value="HR">HR</option>
                <option value="HSE">HSE</option>
                <option value="Batching plant">Batching plant</option>
                <option value="Legal">Legal</option>
                <option value="Logistic">Logistic</option>
                <option value="Security">Security</option>
                <option value="GED">GED</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Process">Process</option>
                <option value="Electrical">Electrical</option>
                <option value="Marine">Marine</option>
                <option value="Chemical">Chemical</option>
                <option value="Warehouse">Warehouse</option>
                <option value="Marketing">Marketing</option>
                <option value="Clinc">Clinc</option>


            </select>
            @error('department')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div> --}}



{{--

          <div class="form-group">
            <label for="HOD_approval" class="col-form-label">HOD_approval <span class="text-danger">*</span></label>
            <select name="HOD_approval" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            @error('HOD_approval')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>




          <div class="form-group">
            <label for="Admin_approval" class="col-form-label">Admin_approval <span class="text-danger">*</span></label>
            <select name="Admin_approval" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            @error('Admin_approval')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>




          <div class="form-group">
            <label for="Fuel_station_approval" class="col-form-label">Fuel_station_approval <span class="text-danger">*</span></label>
            <select name="Fuel_station_approval" class="form-control">
                <option value="">--Select--</option>

                <option value="issued">Issued</option>
                <option value="Notissued">Not-Issued</option>
            </select>
            @error('Fuel_station_approval')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div> --}}






          <div class="form-group">
            <label for="fuelstation">fuelstation</label>
            {{-- {{$brands}} --}}

            <select name="fuelstation_id" class="form-control">
                <option value="">--Select fuelstation--</option>
               {{-- @foreach(\App\Models\Vehicle::where('status','active')->get() as $vehicles) --}}
               @foreach($fuelstation as $fuelstations )
                <option value="{{$fuelstations->id}}"> {{$fuelstations->name}}</option>
               @endforeach
            </select>
          </div>





















        {{-- <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}




        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
