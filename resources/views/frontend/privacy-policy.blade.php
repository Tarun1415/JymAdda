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
            <p>Welcome to <strong>GymHai.online</strong> ("we", "our", or "us"). We respect your privacy and are highly committed to protecting your personal data. This comprehensive Privacy Policy explains in detail how we collect, use, disclose, and safeguard your information when you visit our website, use our mobile applications, or engage with our fitness management CRM and directory services.</p>

            <h2>1. Information We Collect</h2>
            <p>We collect various types of information to provide and continuously improve our services:</p>
            <ul>
                <li><strong>Personal Identification Data:</strong> Your full name, email address, phone number, and date of birth when you register for an account, subscribe to our newsletters, or contact support.</li>
                <li><strong>Business Information (For Partners):</strong> Gym name, registration documents, tax IDs, banking details for payouts, and facility photos.</li>
                <li><strong>Location Data:</strong> Precise or approximate geographical location (if you grant permission) to provide you with the most relevant, localized gym search results.</li>
                <li><strong>Usage & Technical Data:</strong> Information on how you interact with our website, including IP addresses, browser types, operating systems, pages visited, time spent, and navigation paths.</li>
                <li><strong>Cookies & Tracking Technologies:</strong> We use cookies, web beacons, and similar tracking technologies to track activity on our platform, store user preferences, and deliver targeted advertising.</li>
            </ul>

            <h2>2. How We Use Your Data</h2>
            <p>The information we collect is strictly used for the following operational and business purposes:</p>
            <ul>
                <li>To provide, maintain, and upgrade our platform's functionality and user interface.</li>
                <li>To offer personalized gym suggestions, localized fitness content, and tailored marketing campaigns.</li>
                <li>To process transactions securely, manage subscriptions, and send billing notifications.</li>
                <li>To communicate with you efficiently, including responding to inquiries, sending service updates, and providing reliable customer support.</li>
                <li>To monitor usage patterns, detect fraudulent activities, and enhance overall platform security.</li>
            </ul>

            <h2>3. Data Sharing and Third-Party Tools</h2>
            <p>We do not sell your personal data. However, we may share your information with trusted third-party service providers to facilitate our operations:</p>
            <ul>
                <li><strong>Analytics Providers:</strong> Services like Google Analytics help us understand website traffic and user behavior securely.</li>
                <li><strong>Payment Processors:</strong> We use secure payment gateways to process transactions. We do not store your credit card details on our servers.</li>
                <li><strong>Advertising Partners:</strong> We may partner with networks like Google AdSense to show relevant advertisements. These partners may use cookies to serve ads based on your prior visits to our website or other websites.</li>
                <li><strong>Legal Requirements:</strong> We may disclose your data if required by law or in response to valid requests by public authorities.</li>
            </ul>

            <h2>4. Data Retention and Security</h2>
            <p>The security of your data is paramount. We implement industry-standard encryption protocols (SSL/TLS), secure server hosting, and regular security audits to protect your personal information from unauthorized access, alteration, disclosure, or destruction. We retain your personal data only for as long as is necessary for the purposes set out in this Privacy Policy, or as required by law.</p>

            <h2>5. Your Privacy Rights (GDPR & CCPA)</h2>
            <p>Depending on your location, you have full control over your personal information. You have the right to:</p>
            <ul>
                <li><strong>Access:</strong> Request copies of the personal data we hold about you.</li>
                <li><strong>Rectification:</strong> Request the correction of inaccurate or incomplete data.</li>
                <li><strong>Erasure (Right to be Forgotten):</strong> Request the permanent deletion of your personal data from our active systems.</li>
                <li><strong>Opt-Out:</strong> Withdraw your consent for marketing communications or data processing at any time.</li>
            </ul>
            <p>To exercise any of these rights, please contact our Data Protection Officer at <strong>privacy@gymhai.online</strong>.</p>

            <div class="policy-footer">
                By using GymHai.online, you acknowledge that you have read and agree to our Privacy Policy. Last Updated: {{ date('F Y') }}
            </div>
        </div>
    </div>
</section>
@endsection
