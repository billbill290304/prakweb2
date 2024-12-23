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

$title = 'Data Akun';

include 'layout/header.php';

$data_akun = select("SELECT * FROM akun ORDER BY id_akun DESC ");

// jika tombol di tambah tekan jalankan script berikut
if (isset($_POST["tambah"])) {
    if (create_akun($_POST) > 0) {
        echo "<script>
                alert('Data Akun Berhasil Ditambahkan')
                document.location.href = 'akun.php'
              </script> ";
    } else {
        echo "<script>
                alert('Data Akun Gagal Ditambahkan')
                document.location.href = 'akun.php'
              </script> ";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST["ubah"])) {
    if (update_akun($_POST) > 0) {
        echo "<script>
                alert('Data Akun Berhasil Diubah')
                document.location.href = 'akun.php'
              </script> ";
    } else {
        echo "<script>
                alert('Data Akun Gagal Diubah')
                document.location.href = 'akun.php'
              </script> ";
    }
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Galeri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="">
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- <div class="card-header">
                                        <h3 class="card-title">Tabel Data Barang</h3>
                                    </div> -->
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- Gallery -->
                                        <div class="row">

                                            <!-- Kolom 1 -->
                                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                                <img src="img/foto1.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto2.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto3.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto4.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto5.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto6.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />
                                            </div>

                                            <!-- Kolom 2 -->
                                            <div class="col-lg-4 mb-4 mb-lg-0">
                                                <img src="img/foto7.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto8.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto9.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto10.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto11.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto12.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />
                                            </div>

                                            <!-- Kolom 3 -->
                                            <div class="col-lg-4 mb-4 mb-lg-0">
                                                <img src="img/foto13.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto14.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto15.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto16.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto17.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />

                                                <img src="img/foto18.jpg" class="w-100 shadow-1-strong rounded mb-4"
                                                    alt="" />
                                            </div>
                                        </div>
                                        <!-- Gallery -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>