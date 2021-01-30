<?php ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc><?= $this->Url->build(['controller' => 'Sitemap', 'action' => 'xml', '_ext' => 'xml', 'products'], true)?></loc>
    </sitemap>
    <sitemap>
        <loc><?= $this->Url->build(['controller' => 'Sitemap', 'action' => 'xml', '_ext' => 'xml', 'categories'], true)?></loc>
    </sitemap>
    <sitemap>
        <loc><?= $this->Url->build(['controller' => 'Sitemap', 'action' => 'xml', '_ext' => 'xml', 'tags'], true)?></loc>
    </sitemap>
    <sitemap>
        <loc><?= $this->Url->build(['controller' => 'Sitemap', 'action' => 'xml', '_ext' => 'xml', 'stories'], true)?></loc>
    </sitemap>
</sitemapindex>