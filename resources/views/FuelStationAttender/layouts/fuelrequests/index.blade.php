@extends('FuelStationAttender.layouts.master')
@section('title','Fuel Requests')
@section('main-contents')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            {{-- @include('backend.layouts.notification') --}}
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Fuel Requests List</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(isset($fuelrequests) && count($fuelrequests) > 0) <table class="table table-bordered" id="fuelrequests-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Name/Phone</th>
              <th>Vehicle</th>
              <th>Fuel Tank (Liters)</th>
              <th>Liters Requested</th>
              <th>Department</th>
              <th>Order Number</th>
              <th>Fuel Station</th>
              <th>Admin Approval</th>
              <th>HOD Approval</th>
              <th>Fuel Attendant Approval</th>
              {{-- <th>Action</th> --}}
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Name/Phone</th>
              <th>Vehicle</th>
              <th>Fuel Tank (Liters)</th>
              <th>Liters Requested</th>
              <th>Department</th>
              <th>Order Number</th>
              <th>Fuel Station</th>
              <th>Admin Approval</th>
              <th>HOD Approval</th>
              <th>Fuel Attendant Approval</th>
              {{-- <th>Action</th> --}}
            </tr>
          </tfoot>
          <tbody>
            @foreach($fuelrequests as $fuelrequest)
                <tr>
                    <td>{{$fuelrequest->id}}</td>
                    <td>{{$fuelrequest->user->name}} / {{$fuelrequest->user->phone}}</td>
                    <td>@foreach($fuelrequest->vehicles as $vehicle){{ $vehicle->name }} @endforeach</td>
                    <td>@foreach($fuelrequest->vehicles as $vehicle){{ $vehicle->fueltank }} @endforeach</td>
                    <td>{{$fuelrequest->ltr_collected}}</td>
                    <td>@foreach($fuelrequest->vehicles as $vehicle){{ $vehicle->department->name }} @endforeach</td>
                    <td>{{$fuelrequest->order_number}}</td>
                    <td>{{$fuelrequest->fuelstation->name}}</td>
                    <td>
                        <input value="{{$fuelrequest->id}}" name="toogle1" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Approved" data-off="Pending" {{ $fuelrequest->Admin_approval =='active' ? 'checked' : '' }} disabled>
                    </td>
                    <td>
                        <input value="{{$fuelrequest->id}}" name="toogle2" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Approved" data-off="Pending" {{ $fuelrequest->HOD_approval =='active' ? 'checked' : '' }} disabled>
                    </td>
                    <td>
                        <input value="{{$fuelrequest->id}}" name="toogle3" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Issued" data-off="Not Issued" {{ $fuelrequest->Fuel_station_approval =='issued' ? 'checked' : '' }}>
                    </td>
                    {{-- <td>
                        <a href="{{route('fuelattender-fuelrequests.edit',$fuelrequest->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    </td> --}}
                </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No fuel requests found or you are not associated with a fuel station.</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
      .zoom {
        transition: transform .2s; /* Animation */
      }
      .zoom:hover {
        transform: scale(3.2);
      }
  </style>
@endpush

@push('scripts')
  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      $('#fuelrequests-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8,9,10,11]
                }
            ]
        } );
  </script>
  <script>
    $(function() {
      $('input[name=toogle3]').change(function() {
          var mode = $(this).prop('checked');
          var id = $(this).val();
          $.ajax({
              url:"{{route('fuelattender.status')}}",
              type: "POST",
              data:{
                  _token:'{{csrf_token()}}',
                  mode:mode,
                  id:id,
              },
              success:function(response){
                  if (response.status) {
                      alert(response.msg);
                  } else {
                      alert('Error updating status.');
                  }
              }
          });
      })
    })
  </script>
@endpush
