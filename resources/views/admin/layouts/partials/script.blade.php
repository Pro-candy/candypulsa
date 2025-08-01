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

<!-- switch-->
<script>
$(document).ready(function () {
    $('.form-check-input').on('change', function () {
        let nama = '';
        let pesanKonfirmasi = '';
        let isChecked = $(this).is(':checked');
        let value = isChecked ? 1 : 0;

        if (this.id === 'switchInboxProsesor') {
            nama = 'inbox_proses';
            pesanKonfirmasi = isChecked
                ? 'Data inbox siap diproses. Apakah Anda yakin?'
                : 'Data inbox akan dinonaktifkan. Semua inbox tidak akan diproses sampai Anda aktifkan lagi. Apakah yakin?';
        }

        if (this.id === 'switchTrxProsesor') {
            nama = 'trx_prosessor';
            pesanKonfirmasi = isChecked
                ? 'Transaksi siap diproses. Apa Anda yakin?'
                : 'Transaksi tidak akan diproses. Semua transaksi akan dihentikan sampai Anda aktifkan lagi. Apakah yakin?';
        }

        if (this.id === 'switchModulIp') {
            nama = 'trx_ip';
            pesanKonfirmasi = isChecked
                ? 'Anda akan membuka transaksi via IP. Apa Anda yakin?'
                : 'Anda akan menonaktifkan transaksi via IP. Semua transaksi akan ditolak sampai Anda aktifkan lagi. Apakah yakin?';
        }

        // Tampilkan konfirmasi
        if (!confirm(pesanKonfirmasi)) {
            // Jika dibatalkan, kembalikan switch ke kondisi semula
            $(this).prop('checked', !isChecked);
            return;
        }

        // Kirim perubahan via AJAX
        $.ajax({
            url: '{{ route("admin.parameter.update") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nama: nama,
                value: value
            },
            success: function (response) {
                alert(response.message || 'Perubahan berhasil disimpan.');
            },
            error: function () {
                alert('Gagal menyimpan perubahan');
            }
        });
    });
});
</script>


