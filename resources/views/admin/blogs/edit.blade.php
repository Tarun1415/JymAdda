@extends('admin.layouts.app')

@section('content')

<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
          <li class="breadcrumb-item" aria-current="page">Edit Blog</li>
        </ul>
      </div>
      <div class="col-md-12">
        <div class="page-header-title">
          <h2 class="mb-0">Edit Blog Post</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-article me-2"></i> Blog Content</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                        @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $blog->slug) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Blog Body <span class="text-danger">*</span></label>
                        <textarea name="content" class="summernote" required>{{ old('content', $blog->content) }}</textarea>
                        @error('content') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- SEO & Meta Info -->
            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-search me-2"></i> SEO & Discovery</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title) }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $blog->meta_description) }}</textarea>
                    </div>
                    
                    <div>
                        <label class="form-label fw-bold">Meta Keywords</label>
                        <div id="seo-keywords-container">
                            @php
                                $existingKeywords = old('meta_keywords', $blog->meta_keywords);
                                if(!is_array($existingKeywords)) {
                                    $existingKeywords = json_decode($existingKeywords, true) ?? [];
                                }
                            @endphp
                            
                            @forelse($existingKeywords as $keyword)
                                <div class="input-group mb-2 keyword-row">
                                    <input type="text" name="meta_keywords[]" class="form-control" value="{{ $keyword }}" placeholder="e.g. fitness">
                                    <button class="btn btn-outline-danger remove-keyword" type="button"><i class="ti ti-trash"></i></button>
                                </div>
                            @empty
                                <div class="input-group mb-2 keyword-row">
                                    <input type="text" name="meta_keywords[]" class="form-control" placeholder="e.g. fitness">
                                    <button class="btn btn-outline-danger remove-keyword" type="button"><i class="ti ti-trash"></i></button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-light btn-sm border mt-2 fw-bold" id="add-keyword-btn">
                            <i class="ti ti-plus"></i> Add Keyword
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Settings -->
        <div class="col-lg-4">
            
            <div class="card border-warning">
                <div class="card-body bg-light-warning">
                    <label class="form-label fw-bold text-warning-emphasis"><i class="ti ti-eye"></i> Publishing Status</label>
                    <select name="status" class="form-select border-warning" required>
                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>📝 Draft (Hidden)</option>
                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>✅ Published (Live)</option>
                    </select>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-photo me-2"></i> Featured Image</h5>
                </div>
                <div class="card-body text-center">
                    @if($blog->featured_image)
                        <div class="mb-3 p-2 border rounded bg-light">
                            <img src="{{ asset($blog->featured_image) }}" alt="Current Image" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="form-control mb-2" accept="image/*">
                    <small class="text-muted d-block mt-2 text-start">Leave blank to keep current image. Recommended size: 1200 x 630 pixels.</small>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-map-pin me-2"></i> Local SEO (Optional)</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $blog->city) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">State</label>
                        <input type="text" name="state" class="form-control" value="{{ old('state', $blog->state) }}">
                    </div>
                    <div>
                        <label class="form-label fw-bold">Pincode</label>
                        <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $blog->pincode) }}">
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2 fs-6">
                        <i class="ti ti-device-floppy"></i> Update Blog Post
                    </button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-light border py-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if($.fn.summernote) {
            $('.summernote').summernote({
                height: 400,
                placeholder: 'Write your amazing blog post here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }
        
        let slugEdited = true;
        $('#slug').on('input', function() {
            slugEdited = true;
        });

        $('#title').on('keyup', function() {
            if(!slugEdited || $('#slug').val() === '') {
                let text = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                $('#slug').val(text);
            }
        });

        const container = document.getElementById('seo-keywords-container');
        const addBtn = document.getElementById('add-keyword-btn');

        if(addBtn && container) {
            addBtn.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'input-group mb-2 keyword-row';
                row.innerHTML = `
                    <input type="text" name="meta_keywords[]" class="form-control" placeholder="Enter keyword">
                    <button class="btn btn-outline-danger remove-keyword" type="button"><i class="ti ti-trash"></i></button>
                `;
                container.appendChild(row);
            });

            container.addEventListener('click', function(e) {
                if(e.target.closest('.remove-keyword')) {
                    const row = e.target.closest('.keyword-row');
                    if(container.querySelectorAll('.keyword-row').length > 1) {
                        row.remove();
                    } else {
                        row.querySelector('input').value = '';
                    }
                }
            });
        }
    });
</script>
@endpush
