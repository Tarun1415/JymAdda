@extends('partner.layouts.app')

@push('styles')
<style>
    .gallery-img-container {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        height: 200px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gallery-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .gallery-img-container:hover img {
        transform: scale(1.05);
    }
    .btn-delete-overlay {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 59, 48, 0.9);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 0.85rem;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-img-container:hover .btn-delete-overlay {
        opacity: 1;
    }
    .btn-delete-overlay:hover {
        background: rgba(255, 59, 48, 1);
    }
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        background: #f8fafc;
        padding: 40px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .upload-box:hover {
        border-color: #4f46e5;
        background: #eef2ff;
    }
    .bg-light-primary {
        background-color: #eef2ff !important;
    }
</style>
@endpush

@section('content')
<div class="row">
    <!-- Header Section -->
    <div class="col-12 mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold mb-1">Gym Gallery Management</h4>
                <p class="text-muted mb-0">Upload and manage high-quality photos up to 5 per gym.</p>
            </div>
        </div>
    </div>

    <!-- Gym Selector -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('Partnerjym.gallery.index') }}" method="GET" id="gymSelectorForm">
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Select Gym to Manage</label>
                            <select name="gym_id" class="form-select form-select-lg shadow-none" onchange="document.getElementById('gymSelectorForm').submit()">
                                @if($gyms->isEmpty())
                                    <option value="">No gyms found. Please add a gym first.</option>
                                @else
                                    @foreach($gyms as $gym)
                                        <option value="{{ $gym->id }}" {{ $gym->id == $selectedGymId ? 'selected' : '' }}>
                                            {{ $gym->gym_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @if($selectedGym)
                        <div class="col-md-7 text-md-end mt-3 mt-md-0">
                            <span class="badge bg-light-primary text-primary px-3 py-2 fs-6 rounded-pill">
                                <i class="ti ti-photo"></i> {{ $galleries->count() }} / 5 Images Uploaded
                            </span>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($selectedGym)
    <!-- Upload Section -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('Partnerjym.gallery.store') }}" method="POST" enctype="multipart/form-data" class="needs-loading">
                    @csrf
                    <input type="hidden" name="gym_id" value="{{ $selectedGym->id }}">
                    
                    <h5 class="fw-bold mb-3"><i class="ti ti-cloud-upload text-primary me-2"></i>Upload New Images</h5>
                    
                    <div class="upload-box mb-3" onclick="document.getElementById('imageUploadInput').click()">
                        <i class="ti ti-upload text-muted mb-2" style="font-size: 3rem;"></i>
                        <h5 class="mb-1">Click to select files</h5>
                        <p class="text-muted small mb-0">JPEG, PNG, JPG, WEBP formats allowed (Max 3MB per image).</p>
                        @if($galleries->count() < 5)
                            <p class="text-danger small fw-bold mt-2 mb-0">You can select up to {{ 5 - $galleries->count() }} more image(s).</p>
                        @else
                            <p class="text-danger small fw-bold mt-2 mb-0">Maximum limit reached. Please delete an image below to upload more.</p>
                        @endif
                    </div>
                    
                    <!-- File input -->
                    <input type="file" name="images[]" id="imageUploadInput" class="d-none" multiple accept="image/*" 
                           {{ $galleries->count() >= 5 ? 'disabled' : '' }} required onchange="updateFileCount(this)">
                           
                    <div id="selectedFilesText" class="text-center fw-bold text-primary mb-3 d-none">
                        <i class="ti ti-check"></i> <span id="fileCount">0</span> file(s) selected
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" {{ $galleries->count() >= 5 ? 'disabled' : '' }}>
                            <i class="ti ti-device-floppy me-1"></i> Save Images
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="col-12 mb-5">
        <h5 class="fw-bold mb-3">Current Gallery</h5>
        @if($galleries->count() == 0)
            <div class="alert alert-light border text-center p-5 shadow-sm">
                <i class="ti ti-camera text-muted mb-3" style="font-size: 3rem;"></i>
                <h5>No images uploaded yet!</h5>
                <p class="text-muted mb-0">Upload photos above to showcase your gym.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($galleries as $gallery)
                <div class="col-md-4 col-lg-3">
                    <div class="gallery-img-container">
                        <img src="{{ asset($gallery->image_path) }}" alt="Gym Image" loading="lazy">
                        
                        <form action="{{ route('Partnerjym.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-overlay">
                                <i class="ti ti-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function updateFileCount(input) {
    if (input.files && input.files.length > 0) {
        document.getElementById('fileCount').innerText = input.files.length;
        document.getElementById('selectedFilesText').classList.remove('d-none');
    } else {
        document.getElementById('selectedFilesText').classList.add('d-none');
    }
}
</script>
@endpush
