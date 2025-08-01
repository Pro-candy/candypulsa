<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Candy Pulsa | Beli Pulsa, Paket Data & Voucher Game Murah 24 Jam & Cocok untuk Toko</title>

  <meta name="description" content="Candy Pulsa: Beli pulsa, paket data, token PLN, dan voucher game instan. Solusi usaha toko & warung: server pulsa + POS & kasir digital.">
  <meta name="keywords" content="pulsa murah, paket data, voucher game, beli pulsa online, server pulsa, aplikasi kasir, POS toko, jual pulsa untuk warung, token PLN, pembukuan toko, candy pulsa">
  <script type="application/ld+json">
  {!! file_get_contents(public_path('schema.jsonld')) !!}
  </script>

  <!-- Canonical -->
  <link rel="canonical" href="https://www.candypulsa.com/">

  <!-- Favicons -->
  <link href="{{ asset('landing-assets/assets/img/favicon.png') }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing-assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing-assets/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('landing-assets/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('landing-assets/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('landing-assets/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('landing-assets/assets/css/main.css') }}" rel="stylesheet">

  <!-- Open Graph Meta (untuk share sosial media) -->
  <meta property="og:title" content="Candy Pulsa - Beli Pulsa dan Paket Data Murah">
  <meta property="og:description" content="Beli pulsa, paket data, dan voucher game dengan harga murah dan proses instan.">
  <meta property="og:image" content="https://www.candypulsa.com/assets/img/og-image.jpg') }}">
  <meta property="og:url" content="https://www.candypulsa.com">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Candy Pulsa - Beli Pulsa dan Paket Data Murah">
  <meta name="twitter:description" content="Beli pulsa, paket data, dan voucher game dengan harga murah dan proses instan.">
  <meta name="twitter:image" content="https://www.candypulsa.com/assets/img/og-image.jpg') }}">

  <!-- Security Headers via meta  -->
  <meta http-equiv="X-Content-Type-Options" content="nosniff">
</head>


