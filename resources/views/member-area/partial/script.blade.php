<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Popper & Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

<!-- OverlayScrollbars -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>

<!-- AdminLTE -->
<script src="{{ asset('member-assets/js/adminlte.js') }}"></script>

<!-- OverlayScrollbars Init -->
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

<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
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

<!-- JSVectorMap -->
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>

<!-- Pesan Singkat Modal -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pesan-singkat').forEach(function(el) {
      // Tampilkan ... baca jika terpotong
      if (el.scrollHeight > el.offsetHeight + 5) {
        el.querySelector('.baca-detail').style.display = '';
      }

      el.addEventListener('click', function() {
        const msgId = el.getAttribute('data-id');
        // Ambil detail via AJAX & tampilkan modal
        fetch('/member-area/inbox-reseller/' + msgId)
          .then(res => res.text())
          .then(html => {
            document.getElementById('outboxDetailModalBody').innerHTML = html;
            var myModal = new bootstrap.Modal(document.getElementById('outboxDetailModal'));
            myModal.show();
          });
      });
    });
  });
</script>

<!-- Pengumuman Modal -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  function bindPengumumanDropdownModal() {
    document.querySelectorAll('.lihat-pengumuman').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        fetch('/member-area/pengumuman/' + id)
          .then(res => res.text())
          .then(html => {
            document.getElementById('pengumumanDetailModalBody').innerHTML = html;
            let myModal = new bootstrap.Modal(document.getElementById('pengumumanDetailModal'));
            myModal.show();
          });
      });
    });
  }
  bindPengumumanDropdownModal();
});
</script>

<!-- cari pelanggan -->
<script>
$(document).ready(function () {
  const $input = $('#inputNamaPelanggan');
  const $dropdown = $('#dropdownPelanggan');
  const $kodeHidden = $('#inputKodePelanggan');

  let selectedIndex = -1;
  let suggestions = [];
  let debounceTimer = null;

  $input.on('input', function () {
    clearTimeout(debounceTimer);
    const query = $(this).val().trim();

    if (query.length < 1) {
      $dropdown.addClass('d-none').empty();
      $kodeHidden.val('');
      return;
    }

    debounceTimer = setTimeout(() => {
      $.getJSON('/member-area/pelanggan/autocomplete?q=' + encodeURIComponent(query), function (data) {
        suggestions = data || [];
        selectedIndex = -1;
        $dropdown.empty();

        if (suggestions.length === 0) {
          $dropdown.addClass('d-none');
          return;
        }

        suggestions.forEach((item, index) => {
          const html = `<a href="#" class="list-group-item list-group-item-action" data-index="${index}">${item.kode} - ${item.nama}</a>`;
          $dropdown.append(html);
        });

        $dropdown.removeClass('d-none');
      });
    }, 200);
  });

  // Klik untuk pilih
  $dropdown.on('click', 'a', function (e) {
    e.preventDefault();
    const idx = $(this).data('index');
    const item = suggestions[idx];
    $input.val(item.nama);
    $kodeHidden.val(item.kode);
    $dropdown.addClass('d-none');
  });

  // Keyboard arrow & enter
  $input.on('keydown', function (e) {
    const items = $dropdown.find('a');
    if (!$dropdown.hasClass('d-none') && items.length) {
      if (e.key === 'ArrowDown') {
        e.preventDefault();
        selectedIndex = (selectedIndex + 1) % items.length;
        items.removeClass('active');
        items.eq(selectedIndex).addClass('active').get(0).scrollIntoView({ block: 'nearest' });
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        selectedIndex = (selectedIndex - 1 + items.length) % items.length;
        items.removeClass('active');
        items.eq(selectedIndex).addClass('active').get(0).scrollIntoView({ block: 'nearest' });
      } else if (e.key === 'Enter') {
        e.preventDefault();
        if (selectedIndex >= 0) {
          items.eq(selectedIndex).trigger('click');
        }
      }
    }
  });

  // Klik di luar untuk tutup dropdown
  $(document).on('click', function (e) {
    if (!$(e.target).closest('#inputNamaPelanggan, #dropdownPelanggan').length) {
      $dropdown.addClass('d-none');
    }
  });
});
</script>

