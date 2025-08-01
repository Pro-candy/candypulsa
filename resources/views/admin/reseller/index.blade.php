@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <div class="card card-primary">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Reseller</h3>
                <form class="d-flex mb-2" method="get" action="{{ route('admin.reseller.index') }}">
                    <input type="text" name="q" class="form-control me-2" placeholder="Cari Reseller" value="{{ request('q') }}">
                    <button class="btn btn-light" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div id="ResellerTableWrapper">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resellers as $index => $reseller)
                        <tr>
                            <td>{{ $loop->iteration + (($resellers->currentPage() - 1) * $resellers->perPage()) }}</td>
                            <td>{{ $reseller->kode }}</td>
                            <td>{{ $reseller->nama }}</td>
                            <td>
                                <a href="{{ route('admin.reseller.edit', $reseller->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-info btn-pengirim" data-kode="{{ $reseller->kode }}">
                                    Pengirim
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer clearfix">
            {{ $resellers->appends(['q' => request('q')])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
@push('scripts')
  @include('admin.reseller.script')
@endpush