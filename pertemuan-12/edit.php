<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';

/*
  Ambil nilai cid dari GET dan lakukan validasi untuk
  mengecek cid harus angka dan lebih besar dari 0 (> 0).
  options => ['min_range' => 1] artinya cid harus >= 1
*/
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

/*
  Cek apakah $cid bernilai valid.
  Jika tidak valid, kembalikan ke read.php.
*/
if (!$cid) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    header("Location: read.php"); // Atau redirect_ke('read.php') sesuai fungsi Anda
    exit;
}

/*
  Ambil data lama dari DB menggunakan prepared statement.
*/
$stmt = mysqli_prepare($conn, "SELECT cid, cnama, cemail, cpesan FROM tbl_tamu WHERE cid = ? LIMIT 1");
if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    header("Location: read.php");
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    header("Location: read.php");
    exit;
}

// Nilai awal (prefill form)
$nama  = $row['cnama']  ?? '';
$email = $row['cemail'] ?? '';
$pesan = $row['cpesan'] ?? '';

// Ambil error dan nilai old input jika ada (setelah validasi gagal di proses_update.php)
$flash_error = $_SESSION['flash_error'] ?? '';
$old         = $_SESSION['old'] ?? [];

unset($_SESSION['flash_error'], $_SESSION['old']);

if (!empty($old)) {
    $nama  = $old['nama']  ?? $nama;
    $email = $old['email'] ?? $email;
    $pesan = $old['pesan'] ?? $pesan;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku Tamu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistem Buku Tamu</h1>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
            &#9776;
        </button>
        <nav>
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="contact">
            <h2>Edit Buku Tamu</h2>

            <?php if (!empty($flash_error)): ?>
                <div style="padding:10px; margin-bottom:20px; background:#f8d7da; color:#721c24; border-radius:6px; border: 1px solid #f5c6cb;">
                    <?= htmlspecialchars($flash_error); ?>
                </div>
            <?php endif; ?>

            <form action="proses_update.php" method="POST">
                <input type="hidden" name="cid" value="<?= (int)$cid; ?>">

                <div class="form-group">
                    <label for="txtNama">Nama:</label>
                    <input type="text" id="txtNama" name="txtNamaEd" 
                           placeholder="Masukkan nama" required autocomplete="name"
                           value="<?= htmlspecialchars($nama) ?>">
                </div>

                <div class="form-group">
                    <label for="txtEmail">Email:</label>
                    <input type="email" id="txtEmail" name="txtEmailEd" 
                           placeholder="Masukkan email" required autocomplete="email"
                           value="<?= htmlspecialchars($email) ?>">
                </div>

                <div class="form-group">
                    <label for="txtPesan">Pesan Anda:</label>
                    <textarea id="txtPesan" name="txtPesanEd" rows="4"
                              placeholder="Tulis pesan anda..." required><?= htmlspecialchars($pesan) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="txtCaptcha">Captcha: 2 x 3 = ?</label>
                    <input type="number" id="txtCaptcha" name="txtCaptcha"
                           placeholder="Jawab Pertanyaan..." required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Simpan Perubahan</button>
                    <button type="reset" class="btn-reset">Batal</button>
                    <a href="read.php" class="link-back">Kembali</a>
                </div>
            </form>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>