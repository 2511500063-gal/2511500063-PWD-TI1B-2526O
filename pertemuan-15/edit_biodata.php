<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error_bio'] = 'CID tidak valid.';
  redirect_ke('index.php');
}

/* ambil data lama */
$stmt = mysqli_prepare($conn, "SELECT cid, nim, nama_lengkap, tempat_lahir, tanggal_lahir,
                                      hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik
                               FROM biodata_mahasiswa
                               WHERE cid = ? LIMIT 1");
if (!$stmt) {
  $_SESSION['flash_error_bio'] = 'Query tidak benar.';
  redirect_ke('index.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
  $_SESSION['flash_error_bio'] = 'Record tidak ditemukan.';
  redirect_ke('index.php');
}

/* prefill */
$nim            = $row['nim'] ?? '';
$nama_lengkap   = $row['nama_lengkap'] ?? '';
$tempat_lahir   = $row['tempat_lahir'] ?? '';
$tanggal_lahir  = $row['tanggal_lahir'] ?? '';
$hobi           = $row['hobi'] ?? '';
$pasangan       = $row['pasangan'] ?? '';
$pekerjaan      = $row['pekerjaan'] ?? '';
$nama_orang_tua = $row['nama_orang_tua'] ?? '';
$nama_kakak     = $row['nama_kakak'] ?? '';
$nama_adik      = $row['nama_adik'] ?? '';

$flash_error = $_SESSION['flash_error'] ?? '';
$old         = $_SESSION['old'] ?? [];
unset($_SESSION['flash_error'], $_SESSION['old']);

if (!empty($old)) {
  $nim            = $old['nim']            ?? $nim;
  $nama_lengkap   = $old['nama_lengkap']   ?? $nama_lengkap;
  $tempat_lahir   = $old['tempat_lahir']   ?? $tempat_lahir;
  $tanggal_lahir  = $old['tanggal_lahir']  ?? $tanggal_lahir;
  $hobi           = $old['hobi']           ?? $hobi;
  $pasangan       = $old['pasangan']       ?? $pasangan;
  $pekerjaan      = $old['pekerjaan']      ?? $pekerjaan;
  $nama_orang_tua = $old['nama_orang_tua'] ?? $nama_orang_tua;
  $nama_kakak     = $old['nama_kakak']     ?? $nama_kakak;
  $nama_adik      = $old['nama_adik']      ?? $nama_adik;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Biodata Mahasiswa</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Edit Biodata Mahasiswa</h1></header>

<main>
<section id="biodata">
  <?php if (!empty($flash_error)): ?>
    <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24;">
      <?= $flash_error; ?>
    </div>
  <?php endif; ?>

  <form action="biodata_update.php" method="POST">
    <input type="hidden" name="cid" value="<?= (int)$cid; ?>">

    <label><span>NIM:</span>
      <input type="text" name="nim"
             required
             value="<?= htmlspecialchars($nim, ENT_QUOTES); ?>">
    </label>

    <label><span>Nama Lengkap:</span>
      <input type="text" name="nama_lengkap"
             required
             value="<?= htmlspecialchars($nama_lengkap, ENT_QUOTES); ?>">
    </label>

    <label><span>Tempat Lahir:</span>
      <input type="text" name="tempat_lahir"
             required
             value="<?= htmlspecialchars($tempat_lahir, ENT_QUOTES); ?>">
    </label>

    <label><span>Tanggal Lahir:</span>
      <input type="date" name="tanggal_lahir"
             required
             value="<?= htmlspecialchars($tanggal_lahir, ENT_QUOTES); ?>">
    </label>

    <label><span>Hobi:</span>
      <input type="text" name="hobi"
             value="<?= htmlspecialchars($hobi, ENT_QUOTES); ?>">
    </label>

    <label><span>Pasangan:</span>
      <input type="text" name="pasangan"
             value="<?= htmlspecialchars($pasangan, ENT_QUOTES); ?>">
    </label>

    <label><span>Pekerjaan:</span>
      <input type="text" name="pekerjaan"
             value="<?= htmlspecialchars($pekerjaan, ENT_QUOTES); ?>">
    </label>

    <label><span>Nama Orang Tua:</span>
      <input type="text" name="nama_orang_tua"
             value="<?= htmlspecialchars($nama_orang_tua, ENT_QUOTES); ?>">
    </label>

    <label><span>Nama Kakak:</span>
      <input type="text" name="nama_kakak"
             value="<?= htmlspecialchars($nama_kakak, ENT_QUOTES); ?>">
    </label>

    <label><span>Nama Adik:</span>
      <input type="text" name="nama_adik"
             value="<?= htmlspecialchars($nama_adik, ENT_QUOTES); ?>">
    </label>

    <button type="submit">Update</button>
    <a href="index.php">Kembali</a>
  </form>
</section>
</main>
</body>
</html>
;