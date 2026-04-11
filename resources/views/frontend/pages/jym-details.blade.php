@extends('frontend.layouts.app')
@section('content')
    @php
        // Time in 12-hour format
        $opening = $jymListDetails->opening_time
            ? \Carbon\Carbon::parse($jymListDetails->opening_time)->format('h:i A')
            : '-';
        $closing = $jymListDetails->closing_time
            ? \Carbon\Carbon::parse($jymListDetails->closing_time)->format('h:i A')
            : '-';

        // Main image
        $mainImg = $jymListDetails->gym_image ? asset($jymListDetails->gym_image) : asset('images/img_1.jpg');
    @endphp

    <div class="hero page-inner overlay hero-small" style="background-image: url('{{ $mainImg }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        {{ $jymListDetails->gym_name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ================= SMALL HERO ================= */
        .hero-small {
            min-height: 260px !important;
            padding: 60px 0 40px !important;
            background-size: cover;
            background-position: center;
        }

        .hero-small .heading {
            font-size: 34px;
            margin-top: 0;
            line-height: 1.2;
        }

        /* Mobile view */
        @media (max-width: 768px) {
            .hero-small {
                min-height: 200px !important;
                padding: 40px 0 30px !important;
            }

            .hero-small .heading {
                font-size: 26px;
            }
        }

        .hero.page-inner,
        .hero.page-inner>.container>.row {
            height: 40vh;
            min-height: 250px;
        }
    </style>

    <div class="section">
        <div class="container">
            <div class="row justify-content-between">

                {{-- LEFT: MAIN IMAGE + CONTACT/INFO + RATING --}}
                <div class="col-lg-7">

                    {{-- Main Image Preview --}}
                    <div class="img-property-slide-wrap mb-3">
                        <div class="img-property-slide">
                            <img id="mainPreview" src="{{ $mainImg }}" alt="{{ $jymListDetails->gym_name }}"
                                class="img-fluid w-100 gym-main-img">
                        </div>
                    </div>

                    {{-- CONTACT US --}}
                    <div class="ui-card ui-card-soft mt-4">
                        <div class="d-flex align-items-start justify-content-between gap-3">
                            <div>
                                <div class="ui-title">Contact Us</div>
                                <div class="ui-subtitle">Get in touch with the gym owner</div>
                            </div>
                            <span class="ui-badge ui-badge-success">Available</span>
                        </div>

                        <hr class="ui-hr">

                        <div class="d-flex align-items-center gap-3">
                            <div class="ui-avatar">
                                <span>👤</span>
                            </div>
                            <div>
                                <div class="ui-name">{{ $jymListDetails->owner_name ?? '-' }}</div>
                                <div class="ui-muted">Gym Owner</div>
                            </div>
                        </div>

                        <div class="row mt-3 g-2">
                            <div class="col-md-6">
                                <div class="ui-chip">
                                    <div class="ui-chip-label">Mobile</div>
                                    <div class="ui-chip-value">{{ $jymListDetails->mobile ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ui-chip">
                                    <div class="ui-chip-label">Email</div>
                                    <div class="ui-chip-value">{{ $jymListDetails->email ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- GYM INFORMATION --}}
                    <div class="ui-card mt-3">
                        <div>
                            <div class="ui-title">Gym Information</div>
                            <div class="ui-subtitle">Location, timings & facilities</div>
                        </div>

                        <hr class="ui-hr">

                        <div class="ui-info-block">
                            <div class="ui-chip-label">Address</div>
                            <div class="ui-chip-value ui-wrap">{{ $jymListDetails->address ?? '-' }}</div>
                        </div>

                        <div class="row mt-2 g-2">
                            <div class="col-md-6">
                                <div class="ui-info-block">
                                    <div class="ui-chip-label">Open Days</div>
                                    <div class="ui-chip-value">{{ $jymListDetails->open_days ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ui-info-block">
                                    <div class="ui-chip-label">Timing</div>
                                    <div class="ui-chip-value">{{ $opening }} - {{ $closing }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="ui-info-block mt-2">
                            <div class="ui-chip-label">Facilities</div>
                            <div class="ui-chip-value">
                                Trainer: {{ $jymListDetails->trainer_available ? 'Yes' : 'No' }},
                                Parking: {{ $jymListDetails->parking_available ? 'Yes' : 'No' }},
                                AC: {{ $jymListDetails->ac_available ? 'Yes' : 'No' }}
                            </div>
                        </div>
                    </div>

                    {{-- RATING & REVIEWS --}}
                    <div class="ui-card ui-card-gradient mt-3">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="ui-title">Rating & Reviews</div>
                                <div class="ui-subtitle">Rate this gym and share your feedback</div>
                            </div>
                            <div class="text-end">
                                <div class="ui-rating-score">{{ $jymListDetails->rating }} ★</div>
                                <div class="ui-muted">({{ $jymListDetails->total_reviews }} Reviews)</div>
                            </div>
                        </div>

                        <hr class="ui-hr">

                        <div class="ui-inner-card">
                            <form action="{{ route('Review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="gym_id" value="{{ $jymListDetails->id }}">
                                
                                <div class="fw-semibold mb-2">Your Name</div>
                                <input type="text" name="user_name" class="form-control ui-input mb-3" placeholder="Enter your name" required>

                                <div class="fw-semibold mb-2">Your Rating</div>

                                <div class="star-rating mb-3">
                                    <input type="radio" id="star5" name="rating" value="5" required>
                                    <label for="star5" title="5 stars">★</label>

                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4" title="4 stars">★</label>

                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3" title="3 stars">★</label>

                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2" title="2 stars">★</label>

                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1" title="1 star">★</label>
                                </div>

                                <div class="fw-semibold mb-2">Your Review</div>
                                <textarea name="review_text" class="form-control ui-textarea" rows="3" placeholder="Write your review..." required></textarea>

                                <button type="submit" class="btn ui-btn w-100 mt-3">
                                    Submit Review
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- LATEST REVIEWS --}}
                    @if(isset($jymListDetails->reviews) && $jymListDetails->reviews->count() > 0)
                    <div class="mt-4">
                        <h5 class="ui-title-sm mb-3">Latest Reviews</h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach($jymListDetails->reviews as $review)
                            <div class="ui-card ui-card-soft p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="ui-avatar" style="width: 36px; height: 36px; font-size: 14px; background: var(--ui-primary);">
                                            {{ strtoupper(substr($review->user_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold" style="font-size: 14px;">{{ $review->user_name }}</div>
                                            <div class="ui-muted" style="font-size: 11px;">{{ $review->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="ui-rating-score" style="font-size: 16px;">
                                        {{ $review->rating }} ★
                                    </div>
                                </div>
                                <div style="font-size: 13px; color: var(--ui-text);">
                                    {{ $review->review_text }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{-- RIGHT: DETAILS + DESCRIPTION + GALLERY + QUICK ENQUIRY --}}
                <div class="col-lg-4">
                    <h2 class="heading text-primary">{{ $jymListDetails->gym_name }}</h2>
                    <p class="meta">
                        {{ $jymListDetails->city ?? '-' }}, {{ $jymListDetails->state ?? '-' }}
                    </p>

                    {{-- Description (Summernote HTML) --}}
                    <div class="text-black-50">
                        {!! $jymListDetails->description !!}
                    </div>

                    {{-- ================= GYM GALLERY ================= --}}
                    <div class="mt-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="mb-0 ui-title-sm">Gym Gallery</h5>
                            <span class="ui-badge ui-badge-primary">
                                <i class="ti ti-photo me-1"></i> 
                                @if($jymListDetails->galleries) 
                                    {{ $jymListDetails->galleries->count() }} 
                                @else 
                                    0 
                                @endif Photos
                            </span>
                        </div>
                        <p class="ui-subtitle mb-3">Click any picture below to view in full size.</p>

                        @if(empty($jymListDetails->galleries) || $jymListDetails->galleries->count() === 0)
                            <div class="ui-card ui-card-soft text-center py-4">
                                <i class="ti ti-photo text-muted mb-2" style="font-size: 2.5rem;"></i>
                                <p class="ui-muted mb-0">No gallery images uploaded yet.</p>
                            </div>
                        @else
                            <div class="row g-2">
                                @foreach($jymListDetails->galleries as $gallery)
                                <div class="col-4 col-sm-4 col-md-3 col-lg-4">
                                    <div class="position-relative overflow-hidden" style="border-radius:12px;">
                                        <img src="{{ asset($gallery->image_path) }}" 
                                            class="img-fluid gym-thumb w-100" 
                                            onclick="openLightbox('{{ asset($gallery->image_path) }}')" 
                                            alt="Gym gallery preview">
                                        <div class="thumb-overlay" onclick="openLightbox('{{ asset($gallery->image_path) }}')">
                                            <i class="ti ti-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- ================= QUICK ENQUIRY ================= --}}
                    <div class="ui-card ui-card-soft mt-4">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="ui-title">Quick Enquiry</div>
                                <div class="ui-subtitle">Send your query, we’ll contact you soon</div>
                            </div>
                            <span class="ui-badge ui-badge-primary">Fast</span>
                        </div>

                        <hr class="ui-hr">

                        <form action="{{ route('Enquiry.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="gym_id" value="{{ $jymListDetails->id }}">
                            
                            <div class="mb-2">
                                <label class="form-label ui-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control ui-input" placeholder="Enter your name" required maxlength="255">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label ui-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" class="form-control ui-input" placeholder="10-digit mobile number" required pattern="[0-9]{10}" title="Must be a 10 digit number">
                                @error('mobile')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label ui-label">Message</label>
                                <textarea name="message" class="form-control ui-textarea" rows="3" placeholder="I want to know about membership..."></textarea>
                                @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <button type="submit" class="btn ui-btn w-100">
                                Send Enquiry <i class="ti ti-send ms-1"></i>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sent!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#4f46e5'
                });
            @endif
        });
    </script>

    <!-- Lightbox Modal -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-header border-0 pb-0 position-absolute w-100 p-3 d-flex justify-content-end" style="z-index: 1055;">
                    <button type="button" class="btn-close btn-close-white bg-dark p-2 rounded-circle shadow" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="lightboxImage" src="" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 85vh; object-fit: contain; background: rgba(0,0,0,0.5);" alt="Gallery Zoom">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openLightbox(url) {
            document.getElementById('lightboxImage').src = url;
            // Also update the main preview
            document.getElementById('mainPreview').src = url;
            var myModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
            myModal.show();
        }
    </script>

    <style>
        /* ========= THEME ========= */
        :root {
            --ui-primary: #4f46e5;
            /* indigo */
            --ui-primary2: #6366f1;
            --ui-success: #16a34a;
            /* green */
            --ui-bg: #f8fafc;
            --ui-border: #e5e7eb;
            --ui-text: #0f172a;
            --ui-muted: #64748b;
            --ui-shadow: 0 10px 25px rgba(15, 23, 42, .06);
        }

        /* Main image */
        .gym-main-img {
            border-radius: 16px;
            object-fit: cover;
            max-height: 420px;
            box-shadow: var(--ui-shadow);
        }

        /* Cards */
        .ui-card {
            background: #fff;
            border: 1px solid var(--ui-border);
            border-radius: 18px;
            padding: 22px;
            box-shadow: var(--ui-shadow);
        }

        .ui-card-soft {
            background: var(--ui-bg);
        }

        .ui-card-gradient {
            background: linear-gradient(135deg, rgba(79, 70, 229, .10), rgba(248, 250, 252, 1));
        }

        /* Titles */
        .ui-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--ui-primary);
            letter-spacing: .2px;
        }

        .ui-title-sm {
            font-size: 16px;
            font-weight: 800;
            color: var(--ui-primary);
        }

        .ui-subtitle {
            font-size: 13px;
            color: var(--ui-muted);
        }

        .ui-muted {
            color: var(--ui-muted);
            font-size: 13px;
        }

        /* HR */
        .ui-hr {
            border-top: 1px solid var(--ui-border);
            opacity: 1;
            margin: 14px 0;
        }

        /* Avatar */
        .ui-avatar {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 8px 20px rgba(79, 70, 229, .20);
        }

        .ui-name {
            font-size: 16px;
            font-weight: 800;
            color: var(--ui-text);
        }

        /* Badges */
        .ui-badge {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid transparent;
        }

        .ui-badge-success {
            background: rgba(22, 163, 74, .12);
            color: var(--ui-success);
            border-color: rgba(22, 163, 74, .18);
        }

        .ui-badge-primary {
            background: rgba(79, 70, 229, .12);
            color: var(--ui-primary);
            border-color: rgba(79, 70, 229, .18);
        }

        /* Chips */
        .ui-chip {
            background: #fff;
            border: 1px solid var(--ui-border);
            border-radius: 14px;
            padding: 12px 14px;
        }

        .ui-chip-label {
            font-size: 12px;
            color: var(--ui-muted);
        }

        .ui-chip-value {
            font-weight: 700;
            color: var(--ui-text);
        }

        .ui-wrap {
            white-space: pre-line;
        }

        /* Info blocks */
        .ui-info-block {
            background: var(--ui-bg);
            border: 1px solid var(--ui-border);
            border-radius: 14px;
            padding: 14px;
        }

        /* Inputs */
        .ui-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--ui-text);
        }

        .ui-input,
        .ui-textarea {
            border-radius: 12px !important;
            border: 1px solid var(--ui-border) !important;
            padding: 10px 12px !important;
        }

        .ui-input:focus,
        .ui-textarea:focus {
            border-color: rgba(79, 70, 229, .55) !important;
            box-shadow: 0 0 0 .2rem rgba(79, 70, 229, .12) !important;
        }

        /* Button */
        .ui-btn {
            background: linear-gradient(135deg, var(--ui-primary), var(--ui-primary2));
            border: none;
            color: #fff;
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 800;
            box-shadow: 0 10px 22px rgba(79, 70, 229, .22);
        }

        /* Thumbnails & Lightbox */
        .gym-thumb {
            cursor: pointer;
            border-radius: 12px;
            height: 100px;
            object-fit: cover;
            width: 100%;
            transition: transform .25s ease, filter .25s ease;
            background: #f1f5f9;
        }

        .thumb-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.25s ease;
            cursor: pointer;
            color: #fff;
            font-size: 1.5rem;
        }

        .position-relative:hover .gym-thumb {
            transform: scale(1.03);
        }
        .position-relative:hover .thumb-overlay {
            opacity: 1;
        }

        /* Inner card */
        .ui-inner-card {
            background: #fff;
            border: 1px solid var(--ui-border);
            border-radius: 16px;
            padding: 16px;
        }

        /* Rating score */
        .ui-rating-score {
            font-size: 22px;
            font-weight: 900;
            color: #f59e0b;
        }

        /* Modern Star Rating (pure CSS) */
        .star-rating {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 6px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 30px;
            cursor: pointer;
            user-select: none;
            color: #dcdcdc;
            transition: transform .12s ease, color .12s ease;
            line-height: 1;
        }

        .star-rating label:hover {
            transform: scale(1.06);
        }

        .star-rating input:checked~label {
            color: #f5b301;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f5b301;
        }
    </style>
@endsection
