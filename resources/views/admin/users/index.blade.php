@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="page-header-title d-flex justify-content-between">
          <h2 class="mb-0">Super Admin User Management</h2>
          <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Add New User</a>
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
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : ($user->role === 'manager' ? 'bg-primary' : 'bg-info') }}">
                    {{ ucfirst($user->role ?? 'staff') }}
                  </span>
                </td>
                <td>{{ $user->created_at->format('d M, Y') }}</td>
                <td>
                  <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light-primary"><i class="ti ti-edit"></i></a>
                  @if(auth()->id() !== $user->id)
                  <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-light-danger"><i class="ti ti-trash"></i></button>
                  </form>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
