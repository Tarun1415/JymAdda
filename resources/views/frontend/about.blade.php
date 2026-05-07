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
            <!-- Founder Details (Left Side) -->
            <div class="founder-col">
                <div class="founder-photo-wrap">
                    <img src="{{ asset('images/founder.jpeg') }}" onerror="this.src='https://ui-avatars.com/api/?name=Tarun+Singh&size=400&background=4f46e5&color=fff'" alt="Tarun Singh" class="founder-photo">
                </div>
                <div class="founder-info">
                    <h3>Tarun Kumar</h3>
                    <span class="founder-role">Founder & CEO, GymHai</span>
                    <p class="founder-quote">
                        "I started GymHai to make fitness accessible to everyone and empower gym owners with the right tools. Every feature we build is designed keeping your fitness journey in mind."
                    </p>
                   <div class="founder-socials">
    <a href="https://www.linkedin.com/in/tarun-kumar-63954b190" target="_blank" title="LinkedIn">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
        </svg>
    </a>

<a href="https://www.facebook.com/profile.php?id=100009870395609" target="_blank" title="Facebook">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
<path d="M22.675 0h-21.35C.595 0 0 .595 0 1.326v21.348C0 23.405.595 24 1.326 24H12.82V14.706H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24h-1.918c-1.505 0-1.796.715-1.796 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.325-.595 1.325-1.326V1.326C24 .595 23.405 0 22.675 0z"/>
</svg>
</a>

 <a href="https://www.instagram.com/_tarun2515/?hl=en" target="_blank" title="Instagram">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
<path d="M7.75 2C4.574 2 2 4.574 2 7.75v8.5C2 19.426 4.574 22 7.75 22h8.5c3.176 0 5.75-2.574 5.75-5.75v-8.5C22 4.574 19.426 2 16.25 2h-8.5zm0 2h8.5C18.216 4 20 5.784 20 7.75v8.5c0 1.966-1.784 3.75-3.75 3.75h-8.5C5.784 20 4 18.216 4 16.25v-8.5C4 5.784 5.784 4 7.75 4zm4.25 2.75a5.5 5.5 0 100 11 5.5 5.5 0 000-11zm0 2a3.5 3.5 0 110 7 3.5 3.5 0 010-7zm5.25-.88a1.12 1.12 0 100 2.24 1.12 1.12 0 000-2.24z"/>
</svg>
</a>
</div>
                </div>
            </div>

            <!-- Mission Details (Right Side) -->
            <div class="mission-col">
                <div class="mission-badge">🚀 Our Mission</div>
                <h2 class="mission-title">Building a <span class="text-gradient">Fitter India</span></h2>
                <p class="mission-desc">
                    At GymHai, we believe that finding the right gym should be simple, and growing a gym business should be
                    accessible to everyone. We're building a transparent, community-driven platform that puts real information
                    first — for a fitter, healthier India.
                </p>
            </div>
        </div>
    </div>
@endsection
