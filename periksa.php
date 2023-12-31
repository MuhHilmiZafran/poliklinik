<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!-- Main content -->
<main id="periksapasien-page">
  <div class="container" style="margin-top: 1.5rem;">
    <div class="row">
      <h2 class="ps-0">Data Pasien Saya</h2>

      <div class="table-responsive mt-3 px-0">
        <table class="table text-center">
          <thead class="table">
            <tr>
              <th valign="middle">No</th>
              <th valign="middle">Nama Pasien</th>
              <th valign="middle">No. Antrian</th>
              <th valign="middle">Keluhan</th>
              <th valign="middle">Hari</th>
              <th valign="middle">Waktu</th>
              <th valign="middle">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $id_dokter = $_SESSION['id'];
            $result = mysqli_query($mysqli, "
            SELECT daftar_poli.*, pasien.nama AS nama, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai
            FROM daftar_poli
            JOIN (
                SELECT id_pasien, MAX(tanggal) as max_tanggal
                FROM daftar_poli
                GROUP BY id_pasien
            ) as latest_poli ON daftar_poli.id_pasien = latest_poli.id_pasien AND daftar_poli.tanggal = latest_poli.max_tanggal
            JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id 
            JOIN pasien ON daftar_poli.id_pasien = pasien.id
            LEFT JOIN periksa ON daftar_poli.id = periksa.id_daftar_poli
            WHERE jadwal_periksa.id_dokter = '$id_dokter' AND periksa.id_daftar_poli IS NULL
            ");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) :
            ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $data['nama'] ?></td>
              <td><?php echo $data['no_antrian'] ?></td>
              <td><?php echo $data['keluhan'] ?></td>
              <td><?php echo $data['hari'] ?></td>
              <td><?php echo $data['jam_mulai'] . " - " . $data['jam_selesai'] ?></td>
              <td>
                <a class="btn btn-success rounded-pill px-3" href="#">Periksa</a>
                <a class="btn btn-danger rounded-pill px-3"
                  href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<!-- /.content -->