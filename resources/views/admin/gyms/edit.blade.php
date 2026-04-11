@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.gyms.index') }}">Gyms</a></li>
    <li class="breadcrumb-item" aria-current="page">Review Gym</li>
  </ul>
  <h2 class="mb-0">Review & Edit Gym: {{ $gym->gym_name }}</h2>
</div>

<form action="{{ route('admin.gyms.update', $gym) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="row">
    <!-- Main Info -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header bg-light">
          <h5 class="mb-0">General Details</h5>
        </div>
        <div class="card-body">
          <div class="row">

            <!-- Admin specific approval logic -->
            <div class="col-md-12 mb-4 p-3 bg-warning-subtle rounded border border-warning">
              <label class="form-label text-warning-emphasis fw-bold">Gym Publishing Status</label>
              <select name="status" class="form-select form-select-lg" required>
                <option value="pending" {{ $gym->status === 'pending' ? 'selected' : '' }}>⏳ Pending Approval</option>
                <option value="active" {{ $gym->status === 'active' ? 'selected' : '' }}>✅ Active (Live)</option>
                <option value="rejected" {{ $gym->status === 'rejected' ? 'selected' : '' }}>❌ Rejected / Hidden</option>
              </select>
              <small class="text-muted d-block mt-2">Publishing makes this gym instantly visible to end-users.</small>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Gym Name <span class="text-danger">*</span></label>
              <input type="text" name="gym_name" class="form-control" value="{{ old('gym_name', $gym->gym_name) }}" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Owner Name</label>
              <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', $gym->owner_name) }}">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Mobile</label>
              <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $gym->mobile) }}">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email', $gym->email) }}">
            </div>
            <div class="col-md-12 mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control summernote" rows="4">{!! old('description', $gym->description) !!}</textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- Address Info -->
      <div class="card">
        <div class="card-header bg-light">
          <h5 class="mb-0">Location</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">Full Address</label>
              <textarea name="address" class="form-control" rows="2">{{ old('address', $gym->address) }}</textarea>
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">City</label>
              <input type="text" name="city" class="form-control" value="{{ old('city', $gym->city) }}">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">State</label>
              <input type="text" name="state" class="form-control" value="{{ old('state', $gym->state) }}">
            </div>
            <div class="col-md-4 mb-3">
              <label class="form-label">Pincode</label>
              <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $gym->pincode) }}">
            </div>
          </div>
        </div>
      </div>

      <!-- SEO Info -->
      <div class="card">
        <div class="card-header bg-light">
          <h5 class="mb-0">SEO & Meta Information</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">SEO Title</label>
              <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $gym->seo_title) }}">
            </div>
            <div class="col-md-12 mb-3">
              <label class="form-label">SEO Description</label>
              <textarea name="seo_description" class="form-control" rows="3">{{ old('seo_description', $gym->seo_description) }}</textarea>
            </div>
            
            <div class="col-md-12 mb-3">
              <label class="form-label">SEO Keywords</label>
              <div id="seo-keywords-container">
                @php
                  // Retrieve existing keywords if stored as JSON or comma separated string
                  $existingKeywords = old('seo_keywords', json_decode($gym->seo_keywords, true) ?? explode(',', $gym->seo_keywords ?? ''));
                  // filter out empties
                  $existingKeywords = array_filter($existingKeywords ?? []);
                @endphp
                
                @forelse($existingKeywords as $keyword)
                  <div class="input-group mb-2 keyword-row">
                    <input type="text" name="seo_keywords[]" class="form-control" value="{{ trim($keyword) }}" placeholder="e.g. Best Gym in Delhi">
                    <button class="btn btn-outline-danger remove-keyword" type="button"><i class="ti ti-trash"></i></button>
                  </div>
                @empty
                  <div class="input-group mb-2 keyword-row">
                    <input type="text" name="seo_keywords[]" class="form-control" placeholder="e.g. Best Gym in Delhi">
                    <button class="btn btn-outline-danger remove-keyword" type="button"><i class="ti ti-trash"></i></button>
                  </div>
                @endforelse
              </div>
              <button type="button" class="btn btn-sm btn-light-primary border mt-1" id="add-keyword-btn">
                <i class="ti ti-plus"></i> Add Another Keyword
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Right Sidebar Info -->
    <div class="col-lg-4">

      <div class="card">
        <div class="card-header bg-light">
          <h5 class="mb-0">Timing & Amenities</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label">Opening Time</label>
            <input type="time" name="opening_time" class="form-control" value="{{ old('opening_time', $gym->opening_time) }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Closing Time</label>
            <input type="time" name="closing_time" class="form-control" value="{{ old('closing_time', $gym->closing_time) }}">
          </div>
          <div class="mb-4">
            <label class="form-label">Open Days</label>
            <input type="text" name="open_days" class="form-control" placeholder="e.g. Mon - Sat" value="{{ old('open_days', $gym->open_days) }}">
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="trainer_available" value="1" {{ old('trainer_available', $gym->trainer_available) ? 'checked' : '' }}>
            <label class="form-check-label">Trainer Available</label>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="ac_available" value="1" {{ old('ac_available', $gym->ac_available) ? 'checked' : '' }}>
            <label class="form-check-label">AC Available</label>
          </div>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="parking_available" value="1" {{ old('parking_available', $gym->parking_available) ? 'checked' : '' }}>
            <label class="form-check-label">Parking Available</label>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-light">
          <h5 class="mb-0">Media Update</h5>
        </div>
        <div class="card-body">
          <div class="mb-3 text-center">
            @if($gym->gym_image)
              <img src="{{ asset($gym->gym_image) }}" alt="gym" class="img-fluid rounded mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="gym_image" class="form-control mt-2">
            <small class="text-muted">Main Listing Image (leave empty to keep current)</small>
          </div>
          <div class="mb-3 text-center mt-4 border-top pt-3">
             @if($gym->seo_image)
              <img src="{{ asset($gym->seo_image) }}" alt="seo" class="img-fluid rounded mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="seo_image" class="form-control mt-2">
            <small class="text-muted">SEO Banner Image (Optional)</small>
          </div>
        </div>
      </div>

    </div>

    <div class="col-12 mt-3 mb-5 text-end">
      <a href="{{ route('admin.gyms.index') }}" class="btn btn-light px-4 me-2">Cancel</a>
      <button type="submit" class="btn btn-primary px-5">Save Review & Update</button>
    </div>

  </div>
</form>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize Summernote
    if (typeof $ !== 'undefined' && $.fn.summernote) {
      $('.summernote').summernote({
        height: 200,
        placeholder: 'Write complete gym description here...',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['view', ['codeview']]
        ]
      });
    }

    const container = document.getElementById('seo-keywords-container');
    const addBtn = document.getElementById('add-keyword-btn');

    // Add new row
    addBtn.addEventListener('click', function() {
      const row = document.createElement('div');
      row.className = 'input-group mb-2 keyword-row';
      row.innerHTML = `
        <input type="text" name="seo_keywords[]" class="form-control" placeholder="Enter keyword">
        <button class="btn btn-outline-danger remove-keyword" type="button"><i class="ti ti-trash"></i></button>
      `;
      container.appendChild(row);
    });

    // Remove row (Event Delegation)
    container.addEventListener('click', function(e) {
      if(e.target.closest('.remove-keyword')) {
        const row = e.target.closest('.keyword-row');
        // keep at least one row if desired, or let them delete all
        row.remove();
      }
    });
  });
</script>
@endpush
