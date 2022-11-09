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
                    <input type="date" class="form-control input-sm" id="from" name="from">
                    </div>
                    <label for="from" class="col-form-label">To</label>
                    <div class="col-md-2">
                        <input type="date" class="form-control input-sm" id="to" name="to">
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
                <tr>
                <th>S.N.</th>
              <th>Name/phone</th>

              <th>present_km</th>
              <th>liters_km</th>
              <th>last_fuel_qty</th>
              <th>last_km</th>
              <th>last_km_when_fueling</th>
              <th>km_used</th>
              <th>fueltank</th>
              <th>department</th>
              <th>order_number</th>
              <th>TAG-NO</th>

              <th>Fuel_station</th>
              <th>Admin_approval</th>
              <th>HOD_approval</th>
              <th>Fuel_station_approval</th>
              <th>created_at</th>

               

                </tr>
                @foreach ($ViewsPage as $ViewsPages)
{{-- 
                @php
              $departments=DB::table('departments')->select('name')->where('id',$ViewsPage->department_id)->get();
    
                @endphp --}}
    
    
                    <tr>
                        
                    <td>{{$ViewsPages->id}}</td>

<td>{{$ViewsPages->user->name}}/{{$ViewsPages->user->phone}}</td>


<td>{{$ViewsPages->present_km}}</td>
<td>{{$ViewsPages->liters_km}}</td>
<td>{{$ViewsPages->last_fuel_qty}}</td>
<td>{{$ViewsPages->last_km}}</td>
<td>{{$ViewsPages->last_km_when_fueling}}</td>
<td>{{$ViewsPages->km_used}}</td>
{{-- <td>@foreach($ViewsPages->vehicles as $data){{($data->fueltank - $ViewsPages->last_km_when_fueling)}}  @endforeach</td> --}}

<td>@foreach($ViewsPages->vehicles as $data){{($data->fueltank)}}  @endforeach</td>

<td>@foreach($ViewsPages->vehicles as $data){{($data->department->name)}} @endforeach</td>
<td>{{$ViewsPages->order_number}}</td>
<td>@foreach($ViewsPages->vehicles as $data){{($data->tag_no)}}  @endforeach</td>

<td>{{$ViewsPages->Fuel_station}}</td>
<td>
  <input value="{{$ViewsPages->id}}" name="toogle1" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $ViewsPages->Admin_approval =='active' ? 'checked' : '' }}>

</td>

<td>
  <input value="{{$ViewsPages->id}}" name="toogle2" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $ViewsPages->HOD_approval =='active' ? 'checked' : '' }}>

</td>


<td>
  <input value="{{$ViewsPages->id}}" name="toogle3" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="issued" data-off="Notissued" {{ $ViewsPages->Fuel_station_approval =='issued' ? 'checked' : '' }}>

</td>
<td>{{$ViewsPages->created_at}}</td>



                    </tr>
                @endforeach
            </table>
</div>
</body>
</html>
@endsection

