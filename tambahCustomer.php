<?php
require 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $email  = $_POST['email'];

    $query = "INSERT INTO customer (nama, alamat, telpon, email) 
              VALUES ('$nama', '$alamat', '$telpon', '$email')";
    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "<script>alert('Data berhasil ditambahkan!');document.location.href='customer.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Customer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f0f4f7;font-family:'Segoe UI',sans-serif;}
    .header{background:#2e7d32;color:#fff;padding:20px;text-align:center;border-radius:0 0 15px 15px;margin-bottom:30px;}
    .btn-success{background:#2e7d32;border:none;}
    .btn-success:hover{background:#256628;}
  </style>
</head>
<body>

<div class="header">
  <h3>Tambah Data Customer</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="telpon" class="form-label">Telpon</label>
        <input type="text" name="telpon" id="telpon" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>
      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
      <a href="customer.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
