@extends('frontend.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about-contact.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<section class="page-hero">
    <div class="ph-content" data-aos="fade-up">
        <div class="ph-subtitle">About Us</div>
        <h1 class="ph-title">Building a <span>Fitter India</span></h1>
        <p class="ph-desc">
            We are dedicated to bridging the gap between premium fitness centers and health enthusiasts through smart technology and transparent reviews.
        </p>
    </div>
</section>

<!-- Content Layout -->
<section class="page-container">
    <div class="about-grid">
        
        <!-- Card 1 -->
        <div class="about-card" data-aos="fade-up" data-aos-delay="100">
            <div class="about-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="36" height="36">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.36c-5.91.58-7.15-4.92-3.85-8.54 1.66-1.81 3.99-2.88 6.52-2.88.24 0 .5.01.75.04M15.59 14.37A6 6 0 0 1 21 16.5m-5.41-2.13a6 6 0 0 0-4.08-1.12M21 16.5a6 6 0 0 1-9.49 4.81M21 16.5a6 6 0 0 0-5.41-6.13m0 0a6.002 6.002 0 0 0-4.08 1.12m0 0a5.986 5.986 0 0 0-3.32 4.09m6.4-12.82c-.93 0-1.87-.27-2.61-.8m6.65 1.5c-.83-.49-1.81-.7-2.79-.7m2.79.7c.94.57 2.06 1.7 2.51 3.52M6.28 10.51a5.002 5.002 0 0 1 3.73-4.3" />
                </svg>
            </div>
            <h3>Our Mission</h3>
            <p>To make gym management simple for partners, and finding the perfect workout space effortless for every individual looking to improve their health.</p>
        </div>

        <!-- Card 2 -->
        <div class="about-card" data-aos="fade-up" data-aos-delay="200">
            <div class="about-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="36" height="36">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                </svg>
            </div>
            <h3>Why Choose Us?</h3>
            <p>100% verified listings. Genuine customer reviews. We guarantee transparent information directly from gym owners so you make confident choices.</p>
        </div>

        <!-- Card 3 -->
        <div class="about-card" data-aos="fade-up" data-aos-delay="300">
            <div class="about-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="36" height="36">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
            <h3>Our Team</h3>
            <p>Our dedicated team works round the clock to ensure gym partners receive the best leads, while users get exceptional facilities at great prices.</p>
        </div>

    </div>
</section>

@endsection
