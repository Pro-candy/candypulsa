<!-- Modal Pesan -->
<div class="modal fade" id="outboxDetailModal" tabindex="-1" aria-labelledby="outboxDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="outboxDetailModalLabel">Detail Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="outboxDetailModalBody">
        <!-- Isi pesan akan dimuat AJAX -->
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk detail pengumuman -->
<div class="modal fade" id="pengumumanDetailModal" tabindex="-1" aria-labelledby="pengumumanDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pengumumanDetailModalLabel">Detail Pengumuman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="pengumumanDetailModalBody">
        <!-- Isi ajax -->
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPelangganModalLabel">Tambah Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="tambahPelangganModalBody">
        <!-- Isi form akan dimuat via AJAX -->
      </div>
    </div>
  </div>
</div>


<!-- Modal Transaksi digital -->
<div class="modal fade" id="transaksiPulsaModal" tabindex="-1" aria-labelledby="transaksiPulsaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transaksiPulsaModalLabel">Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="inputKategoriMenu" value="Pulsa">

        <div class="mb-3">
          <label for="inputNomorHP" class="form-label">Nomor Tujuan</label>
          <input type="text" id="inputNomorHP" class="form-control" maxlength="15" placeholder="Contoh: 081234567890">
          <div id="pesanErrorHP" class="form-text text-danger d-none">Tidak ada produk ditemukan. Periksa nomor tujuan.</div>
        </div>
        <div id="spinnerProduk" class="text-center d-none my-3">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>

        <div id="produkContainer" class="mb-3"></div>

        <div id="produkDipilihSection" class="d-none">
          <div class="alert alert-info">
            <strong id="produkTerpilihNama"></strong><br>
            Harga: <span id="produkTerpilihHarga"></span>
          </div>
          <div class="d-flex gap-2">
            <button type="button" id="btnTambahKeranjang" class="btn btn-success">Tambah ke Daftar Belanja</button>
            <button type="button" id="btnLanjutTransaksi" class="btn btn-primary">Lanjutkan Transaksi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal PIN -->
<div class="modal fade" id="transaksiPinModalPulsa" tabindex="-1" aria-labelledby="transaksiPinModalPulsaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form id="formTransaksiPinPulsa" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Masukkan PIN Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <input type="password" class="form-control" name="pin" maxlength="6" required placeholder="PIN">
        </div>
        <input type="hidden" name="produk_id" id="inputProdukIdPulsa">
        <input type="hidden" name="nomor_hp" id="inputPinNomorHPPulsa">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Proses</button>
      </div>
    </form>
  </div>
</div>


<!-- Modal Produk Toko -->
<div class="modal fade" id="modalProdukToko" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Produk Toko</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-2">
          <span class="input-group-text">Cari produk</span>
          <input type="text" class="form-control" placeholder="nama/kode..." onkeyup="filterProdukToko(this.value)">
        </div>
        <div id="produkContainer" style="max-height: 400px; overflow-y: auto;">
          <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Stok</th>
              </tr>
            </thead>
            <tbody id="produkTableBody"></tbody>
          </table>
        </div>
        <div id="produkDipilihSectionToko" class="d-none mt-3">
          <div class="alert alert-info">
            <strong id="produkTerpilihNamaToko"></strong><br>
            Harga: <span id="produkTerpilihHargaToko"></span><br>
            Qty: <input type="number" min="1" id="produkTerpilihQtyToko" class="form-control form-control-sm d-inline-block" style="width: 80px;" value="1">
          </div>
          <div class="d-flex gap-2">
            <button type="button" id="btnTambahKeranjangToko" class="btn btn-success">Tambah ke Daftar Belanja</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Tabel keranjang (di luar modal) -->
<table>
  <tbody id="daftarProdukBody"></tbody>
</table>

<!-- Modal pembayaran -->
<div class="modal fade" id="modalPembayaranToko" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="inputUangBayarToko" class="form-label">Uang Bayar</label>
          <input type="number" min="0" class="form-control" id="inputUangBayarToko" placeholder="Masukkan jumlah uang">
        </div>
        <div id="kembalianToko" class="fw-bold fs-5 text-success d-none">Kembalian: Rp 0</div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSimpanPembayaranToko" class="btn btn-primary">Simpan Pembayaran</button>
      </div>
    </div>
  </div>
</div>