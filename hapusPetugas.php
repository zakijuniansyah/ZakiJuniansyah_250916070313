<?php
require 'koneksi.php';

// ambil id dari URL
$id_user = $_GET['id'];

// eksekusi hapus petugas
if (hapusPetugas($id_user) > 0) {
    echo "<script>
            alert('Petugas berhasil dihapus!');
            document.location.href='petugas.php';
          </script>";
} else {
    echo "<script>
            alert('Petugas gagal dihapus!');
            document.location.href='petugas.php';
          </script>";
}
?>
