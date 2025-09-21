<?php
require 'koneksi.php';

// ambil id transaksi dari URL
$id_transaction = $_GET['id'];

// eksekusi hapus transaksi
if (hapusTransaction($id_transaction) > 0) {
    echo "<script>
            alert('Transaksi berhasil dihapus!');
            document.location.href='transaction.php';
          </script>";
} else {
    echo "<script>
            alert('Transaksi gagal dihapus!');
            document.location.href='transaction.php';
          </script>";
}
?>
