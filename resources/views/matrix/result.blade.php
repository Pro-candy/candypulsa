@extends('matrix.layout')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h3 class="card-title">Hasil Matrix of Destiny</h3>
        <p><strong>Tanggal Lahir:</strong> {{ $birthdate }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>

        <ul class="list-group mb-3">
            @foreach ($result as $key => $value)
                <li class="list-group-item">
                    <strong>{{ $key }}:</strong> {{ $value }}<br>
                    <em>{{ $readings[$key] ?? '-' }}</em>
                </li>
            @endforeach
        </ul>

        <a href="{{ url('/matrix') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
