<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('/') }}/categories</loc>
        <lastmod>{{ $categories->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/') }}/brands</loc>
        <lastmod>{{ $brands->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/') }}/products</loc>
        <lastmod>{{ $products->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>
