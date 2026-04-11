@extends('partner.layouts.app')

@push('css')
<style>
    .form-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
    }
    .form-section-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-section-title i {
        color: #4f46e5;
        font-size: 22px;
    }
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 12px 16px;
        font-size: 14px;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        background-color: #ffffff;
    }
    .custom-card {
        border: none;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        border-radius: 20px;
        overflow: hidden;
    }
    .custom-card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 24px 30px;
    }
    .custom-card-header h5 {
        margin: 0;
        font-weight: 900;
        color: #1e293b;
        font-size: 20px;
    }
    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fff;
        border: 1px solid #e2e8f0;
        padding: 14px 20px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .checkbox-wrapper:hover {
        border-color: #94a3b8;
        background: #f8fafc;
        transform: translateY(-1px);
    }
    .checkbox-wrapper input[type="checkbox"] {
        width: 20px;
        height: 20px;
        accent-color: #4f46e5;
        cursor: pointer;
    }
    .checkbox-wrapper label {
        margin: 0;
        font-weight: 700;
        color: #334155;
        cursor: pointer;
        font-size: 14px;
    }
    .action-btn {
        padding: 12px 28px;
        font-weight: 700;
        border-radius: 10px;
        font-size: 15px;
    }
    
    @media (max-width: 768px) {
        .form-section {
            padding: 20px;
        }
        .custom-card-header {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card custom-card">
      <div class="card-header custom-card-header">
        <h5><i class="ti ti-plus"></i> Add New Gym Listing</h5>
      </div>

      <div class="card-body p-0">
        <form action="{{ route('Partnerjym.store') }}" method="POST" enctype="multipart/form-data" class="p-4 p-md-5 needs-loading">
            @csrf

            {{-- ================= BASIC DETAILS ================= --}}
            <div class="form-section">
              <div class="form-section-title">
                  <i class="ti ti-info-circle"></i> Basic Details
              </div>
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label">Gym Name <span class="text-danger">*</span></label>
                  <input type="text" name="gym_name" id="gym_name" class="form-control" placeholder="E.g. Gold's Gym" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">System Slug</label>
                  <input type="text" name="slug" id="slug" class="form-control bg-light" placeholder="auto-generated-slug" readonly>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Owner Name</label>
                  <input type="text" name="owner_name" class="form-control" placeholder="E.g. Rahul Sharma">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Mobile Number</label>
                  <input type="text" name="mobile" class="form-control" placeholder="10-digit number">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" placeholder="contact@example.com">
                </div>

                <input type="hidden" name="status" value="pending">

                <div class="col-md-12">
                  <label class="form-label">Gym Description</label>
                  <textarea name="description" class="form-control summernote" placeholder="Write a compelling gym description here..."></textarea>
                </div>
              </div>
            </div>

            {{-- ================= LOCATION DETAILS ================= --}}
            <div class="form-section">
              <div class="form-section-title">
                  <i class="ti ti-map-pin"></i> Location Details
              </div>
              <div class="row g-4">
                <div class="col-md-12">
                  <label class="form-label">Full Address</label>
                  <textarea name="address" class="form-control" rows="2" placeholder="E.g. 123 Main Street, Sector 4"></textarea>
                </div>

                <div class="col-md-4">
                  <label class="form-label">City</label>
                  <input type="text" name="city" class="form-control" placeholder="E.g. Delhi">
                </div>

                <div class="col-md-4">
                  <label class="form-label">State</label>
                  <input type="text" name="state" class="form-control" placeholder="E.g. Delhi">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Pincode</label>
                  <input type="text" name="pincode" class="form-control" placeholder="E.g. 110001">
                </div>
              </div>
            </div>

            {{-- ================= FACILITIES ================= --}}
            <div class="form-section">
              <div class="form-section-title">
                  <i class="ti ti-star"></i> Facilities Included
              </div>
              <div class="row g-3">
                <div class="col-md-4 col-sm-6">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="trainer_available" value="1">
                        Trainer Available
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="parking_available" value="1">
                        Parking Available
                    </label>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="ac_available" value="1">
                        Air Conditioned (A/C)
                    </label>
                </div>
              </div>
            </div>

            {{-- ================= TIMINGS & MEDIA ================= --}}
            <div class="form-section">
              <div class="form-section-title">
                  <i class="ti ti-clock"></i> Timings & Media
              </div>
              <div class="row g-4">
                <div class="col-md-4">
                  <label class="form-label">Opening Time</label>
                  <input type="time" name="opening_time" class="form-control">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Closing Time</label>
                  <input type="time" name="closing_time" class="form-control">
                </div>

                <div class="col-md-4">
                  <label class="form-label">Open Days</label>
                  <input type="text" name="open_days" class="form-control" placeholder="E.g. Mon-Sat / All Days">
                </div>

                <div class="col-md-12">
                  <label class="form-label">Primary Gym Image</label>
                  <input type="file" name="gym_image" class="form-control" accept="image/*">
                  <div class="form-text mt-2 text-muted"><i class="ti ti-photo"></i> Upload a high-quality main image for better visibility.</div>
                </div>
              </div>
            </div>

            {{-- ================= SEO DETAILS ================= --}}
            <div class="form-section">
              <div class="form-section-title">
                  <i class="ti ti-search"></i> SEO Optimization
              </div>
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label">SEO Meta Title</label>
                  <input type="text" name="seo_title" class="form-control" placeholder="E.g. Best Gym in Delhi - Gold's Gym">
                </div>

                <div class="col-md-6">
                  <label class="form-label">SEO Open Graph Image</label>
                  <input type="file" name="seo_image" class="form-control" accept="image/*">
                </div>

                <div class="col-md-12">
                  <label class="form-label">SEO Meta Description</label>
                  <textarea name="seo_description" class="form-control" rows="3" placeholder="Enter a brief summary of your gym for search engines..."></textarea>
                </div>
              </div>
            </div>

            <div class="d-flex gap-3 align-items-center mb-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary action-btn">
                  <i class="ti ti-check"></i> Submit Listing
                </button>
                <a href="{{ route('Partnerjym.index') }}" class="btn btn-light border action-btn">
                  Cancel
                </a>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Basic Summernote implementation check
    if($.fn.summernote) {
        $('.summernote').summernote({
            height: 250,
            placeholder: 'Write a detailed description about your gym infrastructure, rules, and vibe...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    }

    // Slug auto generate
    $('#gym_name').on('keyup', function () {
        let text = $(this).val()
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');

        $('#slug').val(text);
    });
});
</script>
@endpush
