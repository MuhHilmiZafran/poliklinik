<?php
if (!isset($_SESSION)) {
  session_start();
}

// Initialize a variable to check if the search button is clicked
$isSearchClicked = false;
$searchErrorMessage = ''; // Initialize an error message variable

// Handle search form submission
if (isset($_POST['search'])) {
    $isSearchClicked = true; // Set the flag to true
    $searchTerm = $_POST['searchTerm'];

    // Check if the search term is not empty
    if (!empty($searchTerm)) {
        // Modify the SQL query to include search criteria
        $searchQuery = "SELECT * FROM pasien 
                        WHERE no_rm LIKE '%$searchTerm%' OR no_ktp LIKE '%$searchTerm%'";
        $result = mysqli_query($mysqli, $searchQuery);
    } else {
        // Set an error message if the search term is empty
        $searchErrorMessage = 'Search term cannot be empty';
    }
}

?>

<!-- Add a search form -->
<form class="form col mb-3" method="POST" action="" name="searchForm">
  <div class="col">
    <label for="inputSearch" class="form-label fw-bold">
      Search by No. RM or No. KTP
    </label>
    <div class="input-group">
      <input type="text" class="form-control" name="searchTerm" id="inputSearch" placeholder="Search term">
      <button type="submit" class="btn btn-primary rounded-pill px-3" name="search">Search</button>
    </div>
    <?php if (!empty($searchErrorMessage)): ?>
    <div class="text-danger"><?php echo $searchErrorMessage; ?></div>
    <?php endif; ?>
  </div>
</form>

<!-- Display the table only if the search button is clicked and there is no search error -->
<?php if ($isSearchClicked && empty($searchErrorMessage) && mysqli_num_rows($result) > 0): ?>
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
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <!--tbody berisi isi tabel sesuai dengan judul atau head-->
  <tbody>
    <?php
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
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
<?php elseif ($isSearchClicked && empty($searchErrorMessage) && mysqli_num_rows($result) == 0): ?>
<!-- Display a message if no data is found -->
<div>No data found</div>
<?php endif; ?>