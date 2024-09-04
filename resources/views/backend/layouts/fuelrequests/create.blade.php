@extends('backend.layouts.master')

@section('title','E-SHOP || Fuel Requests Create')

@section('main-content')

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

        <form method="post" action="{{route('fuelrequests.store')}}">
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
                <input id="ltr_collected" type="number" name="ltr_collected" placeholder="Enter Last Fuel Quantity"  value="{{old('ltr_collected')}}" class="form-control">
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

            {{-- <div class="form-group">
                <label for="amount" class="col-form-label">Fuel Cost <span class="text-danger">*</span></label>
                <input id="amount" type="number" name="amount" placeholder="Enter Fuel Cost"  value="{{old('amount')}}" class="form-control">
                @error('amount')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div> --}}

            {{-- <div class="form-group">
                <label for="km_covered" class="col-form-label">KM Covered <span class="text-danger">*</span></label>
                <input id="km_covered" type="number" name="km_covered" placeholder="Enter KM Covered"  value="{{old('km_covered')}}" class="form-control">
                @error('km_covered')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div> --}}

            {{-- <div class="form-group">
                <label for="AVG_KM/LTR" class="col-form-label">Average KM/Liter <span class="text-danger">*</span></label>
                <input id="AVG_KM/LTR" type="number" name="AVG_KM/LTR" placeholder="Enter Average KM/Liter"  value="{{old('AVG_KM/LTR')}}" class="form-control">
                @error('AVG_KM/LTR')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div> --}}

            {{-- <div class="form-group">
                <label for="order_number" class="col-form-label">Order Number <span class="text-danger">*</span></label>
                <input id="order_number" type="text" name="order_number" placeholder="Enter Order Number"  value="{{old('order_number')}}" class="form-control">
                @error('order_number')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div> --}}

            <div class="form-group">
                <label for="vehicle_id">Vehicle Name & Fuel Tank</label>
                <select name="vehicle_id" class="form-control">
                    <option value="">--Select Vehicle--</option>
                    @foreach($vehicle as $vehicles)
                        <option value="{{$vehicles->id}}">Car-Tag {{$vehicles->tag_no}} :{{$vehicles->fueltank}} Liters : {{$vehicles->department}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" class="form-control">
                    @foreach($department as $dept)
                        <option value="{{$dept->id}}"> {{$dept->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fuelstation_id">Fuel Station</label>
                <select name="fuelstation_id" class="form-control">
                    <option value="">--Select Fuel Station--</option>
                    @foreach($fuelstation as $station)
                        <option value="{{$station->id}}"> {{$station->name}}</option>
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
