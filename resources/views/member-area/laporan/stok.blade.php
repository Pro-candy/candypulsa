@extends('member-area.layout')

@section('content')
<div class="container">
    <div class="card card-info">
        <div class="card-header"><h5 class="mb-0">Mutasi Stok</h5></div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Stok Awal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockReports as $report)
                    <tr>
                        <td>{{ $report->tanggal }}</td>
                        <td>{{ $report->product->nama ?? '-' }}</td>
                        <td>{{ $report->stok_awal }}</td>
                        <td>{{ $report->stok_masuk }}</td>
                        <td>{{ $report->stok_keluar }}</td>
                        <td>{{ $report->stok_akhir }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data stok.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
