@php
echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <sitemap>
        <loc>{{ url('/sitemap-main.xml') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </sitemap>

    @for($i = 1; $i <= $totalBankSitemaps; $i++)

        <sitemap>
            <loc>{{ url('/bank-sitemap-' . $i . '.xml') }}</loc>
            <lastmod>{{ now()->toAtomString() }}</lastmod>
        </sitemap>

    @endfor

</sitemapindex>