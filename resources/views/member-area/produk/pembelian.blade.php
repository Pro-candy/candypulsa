@extends('member-area.layout')

@section('title', 'Pembelian Produk')

@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Pembelian Produk</h3>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPembelian">
                    Tambah Pembelian
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('produk.pembelian.index') }}" id="filterForm" class="row g-3 mb-3">
                <div class="col-md-4">
                    <label>Supplier</label>
                    <select name="supplier_id" class="form-select" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Supplier</option>
                        @foreach ($suppliers as $sup)
                            <option value="{{ $sup->id }}" {{ request('supplier_id') == $sup->id ? 'selected' : '' }}>
                                {{ $sup->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>No. Invoice</label>
                    <input
                        type="text"
                        name="invoice"
                        value="{{ request('invoice') }}"
                        class="form-control"
                        placeholder="Cari No. Invoice"
                        id="invoiceSearch"
                    >
                </div>
            </form>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>Tanggal Pembelian</th>
                    <th>No. Invoice</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $groupKey => $items)
                        @php
                            $first = $items->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $first->supplier->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($first->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $first->invoice }}</td>
                            <td>
                               <button class="btn btn-sm btn-primary btn-detail-pembelian"
                                    data-invoice="{{ $first->invoice }}"
                                    data-supplier-id="{{ $first->supplier_id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Modal Tambah Pembelian -->
<div class="modal fade" id="modalTambahPembelian" tabindex="-1" aria-labelledby="modalTambahPembelianLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form method="POST" action="{{ route('produk.pembelian.store') }}" id="formPembelian">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahPembelianLabel">Tambah Pembelian Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label">Tanggal</label>
              <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Supplier</label>
              <select name="supplier_id" class="form-select" required>
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $s)
                  <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Nomor Invoice</label>
              <input type="text" name="invoice" class="form-control" placeholder="Opsional">
            </div>
          </div>

          <hr>

          <table class="table table-bordered align-middle" id="tabelPembelianProduk">
            <thead class="table-light">
              <tr>
                <th style="width: 40px">No</th>
                <th>Produk</th>
                <th style="width: 120px">Qty</th>
                <th style="width: 160px">Harga Satuan</th>
                <th style="width: 50px"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>
                  <select name="items[0][product_id]" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $p)
                      <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                  </select>
                </td>
                <td><input type="number" name="items[0][jumlah]" class="form-control" min="1" required></td>
                <td><input type="text" name="items[0][harga_beli]" class="form-control harga-input" required></td>
                <td class="text-center">
                  <button type="button" class="btn btn-danger btn-sm btn-remove-row">&times;</button>
                </td>
              </tr>
            </tbody>
          </table>

          <button type="button" class="btn btn-sm btn-secondary" id="btnTambahBarisPembelian">+ Tambah Baris</button>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Detail Pembelian -->
<div class="modal fade" id="modalDetailPembelian" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Pembelian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body" id="detailPembelianContent">
        <div class="text-center py-4 text-muted">Memuat data...</div>
      </div>
    </div>
  </div>
</div>




@endsection

@push('scripts')
<script>
let rowIndex = 1;
document.getElementById('btnTambahBarisPembelian').addEventListener('click', function () {
    const tbody = document.querySelector('#tabelPembelianProduk tbody');
    const row = document.createElement('tr');

    row.innerHTML = `
        <td class="text-center">${rowIndex + 1}</td>
        <td>
          <select name="items[${rowIndex}][product_id]" class="form-select" required>
            <option value="">-- Pilih Produk --</option>
            @foreach($products as $p)
              <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
          </select>
        </td>
        <td><input type="number" name="items[${rowIndex}][jumlah]" class="form-control" min="1" required></td>
        <td><input type="text" name="items[${rowIndex}][harga_beli]" class="form-control harga-input" required></td>
        <td class="text-center">
          <button type="button" class="btn btn-danger btn-sm btn-remove-row">&times;</button>
        </td>
    `;

    tbody.appendChild(row);
    rowIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-remove-row')) {
        const row = e.target.closest('tr');
        row.remove();
    }
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-detail-pembelian')) {
        const invoice = e.target.dataset.invoice;
        const supplierId = e.target.dataset.supplierId;

        const modal = new bootstrap.Modal(document.getElementById('modalDetailPembelian'));
        document.getElementById('detailPembelianContent').innerHTML = '<div class="text-center py-4 text-muted">Memuat data...</div>';
        modal.show();

        fetch(`/member-area/produk/pembelian/detail/${supplierId}/${invoice}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('detailPembelianContent').innerHTML = html;
            })
            .catch(() => {
                document.getElementById('detailPembelianContent').innerHTML = '<div class="text-danger">Gagal memuat detail.</div>';
            });
    }
});


let invoiceTimeout;
document.getElementById('invoiceSearch').addEventListener('input', function () {
    clearTimeout(invoiceTimeout);
    invoiceTimeout = setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 400);
});
</script>


@endpush
