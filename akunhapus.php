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

// menerima id barang yang dipilih pengguna
$id_akun = (int) $_GET['id_akun'];

if (delete_akun($id_akun) > 0) {
    echo "<script>
            alert('Data Akun Berhasil Dihapus');
            document.location.href = 'akun.php';
          </script>";
} else {
    echo "<script>
            alert('Data Akun Gagal Dihapus');
            document.location.href = 'akun.php';
          </script>";
}

?>
