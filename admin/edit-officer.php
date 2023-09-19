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
  if (ubahOfficer($_POST) > 0) {
    echo '<script>alert("Ubah Data Officer Berhasil")</script>';
    echo '<script>window.location = "daftar-officer.php"</script>';
  } else {
    echo "<script>alert('Tidak Ada data Yang Diubah')</script>";
    echo '<script>window.location = "daftar-officer.php"</script>';
    echo mysqli_error($conn);
  }
}
$id = $_GET['admin_id'];
$select = query("SELECT * FROM tb_admin WHERE admin_id = $id")[0];
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
              <h3 class="mt-4 mb-3 text-dark">Ubah Data Officer</h3>
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
                        <label for="">Nama Officer</label>
                        <input type="text" maxlength="125" class="form-control" id="validationCustom02" name="nama" value="<?= $select['admin_name']; ?>" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a nama officer.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Email</label>
                        <input type="email" maxlength="125" class="form-control" id="validationCustom02" name="email" value="<?= $select['email']; ?>" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a nama email.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Password</label>
                        <input type="text" maxlength="125" class="form-control" id="validationCustom02" name="password" value="<?= $select['password']; ?>" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                        <div class="invalid-feedback">
                          Please choose a nama password.
                        </div>
                      </div>
                      <div class="form-group mt-3">
                        <label for="">Level</label>
                        <select name="level" id="" class="form-control" id="validationCustom02" required>
                          <option value="">--PILIH--</option>
                          <option value="Admin" <?= ($select['level'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                          <option value="Petugas" <?= ($select['level'] == 'Petugas') ? 'selected' : ''; ?>>Petugas</option>
                        </select>
                      </div>
                      <img src="foto/<?php echo $select['foto']; ?>" width=" 70px" height="70px" class="mt-3 ml-3">
                      <div class="form-group mt-2">
                        <input type="hidden" name="fotoLama" value="<?php echo $select['foto']; ?>">
                        <input type="hidden" name="admin_id" value="<?php echo $select['admin_id']; ?>">
                        <input type="file" class="form-control-file mt-2" name="foto">
                        <small>Masukkan foto 3X4 dengan ukuran maksimal 2 MB</small>
                      </div>
                      <button type="submit" name="ubah" class="btn btn-info mt-4 mb-1 float-right text-white" name="submit">Ubah</button>
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