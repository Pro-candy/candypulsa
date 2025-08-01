@extends('admin.layouts.app')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Setting Parameter</h3>
    </div>

    <div class="card-body">
        <form id="form-parameter">
            @csrf
            <div class="accordion" id="parameterAccordion">
                @foreach ($parameters->groupBy('group') as $group => $items)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $loop->index }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            aria-controls="collapse-{{ $loop->index }}">
                            {{ $group ?? 'Tanpa Grup' }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $loop->index }}"
                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                        data-bs-parent="#parameterAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm m-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Kode</th>
                                            <th style="width:45%">Keterangan</th>
                                            <th style="width:30%">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $i => $param)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $param->kode }}</td>
                                            <td>{{ $param->keterangan ?? '-' }}</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="nilai[{{ $param->id }}]"
                                                    value="{{ $param->nilai }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Semua</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('form-parameter').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("{{ route('parameter.update') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Parameter berhasil disimpan!');
                location.reload();
            } else {
                alert('Gagal menyimpan parameter.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan.');
        });
    });
</script>
@endpush
