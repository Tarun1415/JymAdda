<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

@foreach ($banks as $bank)

    <url>

        <loc>
            {{ url('/ifsc-code/' .
                $bank->bank_slug . '/' .
                $bank->state_slug . '/' .
                $bank->district_slug . '/' .
                strtolower($bank->ifsc_slug ?: $bank->ifsc)
            ) }}
        </loc>

        <lastmod>
            {{ optional($bank->updated_at)->toAtomString() }}
        </lastmod>

        <changefreq>monthly</changefreq>

        <priority>0.7</priority>

    </url>

@endforeach

</urlset>