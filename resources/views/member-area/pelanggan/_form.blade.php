<form id="formTambahPelanggan" method="POST" action="{{ route('reseller.pelanggan.store') }}">
    @csrf
    <div class="mb-2">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-2">
        <label class="form-label">No HP</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="mb-2">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-2">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control">
    </div>
    <div class="mb-2">
        <label class="form-label">Info Tambahan</label>
        <textarea name="info_tambahan" class="form-control"></textarea>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
