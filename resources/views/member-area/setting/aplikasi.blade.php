@extends('member-area.layout')

@section('head')
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Candy Pulsa | Dashboard</title>

  <!-- Meta Info -->
  <meta name="title" content="AdminLTE v4 | Dashboard" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description" content="Candy Pulsa adalah platform terpercaya untuk membeli pulsa, paket data, dan voucher game dengan harga terjangkau dan proses instan.">
  <meta name="keywords" content="pulsa murah, paket data, voucher game, beli pulsa online, Candy Pulsa, server pulsa, agen pulsa, jual pulsa murah, topup pulsa, beli paket data, beli voucher game">

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" 
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" 
        crossorigin="anonymous" />

  <!-- OverlayScrollbars Plugin -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" 
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" 
        crossorigin="anonymous" />

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" 
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" 
        crossorigin="anonymous" />

  <!-- AdminLTE CSS (local) -->
  <link rel="stylesheet" href="{{ asset('member-assets/css/adminlte.min.css') }}" />



  <!-- JS Vector Map -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" 
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" 
        crossorigin="anonymous" />
@endsection
@section('content') 
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
          <div class="container-fluid">

            <!--begin::Row-->
                <div class="row">
                <!-- Saldo -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>Rp 1.250.000</h3>
                        <p>Saldo</p>
                    </div>
                    <i class="small-box-icon bi bi-wallet2"></i>
                    <a href="#" class="small-box-footer link-light">
                        Detail <i class="bi bi-link-45deg"></i>
                    </a>
                    </div>
                </div>

                <!-- Transaksi -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>312</h3>
                        <p>Total Transaksi</p>
                    </div>
                    <i class="small-box-icon bi bi-arrow-repeat"></i>
                    <a href="#" class="small-box-footer link-light">
                        Lihat Transaksi <i class="bi bi-link-45deg"></i>
                    </a>
                    </div>
                </div>

                <!-- Produk -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>123</h3>
                        <p>Produk Aktif</p>
                    </div>
                    <i class="small-box-icon bi bi-box-seam"></i>
                    <a href="#" class="small-box-footer link-dark">
                        Manajemen Produk <i class="bi bi-link-45deg"></i>
                    </a>
                    </div>
                </div>

                <!-- Total Produk -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>312</h3>
                        <p>Total Produk</p>
                    </div>
                    <i class="small-box-icon bi bi-collection"></i>
                    <a href="#" class="small-box-footer link-light">
                        Semua Produk <i class="bi bi-link-45deg"></i>
                    </a>
                    </div>
                </div>
                </div>
            <!--end::Row-->


            <!--begin::Row - Menu Fitur-->
                <div class="row g-4">
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="features-item text-center">
                    <i class="bi bi-phone-fill fs-1" style="color: #ffbb2c;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Pulsa All Operator</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="features-item text-center">
                    <i class="bi bi-wifi fs-1" style="color: #5578ff;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Paket Data Internet</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="features-item text-center">
                    <i class="bi bi-telephone-fill fs-1" style="color: #e80368;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Paket Telpon & SMS</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="features-item text-center">
                    <i class="bi bi-lightning-fill fs-1" style="color: #e361ff;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Token PLN Prabayar</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="features-item text-center">
                    <i class="bi bi-credit-card fs-1" style="color: #47aeff;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Topup E-money</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="features-item text-center">
                    <i class="bi bi-controller fs-1" style="color: #ffa76e;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Topup Game Online</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="700">
                    <div class="features-item text-center">
                    <i class="bi bi-cash fs-1" style="color: #11dbcf;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Aplikasi Kasir</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="800">
                    <div class="features-item text-center">
                    <i class="bi bi-box-seam fs-1" style="color: #4233ff;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Pencatatan Stok</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="900">
                    <div class="features-item text-center">
                    <i class="bi bi-alarm fs-1" style="color: #b2904f;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Reminder Hutang</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1000">
                    <div class="features-item text-center">
                    <i class="bi bi-clipboard-data fs-1" style="color: #b20969;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Laporan Penjualan</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1100">
                    <div class="features-item text-center">
                    <i class="bi bi-diagram-3-fill fs-1" style="color: #ff5828;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Laporan Stok</a>
                    </h5>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1200">
                    <div class="features-item text-center">
                    <i class="bi bi-stars fs-1" style="color: #29cc61;"></i>
                    <h5 class="mt-3">
                        <a href="#" class="stretched-link text-decoration-none">Dan Masih Banyak Lagi</a>
                    </h5>
                    </div>
                </div>
                </div>
            <!--end::Row-->


          </div>
        </div>   
      </main>
      <!--end::App Main-->
@endsection   
    <!--end::App Wrapper-->
@section('scripts')
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('member-assets/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
      crossorigin="anonymous"
    ></script>
    <!-- sortablejs -->
    <script>
      const connectedSortables = document.querySelectorAll('.connectedSortable');
      connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
          group: 'shared',
          handle: '.card-header',
        });
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>
    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"
    ></script>
    <!--end::Script-->
@endsection