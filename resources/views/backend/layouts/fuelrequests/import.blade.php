@extends('backend.layouts.master')
@section('title','E-SHOP || fuelrequests Page')
@section('main-content')
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 6 Search Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>
        <div class="container">
        <br>
            <form action="{{route('fuelrequests.report')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                <div class="row">
                <label for="from" class="col-form-label">From</label>
                    <div class="col-md-2">
                    <input type="date" class="form-control input-sm" id="from" name="from" value="{{ $from ?? '' }}">
                    </div>
                    <label for="from" class="col-form-label">To</label>
                    <div class="col-md-2">
                        <input type="date" class="form-control input-sm" id="to" name="to" value="{{ $to ?? '' }}">
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm" name="search" >Search</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="exportExcel" >Export excel</button>
                        <button type="submit" class="btn btn-primary btn-sm" name="exportPDF" >Export PDF</button>


                    </div>









                </div>
            </div>
            </form>
            <br>
            <table class="table table-dark">
                {{-- <tr> --}}


                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name/phone</th>
                            <th>Fuel Station</th>
                            {{-- <th>User</th> --}}
                            <th>Vehicle Tag No</th>
                            <th>fueltank</th>

                            <th>Present KM</th>
                            <th>Liters Collected</th>
                            <th>Previous KM</th>
                            <th>Amount</th>
                            <th>KM Covered</th>
                            <th>AVG KM/Liter</th>
                            <th>Order Number</th>
                            <th>Created At</th>



                        </tr>
                    </thead>





                {{-- </tr> --}}
                @foreach ($ViewsPage as $ViewsPages)

                <tr>
                    <td>{{$ViewsPages->id}}</td>
                    <td>{{$ViewsPages->user->name}} / {{$ViewsPages->user->phone}}</td>
                    <td>{{$ViewsPages->fuelstation->name}}</td>
                    {{-- <td>{{$fuelrequest->user->name}}</td> --}}
                    <td>
                        @foreach($ViewsPages->vehicles as $vehicle)
                            {{ $vehicle->tag_no }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($ViewsPages->vehicles as $vehicle)
                            {{ $vehicle->fueltank }} <br>
                        @endforeach
                    </td>
                    <td>{{$ViewsPages->present_km}}</td>
                    <td>{{$ViewsPages->ltr_collected}}</td>
                    <td>{{$ViewsPages->previous_km}}</td>
                    <td>₦{{ number_format($ViewsPages->amount, 2) }}</td>
                    <td>{{$ViewsPages->km_covered}}</td>
                    <td>{{ number_format($ViewsPages->avg_km_per_ltr, 2) }}</td>
                    <td>{{$ViewsPages->order_number}}</td>
                    <td>{{ $ViewsPages->created_at }}</td>


                </tr>


                @endforeach
            </table>
</div>
</body>
</html>
@endsection
