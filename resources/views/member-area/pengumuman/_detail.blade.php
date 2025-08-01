<div>
    <h5 class="mb-2">{{ $item->judul }}</h5>
    <div class="mb-2">{!! nl2br(e($item->isi)) !!}</div>
    <small class="text-muted">
        Tipe: <span class="badge bg-info">{{ ucfirst($item->tipe) }}</span>
        &nbsp;|&nbsp;
        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}
    </small>
</div>