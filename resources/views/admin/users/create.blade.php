@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <h2 class="mb-0">Add Internal User</h2>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Assign Role</label>
            <select name="role" class="form-select" required>
              <option value="staff">Staff (Standard Access)</option>
              <option value="manager">Manager (Elevated Access)</option>
              <option value="admin">Super Admin (Full Access)</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required minlength="6">
          </div>
          <button type="submit" class="btn btn-primary">Create User</button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
