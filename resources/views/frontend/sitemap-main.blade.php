<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @php($siteurl = rtrim(url('/'), '/'))

    <!-- Home -->

    <url>
        <loc>{{ $siteurl }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Static Pages -->

    <url>
        <loc>{{ $siteurl }}/gyms</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <url>
        <loc>{{ $siteurl }}/blogs</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ $siteurl }}/ifsc-code</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <!-- Gyms -->

    @foreach ($activeGyms as $gym)

        <url>
            <loc>{{ $siteurl . '/' . ltrim($gym->slug, '/') }}</loc>
            <lastmod>{{ $gym->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>

    @endforeach

    <!-- Blogs -->

    @foreach ($blogs as $blog)

        <url>
            <loc>{{ route('blogs.show', $blog->slug) }}</loc>
            <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>

    @endforeach

</urlset>