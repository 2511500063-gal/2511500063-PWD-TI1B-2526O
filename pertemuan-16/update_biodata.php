<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read_biodata.php');
    exit;
}

# validasi id wajib angka dan > 0
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$id) {
    $_SESSION['flash_error'] = 'ID tidak valid.';
    redirect_ke('edit_biodata.php?id=' . (int)$id);
    exit;
}

# ambil dan bersihkan nilai dari form (harus sama dengan name di form edit)
$nim            = bersihkan($_POST['txtNimEd']            ?? '');
$nama_lengkap   = bersihkan($_POST['txtNama_lengkapEd']   ?? '');
$tempat_lahir   = bersihkan($_POST['txtTempat_LahirEd']   ?? '');
$tanggal_lahir  = bersihkan($_POST['txtTanggal_lahirEd']  ?? '');
$hobi           = bersihkan($_POST['txtHobiEd']           ?? '');
$pasangan       = bersihkan($_POST['txtPasanganEd']       ?? '');
$pekerjaan      = bersihkan($_POST['txtPekerjaanEd']      ?? '');
$nama_orang_tua = bersihkan($_POST['txtNama_orang_tuaEd'] ?? '');
$nama_kakak     = bersihkan($_POST['txtNama_kakakEd']     ?? '');
$nama_adik      = bersihkan($_POST['txtNama_adikEd']      ?? '');
$captcha        = bersihkan($_POST['txtCaptcha']          ?? '');

# Validasi sederhana
$errors = [];

if ($nim === '') {
    $errors[] = 'NIM wajib diisi.';
}
if ($nama_lengkap === '') {
    $errors[] = 'Nama lengkap wajib diisi.';
}
if ($tempat_lahir === '') {
    $errors[] = 'Tempat lahir wajib diisi.';
}
if ($tanggal_lahir === '') {
    $errors[] = 'Tanggal lahir wajib diisi.';
}

if ($captcha === '') {
    $errors[] = 'Pertanyaan captcha wajib diisi.';
} elseif ($captcha !== '6') {  # contoh captcha hasilnya 6
    $errors[] = 'Jawaban ' . $captcha . ' captcha salah.';
}

if (mb_strlen($nama_lengkap) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

# jika ada error, simpan nilai lama & pesan error, lalu redirect
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
        'captcha'        => $captcha,
    ];

    $_SESSION['flash_error'] = implode('<br>', $errors);
    redirect_ke('edit_biodata.php?id=' . (int)$id);
    exit;
}

# Prepared statement UPDATE biodata
$sql = "UPDATE biodata
        SET nim = ?, 
            nama_lengkap = ?, 
            tempat_lahir = ?, 
            tanggal_lahir = ?, 
            hobi = ?, 
            pasangan = ?, 
            pekerjaan = ?, 
            nama_orang_tua = ?, 
            nama_kakak = ?, 
            nama_adik = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit_biodata.php?id=' . (int)$id);
    exit;
}

# 10 kolom string + 1 id integer
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
    $id
);

if (mysqli_stmt_execute($stmt)) {
    unset($_SESSION['old']);
    $_SESSION['flash_sukses'] = 'Data biodata Anda sudah diperbarui.';
    redirect_ke('read_biodata.php');
    exit;
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
        'captcha'        => $captcha,
    ];
    $_SESSION['flash_error'] = 'Data gagal diperbarui. Silakan coba lagi.';
    redirect_ke('edit_biodata.php?id=' . (int)$id);
    exit;
}

mysqli_stmt_close($stmt);
