<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = $mysqli->query($query);

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan";
    }
}
?>

<section class="vh-100" style="background-color: #ffffff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 ">
            <h3 class="mb-5 text-center">Hello, Admin</h3>
            <form method="POST" action="index.php?page=loginAdmin">
              <?php
                            if (isset($error)) {
                                echo '<div class="alert alert-danger">' . $error . '
                                    </div>';
                            }
                            ?>
              <div class="form-outline mb-4">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" class="form-control form-control-lg" required
                  placeholder="Masukkan nama anda" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" required
                  placeholder="Masukkan password anda" />
              </div>

              <div class="d-flex justify-content-center">
                <button class="btn btn-primary btn-lg btn-block px-5" type="submit">Login</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>