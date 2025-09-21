<?php
require 'koneksi.php';

// ambil id dari URL
$id = $_GET['id'];

// jalankan fungsi hapus
if (hapusCustomer($id) > 0) {
    echo "<script>
            alert('Data customer berhasil dihapus!');
            document.location.href='customer.php';
          </script>";
} else {
    echo "<script>
            alert('Data customer gagal dihapus!');
            document.location.href='customer.php';
          </script>";
}
?>
