@extends('matrix.layout')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h3 class="card-title">Matrix of Destiny Calculator</h3>
        <form method="POST" action="{{ route('matrix.calculate') }}">
            @csrf
            <div class="mb-3">
                <label for="birthdate" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Jenis Kelamin</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" required>
                    <label class="form-check-label" for="gender_male">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" required>
                    <label class="form-check-label" for="gender_female">Perempuan</label>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Hitung Matrix</button>
        </form>
    </div>
</div>
@endsection
