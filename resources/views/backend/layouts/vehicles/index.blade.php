@extends('backend.layouts.master')
@section('title','E-SHOP || vehicles Page')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            {{-- @include('backend.layouts.notification') --}}
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">vehicle List</h6>
      <a href="{{route('vehicle.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add vehicles</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($vehicles)>0)



        <table class="table table-bordered" id="vehicles-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Name</th>
              <th>Model</th>
              <th>Plate_no</th>
              <th>TagN</th>
              <th>Fueltank_Size</th>
              <th>Department</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Model</th>
                <th>Plate_no</th>
                <th>TagN</th>
                <th>Fueltank_Size</th>
                <th>Department</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>


          <tbody>
            @foreach($vehicles as $vehicles)
                <tr>
                    <td>{{$vehicles->id}}</td>
                    <td>{{$vehicles->name}}</td>
                    <td>{{$vehicles->model}}</td>
                    <td>{{$vehicles->plate_no}}</td>
                    <td>{{$vehicles->tag_no}}</td>
                    <td>{{$vehicles->fueltank}}</td>
                    <td>{{$vehicles->department}}</td>



                    {{-- <td>
                        @if($vehicles->photo)
                            <img src="{{$vehicles->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$vehicles->photo}}">
                        @else
                            <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                        @endif
                    </td> --}}

                    <td>

                        {{-- <input  type="checkbox"   value="{{$vehicles->id}}" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $vehicles->status == 'active' ? 'checked' : '' }}> --}}

                        {{-- @if($vehicles->status=='active')

                        <input  type="checkbox"   value="{{$vehicles->id}}" name="toogle" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $vehicles->status == 'active' ? 'checked' : '' }}>

                            {{-- <span class="badge badge-success">{{$vehicles->status}}</span> --}}
                        {{-- @else --}}

                        <input data-id="{{$vehicles->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $vehicles->status ? 'checked' : '' }}>


                        {{-- <input data-id="{{$vehicles->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $vehicles->status ? 'checked' : '' }}> --}}
                        {{-- @endif --}}
                    </td>
                    <td>
                        <a href="{{route('vehicle.edit',$vehicles->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('vehicle.destroy',[$vehicles->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$vehicles->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
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
            @endforeach
          </tbody>
        </table>
        {{-- <span style="float:right">{{$vehicles->links()}}</span> --}}
        @else
          <h6 class="text-center">No vehicle found!!! Please create vehicles</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
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

      $('#vehicles-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
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
          var status = $(this).prop('checked') == true ? 1 : 0;
          alert(status)
          var vehicle_id = $(this).data('id');

          $.ajax({
              type: "POST",
              dataType: "json",
              url: '/vehicleStatus',
              data: {'status': status, 'vehicle_id': vehicle_id},
              success: function(data){
                console.log(data.success)
              }
          });
      })
    })


    // $('input[name=toggle]').change(function () {
    //     var mode=$(this).prop('checked');
    //     alert(mode)

    // });
  </script>
@endpush
