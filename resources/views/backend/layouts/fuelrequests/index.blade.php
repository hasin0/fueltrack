@extends('backend.layouts.master')
@section('title','Fuel Requests Page')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            {{-- @include('backend.layouts.notification') --}}
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Fuel Requests List</h6>
      <a href="{{route('fuelrequests.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Fuel Request"><i class="fas fa-plus"></i> Add Fuel Request</a>
    </div>

    <div class="card-body">
        {{-- Display the fuel price --}}
        <div class="mb-3">
            <strong>Current Fuel Price:</strong>
            {{ $fuelPrice ? $fuelPrice->value : 'Not set' }}
        </div>



        {{-- Search Form --}}
        <form method="GET" action="{{ route('fuelrequests.index') }}">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="search" class="form-control" placeholder="Search by Plate No or Tag No" value="{{ request('search') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

    <div class="card-body">
      <div class="table-responsive">
        @if(count($fuelrequests)>0)
        <table class="table table-bordered" id="fuelrequests-dataTable" width="100%" cellspacing="0">
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
                    <th>HOD Approval</th>
                    <th>Admin Approval</th>
                    <th>Order Number</th>
                    <th>Fuel Station Approval</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
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
                    <th>HOD Approval</th>
                    <th>Admin Approval</th>
                    <th>Order Number</th>
                    <th>Fuel Station Approval</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($fuelrequests as $fuelrequest)
                <tr>
                    <td>{{$fuelrequest->id}}</td>
                    <td>{{$fuelrequest->user->name}} / {{$fuelrequest->user->phone}}</td>
                    <td>{{$fuelrequest->fuelstation->name}}</td>
                    {{-- <td>{{$fuelrequest->user->name}}</td> --}}
                    <td>
                        @foreach($fuelrequest->vehicles as $vehicle)
                            {{ $vehicle->tag_no }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($fuelrequest->vehicles as $vehicle)
                            {{ $vehicle->fueltank }} <br>
                        @endforeach
                    </td>
                    <td>{{$fuelrequest->present_km}}</td>
                    <td>{{$fuelrequest->ltr_collected}}</td>
                    <td>{{$fuelrequest->previous_km}}</td>
                    <td>₦{{ number_format($fuelrequest->amount, 2) }}</td>
                    <td>{{$fuelrequest->km_covered}}</td>
                    <td>{{ number_format($fuelrequest->avg_km_per_ltr, 2) }}</td>
                    <td>
                        <input value="{{$fuelrequest->id}}" name="toogle2" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequest->HOD_approval =='active' ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input value="{{$fuelrequest->id}}" name="toogle1" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequest->Admin_approval =='active' ? 'checked' : '' }}>
                    </td>
                    <td>{{$fuelrequest->order_number}}</td>
                    <td>
                        <input value="{{$fuelrequest->id}}" name="toogle3" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="issued" data-off="Notissued" {{ $fuelrequest->Fuel_station_approval =='issued' ? 'checked' : '' }}>
                    </td>
                    <td>
                        <a href="{{route('fuelrequests.edit',$fuelrequest->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('fuelrequests.destroy',[$fuelrequest->id])}}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm dltBtn" data-id={{$fuelrequest->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h6 class="text-center">No fuel requests found!!! Please create a fuel request</h6>
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
  </style>
@endpush

@push('scripts')
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      $('#fuelrequests-dataTable').DataTable( {} );
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
  <script>
    $(function() {
      $('input[name=toogle1]').change(function() {
          var mode = $(this).prop('checked');
          var id = $(this).val();
          $.ajax({
              url:"{{route('admin.status')}}",
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
                      alert('Please wait for approval')
                  }
              }
          });
      })
    })
  </script>
<script>
    $(function() {
      $('input[name=toogle2]').change(function() {
          var mode = $(this).prop('checked');
          var id = $(this).val();
          $.ajax({
              url:"{{route('hod.status')}}",
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
                      alert('Please wait for approval')
                  }
              }
          });
      })
    })
  </script>
<script>
    $(function() {
      $('input[name=toogle3]').change(function() {
          var mode = $(this).prop('checked');
          var id = $(this).val();
          $.ajax({
              url:"{{route('FSA.status')}}",
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
                      alert('Please wait for approval')
                  }
              }
          });
      })
    })
  </script>
@endpush
