<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

/* Cek method: boleh GET karena hanya dari link */
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if ($cid === false || $cid === null) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('read.php');
}

/* Hapus data */
$sql  = "DELETE FROM tbl_tamu WHERE cid = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('read.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['flash_sukses'] = 'Data berhasil dihapus.';
} else {
  $_SESSION['flash_error'] = 'Data gagal dihapus. Silakan coba lagi.';
}

mysqli_stmt_close($stmt);
redirect_ke('read.php');
