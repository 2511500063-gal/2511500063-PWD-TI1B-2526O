<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

/* ================== CEK METHOD ================== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('index.php');
}

/* ================== CEK JENIS FORM ================== */
$form_type = $_POST['form_type'] ?? '';

/* ============================================================
   BAGIAN 1 : FORM BIODATA MAHASISWA
   ============================================================ */
if ($form_type === 'biodata') {

    $nim             = bersihkan($_POST['txtnim']             ?? '');
    $nama_lengkap    = bersihkan($_POST['txtnama_lengkap']    ?? '');
    $tempat_lahir    = bersihkan($_POST['txttempat_lahir']    ?? '');
    $tanggal_lahir   = bersihkan($_POST['txttanggal_lahir']   ?? '');
    $hobi            = bersihkan($_POST['txtHobi']            ?? '');
    $pasangan        = bersihkan($_POST['txtPasangan']        ?? '');
    $pekerjaan       = bersihkan($_POST['txtpekerjaan']       ?? '');
    $nama_orang_tua  = bersihkan($_POST['txtnama_orang_tua']  ?? '');
    $nama_kakak      = bersihkan($_POST['txtnama_kakak']      ?? '');
    $nama_adik       = bersihkan($_POST['txtnama_adik']       ?? '');

    $errors_bio = [];

    // Wajib isi
    if ($nim === '')             $errors_bio[] = 'NIM wajib diisi.';
    if ($nama_lengkap === '')    $errors_bio[] = 'Nama lengkap wajib diisi.';
    if ($tempat_lahir === '')    $errors_bio[] = 'Tempat lahir wajib diisi.';
    if ($tanggal_lahir === '')   $errors_bio[] = 'Tanggal lahir wajib diisi.';
    if ($hobi === '')            $errors_bio[] = 'Hobi wajib diisi.';
    if ($pasangan === '')        $errors_bio[] = 'Pasangan lengkap wajib diisi.';
    if ($pekerjaan === '')       $errors_bio[] = 'Pekerjaan wajib diisi.';
    if ($nama_orang_tua === '')  $errors_bio[] = 'Nama Orang Tua wajib diisi.';
    if ($nama_kakak === '')      $errors_bio[] = 'Nama Kakak wajib diisi.';
    if ($nama_adik === '')       $errors_bio[] = 'Nama Adik wajib diisi.';

    // Panjang
    if ($nim !== '' && (mb_strlen($nim, 'UTF-8') < 5 || mb_strlen($nim, 'UTF-8') > 15)) {
        $errors_bio[] = 'NIM harus 5–15 karakter.';
    }
    if ($nama_lengkap !== '' && mb_strlen($nama_lengkap, 'UTF-8') < 3) {
        $errors_bio[] = 'Nama lengkap minimal 3 karakter.';
    }
    if ($tempat_lahir !== '' && mb_strlen($tempat_lahir, 'UTF-8') < 3) {
        $errors_bio[] = 'Tempat lahir minimal 3 karakter.';
    }
    if ($hobi !== '' && mb_strlen($hobi, 'UTF-8') > 100) {
        $errors_bio[] = 'Hobi maksimal 100 karakter.';
    }

    // Hanya huruf + spasi
    if ($nama_lengkap !== ''   && !preg_match('/^[\p{L}\s]+$/u', $nama_lengkap))   $errors_bio[] = 'Nama lengkap hanya boleh berisi huruf dan spasi.';
    if ($tempat_lahir !== ''   && !preg_match('/^[\p{L}\s]+$/u', $tempat_lahir))   $errors_bio[] = 'Tempat lahir hanya boleh berisi huruf dan spasi.';
    if ($nama_orang_tua !== '' && !preg_match('/^[\p{L}\s]+$/u', $nama_orang_tua)) $errors_bio[] = 'Nama orang tua hanya boleh berisi huruf dan spasi.';
    if ($nama_kakak !== ''     && !preg_match('/^[\p{L}\s]+$/u', $nama_kakak))     $errors_bio[] = 'Nama kakak hanya boleh berisi huruf dan spasi.';
    if ($nama_adik !== ''      && !preg_match('/^[\p{L}\s]+$/u', $nama_adik))      $errors_bio[] = 'Nama adik hanya boleh berisi huruf dan spasi.';

    if (!empty($errors_bio)) {
        $_SESSION['old_bio'] = [
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

        $_SESSION['flash_error_bio'] = implode('<br>', $errors_bio);
        redirect_ke('index.php#biodata');
    }

    // INSERT ke tabel biodata_mahasiswa
    $sql_bio = "INSERT INTO biodata_mahasiswa 
                (nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, 
                 pekerjaan, nama_orang_tua, nama_kakak, nama_adik)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_bio = mysqli_prepare($conn, $sql_bio);

    if (!$stmt_bio) {
        $_SESSION['flash_error_bio'] = 'Terjadi kesalahan sistem (prepare gagal): ' . mysqli_error($conn);
        redirect_ke('index.php#biodata');
    }

    mysqli_stmt_bind_param(
        $stmt_bio,
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

    if (mysqli_stmt_execute($stmt_bio)) {
        unset($_SESSION['old_bio']);

        $_SESSION['biodata'] = [
            'nim'       => $nim,
            'nama'      => $nama_lengkap,
            'tempat'    => $tempat_lahir,
            'tanggal'   => $tanggal_lahir,
            'hobi'      => $hobi,
            'pasangan'  => $pasangan,
            'pekerjaan' => $pekerjaan,
            'ortu'      => $nama_orang_tua,
            'kakak'     => $nama_kakak,
            'adik'      => $nama_adik,
        ];

        $_SESSION['flash_sukses_bio'] = 'Terima kasih, data biodata Anda sudah tersimpan.';
        redirect_ke('index.php#biodata');
    } else {
        $_SESSION['old_bio'] = [
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

        $_SESSION['flash_error_bio'] = 'Data biodata gagal disimpan: ' . mysqli_error($conn);
        redirect_ke('index.php#biodata');
    }
    mysqli_stmt_close($stmt_bio);

    exit;
}

/* ============================================================
   BAGIAN 2 : FORM KONTAK
   ============================================================ */
if ($form_type === 'contact') {

    $nama    = bersihkan($_POST['txtNama']    ?? '');
    $email   = bersihkan($_POST['txtEmail']   ?? '');
    $pesan   = bersihkan($_POST['txtPesan']   ?? '');
    $captcha = bersihkan($_POST['txtCaptcha'] ?? '');

    $errors = [];

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
        $errors[] = 'Pertanyaan wajib diisi.';
    }

    if (mb_strlen($nama, 'UTF-8') < 3) {
        $errors[] = 'Nama minimal 3 karakter.';
    }

    if (mb_strlen($pesan, 'UTF-8') < 10) {
        $errors[] = 'Pesan minimal 10 karakter.';
    }

    if ($captcha !== "5") {
        $errors[] = 'Jawaban ' . $captcha . ' captcha salah.';
    }

    if (!empty($errors)) {
        $_SESSION['old'] = [
            'nama'    => $nama,
            'email'   => $email,
            'pesan'   => $pesan,
            'captcha' => $captcha,
        ];

        $_SESSION['flash_error'] = implode('<br>', $errors);
        redirect_ke('index.php#contact');
    }

    $sql = "INSERT INTO tbl_tamu (cnama, cemail, cpesan) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
        redirect_ke('index.php#contact');
    }

    mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $pesan);

    if (mysqli_stmt_execute($stmt)) {
        unset($_SESSION['old']);
        $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah tersimpan.';
        redirect_ke('index.php#contact');
    } else {
        $_SESSION['old'] = [
            'nama'    => $nama,
            'email'   => $email,
            'pesan'   => $pesan,
            'captcha' => $captcha,
        ];
        $_SESSION['flash_error'] = 'Data gagal disimpan. Silakan coba lagi.';
        redirect_ke('index.php#contact');
    }
    mysqli_stmt_close($stmt);

    exit;
}

/* Jika form_type tidak dikenal */
$_SESSION['flash_error'] = 'Form tidak dikenal.';
redirect_ke('index.php');
