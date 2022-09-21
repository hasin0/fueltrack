<!DOCTYPE html>
<html lang="en">

@include('Driver.layouts.head')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('Driver.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('Driver.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-contents')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('Driver.layouts.footer')

</body>

</html>
