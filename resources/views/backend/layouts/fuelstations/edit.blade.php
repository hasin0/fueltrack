@extends('backend.layouts.master')

@section('title','Fuel Station Edit')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Fuel Station</h5>
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

        <form method="post" action="{{route('fuelstation.update', $fuelstation->id)}}">
            {{csrf_field()}}
            @method('patch')

            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{ old('name', $fuelstation->name) }}" class="form-control">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="user_id">Fuel Station Attendant</label>
                <select name="user_id" class="form-control">
                    <option value="">--Select Attendant--</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ ($fuelstation->user_id == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->roles->first()->name }})
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
