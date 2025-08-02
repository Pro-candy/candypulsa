@extends('member-area.layout')

@section('title', 'Candy Pulsa | Dashboard')

@section('content') 
    <main class="app-main">
        <div class="container py-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Dashboard</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>   
                </div>           
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-primary">
                                <div class="inner">
                                    <p>Saldo Candy Pulsa</p>
                                    <h3>Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                                </div>
                                <i class="small-box-icon bi bi-wallet2"></i>
                                <a href="{{ route('mutasi.saldo') }}" class="small-box-footer link-light">Mutasi Saldo<i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-success">
                                <div class="inner">
                                    <p>Total Transaksi</p>
                                    <h3>312</h3> <!-- isi reseller.saldo -->
                                </div>
                                <i class="small-box-icon bi bi-arrow-repeat"></i>
                                <a href="#" class="small-box-footer link-light">Lihat Transaksi<i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-warning">
                            <div class="inner">
                                <p>Produk Toko</p>
                                <h3>123</h3>
                            </div>
                            <i class="small-box-icon bi bi-box-seam"></i>
                            <a href="{{ route('produk.index') }}" class="small-box-footer link-dark">Manajemen Produk<i class="bi bi-link-45deg"></i>
                            </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box text-bg-danger">
                            <div class="inner">
                                <p>Transaksi Hari ini</p>
                                <h3>Rp 1.250.000</h3>
                            </div>
                            <i class="small-box-icon bi bi-collection"></i>
                            <a href="#" class="small-box-footer link-light">Detail Transaksi <i class="bi bi-link-45deg"></i>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>       
        </div>  
        
        <div class="container py-4">
            <div class="card card-dark">
                <!-- HEADER -->
                <div class="card-header">
                    <h3 class="card-title">Transaksi</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-maximize">
                        <i data-lte-icon="maximize" class="bi bi-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit"></i>
                      </button>
                    </div>
                </div>

                <!-- FORM INPUT ATAS -->
                <div class="card-footer bg-light">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5 position-relative">
                            <label class="form-label mb-1">Pelanggan:</label>
                            <div class="input-group">
                                <input type="text" id="inputNamaPelanggan" class="form-control" placeholder="Ketik nama atau kode pelanggan">
                                <button class="btn btn-outline-primary btn-tambah-pelanggan" type="button">
                                <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <div id="dropdownPelanggan" class="list-group position-absolute w-100 z-3 d-none shadow-sm" style="max-height: 200px; overflow-y: auto;"></div>

                            <!-- Hidden input untuk kode pelanggan -->
                            <input type="hidden" id="inputKodePelanggan" name="kode_pelanggan">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label mb-1">Tanggal:</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label mb-1">No. Invoice:</label>
                            <input type="text" class="form-control" value="INV-00123" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row g-3 mb-3">
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-primary btn-buka-modal btn-lg w-100" data-menu="Pulsa">
                                <i class="bi bi-phone"></i> Pulsa
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-danger btn-buka-modal btn-lg w-100" data-menu="Data">
                                <i class="bi bi-reception-4"></i> Data
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-warning btn-buka-modal btn-lg w-100" data-menu="E-Wallet">
                                <i class="bi bi-wallet2"></i> E-Wallet
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-success btn-buka-modal btn-lg w-100" data-menu="Token PLN">
                                <i class="bi bi-lightning-charge"></i> Token PLN
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-info btn-buka-modal btn-lg w-100" data-menu="SMS/TLP">
                                <i class="bi bi-telephone"></i> SMS / TLP
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-warning btn-buka-modal btn-lg w-100" data-menu="Game">
                                <i class="bi bi-controller"></i> Game
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-file-earmark-text"></i> Bayar Tagihan
                            </button>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <button class="btn btn-dark btn-lg w-100" id="btnTransaksiToko">
                                <i class="bi bi-shop"></i> Transaksi Toko
                            </button>
                        </div>
                    </div>
                </div>

                <!-- FORM TRANSAKSI -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="daftarProdukTable">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th style="width: 50px;">No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th style="width: 100px;">Qty</th>
                                <th style="width: 150px;">Harga</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftarProdukBody">
                            <!-- Diisi dinamis dengan JS -->
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold bg-light">
                                <td class="text-center" colspan="3">Jumlah:</td>
                                <td>
                                    <input type="text" id="totalQty" class="form-control text-end fw-bold" value="0" readonly style="font-size:1.1em;">
                                </td>
                                <td colspan="2">
                                    <input type="text" id="totalPembayaran" class="form-control text-end fw-bold" value="0" readonly style="font-size:1.1em;">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- RINGKASAN DAN PROSES -->
                <div class="card-footer bg-light">
                        <button id="btnProsesPembayaranToko" class="btn btn-lg btn-dark float-end">
                        <i class="bi bi-cash-coin me-1"></i> Proses Pembayaran
                        </button>
                </div>
            </div>
        </div>


    </main>
@endsection  

@section('scripts')

@endsection