<?php
session_start();
unset($_SESSION['siswa']);
echo '<script>window.location="login.php"</script>';
