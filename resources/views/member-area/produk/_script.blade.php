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

function openEditProduct(type, kode, nama, stok, harga_jual, deskripsi, idProduk = '', harga_beli = '', category_id = '', barcode = '') {
    const form = document.getElementById('formProdukEdit');
    form.reset();

    // Reset semua input/select/textarea kecuali hidden
    form.querySelectorAll('input, select, textarea').forEach(el => {
        if (el.type !== 'hidden') el.value = '';
        el.readOnly = false;
        el.disabled = false;
    });

    // Isi data umum
    document.getElementById('produkIdEdit').value = idProduk;
    document.getElementById('produkKodeEdit').value = kode;
    document.getElementById('produkNamaEdit').value = nama;
    document.getElementById('produkDeskripsiEdit').value = deskripsi;
    document.getElementById('produkBarcodeEdit').value = barcode;

    const kategoriSelect = document.getElementById('produkKategoriEdit');
    const hargaBeliInput = document.getElementById('produkHargaBeliEdit');
    const hargaJualInput = document.getElementById('produkHargaJualEdit');
    const barcodeInput = document.getElementById('produkBarcodeEdit');
    const deskripsiInput = document.getElementById('produkDeskripsiEdit');
    const kodeInput = document.getElementById('produkKodeEdit');

    if (type === 'pulsa') {
        form.action = "{{ url('/member-area/produk/update-harga-pulsa') }}";

        // Field readonly atau disabled untuk pulsa
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
        kodeInput.readOnly = true; // Tetap readonly meski produk biasa (jika kode dibuat otomatis oleh sistem)

        hargaBeliInput.value = formatHarga(harga_beli);
        hargaBeliInput.readOnly = false;

        hargaJualInput.value = harga_jual ? parseFloat(harga_jual) : 0;
        hargaJualInput.readOnly = false;

        kategoriSelect.disabled = false;
        kategoriSelect.value = category_id;

        // Sembunyikan opsi Pulsa agar tidak dipilih manual
        const pulsaOption = kategoriSelect.querySelector('option[value="1"]');
        if (pulsaOption) pulsaOption.style.display = 'none';

        document.getElementById('editProdukModalLabel').innerText = "Edit Produk";
    }

    // Tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById('editProdukModal'));
    document.querySelectorAll('.modal.show').forEach(m => bootstrap.Modal.getInstance(m)?.hide());
    modal.show();
}

function openAddProduct() {
    const form = document.getElementById('formProdukEdit');
    form.reset();

    // Kosongkan dan aktifkan semua field kecuali hidden
    form.querySelectorAll('input, select, textarea').forEach(el => {
        if (el.type !== 'hidden') {
            el.value = '';
            el.readOnly = false;
            el.disabled = false;
        }
    });

    form.action = "{{ route('produk.store') }}";

    document.getElementById('produkIdEdit').value = '';
    document.getElementById('produkKodeEdit').readOnly = true; // tetap readonly, karena sistem yang generate

    const kategoriSelect = document.getElementById('produkKategoriEdit');
    kategoriSelect.disabled = false;
    kategoriSelect.value = '';

    // Sembunyikan kategori Pulsa
    const pulsaOption = kategoriSelect.querySelector('option[value="1"]');
    if (pulsaOption) pulsaOption.style.display = 'none';

    document.getElementById('editProdukModalLabel').innerText = "Tambah Produk";

    const modal = new bootstrap.Modal(document.getElementById('editProdukModal'));
    document.querySelectorAll('.modal.show').forEach(m => bootstrap.Modal.getInstance(m)?.hide());
    modal.show();
}

// Validasi harga jual
document.addEventListener('DOMContentLoaded', function () {
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
    });
});

// Pencarian produk
document.addEventListener('DOMContentLoaded', function () {
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
</script>
