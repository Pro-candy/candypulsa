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


<!-- Modal Transaksi Pulsa -->
<div class="modal fade" id="transaksiPulsaModal" tabindex="-1" aria-labelledby="transaksiPulsaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transaksiPulsaModalLabel">Transaksi Pulsa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <!-- Step 1: Input Nomor HP -->
        <div class="mb-3">
          <label class="form-label">Nomor HP Tujuan</label>
          <input type="text" class="form-control" id="inputNomorHP" maxlength="15" placeholder="Contoh: 085234567890">
          <div class="form-text text-danger d-none" id="pesanPrefixTidakCocok">
            Tidak ada produk ditemukan. Periksa nomor tujuan.
          </div>
        </div>

        <!-- Step 2: Produk Promo -->
        <div id="produkPromoSection" class="mb-3">
          <h6>Promo</h6>
          <div id="produkPromoList" class="d-flex flex-wrap gap-2"></div>
        </div>

        <!-- Step 3: Produk Reguler -->
        <div id="produkRegulerSection" class="mb-3">
          <h6>Reguler</h6>
          <div id="produkRegulerList" class="d-flex flex-wrap gap-2"></div>
        </div>

        <!-- Step 4: Pilihan Produk & Aksi -->
        <div id="produkDipilihSection" class="mb-3 d-none">
          <div class="alert alert-info">
            <b id="produkTerpilihNama"></b><br>
            Harga: <span id="produkTerpilihHarga"></span>
          </div>
          <div class="d-flex gap-2">
            <button id="btnTambahKeranjang" class="btn btn-success" type="button">Tambah ke Daftar</button>
            <button id="btnLanjutTransaksi" class="btn btn-primary" type="button">Lanjutkan Transaksi</button>
          </div>
        </div>
      </div>
      <!-- Footer kosong, aksi pindah ke section di atas -->
      <div class="modal-footer">
        <!-- Kosong, tombol aksi di section produkDipilihSection -->
      </div>
    </div>
  </div>
</div>

<!-- Modal PIN -->
<div class="modal fade" id="transaksiPinModal" tabindex="-1" aria-labelledby="transaksiPinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form id="formTransaksiPin" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Masukkan PIN Transaksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <input type="password" class="form-control" name="pin" maxlength="6" required placeholder="PIN">
        </div>
        <input type="hidden" name="produk_id" id="inputProdukId">
        <input type="hidden" name="nomor_hp" id="inputPinNomorHP">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Proses</button>
      </div>
    </form>
  </div>
</div>

