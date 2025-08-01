<div class="modal-header">
    <h5 class="modal-title">Riwayat Stok: {{ $product->nama }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
    <div class="row mb-3">
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Harga Beli Min: <strong>{{ number_format($product->harga_beli_min ?? 0, 0, ',', '.') }}</strong></li>
                <li class="list-group-item">Harga Beli Max: <strong>{{ number_format($product->harga_beli_max ?? 0, 0, ',', '.') }}</strong></li>
                <li class="list-group-item">Harga Beli Rata-rata: <strong>{{ number_format($product->harga_beli_avg ?? 0, 0, ',', '.') }}</strong></li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Harga Jual Min: <strong>{{ number_format($product->harga_jual_min ?? 0, 0, ',', '.') }}</strong></li>
                <li class="list-group-item">Harga Jual Max: <strong>{{ number_format($product->harga_jual_max ?? 0, 0, ',', '.') }}</strong></li>
                <li class="list-group-item">Harga Jual Rata-rata: <strong>{{ number_format($product->harga_jual_avg ?? 0, 0, ',', '.') }}</strong></li>
            </ul>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Stok Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $i => $log)
                @if ($log->stok_masuk > 0 || ($log->stok_keluar == 0 && $log->stok_masuk == 0))
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            @if ($log->stok_masuk > 0)
                                Pembelian - 
                                {{ optional($log->product->purchases()->where('tanggal', $log->tanggal)->first())->supplier->nama ?? '-' }}
                            @else
                                Penyesuaian
                            @endif
                        </td>
                        <td>
                            {{ $log->stok_masuk ?: '-' }}
                        </td>
                        <td>{{ $log->stok_akhir }}</td>
                    </tr>
                @endif
            @empty
                <tr>
            @endforelse
        </tbody>
    </table>
</div>
