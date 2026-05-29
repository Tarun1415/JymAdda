@extends('admin.layouts.app')

@section('content')

  <!-- [ breadcrumb ] start -->
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Staff Panel</a></li>
            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
          </ul>
        </div>
        <div class="col-md-12">
          <div class="page-header-title">
            <h2 class="mb-0">Welcome, {{ $user->name }}! 👋</h2>
            <p class="text-muted mt-2">Here is your blogging activity overview.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ breadcrumb ] end -->

  <!-- [ Main Content ] start -->
  <div class="row">
    
    <div class="col-md-6 col-xl-4">
      <div class="card" style="border-left: 4px solid #0dcaf0;">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="mb-2 f-w-600 text-info">Total Blogs Posted</h6>
              <h3 class="mb-0 text-info">{{ $totalBlogs ?? 0 }}</h3>
            </div>
            <div class="avtar bg-light-info text-info">
              <i class="ti ti-book f-24"></i>
            </div>
          </div>
          <div class="mt-3">
              <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-info text-white">View All Blogs</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>

@endsection
