<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['nip'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: index.php?page=loginDokter");
    exit;
}
?>