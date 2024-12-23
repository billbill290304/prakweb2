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

// membatasi halaman sesuai user login
if ($_SESSION["level"] == 2) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses');
            document.location.href = 'utama.php';
          </script>";
    exit;
}

if ($_SESSION["level"] == 3) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses');
            document.location.href = 'menutentang.php';
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
                    <h1 class="m-0">Data Akun</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <li class="breadcrumb-item active">Data Akun</li>
                    </ol>
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
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Data Barang</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                            data-bs-target="#modalTambah"> <i class="ph-bold ph-plus-circle"></i>
                                            Tambah</button>

                                        <a href="fileexcellakun.php" class="btn btn-success btn-sm mb-2">
                                            <i class="ph-bold ph-file-xls"></i> Unduh Excell</a>

                                        <a href="filepdfakun.php" class="btn btn-danger btn-sm mb-2">
                                            <i class="ph-bold ph-file-pdf"></i> Unduh PDF</a>

                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Level</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data_akun as $akun): ?>
                                                    <tr>
                                                        <td> <?= $no++; ?> </td>
                                                        <td> <?= $akun['nama']; ?> </td>
                                                        <td> <?= $akun['username']; ?> </td>
                                                        <td> <?= $akun['email']; ?> </td>
                                                        <td>Password Ter-enkripsi</td>
                                                        <td> <?= $akun['level']; ?> </td>

                                                        <td width="15%" class="text-left">
                                                            <button type="buttpn" class="btn btn-success mb-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"> <i
                                                                    class="fas fa-edit"></i> Ubah</button>

                                                            <button type="button" class="btn btn-danger mb-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalHapus<?= $akun['id_akun']; ?>"> <i
                                                                    class="ph-bold ph-trash"></i> Hapus</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Modal Tambah -->
                                    <div class="modal fade" id="modalTambah" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <div class="mb-3">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama" id="nama"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" id="username"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="password">Password</label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control" required minlength="6">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="level">Level</label>
                                                            <select name="level" id="level" class="form-control"
                                                                required>
                                                                <option value="">-- pilih level --</option>
                                                                <option value="1">Admin</option>
                                                                <option value="2">Operator Barang</option>
                                                                <option value="3">User</option>
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" name="tambah"
                                                        class="btn btn-primary">Tambah</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Ubah -->
                                    <?php foreach ($data_akun as $akun): ?>
                                        <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id_akun"
                                                                value="<?= $akun['id_akun']; ?>">
                                                            <div class="mb-3">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" name="nama" id="nama"
                                                                    class="form-control" value="<?= $akun['nama']; ?>"
                                                                    required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="username">Username</label>
                                                                <input type="text" name="username" id="username"
                                                                    class="form-control" value="<?= $akun['username']; ?>"
                                                                    required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="email">Email</label>
                                                                <input type="email" name="email" id="email"
                                                                    class="form-control" value="<?= $akun['email']; ?>"
                                                                    required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="password">Password <small>(Masukkan password
                                                                        baru/lama)</small></label>
                                                                <input type="password" name="password" id="password"
                                                                    class="form-control" required minlength="6">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="level">Level</label>
                                                                <select name="level" id="level" class="form-control"
                                                                    required>
                                                                    <?php $level = $akun['level']; ?>
                                                                    <option value="1" <?= $level == '1' ? 'selected' : null ?>>
                                                                        Admin</option>
                                                                    <option value="2" <?= $level == '2' ? 'selected' : null ?>>
                                                                        Operator Barang</option>
                                                                    <option value="3" <?= $level == '3' ? 'selected' : null ?>>
                                                                        User</option>
                                                                </select>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" name="ubah"
                                                            class="btn btn-success">Ubah</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Modal Hapus -->
                                    <?php foreach ($data_akun as $akun): ?>
                                        <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Yakin Ingin Menghapus Akun : <?= $akun['nama'] ?> .? </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <a href="akunhapus.php?id_akun=<?= $akun['id_akun']; ?>"
                                                            class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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