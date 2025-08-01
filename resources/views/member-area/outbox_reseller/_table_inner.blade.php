<table class="table table-bordered">
    <thead>
        <tr>
            <th>Waktu</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($outbox as $pesan)
        <tr>
            <td>{{ \Carbon\Carbon::parse($pesan->created_at)->format('d-m-Y H:i') }}</td>
            <td>{{ \Illuminate\Support\Str::limit($pesan->pesan, 80) }}</td>
            <td>
                <button class="btn btn-info btn-sm lihat-outbox" data-id="{{ $pesan->id }}">Lihat</button>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">Tidak ada pesan.</td></tr>
        @endforelse
    </tbody>
</table>