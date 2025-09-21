<?php
require 'koneksi.php';

// ambil id dari URL
$id = $_GET['id'];

// ambil data customer berdasarkan id
$customer = query("SELECT * FROM customer WHERE id = $id")[0];

// cek tombol submit
if (isset($_POST['submit'])) {
    if (ubahCustomer($_POST) > 0) {
        echo "<script>
                alert('Data customer berhasil diubah!');
                document.location.href='customer.php';
              </script>";
    } else {
        echo "<script>alert('Data customer gagal diubah!');</script>";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ubah Customer</title>
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
  <h3>Ubah Data Customer</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container">
  <div class="card p-4 shadow">
    <form action="" method="post">
      <input type="hidden" name="id" value="<?= $customer['id']; ?>">

      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" 
               value="<?= htmlspecialchars($customer['nama']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control" rows="3" required><?= htmlspecialchars($customer['alamat']); ?></textarea>
      </div>
      <div class="mb-3">
        <label for="telpon" class="form-label">Telpon</label>
        <input type="text" name="telpon" id="telpon" class="form-control" 
               value="<?= htmlspecialchars($customer['telpon']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" 
               value="<?= htmlspecialchars($customer['email']); ?>" required>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="customer.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>

</body>
</html>
