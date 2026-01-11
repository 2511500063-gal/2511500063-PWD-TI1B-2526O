<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';


  $sql = "SELECT * FROM biodata_mahasiswa ORDER BY cid DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>


<?php
  // TAMBAHAN: ambil juga flash_sukses_bio dari proses update
  $flash_sukses_bio = $_SESSION['flash_sukses_bio'] ?? '';

  $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
  $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error

  // TAMBAHAN: kalau ada pesan dari update, gabungkan ke flash_sukses
  if ($flash_sukses_bio !== '') {
    $flash_sukses = trim($flash_sukses . ' ' . $flash_sukses_bio);
  }

  #bersihkan session ini
  unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['flash_sukses_bio']); 
?>


<?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
<?php endif; ?>


<?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
<?php endif; ?>


<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Nim</th>
    <th>Nama Lengkap</th>
    <th>Tempat Lahir</th>
    <th>Tanggal Lahir</th>
    <th>Hobi</th>
    <th>Pasangan</th>
    <th>Pekerjaan</th>
    <th>Nama Orang Tua</th>
    <th>Nama Kakak</th>
    <th>Nama Adik</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit_biodata.php?cid=<?= (int)$row['cid']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['nama_lengkap']); ?>?')" href="biodata_delete.php?cid=<?= (int)$row['cid']; ?>">Delete</a>
      </td>
      <td><?= $row['cid']; ?></td>
      <td><?= htmlspecialchars($row['nim']); ?></td>
      <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
      <td><?= htmlspecialchars($row['tempat_lahir']); ?></td>
      <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
      <td><?= htmlspecialchars($row['hobi']); ?></td>
      <td><?= htmlspecialchars($row['pasangan']); ?></td>
      <td><?= htmlspecialchars($row['pekerjaan']); ?></td>
      <td><?= htmlspecialchars($row['nama_orang_tua']); ?></td>
      <td><?= htmlspecialchars($row['nama_kakak']); ?></td>
      <td><?= htmlspecialchars($row['nama_adik']); ?></td>
      <td><?= formatTanggal(htmlspecialchars($row['dcreated_at'])); ?></td>
    </tr>
  <?php endwhile; ?>
</table>
