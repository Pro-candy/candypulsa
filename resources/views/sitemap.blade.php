
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Halaman utama -->
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>

    <!-- Ngaji -->
    <url>
        <loc>{{ url('/ngaji') }}</loc>
        <priority>0.9</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ url('/ngaji/surat') }}</loc>
        <priority>0.9</priority>
        <changefreq>monthly</changefreq>
    </url>

    <!-- Detail surat ngaji -->
    @foreach ($list as $surat)
    <url>
        <loc>{{ url('/ngaji/surat/' . $surat['slug']) }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    @endforeach

    <!-- Member area login (khusus pengguna) -->
    <url>
        <loc>{{ url('https://candypulsa.cloud/member-area/login') }}</loc>
        <priority>0.6</priority>
        <changefreq>yearly</changefreq>
    </url>

</urlset>
