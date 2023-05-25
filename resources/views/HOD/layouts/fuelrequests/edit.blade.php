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


     <form method="post" action="{{route('HOD-fuelrequests.update',$fuelrequests->id)}}">
        {{csrf_field()}}
        @method('patch')

        <div class="form-group">
          <label for="inputTitle" class="col-form-label">present_km <span class="text-danger">*</span></label>
        <input id="inputTitle" type="number" name="present_km" placeholder="Enter present_km"  value="{{($fuelrequests->present_km)}}" class="form-control">
        @error('present_km')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputTitle" class="col-form-label">last_fuel_qty <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="last_fuel_qty" placeholder="Enter last_fuel_qty"  value="{{($fuelrequests->last_fuel_qty)}}}" class="form-control">
          @error('last_fuel_qty')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="inputTitle" class="col-form-label">last_km <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="last_km" placeholder="Enter last_km"  value="{{$fuelrequests->last_km}}" class="form-control">
          @error('last_km')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="inputTitle" class="col-form-label">last_km_when_fueling <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="last_km_when_fueling" placeholder="Enter last_km_when_fueling"  value="{{$fuelrequests->last_km_when_fueling}}" class="form-control">
          @error('last_km_when_fueling')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>


          <div class="form-group">
            <label for="inputTitle" class="col-form-label">km_used <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="km_used" placeholder="Enter last_km_when_fueling"  value="{{$fuelrequests->last_km_when_fueling}}" class="form-control">
          @error('km_used')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>



          <div class="form-group">
            <label for="inputTitle" class="col-form-label">liters_km <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="liters_km" placeholder="Enter liters_km"  value="{{$fuelrequests->liters_km}}" class="form-control">
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

                <option value="{{$vehicles->id}}" @if($fuelrequests->id == $fuelrequests->vehicle_id) selected @endif>Car-Tag {{$vehicles->tag_no}} :{{$vehicles->fueltank}}Liters: Department:{{$vehicles->department_name }}</option>
               @endforeach
            </select>
          </div>








          <div class="form-group">
            <label for="fuelstation">fuelstation</label>
            {{-- {{$brands}} --}}

            <select name="fuelstation_id" class="form-control">
                <option value="">--Select fuelstation--</option>
               {{-- @foreach(\App\Models\Fuelstation::where('id','active')->get() as $fuelstations) --}}
               @foreach($fuelstation as $fuelstations )
                <option value="{{$fuelstations->id}}" @if($fuelstations->id == $fuelrequests->fuelstation_id) selected @endif> {{$fuelstations->name}}</option>
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
