@extends('frontend.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about-contact.css') }}">
@endpush

@section('content')
<!-- Hero Section -->
<section class="page-hero">
    <div class="ph-content" data-aos="fade-up">
        <div class="ph-subtitle">Contact Us</div>
        <h1 class="ph-title">We're here to <span>help you</span></h1>
        <p class="ph-desc">
            Have a question about GymHai, or need support setting up your partner account? Reach out to us 24/7.
        </p>
    </div>
</section>

<!-- Content Layout -->
<section class="page-container">
    <div class="contact-layout" data-aos="fade-up" data-aos-delay="100">
        
        <!-- Left: Contact Details -->
        <div class="contact-info">
            <h3>Get In Touch</h3>
            <p>Our dedicated support team is always ready to assist you.</p>

            <div class="info-item">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="28" height="28">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                </div>
                <div class="info-text">
                    <h4>Head Office</h4>
                    <span>Sec-66, Noida, Uttar Pradesh 201301</span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="28" height="28">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.18-7.076-7.076l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </div>
                <div class="info-text">
                    <h4>Phone Support</h4>
                    <span>+91 9709337924</span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="28" height="28">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="info-text">
                    <h4>Email Address</h4>
                    <span>support@GymHai.com</span>
                </div>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="contact-form-wrap">
            
            @if(session('success'))
                <div style="background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required>
                    @error('name') <span class="text-danger" style="font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="john@example.com" required>
                        @error('email') <span class="text-danger" style="font-size:13px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+91 xxxxx xxxxx">
                    </div>
                </div>

                <div class="form-group">
                    <label>Your Message</label>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                    @error('message') <span class="text-danger" style="font-size:13px;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Send Message
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20" height="20" style="margin-left: 8px;">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </button>
            </form>
        </div>

    </div>
</section>

@endsection
