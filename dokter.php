<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=loginAdmin");
    exit;
}

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $id_poli = $_POST['id_poli'];
  $nip = $_POST['nip'];
  $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
  if (isset($_POST['id'])) {
      // $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
      //                                     nama = '$nama',
      //                                     alamat = '$alamat',
      //                                     no_hp = '$no_hp',
      //                                     id_poli = '$id_poli',
      //                                     nip = '$nip',
      //                                     password = '$password'
      //                                     WHERE
      //                                     id = '" . $_POST['id'] . "'");
      $updateQuery = "UPDATE dokter SET 
      nama = '$nama',
      alamat = '$alamat',
      no_hp = '$no_hp',
      id_poli = '$id_poli',
      nip = '$nip'";
  
      if (!empty($_POST['password'])) {
      $updateQuery .= ", password = '$password'";
      }
  
      $updateQuery .= " WHERE id = '" . $_POST['id'] . "'";
  
      $ubah = mysqli_query($mysqli, $updateQuery);
  } else {
      $tambah = mysqli_query($mysqli, "INSERT INTO dokter (nama, alamat, no_hp, id_poli, nip, password) 
                                          VALUES (
                                              '$nama',
                                              '$alamat',
                                              '$no_hp',
                                              '$id_poli',
                                              '$nip',
                                              '$password'
                                          )");
  }
  echo "<script> 
              document.location='dashboard.php?page=dokter';
              </script>";
}

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'hapus') {
      $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
  }

  echo "<script> 
              document.location='dashboard.php?page=dokter';
              </script>";
}
?>
<div class="container">
  <!--Form Input Data-->

  <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $nama = '';
    $alamat = '';
    $no_hp = '';
    $id_poli = '';
    $nip = '';
    $password = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $no_hp = $row['no_hp'];
            $id_poli = $row['id_poli'];
            $nip = $row['nip'];
            
            // Retrieve the existing hashed password
            $existingPassword = $row['password'];
        }
    ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
    <?php
    
    }
    ?>
    <div class="col">
      <label for="inputNama" class="form-label fw-bold">
        Nama
      </label>
      <div>
        <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama"
          value="<?php echo $nama ?>">
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputalamat" class="form-label fw-bold">
        Alamat
      </label>
      <div>
        <input type="text" class="form-control" name="alamat" id="inputalamat" placeholder="alamat"
          value="<?php echo $alamat ?>">
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputNoHp" class="form-label fw-bold">
        Nomor Handphone
      </label>
      <div>
        <input type="text" class="form-control" name="no_hp" id="inputNoHp" placeholder="no_hp"
          value="<?php echo $no_hp ?>">
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputPoli" class="form-label fw-bold">
        Poli
      </label>
      <div>
        <select class="form-select" name="id_poli" id="inputPoli">
          <option value="">Pilih Poli</option>
          <?php
                $poli_result = mysqli_query($mysqli, "SELECT * FROM poli");
                while ($poli_data = mysqli_fetch_array($poli_result)) {
                    $selected = ($poli_data['id'] == $id_poli) ? 'selected' : '';
                    echo "<option value='" . $poli_data['id'] . "' $selected>" . $poli_data['nama_poli'] . "</option>";
                }
                ?>
        </select>
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputNip" class="form-label fw-bold">
        NIP
      </label>
      <div>
        <input type="text" class="form-control" name="nip" id="inputNip" placeholder="NIP" value="<?php echo $nip ?>">
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputPassword" class="form-label fw-bold">
        Password
      </label>
      <div>
        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="password">
      </div>
    </div>
    <div class="col mt-3">
      <div class=col>
        <button type="submit" class="btn btn-primary rounded-pill px-3 mt-auto" name="simpan">Simpan</button>
      </div>
    </div>
  </form>
  <br>
  <br>
  <!-- Table-->
  <table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Nomor Handphone</th>
        <th scope="col">Poli</th>
        <th scope="col">NIP</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
      <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
      <?php
        $result = mysqli_query($mysqli, "SELECT dokter.*, poli.nama_poli AS nama_poli FROM dokter JOIN poli ON dokter.id_poli = poli.id");
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
      <tr>
        <th scope="row"><?php echo $no++ ?></th>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['alamat'] ?></td>
        <td><?php echo $data['no_hp'] ?></td>
        <td><?php echo $data['nama_poli'] ?></td>
        <td><?php echo $data['nip'] ?></td>
        <td>
          <a class="btn btn-success rounded-pill px-3"
            href="dashboard.php?page=dokter&id=<?php echo $data['id'] ?>">Ubah</a>
          <a class="btn btn-danger rounded-pill px-3"
            href="dashboard.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
        </td>
      </tr>
      <?php
        }
        ?>
    </tbody>
  </table>