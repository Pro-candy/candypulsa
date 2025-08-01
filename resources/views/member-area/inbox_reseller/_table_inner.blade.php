<table class="table table-bordered">
    <thead>
        <tr>
            <th>Keterangan</th>
            <th>Pesan</th>
            <th>Status Baca</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($outbox as $msg)
        <tr>
            <td>{{ $msg->keterangan }}</td>
            <td>{{ \Illuminate\Support\Str::limit($msg->pesan, 60) }}</td>
            <td>
                @if($msg->read == 'no')
                    <span class="badge bg-danger">Belum dibaca</span>
                @else
                    <span class="badge bg-success">Sudah dibaca</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($msg->created_at)->format('d-m-Y H:i') }}</td>
            <td>
                <button class="btn btn-info btn-sm lihat-pesan" data-id="{{ $msg->id }}">Lihat</button>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">Tidak ada pesan.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $outbox->appends(['q' => request('q')])->links('pagination::bootstrap-5') }}