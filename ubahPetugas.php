<?php
require 'koneksi.php';

// ambil id dari URL
$id_user = $_GET['id'];

// ambil data petugas berdasarkan id
$petugas = query("SELECT * FROM petugas WHERE id_user = $id_user")[0];

// cek tombol submit
if (isset($_POST['submit'])) {
    if (ubahPetugas($_POST) > 0) {
        echo "<script>
                alert('Data petugas berhasil diubah!');
                document.location.href='petugas.php';
              </script>";
    } else {
        echo "<script>alert('Data petugas gagal diubah!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ubah Petugas</title>
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
  <h3>Ubah Data Petugas</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <input type="hidden" name="id_user" value="<?= $petugas['id_user']; ?>">

      <div class="mb-3">
        <label for="nama_user" class="form-label">Nama Petugas</label>
        <input type="text" name="nama_user" id="nama_user" 
               class="form-control" value="<?= htmlspecialchars($petugas['nama_user']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" 
               class="form-control" value="<?= htmlspecialchars($petugas['username']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru">
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="petugas.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
