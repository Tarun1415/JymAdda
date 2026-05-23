@extends('frontend.layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bank-locator.css') }}">
@endpush

@section('content')
@php
    $detailRows = [
        'Bank'      => $selectedIfsc->bank     ?? null,
        'IFSC Code' => $selectedIfsc->ifsc     ?? null,
        'Branch'    => $selectedIfsc->branch   ?? null,
        'State'     => $selectedIfsc->state    ?? null,
        'District'  => $selectedIfsc->district ?? null,
        'City'      => $selectedIfsc->city     ?? null,
        'Centre'    => $selectedIfsc->centre   ?? null,
        'MICR Code' => $selectedIfsc->micr     ?? null,
        'Contact'   => $selectedIfsc->contact  ?? null,
    ];
@endphp

<main class="blp">

    {{-- ══════════════ HERO ══════════════ --}}
    <section class="blp-hero">
        <div class="blp-hero-noise"></div>
        <div class="blp-hero-glow"></div>
        <div class="blp-container">
            <div class="blp-hero-grid">

                {{-- Left copy --}}
                <div class="blp-hero-copy">
                    <span class="blp-pill">🏦 IFSC Finder</span>
                    <h1 class="blp-h1">Find any branch.<br>In seconds.</h1>
                    <p class="blp-lead">Search across {{ number_format($stats['banks']) }}+ banks, {{ number_format($stats['states']) }} states and {{ number_format($stats['branches']) }} branches — instantly.</p>

                    <div class="blp-stats-row">
                        <div class="blp-stat">
                            <strong>{{ number_format($stats['banks']) }}</strong>
                            <span>Banks</span>
                        </div>
                        <div class="blp-stat-divider"></div>
                        <div class="blp-stat">
                            <strong>{{ number_format($stats['states']) }}</strong>
                            <span>States</span>
                        </div>
                        <div class="blp-stat-divider"></div>
                        <div class="blp-stat">
                            <strong>{{ number_format($stats['branches']) }}</strong>
                            <span>Branches</span>
                        </div>
                    </div>

                    {{-- Bank Info Card (shows when bank selected) --}}
                    @if($bankSlug && $selectedBank)
                    <div class="blp-context-card blp-bank-card" id="bankContextCard">
                        <div class="blp-ctx-icon">🏛️</div>
                        <div class="blp-ctx-body">
                            <span class="blp-ctx-label">Selected Bank</span>
                            <strong class="blp-ctx-title">{{ $selectedBank }}</strong>
                            <p class="blp-ctx-meta">
                                One of India's leading banks with branches across the country.
                                @if($stateSlug && $selectedState)
                                    Showing branches in <em>{{ $selectedState }}</em>.
                                @else
                                    Select a state to filter branches.
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- State Info Card (shows when state selected) --}}
                    @if($stateSlug && $selectedState)
                    <div class="blp-context-card blp-state-card" id="stateContextCard">
                        <div class="blp-ctx-icon">📍</div>
                        <div class="blp-ctx-body">
                            <span class="blp-ctx-label">Selected State</span>
                            <strong class="blp-ctx-title">{{ $selectedState }}</strong>
                            <p class="blp-ctx-meta">
                                @if($districtSlug && $selectedDistrict)
                                    Browsing <em>{{ $selectedDistrict }}</em> district.
                                    @if($branches->count())
                                        {{ $branches->count() }} branch(es) found.
                                    @endif
                                @else
                                    Select a district to narrow down branches in {{ $selectedState }}.
                                @endif
                            </p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Right: Locator Panel --}}
                <div class="blp-panel">
                    <div class="blp-panel-header">
                        <div>
                            <p class="blp-panel-sub">Step-by-step</p>
                            <h2 class="blp-panel-title">Bank Locator</h2>
                        </div>
                        <a href="{{ route('bank.locator.index') }}" class="blp-reset-btn">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 4v6h6"/><path d="M3.51 15a9 9 0 1 0 .49-3"/></svg>
                            Reset
                        </a>
                    </div>

                    {{-- Progress Steps --}}
                    <div class="blp-steps">
                        @php
                            $stepLabels = ['Bank', 'State', 'District', 'IFSC'];
                            $stepStates = [
                                $bankSlug ? 'done' : 'active',
                                $stateSlug ? 'done' : ($bankSlug ? 'active' : 'idle'),
                                $districtSlug ? 'done' : ($stateSlug ? 'active' : 'idle'),
                                $ifscSlug ? 'done' : ($districtSlug ? 'active' : 'idle'),
                            ];
                        @endphp
                        @foreach($stepLabels as $i => $label)
                            <div class="blp-step blp-step--{{ $stepStates[$i] }}">
                                <div class="blp-step-dot">
                                    @if($stepStates[$i] === 'done')
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    @else
                                        {{ $i + 1 }}
                                    @endif
                                </div>
                                <span>{{ $label }}</span>
                            </div>
                            @if($i < 3)<div class="blp-step-line blp-step-line--{{ $stepStates[$i] === 'done' ? 'done' : 'idle' }}"></div>@endif
                        @endforeach
                    </div>

                    {{-- Dropdowns --}}
                    <div class="blp-form">

                        <div class="blp-field">
                            <label class="blp-label" for="sel-bank">
                                <span class="blp-label-text">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="15" rx="2"/><path d="M16 7V5a4 4 0 0 0-8 0v2"/></svg>
                                    Bank Name
                                </span>
                                @if($bankSlug)<span class="blp-label-selected">{{ $selectedBank }}</span>@endif
                            </label>
                            <div class="blp-select-wrap">
                                <select id="sel-bank" class="blp-select" data-placeholder="Choose a bank…">
                                    <option value="{{ route('bank.locator.index') }}">Choose a bank…</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ route('bank.locator.show', ['bankSlug' => $bank->bank_slug]) }}" {{ $bankSlug === $bank->bank_slug ? 'selected' : '' }}>
                                            {{ $bank->bank }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="blp-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </div>

                        <div class="blp-field {{ !$bankSlug ? 'blp-field--disabled' : '' }}">
                            <label class="blp-label" for="sel-state">
                                <span class="blp-label-text">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                                    State
                                </span>
                                @if($stateSlug)<span class="blp-label-selected">{{ $selectedState }}</span>@endif
                            </label>
                            <div class="blp-select-wrap">
                                <select id="sel-state" class="blp-select" {{ !$bankSlug ? 'disabled' : '' }}>
                                    <option value="{{ $bankSlug ? route('bank.locator.show', ['bankSlug' => $bankSlug]) : '#' }}">Select state</option>
                                    @foreach($states as $state)
                                        <option value="{{ route('bank.locator.show', ['bankSlug' => $bankSlug, 'stateSlug' => $state->state_slug]) }}" {{ $stateSlug === $state->state_slug ? 'selected' : '' }}>
                                            {{ $state->state }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="blp-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </div>

                        <div class="blp-field {{ !$stateSlug ? 'blp-field--disabled' : '' }}">
                            <label class="blp-label" for="sel-district">
                                <span class="blp-label-text">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>
                                    District
                                </span>
                                @if($districtSlug)<span class="blp-label-selected">{{ $selectedDistrict }}</span>@endif
                            </label>
                            <div class="blp-select-wrap">
                                <select id="sel-district" class="blp-select" {{ !$stateSlug ? 'disabled' : '' }}>
                                    <option value="{{ $stateSlug ? route('bank.locator.show', ['bankSlug' => $bankSlug, 'stateSlug' => $stateSlug]) : '#' }}">Select district</option>
                                    @foreach($districts as $district)
                                        <option value="{{ route('bank.locator.show', ['bankSlug' => $bankSlug, 'stateSlug' => $stateSlug, 'districtSlug' => $district->district_slug]) }}" {{ $districtSlug === $district->district_slug ? 'selected' : '' }}>
                                            {{ $district->district }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="blp-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </div>

                        <div class="blp-field {{ !$districtSlug ? 'blp-field--disabled' : '' }}">
                            <label class="blp-label" for="sel-ifsc">
                                <span class="blp-label-text">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                    IFSC / Branch
                                </span>
                                @if($ifscSlug)<span class="blp-label-selected">{{ $selectedIfsc->ifsc ?? '' }}</span>@endif
                            </label>
                            <div class="blp-select-wrap">
                                <select id="sel-ifsc" class="blp-select" {{ !$districtSlug ? 'disabled' : '' }}>
                                    <option value="{{ $districtSlug ? route('bank.locator.show', ['bankSlug' => $bankSlug, 'stateSlug' => $stateSlug, 'districtSlug' => $districtSlug]) : '#' }}">Select IFSC</option>
                                    @foreach($ifscOptions as $option)
                                        @php $optionSlug = \Illuminate\Support\Str::lower($option->ifsc_slug ?: $option->ifsc); @endphp
                                        <option value="{{ route('bank.locator.show', ['bankSlug' => $bankSlug, 'stateSlug' => $stateSlug, 'districtSlug' => $districtSlug, 'ifscSlug' => $optionSlug]) }}" {{ $ifscSlug === $optionSlug ? 'selected' : '' }}>
                                            {{ $option->ifsc }} — {{ $option->branch ?: $option->city }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="blp-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </div>

                    </div>{{-- /blp-form --}}
                </div>{{-- /blp-panel --}}

            </div>{{-- /blp-hero-grid --}}
        </div>
    </section>

    {{-- ══════════════ CONTENT ══════════════ --}}
    <section class="blp-content">
        <div class="blp-container">

            {{-- Breadcrumb --}}
            <nav class="blp-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('bank.locator.index') }}">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    IFSC Home
                </a>
                @if($selectedBank)<span aria-hidden="true">›</span><span>{{ $selectedBank }}</span>@endif
                @if($selectedState)<span aria-hidden="true">›</span><span>{{ $selectedState }}</span>@endif
                @if($selectedDistrict)<span aria-hidden="true">›</span><span>{{ $selectedDistrict }}</span>@endif
                @if($selectedIfsc)<span aria-hidden="true">›</span><span>{{ $selectedIfsc->ifsc }}</span>@endif
            </nav>

            {{-- ── Branch Detail View ── --}}
            @if($selectedIfsc)
            <div class="blp-detail-layout">

                <div class="blp-detail-main">
                    {{-- Header --}}
                    <div class="blp-detail-header">
                        <div class="blp-detail-header-icon">🏦</div>
                        <div class="blp-detail-header-copy">
                            <span class="blp-pill blp-pill--sm">Branch Details</span>
                            <h2>{{ $selectedIfsc->bank }} — {{ $selectedIfsc->branch }}</h2>
                            <p>{{ $selectedIfsc->city }}, {{ $selectedIfsc->district }}, {{ $selectedIfsc->state }}</p>
                        </div>
                        <button type="button" class="blp-copy-btn" data-copy="{{ $selectedIfsc->ifsc }}">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                            Copy IFSC
                        </button>
                    </div>

                    {{-- IFSC hero code --}}
                    <div class="blp-ifsc-hero">
                        <div class="blp-ifsc-hero-left">
                            <span>IFSC Code</span>
                            <strong id="ifscCode">{{ $selectedIfsc->ifsc }}</strong>
                        </div>
                        <div class="blp-ifsc-hero-right">
                            <div class="blp-ifsc-badge {{ strtolower((string) $selectedIfsc->neft) === 'yes' ? 'blp-ifsc-badge--on' : '' }}">NEFT</div>
                            <div class="blp-ifsc-badge {{ strtolower((string) $selectedIfsc->rtgs) === 'yes' ? 'blp-ifsc-badge--on' : '' }}">RTGS</div>
                            <div class="blp-ifsc-badge {{ strtolower((string) $selectedIfsc->imps) === 'yes' ? 'blp-ifsc-badge--on' : '' }}">IMPS</div>
                        </div>
                    </div>

                    {{-- Details grid --}}
                    <div class="blp-detail-grid">
                        @foreach($detailRows as $label => $value)
                            @if($value)
                            <div class="blp-detail-cell">
                                <span>{{ $label }}</span>
                                <strong>{{ $value }}</strong>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    @if($selectedIfsc->address)
                    <div class="blp-address">
                        <div class="blp-address-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                        </div>
                        <div>
                            <span>Branch Address</span>
                            <p>{{ $selectedIfsc->address }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="blp-sidebar">
                    <div class="blp-service-card">
                        <h3>Payment Services</h3>
                        <div class="blp-service-grid">
                            @foreach(['NEFT' => $selectedIfsc->neft, 'RTGS' => $selectedIfsc->rtgs, 'IMPS' => $selectedIfsc->imps] as $service => $val)
                            @php $isYes = strtolower((string) $val) === 'yes'; @endphp
                            <div class="blp-service-item {{ $isYes ? 'blp-service-item--yes' : '' }}">
                                <div class="blp-service-dot {{ $isYes ? 'blp-service-dot--yes' : '' }}"></div>
                                <span>{{ $service }}</span>
                                <strong>{{ $val ?: 'N/A' }}</strong>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="blp-tips-card">
                        <h4>💡 Quick Tips</h4>
                        <ul>
                            <li>NEFT transfers settle in batches</li>
                            <li>RTGS is for ₹2 lakh+ transfers</li>
                            <li>IMPS is instant, 24×7</li>
                        </ul>
                    </div>
                </aside>
            </div>

            {{-- ── Branch List View ── --}}
            @elseif($branches->count())
            <div class="blp-list-header">
                <div>
                    <span class="blp-pill">{{ $branches->count() }} branches found</span>
                    <h2>{{ $selectedBank }} in {{ $selectedDistrict }}, {{ $selectedState }}</h2>
                    <p>Select a branch below to view its IFSC code and full details.</p>
                </div>
            </div>
            <div class="blp-branch-grid">
                @foreach($branches as $branch)
                <a href="{{ \App\Http\Controllers\Frontend\BankLocatorController::ifscUrl($branch) }}" class="blp-branch-card">
                    <div class="blp-branch-card-top">
                        <span class="blp-branch-ifsc">{{ $branch->ifsc }}</span>
                        <svg class="blp-branch-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </div>
                    <strong class="blp-branch-name">{{ $branch->branch ?: 'Branch details' }}</strong>
                    <span class="blp-branch-loc">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                        {{ $branch->city ?: $branch->centre ?: $branch->district }}
                    </span>
                </a>
                @endforeach
            </div>
            <div class="blp-pagination">
                {{ $branches->links() }}
            </div>

            {{-- ── Empty State ── --}}
            @else
            <div class="blp-empty">
                <div class="blp-empty-visual">
                    <div class="blp-empty-ring blp-empty-ring--1"></div>
                    <div class="blp-empty-ring blp-empty-ring--2"></div>
                    <div class="blp-empty-icon">🔍</div>
                </div>
                <div class="blp-empty-text">
                    <h2>Ready to find your branch</h2>
                    <p>Start by selecting a bank from the panel above. Each step unlocks the next dropdown — bank → state → district → IFSC.</p>
                    <div class="blp-empty-steps">
                        <div>
                            <span>1</span>
                            <p>Pick a bank</p>
                        </div>
                        <div>
                            <span>2</span>
                            <p>Choose state</p>
                        </div>
                        <div>
                            <span>3</span>
                            <p>Select district</p>
                        </div>
                        <div>
                            <span>4</span>
                            <p>View IFSC</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Navigate on select change
    document.querySelectorAll('.blp-select').forEach(function (sel) {
        sel.addEventListener('change', function () {
            if (this.value && this.value !== '#') {
                window.location.href = this.value;
            }
        });
    });

    // Copy IFSC
    const copyBtn = document.querySelector('.blp-copy-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', async function () {
            const code = this.dataset.copy || '';
            try {
                await navigator.clipboard.writeText(code);
                this.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg> Copied!`;
                this.classList.add('blp-copy-btn--done');
            } catch {
                this.textContent = code;
            }
            setTimeout(() => {
                this.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy IFSC`;
                this.classList.remove('blp-copy-btn--done');
            }, 2000);
        });
    }

    // Animate cards on load
    document.querySelectorAll('.blp-branch-card, .blp-detail-cell').forEach((el, i) => {
        el.style.animationDelay = `${i * 40}ms`;
        el.classList.add('blp-fade-in');
    });
});
</script>
@endpush