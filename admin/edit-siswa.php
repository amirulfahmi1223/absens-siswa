<?php
//bisa menggunakan include atau require
session_start();

include '../funcition.php';
//cek kalo gada session login maka blm login
//kembalikan ke login
//jika tidak ada session[login] maka tendang ke login.php
if (!isset($_SESSION["login"])) {
  echo '<script>window.location="../login.php"</script>';
}
//cek jika tidak admin
if ($_SESSION["level"] != 'Admin') {
  echo "<script>alert('Akses Ditolak Anda Bukan Admin')</script>";
  echo '<script>window.location="../login.php"</script>';
}
if (isset($_POST['ubah'])) {
  if (ubahSiswa($_POST) > 0) {
    echo "<script>alert('Data Siswa Berhasil DiUbah')</script>";
    echo "<script>window.location = 'daftar-siswa.php'</script>";
  } else {
    echo "<script>alert('Tidak Ada Data Yang Diubah')</script>";
    echo "<script>window.location = 'daftar-siswa.php'</script>";
    echo mysqli_error($conn);
  }
}
$nisn = $_GET['nisn'];
$select = query("SELECT tb_siswa.nisn,tb_siswa.nama_siswa,tb_siswa.absen,
                        tb_siswa.gambar,tb_siswa.jk,tb_siswa.tanggal_lahir,tb_siswa.gambar,
                        tb_siswa.alamat,tb_siswa.status,tb_siswa.password,tb_kelas.id_kelas,tb_kelas.nama_kelas
                        FROM tb_siswa
                        INNER JOIN tb_kelas ON tb_siswa.id_kelas=tb_kelas.id_kelas WHERE nisn = $nisn")[0];
$kelas = query("SELECT * FROM tb_kelas ORDER BY nama_kelas ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administator | Dashboard</title>
  <link rel="icon" type="image/x-icon" href="img/favicon-sekolah.png" />
  <!-- Custom fonts for this template-->
  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="../fontawesome/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- bagian navbar -->
    <?php include 'header.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <h3 class="mt-4 mb-3 text-dark">Ubah Data Siswa</h3>
            </div>
          </form>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama']; ?></span>
                <img class="img-profile rounded-circle" src="foto/<?= $_SESSION["foto"]; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        <main>
          <div class="container-fluid px-4">
            <div class="row">
              <div class="col-md-12 ">
                <div class="card shadow-lg mb-5">
                  <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                      <div class="form-group">
                        <label for="inputAddress">Nisn</label>
                        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" maxlength="12" class="form-control" id="validationCustom04" name="nisn" value="<?= $select['nisn']; ?>" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a nisn.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Nama Lengkap</label>
                        <input type="text" maxlength="125" class="form-control" id="validationCustom02" name="nama" value="<?= $select['nama_siswa']; ?>" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a nama lengkap.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Kelas</label>
                        <select name="kelas" id="" class="form-control" id="validationCustom02" required>
                          <option value="">--PILIH--</option>
                          <?php foreach ($kelas as $row) : ?>
                            <option value="<?= $row['id_kelas'] ?>" <?= ($select['id_kelas'] == $row['id_kelas']) ? 'selected' : ''; ?>><?= $row['nama_kelas'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a kelas.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">No. Absen</label>
                        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" maxlength="5" class="form-control" id="validationCustom04" name="absen" value="<?= $select['absen']; ?>" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a no absen.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Jenis Kelamin</label>
                        <select name="jk" id="" class="form-control" id="validationCustom02" required>
                          <option value="">--PILIH--</option>
                          <option value="Laki-Laki" <?= ($select['jk'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                          <option value="Perempuan" <?= ($select['jk'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a kelas.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="validationCustom02" value="<?= $select['tanggal_lahir']; ?>" name="tgl_lahir" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a tanggal lahir.
                        </div>
                      </div>

                      <div class="form-group mt-3">
                        <label for="">Alamat</label>
                        <textarea name="alamat" cols="30" rows="5" required class="form-control" id="validationCustom02"><?= $select['alamat']; ?></textarea>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a nama alamat.
                        </div>
                      </div>
                      <img src="../image/<?php echo $select['gambar']; ?>" width=" 70px" height="70px" class="ml-3 mt-3">
                      <div class="form-group mt-2">
                        <input type="hidden" name="gambarLama" value="<?php echo $select['gambar']; ?>">
                        <input type="hidden" name="nisn" value="<?php echo $select['nisn']; ?>">
                        <input type="file" class="form-control-file mt-2" name="gambar">
                        <small>Masukkan foto siswa 3X4 dengan ukuran maksimal 2 MB</small>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control" id="validationCustom02" required>
                          <option value="">-- PILIH STATUS --</option>
                          <option value="1" <?= ($select['status'] == 1) ? 'selected' : ''; ?>>AKTIF</option>
                          <option value="0" <?= ($select['status'] == 0) ? 'selected' : ''; ?>>TIDAK AKTIF</option>
                        </select>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a kelas.
                        </div>
                      </div>
                      <button type="submit" name="ubah" class="btn btn-info mt-4 mb-1 float-right text-white">Ubah</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; FahmiCode 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->


  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>