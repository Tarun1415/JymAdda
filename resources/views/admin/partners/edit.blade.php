@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <h2 class="mb-0">Edit Partner: {{ $partner->name }}</h2>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        @if($partner->partner_image)
          <div class="mb-4 text-center">
             <img src="{{ asset($partner->partner_image) }}" alt="Partner Image" class="img-fluid rounded-circle border" style="width: 100px; height: 100px; object-fit: cover;">
          </div>
        @endif
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
          @csrf @method('PUT')
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" required value="{{ old('name', $partner->name) }}">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mobile</label>
              <input type="text" name="mobile" class="form-control" required value="{{ old('mobile', $partner->mobile) }}">
            </div>
            
            <div class="col-md-12 mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" required value="{{ old('email', $partner->email) }}">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">State</label>
              <input type="text" name="state" class="form-control" value="{{ old('state', $partner->state) }}">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">City</label>
              <input type="text" name="city" class="form-control" value="{{ old('city', $partner->city) }}">
            </div>
            
            <div class="col-md-12 mb-3">
              <label class="form-label">Full Address</label>
              <textarea name="address" class="form-control" rows="2">{{ old('address', $partner->address) }}</textarea>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $partner->date_of_birth ? \Carbon\Carbon::parse($partner->date_of_birth)->format('Y-m-d') : '') }}">
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">Aadhaar Card No.</label>
              <input type="text" name="aadhaar_card" class="form-control" value="{{ old('aadhaar_card', $partner->aadhaar_card) }}">
            </div>

            <hr class="my-4">
            <h5 class="mb-3 text-primary">Subscription Constraints</h5>

            <div class="col-md-6 mb-3">
              <label class="form-label">Plan Name</label>
              <select name="plan_name" class="form-select" required>
                <option value="basic" {{ strtolower($partner->plan_name) === 'basic' ? 'selected' : '' }}>Basic (1 Gym)</option>
                <option value="standard" {{ strtolower($partner->plan_name) === 'standard' ? 'selected' : '' }}>Standard (3 Gyms)</option>
                <option value="premium" {{ strtolower($partner->plan_name) === 'premium' ? 'selected' : '' }}>Premium (5 Gyms)</option>
              </select>
            </div>
            <div class="col-md-6 mb-4">
              <label class="form-label">Allowed Gym Limit</label>
              <input type="number" name="gym_limit" class="form-control" required value="{{ old('gym_limit', $partner->gym_limit ?? 1) }}" min="1">
              <small class="text-muted">Override the default limits here if needed.</small>
            </div>
            <div class="col-md-12 mb-4">
              <label class="form-label">Plan Expires At</label>
              <input type="datetime-local" name="plan_expires_at" class="form-control" value="{{ old('plan_expires_at', $partner->plan_expires_at ? \Carbon\Carbon::parse($partner->plan_expires_at)->format('Y-m-d\TH:i') : '') }}">
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Save Partner</button>
          <a href="{{ route('admin.partners.index') }}" class="btn btn-light ms-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
