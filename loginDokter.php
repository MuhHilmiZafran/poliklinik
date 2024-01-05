<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $query = "SELECT * FROM dokter WHERE nip = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['nip'] = $nip;
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];

            // Redirect to the desired page after successful login
            header("Location: dashboardDokter.php");
            exit();
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "User tidak ditemukan";
    }
}
?>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <div class="d-flex justify-content-center">
          <h2 class="mb-5" style="color: #0047AB;">Welcome Doctor</h2>
        </div>
        <form method="POST" action="index.php?page=loginDokter">
          <?php
                    if (isset($error)) {
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                    ?>
          <!-- NIP input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="nip">NIP</label>
            <input type="text" name="nip" required class="form-control form-control-lg" placeholder="Masukkan NIP" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" required class="form-control form-control-lg"
              placeholder="Masukkan password anda" />
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
            <a href="#!">Forgot password?</a>
          </div>

          <button type="submit" class="btn btn-lg btn-block w-100"
            style="background-color: #0047AB; color: #FFFFFF;">Sign In</button>

        </form>
      </div>
    </div>
  </div>
</section>