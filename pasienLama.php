<?php
if (!isset($_SESSION)) {
  session_start();
}

$showTable = false;
$searchResults = [];

if (isset($_POST['cari'])) {
  $no_ktp = $_POST['searchTerm']; // Update the array key here
  // Check if the No KTP already exists
  $checkNoKTP = mysqli_query($mysqli, "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'");
  if (mysqli_num_rows($checkNoKTP) > 0) {
      $showTable = true;
      // Fetch the rows that match the entered No KTP
      $searchResults = mysqli_query($mysqli, "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'");
  } else {
      // No KTP doesn't exist, show an alert
      echo "<script>alert('No KTP Belum terdaftar. Pasien dengan No KTP tersebut tidak dapat mendaftar Poliklinik.');</script>";
  }
}
?>

<div class="container py-5">
  <!-- Add a search form -->
  <div class="card mx-auto mt-5">
    <div class="card-body">
      <h5 class="card-title">Pencarian No. RM</h5>
      <p>Jika anda sudah mendaftar, masukkan No. KTP untuk melihat No. RM.</p>
      <form class="form" method="POST" action="" name="searchForm">
        <div class="mb-3">
          <label for="inputSearch" class="form-label fw-bold">No. KTP</label>
          <div class="input-group">
            <input type="text" class="form-control" name="searchTerm" id="inputSearch" placeholder="Masukkan No. KTP">
            <button type="submit" class="btn btn-primary rounded-pill mx-3" name="cari">Cari</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <!-- Display the table only if the search button is clicked and there is no search error -->
  <?php if ($showTable): ?>
  <!-- Table-->
  <table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">No. KTP</th>
        <th scope="col">No. Handphone</th>
        <th scope="col">No. RM</th>
      </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
      <?php
            $no = 1;
            while ($data = mysqli_fetch_array($searchResults)) {
            ?>
      <tr>
        <th scope="row"><?php echo $no++ ?></th>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['alamat'] ?></td>
        <td><?php echo $data['no_ktp'] ?></td>
        <td><?php echo $data['no_hp'] ?></td>
        <td><?php echo $data['no_rm'] ?></td>
      </tr>
      <?php
            }
            ?>
    </tbody>
  </table>

  <?php endif; ?>
</div>