</script>
<!--
<script>
$(function(){
  let produkTerpilih = null;
  let keranjang = [];

  // Saat modal dibuka, reset isi
  $('#transaksiPulsaModal').on('show.bs.modal', function(){
    $('#inputNomorHP').val('');
    $('#produkPromoList').empty();
    $('#produkRegulerList').empty();
    $('#produkDipilihSection').addClass('d-none');
    $('#btnLanjutTransaksi').prop('disabled', true);
    $('#pesanPrefixTidakCocok').addClass('d-none');
    $('#pesanNomorPendek').remove();
    produkTerpilih = null;
  });

  // Validasi nomor HP minimal 10 digit, AJAX produk pulsa
  $('#inputNomorHP').on('input', function(){
    const nomor = $(this).val().replace(/\D/g, '');
    $('#pesanNomorPendek').remove();
    if (nomor.length < 3) {
      $('#produkPromoList').empty();
      $('#produkRegulerList').empty();
      $('#produkDipilihSection').addClass('d-none');
      $('#btnLanjutTransaksi').prop('disabled', true);
      $('#pesanPrefixTidakCocok').addClass('d-none');
      return;
    }
    if (nomor.length < 10) {
      $('<div id="pesanNomorPendek" class="form-text text-danger mt-1">Nomor HP minimal 10 digit.</div>').insertAfter($(this));
      $('#produkPromoList').empty();
      $('#produkRegulerList').empty();
      $('#produkDipilihSection').addClass('d-none');
      $('#btnLanjutTransaksi').prop('disabled', true);
      return;
    }
    // AJAX produk pulsa
    $.get('/member-area/transaksi/pulsa/produk', { nomor_hp: nomor }, function(res){
      if(res.success){
        $('#pesanPrefixTidakCocok').addClass('d-none');
        renderProdukList('#produkPromoList', res.promo);
        renderProdukList('#produkRegulerList', res.reguler);
      }else{
        $('#produkPromoList').empty();
        $('#produkRegulerList').empty();
        $('#produkDipilihSection').addClass('d-none');
        $('#btnLanjutTransaksi').prop('disabled', true);
        $('#pesanPrefixTidakCocok').removeClass('d-none');
      }
    });
  });

  // Render produk
  function renderProdukList(selector, produkList) {
    const $list = $(selector);
    $list.empty();
    if (!produkList || !produkList.length) {
      $list.append('<div class="text-muted">Tidak ada produk</div>');
      return;
    }
    const row = $('<div class="row g-3"></div>');
    produkList.forEach(function (produk) {
      const gambar = produk.gambar 
        ? `/storage/operator/${produk.gambar}`
        : '/storage/operator/default.png';
      const card = `
        <div class="col-4 col-md-4">
          <div class="card produk-item shadow-sm p-2 h-100" 
               data-id="${produk.id}" 
               data-nama="${produk.nama}" 
               data-harga="${produk.harga}">
            <div class="d-flex align-items-center">
              <img src="${gambar}" alt="${produk.nama}" 
                   style="width:40px;height:40px;" 
                   class="me-2 rounded" />
              <div>
                <div class="fw-semibold">${produk.nama}</div>
                <div class="text-primary fw-bold">Rp${parseInt(produk.harga).toLocaleString('id-ID')}</div>
              </div>
            </div>
          </div>
        </div>
      `;
      row.append(card);
    });
    $list.append(row);
  }

  // Handle klik produk
  $(document).on('click', '.produk-item', function(){
    const nomorHP = $('#inputNomorHP').val().replace(/\D/g, '');
    $('#pesanNomorPendek').remove();
    if (nomorHP.length < 10) {
      $('<div id="pesanNomorPendek" class="form-text text-danger mt-1">Nomor HP minimal 10 digit.</div>').insertAfter($('#inputNomorHP'));
      $('#produkDipilihSection').addClass('d-none');
      $('#btnLanjutTransaksi').prop('disabled', true);
      return;
    }
    $('.produk-item').removeClass('border-primary border-2');
    $(this).addClass('border-primary border-2');
    produkTerpilih = {
      id: $(this).data('id'),
      nama: $(this).data('nama'),
      harga: $(this).data('harga')
    };
    $('#produkTerpilihNama').text(produkTerpilih.nama);
    $('#produkTerpilihHarga').text('Rp ' + parseInt(produkTerpilih.harga).toLocaleString('id-ID'));
    $('#produkDipilihSection').removeClass('d-none');
    $('#btnLanjutTransaksi').prop('disabled', false);
  });

  // Tambah produk ke keranjang (anti duplikat, konfirmasi jika produk beda di nomor sama)
  $('#btnTambahKeranjang').on('click', function(){
    if (produkTerpilih) {
      const nomorHP = $('#inputNomorHP').val().replace(/\D/g, '');
      // Cek duplikat produk & nomor
      const ada = keranjang.find(item => item.id === produkTerpilih.id && item.nomor === nomorHP);
      if (ada) {
        alert('Produk dengan nomor ini sudah ada di daftar!');
        return;
      }
      // Cek jika nomor sama, produk beda
      const adaNomorSaja = keranjang.find(item => item.nomor === nomorHP && item.id !== produkTerpilih.id);
      if (adaNomorSaja) {
        if (!confirm('Anda akan melakukan pengisian ke nomor yang sama dengan produk berbeda.\n' +
          'Produk sebelumnya: ' + adaNomorSaja.nama + '\nProduk baru: ' + produkTerpilih.nama + '\nLanjutkan?')) {
          return;
        }
      }
      keranjang.push({
        id: produkTerpilih.id,
        nama: produkTerpilih.nama + (nomorHP ? ' ('+nomorHP+')' : ''),
        harga: produkTerpilih.harga,
        qty: 1,
        nomor: nomorHP
      });
      renderKeranjangTable();
      produkTerpilih = null;
      $('#produkDipilihSection').addClass('d-none');
      $('#btnLanjutTransaksi').prop('disabled', true);
      alert('Produk berhasil ditambahkan.');
    }
  });

  // Render keranjang ke tabel
  function renderKeranjangTable() {
    const $body = $('#daftarProdukBody');
    $body.empty();
    if (keranjang.length === 0) {
      $body.append('<tr><td colspan="6" class="text-center text-muted">Belum ada produk</td></tr>');
      return;
    }
    keranjang.forEach((item, idx) => {
      $body.append(`
        <tr>
          <td class="text-center">${idx + 1}</td>
          <td>${item.id}</td>
          <td>${item.nama}</td>
          <td>
            <input type="number" min="1" class="form-control form-control-sm inputQty" data-index="${idx}" value="${item.qty}">
          </td>
          <td class="text-end">Rp ${parseInt(item.harga * item.qty).toLocaleString('id-ID')}</td>
          <td class="text-center">
            <button class="btn btn-danger btn-sm btnHapusProduk" data-index="${idx}">&times;</button>
          </td>
        </tr>
      `);
    });
  }

  // Hapus produk dari keranjang
  $(document).on('click', '.btnHapusProduk', function(){
    const idx = $(this).data('index');
    keranjang.splice(idx, 1);
    renderKeranjangTable();
  });

  // Ubah qty
  $(document).on('input', '.inputQty', function(){
    const idx = $(this).data('index');
    let val = parseInt($(this).val());
    if (isNaN(val) || val < 1) val = 1;
    keranjang[idx].qty = val;
    renderKeranjangTable();
  });

  // Lanjutkan transaksi satu produk (langsung PIN)
  $('#btnLanjutTransaksi').on('click', function(){
    $('#inputProdukId').val(produkTerpilih.id);
    $('#inputPinNomorHP').val($('#inputNomorHP').val());
    $('#transaksiPinModal').modal('show');
  });

  // Lanjutkan transaksi keranjang (checkout banyak produk)
  $('#btnLanjutTransaksiKeranjang').on('click', function(){
    if (keranjang.length === 0) {
      alert('Keranjang kosong!');
      return;
    }
    $('#inputProdukId').val(JSON.stringify(keranjang));
    $('#inputPinNomorHP').val('');
    $('#transaksiPinModal').modal('show');
  });

  // Submit PIN transaksi
  $('#formTransaksiPin').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      url: '/member-area/transaksi/pulsa/proses',
      method: 'POST',
      data: $(this).serialize(),
      success: function(res){
        if(res.success){
          $('#transaksiPinModal').modal('hide');
          $('#transaksiPulsaModal').modal('hide');
          alert('Transaksi berhasil!');
          keranjang = [];
          renderKeranjangTable();
        }else{
          alert(res.message || 'Transaksi gagal.');
        }
      },
      error: function(xhr){
        alert('Terjadi kesalahan server.');
      }
    });
  });

});
</script> 
--->