<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href=/ class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="{{ asset('landing-assets/assets/img/logo.png') }}" alt=""> -->
        <h1 class="sitename">Candy Pulsa</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#harga">Price List</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
      <section id="hero" class="hero section dark-background">
        <img src="{{ asset('landing-assets/assets/img/hero-bg-2.jpg') }}" alt="" class="hero-bg">

        <div class="container">
            <nav class="d-lg-none mb-4">
            <div class="d-grid gap-2">
              <a class="btn btn-primary" href="#about">About</a>
              <a class="btn btn-primary" href="#features">Features</a>
              <a class="btn btn-primary" href="#harga">Price List</a>
            </div>
          </nav>
          
          <div class="row gy-4 justify-content-between">
            <div class="col-lg-5 order-lg-last hero-img d-none d-lg-block" data-aos="zoom-out" data-aos-delay="100">
              <img src="{{ asset('landing-assets/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
            </div>

            <!-- Formulir Pendaftaran Candy Pulsa -->
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-in">

              <!-- <img src="{{ asset('landing-assets/assets/img/logo.png') }}" alt="logo-form" class="img-fluid mb-4" style="max-width: 200px;"> Logo -->

              <h2 class="mb-3 text-center">Gabung sekarang dan nikmati cuan manis dari Candy Pulsa 🍭</h2>
                
                    {{-- Success Message --}}
                    {{-- Error Validation --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif                                              
              <!-- Formulir Pendaftaran Candy Pulsa -->
                <form action="/register" method="POST" class="bg-white p-4 rounded shadow-sm">
                @csrf
                 <div class="text-center text-muted my-3">
                    <div class="fw-bold">Join Cuad Disini</div>
                    <hr class="hr-candy">
                  </div>

                 <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                    <label for="nama" class="col form-label">Nama</label>
                    </div>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" required placeholder="Nama lengkap" value="{{ old('nama') }}">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                    <label for="nomor_hp" class="col form-label">No HP / WA</label>
                    </div>
                    <div class="col-sm-8">
                    <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" required placeholder="08xxxxxxxx" value="{{ old('nomor_hp') }}">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                    <label for="email" class="col form-label">Email</label>
                    </div>
                    <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="emailkamu@example.com" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-sm-4">
                    <label for="pin" class="col form-label">PIN Transaksi</label>
                    </div>
                    <div class="col-sm-8">
                    <input type="number" class="form-control" id="pin" name="pin" required placeholder="4 digit angka" value="{{ old('pin') }}">
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-sm-4">
                    <label for="password" class="col form-label">Password</label>
                    </div>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Minimal 6 karakter">
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-sm-4">
                    <label for="password_confirmation" class="col form-label">Ulangi Password</label>
                    </div>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mb-3">Daftar Sekarang</button>
                <div class="text-center text-muted mb-2">------ atau ------</div>
                <a href="/member-area/" class="btn btn-primary w-100">Login</a>
                </form>

              <p class="text-center mt-3"></p>

            </div>


          </div>
        </div>

        <!-- Waves Bawah -->
        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28 " preserveAspectRatio="none">
          <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z"></path>
          </defs>
          <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3"></use>
          </g>
          <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0"></use>
          </g>
          <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9"></use>
          </g>
        </svg>
      </section>


    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h3>About Us</h3>
            <h2>Candy Pulsa | Platform Pembelian Pulsa Berbasis Web & Android</h2>
            <p>
              Candy Pulsa adalah aplikasi berbasis Web dan Android yang memudahkan pengguna untuk membeli pulsa, paket data, dan voucher game kapan saja dan di mana saja. Dengan tampilan yang sederhana dan fitur yang lengkap, Candy Pulsa cocok digunakan oleh pengguna pribadi maupun pebisnis konter yang ingin mendapatkan keuntungan lebih.
            </p>
          </div>


          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-globe2"></i> <!-- Ganti ikon jadi globe untuk kesan web-based -->
                  <h3>Akses Langsung via Web</h3>
                  <p>Candy Pulsa dapat digunakan langsung melalui browser tanpa perlu instalasi aplikasi tambahan. Cocok untuk kamu yang ingin praktis dan cepat jualan pulsa!</p>
                </div>
              </div> <!-- End Icon Box -->


              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-cash"></i> <!-- Ganti ikon agar sesuai dengan fitur kasir -->
                  <h3>Fitur Kasir POS</h3>
                  <p>
                    Selain berjualan pulsa, Candy Pulsa juga dilengkapi dengan sistem kasir (Point of Sale) untuk mencatat transaksi penjualan harian. Cocok untuk konter dan toko kecil yang ingin lebih rapi dalam pembukuan.
                  </p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-graph-up-arrow"></i> <!-- Ikon tetap karena sudah cocok untuk laporan -->
                  <h3>Laporan Pembukuan</h3>
                  <p>
                    Candy Pulsa menyediakan fitur laporan keuangan lengkap untuk memantau laba, arus kas, dan status stok barang. Sangat membantu untuk mengetahui kondisi usaha secara real-time.
                  </p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-phone"></i> <!-- Ganti ikon agar lebih relevan dengan aplikasi Android -->
                  <h3>Pengembangan Aplikasi Android</h3>
                  <p>
                    Kami sedang mengembangkan versi Android dari Candy Pulsa agar pengguna yang terbiasa berjualan lewat aplikasi mobile bisa lebih efisien, cepat, dan nyaman. Tetap terhubung kapan saja langsung dari genggaman!
                  </p>
                </div>
              </div> <!-- End Icon Box -->


            </div>
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="features-item">
              <i class="bi bi-phone-fill" style="color: #ffbb2c;"></i>
              <h3><a href="#" class="stretched-link">Pulsa All Operator</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="features-item">
              <i class="bi bi-wifi" style="color: #5578ff;"></i>
              <h3><a href="#" class="stretched-link">Paket Data Internet</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="features-item">
              <i class="bi bi-telephone-fill" style="color: #e80368;"></i>
              <h3><a href="#" class="stretched-link">Paket Telpon & SMS</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
            <div class="features-item">
              <i class="bi bi-lightning-fill" style="color: #e361ff;"></i>
              <h3><a href="#" class="stretched-link">Token PLN Prabayar</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="500">
            <div class="features-item">
              <i class="bi bi-credit-card" style="color: #47aeff;"></i>
              <h3><a href="#" class="stretched-link">Topup E-money</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="600">
            <div class="features-item">
              <i class="bi bi-controller" style="color: #ffa76e;"></i>
              <h3><a href="#" class="stretched-link">Topup Game Online</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="700">
            <div class="features-item">
              <i class="bi bi-cash" style="color: #11dbcf;"></i>
              <h3><a href="#" class="stretched-link">Aplikasi Kasir</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="800">
            <div class="features-item">
              <i class="bi bi-box-seam" style="color: #4233ff;"></i>
              <h3><a href="#" class="stretched-link">Pencatatan Stok</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="900">
            <div class="features-item">
              <i class="bi bi-alarm" style="color: #b2904f;"></i>
              <h3><a href="#" class="stretched-link">Reminder Hutang</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1000">
            <div class="features-item">
              <i class="bi bi-clipboard-data" style="color: #b20969;"></i>
              <h3><a href="#" class="stretched-link">Laporan Penjualan</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1100">
            <div class="features-item">
              <i class="bi bi-diagram-3-fill" style="color: #ff5828;"></i>
              <h3><a href="#" class="stretched-link">Laporan Stok</a></h3>
            </div>
          </div>

          <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1200">
            <div class="features-item">
              <i class="bi bi-stars" style="color: #29cc61;"></i>
              <h3><a href="#" class="stretched-link">Dan Masih Banyak Lagi</a></h3>
            </div>
          </div>


        </div>

      </div>

    </section><!-- /Features Section -->
    <!-- data Section show -->
    <section id="stats" class="stats section light-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">

          <!-- Operator Aktif -->
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-broadcast-pin" style="font-size: 48px; color: #47aeff;"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ $totalOperatorAktif }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Operator Aktif</p>
            </div>
          </div><!-- End Stats Item -->

          <!-- Produk Aktif -->
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center">
            <i class="bi bi-box-seam" style="font-size: 48px; color: #ff5828;"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ $totalProdukAktif }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Produk Aktif</p>
            </div>
          </div><!-- End Stats Item -->

        </div>
      </div>
    </section>
    <!--end data Section show-->


    <!-- Details Section -->
    <section id="harga" class="details section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Daftar Harga</h2>
        <div class="row mb-3">
          <span class="description-title col-sm-6">Harga Candy Pulsa</span>
        </div>
      </div>
      
      </div><!-- End Section Title -->

      
      <!-- Table Section -->
        @foreach($groupedProduk as $operatorNama => $produkList)
      <div class="container" data-aos="fade-up" data-aos-delay="200">
          <h2>{{ $operatorNama }}</h2>
          <div class="table-responsive">
              <table class="table table-striped table-bordered">
                  <thead class="table-primary">
                      <tr>
                          <th style="width: 5%;">No</th>
                          <th style="width: 15%;">Kode</th>
                          <th style="width: 40%;">Nama Produk</th>
                          <th style="width: 20%;">Harga</th>
                          <th style="width: 20%;">Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($produkList as $no => $produk)
                      <tr class="align-middle">
                          <td>{{ $no+1 }}</td>
                          <td>{{ $produk->kode }}</td>
                          <td>{{ $produk->nama }}</td>
                          <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                          <td>
                              @if($produk->operator && $produk->operator->gangguan === 'yes')
                                  <span class="badge bg-danger">Gangguan</span>
                              @elseif($produk->gangguan === 'yes')
                                  <span class="badge bg-warning">Gangguan</span>
                              @else
                                  <span class="badge bg-success">Aktif</span>
                              @endif
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      @endforeach
      <!-- End Table Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href=/ class="logo d-flex align-items-center">
            <span class="sitename">Candy Pulsa</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Lotus Tim., Ruko Sentra Office RSOD/20 Grand Galaxy City</p>
            <p>Jaka Setia, Kec. Bekasi Selatan</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+6281 779 544 044</span></p>
            <p><strong>Email:</strong> <span>procandytech@gmail.com</span></p>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Bootslander</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landing-assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('landing-assets/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('landing-assets/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('landing-assets/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('landing-assets/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('landing-assets/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('landing-assets/assets/js/main.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const input = document.getElementById("searchProduk");
  input.addEventListener("keyup", function() {
    let filter = input.value.toLowerCase().trim();
    let firstVisibleArea = null;

    // Loop semua container operator
    document.querySelectorAll('div.container[data-aos="fade-up"][data-aos-delay="200"]').forEach(function(area) {
      let tbody = area.querySelector("tbody");
      let rows = tbody ? Array.from(tbody.querySelectorAll("tr")) : [];
      let visibleRows = 0;
      rows.forEach(function(row) {
        let kode = (row.cells[1]?.textContent || "").toLowerCase();
        let nama = (row.cells[2]?.textContent || "").toLowerCase();
        // Wildcard match di kode dan nama produk
        if (kode.includes(filter) || nama.includes(filter)) {
          row.style.display = "";
          visibleRows++;
        } else {
          row.style.display = "none";
        }
      });
      // Tampilkan/hilangkan area operator
      if (visibleRows === 0) {
        area.style.display = "none";
      } else {
        area.style.display = "";
        if (!firstVisibleArea) {
          firstVisibleArea = area;
        }
      }
    });
    // Auto scroll ke hasil pertama
    if (firstVisibleArea && filter.length > 0) {
      setTimeout(function() { // Timeout untuk memastikan DOM sudah update
        firstVisibleArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 100);
    }
  });
});
</script>
</body>
</html>