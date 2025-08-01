<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Dashboard | Candy Pulsa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="card p-4 shadow" style="width: 350px;">
    <h4 class="text-center mb-3">Login Dashboard</h4>
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      <div class="mb-2">
        <label>Nomor Pegawai</label>
        <input type="text" name="nip" class="form-control" required>
      </div>
      <div class="mb-2">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</body>
</html>
