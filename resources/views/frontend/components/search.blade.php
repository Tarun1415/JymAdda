<div class="hero hero-modern">
  <div class="hero-slide" id="heroBgSlider">
    <div class="img overlay" style="background-image: url('{{ asset('images/jym1.jpg') }}')"></div>
    <div class="img overlay" style="background-image: url('{{ asset('images/jym2.jpg') }}')"></div>
    <div class="img overlay" style="background-image: url('{{ asset('images/jym3.jpg') }}')"></div>
  </div>

  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 text-center">

        <h1 class="heading" data-aos="fade-up">
          Discover Your Perfect Gym & Start Your Fitness Journey
        </h1>

        <div class="hero-search-wrapper" data-aos="fade-up" data-aos-delay="100" style="position: relative; z-index: 9000;">
          <form action="{{ route('gyms.index') }}"
                class="form-search position-relative"
                autocomplete="off"
                style="z-index: 9999 !important;">

            <div class="mobile-input-wrap">
              <div class="search-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </div>
              <input type="text"
                     class="form-control"
                     id="gymSearchInput"
                     name="q"
                     placeholder="Search for city, location or gym...">
            </div>

            <!-- Desktop Search Button -->
            <button type="submit" class="btn btn-primary d-none d-md-block">Search</button>

            <!-- Vertical Mobile Submit Button -->
            <button type="submit" class="btn btn-primary d-flex d-md-none btn-hero-submit">
              Search Gyms Now
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="ms-2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>

           
            <div id="suggestBox" class="suggest-box d-none" style="z-index: 9999 !important; position: absolute; width: 100%; text-align: left; background: #fff; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border-radius: 12px; margin-top: 5px;"></div>
          </form>
        </div>
        <!-- Premium Mobile Partner CTA -->
        <div class="d-md-none mt-4" style="position: relative; z-index: 10;" data-aos="fade-up" data-aos-delay="200">
            <a href="/partner/register" style="
                display: flex;
                align-items: center;
                background: rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 215, 0, 0.3);
                border-radius: 16px;
                padding: 12px 16px;
                text-decoration: none;
                box-shadow: 0 8px 32px rgba(0,0,0,0.3);
                transition: transform 0.2s ease, border-color 0.2s ease;
            ">
              <div style="background: rgba(255, 215, 0, 0.15); border-radius: 12px; padding: 12px; display: flex; align-items: center; justify-content: center;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#FFD700" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                  </svg>
              </div>
              <div class="text-start ms-3">
                  <div style="font-size: 0.75rem; color: #e2e8f0; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Partner With Us</div>
                  <div style="font-size: 1.1rem; color: #FFD700; font-weight: 700; margin-top: 2px;">List Your Gym Free</div>
              </div>
              <div class="ms-auto" style="background: #FFD700; color: #000; border-radius: 50%; padding: 6px; display: flex; justify-content: center; align-items: center; box-shadow: 0 2px 10px rgba(255,215,0,0.4);">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                      <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
              </div>
            </a>
        </div>

        {{-- ✅ Explore (Pill Tags) --}}
        <div class="hero-explore" style="position: relative; z-index: 1;">
          <div class="hero-explore-title text-center text-lg-start">Trending Locations</div>
          <div class="explore-row">
            
            @php
              $cities = ['Noida', 'Delhi', 'Gurgaon', 'Mumbai', 'Jaipur', 'Bangalore'];
            @endphp

            @foreach($cities as $city)
            <a href="{{ route('gyms.index',['q'=>$city]) }}" class="explore-pill">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <span>{{ $city }}</span>
            </a>
            @endforeach

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
/* =========================
   ✅ HERO BACKGROUND SLIDER (AUTO FADE)
========================= */
(function () {
  const slider = document.getElementById('heroBgSlider');
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll('.img'));
  if (!slides.length) return;

  let i = 0;
  const interval = 3500; 

  slides.forEach((el, idx) => {
    el.style.opacity = (idx === 0) ? '1' : '0';
    el.style.zIndex = (idx === 0) ? '1' : '0';
  });

  setInterval(() => {
    const current = slides[i];
    const nextIndex = (i + 1) % slides.length;
    const next = slides[nextIndex];

    next.style.zIndex = '2';
    next.style.opacity = '1';
    current.style.opacity = '0';

    setTimeout(() => {
      current.style.zIndex = '0';
      next.style.zIndex = '1';
      i = nextIndex;
    }, 850); 
  }, interval);
})();

/* =========================
   ✅ SUGGEST SEARCH
========================= */
(function () {
  const input = document.getElementById('gymSearchInput');
  const box = document.getElementById('suggestBox');
  let timer = null;

  function escapeHtml(str){
    return String(str || '').replace(/[&<>"']/g, (m) => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'
    }[m]));
  }

  function show(html){ box.innerHTML = html; box.classList.remove('d-none'); }
  function hide(){ box.classList.add('d-none'); box.innerHTML = ''; }

  async function fetchSuggest(q){
    const url = `{{ route('gyms.suggest') }}?q=${encodeURIComponent(q)}`;
    const res = await fetch(url, { headers: {'X-Requested-With':'XMLHttpRequest'} });
    return await res.json();
  }

  function render(data){
    const gyms = data.gyms || [];
    const mode = data.mode || 'gym';
    const label = data.label || '';
    const viewAll = data.view_all || null;

    let title = 'Matching Gyms';
    if (mode === 'city') title = `Gyms in ${escapeHtml(label)}`;
    if (mode === 'pincode') title = `Gyms in Pincode ${escapeHtml(label)}`;

    let html = `<div class="suggest-inner">
      <div class="suggest-head"><span class="suggest-title">${title}</span></div>
    `;

    if (gyms.length) {
      gyms.forEach(g => {
        html += `
          <a class="suggest-item" href="${g.url}">
            <img class="suggest-img" src="${g.image}" alt="">
            <div class="suggest-text">
              <div class="suggest-name">${escapeHtml(g.name)}</div>
              <div class="suggest-meta">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                ${escapeHtml(g.city || '-')}${g.state ? ', ' + escapeHtml(g.state) : ''}
              </div>
            </div>
          </a>
        `;
      });
    } else {
      html += `<div class="suggest-empty">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        No gyms found for this search.
      </div>`;
    }

    if (viewAll) {
      html += `<div class="suggest-footer">
        <a class="view-all-btn" href="${viewAll}">
          View All Results
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </a>
      </div>`;
    }

    html += `</div>`;
    return html;
  }

  if(input && box) {
    input.addEventListener('input', () => {
      const q = input.value.trim();
      clearTimeout(timer);
      if (q.length < 1) return hide();

      show(`<div class="suggest-empty">
         <svg class="suggest-spin" style="animation: sspin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
         Searching...
      </div>`);
      timer = setTimeout(async () => {
        try {
          const data = await fetchSuggest(q);
          show(render(data));
        } catch (e) {
          hide();
        }
      }, 300);
    });

    document.addEventListener('click', (e) => {
      if (!box.contains(e.target) && e.target !== input) hide();
    });

    input.addEventListener('focus', () => {
      if (box.innerHTML.trim() !== '' && input.value.trim().length > 0) {
          box.classList.remove('d-none');
      }
    });
  }
})();
</script>
@endpush
