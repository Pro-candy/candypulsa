{{-- partial/head.blade.php --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'Candy Pulsa Member Area')</title>

<meta name="title" content="@yield('meta_title', 'Candy Pulsa Member Area')" />
<meta name="author" content="ColorlibHQ" />
<meta name="description" content="Candy Pulsa adalah platform terpercaya untuk membeli pulsa, paket data, dan voucher game dengan harga terjangkau dan proses instan.">
<meta name="keywords" content="pulsa murah, paket data, voucher game, beli pulsa online, Candy Pulsa, server pulsa, agen pulsa, jual pulsa murah, topup pulsa, beli paket data, beli voucher game">
<link href="{{ asset('landing-assets/assets/img/favicon.png') }}" rel="icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('member-assets/css/adminlte.min.css') }}" />
<link rel="stylesheet" href="{{ asset('member-assets/css/main.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous" />

{{-- Section tambahan untuk head di setiap halaman --}}
@yield('head')