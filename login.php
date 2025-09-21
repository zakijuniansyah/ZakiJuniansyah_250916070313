<?php
session_start();
require 'koneksi.php'; // pastikan fungsi login() ada di koneksi.php

$error = '';
// proses login saat tombol diklik
if (isset($_POST["login"])) {
    if (login($_POST) > 0) {
        // jika login sukses, redirect ke admin.php
        $_SESSION['success'] = "Login Berhasil.";
        header("Location: dashboard.php");
        exit;
    } else {
        // jangan echo sebelum header; tampilkan pesan error di halaman
        $error = "Login gagal. Periksa username dan password.";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - Aplikasi Pengadaan Koperasi Pegawai</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg1:#e8f5e9;
      --bg2:#c8e6c9;
      --card:#fff;
      --accent:#2e7d32;
      --muted:#51626a;
    }
    *{box-sizing:border-box;font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial;}
    body{
      margin:0;
      min-height:100vh;
      background: linear-gradient(135deg,var(--bg1),var(--bg2));
      display:flex;
      align-items:center;
      justify-content:center;
      padding:28px;
    }
    .container{
      width:100%;
      max-width:980px;
      display:grid;
      grid-template-columns: 1fr 420px;
      gap:28px;
      align-items:center;
    }
    .hero{
      padding:28px;
    }
    .logo{
      display:inline-block;
      background:rgba(46,125,50,0.12);
      padding:8px 14px;
      border-radius:8px;
      color:var(--accent);
      font-weight:700;
    }
    .hero h1{
      margin:18px 0 12px;
      font-size:30px;
      color:var(--accent);
    }
    .hero p{
      color:#243233;
      font-size:15px;
      margin-bottom:16px;
    }
    .cta{
      display:inline-block;
      padding:10px 14px;
      background:var(--accent);
      color:#fff;
      border-radius:8px;
      text-decoration:none;
      font-weight:600;
      box-shadow:0 8px 20px rgba(46,125,50,0.12);
    }

    .card{
      background:var(--card);
      border-radius:12px;
      padding:26px;
      box-shadow:0 10px 28px rgba(6,24,12,0.06);
    }
    .card h2{ margin:0 0 8px; color:var(--accent); font-size:20px; }
    .muted{ color:var(--muted); font-size:13px; margin-bottom:10px; display:block; }

    .form-row{ margin-bottom:12px; position:relative; }
    label{ display:block; font-size:13px; margin-bottom:6px; color:#324041; }
    input[type="text"], input[type="password"]{
      width:100%;
      padding:11px 12px;
      border-radius:8px;
      border:1px solid rgba(0,0,0,0.06);
      font-size:15px;
      outline:none;
      background:#fff;
    }
    input:focus{ box-shadow:0 6px 16px rgba(46,125,50,0.08); transform:translateY(-1px); }
    .btn{
      display:inline-block;
      padding:11px 16px;
      background: linear-gradient(90deg,var(--accent), #1b5e20);
      color:#fff;
      border:none;
      border-radius:8px;
      font-weight:600;
      cursor:pointer;
      box-shadow:0 8px 18px rgba(46,125,50,0.12);
    }
    .small{ font-size:13px; color:#556; margin-top:10px; }
    .error{
      background:#fff0f0;
      color:#b32b2b;
      padding:10px 12px;
      border-radius:8px;
      margin-bottom:12px;
      border:1px solid rgba(179,43,43,0.08);
    }
    .show-pass{ position:absolute; right:12px; top:36px; font-size:13px; cursor:pointer; color:#6b6b6b; user-select:none; }

    @media (max-width:920px){
      .container{ grid-template-columns: 1fr; padding:12px; }
      .hero{ order:2; text-align:center; padding:14px 6px; }
      .card{ order:1; }
      .hero h1{ font-size:26px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="hero" aria-hidden="true">
      <div class="logo">Koperasi Pegawai</div>
      <h1>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA</h1>
      <p>Masuk untuk mengelola pengadaan, stok, dan transaksi kebutuhan anggota koperasi.</p>
      <a class="cta" href="index.html">Kembali ke Beranda</a>
    </div>

    <div class="card" aria-live="polite">
      <h2>Login Pengelola</h2>
      <span class="muted">Masukkan username dan password yang telah terdaftar.</span>

      <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="" method="post" autocomplete="off" novalidate>
        <div class="form-row">
          <label for="username">Username</label>
          <input id="username" name="username" type="text" required value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>

        <div class="form-row">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" minlength="6" required>
          <span class="show-pass" onclick="togglePass('password')">Tampilkan</span>
        </div>

        <div style="display:flex; gap:10px; align-items:center; margin-top:8px;">
          <button class="btn" type="submit" name="login">Login</button>
          <div class="small">Belum punya akun? <a href="registrasi.php">Daftar</a></div>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePass(id){
      var inp = document.getElementById(id);
      if (!inp) return;
      inp.type = (inp.type === 'password') ? 'text' : 'password';
    }

    // validasi sederhana di client-side
    document.querySelector('form').addEventListener('submit', function(e){
      var user = document.getElementById('username').value.trim();
      var pass = document.getElementById('password').value;
      if (user === '' || pass === '') {
        e.preventDefault();
        alert('Username dan password harus diisi.');
        return false;
      }
      return true;
    });
  </script>
</body>
</html>
