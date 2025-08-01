@extends('member-area.layout')

@section('title', 'Daftar Supplier')

@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Supplier</h3>
                <div class="card-tools">
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahSupplier">
                        Tambah Supplier
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Jumlah Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers ?? [] as $i => $supplier)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $supplier->nama }}</td>
                            <td>{{ $supplier->telepon ?? '-' }}</td>
                            <td>{{ $supplier->alamat ?? '-' }}</td>
                            <td>
                                <a href="{{ url('/member-area/produk/pembelian?supplier_id=' . $supplier->id) }}">
                                    {{ $supplier->purchases_count }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada supplier.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-labelledby="modalTambahSupplierLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('produk.supplier.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahSupplierLabel">Tambah Supplier</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" name="telepon">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="2"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>
@endsection
