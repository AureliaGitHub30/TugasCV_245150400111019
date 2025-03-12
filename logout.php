<?php
// Hapus semua cookie dengan mengatur waktu kedaluwarsa di masa lalu
setcookie("nama", "", time() - 3600, "/");
setcookie("pekerjaan", "", time() - 3600, "/");
setcookie("ttl", "", time() - 3600, "/");
setcookie("email", "", time() - 3600, "/");
setcookie("no_hp", "", time() - 3600, "/");
setcookie("tahun_sma", "", time() - 3600, "/");
setcookie("sma", "", time() - 3600, "/");
setcookie("gpa_sma", "", time() - 3600, "/");
setcookie("tahun_pt", "", time() - 3600, "/");
setcookie("pt", "", time() - 3600, "/");
setcookie("gpa_pt", "", time() - 3600, "/");

// Redirect ke index.php
header("Location: index.php");
exit;
?>
