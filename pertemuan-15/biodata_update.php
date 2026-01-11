<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';


# cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('read_biodata.php');
}


# validasi cid wajib angka dan > 0
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);


if (!$cid) {
  $_SESSION['flash_error'] = 'CID Tidak Valid.';
  // PERBAIKAN: ikutkan cid agar link edit tetap jelas
  redirect_ke('edit_biodata.php');
}


# ambil dan bersihkan nilai dari form (nama harus sama dengan form edit)
$nim            = bersihkan($_POST['nim']            ?? '');
$nama_lengkap   = bersihkan($_POST['nama_lengkap']   ?? '');
$tempat_lahir   = bersihkan($_POST['tempat_lahir']   ?? '');
$tanggal_lahir  = bersihkan($_POST['tanggal_lahir']  ?? '');
$hobi           = bersihkan($_POST['hobi']           ?? '');
$pasangan       = bersihkan($_POST['pasangan']       ?? '');
$pekerjaan      = bersihkan($_POST['pekerjaan']      ?? '');
$nama_orang_tua = bersihkan($_POST['nama_orang_tua'] ?? '');
$nama_kakak     = bersihkan($_POST['nama_kakak']     ?? '');
$nama_adik      = bersihkan($_POST['nama_adik']      ?? '');


# Validasi sederhana
$errors = [];


if ($nim === '')            $errors[] = 'NIM wajib diisi.';
if ($nama_lengkap === '')   $errors[] = 'Nama lengkap wajib diisi.';
if ($tempat_lahir === '')   $errors[] = 'Tempat lahir wajib diisi.';
if ($tanggal_lahir === '')  $errors[] = 'Tanggal lahir wajib diisi.';
if ($hobi === '')           $errors[] = 'Hobi wajib diisi.';
if ($pasangan === '')       $errors[] = 'Pasangan wajib diisi.';
if ($pekerjaan === '')      $errors[] = 'Pekerjaan wajib diisi.';
if ($nama_orang_tua === '') $errors[] = 'Nama Orang Tua wajib diisi.';
if ($nama_kakak === '')     $errors[] = 'Nama Kakak wajib diisi.';
if ($nama_adik === '')      $errors[] = 'Nama Adik wajib diisi.';


if ($nim !== '' && (mb_strlen($nim, 'UTF-8') < 5 || mb_strlen($nim, 'UTF-8') > 15)) {
  $errors[] = 'NIM harus 5–15 karakter.';
}


if ($nama_lengkap !== '' && mb_strlen($nama_lengkap, 'UTF-8') < 3) {
  $errors[] = 'Nama lengkap minimal 3 karakter.';
}


if ($tempat_lahir !== '' && mb_strlen($tempat_lahir, 'UTF-8') < 3) {
  $errors[] = 'Tempat lahir minimal 3 karakter.';
}


if ($hobi !== '' && mb_strlen($hobi, 'UTF-8') > 100) {
  $errors[] = 'Hobi maksimal 100 karakter.';
}


/* huruf + spasi untuk beberapa field */
foreach ([
  'pasangan'       => $pasangan,
  'pekerjaan'      => $pekerjaan,
  'nama_orang_tua' => $nama_orang_tua,
  'nama_kakak'     => $nama_kakak,
  'nama_adik'      => $nama_adik,
] as $label => $value) {
  if ($value !== '' && !preg_match('/^[\p{L}\s]+$/u', $value)) {
    $label_show = str_replace('_', ' ', $label);
    $errors[]   = ucfirst($label_show) . ' hanya boleh berisi huruf dan spasi.';
  }
}


# jika ada error
if (!empty($errors)) {
  $_SESSION['old'] = [
    'nim'            => $nim,
    'nama_lengkap'   => $nama_lengkap,
    'tempat_lahir'   => $tempat_lahir,
    'tanggal_lahir'  => $tanggal_lahir,
    'hobi'           => $hobi,
    'pasangan'       => $pasangan,
    'pekerjaan'      => $pekerjaan,
    'nama_orang_tua' => $nama_orang_tua,
    'nama_kakak'     => $nama_kakak,
    'nama_adik'      => $nama_adik,
  ];

  $_SESSION['flash_error'] = implode('<br>', $errors);
  redirect_ke('edit_biodata.php?cid=' . (int)$cid);
}


# UPDATE dengan prepared statement
$stmt = mysqli_prepare(
  $conn,
  "UPDATE biodata_mahasiswa 
   SET nim = ?, nama_lengkap = ?, tempat_lahir = ?, tanggal_lahir = ?, 
       hobi = ?, pasangan = ?, pekerjaan = ?, nama_orang_tua = ?, 
       nama_kakak = ?, nama_adik = ? 
   WHERE cid = ?"
);


if (!$stmt) {
  $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('edit_biodata.php?cid=' . (int)$cid);
}


mysqli_stmt_bind_param(
  $stmt,
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


if (mysqli_stmt_execute($stmt)) {
  unset($_SESSION['old']);
  // PERBAIKAN: gunakan kunci yang sama dengan yang dibaca di read_biodata.php
  $_SESSION['flash_sukses_bio'] = 'Data biodata berhasil diperbaharui.';
  redirect_ke('read_biodata.php');
} else {
  $_SESSION['old'] = [
    'nim'            => $nim,
    'nama_lengkap'   => $nama_lengkap,
    'tempat_lahir'   => $tempat_lahir,
    'tanggal_lahir'  => $tanggal_lahir,
    'hobi'           => $hobi,
    'pasangan'       => $pasangan,
    'pekerjaan'      => $pekerjaan,
    'nama_orang_tua' => $nama_orang_tua,
    'nama_kakak'     => $nama_kakak,
    'nama_adik'      => $nama_adik,
  ];
  $_SESSION['flash_error'] = 'Data biodata gagal diperbaharui. Silakan coba lagi.';
  redirect_ke('edit_biodata.php?cid=' . (int)$cid);
}


mysqli_stmt_close($stmt);
