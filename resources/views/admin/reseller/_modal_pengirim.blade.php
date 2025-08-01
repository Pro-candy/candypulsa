@php
  $tipeOptions = [
    'WhatsApp' => 'WhatsApp',
    'HTTP'     => 'HTTP',
    'SMS'      => 'SMS',
    'Aplikasi' => 'Aplikasi',
  ];
@endphp
<div class="modal fade" id="pengirimModal" tabindex="-1" aria-labelledby="pengirimModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
<div class="card card-dark" id="pengirimCard">
  <div class="card-header">
    <h3 class="card-title">Edit Pengirim - {{ $reseller->kode }} - {{ $reseller->nama }}</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" onclick="closePengirimModal()">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>
  </div>

  <div class="card-body p-0">
            <input type="hidden" id="kodeReseller" value="{{ $reseller->kode }}">

    <div class="table-responsive">
      <table class="table m-0" id="tablePengirim">
        <thead>
          <tr>
            <th>No</th>
            <th>Pengirim</th>
            <th>Tipe</th>
            <th>Kirim Info</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pengirimList as $i => $item)
            <tr>
            <td>{{ $i + 1 }}</td>
            <td><input type="text" name="pengirim[]" class="form-control" value="{{ $item->pengirim }}"></td>
            <td>
                <select name="tipe_pengirim[]" class="form-control">
                @foreach($tipeOptions as $val => $label)
                    <option value="{{ $val }}" {{ $item->tipe === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
                </select>
            </td>
            <td><input type="checkbox" name="kirim_info[]" value="1" {{ $item->kirim_info ? 'checked' : '' }}></td>
            </tr>
            @endforeach

          <!-- baris kosong -->
          <tr class="baris-baru">
            <td>{{ count($pengirimList) + 1 }}</td>
            <td><input type="text" name="pengirim[]" class="form-control"></td>
            <td>
              <select name="tipe_pengirim[]" class="form-control">
                @foreach($tipeOptions as $val => $label)
                  <option value="{{ $val }}">{{ $label }}</option>
                @endforeach
              </select>
            </td>
            <td><input type="checkbox" name="kirim_info[]" value="1"></td>
          </tr>
        </tbody>
      </table>
      <button type="button" class="btn btn-sm btn-primary m-2" id="tambahBaris">+ Tambah Baris</button>
    </div>
  </div>

  <div class="card-footer clearfix">
    <button type="button" class="btn btn-success" id="simpanPengirim">Simpan Perubahan</button>
    <span class="float-right text-muted">
    Terakhir update: {{ optional($lastUpdate)->updated_at ? $lastUpdate->updated_at->format('d/m/Y H:i') : '-' }}
    </span>
 </div>
</div>
 
    </div>
  </div>
</div>

