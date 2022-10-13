
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
              <th>Action</th>

               

                </tr>
                @foreach ($fuelrequest as $fuelrequests)
{{-- 
                @php
              $departments=DB::table('departments')->select('name')->where('id',$ViewsPage->department_id)->get();
    
                @endphp --}}
    
    
                    <tr>
                        
                    <td>{{$fuelrequests->id}}</td>

<td>{{$fuelrequests->user->name}}/{{$fuelrequests->user->phone}}</td>


<td>{{$fuelrequests->present_km}}</td>
<td>{{$fuelrequests->liters_km}}</td>
<td>{{$fuelrequests->last_fuel_qty}}</td>
<td>{{$fuelrequests->last_km}}</td>
<td>{{$fuelrequests->last_km_when_fueling}}</td>
<td>{{$fuelrequests->km_used}}</td>
{{-- <td>@foreach($fuelrequests->vehicles as $data){{($data->fueltank - $fuelrequests->last_km_when_fueling)}}  @endforeach</td> --}}

<td>@foreach($fuelrequests->vehicles as $data){{($data->fueltank)}}  @endforeach</td>

<td>@foreach($fuelrequests->vehicles as $data){{($data->department->name)}} @endforeach</td>
<td>{{$fuelrequests->order_number}}</td>
<td>@foreach($fuelrequests->vehicles as $data){{($data->tag_no)}}  @endforeach</td>

<td>{{$fuelrequests->Fuel_station}}</td>


                    </tr>
                @endforeach
            </table>
</div>
</body>
</html>

