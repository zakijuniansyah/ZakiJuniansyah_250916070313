<?php
require 'koneksi.php';

// ambil semua data customer untuk dropdown
$customer = query("SELECT * FROM customer");

// cek tombol submit
if (isset($_POST['submit'])) {
    if (tambahSales($_POST) > 0) {
        echo "<script>
                alert('Data sales berhasil ditambahkan!');
                document.location.href='sales.php';
              </script>";
    } else {
        echo "<script>alert('Data sales gagal ditambahkan!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Sales</title>
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
  <h3>Tambah Data Sales</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <!-- pilih customer -->
      <div class="mb-3">
        <label for="id_customer" class="form-label">Customer</label>
        <select name="id_customer" id="id_customer" class="form-select" required>
          <option value="">-- Pilih Customer --</option>
          <?php foreach($customer as $cst): ?>
            <option value="<?= $cst['id']; ?>"><?= $cst['nama']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- nomor DO -->
      <div class="mb-3">
        <label for="do_number" class="form-label">Nomor DO</label>
        <input type="text" name="do_number" id="do_number" class="form-control" required>
      </div>

      <!-- status -->
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
          <option value="Pending">Pending</option>
          <option value="Proses">Proses</option>
          <option value="Selesai">Selesai</option>
        </select>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
      <a href="sales.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
