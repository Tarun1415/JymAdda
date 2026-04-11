@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="page-header-title d-flex justify-content-between">
          <h2 class="mb-0">Registered Partners</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover mb-0 text-center">
            <thead>
              <tr>
                <th>Partner ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Location</th>
                <th>Plan Name</th>
                <th>Gym Limit</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($partners as $partner)
              <tr>
                <td>#{{ $partner->partner_id }}</td>
                <td>{{ $partner->name }}</td>
                <td>
                  <div>{{ $partner->mobile }}</div>
                  <small class="text-muted">{{ $partner->email }}</small>
                </td>
                <td>{{ $partner->city ?? '-' }}, {{ $partner->state ?? '-' }}</td>
                <td><span class="badge bg-light-primary text-primary">{{ ucfirst($partner->plan_name ?? 'Basic') }}</span></td>
                <td>{{ $partner->gym_limit ?? 1 }}</td>
                <td>
                  <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-light-primary"><i class="ti ti-edit"></i></a>
                  
                  @if(auth()->user()->role === 'admin')
                  <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('WARNING: Are you sure you want to permanently delete this Partner?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-light-danger"><i class="ti ti-trash"></i></button>
                  </form>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">No partners registered yet.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="mt-3">
          {{ $partners->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
