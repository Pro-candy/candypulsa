
{{-- Modal Tambah/Edit Produk --}}
<div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formProdukEdit" method="POST">
      @csrf
      <input type="hidden" name="id" id="produkIdEdit">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3" id="fieldKategoriEdit">
                <label for="produkKategoriEdit" class="form-label">Kategori</label>
                <select id="produkKategoriEdit" name="category_id" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="produkKodeEdit" class="form-label">Kode Produk</label>
                <input type="text" class="form-control" id="produkKodeEdit" name="kode" readonly>
            </div>
            <div class="mb-3">
                <label for="produkNamaEdit" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="produkNamaEdit" name="nama" required>
            </div>
            <div class="mb-3" id="fieldHargaBeliEdit">
                <label for="produkHargaBeliEdit" class="form-label">Harga Beli</label>
                <input type="text" class="form-control" id="produkHargaBeliEdit" name="harga_beli" min="0" required>
            </div>
            <div class="mb-3">
                <label for="produkHargaJualEdit" class="form-label">Harga Jual</label>
                <input type="number" step="any" class="form-control" id="produkHargaJualEdit" name="harga_jual"  min="0" required>
            </div>
            <div class="mb-3" id="fieldDeskripsiEdit">
                <label for="produkDeskripsiEdit" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="produkDeskripsiEdit" name="deskripsi" rows="2"></textarea>
            </div>
            <div class="mb-3" id="fieldBarcodeEdit">
              <label for="produkBarcodeEdit" class="form-label">Barcode</label>
              <input type="text" class="form-control" id="produkBarcodeEdit" name="barcode">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>