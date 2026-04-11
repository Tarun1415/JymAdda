@extends('frontend.layouts.app')
@section('content')

<div class="directory-page">
  <!-- Premium Directory Toolbar -->
  <div class="directory-toolbar">
    <div class="container pb-4 pt-5">
      
      @php
        $searchTitle = 'All Gyms';
        if (!empty($q)) {
          $searchTitle = 'Results for "' . $q . '"';
        } elseif (!empty($city)) {
          $searchTitle = 'Gyms in ' . $city;
        } elseif (!empty($pincode)) {
          $searchTitle = 'Gyms in Pincode ' . $pincode;
        }
      @endphp

      <div class="dt-header d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
        <!-- Left: Title -->
        <div class="dt-title-area">
          <h1 class="dt-title">
            {!! str_replace(
                ['"'.$q.'"', $city, $pincode],
                [
                  '<span class="text-primary fw-bold">"'.e($q).'"</span>',
                  '<span class="text-primary fw-bold">'.e($city).'</span>',
                  '<span class="text-primary fw-bold">'.e($pincode).'</span>'
                ],
                e($searchTitle)
            ) !!}
          </h1>
          <p class="dt-subtitle text-muted mb-0">Showing <strong>{{ $gyms->total() }}</strong> premium fitness centers</p>
        </div>

        <!-- Right: Search Box (Corner style) -->
        <div class="dt-search-area">
          <form action="{{ route('gyms.index') }}" class="dt-search-form" autocomplete="off">
            <div class="dt-input-wrap">
              <svg class="dt-search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
              <input type="text" class="dt-search-input" id="pageSearchInput" name="q" value="{{ $q ?? '' }}" placeholder="Search Gyms, Cities...">
              @if(!empty($q) || !empty($city) || !empty($pincode))
                <a href="{{ route('gyms.index') }}" class="dt-clear-btn" title="Clear">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </a>
              @endif
              
              <!-- Suggest Box -->
              <div id="pageSuggestBox" class="modern-suggest-box d-none" style="top: 110%;"></div>
            </div>
            <button type="submit" class="dt-search-btn">Search</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container pb-5">
    <!-- Filters / Breadcrumbs area -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="dt-chip-tags d-none d-md-flex gap-2">
            <span class="dt-chip active">All Gyms</span>
        </div>
        <div class="dt-sort">
            <select class="form-select dt-select">
                <option>Top Rated</option>
                <option>Newest Added</option>
            </select>
        </div>
    </div>

    <!-- Gym Cards List -->
    <div class="row g-3 g-md-4 mt-2">
      @forelse($gyms as $gym)
        @php
          $img = $gym->gym_image ? asset($gym->gym_image) : asset('images/img_1.jpg');
          $desc = \Illuminate\Support\Str::limit(strip_tags((string)$gym->description), 90);
        @endphp

        <div class="col-12 col-md-6 col-lg-4">
          <a href="{{ url('/'.$gym->slug) }}" class="text-decoration-none text-dark">
            <div class="card border-0 shadow-sm gym-card">
              <div class="gym-card-img-wrap">
                <img src="{{ $img }}" class="gym-card-img" alt="{{ $gym->gym_name }}">
                <div class="gym-badge-rating">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                  <span>{{ $gym->rating ?? '0.0' }}</span>
                </div>
              </div>
              <div class="gym-card-body">
                <div class="gym-card-title">{{ $gym->gym_name }}</div>
                <div class="gym-card-location">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  {{ $gym->city ?? '-' }}{{ $gym->state ? ', ' . $gym->state : '' }}
                </div>

                <div class="gym-card-desc">
                  {{ $desc }}
                </div>

                <div class="gym-card-footer">
                  <span class="gym-reviews-count">{{ $gym->total_reviews ?? 0 }} Reviews</span>
                  <span class="btn btn-sm btn-primary btn-view-gym">View Details</span>
                </div>
              </div>
            </div>
          </a>
        </div>
      @empty
        <div class="col-12">
          <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <h4 class="mt-3">No gyms found</h4>
            <p class="text-muted">Try adjusting your search or location settings.</p>
          </div>
        </div>
      @endforelse
    </div>

    <div class="pagination-wrapper mt-5">
      {{ $gyms->links() }}
    </div>

  </div>
</div>

