@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <h2 class="mb-0">Edit User: {{ $user->name }}</h2>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
          @csrf @method('PUT')
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Assign Role</label>
            <select name="role" class="form-select" required>
              <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff (Standard Access)</option>
              <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager (Elevated Access)</option>
              <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Super Admin (Full Access)</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control" minlength="6">
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
