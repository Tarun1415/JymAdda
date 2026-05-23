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
            <p>Welcome to <strong>GymHai.online</strong>. These detailed Terms and Conditions outline the rules, regulations, and legal obligations for the use of our website, applications, and fitness CRM services. By accessing or using this website, you accept these terms and conditions in full. If you disagree with any part of these terms, you must not use our platform.</p>

            <h2>1. Platform Purpose and Scope</h2>
            <p><strong>GymHai.online</strong> operates as an advanced digital fitness ecosystem. We provide a directory for fitness enthusiasts to discover local gyms, read reviews, and connect with fitness centers. Simultaneously, we offer a B2B Software-as-a-Service (SaaS) CRM platform for gym owners to manage memberships, billing, and leads.</p>

            <h2>2. User Accounts and Responsibilities</h2>
            <p>To access certain features, you may be required to create an account. You agree to:</p>
            <ul>
                <li><strong>Provide Accurate Information:</strong> You must submit true, current, and complete information during registration and keep your profile updated.</li>
                <li><strong>Maintain Account Security:</strong> You are strictly responsible for safeguarding your password and account details. You must immediately notify us of any unauthorized use or security breach.</li>
                <li><strong>Acceptable Use:</strong> You agree not to use the platform for scraping data, spamming, harassment, distributing malware, or attempting to breach our security infrastructure.</li>
            </ul>

            <h2>3. Gym Listings, Content, and Accuracy</h2>
            <p>We strive to maintain a high-quality directory, but we operate as an intermediary platform:</p>
            <ul>
                <li><strong>No Guarantees:</strong> We do not guarantee the absolute accuracy, completeness, or timeliness of the gym details, pricing, or operating hours listed on the platform.</li>
                <li><strong>Partner Responsibility:</strong> Gym owners and partners are solely responsible for the content, promotional offers, images, and specific details they publish on their respective listing pages.</li>
                <li><strong>User-Generated Content:</strong> Any reviews, comments, or ratings posted by users must be based on genuine experiences. We reserve the right to remove offensive, fake, or defamatory content without notice.</li>
            </ul>

            <h2>4. Intellectual Property Rights</h2>
            <p>Unless otherwise stated, GymHai and/or its licensors own the intellectual property rights for all material on the platform, including logos, software code, UI designs, and written content. You may view and/or print pages for your own personal use subject to restrictions set in these terms. You must not republish, sell, rent, or sub-license our proprietary material.</p>

            <h2>5. Payments and Subscriptions</h2>
            <p>For Gym Partners using our premium CRM services:</p>
            <ul>
                <li>All subscription fees are billed in advance on a recurring basis (monthly or annually) depending on your selected plan.</li>
                <li>Failure to pay subscription fees may result in immediate suspension or termination of your premium features and listing visibility.</li>
                <li>Please refer to our Refund Policy for detailed information regarding cancellations and refunds.</li>
            </ul>

            <h2>6. Limitation of Liability and Indemnification</h2>
            <p>Your health, safety, and business success are important, but you use our platform at your own risk. To the maximum extent permitted by applicable law:</p>
            <ul>
                <li>We are not responsible or liable for any physical injury, health issues, financial loss, or damages that occur at any physical gym or fitness center found through our platform.</li>
                <li>We hold no liability for any business disputes, loss of revenue, or operational issues that arise between users and gym owners.</li>
                <li>You agree to indemnify and hold harmless GymHai.online and its affiliates from any claims, damages, or expenses arising from your violation of these Terms.</li>
            </ul>

            <h2>7. Governing Law and Modifications</h2>
            <p>These terms shall be governed by and construed in accordance with the laws of our operating jurisdiction. We reserve the right to update or modify these Terms and Conditions at any time without prior notice. Your continued use of the website following any changes indicates your acceptance of the new terms.</p>

            <div class="policy-footer">
                By accessing GymHai.online, you legally accept these terms and conditions. Last Updated: {{ date('F Y') }}
            </div>
        </div>
    </div>
</section>
@endsection
