@extends('member-area.layout')

@section('title', 'Kategori Produk')

@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Kategori Produk</h3>
                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                    Tambah Kategori
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories ?? [] as $i => $category)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $category->nama }}</td>
                            <td>{{ $category->deskripsi ?? '-' }}</td>
                            <td>
                                <a href="{{ url('/member-area/produk?kategori='.$category->id) }}">
                                    {{ $category->jumlah_produk_pulsa + $category->jumlah_produk_reseller }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('member-area.produk.kategori.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori Produk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi (opsional)</label>
                <textarea class="form-control" name="deskripsi" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
  </div>
</div>
@endsection