<!-- Tambah Pelanggan -->
<script>
document.addEventListener("DOMContentLoaded", function() {

    // Saat tombol tambah pelanggan diklik
    $(document).on('click', '.btn-tambah-pelanggan', function(e) {
        e.preventDefault();

        // Buka modal
        $('#tambahPelangganModal').modal('show');

        // Load isi modal dari route create
        $('#tambahPelangganModalBody').load('{{ route("reseller.pelanggan.create") }}');
    });

    // Tangani submit form yang muncul dinamis
    $(document).on('submit', '#formTambahPelanggan', function(e) {
        e.preventDefault(); // ⛔ Hentikan submit default

        let formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            success: function(res) {
                if (res.success) {
                    // ✅ Tutup modal
                    $('#tambahPelangganModal').modal('hide');

                    // ✅ Isi input pelanggan utama
                    $('#inputNamaPelanggan').val(res.data.nama);
                    $('#inputNamaPelanggan').data('pelanggan', res.data);
                    $('#inputKodePelanggan').val(res.data.kode_pelanggan);

                    toastr.success(res.message);
                } else {
                    toastr.error(res.message || 'Gagal menambahkan pelanggan');
                }
            },
            error: function(xhr) {
                toastr.error('Gagal menyimpan pelanggan');
            }
        });
    });

});
</script>

