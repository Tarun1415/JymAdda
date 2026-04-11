<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @php($siteurl = rtrim(url('/'), '/'))

    <!-- Static Pages -->
    <url>
        <loc>{{ $siteurl }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ $siteurl }}/gyms</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ $siteurl }}/services</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ $siteurl }}/about</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ $siteurl }}/contact</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>

    <!-- Dynamic Gyms Loop -->
    @if (!empty($activeGyms))
        @foreach ($activeGyms as $gym)
            <url>
                <loc>{{ $siteurl . '/' . ltrim($gym->slug, '/') }}</loc>
                <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z', strtotime($gym->updated_at)) }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @endif

</urlset>
