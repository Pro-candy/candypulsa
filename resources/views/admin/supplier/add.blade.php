@extends('admin.layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
        <!--begin::Form-->
        <div class="card card-success card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Tambah Modul Supplier</div>
            </div>
            <!--end::Header-->

            <form method="POST" action="{{ route('supplier.store') }}">
                @csrf

                <!--begin::Body-->
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Supplier</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username API</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="apikey" class="col-sm-2 col-form-label">API Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apikey" name="apikey" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pin" class="col-sm-2 col-form-label">PIN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pin" name="pin" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="endpoint" class="col-sm-2 col-form-label">Endpoint</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="endpoint" name="endpoint" rows="3" placeholder="Contoh: https://websuplier.com/ atau http://192.168.10.11/ "></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="port" class="col-sm-2 col-form-label">Port</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="port" name="port" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="terima_dari" class="col-sm-2 col-form-label">Terima Dari</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="terima_dari" name="terima_dari" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="id_jawaban_provider" class="col-sm-2 col-form-label">ID Jawaban Provider</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="id_jawaban_provider" name="id_jawaban_provider" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="parameter" class="col-sm-2 col-form-label">Parameter</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="parameter" name="parameter" rows="3" placeholder="Contoh: id=abc123|pin=123456|user=userapi|pass=passapi"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jenis_method" class="col-sm-2 col-form-label">Jenis Request</label>                        
                        <div class="col-sm-10">
                            <select class="form-select" id="jenis_method" name="jenis_method" required>
                                <option value="">-- Pilih Jenis Request --</option>
                                <option value="GET">HTTP GET</option>
                                <option value="POST">HTTP POST</option>
                                <option value="API">API (JSON)</option>
                            </select>
                            <div class="invalid-feedback">Pilih tipe request yang valid.</div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="method" class="col-sm-2 col-form-label">Method</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="method" name="method" rows="3" placeholder="Contoh: key=value;sign=value_sign"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="initial_parsing" class="col-sm-2 col-form-label">Initial Parsing</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="initial_parsing" name="initial_parsing" rows="3"></textarea>
                        </div>
                    </div>

                    {{-- Hidden fields --}}
                    <input type="hidden" name="saldo" value="0">
                    <input type="hidden" name="deleted" value="0">

                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Aktif</legend>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="aktif" id="aktif1" value="1" checked />
                                <label class="form-check-label" for="aktif1">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="aktif" id="aktif0" value="0" />
                                <label class="form-check-label" for="aktif0">Tidak</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success ">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary float-end">Batal</a>
                </div>
                <!--end::Footer-->
            </form>
        </div>
        <!--end::Form-->

@endsection
