<!DOCTYPE html>
<html lang="en">

@include('HOD.layouts.head')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('HOD.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('HOD.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-contents')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('HOD.layouts.footer')

</body>

</html>
