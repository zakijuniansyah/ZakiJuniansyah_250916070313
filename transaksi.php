<?php
require 'koneksi.php';

// ambil semua transaksi beserta relasi sales & item
$transactions = query("
    SELECT t.id_transaction, t.quantity, t.price, t.amount, t.created_at,
           s.do_number, s.status,
           c.nama AS nama_customer,
           i.nama_item
    FROM transaction t
    JOIN sales s ON t.id_sales = s.id_sales
    JOIN customer c ON s.id_customer = c.id
    JOIN item i ON t.id_item = i.id_item
    ORDER BY t.created_at DESC
");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f0f4f7;font-family:'Segoe UI',sans-serif;}
    .header{background:#2e7d32;color:#fff;padding:20px;text-align:center;
            border-radius:0 0 15px 15px;margin-bottom:30px;}
    .btn-success{background:#2e7d32;border:none;}
    .btn-success:hover{background:#256628;}
    .table thead{background:#2e7d32;color:#fff;}
  </style>
</head>
<body>

<div class="header">
  <h3>Data Transaksi</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container mb-5">
  <div class="d-flex justify-content-between mb-3">
    <a href="dashboard.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
    <a href="tambahTransaksi.php" class="btn btn-success">+ Tambah Transaksi Baru</a>
  </div>

  <div class="card p-3 shadow">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>No. DO</th>
            <th>Customer</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($transactions)): ?>
            <?php $i=1; foreach ($transactions as $trx): ?>
              <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td><?= htmlspecialchars($trx['do_number']); ?></td>
                <td><?= htmlspecialchars($trx['nama_customer']); ?></td>
                <td><?= htmlspecialchars($trx['nama_item']); ?></td>
                <td class="text-center"><?= $trx['quantity']; ?></td>
                <td>Rp <?= number_format($trx['price'],0,',','.'); ?></td>
                <td>Rp <?= number_format($trx['amount'],0,',','.'); ?></td>
                <td class="text-center"><?= htmlspecialchars($trx['status']); ?></td>
                <td><?= $trx['created_at']; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
              <tr><td colspan="9" class="text-center text-muted">Belum ada data transaksi</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
