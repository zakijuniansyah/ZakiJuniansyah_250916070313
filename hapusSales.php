<?php
require 'koneksi.php';

// ambil id dari URL
$id_sales = $_GET['id'];

// jalankan fungsi hapus
if (hapusSales($id_sales) > 0) {
    echo "<script>
            alert('Data sales berhasil dihapus!');
            document.location.href='sales.php';
          </script>";
} else {
    echo "<script>
            alert('Data sales gagal dihapus!');
            document.location.href='sales.php';
          </script>";
}
?>
