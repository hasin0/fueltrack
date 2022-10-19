@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit User</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.update',$user->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name</label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter name"  value="{{$user->name}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" name="email" placeholder="Enter email"  value="{{$user->email}}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>




        <div class="form-group">
            <label for="inputSap" class="col-form-label">Sap</label>
          <input id="inputSap" type="number" name="sap" placeholder="Enter Sap"  value="{{$user->sap}}" class="form-control">
          @error('sap')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>



        <div class="form-group">
            <label for="inputPhone" class="col-form-label">Phone</label>
          <input id="inputPhone" type="number" name="phone" placeholder="Enter phone no"  value="{{$user->phone}}" class="form-control">
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>












        {{-- <div class="form-group">
            <label for="inputPassword" class="col-form-label">Password</label>
          <input id="inputPassword" type="password" name="password" placeholder="Enter password"  value="{{$user->password}}" class="form-control">
          @error('password')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        @php
        $department=DB::table('departments')->select('id','name')->get();
        @endphp



         <div class="form-group">
            <label for="department_id">department</label>

            <select name="department_id" class="form-control">


               @foreach($department as $department )
                <option value="{{$department->id}}"> {{$department->name}}</option>
               @endforeach
            </select>
          </div>






        {{-- @php
        $roles=DB::table('roles')->select('id')->where('id',$role->id)->get();
        // dd($roles);
        @endphp --}}
        {{-- @php
        $roles=DB::table('roles')->select('name')->get();
        @endphp --}}
        {{-- <div class="form-group">

                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
           @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div> --}}


          <div class="form-group">
            <strong>Role:</strong>
            <br/>
            @foreach($roles as $value)
                <label>{{ Form::checkbox('roles[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
        </div>




      

          <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Active</option>
                <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Inactive</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush
