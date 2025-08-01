@extends('admin.layouts.app')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Setting Landing Page</h3>
    </div>

    <div class="card-body">
        <form id="form-landing-settings" enctype="multipart/form-data">
            @csrf
            <div class="accordion" id="landingAccordion">
                @foreach ($settings->groupBy('group') as $group => $items)
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
                        data-bs-parent="#landingAccordion">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm m-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Key</th>
                                            <th style="width:35%">Keterangan</th>
                                            <th style="width:40%">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $i => $setting)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $setting->label }}</td>
                                            <td>{{ $setting->keterangan ?? '-' }}</td>
                                            <td>
                                                @if($setting->type === 'text')
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="nilai[{{ $setting->id }}]"
                                                        value="{{ $setting->value }}">
                                                @elseif($setting->type === 'textarea')
                                                    <textarea name="nilai[{{ $setting->id }}]"
                                                        class="form-control form-control-sm"
                                                        rows="3">{{ $setting->value }}</textarea>
                                                @elseif($setting->type === 'image')
                                                    <div class="mb-1">
                                                        @if($setting->value)
                                                            <img src="{{ asset('storage/landing/' . $setting->value) }}"
                                                                style="max-height: 60px;" alt="preview">
                                                        @endif
                                                    </div>
                                                    <input type="file" class="form-control form-control-sm"
                                                        name="file[{{ $setting->id }}]">
                                                @endif
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
document.getElementById('form-landing-settings').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("{{ route('landing-settings.update') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Berhasil disimpan!');
            location.reload();
        } else {
            alert('Gagal menyimpan!');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan.');
    });
});
</script>

@endpush
