<?php
// read_inc.php
require 'koneksi.php';

// ambil data buku tamu
$sql   = "SELECT cid, cnama, cemail, cpesan, created_at FROM tbl_tamu ORDER BY cid DESC";
$query = mysqli_query($conn, $sql);
if (!$query) {
    echo "Query error: " . mysqli_error($conn);
    exit;
}

$flash_error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_error']);
?>

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
    <th>Nama</th>
    <th>Email</th>
    <th>Pesan</th>
    <th>Created At</th>
  </tr>

  <?php
  $no = 1;
  while ($row = mysqli_fetch_assoc($query)):
      $cid   = (int)$row['cid'];          // ID primary key
      $nama  = $row['cnama'];
      $email = $row['cemail'];
      $pesan = $row['cpesan'];
      $tgl   = $row['created_at'];
  ?>
    <tr>
      <td><?= $no++; ?></td>

      <!-- PENTING: kirim cid, BUKAN id -->
      <td>
        <a href="edit.php?cid=<?= $cid; ?>">Edit</a>
        |
        <a href="delete.php?cid=<?= $cid; ?>"
           onclick="return confirm('Yakin ingin menghapus data ini?');">
           Delete
        </a>
      </td>

      <td><?= $cid; ?></td>
      <td><?= htmlspecialchars($nama); ?></td>
      <td><?= htmlspecialchars($email); ?></td>
      <td><?= htmlspecialchars($pesan); ?></td>
      <td><?= htmlspecialchars($tgl); ?></td>
    </tr>
  <?php endwhile; ?>

  <?php if (mysqli_num_rows($query) === 0): ?>
    <tr>
      <td colspan="7" align="center">Belum ada data.</td>
    </tr>
  <?php endif; ?>
</table>
