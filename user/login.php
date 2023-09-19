<?php
//mengembalikan ke dashboard jika sudah login jika belum login
//$_SESSION adalah mekanisme penyimpanan informasi kedalam variabel agar
// $_SESSION['login'] = true;
//bisa digunakan lebih dari satu halaman
session_start();
include '../funcition.php';
// //cek cookei login
// if (isset($_COOKIE['login'])) {
//   //cek value
//   if ($_COOKIE['login'] == 'true') {
//     //set session true
//     $_SESSION['login'] = true;
//   }
// }
//kalo ada $_SESSION['login'] / kalo sudah login maka kembalikan ke index
//jika ada session[login]
if (isset($_SESSION["siswa"])) {
  echo '<script>window.location="index.php"</script>';
}

if (isset($_POST["login"])) {
  $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  //cek akun ada apa tidak
  //PENGGUNAAN INNER JOIN YANG BENAR BEGITU JUGA LEFT AND RIGHT
  $cek = mysqli_query($conn, "SELECT * FROM tb_siswa INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_siswa.nisn = '" . $nisn . "' AND tb_siswa.password = '" . $password . "' ");
  //cek validasi login
  if (mysqli_num_rows($cek) > 0) {
    $a = mysqli_fetch_object($cek);
    $_SESSION['siswa'] = true;
    $_SESSION['nisn'] = $a->nisn;
    $_SESSION['nama'] = $a->nama_siswa;
    $_SESSION['jk'] = $a->jk;
    $_SESSION['kelas'] = $a->id_kelas;
    $_SESSION['nm_kelas'] = $a->nama_kelas;
    $_SESSION['absen'] = $a->absen;
    $_SESSION['status'] = $a->status;

    //$_COOKEI sendiri untuk menyimpan data user untuk beberapa waktu
    //ada waktu kadarulasa

    echo '<script>alert("Login Berhasil")</script>';
    echo '<script>window.location="index.php"</script>';
  } else {
    echo '<script>alert("Gagal, nisn atau password salah")</script>';
  }
}
//untuk password_verify,password_hash
// session_start();
// require 'funcition.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <link rel="stylesheet" href="../style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="overlay"></div>
  <form action="" method="POST" class="box">
    <div class="header">
      <h3>Login To Student</h3>
      <p> "Pendidikan adalah senjata paling ampuh yang dapat kamu gunakan untuk mengubah dunia." - Nelson Mandela</p>
    </div>
    <div class="login-area">
      <input type="number" name="nisn" class="username" placeholder="Masukkan Username">
      <input type="password" name="password" class="password" placeholder="Masukkan Password">
      <input type="submit" name="login" value="Login" class="submit">
      <a href="registrasi.php">Belum Register?</a>
    </div>
  </form>
</body>

</html>