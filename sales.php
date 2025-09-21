<?php
require 'koneksi.php';

// ambil semua data sales (gabung dengan customer biar bisa tampil nama customer)
$sales = query("SELECT sales.id_sales, customer.nama AS nama_customer, sales.do_number, sales.status 
                FROM sales 
                JOIN customer ON sales.id_customer = customer.id");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Sales</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f0f4f7;font-family:'Segoe UI',sans-serif;}
    .header{background:#2e7d32;color:#fff;padding:20px;text-align:center;border-radius:0 0 15px 15px;margin-bottom:30px;}
    .card{border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);}
    .btn-success{background:#2e7d32;border:none;}
    .btn-success:hover{background:#256628;}
    .table thead{background:#2e7d32;color:#fff;}
    .arrow-btn{font-size:18px;}
  </style>
</head>
<body>

<div class="header">
  <h3>Data Sales</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container mb-5">
  <div class="d-flex justify-content-between mb-3">
    <a href="dashboard.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
    <a href="tambahSales.php" class="btn btn-success">+ Tambah Sales</a>
  </div>

  <div class="card p-3">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Customer</th>
            <th>No. DO</th>
            <th>Status</th>
            <th width="160">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($sales)): ?>
            <?php $i=1; foreach ($sales as $s): ?>
              <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td><?= htmlspecialchars($s['nama_customer']); ?></td>
                <td><?= htmlspecialchars($s['do_number']); ?></td>
                <td><?= htmlspecialchars($s['status']); ?></td>
                <td class="text-center">
                  <a href="ubahSales.php?id=<?= $s['id_sales']; ?>" class="btn btn-sm btn-primary">✏️</a>
                  <a href="hapusSales.php?id=<?= $s['id_sales']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">🗑</a>
                  <a href="detailSales.php?id=<?= $s['id_sales']; ?>" class="btn btn-sm btn-success arrow-btn">➡</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
              <tr><td colspan="5" class="text-center text-muted">Belum ada data sales</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
