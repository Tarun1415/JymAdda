@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">Platform Gym Network</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 mb-4">
    <div class="card bg-white border-0 shadow-sm">
      <div class="card-body py-3">
        <form action="{{ route('admin.gyms.index') }}" method="GET" class="row g-3 align-items-center">
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0"><i class="ti ti-search text-muted"></i></span>
              <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by Gym Name, City, UUID, or Partner..." value="{{ request('search') }}">
            </div>
          </div>
          <div class="col-md-3">
            <select name="status" class="form-select">
              <option value="">All Statuses</option>
              <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Approval</option>
              <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active (Published)</option>
              <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
          </div>
          <div class="col-md-4 text-md-end">
            <button type="submit" class="btn btn-primary px-4"><i class="ti ti-filter me-2"></i>Filter Results</button>
            @if(request()->has('search') || request()->has('status'))
              <a href="{{ route('admin.gyms.index') }}" class="btn btn-light ms-2">Clear</a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover table-striped mb-0 align-middle">
            <thead class="table-light text-uppercase font-monospace text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
              <tr>
                <th>Image</th>
                <th>Gym Name</th>
                <th>City</th>
                <th>Partner Owner</th>
                <th>Status</th>
                <th>Location</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($gyms as $gym)
              <tr>
                <td>
                  <img src="{{ $gym->gym_image ? asset($gym->gym_image) : asset('assets/images/user/avatar-2.jpg') }}" alt="logo" class="img-radius wid-40">
                </td>
                <td>
                  <strong>{{ $gym->gym_name }}</strong><br>
                  <small class="text-muted">{{ $gym->mobile }}</small>
                </td>
                <td>{{ $gym->city }}</td>
                <td>
                  @if($gym->partner)
                    {{ $gym->partner->name }} <br>
                    <small class="text-primary">#{{ $gym->partner_id }}</small>
                  @else
                    <span class="text-muted">Unassigned/Deleted</span>
                  @endif
                </td>
                <td>
                  @if($gym->status === 'active')
                    <span class="badge bg-light-success text-success">Active / Published</span>
                  @elseif($gym->status === 'rejected')
                    <span class="badge bg-light-danger text-danger">Rejected</span>
                  @else
                    <span class="badge bg-light-warning text-warning">Pending Review</span>
                  @endif
                </td>
                <td>{{ $gym->state }}, {{ $gym->pincode }}</td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.gyms.edit', $gym) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit Gym">
                      <i class="ti ti-edit"></i> Edit
                    </a>
                    
                    @if(auth()->user()->role === 'admin')
                    <form action="{{ route('admin.gyms.destroy', $gym) }}" method="POST" class="d-inline" onsubmit="return confirm('WARNING: Are you absolutely sure you want to permanently delete this listing?');">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete listing">
                        <i class="ti ti-trash"></i>
                      </button>
                    </form>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-5">
                  <div class="text-muted">
                    <i class="ti ti-building opacity-50 mb-2" style="font-size: 3rem;"></i>
                    <h5 class="mt-2">No Gyms Found</h5>
                    <p>Try clearing your search filters or check back later.</p>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer bg-white border-top-0 pt-4">
        {{ $gyms->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
