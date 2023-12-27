<?php
session_start();
if (isset($_SESSION['nip'])) {
    // Hapus session untuk nip
    unset($_SESSION['nip']);
}

header("Location: index.php");
exit();
?>