<h6>Invoice: <strong>{{ $invoice }}</strong></h6>
<h6>Supplier: <strong>{{ $supplier->nama }}</strong></h6>

<table class="table table-sm table-bordered mt-3">
    <thead class="table-light">
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total</th>
            <th>Stok Awal</th>
            <th>Stok Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $p)
        @php
            $report = $stockReports[$p->id] ?? null;
        @endphp
        <tr>
            <td>{{ $p->product->nama }}</td>
            <td>{{ $p->jumlah }}</td>
            <td>{{ number_format($p->harga_beli, 0, ',', '.') }}</td>
            <td>{{ number_format($p->jumlah * $p->harga_beli, 0, ',', '.') }}</td>
            <td>{{ $report ? $report->stok_awal : '-' }}</td>
            <td>{{ $report ? $report->stok_akhir : '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
