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
        <h1>Privacy Policy</h1>
        <p>Your privacy is critically important to us. Learn how we collect, use, and protect your data securely on our platform.</p>
    </div>
</section>

<!-- Content Layout -->
<section class="policy-wrapper">
    <div class="container">
        <div class="policy-container" data-aos="fade-up" data-aos-delay="100">
            <p>Welcome to <strong>GymHai.online</strong>. We respect your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p>

            <h2>1. Information We Collect</h2>
            <p>We collect information to provide better services to all our users. The types of personal data we collect include:</p>
            <ul>
                <li><strong>Personal Details:</strong> Your name, email address, and phone number when you register, fill out forms, or contact us.</li>
                <li><strong>Location Data:</strong> Your geographical location (if you grant permission) to provide you with the most relevant gym search results near you.</li>
                <li><strong>Usage Data:</strong> Information on how you interact with our website, including pages visited, time spent, and search queries.</li>
                <li><strong>Cookies & Analytics:</strong> We use cookies and similar tracking technologies (like Google Analytics) to track the activity on our platform and hold certain information.</li>
            </ul>

            <h2>2. How We Use Your Data</h2>
            <p>The information we collect is used for the following purposes:</p>
            <ul>
                <li>To provide, maintain, and improve our platform functionality.</li>
                <li>To offer personalized gym suggestions and tailored content based on your location and preferences.</li>
                <li>To communicate with you, including responding to inquiries and providing reliable customer support.</li>
                <li>To monitor the usage of our platform and perform technical analysis to enhance user experience.</li>
            </ul>

            <h2>3. Third-Party Tools & Services</h2>
            <p>We may share your data with trusted third-party service providers to facilitate our services. These include:</p>
            <ul>
                <li><strong>Google Analytics:</strong> Used to understand our website traffic and user behavior securely.</li>
                <li><strong>Advertising Partners:</strong> We may use platforms like Google Ads to show relevant advertisements to our users.</li>
            </ul>
            <p>These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>

            <h2>4. Data Security</h2>
            <p>The security of your data is paramount to us. We take reasonable steps and implement industry-standard security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>

            <h2>5. Your Data Rights</h2>
            <p>You have full control over your personal information. You have the right to:</p>
            <ul>
                <li>Request access to the personal data we hold about you.</li>
                <li>Request the correction of inaccurate or incomplete data at any time.</li>
                <li>Request the deletion of your personal data from our systems.</li>
                <li>Withdraw your consent where we relied on it to process your personal information.</li>
            </ul>
            <p>To exercise any of these rights, please contact us via our Support page.</p>

            <div class="policy-footer">
                By using gymhai.online, you agree to our Privacy Policy.
            </div>
        </div>
    </div>
</section>
@endsection
