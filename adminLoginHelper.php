<?php
session_start();

// Check if the 'nip' session is set
if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
  exit();
} else {
  // If 'nip' session is not set, redirect to the login page
  header("Location: index.php?page=loginAdmin");
  exit();
}
?>