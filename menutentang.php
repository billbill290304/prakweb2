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
                    <h1 class="m-0">Tentang</h1>
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

                                        <!-- codingan untuk menu tentang letakkan dibawah ini -->
                                        <div class="about-section">
                                            <h2>Bill Project Official</h2>
                                            <p>Aplikasi ini adalah sistem manajemen data yang dirancang untuk memudahkan
                                                pengelolaan akun, data pengguna, dan fungsi lainnya. Sistem ini
                                                bertujuan untuk meningkatkan efisiensi dan akurasi dalam pengelolaan
                                                data.</p>
                                        
                                            <h3>Informasi Kontak</h3>
                                            <p>Jika anda ingin memesan jasa desain dan mencetak sticker, silahkan hubungi:</p>
                                                <!-- <li>Email: support@domainanda.com</li> -->
                                                <li>Instagram : <a href="https://www.instagram.com/bill.project.official/" target="blank">bill.project.official</a></li></li>
                                                <li>Shopee : <a href="https://shopee.co.id/bill.project" target="blank">bill.project.official</a></li></li></li>
                                                <li>Whatasapp : <a href="https://wa.me/6287884658331" target="blank">+62 878 8465 8331</a></li>
                                        </div>
                                        <style>
                                            .about-section {
                                                padding: 20px;
                                                
                                                border-radius: 10px;
                                            }

                                            .about-section h2,
                                            .about-section h3 {
                                                margin-top: 0;
                                            }

                                            .about-section ul {
                                                list-style: disc;
                                                padding-left: 20px;
                                            }
                                        </style>


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