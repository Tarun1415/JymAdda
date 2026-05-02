@extends('admin.layouts.app')

@section('content')
<style>
    /* Premium UI Tokens */
    :root {
        --ui-primary: #4f46e5;
        --ui-primary-hover: #4338ca;
        --ui-primary-light: #e0e7ff;
        --ui-surface: #ffffff;
        --ui-border: #e2e8f0;
        --ui-text: #1e293b;
        --ui-text-muted: #64748b;
        --ui-radius: 16px;
        --ui-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.025);
        --ui-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
        --ui-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Base Elements */
    .ui-page-header {
        margin-bottom: 2rem;
    }
    
    .ui-page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--ui-text);
        letter-spacing: -0.025em;
    }

    /* Cards */
    .ui-card {
        background: var(--ui-surface);
        border: 1px solid var(--ui-border);
        border-radius: var(--ui-radius);
        box-shadow: var(--ui-shadow);
        transition: var(--ui-transition);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .ui-card:hover {
        box-shadow: var(--ui-shadow-hover);
    }
    .ui-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--ui-border);
        background: #f8fafc;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .ui-card-title {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--ui-text);
    }
    .ui-card-icon {
        background: var(--ui-primary-light);
        color: var(--ui-primary);
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 1.1rem;
    }
    .ui-card-body {
        padding: 1.5rem;
    }

    /* Form Controls */
    .ui-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--ui-text);
        margin-bottom: 0.5rem;
        display: block;
    }
    .ui-input {
        border: 1px solid var(--ui-border);
        border-radius: 10px;
        padding: 0.625rem 1rem;
        font-size: 0.95rem;
        color: var(--ui-text);
        transition: var(--ui-transition);
        background-color: #f8fafc;
    }
    .ui-input:focus {
        border-color: var(--ui-primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        background-color: var(--ui-surface);
        outline: none;
    }
    .ui-select {
        border: 1px solid var(--ui-border);
        border-radius: 10px;
        padding: 0.625rem 1rem;
        font-size: 0.95rem;
        color: var(--ui-text);
        transition: var(--ui-transition);
        background-color: #f8fafc;
        cursor: pointer;
    }
    .ui-select:focus {
        border-color: var(--ui-primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }
    
    /* Buttons */
    .ui-btn {
        padding: 0.625rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: var(--ui-transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
    }
    .ui-btn-primary {
        background: linear-gradient(135deg, var(--ui-primary), #6366f1);
        color: white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
    }
    .ui-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.3);
        color: white;
    }
    .ui-btn-light {
        background: #f1f5f9;
        color: #475569;
    }
    .ui-btn-light:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* Approval Box */
    .approval-box {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border: 1px solid #fde68a;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(251, 191, 36, 0.1);
    }
    .approval-box select {
        border: 2px solid #fbbf24;
        font-weight: 600;
    }
    .approval-box select:focus {
        box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.2);
        border-color: #f59e0b;
    }

    /* Checkboxes */
    .ui-checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid var(--ui-border);
    }
    .ui-checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .ui-checkbox {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 6px;
        border: 2px solid var(--ui-border);
        cursor: pointer;
        transition: var(--ui-transition);
    }
    .ui-checkbox:checked {
        background-color: var(--ui-primary);
        border-color: var(--ui-primary);
    }

    /* Image Preview */
    .ui-image-preview {
        border: 2px dashed var(--ui-border);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        background: #f8fafc;
        transition: var(--ui-transition);
    }
    .ui-image-preview:hover {
        border-color: var(--ui-primary);
        background: var(--ui-primary-light);
    }
    .ui-image-preview img {
        border-radius: 8px;
        box-shadow: var(--ui-shadow);
        max-height: 150px;
        object-fit: cover;
    }
</style>

<div class="ui-page-header">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb mb-2" style="font-size: 0.875rem;">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.gyms.index') }}" class="text-decoration-none text-muted">Gyms</a></li>
            <li class="breadcrumb-item active fw-medium" aria-current="page">Review Gym</li>
        </ul>
    </nav>
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded-circle shadow" style="width: 48px; height: 48px;">
            <i class="ti ti-edit fs-4"></i>
        </div>
        <div>
            <h2 class="ui-page-title mb-0">Review & Edit Gym</h2>
            <p class="text-muted mb-0">{{ $gym->gym_name }}</p>
        </div>
    </div>
</div>

