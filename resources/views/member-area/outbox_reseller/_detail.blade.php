<div>
    <h5 class="mb-2">{{ $pesan->keterangan }}</h5>
    <div class="mb-2">{{ $pesan->pesan }}</div>
    <small class="text-muted">Dikirim: {{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</small>
</div>