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

$title = 'Daftar Produk';

include 'layout/header.php';

$data_produk = select("SELECT * FROM produk ORDER BY id_produk ASC");

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
                    <h1 class="m-0">Produk</h1>
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

                                        <!-- codingan untuk tabel produk -->
                                        <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2): ?>
                                            <a href="menuproducttambah.php" class="btn btn-primary btn-sm mb-2">
                                                <i class="ph-bold ph-plus-circle"></i> Tambah</a>
                                        <?php endif; ?>
                                        
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Deskripsi</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2): ?>
                                                        <th>Aksi</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data_produk as $produk): ?>
                                                    <tr>
                                                        <td> <?= $no++; ?> </td>
                                                        <td>
                                                            <a href="img/product/<?= $produk['foto']; ?> " target="blank">
                                                                <img src="img/product/<?= $produk['foto']; ?>"
                                                                    alt="Foto Produk" width="100">
                                                            </a>
                                                        </td>
                                                        <td> <?= $produk['nama']; ?> </td>
                                                        <td> <?= $produk['deskripsi']; ?> </td>
                                                        <td> <?= $produk['kategori']; ?> </td>
                                                        <td>Rp. <?= number_format($produk['harga'], 0, ',', '.'); ?></td>
                                                        <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2): ?>
                                                            <td width="20%" class="text-left">
                                                                <a href="menuproductubah.php?id_produk=<?= $produk['id_produk']; ?>#"
                                                                    class="btn btn-success btn-sm"> <i class="fas fa-edit"></i>
                                                                    Ubah</a>

                                                                <a href="menuproducthapus.php?id_produk=<?= $produk['id_produk']; ?>"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Apakah Anda Yakin Ingin Mneghapus Produk Ini')">
                                                                    <i class="ph-bold ph-trash"></i> Hapus</a>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

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