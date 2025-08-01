@extends('member-area.layout')

@section('title', 'Candy Pulsa | Daftar Produk')

@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Produk</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-light btn-sm" onclick="openAddProduct()">Tambah Produk</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="get" class="mb-3 row g-2 align-items-center" onsubmit="return false;">
                <div class="col-auto">
                    <label for="kategori" class="me-2">Kategori:</label>
                    <select name="kategori" id="kategori" class="form-select d-inline-block w-auto">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $selected_category == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="q" id="inputSearchProduk" value="{{ request('q') }}" class="form-control" placeholder="Cari nama produk...">
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th class="d-none d-sm-table-cell">Stok</th>
                        <th class="d-none d-sm-table-cell">Harga Beli</th>
                        <th class="d-none d-sm-table-cell">Harga Jual</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbodyProduk">
                    @include('member-area.produk._table_rows', ['products' => $products])
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix" id="produkPagination">
            {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@include('member-area.produk._modal_edit')

<div class="modal fade" id="modalRiwayatStok" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modalRiwayatStokContent">
      <div class="modal-body text-center p-5">
        <div class="spinner-border text-primary"></div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
function formatHarga(nilai) {
    if (!nilai) return '0,00';
    return parseFloat(nilai).toLocaleString('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function unformatHarga(nilai) {
    return parseFloat(nilai.replace(/\./g, '').replace(',', '.'));
}

function bindEditButtons() {
    document.querySelectorAll('.btn-edit-produk').forEach(function (btn) {
        btn.removeEventListener('click', btn._listener || (() => {}));
        btn._listener = function () {
            openEditProduct(
                btn.dataset.type,
                btn.dataset.kode,
                btn.dataset.nama,
                btn.dataset.stok,
                btn.dataset.hargaJual,
                btn.dataset.deskripsi,
                btn.dataset.id,
                btn.dataset.hargaBeli,
                btn.dataset.categoryId,
                btn.dataset.barcode || ''
            );
        };
        btn.addEventListener('click', btn._listener);
    });
}

function openEditProduct(type, kode, nama, stok, harga_jual, deskripsi, idProduk = '', harga_beli = '', category_id = '', barcode = '') {
    const form = document.getElementById('formProdukEdit');
    form.reset();

    form.querySelectorAll('input, select, textarea').forEach(el => {
        if (el.type !== 'hidden') el.value = '';
        el.readOnly = false;
        el.disabled = false;
    });

    document.getElementById('produkKodeEdit').value = kode;
    document.getElementById('produkIdEdit').value = idProduk;
    document.getElementById('produkNamaEdit').value = nama;
    document.getElementById('produkDeskripsiEdit').value = deskripsi;
    document.getElementById('produkBarcodeEdit').value = barcode || '';

    const kategoriSelect = document.getElementById('produkKategoriEdit');
    const hargaBeliInput = document.getElementById('produkHargaBeliEdit');
    const hargaJualInput = document.getElementById('produkHargaJualEdit');
    const kodeInput = document.getElementById('produkKodeEdit');
    const barcodeInput = document.getElementById('produkBarcodeEdit');
    const deskripsiInput = document.getElementById('produkDeskripsiEdit');

    if (type === 'pulsa') {
        form.action = "{{ url('/member-area/produk/update-harga-pulsa') }}";
        document.getElementById('produkNamaEdit').readOnly = true;
        deskripsiInput.disabled = true;
        barcodeInput.disabled = true;
        kodeInput.readOnly = true;
        hargaBeliInput.value = formatHarga(harga_beli);
        hargaBeliInput.readOnly = true;
        hargaJualInput.value = harga_jual ? parseFloat(harga_jual) : 0;
        hargaJualInput.readOnly = false;
        kategoriSelect.innerHTML = '<option value="1" selected>Pulsa</option>';
        kategoriSelect.disabled = true;
        document.getElementById('editProdukModalLabel').innerText = "Edit Harga Jual Pulsa";
    } else {
        form.action = "{{ url('/member-area/produk/update-produk') }}";
        document.getElementById('produkNamaEdit').readOnly = false;
        deskripsiInput.disabled = false;
        barcodeInput.disabled = false;
        kodeInput.readOnly = false;
        hargaBeliInput.value = formatHarga(harga_beli);
        hargaBeliInput.readOnly = false;
        hargaJualInput.value = harga_jual ? parseFloat(harga_jual) : 0;
        hargaJualInput.readOnly = false;
        kategoriSelect.disabled = false;
        kategoriSelect.value = category_id;
        const pulsaOption = kategoriSelect.querySelector('option[value="1"]');
        if (pulsaOption) pulsaOption.style.display = 'none';
        document.getElementById('editProdukModalLabel').innerText = "Edit Produk";
    }

    const modal = new bootstrap.Modal(document.getElementById('editProdukModal'));
    document.querySelectorAll('.modal.show').forEach(m => bootstrap.Modal.getInstance(m)?.hide());
    modal.show();
}

function openAddProduct() {
    const form = document.getElementById('formProdukEdit');
    form.reset();
    form.querySelectorAll('input, select, textarea').forEach(el => {
        if (el.type !== 'hidden') el.value = '';
        el.readOnly = false;
        el.disabled = false;
    });
    form.action = "{{ route('produk.store') }}";
    document.getElementById('produkIdEdit').value = '';
    document.getElementById('produkKodeEdit').value = '';
    const kategoriSelect = document.getElementById('produkKategoriEdit');
    kategoriSelect.disabled = false;
    kategoriSelect.value = '';
    const pulsaOption = kategoriSelect.querySelector('option[value="1"]');
    if (pulsaOption) pulsaOption.style.display = 'none';
    document.getElementById('editProdukModalLabel').innerText = "Tambah Produk";
    const modal = new bootstrap.Modal(document.getElementById('editProdukModal'));
    document.querySelectorAll('.modal.show').forEach(m => bootstrap.Modal.getInstance(m)?.hide());
    modal.show();
}

document.addEventListener('DOMContentLoaded', function () {
    bindEditButtons();

    const form = document.getElementById('formProdukEdit');
    form.addEventListener('submit', function (e) {
        const hargaBeli = unformatHarga(document.getElementById('produkHargaBeliEdit').value);
        const hargaJual = unformatHarga(document.getElementById('produkHargaJualEdit').value);

        if (isNaN(hargaBeli) || isNaN(hargaJual)) {
            e.preventDefault();
            alert('Harga tidak valid.');
            return;
        }

        if (hargaJual < hargaBeli) {
            e.preventDefault();
            alert('Harga jual tidak boleh lebih kecil dari harga beli.');
            return;
        }

        document.getElementById('produkHargaBeliEdit').value = hargaBeli;
        document.getElementById('produkHargaJualEdit').value = hargaJual;

        const tokenInput = form.querySelector('input[name="_token"]');
        if (!tokenInput) {
            const newToken = document.createElement('input');
            newToken.type = 'hidden';
            newToken.name = '_token';
            newToken.value = '{{ csrf_token() }}';
            form.appendChild(newToken);
        } else {
            tokenInput.value = '{{ csrf_token() }}';
        }
    });

    const inputSearch = document.getElementById('inputSearchProduk');
    const kategoriSelect = document.getElementById('kategori');
    const tbodyProduk = document.getElementById('tbodyProduk');
    const paginationWrapper = document.getElementById('produkPagination');
    if (!inputSearch || !kategoriSelect || !tbodyProduk || !paginationWrapper) return;

    let timerProdukSearch = null;

    function triggerSearchProduk(page = 1) {
        clearTimeout(timerProdukSearch);
        let q = inputSearch.value;
        let kategori = kategoriSelect.value;
        if (q.length > 0 && q.length < 3) {
            tbodyProduk.innerHTML = '<tr><td colspan="7" class="text-center text-muted">Ketik minimal 3 huruf...</td></tr>';
            paginationWrapper.innerHTML = '';
            return;
        }
        timerProdukSearch = setTimeout(function () {
            let params = new URLSearchParams();
            if (q) params.append('q', q);
            if (kategori) params.append('kategori', kategori);
            if (page > 1) params.append('page', page);
            fetch(`{{ route('produk.ajax-search') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.json())
                .then(data => {
                    tbodyProduk.innerHTML = data.html;
                    paginationWrapper.innerHTML = data.pagination;
                    bindEditButtons();
                });
        }, 350);
    }

    inputSearch.addEventListener('input', () => triggerSearchProduk(1));
    kategoriSelect.addEventListener('change', () => triggerSearchProduk(1));

    paginationWrapper.addEventListener('click', function (e) {
        if (e.target.tagName === 'A' && e.target.classList.contains('page-link')) {
            e.preventDefault();
            const url = new URL(e.target.href);
            const page = url.searchParams.get('page') || 1;
            triggerSearchProduk(page);
        }
    });
});


function showRiwayatStok(productId) {
    const modal = new bootstrap.Modal(document.getElementById('modalRiwayatStok'));
    const content = document.getElementById('modalRiwayatStokContent');

    content.innerHTML = '<div class="modal-body text-center p-5"><div class="spinner-border text-primary"></div></div>';

    fetch(`/member-area/produk/stok/${productId}`)
        .then(response => response.json())
        .then(data => {
            content.innerHTML = data.html;
            modal.show();
        })
        .catch(err => {
            content.innerHTML = '<div class="modal-body text-danger p-5 text-center">Gagal memuat data.</div>';
        });
}


</script>
@endpush