<script>
// Gabungan transaksi digital dan toko ke satu keranjang + satu render keranjang
document.addEventListener('DOMContentLoaded', function () {
  // ---------- KERANJANG UTAMA ----------
  let keranjangGabungan = []; // semua produk digital & toko

  // ---------- MODAL TRANSAKSI DIGITAL ----------
  let produkTerpilihDigital = null;

  // Ambil elemen modal digital
  const tombolBukaModal = document.querySelectorAll('.btn-buka-modal');
  const inputHP = document.getElementById('inputNomorHP');
  const errorMsg = document.getElementById('pesanErrorHP');
  const produkContainer = document.getElementById('produkContainer');
  const spinner = document.getElementById('spinnerProduk');
  const pilihSection = document.getElementById('produkDipilihSection');
  const produkNama = document.getElementById('produkTerpilihNama');
  const produkHarga = document.getElementById('produkTerpilihHarga');
  const btnTambahDigital = document.getElementById('btnTambahKeranjang');
  const btnLanjut = document.getElementById('btnLanjutTransaksi');
  const inputProdukId = document.getElementById('inputProdukIdPulsa');
  const inputPinNomorHP = document.getElementById('inputPinNomorHPPulsa');
  const transaksiPulsaModal = document.getElementById('transaksiPulsaModal');

  tombolBukaModal.forEach(btn => {
    btn.addEventListener('click', function () {
      const menu = this.getAttribute('data-menu') || 'Pulsa';
      document.getElementById('inputKategoriMenu').value = menu;
      document.getElementById('transaksiPulsaModalLabel').textContent = 'Transaksi - ' + menu;
      const modal = new bootstrap.Modal(transaksiPulsaModal);
      modal.show();
    });
  });

  $('#transaksiPulsaModal').on('show.bs.modal', function () {
    inputHP.value = '';
    errorMsg.classList.add('d-none');
    produkContainer.innerHTML = '';
    pilihSection.classList.add('d-none');
    produkTerpilihDigital = null;
  });
  $('#transaksiPulsaModal').on('hidden.bs.modal', function () {
    inputHP.value = '';
    errorMsg.classList.add('d-none');
    produkContainer.innerHTML = '';
    pilihSection.classList.add('d-none');
    produkTerpilihDigital = null;
    setTimeout(() => document.activeElement?.blur(), 10);
  });

  inputHP.addEventListener('input', function () {
    const nomor = inputHP.value.replace(/\D/g, '');
    produkContainer.innerHTML = '';
    pilihSection.classList.add('d-none');
    errorMsg.classList.add('d-none');
    produkTerpilihDigital = null;

    const menu = document.getElementById('inputKategoriMenu').value;
    const minLength = (menu === 'Game') ? 5 : 9;
    if (nomor.length < minLength) return;

    spinner.classList.remove('d-none');
    setTimeout(() => {
      fetch(`/member-area/transaksi/pulsa/produk?nomor_hp=${nomor}&menu=${menu}`)
        .then(res => res.json())
        .then(res => {
          spinner.classList.add('d-none');
          if (!res.success) {
            errorMsg.classList.remove('d-none');
            return;
          }
          produkContainer.innerHTML = '';
          res.operators.forEach((group, index) => {
            produkContainer.innerHTML += buildProdukGroup(group, nomor, index === 0);
          });
          $('[data-lte-toggle="card-collapse"]').off('click').on('click', function () {
            const $card = $(this).closest('.card');
            const $body = $card.children('.card-body');
            if ($card.hasClass('collapsed-card')) {
              $body.slideDown(200, function () { $card.removeClass('collapsed-card'); });
            } else {
              $body.slideUp(200, function () { $card.addClass('collapsed-card'); });
            }
          });
          window.dispatchEvent(new Event('lte:init'));
        })
        .catch(() => {
          spinner.classList.add('d-none');
          errorMsg.classList.remove('d-none');
        });
    }, 300);
  });

  function buildProdukGroup(group, nomor, open = false) {
    const collapseClass = open ? '' : 'collapsed-card';
    const displayStyle = open ? '' : 'style="display: none;"';
    let html = `
      <div class="card ${group.head_property || 'card-primary'} ${collapseClass} mb-3">
        <div class="card-header">
          <h5 class="card-title mb-0">${group.nama}</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0" ${displayStyle}>
          <div class="row g-2 p-2">
    `;
    group.produk.forEach(p => {
      const harga = parseInt(p.harga).toLocaleString('id-ID');
      html += `
        <div class="col-4">
          <div class="card produk-item shadow-sm p-2 h-100"
               data-id="${p.id}" data-nama="${p.nama}" data-harga="${p.harga}" data-nomor="${nomor}" data-tipe="digital">
            <div class="d-flex align-items-center">
              <img src="/storage/operator/${p.gambar || 'default.png'}" alt="${p.nama}" class="me-2 rounded" width="40" height="40">
              <div>
                <div class="fw-semibold">${p.nama}</div>
                <div class="text-primary fw-bold">Rp${harga}</div>
              </div>
            </div>
          </div>
        </div>`;
    });
    html += '</div></div></div>';
    return html;
  }

  // Handle klik produk digital
  document.addEventListener('click', function (e) {
    const el = e.target.closest('.produk-item');
    if (!el || !transaksiPulsaModal.classList.contains('show')) return;
    const menu = document.getElementById('inputKategoriMenu').value;
    const nomor = inputHP.value.replace(/\D/g, '');
    const minLength = (menu === 'Game') ? 5 : 9;
    if (nomor.length < minLength) {
      alert(`Nomor minimal ${minLength} digit untuk ${menu}`);
      return;
    }
    document.querySelectorAll('.produk-item').forEach(item => item.classList.remove('border-primary', 'border-2'));
    el.classList.add('border-primary', 'border-2');
    produkTerpilihDigital = {
      id: el.dataset.id,
      nama: el.dataset.nama,
      harga: el.dataset.harga,
      nomor: nomor,
      qty: 1,
      tipe: 'digital'
    };
    produkNama.textContent = produkTerpilihDigital.nama;
    produkHarga.textContent = 'Rp ' + parseInt(produkTerpilihDigital.harga).toLocaleString('id-ID');
    pilihSection.classList.remove('d-none');
  });

  // Tambah produk digital ke keranjang utama
  $('#btnTambahKeranjang').on('click', function () {
    if (produkTerpilihDigital) {
      const nomorHP = inputHP.value.replace(/\D/g, '');
      const ada = keranjangGabungan.find(item => item.id === produkTerpilihDigital.id && item.nomor === nomorHP && item.tipe === 'digital');
      if (ada) {
        alert('Produk dengan nomor ini sudah ada di daftar!');
        return;
      }
      keranjangGabungan.push({
        id: produkTerpilihDigital.id,
        nama: produkTerpilihDigital.nama + (nomorHP ? ' (' + nomorHP + ')' : ''),
        harga: produkTerpilihDigital.harga,
        qty: 1,
        nomor: nomorHP,
        tipe: 'digital'
      });
      renderKeranjangGabungan();
      produkTerpilihDigital = null;
      pilihSection.classList.add('d-none');
      alert('Produk berhasil ditambahkan.');
      $('#transaksiPulsaModal').modal('hide');
    }
  });

  // ---------- MODAL TRANSAKSI TOKO ----------
  let semuaProdukToko = [];
  let produkDipilihToko = null;

  // Ambil elemen modal toko
  const btnTransaksiToko = document.getElementById('btnTransaksiToko');
  const produkTableBody = document.getElementById('produkTableBody');
  const produkDipilihSectionToko = document.getElementById('produkDipilihSectionToko');
  const produkNamaToko = document.getElementById('produkTerpilihNamaToko');
  const produkHargaToko = document.getElementById('produkTerpilihHargaToko');
  const produkQtyToko = document.getElementById('produkTerpilihQtyToko');
  const btnTambahKeranjangToko = document.getElementById('btnTambahKeranjangToko');
  const modalProdukToko = document.getElementById('modalProdukToko');
  const totalPembayaran = document.getElementById('totalPembayaran');

  $('#modalProdukToko').on('show.bs.modal', function () {
    produkDipilihToko = null;
    if (produkDipilihSectionToko) produkDipilihSectionToko.classList.add('d-none');
    if (produkNamaToko) produkNamaToko.textContent = '';
    if (produkHargaToko) produkHargaToko.textContent = '';
    if (produkQtyToko) produkQtyToko.value = 1;
  });
  $('#modalProdukToko').on('hidden.bs.modal', function () {
    produkDipilihToko = null;
    if (produkDipilihSectionToko) produkDipilihSectionToko.classList.add('d-none');
    if (produkNamaToko) produkNamaToko.textContent = '';
    if (produkHargaToko) produkHargaToko.textContent = '';
    if (produkQtyToko) produkQtyToko.value = 1;
  });

  // Tombol buka modal produk toko
  btnTransaksiToko?.addEventListener('click', () => {
    fetch('/member-area/produk-toko/semua')
      .then(res => {
        if (!res.ok) throw new Error('Respon tidak OK: ' + res.status);
        return res.json();
      })
      .then(data => {
        semuaProdukToko = data;
        renderTabelProdukToko(semuaProdukToko);
        if (modalProdukToko) new bootstrap.Modal(modalProdukToko).show();
        produkDipilihToko = null;
        if (produkDipilihSectionToko) produkDipilihSectionToko.classList.add('d-none');
      })
      .catch(err => {
        console.error('Gagal memuat produk:', err);
        alert('Gagal memuat produk');
      });
  });

  // Render tabel produk toko
  function renderTabelProdukToko(data) {
    if (!produkTableBody) return;
    produkTableBody.innerHTML = '';
    data.forEach(p => {
      const tr = document.createElement('tr');
      tr.classList.add('produk-item-toko');
      tr.dataset.id = p.id;
      tr.dataset.nama = p.nama;
      tr.dataset.kode = p.kode;
      tr.dataset.harga = p.harga;
      tr.dataset.stok = p.stok;
      tr.innerHTML = `
        <td>${p.kode}</td>
        <td>${p.nama}</td>
        <td>${p.stok}</td>
      `;
      produkTableBody.appendChild(tr);
    });
  }

  // Handle klik produk toko
  document.addEventListener('click', function (e) {
    const row = e.target.closest('.produk-item-toko');
    if (!row || !modalProdukToko.classList.contains('show')) return;
    document.querySelectorAll('.produk-item-toko').forEach(el => el.classList.remove('table-primary'));
    row.classList.add('table-primary');
    const id = row.dataset.id;
    const nama = row.dataset.nama;
    const kode = row.dataset.kode;
    const harga = parseFloat(row.dataset.harga);
    const stok = parseInt(row.dataset.stok);
    produkDipilihToko = { id, nama, kode, harga, qty: 1, tipe: 'toko' };
    if (produkNamaToko) produkNamaToko.textContent = `${nama} [${kode}]`;
    if (produkHargaToko) produkHargaToko.textContent = 'Rp ' + harga.toLocaleString('id-ID');
    if (produkQtyToko) produkQtyToko.value = 1;
    if (produkDipilihSectionToko) produkDipilihSectionToko.classList.remove('d-none');
    if (stok === 0) {
      alert('⚠️ Stok kosong. Anda tetap bisa menambahkan, tapi pastikan stok tersedia secara fisik.');
    }
  });

  // Tambah produk toko ke keranjang utama
  btnTambahKeranjangToko?.addEventListener('click', () => {
    if (!produkDipilihToko) return alert('Pilih produk terlebih dahulu');
    const qty = parseInt(produkQtyToko.value);
    if (isNaN(qty) || qty < 1) return alert('Qty minimal 1');
    const sudahAda = keranjangGabungan.find(p => p.id === produkDipilihToko.id && p.tipe === 'toko');
    if (sudahAda) return alert('Produk sudah ada di daftar');
    keranjangGabungan.push({ ...produkDipilihToko, qty });
    renderKeranjangGabungan();
    if (produkDipilihSectionToko) produkDipilihSectionToko.classList.add('d-none');
  });

  // ---------- RENDER KERANJANG UTAMA ----------
  function renderKeranjangGabungan() {
    const tbody = document.getElementById('daftarProdukBody');
    if (!tbody) return;
    tbody.innerHTML = '';
    if (keranjangGabungan.length === 0) {
      tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Belum ada produk</td></tr>';
      if (totalPembayaran) totalPembayaran.value = 0;
      return;
    }
    keranjangGabungan.forEach((item, i) => {
      tbody.innerHTML += `
        <tr>
          <td class="text-center">${i + 1}</td>
          <td>${item.kode || item.id}</td>
          <td>${item.nama}</td>
          <td>
            <input type="number" min="1" class="form-control form-control-sm inputQtyGabungan" data-index="${i}" value="${item.qty}" ${item.tipe === 'digital' ? 'disabled' : ''}>
          </td>
          <td class="text-end">Rp ${(parseFloat(item.harga) * item.qty).toLocaleString('id-ID')}</td>
          <td class="text-center">
            <button class="btn btn-danger btn-sm btnHapusProdukGabungan" data-index="${i}">&times;</button>
          </td>
        </tr>
      `;
    });
    // Update total pembayaran
    const total = keranjangGabungan.reduce((sum, item) => sum + (parseFloat(item.harga) * item.qty), 0);
    if (totalPembayaran) totalPembayaran.value = total.toLocaleString('id-ID');
    // Event hapus produk dari keranjang gabungan
    document.querySelectorAll('.btnHapusProdukGabungan').forEach(btn => {
      btn.addEventListener('click', function () {
        const i = parseInt(btn.dataset.index);
        keranjangGabungan.splice(i, 1);
        renderKeranjangGabungan();
      });
    });
    // Event qty untuk produk toko
    document.querySelectorAll('.inputQtyGabungan').forEach(input => {
      input.addEventListener('input', function () {
        const i = parseInt(input.dataset.index);
        let qty = parseInt(input.value);
        if (isNaN(qty) || qty < 1) qty = 1;
        keranjangGabungan[i].qty = qty;
        renderKeranjangGabungan();
      });
    });
  }

  // ---------- FILTER PRODUK TOKO ----------
  window.filterProdukToko = function(keyword) {
    keyword = keyword.toLowerCase();
    const hasil = semuaProdukToko.filter(p =>
      p.nama.toLowerCase().includes(keyword) ||
      p.kode.toLowerCase().includes(keyword)
    );
    renderTabelProdukToko(hasil);
  };
});

</script>