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

$title = 'Ubah Produk';

include 'layout/header.php';

// mengambil id_produk dari url
$id_produk = (int) $_GET['id_produk'];

$produk = select("SELECT * FROM produk WHERE id_produk = $id_produk")[0];

// cek apakah  
if (isset($_POST['ubah'])) {
    if (update_produk($_POST) > 0) {
        echo "<script>
                alert('Produk Berhasil Diubah')
                document.location.href = 'menuproduct.php'
              </script> ";
    } else {
        echo "<script>
                alert('Produk Gagal Diubah')
                document.location.href = 'menuproduct.php'
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
                    <h1 class="m-0">Ubah Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="menuproduct.php">Produk</a></li>
                        <li class="breadcrumb-item active">Ubah Produk</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                <input type="hidden" name="fotoLama" value="<?= $produk['foto']; ?>">

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto Produk...">
                    <p>
                        <small>Gambar Sebelumnya</small>
                    </p>
                    <img src="img/product/<?= $produk['foto']; ?>" alt="foto"
                         width="300">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk..." required
                        value="<?= $produk['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        placeholder="Deskripsi Produk..." required value="<?= $produk['deskripsi']; ?>">
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori Produk</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <?php $kategori = $produk['kategori']; ?>
                        <option value="Undangan Digital" <?= $kategori == 'Undangan Digital' ? 'selected' : ''; ?>>Undangan
                            Digital</option>
                        <option value="Korek Api" <?= $kategori == 'Korek Api' ? 'selected' : ''; ?>>Korek Api</option>
                        <option value="Sticker Vinyl" <?= $kategori == 'Sticker Vinyl' ? 'selected' : ''; ?>>Sticker Vinyl
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Produk..."
                        required value="<?= $produk['harga']; ?>">
                </div>

                <button type="submit" name="ubah" class="btn btn-success" style="float: right">Ubah</button>
            </form>
        </div>
    </section>
</div>

<?php include 'layout/footer.php'; ?>