<?php
require 'koneksi.php';

// ambil semua data item
$item = query("SELECT * FROM item");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f0f4f7;font-family:'Segoe UI',sans-serif;}
    .header{background:#2e7d32;color:#fff;padding:20px;text-align:center;border-radius:0 0 15px 15px;margin-bottom:30px;}
    .card{border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);}
    .btn-success{background:#2e7d32;border:none;}
    .btn-success:hover{background:#256628;}
    .table thead{background:#2e7d32;color:#fff;}
  </style>
</head>
<body>

<div class="header">
  <h3>Data Item / Barang</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container mb-5">
  <div class="d-flex justify-content-between mb-3">
    <a href="dashboard.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
    <a href="tambahItem.php" class="btn btn-success">+ Tambah Item</a>
  </div>

  <div class="card p-3">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama Item</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th width="200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($item)): ?>
            <?php $i=1; foreach ($item as $itm): ?>
              <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td><?= htmlspecialchars($itm['nama_item']); ?></td>
                <td>Rp <?= number_format($itm['harga_beli'],0,',','.'); ?></td>
                <td>Rp <?= number_format($itm['harga_jual'],0,',','.'); ?></td>
                <td class="text-center"><?= $itm['stok']; ?></td>
                <td class="text-center">
                  <a href="ubahItem.php?id=<?= $itm['id_item']; ?>" class="btn btn-sm btn-primary">Ubah</a>
                  <a href="tambahStok.php?id=<?= $itm['id_item']; ?>" class="btn btn-sm btn-success">+ Stok</a>
                  <a href="hapusItem.php?id=<?= $itm['id_item']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus item ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
              <tr><td colspan="6" class="text-center text-muted">Belum ada data item</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
