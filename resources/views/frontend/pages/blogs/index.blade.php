@extends('frontend.layouts.app')

@push('styles')
<style>
    /* ── SCOPED CSS VARIABLES ── */
    .custom-blog-index {
        --blog-primary: #6366f1; /* Brand Indigo/Purple */
        --blog-primary-light: rgba(99, 102, 241, 0.15);
        --blog-text-dark: #0f172a;
        --blog-text-main: #334155;
        --blog-text-muted: #64748b;
        --blog-border: #e2e8f0;
        --blog-bg: #f8fafc;
        --radius-lg: 24px;
        --radius-md: 16px;
        
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--blog-bg);
        min-height: 100vh;
        padding-bottom: 80px;
    }

    /* ── HERO SECTION ── */
    .blog-index-hero {
        position: relative;
        padding: 140px 0 100px;
        text-align: center;
        background: linear-gradient(135deg, #4f46e5 0%, #1e1b4b 100%);
        overflow: hidden;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }

    .hero-title {
        font-size: clamp(3rem, 6vw, 4.5rem);
        font-weight: 800;
        letter-spacing: -0.04em;
        color: #ffffff;
        margin-bottom: 20px;
        line-height: 1.1;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.8);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
        font-weight: 500;
    }

    /* ── BLOG LIST ── */
    .blog-list-section {
        padding-top: 80px;
    }

    .blog-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--blog-border);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        border-color: rgba(99, 102, 241, 0.3);
    }

    .blog-img-wrapper {
        position: relative;
        overflow: hidden;
        padding-top: 60%; /* Aspect ratio */
    }

    .blog-img-wrapper img {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .blog-card:hover .blog-img-wrapper img {
        transform: scale(1.05);
    }

    .category-tag {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        color: var(--blog-text-dark);
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .category-tag i {
        color: var(--blog-primary);
        font-size: 14px;
    }

    .blog-card-body {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-meta-row {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--blog-text-muted);
        margin-bottom: 16px;
    }

    .blog-meta-row i {
        font-size: 14px;
        color: var(--blog-primary);
        margin-right: 4px;
    }

    .blog-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--blog-text-dark);
        margin-bottom: 16px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s;
    }

    .blog-card:hover .blog-title {
        color: var(--blog-primary);
    }

    .blog-excerpt {
        color: var(--blog-text-main);
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 24px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .blog-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 20px;
        border-top: 1px solid var(--blog-border);
    }

    .read-more {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: var(--blog-text-dark);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .read-more i {
        color: var(--blog-primary);
        font-size: 18px;
        transition: transform 0.3s;
    }

    .blog-card:hover .read-more i {
        transform: translateX(6px);
    }

    /* ── FEATURED POST (FIRST POST) ── */
    @media (min-width: 992px) {
        .featured-card {
            flex-direction: row;
        }
        .featured-card .blog-img-wrapper {
            width: 55%;
            padding-top: 0;
            min-height: 450px;
        }
        .featured-card .blog-card-body {
            width: 45%;
            padding: 40px 50px;
            justify-content: center;
        }
        .featured-card .blog-title {
            font-size: 2.5rem;
            -webkit-line-clamp: 3;
        }
        .featured-card .blog-excerpt {
            font-size: 1.15rem;
        }
    }

    /* ── PAGINATION ── */
    .pagination {
        gap: 8px;
    }
    .page-item .page-link {
        border-radius: 12px;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--blog-border);
        color: var(--blog-text-main);
        font-weight: 700;
        background: #fff;
        transition: all 0.2s;
    }
    .page-item.active .page-link {
        background-color: var(--blog-primary);
        border-color: var(--blog-primary);
        color: white;
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
    }
    .page-item .page-link:hover:not(.active) {
        background-color: var(--blog-bg);
        color: var(--blog-primary);
        border-color: var(--blog-primary);
    }
</style>
@endpush

@section('content')

<div class="custom-blog-index">
    
    <!-- Hero Section -->
    <div class="blog-index-hero">
        <div class="container">
            <p class="hero-subtitle">
                Expert insights, fitness tips, and the latest news from the world of health and wellness. Elevate your journey today.
            </p>
        </div>
    </div>

    <!-- Blog Grid -->
    <div class="blog-list-section">
        <div class="container">
            <div class="row g-5">
                @forelse($blogs as $key => $blog)
                    <div class="col-lg-4 col-md-6 {{ $key === 0 && $blogs->currentPage() == 1 ? 'col-lg-12 col-md-12' : '' }}">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-card {{ $key === 0 && $blogs->currentPage() == 1 ? 'featured-card' : '' }}">
                            
                            <div class="blog-img-wrapper">
                                <span class="category-tag"><i class="ti ti-flame"></i> Fitness</span>
                                @if($blog->featured_image)
                                    <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}">
                                @else
                                    <img src="{{ asset('images/img_1.jpg') }}" alt="{{ $blog->title }}">
                                @endif
                            </div>
                            
                            <div class="blog-card-body">
                                <div class="blog-meta-row">
                                    <span><i class="ti ti-calendar"></i> {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                                    <span><i class="ti ti-eye"></i> {{ number_format($blog->views) }} Views</span>
                                </div>
                                
                                <h3 class="blog-title">{{ $blog->title }}</h3>
                                
                                <div class="blog-excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}
                                </div>
                                
                                <div class="blog-footer">
                                    <div class="read-more">
                                        Read Article <i class="ti ti-arrow-right"></i>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="py-5 bg-white rounded-4 shadow-sm" style="border: 1px solid var(--blog-border);">
                            <i class="ti ti-article text-muted" style="font-size: 4rem;"></i>
                            <h3 class="mt-3 text-muted fw-bold">No Articles Found</h3>
                            <p class="text-muted">We are currently working on amazing content for you. Check back soon!</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($blogs->hasPages())
            <div class="mt-5 pt-4 d-flex justify-content-center">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>

</div>

@endsection
