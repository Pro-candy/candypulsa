@extends('member-area.layout')

@section('title', 'Candy Pulsa | Pengumuman')

@section('content')
<div class="container py-4">
    <div class="card card-warning">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Pengumuman</h3>
                <form id="formSearchPengumuman" class="d-flex" method="get" action="{{ route('pengumuman.index') }}" autocomplete="off">
                    <input type="text" id="searchPengumuman" name="q" class="form-control me-2" placeholder="Cari judul/isi..." value="{{ request('q') }}">
                </form>
            </div>
        </div>
    <div class="card-body">
        <div id="pengumumanTableWrapper">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumuman as $row)
                    <tr>
                        <td>
                            <a href="javascript:void(0)" class="lihat-pengumuman fw-bold" data-id="{{ $row->id }}">
                                {{ $row->judul }}
                            </a>
                            @if(isset($readIds) && !in_array($row->id, $readIds))
                                <span class="badge bg-warning text-dark ms-2">Baru</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($row->tipe) }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                        
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Tidak ada pengumuman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix"> 
            {{ $pengumuman->appends(['q' => request('q')])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let timerSearch = null;
    const searchBox = document.getElementById('searchPengumuman');
    const tableWrapper = document.getElementById('pengumumanTableWrapper');

    function bindLihatPengumuman() {
        document.querySelectorAll('.lihat-pengumuman').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch('/member-area/pengumuman/' + id)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('pengumumanDetailModalBody').innerHTML = html;
                        let myModal = new bootstrap.Modal(document.getElementById('pengumumanDetailModal'));
                        myModal.show();
                    });
            });
        });
    }

    bindLihatPengumuman();

    if (searchBox) {
        searchBox.addEventListener('input', function() {
            clearTimeout(timerSearch);
            const q = this.value.trim();
            if (q.length > 0 && q.length < 3) return; // minimal 3 karakter

            timerSearch = setTimeout(function() {
                let url = "{{ route('pengumuman.index') }}";
                let params = new URLSearchParams();
                if (q.length >= 3) params.append('q', q);
                fetch(url + '?' + params.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    tableWrapper.innerHTML = html;
                    bindLihatPengumuman();
                });
            }, 400);
        });
    }

    tableWrapper.addEventListener('click', function(e) {
        if (e.target.tagName === 'A' && e.target.classList.contains('page-link')) {
            e.preventDefault();
            fetch(e.target.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                tableWrapper.innerHTML = html;
                bindLihatPengumuman();
            });
        }
    });
});
</script>
@endpush