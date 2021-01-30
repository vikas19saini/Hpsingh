<?php ?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($stories as $story):?>
    <url>
        <loc><?= $this->Url->build(['_name' => 'stories', $story->slug], true)?></loc>
        <lastmod><?= date_format($story->modified, 'c')?></lastmod>
    </url>
    <?php endforeach;?>
</urlset>