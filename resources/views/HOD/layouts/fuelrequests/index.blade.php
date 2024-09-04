@extends('HOD.layouts.master')
@section('title','E-SHOP || Fuel Requests Page')
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
      <a href="{{route('HOD-fuelrequests.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Fuel Requests</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($fuelrequest)>0)
        <table class="table table-bordered" id="fuelrequests-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Driver Name</th>
              <th>Vehicle Tag No</th>
              <th>Fuel Station</th>
              <th>Present KM</th>
              <th>Liters Collected</th>
              <th>Previous KM</th>
              <th>Amount (₦)</th>
              <th>KM Covered</th>
              <th>AVG KM/Liter</th>
              <th>HOD Approval</th>
              <th>Admin Approval</th>
              <th>Fuel Station Approval</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Driver Name</th>
              <th>Vehicle Tag No</th>
              <th>Fuel Station</th>
              <th>Present KM</th>
              <th>Liters Collected</th>
              <th>Previous KM</th>
              <th>Amount (₦)</th>
              <th>KM Covered</th>
              <th>AVG KM/Liter</th>
              <th>HOD Approval</th>
              <th>Admin Approval</th>
              <th>Fuel Station Approval</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($fuelrequest as $fuelrequests)
                <tr>
                    <td>{{$fuelrequests->id}}</td>
                    <td>{{$fuelrequests->user->name}}</td>
                    <td>{{ $fuelrequests->vehicles->first()->tag_no }}</td>
                    <td>{{$fuelrequests->fuelstation->name}}</td>
                    <td>{{$fuelrequests->present_km}}</td>
                    <td>{{$fuelrequests->ltr_collected}}</td>
                    <td>{{$fuelrequests->previous_km}}</td>
                    <td>₦{{ number_format($fuelrequests->amount, 2) }}</td>
                    <td>{{$fuelrequests->km_covered}}</td>
                    <td>{{ number_format($fuelrequests->avg_km_per_ltr, 2) }}</td>
                    <td>
                        <input value="{{$fuelrequests->id}}" name="toogle2" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequests->HOD_approval =='active' ? 'checked' : '' }}>
                    </td>
                    <td>
                        @if($fuelrequests->Admin_approval == 'active')
                            <span class="badge badge-success">Approved</span>
                        @elseif($fuelrequests->Admin_approval == 'inactive')
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if($fuelrequests->Fuel_station_approval == 'issued')
                            <span class="badge badge-success">Issued</span>
                        @elseif($fuelrequests->Fuel_station_approval == 'Notissued')
                            <span class="badge badge-warning">Not Issued</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('HOD-fuelrequests.edit',$fuelrequests->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('HOD-fuelrequests.destroy',[$fuelrequests->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$fuelrequests->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No fuel requests found!!! Please create a fuel request.</h6>
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
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      $('#fuelrequests-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );
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
      $('input[name=toogle2]').change(function() {
          var mode = $(this).prop('checked');
          var id = $(this).val();
          $.ajax({
              url:"{{route('hods.status')}}",
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
