<div>
    <h5 class="mb-2">{{ $pesan->keterangan }}</h5>
    <p>{{ $pesan->pesan }}</p>
    <small class="text-muted">Dikirim: {{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</small>
</div>