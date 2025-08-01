<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Verifikasi Email</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    textarea.terms {
      height: 300px;
      resize: none;
      overflow-y: scroll;
      background-color: #f8f9fa;
      padding: 15px;
      border: 1px solid #ced4da;
    }
  </style>
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <h2 class="text-center mb-4">Konfirmasi Verifikasi Email</h2>

      <p>Silakan baca dan setujui Perjanjian Pengguna sebelum melanjutkan.</p>

      <textarea id="terms" class="form-control terms" readonly>
PERJANJIAN PENGGUNA CANDY PULSA

Harap membaca syarat dan ketentuan berikut dengan seksama sebelum menggunakan layanan Candy Pulsa.

1. DEFINISI
- Candy Pulsa: Merujuk pada platform penyedia layanan pembelian pulsa, voucher digital, dan pembayaran tagihan.
- Pengguna: Individu atau badan hukum yang mendaftar dan/atau menggunakan layanan Candy Pulsa.

2. PENGGUNAAN LAYANAN
- Pengguna wajib memberikan data yang benar, akurat, dan terbaru saat pendaftaran.
- Pengguna bertanggung jawab atas keamanan akun dan aktivitas yang dilakukan melalui akun tersebut.
- Pengguna dilarang menggunakan layanan untuk aktivitas ilegal, penipuan, atau melanggar hukum yang berlaku.

3. PEMBELIAN & TRANSAKSI
- Setiap transaksi dianggap sah apabila telah dilakukan dari akun pengguna yang telah diverifikasi.
- Candy Pulsa tidak bertanggung jawab atas kesalahan pengisian nomor, nominal, atau data transaksi lainnya yang dilakukan oleh pengguna.
- Produk digital yang telah dibeli tidak dapat dikembalikan, kecuali terjadi kesalahan dari pihak Candy Pulsa.

4. SALDO & PENGISIAN
- Pengisian saldo harus dilakukan sesuai instruksi dan metode yang tersedia.
- Candy Pulsa tidak bertanggung jawab atas dana yang tidak masuk akibat kesalahan transfer dari pihak pengguna.

5. KEAMANAN DATA
- Candy Pulsa berkomitmen menjaga kerahasiaan data pengguna sesuai dengan kebijakan privasi yang berlaku.
- Namun, pengguna setuju bahwa tidak ada sistem yang sepenuhnya aman, dan memahami adanya risiko atas pelanggaran data dari pihak ketiga.

6. HAK DAN KEWAJIBAN CANDY PULSA
- Candy Pulsa berhak menolak atau menghentikan layanan terhadap pengguna yang melanggar syarat dan ketentuan ini.
- Candy Pulsa berhak mengubah, menghentikan, atau menangguhkan layanan dengan pemberitahuan sebelumnya melalui media yang wajar.

7. PENYELESAIAN SENGKETA
- Segala perselisihan yang timbul antara pengguna dan Candy Pulsa akan diselesaikan secara musyawarah.
- Jika tidak tercapai kesepakatan, maka akan diselesaikan sesuai hukum yang berlaku di Indonesia.

8. PERUBAHAN PERJANJIAN
- Candy Pulsa berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan diberitahukan kepada pengguna melalui media yang sesuai.
- Dengan terus menggunakan layanan setelah perubahan, pengguna dianggap menyetujui syarat dan ketentuan yang baru.

9. LAIN-LAIN
- Jika ada ketentuan yang tidak berlaku, ketentuan lainnya tetap berlaku sepenuhnya.
- Pengguna menyatakan telah membaca, memahami, dan menyetujui seluruh isi perjanjian ini.

Terima kasih telah menggunakan Candy Pulsa.
      </textarea>

      <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" value="" id="agree" disabled>
        <label class="form-check-label" for="agree">
          Saya telah membaca dan setuju dengan Perjanjian Pengguna.
        </label>
      </div>

      <form id="verifyForm" action="{{ route('reseller.verifyEmail') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="token" value="{{ request('token') }}">
        <button type="submit" class="btn btn-success" id="submitBtn" disabled>Klik untuk Verifikasi</button>
      </form>

    </div>
  </div>
</div>

<script>
  const textarea = document.getElementById('terms');
  const checkbox = document.getElementById('agree');
  const submitBtn = document.getElementById('submitBtn');

  textarea.addEventListener('scroll', () => {
    if (textarea.scrollTop + textarea.clientHeight >= textarea.scrollHeight) {
      checkbox.disabled = false;
    }
  });

  checkbox.addEventListener('change', () => {
    submitBtn.disabled = !checkbox.checked;
  });
</script>

</body>
</html>
