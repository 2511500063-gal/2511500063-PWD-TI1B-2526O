<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if ($cid === false || $cid === null) {
    $_SESSION['flash_error_bio'] = 'CID tidak valid.';
    redirect_ke('index.php');
}

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM biodata_mahasiswa WHERE cid = ?"
);

if (!$stmt) {
    $_SESSION['flash_error_bio'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('index.php');
}

mysqli_stmt_bind_param($stmt, "i", $cid);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash_sukses_bio'] = 'Data biodata berhasil dihapus.';
} else {
    $_SESSION['flash_error_bio'] = 'Data gagal dihapus. Silakan coba lagi.';
}

mysqli_stmt_close($stmt);
redirect_ke('index.php');
