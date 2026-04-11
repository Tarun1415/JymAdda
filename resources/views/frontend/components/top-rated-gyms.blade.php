<div class="section py-5 bg-light">
  <div class="container">
    <div class="row mb-4 align-items-center">
      <div class="col-lg-6">
        <h2 class="font-weight-bold text-primary heading mb-0">
          Top Rated Gyms {{ session('user_city') ? 'Near ' . session('user_city') : 'Across India' }}
        </h2>
        <p class="text-muted mt-2 mb-0">Discover the highest-rated fitness centers {{ session('user_city') ? 'in your location' : 'loved by our users' }}.</p>
      </div>
      <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
        <a href="{{ route('gyms.index') }}" class="btn btn-primary text-white py-2 px-4 rounded-pill fw-semibold">View all gyms</a>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="property-slider-wrap">
          <div class="property-slider">
            
            @forelse($topRatedGyms as $gym)
                @php
                    $img = $gym->gym_image ? asset($gym->gym_image) : asset('images/img_1.jpg');
                @endphp
                <div class="property-item px-2 px-md-3 py-3">
                  <a href="{{ url('/'.$gym->slug) }}" class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm gym-card d-flex flex-column h-100">
                      <div class="gym-card-img-wrap" style="height: 220px; position: relative;">
                        <img src="{{ $img }}" style="width: 100%; height: 100%; object-fit: cover; border-top-left-radius: 20px; border-top-right-radius: 20px;" alt="{{ $gym->gym_name }}">
                        <div class="gym-badge-rating" style="position: absolute; top: 16px; right: 16px; background: rgba(255, 255, 255, 0.95); padding: 6px 12px; border-radius: 20px; font-weight: 800; font-size: 14px; color: #f59e0b; display: flex; align-items: center; gap: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); backdrop-filter: blur(4px);">
                          ★ <span style="color: #0f172a;">{{ $gym->rating ?? '0.0' }}</span>
                        </div>
                      </div>
                      <div class="gym-card-body p-4 d-flex flex-column flex-grow-1" style="background: #fff; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
                        <div class="gym-card-title fw-bold text-dark mb-1" style="font-size: 18px; line-height: 1.3;">{{ $gym->gym_name }}</div>
                        <div class="gym-card-location text-muted mb-3" style="font-size: 14px;">
                          📍 {{ $gym->city ?? '-' }}{{ $gym->state ? ', ' . $gym->state : '' }}
                        </div>
                        
                        <div class="gym-card-footer mt-auto pt-3 d-flex justify-content-between align-items-center" style="border-top: 1px solid #f1f5f9;">
                          <span class="gym-reviews-count text-muted fw-medium" style="font-size: 13px;">{{ $gym->total_reviews ?? 0 }} Reviews</span>
                          <span class="btn btn-sm btn-light text-primary fw-bold px-3 py-2" style="border-radius: 10px;">View Details</span>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No top-rated gyms available yet.</p>
                </div>
            @endforelse

          </div>

          @if($topRatedGyms->count() > 0)
          <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
          </div>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Base modern styles for the card hover effect inside the slider */
.property-item .gym-card {
  border-radius: 20px;
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  height: 100%;
}
.property-item .gym-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 24px 48px rgba(15,23,42,.1) !important;
}
.property-item .btn-light {
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
}
.property-item .gym-card:hover .btn-light {
    background-color: var(--bs-primary, #4f46e5);
    color: #fff !important;
    border-color: var(--bs-primary, #4f46e5);
}

/* Ensure images don't stretch weirdly in slider */
.property-slider .property-item {
    outline: none;
}
.property-slider-wrap .controls {
    margin-top: 10px;
}

/* Mobile Optimizations */
@media (max-width: 768px) {
  .bg-light .heading {
     font-size: 26px !important;
  }
  .bg-light .btn-primary {
     width: 100%;
     display: block;
  }
  .property-item .gym-card-title {
     font-size: 16px !important;
  }
  .gym-reviews-count {
     font-size: 11px !important;
  }
  .property-item .btn-light {
     padding: 6px 12px !important;
     font-size: 12px;
  }
}
</style>
