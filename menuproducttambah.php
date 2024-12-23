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

$title = 'Tambah Produk';

include 'layout/header.php';

// cek apakah  
if (isset($_POST['tambah'])) {
    if (create_produk($_POST) > 0) {
        echo "<script>
                alert('Produk Berhasil Ditambahkan')
                document.location.href = 'menuproduct.php'
              </script> ";
    } else {
        echo "<script>
                alert('Produk Gagal Ditambahkan')
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
                    <h1 class="m-0">Tambah Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="menuproduct.php">Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
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

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto Produk..."
                        onchange="previewImg()">

                    <img src="" alt="" class="img-thumbnail img-preview mt-2" width="300">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk..." required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        placeholder="Deskripsi Produk..." required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori Produk</label>
                    <select name="kategori" id="ketagori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Undangan Digital">Undangan Digital</option>
                        <option value="Korek Api">Korek Api</option>
                        <option value="Sticker Vinyl">Sticker Vinyl</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Produk..."
                        required>
                </div>

                <button type="submit" name="tambah" class="btn btn-primary" style="float: right">Tambah</button>
            </form>
        </div>
    </section>
</div>

<script>

    // logika preview image
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview')

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload =function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>