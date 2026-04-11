@extends('admin.layouts.app')

@section('content')

  <!-- [ breadcrumb ] start -->
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
          </ul>
        </div>
        <div class="col-md-12">
          <div class="page-header-title">
            <h2 class="mb-0">Super Admin Dashboard</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ breadcrumb ] end -->

  <!-- [ Main Content ] start -->
  <div class="row">
    
    <!-- Summary Cards -->
    <div class="col-md-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="mb-2 f-w-400 text-muted">Total Platforms Gyms</h6>
              <h4 class="mb-0">{{ $totalGyms ?? 0 }}</h4>
            </div>
            <div class="avtar bg-light-primary text-primary">
              <i class="ti ti-building f-24"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="mb-2 f-w-400 text-muted">Total Partners</h6>
              <h4 class="mb-0">{{ $totalPartners ?? 0 }}</h4>
            </div>
            <div class="avtar bg-light-success text-success">
              <i class="ti ti-users f-24"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection