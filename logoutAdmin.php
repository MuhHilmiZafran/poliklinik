<?php
session_start();
if (isset($_SESSION['username']) ) {
    // Hapus session untuk username
    unset($_SESSION['username']);
 
}

header("Location: index.php");
exit();
?>