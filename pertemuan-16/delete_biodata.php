<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

# validasi id wajib angka dan > 0
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$id) {
    $_SESSION['flash_error'] = 'ID tidak valid.';
    redirect_ke('read_biodata.php');
    exit;
}

/*
  Prepared statement untuk anti SQL injection.
  Hapus 1 baris biodata berdasarkan id.
*/
$stmt = mysqli_prepare($conn, "DELETE FROM biodata WHERE id = ?");
if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('read_biodata.php');
    exit;
}

# bind parameter dan eksekusi (i = integer)
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['flash_sukses'] = 'Data biodata Anda sudah dihapus.';
} else {
    $_SESSION['flash_error'] = 'Data gagal dihapus. Silakan coba lagi.';
}

mysqli_stmt_close($stmt);

redirect_ke('read_biodata.php');
exit;
