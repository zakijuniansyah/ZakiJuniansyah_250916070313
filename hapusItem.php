<?php
require 'koneksi.php';

// ambil id dari URL
$id_item = $_GET['id'];

// eksekusi hapus item
if (hapusItem($id_item) > 0) {
    echo "<script>
            alert('Item berhasil dihapus!');
            document.location.href='item.php';
          </script>";
} else {
    echo "<script>
            alert('Item gagal dihapus!');
            document.location.href='item.php';
          </script>";
}
?>
