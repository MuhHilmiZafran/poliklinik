<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
  /* Add your custom styles here */
  body {
    background-color: #f8f9fa;
  }

  .header {
    padding: 80px;
    text-align: center;
    background: #343a40;
    color: white;
  }

  .features {
    padding: 50px 0;
    background: #ffffff;
  }

  .feature {
    text-align: center;
  }

  .footer {
    padding: 30px 0;
    text-align: center;
    background: #343a40;
    color: white;
  }
  </style>
</head>

<body>

  <div class="header">
    <h2>Selamat datang di Website Daftar Online Klinik Sejahtera Sentosa</h2>
  </div>

  <div class="features">
    <div class="container">
      <div class="row">
        <div class="col">
          <h3>Login sebagai Dokter</h3>
          <p>Jika anda adalah seorang Dokter silahkan klik link berikut ini.</p>
          <a href="dokterLoginHelper.php" class="text-decoration-none">Login Dokter</a>
        </div>
        <div class="col">
          <h3>Login sebagai Admin</h3>
          <p>Jika anda adalah seorang Admin silahkan klik link berikut ini.</p>
          <a href="adminLoginHelper.php" class="text-decoration-none">Login Admin</a>
        </div>

      </div>
    </div>
  </div>

  < <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>