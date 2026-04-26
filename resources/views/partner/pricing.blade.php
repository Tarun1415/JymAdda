@extends('partner.layouts.app')

@section('content')
<style>
    body {
        font-family: 'Outfit', sans-serif;
    }
    .pricing-header {
        text-align: center;
        padding: 40px 20px 30px;
    }
    .pricing-header h1 {
        font-weight: 800;
        font-size: 2.5rem;
        color: #1e293b;
        margin-bottom: 10px;
    }
    .pricing-header p {
        color: #64748b;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .pricing-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .pricing-card.popular {
        border: 2px solid #4f46e5;
        transform: scale(1.03);
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.15);
    }
    .pricing-card.active-plan {
        border: 2px solid #10b981;
        transform: scale(1.03);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
    }
    .pricing-card.popular:hover, .pricing-card.active-plan:hover {
        transform: scale(1.05) translateY(-5px);
    }
    .popular-badge {
        position: absolute;
        top: 15px;
        right: -35px;
        background: #4f46e5;
        color: #fff;
        padding: 5px 40px;
        transform: rotate(45deg);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .active-badge {
        position: absolute;
        top: 15px;
        right: -35px;
        background: #10b981;
        color: #fff;
        padding: 5px 40px;
        transform: rotate(45deg);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .plan-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 15px;
    }
    .pricing-card.popular .plan-name {
        color: #4f46e5;
    }
    .pricing-card.active-plan .plan-name {
        color: #10b981;
    }
    .plan-price {
        font-size: 3rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 25px;
    }
    .plan-price span {
        font-size: 1rem;
        color: #94a3b8;
        font-weight: 500;
    }
    .plan-features {
        list-style: none;
        padding: 0;
        margin: 0 0 30px 0;
        text-align: left;
        flex-grow: 1;
    }
    .plan-features li {
        padding: 10px 0;
        color: #475569;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
    }
    .plan-features li:last-child {
        border-bottom: none;
    }
    .plan-features li svg {
        color: #10b981;
        width: 20px;
        height: 20px;
        margin-right: 12px;
        flex-shrink: 0;
    }
    .btn-pay {
        background: #f1f5f9;
        color: #0f172a;
        font-weight: 700;
        padding: 14px 24px;
        border-radius: 12px;
        border: none;
        width: 100%;
        transition: all 0.2s;
    }
    .btn-pay:hover {
        background: #e2e8f0;
    }
    .pricing-card.popular .btn-pay {
        background: #4f46e5;
        color: #fff;
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    }
    .pricing-card.popular .btn-pay:hover {
        background: #4338ca;
        box-shadow: 0 12px 25px rgba(79, 70, 229, 0.4);
    }
    .pricing-card.active-plan .btn-pay {
        background: #10b981;
        color: #fff;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }
    .pricing-card.active-plan .btn-pay:hover {
        background: #059669;
        box-shadow: 0 12px 25px rgba(16, 185, 129, 0.4);
    }
    .alert-error {
        background: #fef2f2;
        border: 1px solid #f87171;
        color: #b91c1c;
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 500;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="pricing-header">
            @if(session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h1>Subscription Plans</h1>
            <p>Manage your billing and subscription plan. Choose the best plan to continue growing your gym business with GymHai.</p>
        </div>

        <div class="row g-4 justify-content-center max-w-5xl mx-auto mb-5">
            @php
                $hasAnyActivePlan = $partner->plan_expires_at && \Carbon\Carbon::parse($partner->plan_expires_at)->isFuture();
            @endphp
            @foreach($plans as $plan)
            @php
                $isActive = (strtolower($partner->plan_name ?? '') === strtolower($plan->plan_name)) && ($partner->plan_expires_at && \Carbon\Carbon::parse($partner->plan_expires_at)->isFuture());
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card {{ $isActive ? 'active-plan' : ($plan->is_recommended ? 'popular' : '') }}">
                    @if($isActive)
                        <div class="active-badge">ACTIVE PLAN</div>
                    @elseif($plan->is_recommended)
                        <div class="popular-badge">RECOMMENDED</div>
                    @endif
                    <div class="plan-name">{{ $plan->plan_name }}</div>
                    
                    <div class="plan-price">
                        @if($plan->confirm_price)
                            <span style="text-decoration: line-through; color: #cbd5e1; font-size: 1.5rem; margin-right: 8px;">₹{{ rtrim(rtrim($plan->price, '0'), '.') }}</span>
                            ₹{{ rtrim(rtrim($plan->confirm_price, '0'), '.') }}
                        @else
                            ₹{{ rtrim(rtrim($plan->price, '0'), '.') }}
                        @endif
                        <span>/ {{ $plan->duration_months }} mo</span>
                    </div>
                    
                    <ul class="plan-features">
                        @php
                            $features = json_decode($plan->features, true) ?? [];
                        @endphp
                        @foreach($features as $feature)
                        <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> {{ $feature }}</li>
                        @endforeach
                    </ul>
                    
                    @php
                        $amountToPay = $plan->confirm_price ? $plan->confirm_price : $plan->price;
                        $amountInPaise = $amountToPay * 100;
                    @endphp
                    @if($isActive)
                        <button class="btn-pay" disabled style="background: #e2e8f0; color: #64748b; cursor: not-allowed; box-shadow: none;">Current Active Plan</button>
                    @elseif($hasAnyActivePlan)
                        <button class="btn-pay" onclick="payWithRazorpay('{{ $plan->id }}', {{ $amountInPaise }}, '{{ $plan->plan_name }}')">Upgrade to {{ explode(' ', $plan->plan_name)[0] }}</button>
                    @else
                        <button class="btn-pay" onclick="payWithRazorpay('{{ $plan->id }}', {{ $amountInPaise }}, '{{ $plan->plan_name }}')">Choose {{ explode(' ', $plan->plan_name)[0] }}</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Hidden Form for submission to server after successful payment -->
<form id="verifyPaymentForm" action="{{ route('partner.verifyPayment') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="plan_id" id="plan_id_input">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function payWithRazorpay(planId, amountInPaise, planDescription) {
        var options = {
            "key": "{{ $razorpayKey }}",
            "amount": amountInPaise, 
            "currency": "INR",
            "name": "GymHai Partner",
            "description": planDescription,
            "image": "{{ asset('images/logo2.png') }}",
            "handler": function (response){
                // On successful payment, store the details and submit format
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('plan_id_input').value = planId;
                document.getElementById('verifyPaymentForm').submit();
            },
            "prefill": {
                "name": "{{ $partner->name }}",
                "email": "{{ $partner->email }}",
                "contact": "{{ $partner->mobile }}"
            },
            "theme": {
                "color": "#4f46e5"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
            alert("Payment Failed. Reason: " + response.error.description);
        });
        rzp1.open();
    }
</script>
@endsection
