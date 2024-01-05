<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = $mysqli->query($query);

        if ($result === false) {
            die("Query error: " . $mysqli->error);
        }

        if ($result->num_rows == 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($mysqli, $insert_query)) {
                echo "<script>
                alert('Pendaftaran Berhasil'); 
                document.location='index.php?page=loginUser';
                </script>";
            } else {
                $error = "Pendaftaran gagal";
            }
        } else {
            $error = "Username sudah digunakan";
        }
    } else {
        $error = "Password tidak cocok";
    }
}
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center" style="font-weight: bold; font-size: 32px;">Register</div>
        <div class="card-body">
          <form method="POST" action="index.php?page=registerUser">
            <?php
                        if (isset($error)) {
                            echo '<div class="alert alert-danger">' . $error . '
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        }
                        ?>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" required placeholder="Masukkan nama anda">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" required
                placeholder="Masukkan password konfirmasi">
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
          </form>

        </div>

      </div>

    </div>
  </div>
  <br>
  <br>
  <!-- Table-->
  <table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Password</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
      <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
      <?php
            $result = mysqli_query($mysqli, "SELECT * FROM user");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
      <tr>
        <th scope="row"><?php echo $no++ ?></th>
        <td><?php echo $data['username'] ?></td>
        <td><?php echo password_hash($data['password'], PASSWORD_DEFAULT) ?></td>

        <td>
          <a class="btn btn-success rounded-pill px-3"
            href="dashboard.php?page=registerUser&id=<?php echo $data['id'] ?>">Ubah</a>
          <a class="btn btn-danger rounded-pill px-3"
            href="dashboard.php?page=registerUser&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
        </td>
      </tr>
      <?php
            }
            ?>
    </tbody>
  </table>
</div>