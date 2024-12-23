<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
  echo "<script>
          alert('Harap Login Terlebih Dahulu');
          document.location.href = 'index.php';
        </script>";
  exit;
}

include 'config/app.php';

// menerima id produk yang dipilih pengguna
$id_produk = (int) $_GET['id_produk'];

if (delete_produk($id_produk) > 0) {
    echo "<script>
            alert('Data Produk Berhasil Dihapus');
            document.location.href = 'menuproduct.php';
          </script>";
} else {
    echo "<script>
            alert('Data Produk Gagal Dihapus');
            document.location.href = 'menuproduct.php';
          </script>";
}

?>
