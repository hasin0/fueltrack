<!DOCTYPE html>
<html>
<head>
    <title>Laravel Update User Status Using Toggle Button Example - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
               @foreach($users as $user)
                  <tr>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->email }}</td>
                     <td>

                        <input value="{{$user->id}}" name="toogle" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status =='active' ? 'checked' : '' }}>

                        {{-- <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}> --}}
                     </td>
                  </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</body>




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




{{-- <script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/userStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script> --}}
</html>
