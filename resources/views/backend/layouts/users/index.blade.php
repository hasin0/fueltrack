@extends('backend.layouts.master')
@section('title','E-SHOP || users Page')
@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            {{-- @include('backend.layouts.notification') --}}
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">users List</h6>
      <a href="{{route('users.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add users</a>
    </div>

{{--
    <form action="{{route('user.report')}}"method="POST" enctype="multipart/form-data">
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


            </div>









        </div>
    </div>
    </form> --}}
    <div class="card-body">
      <div class="table-responsive">
        @if(count($users)>0)



        <table class="table table-bordered" id="users-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Sap</th>
                <th>Phone</th>
                <th>Department</th>



                <th>Photo</th>
                <th>Join Date</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Sap</th>
                <th>Phone</th>
                <th>Department</th>



                <th>Photo</th>
                <th>Join Date</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>


          <tbody>
            @foreach($users as $user)

            @php
              $department=DB::table('departments')->select('name')->where('id',$user->department_id)->get();

            @endphp

            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->sap}}</td>
                <td>{{$user->phone}}</td>

                <td>{{$user->department->name}}</td>
                {{-- <td> {{ucfirst($user->department)}}</td> --}}





                <td>
                    @if($user->photo)
                        <img src="{{$user->photo}}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{$user->photo}}">
                    @else
                        <img src="{{asset('backend/img/avatar.png')}}" class="img-fluid rounded-circle" style="max-width:50px" alt="avatar.png">
                    @endif
                </td>
                <td>{{(($user->created_at)? $user->created_at->diffForHumans() : '')}}</td>
                {{-- <td>{{$user->role}}</td> --}}

                <td>
                    @if(!empty($user->getRoleNames()))
                      @foreach($user->getRoleNames() as $v)
                         <label class="badge badge-success">{{ $v }}</label>
                      @endforeach
                    @endif
                  </td>
                <td>

                    <input value="{{$user->id}}" name="toogle" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status =='active' ? 'checked' : '' }}>

                    {{-- @if($user->status=='active')
                        <span class="badge badge-success">{{$user->status}}</span>
                    @else
                        <span class="badge badge-warning">{{$user->status}}</span>
                    @endif --}}
                </td>
                <td>
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('users.destroy',[$user->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$user->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
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
                          <form method="post" action="{{ route('users.destroy',$user->id) }}">
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
        {{-- <span style="float:right">{{$users->links()}}</span> --}}
        @else
          <h6 class="text-center">No users found!!! Please create users</h6>
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

{{--

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

 --}}








  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>



  <script>

      $('#users-dataTable').DataTable( {
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
      $('input[name=toogle]').change(function() {
          var mode = $(this).prop('checked'); //== true ? 1 : 0;
         // alert(mode)
          var id = $(this).val();
        //  alert(id);

          $.ajax({
              url:"{{route('user.status')}}",

              type: "POST",
              // dataType: "json",
              data:{
                  // 'status': status, 'users_id': users_id
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







@endpush










