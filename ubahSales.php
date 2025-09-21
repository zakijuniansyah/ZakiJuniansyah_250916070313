<?php
require 'koneksi.php';

// ambil id dari URL
$id_sales = $_GET['id'];

// ambil data sales berdasarkan id_sales
$sales = query("SELECT * FROM sales WHERE id_sales = $id_sales")[0];

// ambil semua customer untuk dropdown
$customer = query("SELECT * FROM customer");

// cek tombol submit
if (isset($_POST['submit'])) {
    if (ubahSales($_POST) > 0) {
        echo "<script>
                alert('Data sales berhasil diubah!');
                document.location.href='sales.php';
              </script>";
    } else {
        echo "<script>alert('Data sales gagal diubah!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ubah Sales</title>
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
  <h3>Ubah Data Sales</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <input type="hidden" name="id_sales" value="<?= $sales['id_sales']; ?>">

      <!-- pilih customer -->
      <div class="mb-3">
        <label for="id_customer" class="form-label">Customer</label>
        <select name="id_customer" id="id_customer" class="form-select" required>
          <?php foreach($customer as $cst): ?>
            <option value="<?= $cst['id']; ?>" 
              <?= ($sales['id_customer'] == $cst['id']) ? 'selected' : ''; ?>>
              <?= $cst['nama']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- nomor DO -->
      <div class="mb-3">
        <label for="do_number" class="form-label">Nomor DO</label>
        <input type="text" name="do_number" id="do_number" class="form-control" 
               value="<?= htmlspecialchars($sales['do_number']); ?>" required>
      </div>

      <!-- status -->
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
          <option value="Pending" <?= ($sales['status']=="Pending") ? "selected":""; ?>>Pending</option>
          <option value="Proses" <?= ($sales['status']=="Proses") ? "selected":""; ?>>Proses</option>
          <option value="Selesai" <?= ($sales['status']=="Selesai") ? "selected":""; ?>>Selesai</option>
        </select>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="sales.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
