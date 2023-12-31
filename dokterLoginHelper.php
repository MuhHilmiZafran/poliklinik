<?php
session_start();

// Check if the 'nip' session is set
if (isset($_SESSION['nip'])) {
  header("Location: dashboardDokter.php");
  exit();
} else {
  // If 'nip' session is not set, redirect to the login page
  header("Location: index.php?page=loginDokter");
  exit();
}
?>