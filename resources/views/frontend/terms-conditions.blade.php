@extends('frontend.layouts.app')

@push('styles')
<style>
    .page-hero-policy {
        background: linear-gradient(135deg, #4f46e5 0%, #0f172a 100%);
        padding: 160px 0 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .page-hero-policy::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4f46e5, #ec4899);
    }

    .page-hero-policy h1 {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 20px;
        background: linear-gradient(to right, #ffffff, #cbd5e1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -1px;
    }

    .page-hero-policy p {
        font-size: 18px;
        color: #94a3b8;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .policy-wrapper {
        background-color: #f8fafc;
        padding: 80px 0;
    }

    .policy-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 50px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }

    .policy-container h2 {
        font-size: 26px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 45px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .policy-container h2::before {
        content: '';
        display: inline-block;
        width: 8px;
        height: 24px;
        background: linear-gradient(180deg, #4f46e5, #ec4899);
        border-radius: 4px;
    }

    .policy-container p {
        font-size: 17px;
        line-height: 1.8;
        color: #475569;
        margin-bottom: 20px;
    }

    .policy-container strong {
        color: #1e293b;
        font-weight: 600;
    }

    .policy-container ul {
        margin-bottom: 30px;
        padding-left: 0;
        list-style: none;
    }

    .policy-container li {
        font-size: 17px;
        line-height: 1.7;
        color: #475569;
        margin-bottom: 12px;
        padding-left: 28px;
        position: relative;
    }

    .policy-container li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 0;
        color: #4f46e5;
        font-weight: bold;
        font-size: 16px;
    }

    .policy-footer {
        margin-top: 60px;
        padding-top: 30px;
        border-top: 2px dashed #e2e8f0;
        font-weight: 600;
        color: #4f46e5;
        text-align: center;
        font-size: 18px;
        background: linear-gradient(90deg, #4f46e5, #ec4899);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @media (max-width: 768px) {
        .policy-container {
            padding: 30px 20px;
        }
        .page-hero-policy h1 {
            font-size: 36px;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="page-hero-policy">
    <div class="container" data-aos="fade-up">
        <h1>Terms & Conditions</h1>
        <p>Please read these rules carefully before using our platform to understand your rights and responsibilities.</p>
    </div>
</section>

<!-- Content Layout -->
<section class="policy-wrapper">
    <div class="container">
        <div class="policy-container" data-aos="fade-up" data-aos-delay="100">
            <p>Welcome to <strong>GymHai.online</strong>. These terms and conditions outline the rules and regulations for the use of our website and services. By accessing this website, we assume you accept these terms and conditions in full.</p>

            <h2>1. Purpose of the Website</h2>
            <p><strong>gymhai.online</strong> is an advanced platform dedicated to helping users discover gyms, fitness centers, and health clubs. We also provide CRM and management tools for gym owners to manage their facilities efficiently. Our goal is to connect fitness enthusiasts with the best local gym options.</p>

            <h2>2. User Responsibilities</h2>
            <p>As a user of our platform, you agree to the following responsibilities:</p>
            <ul>
                <li><strong>Accurate Information:</strong> You must not submit false, misleading, or inaccurate information when registering, reviewing, or submitting forms.</li>
                <li><strong>Acceptable Use:</strong> You agree not to use the platform for spamming, harassment, distributing malware, or any other unauthorized or illegal misuse.</li>
                <li><strong>Respect for Others:</strong> You will engage respectfully with other users and gym owners when leaving reviews or inquiries.</li>
            </ul>

            <h2>3. Gym Listings & Accuracy</h2>
            <p>While we strive to keep our directory updated, please note:</p>
            <ul>
                <li>We do not guarantee the absolute accuracy, completeness, or timeliness of the gym details, pricing, or operating hours listed on the platform.</li>
                <li>Gym owners and partners are solely responsible for the content, offers, and details they publish on their respective listing pages.</li>
            </ul>

            <h2>4. Account Security</h2>
            <p>If you create an account on gymhai.online, you are responsible for maintaining the security of your login details. You are fully responsible for all activities that occur under your account. You must immediately notify us of any unauthorized uses of your account or any other breaches of security.</p>

            <h2>5. Limitation of Liability</h2>
            <p>Your health and safety are important, but we are a discovery platform. Therefore:</p>
            <ul>
                <li>We are not responsible for any physical injury, financial loss, or damages that occur at any gym or fitness center found through our platform.</li>
                <li>We hold no liability for any disputes that arise between users and gym owners.</li>
            </ul>

            <h2>6. Changes to Terms</h2>
            <p>We reserve the right to update or modify these Terms and Conditions at any time without prior notice. Your continued use of the website following any changes indicates your acceptance of the new terms.</p>

            <div class="policy-footer">
                By accessing gymhai.online, you accept these terms and conditions.
            </div>
        </div>
    </div>
</section>
@endsection
