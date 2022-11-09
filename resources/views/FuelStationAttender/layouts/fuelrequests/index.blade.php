@extends('FuelStationAttender.layouts.master')
@section('title','E-SHOP || fuelrequests Page')
@section('main-contents')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            {{-- @include('backend.layouts.notification') --}}
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">fuelrequests List</h6>
      <a href="{{route('fuelattender-fuelrequests.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add fuelrequests</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($fuelstation)>0)



        <table class="table table-bordered" id="fuelrequests-dataTable" width="100%" cellspacing="0">
          <thead>
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
              <th>Fuel_station</th>
              <th>Admin_approval</th>
              <th>HOD_approval</th>
              <th>FuelStationAttender_approval</th>
              <th>Action</th>


            </tr>
          </thead>
          <tfoot>
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
              <th>Fuel_station</th>
              <th>Admin_approval</th>
              <th>HOD_approval</th>
              <th>FuelStationAttender_approval</th>
              <th>Action</th>

              </tr>
          </tfoot>


          <tbody>
            @foreach($fuelstation as $fuelrequests)

             {{-- @php
            $vehicle_fueltank=DB::table('vehicles')->where('id',$fuelrequests->vehicle_id)->pluck('fueltank');
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
                    <td>{{$fuelrequests->name}}</td>






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
                        <input value="{{$fuelrequests->id}}" name="toogle2" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $fuelrequests->FuelStationAttender_approval =='active' ? 'checked' : '' }}>

                    </td>


                    <td>
                        <input value="{{$fuelrequests->id}}" name="toogle3" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="issued" data-off="Notissued" {{ $fuelrequests->Fuel_station_approval =='issued' ? 'checked' : '' }}>

                    </td>

                    <td>
                        <a href="{{route('fuelattender-fuelrequests.edit',$fuelrequests->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form metFuelStationAttender="POST" action="{{route('fuelattender-fuelrequests.destroy',[$fuelrequests->id])}}">
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
                              <form metFuelStationAttender="post" action="{{ route('vehicle.destroy',$user->id) }}">
                                @csrf
                                @metFuelStationAttender('delete')
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
        {{-- <span style="float:right">{{$fuelrequests->links()}}</span> --}}
        @else
          <h6 class="text-center">No vehicle found!!! Please create fuelrequests</h6>
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

      $('#fuelrequests-dataTable').DataTable( {
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
              url:"{{route('vehicle.status')}}",

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









<script>
    $(function() {
      $('input[name=toogle2]').change(function() {
          var mode = $(this).prop('checked'); //== true ? 1 : 0;
         // alert(mode)
          var id = $(this).val();
        //  alert(id);

          $.ajax({
              url:"{{route('fuelattender.status')}}",

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









<script>
    $(function() {
      $('input[name=toogle3]').change(function() {
          var mode = $(this).prop('checked'); //== true ? 1 : 0;
         // alert(mode)
          var id = $(this).val();
        //  alert(id);

          $.ajax({
              url:"{{route('fuelattender.status')}}",

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











@endpush










