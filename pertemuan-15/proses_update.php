<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

/* Cek method */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('read.php');
}

/* Ambil dan validasi cid dari POST */
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if ($cid === false || $cid === null) {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('read.php');
}

/* Ambil input form */
$nama    = bersihkan($_POST['txtNamaEd']   ?? '');
$email   = bersihkan($_POST['txtEmailEd']  ?? '');
$pesan   = bersihkan($_POST['txtPesanEd']  ?? '');
$captcha = bersihkan($_POST['txtCaptcha']  ?? '');

$errors = [];

/* Validasi sederhana */
if ($nama === '') {
  $errors[] = 'Nama wajib diisi.';
}
if ($email === '') {
  $errors[] = 'Email wajib diisi.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'Format e-mail tidak valid.';
}
if ($pesan === '') {
  $errors[] = 'Pesan wajib diisi.';
}
if ($captcha === '') {
  $errors[] = 'Pertanyaan captcha wajib diisi.';
}

/* Validasi panjang */
if ($nama !== '' && mb_strlen($nama, 'UTF-8') < 3) {
  $errors[] = 'Nama minimal 3 karakter.';
}
if ($pesan !== '' && mb_strlen($pesan, 'UTF-8') < 10) {
  $errors[] = 'Pesan minimal 10 karakter.';
}

/* Validasi captcha 2 x 3 = 6 */
if ($captcha !== '6') {
  $errors[] = 'Jawaban captcha salah.';
}

/* Jika ada error, kirim balik ke edit.php */
if (!empty($errors)) {
  $_SESSION['old'] = [
    'nama'  => $nama,
    'email' => $email,
    'pesan' => $pesan,
  ];
  $_SESSION['flash_error'] = implode('<br>', $errors);
  redirect_ke('edit.php?cid=' . (int)$cid);
}

/* Update ke database */
$sql  = "UPDATE tbl_tamu 
         SET cnama = ?, cemail = ?, cpesan = ?
         WHERE cid = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('edit.php?cid=' . (int)$cid);
}

mysqli_stmt_bind_param($stmt, "sssi", $nama, $email, $pesan, $cid);

if (mysqli_stmt_execute($stmt)) {
  $_SESSION['flash_sukses'] = 'Data berhasil diperbarui.';
  redirect_ke('read.php');
} else {
  $_SESSION['old'] = [
    'nama'  => $nama,
    'email' => $email,
    'pesan' => $pesan,
  ];
  $_SESSION['flash_error'] = 'Data gagal diperbarui. Silakan coba lagi.';
  redirect_ke('edit.php?cid=' . (int)$cid);
}

mysqli_stmt_close($stmt);
