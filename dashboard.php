<?php
// session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit;
// }
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Aplikasi Pengadaan</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .header {
      background: linear-gradient(90deg, #2e7d32, #43a047);
      color: #fff;
      padding: 30px 20px;
      text-align: center;
      border-radius: 0 0 20px 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      margin-bottom: 40px;
    }
    .header h2 {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .card-menu {
      border: none;
      border-radius: 15px;
      padding: 30px 20px;
      text-align: center;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }
    .card-menu:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .card-menu h4 {
      margin-top: 15px;
      font-weight: bold;
      color: #2e7d32;
    }
    .card-menu p {
      font-size: 14px;
      color: #666;
    }
    .logout-btn {
      margin-top: auto;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

<div class="header">
  <h2>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA</h2>
  <h5>PADA KOPERASI PEGAWAI</h5>
</div>

<div class="container flex-grow-1">
  <div class="row g-4 justify-content-center">
    <!-- Customer -->
    <div class="col-md-4 col-lg-3">
      <a href="customer.php" class="text-decoration-none">
        <div class="card-menu">
          <img src="https://img.icons8.com/ios-filled/50/2e7d32/user-group-man-man.png"/>
          <h4>Customer</h4>
          <p>Kelola data customer</p>
        </div>
      </a>
    </div>
    <!-- Sales -->
    <div class="col-md-4 col-lg-3">
      <a href="sales.php" class="text-decoration-none">
        <div class="card-menu">
          <img src="https://img.icons8.com/ios-filled/50/2e7d32/sell.png"/>
          <h4>Sales</h4>
          <p>Input & kelola data penjualan</p>
        </div>
      </a>
    </div>
    <!-- Item -->
    <div class="col-md-4 col-lg-3">
      <a href="item.php" class="text-decoration-none">
        <div class="card-menu">
          <img src="https://img.icons8.com/ios-filled/50/2e7d32/box.png"/>
          <h4>Item</h4>
          <p>Kelola barang & perlengkapan</p>
        </div>
      </a>
    </div>
    <!-- Transaksi -->
    <div class="col-md-4 col-lg-3">
      <a href="transaction.php" class="text-decoration-none">
        <div class="card-menu">
          <img src="https://img.icons8.com/ios-filled/50/2e7d32/transaction-list.png"/>
          <h4>Transaksi</h4>
          <p>Catat & proses transaksi</p>
        </div>
      </a>
    </div>
    <!-- Petugas -->
    <div class="col-md-4 col-lg-3">
      <a href="petugas.php" class="text-decoration-none">
        <div class="card-menu">
          <img src="https://img.icons8.com/ios-filled/50/2e7d32/admin-settings-male.png"/>
          <h4>Petugas</h4>
          <p>Kelola akun petugas</p>
        </div>
      </a>
    </div>
  </div>

  <br><br>

  <div class="text-center logout-btn">
    <a href="logout.php" class="btn btn-danger px-4">Logout</a>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
