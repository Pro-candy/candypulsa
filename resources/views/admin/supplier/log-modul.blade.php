@extends('admin.layouts.app')

@section('content')
<div class="card card-success card-outline mb-4">

    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="card-title mb-0">Log Modul: {{ $supplier->nama }}</h4>
            <form method="GET" action="{{ request()->url() }}" class="d-flex align-items-center mt-2 mt-md-0">
                <label for="per_page" class="me-2 mb-0">Tampilkan</label>
                <select name="per_page" id="per_page" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                    @foreach ([10, 25, 50, 100, 'all'] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 25) == $size ? 'selected' : '' }}>
                            {{ $size === 'all' ? 'Semua' : $size }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>


    <div class="card-body p-0">
        <div class="table">
            <table class="table table-bordered table-striped m-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 180px;">Waktu</th>
                        <th style="width: 180px;">Sumber</th>
                        <th style="width: auto;">Pesan</th>
                        <th style="width: 100px;">Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->waktu }}</td>
                            <td>{{ $log->sumber }}</td>                            
                            <td>
                                <pre style="white-space: pre-wrap; word-break: break-word; margin: 0;">{{ $log->pesan }}</pre>
                            </td>
                            <td>
                                <span class="badge bg-{{ $log->tipe === 'inbox' ? 'success' : ($log->tipe === 'outbox' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst($log->tipe) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Tidak ada log tercatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-between align-items-center flex-wrap">
        <div class="order-2 order-md-1 mt-2 mt-md-0">
            @if ($logs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                Menampilkan {{ $logs->firstItem() }} - {{ $logs->lastItem() }} dari {{ $logs->total() }} data
            @else
                Menampilkan 1 - {{ $logs->count() }} dari {{ $logs->count() }} data
            @endif
        </div>
        <div class="order-1 order-md-2">
            @if ($logs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $logs->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>

</div>
@endsection
