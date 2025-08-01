@extends('member-area.layout')

@section('title', 'Pesan Masuk')

@section('content')
<div class="container py-4">
    <div class="card card-success">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Pesan Masuk</h3>
                <form id="formSearchOutbox" class="d-flex" method="get" action="{{ route('inbox-reseller.index') }}" autocomplete="off">
                    <input type="text" id="searchOutbox" name="q" class="form-control me-2" placeholder="Cari pesan/keterangan..." value="{{ request('q') }}">
                </form>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Pesan</th>
                            <th>Status Baca</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($outbox as $msg)
                        <tr>
                            <td>
                                <a href="javascript:void(0)" class="lihat-pesan fw-bold" data-id="{{ $msg->id }}">
                                {{ $msg->keterangan }}
                            </a>
                            </td>
                            <td>
                                @if($msg->read == 'no')
                                    <span class="badge bg-danger">Belum dibaca</span>
                                @else
                                    <span class="badge bg-success">Sudah dibaca</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($msg->created_at)->format('d-m-Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Tidak ada pesan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
        <div class="card-footer clearfix">  <!-- buatkan pagenation otomatis-->
            {{ $outbox->appends(['q' => request('q')])->links('pagination::bootstrap-5') }}
        </div>
    </div>  
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let timerSearchOutbox = null;
    const searchBox = document.getElementById('searchOutbox');
    const tableWrapper = document.getElementById('outboxTableWrapper');

    function bindLihatPesan() {
        document.querySelectorAll('.lihat-pesan').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch('/member-area/inbox-reseller/' + id)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('outboxDetailModalBody').innerHTML = html;
                        let myModal = new bootstrap.Modal(document.getElementById('outboxDetailModal'));
                        myModal.show();
                    });
            });
        });
    }

    bindLihatPesan();

    if (!searchBox) return;

    searchBox.addEventListener('input', function() {
        clearTimeout(timerSearchOutbox);
        const q = this.value.trim();
        if (q.length > 0 && q.length < 3) return; // min 3 karakter untuk search

        timerSearchOutbox = setTimeout(function() {
            let url = "{{ route('inbox-reseller.index') }}";
            let params = new URLSearchParams();
            if (q.length >= 3) params.append('q', q);
            fetch(url + '?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                // Replace hanya isi table wrapper
                tableWrapper.innerHTML = html;
                bindLihatPesan(); // re-bind event untuk tombol baru
            });
        }, 400); // debounce 400ms
    });

    // AJAX pagination (opsional, jika ingin pagination tetap AJAX)
    tableWrapper.addEventListener('click', function(e) {
        if (e.target.tagName === 'A' && e.target.classList.contains('page-link')) {
            e.preventDefault();
            fetch(e.target.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                tableWrapper.innerHTML = html;
                bindLihatPesan();
            });
        }
    });

});
</script>
@endpush