<form action="{{ route('admin.gyms.update', $gym) }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="row">
    <!-- Main Info -->
    <div class="col-lg-8">
      
      <!-- Admin specific approval logic -->
      <div class="approval-box">
          <label class="ui-label text-warning-emphasis fs-6 mb-2"><i class="ti ti-shield-check"></i> Gym Publishing Status</label>
          <select name="status" class="form-select form-select-lg ui-select" required>
            <option value="pending" {{ $gym->status === 'pending' ? 'selected' : '' }}>⏳ Pending Approval</option>
            <option value="active" {{ $gym->status === 'active' ? 'selected' : '' }}>✅ Active (Live on Platform)</option>
            <option value="rejected" {{ $gym->status === 'rejected' ? 'selected' : '' }}>❌ Rejected / Hidden</option>
          </select>
          <small class="text-muted d-block mt-2 fw-medium"><i class="ti ti-info-circle"></i> Setting status to "Active" makes this gym instantly visible to end-users.</small>
      </div>

      <!-- General Details -->
      <div class="ui-card">
        <div class="ui-card-header">
          <div class="ui-card-icon"><i class="ti ti-building"></i></div>
          <h5 class="ui-card-title">General Details</h5>
        </div>
        <div class="ui-card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="ui-label">Gym Name <span class="text-danger">*</span></label>
              <input type="text" name="gym_name" class="form-control ui-input" value="{{ old('gym_name', $gym->gym_name) }}" required>
            </div>
            <div class="col-md-6">
              <label class="ui-label">Gym Type <span class="text-danger">*</span></label>
              <select name="gym_type" class="form-select ui-select" required>
                <option value="unisex" {{ old('gym_type', $gym->gym_type) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                <option value="male" {{ old('gym_type', $gym->gym_type) == 'male' ? 'selected' : '' }}>Male Only</option>
                <option value="female" {{ old('gym_type', $gym->gym_type) == 'female' ? 'selected' : '' }}>Female Only</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="ui-label">Owner Name</label>
              <input type="text" name="owner_name" class="form-control ui-input" value="{{ old('owner_name', $gym->owner_name) }}">
            </div>
            <div class="col-md-4">
              <label class="ui-label">Mobile</label>
              <input type="text" name="mobile" class="form-control ui-input" value="{{ old('mobile', $gym->mobile) }}">
            </div>
            <div class="col-md-4">
              <label class="ui-label">Email</label>
              <input type="email" name="email" class="form-control ui-input" value="{{ old('email', $gym->email) }}">
            </div>
            <div class="col-md-12 mt-4">
              <label class="ui-label">Description</label>
              <textarea name="description" class="form-control summernote" rows="4">{!! old('description', $gym->description) !!}</textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- Location Info -->
      <div class="ui-card">
        <div class="ui-card-header">
          <div class="ui-card-icon"><i class="ti ti-map-pin"></i></div>
          <h5 class="ui-card-title">Location</h5>
        </div>
        <div class="ui-card-body">
          <div class="row g-3">
            <div class="col-md-12">
              <label class="ui-label">Full Address</label>
              <textarea name="address" class="form-control ui-input" rows="2">{{ old('address', $gym->address) }}</textarea>
            </div>
            <div class="col-md-12">
              <label class="ui-label">Google Map Link</label>
              <div class="input-group">
                <span class="input-group-text border-end-0 bg-light"><i class="ti ti-map-2 text-primary"></i></span>
                <input type="url" name="google_map_link" class="form-control ui-input border-start-0" value="{{ old('google_map_link', $gym->google_map_link) }}" placeholder="https://maps.google.com/...">
              </div>
            </div>
            <div class="col-md-4">
              <label class="ui-label">City</label>
              <input type="text" name="city" class="form-control ui-input" value="{{ old('city', $gym->city) }}">
            </div>
            <div class="col-md-4">
              <label class="ui-label">State</label>
              <input type="text" name="state" class="form-control ui-input" value="{{ old('state', $gym->state) }}">
            </div>
            <div class="col-md-4">
              <label class="ui-label">Pincode</label>
              <input type="text" name="pincode" class="form-control ui-input" value="{{ old('pincode', $gym->pincode) }}">
            </div>
          </div>
        </div>
      </div>

      <!-- SEO Info -->
      <div class="ui-card">
        <div class="ui-card-header">
          <div class="ui-card-icon"><i class="ti ti-search"></i></div>
          <h5 class="ui-card-title">SEO & Meta Information</h5>
        </div>
        <div class="ui-card-body">
          <div class="row g-3">
            <div class="col-md-12">
              <label class="ui-label">SEO Title</label>
              <input type="text" name="seo_title" class="form-control ui-input" value="{{ old('seo_title', $gym->seo_title) }}">
            </div>
            <div class="col-md-12">
              <label class="ui-label">SEO Description</label>
              <textarea name="seo_description" class="form-control ui-input" rows="3">{{ old('seo_description', $gym->seo_description) }}</textarea>
            </div>
            
            <div class="col-md-12">
              <label class="ui-label">SEO Keywords</label>
              <div id="seo-keywords-container">
                @php
                  $existingKeywords = old('seo_keywords', json_decode($gym->seo_keywords, true) ?? explode(',', $gym->seo_keywords ?? ''));
                  $existingKeywords = array_filter($existingKeywords ?? []);
                @endphp
                
                @forelse($existingKeywords as $keyword)
                  <div class="input-group mb-2 keyword-row">
                    <input type="text" name="seo_keywords[]" class="form-control ui-input" value="{{ trim($keyword) }}" placeholder="e.g. Best Gym in Delhi">
                    <button class="btn btn-outline-danger remove-keyword px-3" type="button" style="border-radius: 0 10px 10px 0;"><i class="ti ti-trash"></i></button>
                  </div>
                @empty
                  <div class="input-group mb-2 keyword-row">
                    <input type="text" name="seo_keywords[]" class="form-control ui-input" placeholder="e.g. Best Gym in Delhi">
                    <button class="btn btn-outline-danger remove-keyword px-3" type="button" style="border-radius: 0 10px 10px 0;"><i class="ti ti-trash"></i></button>
                  </div>
                @endforelse
              </div>
              <button type="button" class="btn ui-btn ui-btn-light mt-2" id="add-keyword-btn">
                <i class="ti ti-plus"></i> Add Another Keyword
              </button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Right Sidebar Info -->
    <div class="col-lg-4">

      <div class="ui-card">
        <div class="ui-card-header">
          <div class="ui-card-icon"><i class="ti ti-clock"></i></div>
          <h5 class="ui-card-title">Timing & Amenities</h5>
        </div>
        <div class="ui-card-body">
          <div class="mb-3">
            <label class="ui-label">Opening Time</label>
            <input type="time" name="opening_time" class="form-control ui-input" value="{{ old('opening_time', $gym->opening_time) }}">
          </div>
          <div class="mb-3">
            <label class="ui-label">Closing Time</label>
            <input type="time" name="closing_time" class="form-control ui-input" value="{{ old('closing_time', $gym->closing_time) }}">
          </div>
          <div class="mb-4">
            <label class="ui-label">Open Days</label>
            <input type="text" name="open_days" class="form-control ui-input" placeholder="e.g. Mon - Sat" value="{{ old('open_days', $gym->open_days) }}">
          </div>
          
          <label class="ui-label mb-2">Available Facilities</label>
          <div class="ui-checkbox-group">
            <div class="ui-checkbox-wrapper">
              <input class="form-check-input ui-checkbox m-0" type="checkbox" id="trainer_available" name="trainer_available" value="1" {{ old('trainer_available', $gym->trainer_available) ? 'checked' : '' }}>
              <label class="form-check-label fw-medium cursor-pointer" for="trainer_available">Trainer Available</label>
            </div>
            <div class="ui-checkbox-wrapper">
              <input class="form-check-input ui-checkbox m-0" type="checkbox" id="ac_available" name="ac_available" value="1" {{ old('ac_available', $gym->ac_available) ? 'checked' : '' }}>
              <label class="form-check-label fw-medium cursor-pointer" for="ac_available">AC Available</label>
            </div>
            <div class="ui-checkbox-wrapper">
              <input class="form-check-input ui-checkbox m-0" type="checkbox" id="parking_available" name="parking_available" value="1" {{ old('parking_available', $gym->parking_available) ? 'checked' : '' }}>
              <label class="form-check-label fw-medium cursor-pointer" for="parking_available">Parking Available</label>
            </div>
          </div>
        </div>
      </div>

      <div class="ui-card">
        <div class="ui-card-header">
          <div class="ui-card-icon"><i class="ti ti-photo"></i></div>
          <h5 class="ui-card-title">Media Update</h5>
        </div>
        <div class="ui-card-body">
          <div class="mb-4">
            <label class="ui-label">Main Listing Image</label>
            <div class="ui-image-preview mt-2">
                @if($gym->gym_image)
                <img src="{{ asset($gym->gym_image) }}" alt="gym" class="mb-3">
                @endif
                <input type="file" name="gym_image" class="form-control ui-input">
                <small class="text-muted d-block mt-2">Leave empty to keep current image</small>
            </div>
          </div>
          <div class="mb-2">
            <label class="ui-label">SEO Banner Image <span class="text-muted fw-normal">(Optional)</span></label>
            <div class="ui-image-preview mt-2">
                @if($gym->seo_image)
                <img src="{{ asset($gym->seo_image) }}" alt="seo" class="mb-3">
                @endif
                <input type="file" name="seo_image" class="form-control ui-input">
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-12 mt-2 mb-5 d-flex justify-content-end gap-3">
      <a href="{{ route('admin.gyms.index') }}" class="btn ui-btn ui-btn-light">Cancel</a>
      <button type="submit" class="btn ui-btn ui-btn-primary"><i class="ti ti-device-floppy"></i> Save Review & Update</button>
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
        height: 250,
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
        <input type="text" name="seo_keywords[]" class="form-control ui-input" placeholder="Enter keyword">
        <button class="btn btn-outline-danger remove-keyword px-3" type="button" style="border-radius: 0 10px 10px 0;"><i class="ti ti-trash"></i></button>
      `;
      container.appendChild(row);
    });

    // Remove row (Event Delegation)
    container.addEventListener('click', function(e) {
      if(e.target.closest('.remove-keyword')) {
        const row = e.target.closest('.keyword-row');
        row.remove();
      }
    });
  });
</script>
@endpush
