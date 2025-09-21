<?php
require 'koneksi.php';

// ambil id item dari URL
$id_item = $_GET['id'];

// ambil data item dari database
$item = query("SELECT * FROM item WHERE id_item = $id_item")[0];

// cek tombol submit
if (isset($_POST['submit'])) {
    $jumlah = $_POST['jumlah'];
    if (tambahStok($id_item, $jumlah) > 0) {
        echo "<script>
                alert('Stok berhasil ditambahkan!');
                document.location.href='item.php';
              </script>";
    } else {
        echo "<script>alert('Stok gagal ditambahkan!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Stok</title>
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
  <h3>Tambah Stok Barang</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <h5><?= htmlspecialchars($item['nama_item']); ?></h5>
    <p>Stok saat ini: <strong><?= $item['stok']; ?></strong></p>

    <form action="" method="post">
      <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah Tambahan Stok</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah tambahan" required>
      </div>
      <button type="submit" name="submit" class="btn btn-success">Tambah Stok</button>
      <a href="item.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
