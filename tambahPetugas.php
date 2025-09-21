<?php
require 'koneksi.php';

// cek tombol submit
if (isset($_POST['submit'])) {
    if (tambahPetugas($_POST) > 0) {
        echo "<script>
                alert('Petugas berhasil ditambahkan!');
                document.location.href='petugas.php';
              </script>";
    } else {
        echo "<script>alert('Petugas gagal ditambahkan!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Petugas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f0f4f7;font-family:'Segoe UI',sans-serif;}
    .header{background:#2e7d32;color:#fff;padding:20px;text-align:center;
            border-radius:0 0 15px 15px;margin-bottom:30px;}
    .btn-success{background:#2e7d32;border:none;}
    .btn-success:hover{background:#256628;}
    .card{border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);}
  </style>
</head>
<body>

<div class="header">
  <h3>Tambah Petugas Baru</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama_user" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_user" id="nama_user" class="form-control" 
               placeholder="Masukkan nama petugas" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" 
               placeholder="Masukkan username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" 
               placeholder="Masukkan password" required>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
      <a href="petugas.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
