@extends('member-area.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-4">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header"><h3 class="card-title">Edit Profile</h3></div>
        <form action="{{ route('profile-reseller.update') }}" method="POST" enctype="multipart/form-data">
            @csrf            
            <div class="card-body">
                <div class="mb-3">
                    <label>Kode</label>
                    <input type="text" class="form-control" value="{{ $reseller->kode }}" disabled>
                </div>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $reseller->nama) }}">
                </div>
                <div class="mb-3">
                    <label>Nama Toko</label>
                    <input type="text" name="nama_toko" class="form-control" value="{{ old('nama_toko', $reseller->nama_toko) }}">
                </div>
                <div class="mb-3">
                    <label>Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $reseller->nomor_hp) }}">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat', $reseller->alamat) }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Foto Profile</label>
                    <input type="file" name="link_foto_profile" class="form-control">
                    @if($reseller->link_foto_profile)                                              
                        <img src="{{ $reseller->link_foto_profile ? asset('storage/' . $reseller->link_foto_profile) : asset('member-assets/assets/img/user2-160x160.jpg') }}" width="80" class="mt-2">
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection