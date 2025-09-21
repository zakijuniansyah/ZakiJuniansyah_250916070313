<?php
require 'koneksi.php';

// ambil data sales & item untuk dropdown
$sales  = query("SELECT s.id_sales, s.do_number, c.nama 
                 FROM sales s JOIN customer c ON s.id_customer = c.id");
$items  = query("SELECT * FROM item");

// cek tombol tambah temp
if (isset($_POST['tambah'])) {
    if (tambahTemp($_POST) > 0) {
        echo "<script>alert('Item ditambahkan ke keranjang sementara!');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan item!');</script>";
    }
}

// cek tombol simpan transaksi
if (isset($_POST['simpan'])) {
    $id_sales = $_POST['id_sales'];
    if (simpanTransaction($id_sales) > 0) {
        echo "<script>
                alert('Transaksi berhasil disimpan!');
                document.location.href='transaksi.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menyimpan transaksi!');</script>";
    }
}

// tampilkan isi keranjang sementara
$temp = [];
if (!empty($_POST['id_sales'])) {
    $id_sales = $_POST['id_sales'];
    $temp = query("
        SELECT t.id_temp, i.nama_item, t.quantity, t.price, t.amount
        FROM transaction_temp t
        JOIN item i ON t.id_item = i.id_item
        WHERE t.id_sales = $id_sales
    ");
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Tambah Transaksi</title>
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
  <h3>Tambah Transaksi Baru</h3>
  <p>APLIKASI PENGADAAN BARANG DAN PERLENGKAPAN RUMAH TANGGA PADA KOPERASI PEGAWAI</p>
</div>

<div class="container mb-5">
  <!-- Form tambah item ke keranjang -->
  <div class="card p-4 shadow mb-4">
    <form action="" method="post">
      <div class="mb-3">
        <label for="id_sales" class="form-label">Pilih Sales</label>
        <select name="id_sales" id="id_sales" class="form-select" required>
          <option value="">-- Pilih Sales --</option>
          <?php foreach($sales as $s): ?>
            <option value="<?= $s['id_sales']; ?>"
              <?= (isset($_POST['id_sales']) && $_POST['id_sales']==$s['id_sales'])?'selected':''; ?>>
              <?= $s['do_number']." - ".$s['nama']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="id_item" class="form-label">Pilih Item</label>
        <select name="id_item" id="id_item" class="form-select" required>
          <option value="">-- Pilih Item --</option>
          <?php foreach($items as $i): ?>
            <option value="<?= $i['id_item']; ?>"><?= $i['nama_item']; ?> (Stok: <?= $i['stok']; ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required>
      </div>
      <button type="submit" name="tambah" class="btn btn-success">+ Tambah ke Keranjang</button>
    </form>
  </div>

  <!-- Tabel keranjang sementara -->
  <div class="card p-4 shadow">
    <h5>Keranjang Transaksi Sementara</h5>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle mt-3">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($temp)): ?>
            <?php $i=1; $grand=0; foreach($temp as $t): $grand+=$t['amount']; ?>
              <tr>
                <td class="text-center"><?= $i++; ?></td>
                <td><?= $t['nama_item']; ?></td>
                <td class="text-center"><?= $t['quantity']; ?></td>
                <td>Rp <?= number_format($t['price'],0,',','.'); ?></td>
                <td>Rp <?= number_format($t['amount'],0,',','.'); ?></td>
              </tr>
            <?php endforeach; ?>
            <tr class="fw-bold">
              <td colspan="4" class="text-end">Grand Total</td>
              <td>Rp <?= number_format($grand,0,',','.'); ?></td>
            </tr>
          <?php else: ?>
            <tr><td colspan="5" class="text-center text-muted">Keranjang masih kosong</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if(!empty($temp)): ?>
      <form action="" method="post">
        <input type="hidden" name="id_sales" value="<?= $id_sales; ?>">
        <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan Transaksi</button>
      </form>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
