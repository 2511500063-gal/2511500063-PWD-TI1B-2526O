<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

/* =====================
   CEK METHOD
===================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read.php');
}

/* =====================
   VALIDASI CID
===================== */
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$cid) {
    $_SESSION['flash_error'] = 'CID Tidak Valid.';
    redirect_ke('edit.php?cid=' . (int)$cid);
}

/* =====================
   AMBIL & SANITASI DATA
===================== */
$nama  = bersihkan($_POST['txtNamaEd'] ?? '');
$email = bersihkan($_POST['txtEmailEd'] ?? '');
$pesan = bersihkan($_POST['txtPesanEd'] ?? '');
$captcha = bersihkan($_POST['txtCaptcha'] ?? '');

$nim            = bersihkan($_POST['txtnim'] ?? '');
$nama_lengkap   = bersihkan($_POST['txtnama_lengkap'] ?? '');
$tempat_lahir   = bersihkan($_POST['txttempat_lahir'] ?? '');
$tanggal_lahir  = bersihkan($_POST['txttanggal_lahir'] ?? '');
$hobi           = bersihkan($_POST['txthobi'] ?? '');
$pasangan       = bersihkan($_POST['txtpasangan'] ?? '');
$pekerjaan      = bersihkan($_POST['txtpekerjaan'] ?? '');
$nama_orang_tua = bersihkan($_POST['txtnama_orang_tua'] ?? '');
$nama_kakak     = bersihkan($_POST['txtnama_kakak'] ?? '');
$nama_adik      = bersihkan($_POST['txtnama_adik'] ?? '');

/* =====================
   VALIDASI DATA
===================== */
$errors = [];

/* validasi tbl_tamu */
if ($nama === '' || mb_strlen($nama) < 3) $errors[] = 'Nama minimal 3 karakter.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Format e-mail tidak valid.';
if ($pesan === '' || mb_strlen($pesan) < 10) $errors[] = 'Pesan minimal 10 karakter.';
if ($captcha !== '6') $errors[] = 'Jawaban captcha salah.';

/* validasi biodata_mahasiswa */
if ($nim === '' || mb_strlen($nim) < 3) $errors[] = 'NIM minimal 3 karakter.';
if ($nama_lengkap === '' || mb_strlen($nama_lengkap) < 3) $errors[] = 'Nama lengkap minimal 3 karakter.';
if ($tempat_lahir === '' || mb_strlen($tempat_lahir) < 3) $errors[] = 'Tempat lahir minimal 3 karakter.';
if ($tanggal_lahir === '') $errors[] = 'Tanggal lahir wajib diisi.';
if ($hobi === '' || mb_strlen($hobi) < 3) $errors[] = 'Hobi minimal 3 karakter.';
if ($pasangan === '' || mb_strlen($pasangan) < 3) $errors[] = 'Pasangan minimal 3 karakter.';
if ($pekerjaan === '' || mb_strlen($pekerjaan) < 3) $errors[] = 'Pekerjaan minimal 3 karakter.';
if ($nama_orang_tua === '' || mb_strlen($nama_orang_tua) < 3) $errors[] = 'Nama orang tua minimal 3 karakter.';
if ($nama_kakak === '' || mb_strlen($nama_kakak) < 3) $errors[] = 'Nama kakak minimal 3 karakter.';
if ($nama_adik === '' || mb_strlen($nama_adik) < 3) $errors[] = 'Nama adik minimal 3 karakter.';

/* =====================
   PRG JIKA ERROR
===================== */
if (!empty($errors)) {
    $_SESSION['old'] = $_POST;
    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('edit.php?cid=' . (int)$cid);
}

/* =====================
   UPDATE tbl_tamu
===================== */
$stmtTamu = mysqli_prepare($conn, "UPDATE tbl_tamu 
                                   SET cnama = ?, cemail = ?, cpesan = ? 
                                   WHERE cid = ?");
if (!$stmtTamu) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (tbl_tamu prepare gagal).';
    redirect_ke('edit.php?cid=' . (int)$cid);
}
mysqli_stmt_bind_param($stmtTamu, "sssi", $nama, $email, $pesan, $cid);
mysqli_stmt_execute($stmtTamu);
mysqli_stmt_close($stmtTamu);

/* =====================
   UPDATE biodata_mahasiswa
===================== */
$stmtBio = mysqli_prepare($conn, "UPDATE biodata_mahasiswa 
                                  SET nim = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, hobi = ?, pasangan = ?, pekerjaan = ?, nama_orang_tua = ?, nama_kakak = ?, nama_adik = ?
                                  WHERE cid = ?");
if (!$stmtBio) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (biodata_mahasiswa prepare gagal).';
    redirect_ke('edit.php?cid=' . (int)$cid);
}
mysqli_stmt_bind_param(
    $stmtBio,
    "ssssssssssi",
    $nim,
    $nama_lengkap,
    $tempat_lahir,
    $tanggal_lahir,
    $hobi,
    $pasangan,
    $pekerjaan,
    $nama_orang_tua,
    $nama_kakak,
    $nama_adik,
    $cid
);
mysqli_stmt_execute($stmtBio);
mysqli_stmt_close($stmtBio);

/* =====================
   PRG SUKSES
===================== */
unset($_SESSION['old']);
$_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbaharui.';
redirect_ke('read.php');
