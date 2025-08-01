<form id="formCekNomor">
    @csrf
    <div class="mb-3">
        <label for="nomorHpPulsa" class="form-label">Masukkan Nomor HP</label>
        <input type="text" id="nomorHpPulsa" name="nomor" class="form-control" placeholder="08xxxxxx" required>
        <div class="form-text text-danger" id="statusPrefixPulsa"></div>
    </div>

    <div class="row" id="produkPromoPulsa"></div>
    <div class="row" id="produkRegulerPulsa"></div>

    <div class="mt-3">
        <div id="infoProdukTerpilih" class="mb-2 text-primary fw-bold"></div>
        <button type="submit" id="btnLanjutkanTransaksi" class="btn btn-success w-100" disabled>Lanjutkan Transaksi</button>
    </div>
</form>
