<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  if (isset($_POST['id'])) {
    $updateQuery = "UPDATE user SET 
    nama = '$nama',
    username = '$username'";

    if (!empty($password)) {
    $updateQuery .= ", password = '$password'";
    }

    $updateQuery .= " WHERE id = '" . $_POST['id'] . "'";

    $ubah = mysqli_query($mysqli, $updateQuery);
  } else {
      $tambah = mysqli_query($mysqli, "INSERT INTO user (nama, username, password) 
                                        VALUES (
                                            '$nama',
                                            '$username',
                                            '$password'
                                        )");
  }
  echo "<script> 
            document.location='dashboard.php?page=registerAdmin';
            </script>";
}

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'hapus') {
      $hapus = mysqli_query($mysqli, "DELETE FROM user WHERE id = '" . $_GET['id'] . "'");
  }

  echo "<script> 
            document.location='dashboard.php?page=registerAdmin';
            </script>";
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
                document.location='dashboard.php?page=registerAdmin';
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
          <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
            <!-- Kode php untuk menghubungkan form dengan database -->
            <?php
            $nama = '';
            $username = '';
            $password = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, "SELECT * FROM user 
                        WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $username = $row['username'];
                    $password = $row['password'];
                }
            ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
            }
            ?>
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
              <label for="nama">Nama</label>
              <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama anda"
                value="<?php echo $nama ?>">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" required placeholder="Masukkan Username anda"
                value="<?php echo $username ?>">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control"
                <?php echo isset($_GET['id']) ? '' : 'required'; ?> placeholder="Masukkan password">
            </div>

            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control"
                <?php echo isset($_GET['id']) ? '' : 'required'; ?> placeholder="Masukkan password konfirmasi">
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary btn-block" name="simpan">Simpan</button>
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
        <th scope="col">Username</th>
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
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['username'] ?></td>

        <td>
          <a class="btn btn-success rounded-pill px-3"
            href="dashboard.php?page=registerAdmin&id=<?php echo $data['id'] ?>">Ubah</a>
          <a class="btn btn-danger rounded-pill px-3"
            href="dashboard.php?page=registerAdmin&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
        </td>
      </tr>
      <?php
            }
            ?>
    </tbody>
  </table>
</div>