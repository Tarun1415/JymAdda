@extends('frontend.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about-contact.css') }}?v=1.0">
    @endpush

@section('content')
    <!-- ===== HERO ===== -->
    <section class="page-hero">
        <div class="ph-content">
            <div class="ph-subtitle">About GymHai</div>
            <h1 class="ph-title">Building a <span>Fitter India</span></h1>
            <p class="ph-desc">
                Whether you are looking for the perfect gym to start your fitness journey, or you are a gym owner
                wanting to scale your business — GymHai bridges the gap with cutting-edge technology.
            </p>
        </div>
    </section>

    <!-- ===== FOR GYM OWNERS ===== -->
    <div class="ab-wrap" style="margin-top: 40px;">
        <div class="ab-section-title">
            <div class="tag tag-partner">🏢 For Gym Owners</div>
            <h2>Grow Your Fitness Business</h2>
            <p>A complete digital toolkit for gym owners — from building your profile to collecting member enquiries.</p>
        </div>
        <div class="feat-grid">
            <div class="feat-card fc-partner">
                <div class="feat-icon ic-partner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                </div>
                <h3>Gym Listing</h3>
                <p>Create a comprehensive gym profile with name, address, facilities, timings, and contact info — all in one
                    place.</p>
            </div>
            <div class="feat-card fc-partner">
                <div class="feat-icon ic-partner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <h3>Gallery Management</h3>
                <p>Upload high-quality photos of your gym. A visually appealing gallery builds trust and drives more
                    enquiries.</p>
            </div>
            <div class="feat-card fc-partner">
                <div class="feat-icon ic-partner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <h3>Gym Memberships</h3>
                <p>Showcase your Monthly, Quarterly, and Annual membership plans directly on your gym page for full
                    transparency.</p>
            </div>
            <div class="feat-card fc-partner">
                <div class="feat-icon ic-partner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <h3>Enquiry Lead Form</h3>
                <p>Every gym page includes a built-in enquiry form. Interested users send their details directly to you — no
                    middleman.</p>
            </div>
        </div>
    </div>

    <div class="ab-divider"></div>

    <!-- ===== FOR USERS ===== -->
    <div class="ab-wrap">
        <div class="ab-section-title">
            <div class="tag tag-client">👤 For Users</div>
            <h2>Find the Perfect Gym, Effortlessly</h2>
            <p>Search by city, pincode, or your current location. Read real reviews and make confident decisions.</p>
        </div>
        <div class="feat-grid">
            <div class="feat-card fc-client">
                <div class="feat-icon ic-client">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </div>
                <h3>City & Pincode Search</h3>
                <p>Enter your city name or pincode to instantly browse all available gyms in your area with complete
                    details.</p>
            </div>
            <div class="feat-card fc-client">
                <div class="feat-icon ic-client">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
                    </svg>
                </div>
                <h3>Near Me Search</h3>
                <p>Allow location access and discover gyms closest to you in seconds. Distance-sorted results for your
                    convenience.</p>
            </div>
            <div class="feat-card fc-client">
                <div class="feat-icon ic-client">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                </div>
                <h3>Ratings & Reviews</h3>
                <p>Explore genuine star ratings and detailed member reviews on every gym profile to help you choose wisely.
                </p>
            </div>
        </div>
    </div>

    <!-- ===== FREE PLAN BANNER ===== -->
    <div class="free-banner">
        <div class="free-banner-inner">
            <div class="free-banner-text">
                <span class="eyebrow">🎉 Basic Plan</span>
                <h2>Everything You Need —<br>Completely Free</h2>
                <p>List your gym on GymHai and access all essential features at absolutely zero cost. No credit card. No
                    hidden fees.</p>
                <ul class="free-perks">
                    <li>Full Gym Profile Page</li>
                    <li>Photo Gallery Upload</li>
                    <li>Membership Plans Display</li>
                    <li>Enquiry Lead Form</li>
                    <li>City & Near Search Visibility</li>
                    <li>Ratings & Reviews Access</li>
                </ul>
            </div>
            <div class="free-banner-cta">
                <a href="{{ route('partner.register') }}" class="btn-free">
                    List Your Gym Free
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"
                        stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <small>No credit card required &nbsp;•&nbsp; Free forever</small>
            </div>
        </div>
    </div>

    <!-- ===== MISSION ===== -->
    <div class="mission-strip">
        <div class="mission-inner">
            <h2>Our Mission</h2>
            <p>
                At GymHai, we believe that finding the right gym should be simple, and growing a gym business should be
                accessible to everyone. We're building a transparent, community-driven platform that puts real information
                first — for a fitter, healthier India.
            </p>
        </div>
    </div>
@endsection
