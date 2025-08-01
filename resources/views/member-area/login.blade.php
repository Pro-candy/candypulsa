<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Member Area</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- TAMPILKAN ERROR VALIDASI --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- TOMBOL KIRIM ULANG EMAIL VERIFIKASI --}}
            @if(session('unverified_email'))
            <div class="text-center mb-3">
                <form action="{{ route('reseller.resendVerification') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ session('unverified_email') }}">
                <button type="submit" class="btn btn-warning w-100">Kirim Ulang Email Verifikasi</button>
                </form>
            </div>
            @endif

        <h2 class="text-center mb-4">Login Member Area</h2>

        <form action="{{ route('reseller.login.submit') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
          @csrf
          <div class="mb-3">
            <label for="login" class="form-label">Nomor HP atau Email</label>
            <input type="text" name="login" id="login" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label for="pin" class="form-label">PIN</label>
            <input type="password" name="pin" id="pin" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <button class="btn btn-success w-100" type="submit">Login Sekarang</button>
        </form>
        <div class="text-center mt-3">
          <span>Belum jadi member? </span><a href="{{ url('/') }}">Daftar Sekarang</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>