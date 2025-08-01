@extends('member-area.layout')

@section('title', 'Outbox Reseller')

@section('content')
<div class="container py-4">
    <div class="card card-danger">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Pesan terkirim</h3>
                <form class="d-flex mb-2" method="get" action="{{ route('outbox-reseller.index') }}">
                    <input type="text" name="q" class="form-control me-2" placeholder="Cari pesan..." value="{{ request('q') }}">
                    <button class="btn btn-light" type="submit">Cari</button>
                </form>
            </div>
        </div>  
        <div class="card-body">
            <div id="outboxTableWrapper">
                @include('member-area.outbox_reseller._table_inner', ['outbox' => $outbox])
            </div>   
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
    function bindLihatOutbox() {
        document.querySelectorAll('.lihat-outbox').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                fetch('/member-area/outbox-reseller/' + id)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('outboxDetailModalBody').innerHTML = html;
                        var modalEl = document.getElementById('outboxDetailModal');
                        var modalInstance = bootstrap.Modal.getInstance(modalEl);
                        if (!modalInstance) {
                            modalInstance = new bootstrap.Modal(modalEl);
                        }
                        modalInstance.show();
                    });
            });
        });
    }
    bindLihatOutbox();
});
</script>
@endpush