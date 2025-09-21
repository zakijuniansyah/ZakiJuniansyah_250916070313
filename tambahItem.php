<?php
require 'koneksi.php';

// cek tombol submit
if (isset($_POST['submit'])) {
    if (tambahItem($_POST) > 0) {
        echo "<script>
                alert('Item berhasil ditambahkan!');
                document.location.href='item.php';
              </script>";
    } else {
        echo "<script>alert('Item gagal ditambahkan!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Item</title>
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
  <h3>Tambah Data Item / Barang</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama_item" class="form-label">Nama Item</label>
        <input type="text" name="nama_item" id="nama_item" class="form-control" placeholder="Masukkan nama barang" required>
      </div>
      <div class="mb-3">
        <label for="harga_beli" class="form-label">Harga Beli</label>
        <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Masukkan harga beli" required>
      </div>
      <div class="mb-3">
        <label for="harga_jual" class="form-label">Harga Jual</label>
        <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Masukkan harga jual" required>
      </div>
      <div class="mb-3">
        <label for="stok" class="form-label">Stok Awal</label>
        <input type="number" name="stok" id="stok" class="form-control" placeholder="Masukkan jumlah stok awal" required>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
      <a href="item.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
