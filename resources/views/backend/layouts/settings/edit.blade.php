@extends('backend.layouts.master')

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Settings</h3>
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="fuel_price">Fuel Price:</label>
                            <input type="number" step="0.01" name="fuel_price" id="fuel_price" class="form-control" value="{{ old('fuel_price', $fuelPrice ? $fuelPrice->value : '') }}">
                            @error('fuel_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
