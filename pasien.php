<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['username'])) {
  header("Location: index.php?page=loginAdmin");
  exit;
}

?>

<div>
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
      <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
      <?php
        $result = mysqli_query($mysqli, "SELECT * FROM pasien");
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
        <td>
          <a class="btn btn-danger rounded-pill px-3"
            href="index.php?page=pasienBaru&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
        </td>
      </tr>
      <?php
        }
        ?>
    </tbody>
  </table>
</div>