@extends('backend.layouts.master')

@section('title','E-SHOP || Vehicle Create')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit vehicle</h5>
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
      <form method="post" action="{{route('vehicle.update',$vehicle->id)}}">
        {{csrf_field()}}
        @method('patch')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter name"  value="{{($vehicle->name)}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
            <label for="inputTitle" class="col-form-label">Model <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="model" placeholder="Enter model"  value="{{$vehicle->model}}" class="form-control">
          @error('model')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="inputTitle" class="col-form-label">Plate-Number <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="plate_no" placeholder="Enter plate_no"  value="{{$vehicle->plate_no}}" class="form-control">
          @error('plate_no')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>

          <div class="form-group">
            <label for="inputTitle" class="col-form-label">TAGN <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="tag_no" placeholder="Enter tag_no"  value="{{$vehicle->tag_no}}" class="form-control">
          @error('tag_no')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>




          <div class="form-group">
            <label for="inputTitle" class="col-form-label">FuelTank <span class="text-danger">*</span></label>
          <input id="inputTitle" type="number" name="fueltank" placeholder="Enter fueltank"  value="{{$vehicle->fueltank}}" class="form-control">
          @error('fueltank')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>




          <div class="form-group">
            <label for="department_id">department</label>
            {{-- {{$brands}} --}}

            <select name="department_id" class="form-control">
                {{-- <option value="">--Select vehicle--</option> --}}
               {{-- @foreach(\App\Models\department::where('id',$department->id)->get() as $departments) --}}
               @foreach($department as $departments )
                <option value="{{$departments->id}}" @if($departments->id == $vehicle->department_id) selected @endif> {{$departments->name}}</option>

               @endforeach
            </select>
          </div>





          <div class="form-group">
            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
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
