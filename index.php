<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("koneksi.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Klinik Sejahtera Sentosa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Klinik Sejahtera Sentosa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?page=pasienLama">Pasien Lama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?page=pasienBaru">Pasien Baru</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?page=daftarPoliklinik">Daftar Poliklinik</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <main role="main">
    <?php

        if (isset($_GET['page'])) {
            include($_GET['page'] . ".php");
        } else {
           include("landingPage.php");
        }
        ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
</body>

</html>