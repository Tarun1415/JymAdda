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
            <p>Thank you for choosing <strong>GymHai.online</strong>. This Refund Policy outlines the terms regarding payments made for premium features, advertising, gym listings, or any other digital services offered on our platform.</p>

            <h2>1. Nature of Payments</h2>
            <p>All payments made on gymhai.online are for <strong>digital services and software access</strong>. This includes, but is not limited to, CRM software subscriptions for gym owners, premium listing placements, advertising packages, and premium member features.</p>

            <h2>2. General Refund Rules</h2>
            <p>Because our services are digital and provide immediate access or placement, we strictly adhere to the following rules regarding refunds:</p>
            <ul>
                <li><strong>No Refunds After Activation:</strong> Once a service, subscription, or ad campaign has been activated and is accessible or live on the platform, no refunds will be granted.</li>
                <li><strong>Subscription Renewals:</strong> It is the user's responsibility to cancel any recurring subscriptions before the renewal date if they do not wish to be charged. We do not refund charges for subscriptions that were not canceled in time.</li>
            </ul>

            <h2>3. Exceptions for Technical Issues</h2>
            <p>We strive to provide a seamless experience, but technical glitches can happen. A refund may be considered <strong>only</strong> in the following scenarios:</p>
            <ul>
                <li>If there is a severe technical issue or platform downtime that prevents you from accessing a service you just paid for, and our support team is unable to resolve it within a reasonable timeframe.</li>
                <li>If you were charged multiple times for a single transaction due to a payment gateway error.</li>
            </ul>

            <h2>4. How to Request a Refund</h2>
            <p>If you believe you qualify for a refund under our technical issues exception, please follow these steps:</p>
            <ul>
                <li>Contact our support team immediately at <strong>support@GymHai.com</strong>.</li>
                <li>Provide your payment receipt and a detailed explanation of the technical issue.</li>
                <li>Our team will review the request and get back to you within 3-5 business days.</li>
            </ul>

            <h2>5. Changes to This Policy</h2>
            <p>We may update this Refund Policy periodically. We advise you to review this page before making any new purchases on our platform. Continued use signifies your acceptance of our terms.</p>

            <div class="policy-footer">
                For any queries, feel free to reach out to our support team.
            </div>
        </div>
    </div>
</section>
@endsection
