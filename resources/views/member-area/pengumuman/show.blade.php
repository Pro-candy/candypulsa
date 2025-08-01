<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ $item->judul }}</h4>
            <small class="text-muted">
                Tipe: <span class="badge bg-info">{{ ucfirst($item->tipe) }}</span>
                &nbsp;|&nbsp;
                {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}
            </small>
        </div>
        <div class="card-body">
            <div class="mb-3">
                {!! nl2br(e($item->isi)) !!}
            </div>
            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary btn-sm">&laquo; Kembali ke daftar pengumuman</a>
        </div>
    </div>
</div>