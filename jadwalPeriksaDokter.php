<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['nip'])) {
  // Jika pengguna sudah login, tampilkan tombol "Logout"
  header("Location: dashboardDokter.php?page=loginDokter");
  exit;
}

if (isset($_POST['simpan'])) {
  $id_dokter = $_SESSION['id'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];
  $status = 1;

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $mysqli->prepare("UPDATE jadwal_periksa SET id_dokter=?, hari=?, jam_mulai=?, jam_selesai=?, status=? WHERE id=?");
    $stmt->bind_param("isssii", $id_dokter, $hari, $jam_mulai, $jam_selesai, $status, $id);

    if ($stmt->execute()) {
      echo "
                    <script> 
                        alert('Berhasil mengubah data.');
                        document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
                    </script>
                ";
    } else {
      echo "
                    <script> 
                        alert('Gagal mengubah data.');
                        document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
                    </script>
                ";
    }

    $stmt->close();
  } else {
    $stmt = $mysqli->prepare("INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $id_dokter, $hari, $jam_mulai, $jam_selesai, $status);

    if ($stmt->execute()) {
      echo "
                    <script> 
                        alert('Berhasil menambah data.');
                        document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
                    </script>
                ";
    } else {
      echo "
                      <script> 
                          alert('Gagal mengubah data.');
                          document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
                      </script>
                ";
    }

    $stmt->close();
  }
}

if (isset($_POST['id_status']) && isset($_POST['status_update'])) {
  $id = $_POST['id_status'];
  $newStatus = $_POST['status_update'];

  $stmtToggle = $mysqli->prepare("UPDATE jadwal_periksa SET status=? WHERE id=?");
  $stmtToggle->bind_param("ii", $newStatus, $id);

  if ($stmtToggle->execute()) {
    echo "<script> 
                  alert('Berhasil mengubah status.');
                  document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
              </script>";
  } else {
    echo "<script> 
                  alert('Gagal mengubah status: " . mysqli_error($mysqli) . "');
                  document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
              </script>";
  }

  $stmtToggle->close();
}

if (isset($_POST['id'])) {
  // If editing an existing schedule, retrieve the current status
  $stmtStatus = $mysqli->prepare("SELECT status FROM jadwal_periksa WHERE id = ?");
  $stmtStatus->bind_param("i", $_POST['id']);
  $stmtStatus->execute();
  $stmtStatus->bind_result($status);
  $stmtStatus->fetch();
  $stmtStatus->close();
  echo $stmtStatus;
}

