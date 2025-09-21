<?php
session_start();
require 'koneksi.php'; // pastikan koneksi.php ada dan fungsi regis() tersedia

$error = '';
// proses registrasi saat tombol diklik
if (isset($_POST["registrasi"])) {
    if (regis($_POST) > 0) {
        $_SESSION['success'] = "Registrasi Berhasil. Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        $error = "Registrasi gagal. Periksa username dan konfirmasi password.";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registrasi - Aplikasi Pengadaan Koperasi Pegawai</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg1:#e8f5e9; /* hijau lembut */
      --bg2:#c8e6c9;
      --card:#fff;
      --accent:#2e7d32; /* hijau koperasi */
      --muted:#51626a;
    }
    *{box-sizing:border-box;font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;}
    body{
      margin:0;
      min-height:100vh;
      background: linear-gradient(135deg,var(--bg1) 0%, var(--bg2) 100%);
      display:flex;
      align-items:center;
      justify-content:center;
      padding:28px;
    }
    .container{
      width:100%;
      max-width:1000px;
      display:grid;
      grid-template-columns: 1fr 460px;
      gap:28px;
      align-items:center;
    }
    .hero{
      color:#233;
      padding:36px;
    }
    .logo{
      display:inline-block;
      background:rgba(46,125,50,0.12);
      padding:8px 14px;
      border-radius:8px;
      color:var(--accent);
      font-weight:700;
      letter-spacing:0.4px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    }
    .hero h1{
      margin:22px 0 12px;
      font-size:34px;
      line-height:1.06;
      color:var(--accent);
    }
    .hero p{
      color:rgba(35,45,51,0.9);
      font-size:15px;
      margin-bottom:16px;
    }
    .hero .cta{
      display:inline-block;
      margin-top:8px;
      padding:10px 16px;
      background: var(--accent);
      color:#fff;
      border-radius:8px;
      text-decoration:none;
      font-weight:600;
      box-shadow: 0 8px 20px rgba(46,125,50,0.12);
    }

    .card{
      background:var(--card);
      border-radius:12px;
      padding:26px;
      box-shadow: 0 10px 28px rgba(6,24,12,0.06);
    }
    .card h2{
      margin:0 0 8px;
      color:var(--accent);
      font-size:20px;
    }
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
      background: #fff;
    }
    input[type="text"]:focus, input[type="password"]:focus{
      box-shadow: 0 6px 16px rgba(46,125,50,0.08);
      transform: translateY(-1px);
    }
    .btn{
      display:inline-block;
      padding:11px 16px;
      background: linear-gradient(90deg,var(--accent), #1b5e20);
      color:#fff;
      border:none;
      border-radius:8px;
      font-weight:600;
      cursor:pointer;
      box-shadow: 0 8px 18px rgba(46,125,50,0.12);
    }
    .btn:active{ transform: translateY(1px); }

    .small{ font-size:13px; color:#556; margin-top:10px; }
    .error{
      background: #fff0f0;
      color:#b32b2b;
      padding:10px 12px;
      border-radius:8px;
      margin-bottom:12px;
      border:1px solid rgba(179,43,43,0.08);
    }

    .show-pass{
      position:absolute; right:12px; top:36px; font-size:13px; cursor:pointer; color:#6b6b6b;
      user-select:none;
    }

    /* responsive */
    @media (max-width:920px){
      .container{ grid-template-columns: 1fr; padding:12px; }
      .hero{ order:2; text-align:center; padding:14px 6px; }
      .card{ order:1; }
      .hero h1{ font-size:28px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="hero" aria-hidden="true">
      <div class="logo">Koperasi Pegawai</div>
      <h1>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA</h1>
      <p>Kelola pengadaan, stok, dan transaksi kebutuhan rumah tangga anggota koperasi dengan mudah. Daftar untuk membuat akun pengelola/petugas koperasi.</p>
      <a class="cta" href="index.html">Kembali ke Beranda</a>
    </div>

    <div class="card" aria-live="polite">
      <h2>Registrasi Akun Pengelola</h2>
      <span class="muted">Isi data dengan benar. Akun ini digunakan untuk mengelola pengadaan dan transaksi di koperasi.</span>

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

        <div class="form-row">
          <label for="password2">Konfirmasi Password</label>
          <input id="password2" name="password2" type="password" minlength="6" required>
          <span class="show-pass" onclick="togglePass('password2')">Tampilkan</span>
        </div>

        <div style="display:flex; gap:10px; align-items:center; margin-top:8px;">
          <button class="btn" type="submit" name="registrasi">Registrasi</button>
          <div class="small">Sudah punya akun? <a href="login.php">Masuk</a></div>
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

    document.querySelector('form').addEventListener('submit', function(e){
      var p1 = document.getElementById('password').value;
      var p2 = document.getElementById('password2').value;
      if (p1 !== p2) {
        e.preventDefault();
        alert('Konfirmasi password tidak cocok.');
        return false;
      }
      if (p1.length < 6) {
        e.preventDefault();
        alert('Password minimal 6 karakter.');
        return false;
      }
      return true;
    });
  </script>
</body>
</html>
