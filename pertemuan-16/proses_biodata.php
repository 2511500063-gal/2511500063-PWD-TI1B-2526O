<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# Cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('index.php#about');
    exit;
}

# Ambil dan bersihkan nilai dari form
$nim            = bersihkan($_POST['txtNim']            ?? '');
$nama_lengkap   = bersihkan($_POST['txtNama_lengkap']   ?? '');
$tempat_lahir   = bersihkan($_POST['txtTempat_Lahir']   ?? '');
$tanggal_lahir  = bersihkan($_POST['txtTanggal_lahir']  ?? '');
$hobi           = bersihkan($_POST['txtHobi']           ?? '');
$pasangan       = bersihkan($_POST['txtPasangan']       ?? '');
$pekerjaan      = bersihkan($_POST['txtPekerjaan']      ?? '');
$nama_orang_tua = bersihkan($_POST['txtNama_orang_tua'] ?? '');
$nama_kakak     = bersihkan($_POST['txtNama_kakak']     ?? '');
$nama_adik      = bersihkan($_POST['txtNama_adik']      ?? '');
$captcha        = bersihkan($_POST['txtCaptcha']        ?? '');

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
} elseif ($captcha !== '5') { // contoh captcha 2+3
    $errors[] = 'Jawaban ' . $captcha . ' captcha salah.';
}

if (mb_strlen($nama_lengkap) < 3) {
    $errors[] = 'Nama minimal 3 karakter.';
}

# Jika ada error: simpan nilai lama & pesan error, lalu redirect (konsep PRG)
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
    redirect_ke('index.php#about');
    exit;
}

# Menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO biodata 
    (nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('index.php#about');
    exit;
}

# Bind parameter dan eksekusi (s = string)
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

if (mysqli_stmt_execute($stmt)) {
    # Jika berhasil, kosongkan old value, beri pesan sukses
    unset($_SESSION['old']);
    $_SESSION['flash_sukses'] = 'Terima kasih, data biodata Anda sudah tersimpan.';
    redirect_ke('index.php#about');
    exit;
} else {
    # Jika gagal, simpan kembali old value dan tampilkan error umum
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
    $_SESSION['flash_error'] = 'Data gagal disimpan. Silakan coba lagi.';
    redirect_ke('index.php#about');
    exit;
}

# Tutup statement
mysqli_stmt_close($stmt);