<style>
  /* ===== Premium Directory Styles ===== */
  .directory-page {
    background-color: #f8fafc;
    min-height: 100vh;
  }

  /* --- Toolbar Area --- */
  .directory-toolbar {
    background: linear-gradient(135deg, #4f46e5 0%, #0f172a 100%);
    position: relative;
    z-index: 10;
    padding-top: 120px; /* Offset to prevent hiding behind the fixed header and extend gradient to top */
    padding-bottom: 2rem;
    border-radius: 0 0 40px 40px;
    box-shadow: 0 15px 35px rgba(15, 23, 42, 0.1);
  }
  
  .directory-toolbar .container {
    position: relative;
    z-index: 11;
  }
  
  .dt-title {
    font-size: 34px;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.5px;
    margin-bottom: 6px;
  }
  .directory-toolbar .text-primary {
    color: #38bdf8 !important; /* Make primary color pop on dark gradient */
  }
  .dt-subtitle {
    font-size: 15px;
    color: #cbd5e1 !important;
  }

  /* --- Corner Search Box --- */
  .dt-search-form {
    display: flex;
    gap: 8px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px;
    border-radius: 16px;
  }
  .dt-input-wrap {
    position: relative;
    width: 320px;
  }
  .dt-search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    z-index: 5;
  }
  .dt-search-input {
    width: 100%;
    height: 48px;
    padding-left: 44px;
    padding-right: 40px;
    border: none;
    border-radius: 12px;
    background: #ffffff;
    font-size: 15px;
    color: #0f172a;
    transition: all 0.2s;
  }
  .dt-search-input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.4);
  }
  .dt-clear-btn {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
  }
  .dt-clear-btn:hover { color: #ef4444; }
  .dt-search-btn {
    height: 48px;
    padding: 0 28px;
    background: #38bdf8;
    color: #0f172a;
    font-weight: 700;
    font-size: 15px;
    border: none;
    border-radius: 12px;
    transition: all 0.2s;
  }
  .dt-search-btn:hover { 
    background: #0284c7; 
    color: #ffffff;
  }

  /* --- Filters & Chips --- */
  .dt-chip {
    padding: 8px 16px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s;
  }
  .dt-chip:hover {
    border-color: #cbd5e1;
    color: #0f172a;
  }
  .dt-chip.active {
    background: #4f46e5;
    color: #fff;
    border-color: #4f46e5;
  }
  .dt-select {
    height: 40px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    font-size: 14px;
    font-weight: 500;
    color: #475569;
    background-color: #fff;
    cursor: pointer;
    min-width: 140px;
  }

  /* --- Premium Gym Cards --- */
  .gym-card {
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(0,0,0,0.04);
  }
  .gym-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 48px rgba(15,23,42,0.08) !important;
  }
  .gym-card-img-wrap {
    position: relative;
    width: 100%;
    height: 220px;
  }
  .gym-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .gym-card-img-wrap::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0; height: 50%;
    background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
  }
  .gym-badge-rating {
    position: absolute;
    top: 14px;
    right: 14px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(4px);
    color: #f59e0b;
    padding: 6px 12px;
    border-radius: 30px;
    font-weight: 800;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 2;
  }
  .gym-badge-rating span { color: #0f172a; }
  
  .gym-card-body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .gym-card-title {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.3;
  }
  .gym-card-location {
    font-size: 14px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 16px;
  }
  .gym-card-desc {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    margin-bottom: 24px;
  }
  .gym-card-footer {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f8fafc;
    padding-top: 16px;
  }
  .gym-reviews-count {
    font-size: 13px;
    color: #64748b;
    font-weight: 600;
  }
  .btn-view-gym {
    border-radius: 10px;
    font-weight: 700;
    padding: 8px 20px;
    background-color: #f1f5f9;
    color: #4f46e5;
    border: none;
    transition: all 0.2s;
  }
  .gym-card:hover .btn-view-gym {
    background-color: #4f46e5;
    color: #fff;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
  }

  /* Empty State */
  .empty-state {
    background: #fff;
    border-radius: 20px;
    padding: 60px 20px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.02);
  }

  /* ===== MOBILE VIEW ENHANCEMENTS ===== */
  @media (max-width: 768px) {
    .search-page-section {
      padding-top: 90px;
      padding-bottom: 40px;
      background-color: #f1f5f9;
    }
    
    .search-header {
      flex-direction: column;
      align-items: stretch;
      background: #fff;
      padding: 16px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
      margin-bottom: 20px;
      gap: 12px;
    }

    .search-title {
      font-size: 20px;
    }

    .search-form-wrap {
      flex: 1;
    }

    .search-form {
      flex-direction: column;
      gap: 10px;
    }
    
    .search-input-group {
      width: 100%;
    }
    
    .btn-search-submit {
      width: 100%;
    }

    /* Horizontal Cards for Mobile */
    .gym-card {
      flex-direction: row;
      height: 140px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .gym-card-img-wrap {
      width: 130px;
      height: 100%;
      flex-shrink: 0;
    }
    .gym-badge-rating {
      top: 8px;
      left: 8px; /* Move to left to stay visible */
      right: auto;
      padding: 4px 8px;
      font-size: 11px;
    }
    .gym-badge-rating svg {
      width: 10px;
      height: 10px;
    }
    .gym-card-body {
      padding: 12px;
      justify-content: flex-start;
      overflow: hidden;
    }
    .gym-card-title {
      font-size: 15px;
      margin-bottom: 4px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .gym-card-location {
      font-size: 12px;
      margin-bottom: 8px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      flex-shrink: 0;
    }
    .gym-card-desc {
      display: none; /* Hide desc on mobile */
    }
    .gym-card-footer {
      border-top: none;
      padding-top: 0;
      margin-top: auto;
    }
    .gym-reviews-count {
      display: none; /* Hide review count */
    }
    .btn-view-gym {
      width: 100%;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      background-color: var(--bs-primary, #4f46e5);
      color: #fff;
      border: none;
    }
    .pagination-wrapper {
      margin-top: 30px !important;
    }
  }

  /* Extra small mobile devices */
  @media (max-width: 400px) {
    .gym-card {
      height: 130px;
    }
    .gym-card-img-wrap {
      width: 110px;
    }
    .gym-card-title {
      font-size: 14px;
    }
  }

  /* ===== Ultra Modern Suggest Box ===== */
  .modern-suggest-box {
    position: absolute;
    top: calc(100% + 12px);
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 20px;
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 24px 48px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.04);
    z-index: 1050;
    overflow: hidden;
    max-height: 480px;
    overflow-y: auto;
    animation: suggestSlideDown 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
  @keyframes suggestSlideDown {
    from { opacity: 0; transform: translateY(-12px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .modern-suggest-box::-webkit-scrollbar {
    width: 6px;
  }
  .modern-suggest-box::-webkit-scrollbar-track {
    background: transparent;
  }
  .modern-suggest-box::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
  }
  .suggest-head {
    padding: 14px 20px;
    background: #f8fafc;
    border-bottom: 1px solid #f1f5f9;
  }
  .suggest-title {
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    color: #64748b;
    letter-spacing: 0.8px;
  }
  .suggest-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px 20px;
    text-decoration: none;
    border-bottom: 1px solid #f8fafc;
    transition: background 0.2s, padding-left 0.2s;
  }
  .suggest-item:last-child {
    border-bottom: none;
  }
  .suggest-item:hover {
    background: #f1f5f9;
    padding-left: 26px; /* Smooth indent effect on hover */
  }
  .suggest-img {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    object-fit: cover;
    flex-shrink: 0;
    box-shadow: 0 3px 6px rgba(0,0,0,0.08);
  }
  .suggest-text {
    flex: 1;
    min-width: 0;
  }
  .suggest-name {
    font-weight: 700;
    color: #0f172a;
    font-size: 16px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 3px;
  }
  .suggest-meta {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .suggest-footer {
    padding: 16px;
    background: #fff;
    border-top: 1px solid #f1f5f9;
  }
  .view-all-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-align: center;
    padding: 12px;
    border-radius: 12px;
    background: #f1f5f9;
    color: var(--bs-primary, #4f46e5);
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.2s;
  }
  .view-all-btn:hover {
    background: var(--bs-primary, #4f46e5);
    color: #fff;
  }
  .suggest-empty {
    padding: 30px;
    text-align: center;
    color: #64748b;
    font-size: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }
  @keyframes pspin { 100% { transform: rotate(360deg); } }
  
  @media (max-width: 768px) {
    .modern-suggest-box {
      border-radius: 16px;
      max-height: 380px;
      top: calc(100% + 8px);
    }
    .suggest-item {
      padding: 14px 16px;
      gap: 12px;
    }
    .suggest-item:hover {
      padding-left: 16px; /* disable indent on mobile */
      background: none;
    }
    .suggest-item:active {
      background: #f1f5f9;
    }
    .suggest-img {
      width: 46px;
      height: 46px;
      border-radius: 12px;
    }
    .suggest-name {
      font-size: 15px;
    }
  }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const input = document.getElementById('pageSearchInput');
  const box = document.getElementById('pageSuggestBox');
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

  if (input && box) {
      input.addEventListener('input', () => {
        const q = input.value.trim();
        clearTimeout(timer);
        if (q.length < 1) return hide();

        show(`<div class="suggest-empty">
           <svg class="spin" style="animation: pspin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--bs-primary, #4f46e5)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
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
});
</script>
@endpush
@endsection
