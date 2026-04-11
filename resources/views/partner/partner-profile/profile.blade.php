@extends('partner.layouts.app')
@section('content')

<div class="row">
  <div class="col-sm-12">

    {{-- Flash messages --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
      {{-- LEFT CARD --}}
      <div class="col-md-4">
        <div class="card">
          <div class="card-body position-relative">
            <div class="text-center">

              <div class="chat-avtar d-inline-flex mx-auto">
                <img class="rounded-circle img-fluid wid-120"
                     src="{{ $partner->partner_image ? asset($partner->partner_image) : asset('../assets/images/user/avatar-5.jpg') }}"
                     alt="Partner image">
              </div>

              <h5 class="mt-3">{{ $partner->name }}</h5>
              <p class="text-muted">{{ $partner->email }}</p>

              <div class="row g-3 my-4">
                <div class="col-4">
                  <h5 class="mb-0">{{ $partner->plan_name ?? '-' }}</h5>
                  <small class="text-muted">Plan</small>
                </div>
                <div class="col-4 border border-top-0 border-bottom-0">
                  <h5 class="mb-0">{{ $partner->plan_expires_at ? $partner->plan_expires_at->format('d M Y') : '-' }}</h5>
                  <small class="text-muted">Expiry</small>
                </div>
                <div class="col-4">
                  @php
                      $planName = strtolower($partner->plan_name ?? 'basic');
                      $displayLimit = 1;
                      if ($planName === 'standard') $displayLimit = 3;
                      elseif ($planName === 'premium') $displayLimit = 5;
                  @endphp
                  <h5 class="mb-0">{{ $displayLimit }}</h5>
                  <small class="text-muted">Gym Limit</small>
                </div>
              </div>
            </div>

            <div class="nav flex-column nav-pills list-group list-group-flush user-sett-tabs" id="user-set-tab"
                 role="tablist" aria-orientation="vertical">

              <a class="nav-link list-group-item list-group-item-action active" id="user-tab-1"
                 data-bs-toggle="pill" href="#user-cont-1" role="tab">
                <span class="f-w-500"><i class="ti ti-user m-r-10"></i>Personal Information</span>
              </a>

              <a class="nav-link list-group-item list-group-item-action" id="user-tab-2"
                 data-bs-toggle="pill" href="#user-cont-2" role="tab">
                <span class="f-w-500"><i class="ti ti-credit-card m-r-10"></i>Upload Profile Image</span>
              </a>

              <a class="nav-link list-group-item list-group-item-action" id="user-tab-3"
                 data-bs-toggle="pill" href="#user-cont-3" role="tab">
                <span class="f-w-500"><i class="ti ti-file m-r-10"></i>Upload Document</span>
              </a>

              <a class="nav-link list-group-item list-group-item-action" id="user-tab-4"
                 data-bs-toggle="pill" href="#user-cont-4" role="tab">
                <span class="f-w-500"><i class="ti ti-key m-r-10"></i>Update Password</span>
              </a>

            </div>
          </div>
        </div>
      </div>

      {{-- RIGHT SIDE --}}
      <div class="col-md-8">
        <div class="tab-content" id="user-set-tabContent">

          {{-- TAB 1: Personal Info --}}
          <div class="tab-pane fade show active" id="user-cont-1" role="tabpanel">
            <div class="card">
              <form method="POST" action="{{ route('Partnerjym.profile', $partner->token) }}">
                @csrf
                <input type="hidden" name="action_type" value="info">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <h5>Personal Information</h5>
                      <hr class="mb-4">
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Partner Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $partner->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="mobile"
                               class="form-control @error('mobile') is-invalid @enderror"
                               value="{{ old('mobile', $partner->mobile) }}">
                        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $partner->email) }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth"
                               class="form-control @error('date_of_birth') is-invalid @enderror"
                               value="{{ old('date_of_birth', $partner->date_of_birth) }}">
                        @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-12">
                      <h5 class="mt-4">Address</h5>
                      <hr class="mb-4">
                    </div>

                    <div class="col-sm-12">
                      <div class="form-group mb-3">
                        <label class="form-label">Full Address</label>
                        <textarea name="address"
                                  class="form-control @error('address') is-invalid @enderror"
                                  rows="3">{{ old('address', $partner->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <label class="form-label">State</label>
                        <input type="text" name="state"
                               class="form-control @error('state') is-invalid @enderror"
                               value="{{ old('state', $partner->state) }}">
                        @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group mb-3">
                        <label class="form-label">City</label>
                        <input type="text" name="city"
                               class="form-control @error('city') is-invalid @enderror"
                               value="{{ old('city', $partner->city) }}">
                        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                      </div>
                    </div>

                  </div>
                </div>

                <div class="card-footer text-end btn-page">
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>

              </form>
            </div>
          </div>

          {{-- TAB 2: Profile Image --}}
          <div class="tab-pane fade" id="user-cont-2" role="tabpanel">
            <div class="card">
              <form method="POST" action="{{ route('Partnerjym.profile', $partner->token) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action_type" value="image">

                <div class="card-body">
                  <h5>Partner Profile Image</h5>
                  <hr class="mb-4">

                  <div class="form-group mb-3">
                    <label class="form-label">Upload Partner Image</label>
                    <input type="file" name="partner_image"
                           class="form-control @error('partner_image') is-invalid @enderror" required>
                    @error('partner_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Allowed: jpg, jpeg, png, webp (max 2MB)</small>
                  </div>

                  @if($partner->partner_image)
                    <div class="mt-3">
                      <p class="mb-1"><b>Current:</b></p>
                      <img src="{{ asset($partner->partner_image) }}" style="max-width:180px;border-radius:12px;">
                    </div>
                  @endif
                </div>

                <div class="card-footer text-end btn-page">
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>

          {{-- TAB 3: Aadhaar Document --}}
          <div class="tab-pane fade" id="user-cont-3" role="tabpanel">
            <div class="card">
              <form method="POST" action="{{ route('Partnerjym.profile', $partner->token) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="action_type" value="document">

                <div class="card-body">
                  <h5>Partner Document</h5>
                  <hr class="mb-4">

                  <div class="form-group mb-3">
                    <label class="form-label">Upload Aadhaar Card (PDF/Image)</label>
                    <input type="file" name="aadhaar_card"
                           class="form-control @error('aadhaar_card') is-invalid @enderror" required>
                    @error('aadhaar_card') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Allowed: jpg, jpeg, png, webp, pdf (max 5MB)</small>
                  </div>

                  @if($partner->aadhaar_card)
                    <div class="mt-3">
                      <p class="mb-1"><b>Uploaded File:</b></p>
                      <a href="{{ asset($partner->aadhaar_card) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        View Aadhaar
                      </a>
                    </div>
                  @endif
                </div>

                <div class="card-footer text-end btn-page">
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>

          {{-- TAB 4: Update Password --}}
          <div class="tab-pane fade" id="user-cont-4" role="tabpanel">
            <div class="card">
              <form method="POST" action="{{ route('Partnerjym.profile', $partner->token) }}" class="needs-loading">
                @csrf
                <input type="hidden" name="action_type" value="password">

                <div class="card-body">
                  <h5>Update Account Password</h5>
                  <hr class="mb-4">

                  <div class="form-group mb-4">
                    <label class="form-label">Current Password <span class="text-danger">*</span></label>
                    <input type="password" name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror" required placeholder="Enter current password">
                    @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>

                  <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group mb-3">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror" required placeholder="New password">
                            @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted">Minimum 8 characters</small>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group mb-3">
                            <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="new_password_confirmation"
                                   class="form-control" required placeholder="Re-enter new password">
                          </div>
                      </div>
                  </div>
                </div>

                <div class="card-footer text-end btn-page">
                  <button type="reset" class="btn btn-outline-secondary">Clear</button>
                  <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // If the URL has #password hash, auto show the Password tab
        if(window.location.hash === '#password') {
            $('#user-tab-4').tab('show');
        }
    });
</script>
@endpush
