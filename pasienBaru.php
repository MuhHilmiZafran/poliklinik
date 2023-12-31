<?php
if (!isset($_SESSION)) {
    session_start();
}

function generateNoRM($mysqli)
{
    $date = date('ym');

    // Get the maximum count for the current month and year
    $result = mysqli_query($mysqli, "SELECT MAX(CAST(SUBSTRING(no_rm, 8) AS SIGNED)) as max_count FROM pasien WHERE no_rm LIKE '$date%'");
    $data = mysqli_fetch_assoc($result);
    $maxCount = $data['max_count'];

    $count = ($maxCount === null) ? 1 : $maxCount + 1;
    $formattedCount = sprintf('%03d', $count);
    $no_rm = $date . '-' . $formattedCount;

    return $no_rm;
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $no_ktp = $_POST['no_ktp'];
    $no_rm = generateNoRM($mysqli);

    $tambah = mysqli_query($mysqli, "INSERT INTO pasien (nama, alamat, no_hp, no_ktp, no_rm) 
                                    VALUES (
                                        '$nama',
                                        '$alamat',
                                        '$no_hp',
                                        '$no_ktp',
                                        '$no_rm'
                                    )");

    echo "<script> 
              document.location='index.php?page=pasienBaru';
              </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
              document.location='index.php?page=pasienBaru';
              </script>";
}
?>
<div class="container py-5">
  <div>
    <h2>Pendaftaran Online Pasien Baru</h2>
  </div>
  <!--Form Input Data-->
  <form class="form col" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <div class="col">
      <label for="inputNama" class="form-label fw-bold">
        Nama
      </label>
      <div>
        <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama" value="">
      </div>
    </div>
    <div class="col">
      <label for="inputNoKTP" class="form-label fw-bold">
        No. KTP
      </label>
      <div>
        <input type="text" class="form-control" name="no_ktp" id="inputNoKTP" placeholder="nomot KTP" value="">
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputalamat" class="form-label fw-bold">
        Alamat
      </label>
      <div>
        <input type="text" class="form-control" name="alamat" id="inputalamat" placeholder="alamat" value="">
      </div>
    </div>
    <div class="col mt-1">
      <label for="inputNoHp" class="form-label fw-bold">
        No. Handphone
      </label>
      <div>
        <input type="text" class="form-control" name="no_hp" id="inputNoHp" placeholder="no_hp" value="">
      </div>
    </div>

    <div class="col mt-3">
      <div class=col>
        <button type="submit" class="btn btn-primary rounded-pill px-3 mt-auto" name="simpan">Simpan</button>
      </div>
    </div>
  </form>

</div>