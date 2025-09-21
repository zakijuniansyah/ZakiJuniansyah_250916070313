<?php
require 'koneksi.php';

// ambil semua data petugas
$petugas = query("SELECT * FROM petugas");
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Petugas</title>
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
  <h3>Data Petugas</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container mb-5">
  <div class="d-flex justify-content-between mb-3">
    <a href="dashboard.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
    <a href="tambahPetugas.php" class="btn btn-success">+ Tambah Petugas</a>
  </div>

  <div class="card p-3 shadow">
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Username</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($petugas)): ?>
            <?php $i=1; foreach ($petugas as $p): ?>
              <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td><?= htmlspecialchars($p['nama_user']); ?></td>
                <td><?= htmlspecialchars($p['username']); ?></td>
                <td class="text-center">
                  <a href="ubahPetugas.php?id=<?= $p['id_user']; ?>" class="btn btn-sm btn-primary">Update</a>
                  <a href="hapusPetugas.php?id=<?= $p['id_user']; ?>" 
                     class="btn btn-sm btn-danger" 
                     onclick="return confirm('Yakin hapus petugas ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="4" class="text-center text-muted">Belum ada data petugas</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
