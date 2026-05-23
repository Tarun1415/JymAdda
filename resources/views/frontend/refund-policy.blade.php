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
        <h1>Refund Policy</h1>
        <p>Understanding our payment, cancellation, and refund procedures clearly and transparently.</p>
    </div>
</section>

<!-- Content Layout -->
<section class="policy-wrapper">
    <div class="container">
        <div class="policy-container" data-aos="fade-up" data-aos-delay="100">
            <p>Thank you for choosing <strong>GymHai.online</strong>. We are committed to delivering premium digital solutions for the fitness community. This comprehensive Refund and Cancellation Policy outlines the strict terms regarding payments made for premium features, subscriptions, advertising, gym listings, or any other digital services offered on our platform.</p>

            <h2>1. Nature of Digital Services</h2>
            <p>All transactions processed on GymHai.online are for <strong>intangible, digital services and software access</strong>. This includes, but is not limited to, B2B CRM software subscriptions for gym owners, premium listing placements, lead generation packages, and advertising slots. Because our services provide immediate digital access and value, our refund policy is strictly structured.</p>

            <h2>2. General Refund Rules & No-Refund Policy</h2>
            <p>We adhere to a strict no-refund policy for all digital services once they have been delivered or activated. Please read the following carefully:</p>
            <ul>
                <li><strong>No Refunds After Activation:</strong> Once a service, subscription, or ad campaign has been activated, customized, or made live on the platform, no refunds will be granted under any circumstances.</li>
                <li><strong>Change of Mind:</strong> We do not offer refunds for "buyer's remorse" or if you simply decide you no longer need the software or listing after purchasing. We encourage all users to utilize our Free Trial (if available) before committing to a paid plan.</li>
                <li><strong>Business Performance:</strong> We do not guarantee a specific number of footfalls, leads, or revenue increases. Refunds will not be issued based on the business performance or ROI of your gym listing.</li>
            </ul>

            <h2>3. Subscription Renewals and Cancellations</h2>
            <p>If you are subscribed to a recurring premium plan (Monthly or Annually):</p>
            <ul>
                <li><strong>User Responsibility:</strong> It is your absolute responsibility to cancel any recurring subscriptions before the upcoming renewal billing date if you do not wish to be charged further.</li>
                <li><strong>Cancellation Process:</strong> You can cancel your subscription at any time via your Partner Dashboard settings. Cancellation will prevent future charges, but it will not trigger a refund for the current active billing cycle.</li>
                <li><strong>Access After Cancellation:</strong> After cancellation, you will retain access to your premium features until the end of your current paid billing period.</li>
            </ul>

            <h2>4. Exceptions: Technical Issues & Billing Errors</h2>
            <p>We strive to provide a flawless experience. A refund may be considered <strong>only</strong> in the following exceptional scenarios:</p>
            <ul>
                <li><strong>Major Technical Failure:</strong> If a severe, documented technical issue or prolonged platform downtime prevents you from accessing the core services you paid for, and our engineering team is unable to resolve it within 72 business hours.</li>
                <li><strong>Duplicate Billing:</strong> If you provide proof that you were charged multiple times for a single transaction due to a payment gateway error on our end.</li>
            </ul>

            <h2>5. How to Request a Refund or Report an Issue</h2>
            <p>If you believe you qualify for a refund under the technical issue or billing error exceptions, please follow these strict steps within 7 days of the transaction:</p>
            <ul>
                <li>Send an email directly to our billing department at <strong>billing@gymhai.online</strong>.</li>
                <li>Include your Account ID, payment receipt, transaction ID, and a detailed explanation (with screenshots) of the technical issue or duplicate charge.</li>
                <li>Chargebacks initiated through your bank without first contacting our support team will result in immediate permanent suspension of your account and gym listing.</li>
            </ul>

            <div class="policy-footer">
                For any queries regarding this policy, feel free to reach out to our support team. Last Updated: {{ date('F Y') }}
            </div>
        </div>
    </div>
</section>
@endsection
