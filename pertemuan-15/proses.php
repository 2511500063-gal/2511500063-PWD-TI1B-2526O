<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

/* =====================
   CEK METHOD
===================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#contact');
}

/* =====================
   AMBIL & SANITASI DATA
===================== */
$nama    = bersihkan($_POST['txtNama'] ?? '');
$email   = bersihkan($_POST['txtEmail'] ?? '');
$pesan   = bersihkan($_POST['txtPesan'] ?? '');
$captcha = bersihkan($_POST['txtCaptcha'] ?? '');

$nim            = bersihkan($_POST['txtnim'] ?? '');
$nama_lengkap   = bersihkan($_POST['txtnama_lengkap'] ?? '');
$tempat_lahir  = bersihkan($_POST['txttempat_lahir'] ?? '');
$tanggal_lahir  = bersihkan($_POST['txttanggal_lahir'] ?? '');
$hobi           = bersihkan($_POST['txthobi'] ?? '');
$pasangan       = bersihkan($_POST['txtpasangan'] ?? '');
$pekerjaan      = bersihkan($_POST['txtpekerjaan'] ?? '');
$nama_orang_tua = bersihkan($_POST['txtnama_orang_tua'] ?? '');
$nama_kakak     = bersihkan($_POST['txtnama_kakak'] ?? '');
$nama_adik      = bersihkan($_POST['txtnama_adik'] ?? '');

/* =====================
   VALIDASI
===================== */
$errors = [];

/* validasi biodata */
if ($nim === '' || mb_strlen($nim) < 3) {
    $errors[] = 'NIM minimal 3 karakter.';
}

if ($nama_lengkap === '' || mb_strlen($nama_lengkap) < 3) {
    $errors[] = 'Nama lengkap minimal 3 karakter.';
}

if ($tempat_lahir === '' || mb_strlen($tempat_lahir) < 3) {
    $errors[] = 'Tempat lahir minimal 3 karakter.';
}

if ($tanggal_lahir === '') {
    $errors[] = 'Tanggal lahir wajib diisi.';
}

if ($hobi === '' || mb_strlen($hobi) < 3) {
    $errors[] = 'Hobi minimal 3 karakter.';
}

if ($pasangan === '' || mb_strlen($pasangan) < 3) {
    $errors[] = 'Pasangan minimal 3 karakter.';
}

if ($pekerjaan === '' || mb_strlen($pekerjaan) < 3) {
    $errors[] = 'Pekerjaan minimal 3 karakter.';
}

if ($nama_orang_tua === '' || mb_strlen($nama_orang_tua) < 3) {
    $errors[] = 'Nama orang tua minimal 3 karakter.';
}

if ($nama_kakak === '' || mb_strlen($nama_kakak) < 3) {
    $errors[] = 'Nama kakak minimal 3 karakter.';
}

if ($nama_adik === '' || mb_strlen($nama_adik) < 3) {
    $errors[] = 'Nama adik minimal 3 karakter.';
}


/* validasi kontak */
if ($nama === '' || mb_strlen($nama) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email tidak valid.';
}

if ($pesan === '' || mb_strlen($pesan) < 10) {
    $errors[] = 'Pesan minimal 10 karakter.';
}

if ($captcha !== '5') {
    $errors[] = 'Captcha salah.';
}

/* =====================
   PRG JIKA ERROR
===================== */
if (!empty($errors)) {
    $_SESSION['old'] = $_POST;
    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('index.php#contact');
}

/* =====================
   INSERT tbl_tamu
===================== */
$sql = "INSERT INTO tbl_tamu (cnama, cemail, cpesan) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pesan);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

/* =====================
   INSERT biodata_mahasiswa
===================== */
$sql = "INSERT INTO biodata_mahasiswa
(nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "ssssssssss",
    $nim,
    $nama_lengkap,
    $tempat_lahir,
    $tanggal_lahir,
    $hobi,
    $pasangan,
    $pekerjaan,
    $nama_orang_tua,
    $nama_kakak,
    $nama_adik
);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

/* =====================
   PRG SUKSES
===================== */
unset($_SESSION['old']);
$_SESSION['flash_sukses'] = 'Data berhasil disimpan.';
redirect_ke('index.php#about');
