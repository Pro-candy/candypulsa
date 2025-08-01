
<div class="container py-4">
    <h2 class="mb-3">{{ $pesan->keterangan }}</h2>
    <div class="mb-3">
        <strong>Pesan:</strong>
        <div>{{ $pesan->pesan }}</div>
    </div>
    <div class="text-muted">
        <small>Dikirim: {{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</small>
    </div>
    <a href="{{ route('inbox-reseller.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Pesan</a>
</div>