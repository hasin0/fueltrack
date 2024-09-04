@extends('backend.layouts.master')
@section('title','Fuel Stations')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            {{-- @include('backend.layouts.notification') --}}
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Fuel Station List</h6>
      <a href="{{route('fuelstation.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Fuel Station</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($fuelstation)>0)
        <table class="table table-bordered" id="fuelstations-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Name</th>
              <th>Fuel Attendant</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Fuel Attendant</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($fuelstation as $fuelstations)
                <tr>
                    <td>{{$fuelstations->id}}</td>
                    <td>{{$fuelstations->name}}</td>
                    <td>{{ $fuelstations->user ? $fuelstations->user->name : 'N/A' }}</td>
                    <td>
                        <input data-id="{{$fuelstations->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $fuelstations->status == 'active' ? 'checked' : '' }}>
                    </td>
                    <td>
                        <a href="{{route('fuelstation.edit',$fuelstations->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('fuelstation.destroy',[$fuelstations->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$fuelstations->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No fuel stations found!!! Please create fuel stations.</h6>
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
      $('#fuelstations-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4]
                }
            ]
        } );
        // Sweet alert
        function deleteData(id){

        }
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
              // alert(dataID);
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
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 'active' : 'inactive'; // Send 'active' or 'inactive'
          var fuelstation_id = $(this).data('id');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '{{ route('fuelattender.status') }}', // Use the correct route name
              data: {'status': status, 'fuelstation_id': fuelstation_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })
  </script>
@endpush
