<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

/* =====================
   VALIDASI CID
===================== */
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('read.php');
}

/* =====================
   DELETE tbl_tamu
===================== */
$stmtTamu = mysqli_prepare($conn, "DELETE FROM tbl_tamu WHERE cid = ?");
if (!$stmtTamu) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (tbl_tamu prepare gagal).';
    redirect_ke('read.php');
}
mysqli_stmt_bind_param($stmtTamu, "i", $cid);
$successTamu = mysqli_stmt_execute($stmtTamu);
mysqli_stmt_close($stmtTamu);

/* =====================
   DELETE biodata_mahasiswa
===================== */
$stmtBio = mysqli_prepare($conn, "DELETE FROM biodata_mahasiswa WHERE cid = ?");
if (!$stmtBio) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (biodata_mahasiswa prepare gagal).';
    redirect_ke('read.php');
}
mysqli_stmt_bind_param($stmtBio, "i", $cid);
$successBio = mysqli_stmt_execute($stmtBio);
mysqli_stmt_close($stmtBio);

/* =====================
   PRG & FLASH MESSAGE
===================== */
if ($successTamu && $successBio) {
    $_SESSION['flash_sukses'] = 'Data berhasil dihapus.';
} else {
    $_SESSION['flash_error'] = 'Data gagal dihapus. Silakan coba lagi.';
}

redirect_ke('read.php');
