<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../toko.php">
    <div class="sidebar-brand-icon rotate-n-10">
      <i class="fa-solid fa-school"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Absensi Sekolah</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <?php if ($_SESSION['level'] == 'Admin') :  ?>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
      <a class="nav-link" href="daftar-kelas.php">
        <i class="fa-solid fa-school"></i>
        <span>Data Kelas</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
      <a class="nav-link" href="daftar-siswa.php">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>Data Siswa</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
      <a class="nav-link" href="daftar-officer.php">
        <i class="fa-solid fa-user-gear me-3"></i>
        <span>Data Officer</span></a>
    </li>
  <?php endif; ?>
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - daftar pegawai -->
  <li class="nav-item">
    <a class="nav-link" href="daftar-absen.php">
      <i class="fa-solid fa-book"></i>
      <span>Data Absensi</span></a>
  </li>
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="setting.php">
      <i class="fas fa-cogs fa-sm fa-fw"></i>
      <span>Setting</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <li class="nav-item">
    <a class="nav-link" href="keluar.php" data-toggle="modal" data-target="#logoutModal">
      <i class="fa-solid fa-right-from-bracket"></i>
      <span>Log Out</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apakah Anda Yakin Ingin Keluar?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="keluar.php">Logout</a>
      </div>
    </div>
  </div>
</div>