<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ $pesan->keterangan }}</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">{{ $pesan->pesan }}</div>
            <small class="text-muted">Dikirim: {{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</small>
            <br><br>
        </div>
    </div>
</div>