if (isset($_POST['status'])) {
  $status = $_POST['status'];
}

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'hapus') {
    $stmt = $mysqli->prepare("DELETE FROM jadwal_periksa WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);

    if ($stmt->execute()) {
      echo "
                    <script> 
                        alert('Berhasil menghapus data.');
                        document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
                    </script>
                ";
    } else {
      echo "
                    <script> 
                        alert('Gagal menghapus data: " . mysqli_error($mysqli) . "');
                        document.location='dashboardDokter.php?page=jadwalPeriksaDokter';
                    </script>
                ";
    }

    $stmt->close();
  }
}
?>
<main class="jadwalPeriksaDokter">

  <div class="container">

    <div class="container">
      <div class="card">
        <div class="card-title">
          <h5 class="card-title">Tambah Data Jadwal Periksa</h5>
        </div>
        <div class="mdl-card__supporting-text">
          <form action="" method="POST" onsubmit="return(validate());">
            <?php
            $id_dokter = '';
            $hari = '';
            $jam_mulai = '';
            $jam_selesai = '';
            if (isset($_GET['id'])) {
              $get = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa 
                                WHERE id='" . $_GET['id'] . "'");
              while ($row = mysqli_fetch_array($get)) {
                $id_dokter = $row['id_dokter'];
                $hari = $row['hari'];
                $jam_mulai = $row['jam_mulai'];
                $jam_selesai = $row['jam_selesai'];
              }
            ?>
              <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone form__article">
                <div class="">
                  <label for="id_dokter">Dokter <span class="text-danger">*</span></label>
                  <select disabled class="form-select" name="id_dokter" aria-label="id_dokter">
                    <option value="" selected>Pilih Dokter...</option>
                    <?php
                    $id_dokter = $_SESSION['id'];

                    $result = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id");

                    while ($data = mysqli_fetch_assoc($result)) {
                      $selected = ($data['id'] == $id_dokter) ? 'selected' : ''; // If the doctor id matches the session id, mark it as selected
                      echo "<option $selected value='" . $data['id'] . "'>" . $data['nama'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="">
                  <label for="hari">Hari <span class="text-danger">*</span></label>
                  <select class="form-select" name="hari" aria-label="hari">
                    <option value="" selected>Pilih Hari...</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jum'at</option>
                    <option value="Sabtu">Sabtu</option>
                  </select>
                </div>
                <div class="mb-3 w-25">
                  <label for="jam_mulai">Jam Mulai <span class="text-danger">*</span></label>
                  <input type="time" name="jam_mulai" class="form-control" required value="<?php echo $jam_mulai ?>">
                </div>
                <div class="mb-3 w-25">
                  <label for="jam_selesai">Jam Selesai <span class="text-danger">*</span></label>
                  <input type="time" name="jam_selesai" class="form-control" required value="<?php echo $jam_selesai ?>">
                </div>
                <li class="mdl-list__item">
                  <button type="submit" name="simpan" class="btn btn-primary">
                    Tambah
                  </button>
                </li>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="mdl-grid ui-tables">

    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
      <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
          <h1 class="mdl-card__title-text">Tabel Jadwal Periksa</h1>
        </div>
        <div class="mdl-card__supporting-text no-padding">
          <table class="table table-hover text-center">
            <thead>
              <tr>
                <th class="mdl-data-table__cell--non-numeric">NO</th>
                <th class="mdl-data-table__cell--non-numeric">NAMA</th>
                <th class="mdl-data-table__cell--non-numeric">HARI</th>
                <th class="mdl-data-table__cell--non-numeric">Jam Periksa</th>
                <th class="mdl-data-table__cell--non-numeric">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $id_dokter = $_SESSION['id'];

              $result = mysqli_query($mysqli, "SELECT dokter.nama, jadwal_periksa.id, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, jadwal_periksa.status 
                            FROM dokter 
                            JOIN jadwal_periksa ON dokter.id = jadwal_periksa.id_dokter 
                            WHERE dokter.id = $id_dokter");
              $no = 1;
              while ($data = mysqli_fetch_array($result)) :
              ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $data['nama'] ?></td>
                  <td><?php echo $data['hari'] ?></td>
                  <td>
                    <?php
                    echo date('H:i', strtotime($data['jam_mulai']));
                    echo ' - ' . date('H:i', strtotime($data['jam_selesai']));
                    ?>
                  </td>
                  <td>
                    <a class="btn btn-success rounded-pill px-3" href="dashboardDokter.php?page=jadwalPeriksaDokter&id=<?php echo $data['id'] ?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="dashboardDokter.php?page=jadwalPeriksaDokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                  </td>
                  <td>
                    <?php
                    $statusText = ($data['status'] == 1) ? 'Aktif' : 'Non-Aktif';
                    $buttonClass = ($data['status'] == 1) ? 'btn-success' : 'btn-danger';
                    $toggleStatus = ($data['status'] == 1) ? 0 : 1;
                    ?>
                    <form action="" method="POST">
                      <input type="hidden" name="id_status" value="<?php echo $data['id'] ?>">
                      <input type="hidden" name="status_update" value="<?php echo $toggleStatus ?>">
                      <button type="submit" class="btn <?php echo $buttonClass ?> rounded-pill px-3">
                        <?php echo $statusText ?>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>


</main>