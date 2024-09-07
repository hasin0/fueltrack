@extends('Driver.layouts.master')
@section('title','E-SHOP || DASHBOARD')
@section('main-contents')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Your Fuel Summary -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center"> <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Your Fuel Summary</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Total Liters Collected: {{ $totalLitersCollected }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Total Amount Spent: ₦{{ number_format($totalAmountSpent, 2) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-gas-pump fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Fuel Requests -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Fuel Requests</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Your Requests: {{ $fuelrequest->count() }}</div>
                {{-- You can remove the department total if not needed for the driver --}}
                {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">Department Total: {{ $fuelrequestC->count() }}</div> --}}
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Vehicles Used -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vehicles Used</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fuelDataByVehicle->count() }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-car fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>




      <!-- Total Liters Collected (Corrected) -->



      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Liters Collected</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $totalLitersCollected }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-car fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Liters Collected</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalLitersCollected }}</div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-gas-pump fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- Total Amount Spent -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Amount Spent</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">₦{{ number_format($totalAmountSpent, 2) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    {{-- End of First Row --}}

    <div class="row">

      <!-- Area Chart (You can customize this section) -->
      <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart (You can customize this section) -->
      <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
          </div>
          <div class="card-body" style="overflow:hidden">
            <div id="pie_chart" style="width:350px; height:320px;">
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End of Second Row --}}

  </div>
@endsection
