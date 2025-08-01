@extends('member-area.layout')

@section('title', 'Candy Pulsa | Pelanggan')

@section('content')
<div class="container py-4">
    <div class="card card-warning">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Pelanggan</h3>
                <form id="formSearchPelanggan" class="d-flex" method="get" action="{{ route('reseller.pelanggan') }}" autocomplete="off">
                    <input type="text" id="searchPelanggan" name="q" class="form-control me-2" placeholder="Cari nama/no. HP..." value="{{ request('q') }}">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div id="pelangganTableWrapper">
                <table class="table table-bordered">
                    <thead class="table-dark text-center">
                        <tr>
                            <th style="width: 50px">No</th>
                            <th>Nomor Member</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="d-none d-sm-table-cell">Alamat</th>
                            <th class="d-none d-sm-table-cell">Info Tambahan</th>
                            <th style="width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $index => $p)
                            <tr>
                                <td class="text-center">{{ $index + $pelanggan->firstItem() }}</td>
                                <td>{{ $p->kode_pelanggan }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->phone }}</td>
                                <td class="d-none d-sm-table-cell">{{ $p->email }}</td>
                                <td class="d-none d-sm-table-cell">{{ $p->alamat }}</td>
                                <td class="d-none d-sm-table-cell">{{ $p->info_tambahan }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Tidak ada data pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $pelanggan->appends(['q' => request('q')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Tambahkan script jika perlu
</script>
@endpush
