@extends('HOD.layouts.master')
@section('title','E-SHOP || vehicles Page')
@section('main-contents')

<!DOCTYPE html>
<html>
<head>
    <title>Laravel Update User Status Using Toggle Button Example - ItSolutionStuff.com</title>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}
</head>
<body>
    <div class="container">
        <h1>Laravel Update User Status Using Toggle Button Example - ItSolutionStuff.com</h1>
        <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
               </tr>
            </thead>
            <tbody>
                @foreach($fuelrequest as $fuelrequests)
                <tr>
                <td>{{$fuelrequests->id}}</td>

                <td>{{$fuelrequests->user->name}}/{{$fuelrequests->user->phone}}</td>


                <td>{{$fuelrequests->present_km}}</td>
                <td>{{$fuelrequests->liters_km}}</td>
                <td>{{$fuelrequests->last_fuel_qty}}</td>
                <td>{{$fuelrequests->last_km}}</td>
                <td>{{$fuelrequests->last_km_when_fueling}}</td>
                <td>{{$fuelrequests->km_used}}</td>
                <td>@foreach($fuelrequests->vehicles as $data){{($data->fueltank - $fuelrequests->last_km_when_fueling)}}  @endforeach</td>
                <td>@foreach($fuelrequests->vehicles as $data){{($data->department)}} @endforeach</td>
                <td>{{$fuelrequests->order_number}}</td>
                <td>{{$fuelrequests->Fuel_station}}</td>






                {{-- <td>
                    @if($fuelrequests->photo)
                        <img src="{{$fuelrequests->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$fuelrequests->photo}}">
                    @else
                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                    @endif
                </td> --}}

                <td>
                    <input value="{{$fuelrequests->id}}" name="toogle1" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequests->Admin_approval =='active' ? 'checked' : '' }}>

                </td>

                <td>
                    <input value="{{$fuelrequests->id}}" name="toogle" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequests->HOD_approval =='active' ? 'checked' : '' }}>

                </td>


                <td>
                    <input value="{{$fuelrequests->id}}" name="toogle" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequests->Fuel_station_approval =='active' ? 'checked' : '' }}>

                </td>

                <td>
                    <a href="{{route('fuelrequests.edit',$fuelrequests->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('fuelrequests.destroy',[$fuelrequests->id])}}">
                      @csrf
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$fuelrequests->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                {{-- Delete Modal --}}
                {{-- <div class="modal fade" id="delModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="#delModal{{$user->id}}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="#delModal{{$user->id}}Label">Delete user</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="{{ route('vehicle.destroy',$user->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="margin:auto; text-align:center">Parmanent delete user</button>
                          </form>
                        </div>
                      </div>
                    </div>
                </div> --}}
            </tr>

                     </td>
                  </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
  $(function() {
    $('input[name=toogle1]').change(function() {
        var mode = $(this).prop('checked'); //== true ? 1 : 0;
       // alert(mode)
        var id = $(this).val();
      //  alert(id);

        $.ajax({
            url:"{{route('admin.status')}}",

            type: "POST",
            // dataType: "json",
            data:{
                // 'status': status, 'vehicle_id': vehicle_id
                _token:'{{csrf_token()}}',
                mode:mode,
                id:id,
            },
            success:function(response){
                if (response.status) {

                    alert(response.msg);

                }
                else {
                    alert('Please wait for approval')
                }
            }
        });
    })
  })




















</script>
</html>

@endsection


