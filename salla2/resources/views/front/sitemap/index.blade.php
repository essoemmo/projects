<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>
            {{ route('storeSiteMap', [
                    'locale' => app()->getLocale(),
                ])
            }}/categories
        </loc>
        <lastmod>{{ $categories->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>
            {{ route('storeSiteMap', [
                'locale' => app()->getLocale(),
                ])
            }}/products
        </loc>
        <lastmod>{{ $products->created_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>
