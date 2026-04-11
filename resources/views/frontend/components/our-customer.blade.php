    <!-- Custom Pricing Section -->
    <style>
      .pricing-section {
        padding: 100px 0;
        background-color: #f8fafc;
        position: relative;
        overflow: hidden;
      }
      .pricing-header {
        text-align: center;
        margin-bottom: 60px;
      }
      .pricing-title {
        font-size: 36px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 16px;
      }
      .pricing-title span {
        color: #4f46e5;
      }
      .pricing-desc {
        font-size: 16px;
        color: #64748b;
        max-width: 600px;
        margin: 0 auto;
      }

      .pricing-card {
        background: #fff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
      }
      .pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 24px 48px rgba(15,23,42,0.06);
      }
      
      .pricing-card.popular {
        background: #0f172a;
        color: #fff;
        box-shadow: 0 24px 48px rgba(79,70,229,0.15);
        border: none;
        transform: scale(1.02);
      }
      .pricing-card.popular:hover {
        transform: scale(1.02) translateY(-8px);
      }
      .popular-badge {
        position: absolute;
        top: -14px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #4f46e5, #ec4899);
        color: #fff;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(236,72,153,0.3);
      }

      .plan-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 12px;
        color: inherit;
      }
      .pricing-card:not(.popular) .plan-name { color: #0f172a; }
      
      .plan-price {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 8px;
        display: flex;
        align-items: baseline;
      }
      .plan-price span {
        font-size: 16px;
        font-weight: 500;
        opacity: 0.7;
        margin-left: 4px;
      }
      .pricing-card:not(.popular) .plan-price { color: #0f172a; }

      .plan-desc {
        font-size: 14px;
        margin-bottom: 32px;
        opacity: 0.8;
      }

      .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-bottom: 40px;
        flex: 1;
      }
      .feature-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        font-size: 15px;
        opacity: 0.9;
      }
      .feature-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }
      .pricing-card:not(.popular) .feature-icon {
        background: #e0e7ff;
        color: #4f46e5;
      }
      .pricing-card.popular .feature-icon {
        background: rgba(255,255,255,0.1);
        color: #fff;
      }

      .btn-pricing {
        display: block;
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s;
      }
      .pricing-card:not(.popular) .btn-pricing {
        background: #f1f5f9;
        color: #4f46e5;
      }
      .pricing-card:not(.popular) .btn-pricing:hover {
        background: #4f46e5;
        color: #fff;
      }
      .pricing-card.popular .btn-pricing {
        background: #4f46e5;
        color: #fff;
        box-shadow: 0 4px 12px rgba(79,70,229,0.3);
      }
      .pricing-card.popular .btn-pricing:hover {
        background: #4338ca;
      }

      @media (max-width: 991px) {
        .pricing-card.popular {
          transform: none;
          margin: 16px 0;
        }
        .pricing-card.popular:hover {
          transform: translateY(-8px);
        }
      }

      /* Mobile Sizing Improvements */
      @media (max-width: 768px) {
        .pricing-section {
          padding: 60px 0;
        }
        .pricing-title {
          font-size: 28px;
        }
        .pricing-card {
          padding: 30px 20px;
        }
        .plan-price {
          font-size: 34px;
        }
        .plan-price span[style*="line-through"] {
          font-size: 20px !important;
        }
      }
    </style>

    <div class="pricing-section">
      <div class="container">
        <div class="pricing-header" data-aos="fade-up">
          <h2 class="pricing-title">Partner with <span>GymAdda</span></h2>
          <p class="pricing-desc">
            Choose the perfect plan to grow your fitness business. Get more leads, manage members easily, and boost your gym's visibility locally.
          </p>
        </div>

        <div class="row align-items-center g-4">
          
          @php
            $plans = \App\Models\SubscriptionPlan::where('status', 'active')->get();
          @endphp
          
          @foreach($plans as $plan)
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
            <div class="pricing-card {{ $plan->is_recommended ? 'popular' : '' }}">
              @if($plan->is_recommended)
                <div class="popular-badge">Most Popular</div>
              @endif
              <div class="plan-name">{{ $plan->plan_name }}</div>
              
              <div class="plan-price">
                @if($plan->confirm_price)
                  <span style="text-decoration: line-through; color: rgba(15,23,42,0.4); font-size: 24px; margin-right: 8px;">₹{{ rtrim(rtrim($plan->price, '0'), '.') }}</span>
                  ₹{{ rtrim(rtrim($plan->confirm_price, '0'), '.') }}
                @else
                  ₹{{ rtrim(rtrim($plan->price, '0'), '.') }}
                @endif
                <span style="{{ $plan->is_recommended ? 'color: rgba(255,255,255,0.7);' : 'color: rgba(15,23,42,0.6);' }}">/ {{ $plan->duration_months }} mo</span>
              </div>
              <p class="plan-desc">Accelerate your gym's growth today.</p>
              
              <ul class="feature-list">
                @php
                    $features = json_decode($plan->features, true) ?? [];
                @endphp
                @foreach($features as $feature)
                <li>
                  <span class="feature-icon"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                  {!! $feature !!}
                </li>
                @endforeach
              </ul>
              
              <a href="/partner/register" class="btn-pricing">Choose {{ explode(' ', $plan->plan_name)[0] }}</a>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>