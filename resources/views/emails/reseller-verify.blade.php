<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Verifikasi Email - Candy Pulsa</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      padding: 30px;
      color: #333;
    }
    .container {
      max-width: 600px;
      background-color: #ffffff;
      padding: 30px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 25px;
      background-color: #0d6efd;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
    }
    .footer {
      font-size: 12px;
      margin-top: 40px;
      color: #777;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Verifikasi Email Anda</h2>

    <p>Hallo {{ $nama }},</p>

    <p>Terima kasih telah mendaftar di <strong>Candy Pulsa</strong>.</p>

    <p>Untuk menyelesaikan proses pendaftaran dan mengaktifkan akun Anda, silakan klik tombol di bawah ini:</p>

    <p>
      <a href="{{ $verifyUrl }}" class="btn btn-success">Verifikasi Sekarang</a>
    </p>

    <p>Atau salin dan tempel link berikut ke browser Anda jika tombol di atas tidak berfungsi:</p>

    <p><a href="{{ $verifyUrl }}">{{ $verifyUrl }}</a></p>

    <p>Jika Anda tidak merasa mendaftar di Candy Pulsa, abaikan email ini.</p>

    <div class="footer">
      &copy; {{ date('Y') }} Candy Pulsa | Cuannya Manis cuy ... 🍭<br>
    </div>
  </div>
</body>
</html>
