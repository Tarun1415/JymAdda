@extends('frontend.layouts.app')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">

    <style>
        /* ── SCOPED CSS VARIABLES ── */
        .custom-blog-wrapper {
            --blog-primary: #e63946;
            /* GymHai red */
            --blog-text-dark: #111827;
            --blog-text-main: #374151;
            --blog-text-muted: #6b7280;
            --blog-border: #e5e7eb;
            --blog-bg-alt: #f9fafb;
            --navbar-h: 70px;

            padding-top: calc(var(--navbar-h) + 40px);
            padding-bottom: 80px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ── READING PROGRESS ── */
        #read-progress {
            position: fixed;
            top: 70px;
            /* fallback */
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, #e63946, #f87171);
            z-index: 9999;
            transition: width 0.1s ease-out;
        }

        @media (max-width: 768px) {
            #read-progress {
                top: 60px;
            }

            .custom-blog-wrapper {
                padding-top: 100px;
            }
        }

        /* ── LEFT COLUMN (MAIN ARTICLE) ── */
        .article-main {
            padding-right: 20px;
        }

        @media (max-width: 991px) {
            .article-main {
                padding-right: 0;
                margin-bottom: 40px;
            }
        }

        .article-category {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--blog-primary);
            background: rgba(230, 57, 70, 0.1);
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 20px;
        }

        .article-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: var(--blog-text-dark) !important;
            margin-bottom: 24px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .article-meta-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px 24px;
            padding-bottom: 24px;
            margin-bottom: 30px;
            border-bottom: 1px solid var(--blog-border);
            font-size: 14px;
            font-weight: 500;
            color: var(--blog-text-muted);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-item i {
            font-size: 18px;
            color: var(--blog-primary);
        }

        .article-featured-img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        /* Article Content Styles */
        .article-body {
            font-family: 'Lora', Georgia, serif;
            font-size: 1.15rem;
            line-height: 1.8;
            color: var(--blog-text-main);
            overflow-wrap: break-word;
            word-break: break-word;
        }

        .article-body>p:first-of-type::first-letter {
            float: left;
            font-size: 4rem;
            line-height: 0.8;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            color: var(--blog-text-dark);
            margin: 10px 12px 0 0;
        }

        .article-body p {
            margin-bottom: 1.8em;
        }

        .article-body h2,
        .article-body h3,
        .article-body h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--blog-text-dark);
            font-weight: 800;
            margin-top: 2em;
            margin-bottom: 0.8em;
        }

        .article-body h2 {
            font-size: 1.8rem;
        }

        .article-body h3 {
            font-size: 1.4rem;
        }

        .article-body img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 2em 0;
            display: block;
        }

        .article-body blockquote {
            font-style: italic;
            font-size: 1.3rem;
            line-height: 1.6;
            color: var(--blog-text-dark);
            border-left: 4px solid var(--blog-primary);
            padding: 20px 24px;
            margin: 2.5em 0;
            background: var(--blog-bg-alt);
            border-radius: 0 12px 12px 0;
        }

        .article-body blockquote p {
            margin: 0;
        }

        .article-body ul,
        .article-body ol {
            margin-bottom: 1.8em;
            padding-left: 1.2em;
        }

        .article-body li {
            margin-bottom: 0.5em;
        }

        .article-body a {
            color: var(--blog-primary);
            text-decoration: underline;
            text-underline-offset: 3px;
            font-weight: 500;
        }

        /* ── RIGHT COLUMN (SIDEBAR) ── */
        .sidebar-sticky {
            position: sticky;
            top: calc(var(--navbar-h) + 30px);
        }

        .sidebar-widget {
            background: #fff;
            border: 1px solid var(--blog-border);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .widget-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--blog-text-dark);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--blog-bg-alt);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Share Buttons */
        .share-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 12px;
        }

        .share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 46px;
            border-radius: 12px;
            background: var(--blog-bg-alt);
            color: var(--blog-text-main);
            font-size: 20px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .share-btn:hover {
            background: var(--blog-text-dark);
            color: #fff;
            transform: translateY(-2px);
        }

        .copy-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 46px;
            border-radius: 12px;
            background: transparent;
            border: 1px solid var(--blog-border);
            font-weight: 600;
            font-size: 14px;
            color: var(--blog-text-main);
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .copy-btn:hover {
            background: var(--blog-bg-alt);
        }

        /* Sidebar Related Posts - Premium Design */
        .sidebar-posts-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-post {
            display: flex;
            align-items: stretch;
            gap: 16px;
            padding: 12px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid var(--blog-border);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .sidebar-post::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--blog-primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            transform-origin: bottom;
        }

        .sidebar-post:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
            border-color: transparent;
        }

        .sidebar-post:hover::before {
            transform: scaleY(1);
        }

        .sidebar-post-img {
            width: 85px;
            height: 85px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .sidebar-post:hover .sidebar-post-img {
            transform: scale(1.05) rotate(-2deg);
        }

        .sidebar-post-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .sidebar-post-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--blog-text-dark);
            line-height: 1.4;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.2s;
        }

        .sidebar-post:hover .sidebar-post-title {
            color: var(--blog-primary);
        }

        .sidebar-post-desc {
            font-size: 13px;
            color: var(--blog-text-muted);
            margin-bottom: 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .sidebar-post-date {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--blog-text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .sidebar-read-more {
            font-size: 12px;
            font-weight: 700;
            color: var(--blog-primary);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 4px;
            transition: gap 0.2s;
        }

        .sidebar-post:hover .sidebar-read-more {
            gap: 8px;
        }

        .sidebar-post-date i {
            color: var(--blog-primary);
            font-size: 14px;
        }
    </style>
@endpush

@section('content')

    <div id="read-progress"></div>

    <div class="custom-blog-wrapper">
        <div class="container">
            <div class="row">

                {{-- ── LEFT COLUMN (MAIN ARTICLE) ── --}}
                <div class="col-lg-8">
                    <article class="article-main">

                        <div class="article-category">
                            <i class="ti ti-flame"></i> Fitness & Health
                        </div>

                        <h1 class="article-title">{{ $blog->title }}</h1>

                        <div class="article-meta-row">
                            <div class="meta-item">
                                <i class="ti ti-calendar"></i>
                                {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('F j, Y') : ($blog->created_at ? $blog->created_at->format('F j, Y') : '') }}
                            </div>

                            <div class="meta-item">
                                <i class="ti ti-chart-bar"></i>
                                {{ number_format($blog->views) }} reads
                            </div>

                            @if ($blog->city)
                                <div class="meta-item">
                                    <i class="ti ti-map-pin"></i>
                                    {{ $blog->city }}{{ $blog->state ? ', ' . $blog->state : '' }}
                                </div>
                            @endif
                        </div>

                        @if (!empty($blog->featured_image))
                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                                class="article-featured-img" onerror="this.style.display='none';">
                        @endif

                        <div class="article-body">
                            {!! $blog->content !!}
                        </div>

                    </article>
                </div>

                {{-- ── RIGHT COLUMN (SIDEBAR) ── --}}
                <div class="col-lg-4">
                    <aside class="sidebar-sticky">

                        {{-- Share Widget --}}
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Share this article</h4>
                            <div class="share-grid">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank" class="share-btn" title="Facebook"><i
                                        class="ti ti-brand-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                    target="_blank" class="share-btn" title="Twitter"><i
                                        class="ti ti-brand-twitter"></i></a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
                                    target="_blank" class="share-btn" title="WhatsApp"><i
                                        class="ti ti-brand-whatsapp"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}"
                                    target="_blank" class="share-btn" title="LinkedIn"><i
                                        class="ti ti-brand-linkedin"></i></a>
                            </div>
                            <button class="copy-btn" onclick="copyLink(this)">
                                <i class="ti ti-link"></i> Copy Article Link
                            </button>
                        </div>

                        {{-- Recent Posts Widget --}}
                        @if ($recentBlogs->count() > 0)
                            <div class="sidebar-widget">
                                <h4 class="widget-title">Recent Posts</h4>
                                <div class="sidebar-posts-list">
                                    @foreach ($recentBlogs as $recent)
                                        <a href="{{ route('blogs.show', $recent->slug) }}" class="sidebar-post {{ empty($recent->featured_image) ? 'no-image' : '' }}">
                                            @if (!empty($recent->featured_image))
                                                <img src="{{ asset($recent->featured_image) }}" alt="{{ $recent->title }}" class="sidebar-post-img" onerror="this.style.display='none'; this.closest('.sidebar-post').classList.add('no-image');">
                                            @endif
                                            <div class="sidebar-post-content">
                                                <div class="sidebar-post-title">{{ $recent->title }}</div>
                                                <div class="sidebar-post-desc">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($recent->content), 60) }}
                                                </div>
                                                <div class="sidebar-post-date">
                                                    <i class="ti ti-calendar-event"></i>
                                                    {{ $recent->published_at ? \Carbon\Carbon::parse($recent->published_at)->format('M d, Y') : ($recent->created_at ? $recent->created_at->format('M d, Y') : '') }}
                                                </div>
                                                <div class="sidebar-read-more">Read more <i class="ti ti-arrow-right"></i></div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </aside>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // ── READING PROGRESS BAR ──
        document.addEventListener('DOMContentLoaded', function() {
            const bar = document.getElementById('read-progress');
            if (!bar) return;

            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY;
                const docH = document.documentElement.scrollHeight - window.innerHeight;
                bar.style.width = (docH > 0 ? (scrollTop / docH) * 100 : 0) + '%';
            }, {
                passive: true
            });
        });

        // ── COPY LINK ──
        function copyLink(btn) {
            navigator.clipboard.writeText(window.location.href).then(function() {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="ti ti-check"></i> Copied!';
                btn.style.background = 'var(--blog-bg-alt)';

                setTimeout(function() {
                    btn.innerHTML = originalHtml;
                    btn.style.background = 'transparent';
                }, 2000);
            });
        }
    </script>
@endpush
