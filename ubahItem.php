<?php
require 'koneksi.php';

// ambil id dari URL
$id_item = $_GET['id'];

// ambil data item berdasarkan id
$item = query("SELECT * FROM item WHERE id_item = $id_item")[0];

// cek tombol submit
if (isset($_POST['submit'])) {
    if (ubahItem($_POST) > 0) {
        echo "<script>
                alert('Data item berhasil diubah!');
                document.location.href='item.php';
              </script>";
    } else {
        echo "<script>alert('Data item gagal diubah!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ubah Item</title>
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
  <h3>Ubah Data Item / Barang</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <input type="hidden" name="id_item" value="<?= $item['id_item']; ?>">

      <div class="mb-3">
        <label for="nama_item" class="form-label">Nama Item</label>
        <input type="text" name="nama_item" id="nama_item" class="form-control" 
               value="<?= htmlspecialchars($item['nama_item']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="harga_beli" class="form-label">Harga Beli</label>
        <input type="number" name="harga_beli" id="harga_beli" class="form-control" 
               value="<?= $item['harga_beli']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="harga_jual" class="form-label">Harga Jual</label>
        <input type="number" name="harga_jual" id="harga_jual" class="form-control" 
               value="<?= $item['harga_jual']; ?>" required>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="item.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
