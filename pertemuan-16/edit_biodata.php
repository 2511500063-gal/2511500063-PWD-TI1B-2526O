<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

/*
  Ambil nilai id dari GET dan validasi harus angka > 0
*/
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$id) {
    $_SESSION['flash_error'] = 'ID tidak valid.';
    redirect_ke('read_biodata.php');
    exit;
}

/*
  Ambil data lama dari DB biodata
*/
$stmt = mysqli_prepare($conn, "SELECT * FROM biodata WHERE id = ? LIMIT 1");
if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('read_biodata.php');
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
    $_SESSION['flash_error'] = 'Data biodata tidak ditemukan.';
    redirect_ke('read_biodata.php');
    exit;
}

# Nilai awal (prefill form)
$nim            = $row['nim'] ?? '';
$nama_lengkap   = $row['nama_lengkap'] ?? '';
$tempat_lahir   = $row['tempat_lahir'] ?? '';
$tanggal_lahir  = $row['tanggal_lahir'] ?? '';
$hobi           = $row['hobi'] ?? '';
$pasangan       = $row['pasangan'] ?? '';
$pekerjaan      = $row['pekerjaan'] ?? '';
$nama_orang_tua = $row['nama_orang_tua'] ?? '';
$nama_kakak     = $row['nama_kakak'] ?? '';
$nama_adik      = $row['nama_adik'] ?? '';

# Ambil error dan nilai old input kalau ada
$flash_error = $_SESSION['flash_error'] ?? '';
$old = $_SESSION['old'] ?? [];
unset($_SESSION['flash_error'], $_SESSION['old']);
if (!empty($old)) {
    $nim            = $old['nim'] ?? $nim;
    $nama_lengkap   = $old['nama_lengkap'] ?? $nama_lengkap;
    $tempat_lahir   = $old['tempat_lahir'] ?? $tempat_lahir;
    $tanggal_lahir  = $old['tanggal_lahir'] ?? $tanggal_lahir;
    $hobi           = $old['hobi'] ?? $hobi;
    $pasangan       = $old['pasangan'] ?? $pasangan;
    $pekerjaan      = $old['pekerjaan'] ?? $pekerjaan;
    $nama_orang_tua = $old['nama_orang_tua'] ?? $nama_orang_tua;
    $nama_kakak     = $old['nama_kakak'] ?? $nama_kakak;
    $nama_adik      = $old['nama_adik'] ?? $nama_adik;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Ini Header</h1>
        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">&#9776;</button>
        <nav>
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="read_biodata.php">Biodata</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="contact">
            <h2>Edit Biodata</h2>
            <?php if (!empty($flash_error)): ?>
                <div style="padding:10px; margin-bottom:10px; 
                    background:#f8d7da; color:#721c24; border-radius:6px;">
                    <?= $flash_error; ?>
                </div>
            <?php endif; ?>
            
            <form action="update_biodata.php" method="POST">
                <!-- Hidden input untuk ID biodata -->
                <input type="hidden" name="id" value="<?= (int)$id; ?>">

                <label for="txtNim">
                    <span>NIM:</span>
                    <input type="text" id="txtNim" name="txtNimEd" 
                           placeholder="Masukkan NIM" required 
                           value="<?= htmlspecialchars($nim); ?>">
                </label>

                <label for="txtNama_lengkap">
                    <span>Nama Lengkap:</span>
                    <input type="text" id="txtNama_lengkap" name="txtNama_lengkapEd" 
                           placeholder="Masukkan nama lengkap" required 
                           value="<?= htmlspecialchars($nama_lengkap); ?>">
                </label>

                <label for="txtTempat_Lahir">
                    <span>Tempat Lahir:</span>
                    <input type="text" id="txtTempat_Lahir" name="txtTempat_LahirEd" 
                           placeholder="Tempat lahir" required 
                           value="<?= htmlspecialchars($tempat_lahir); ?>">
                </label>

                <label for="txtTanggal_lahir">
                    <span>Tanggal Lahir:</span>
                    <input type="date" id="txtTanggal_lahir" name="txtTanggal_lahirEd" 
                           required value="<?= htmlspecialchars($tanggal_lahir); ?>">
                </label>

                <label for="txtHobi">
                    <span>Hobi:</span>
                    <input type="text" id="txtHobi" name="txtHobiEd" 
                           placeholder="Hobi" 
                           value="<?= htmlspecialchars($hobi); ?>">
                </label>

                <label for="txtPasangan">
                    <span>Pasangan:</span>
                    <input type="text" id="txtPasangan" name="txtPasanganEd" 
                           placeholder="Nama pasangan" 
                           value="<?= htmlspecialchars($pasangan); ?>">
                </label>

                <label for="txtPekerjaan">
                    <span>Pekerjaan:</span>
                    <input type="text" id="txtPekerjaan" name="txtPekerjaanEd" 
                           placeholder="Pekerjaan" 
                           value="<?= htmlspecialchars($pekerjaan); ?>">
                </label>

                <label for="txtNama_orang_tua">
                    <span>Nama Orang Tua:</span>
                    <input type="text" id="txtNama_orang_tua" name="txtNama_orang_tuaEd" 
                           placeholder="Nama orang tua" 
                           value="<?= htmlspecialchars($nama_orang_tua); ?>">
                </label>

                <label for="txtNama_kakak">
                    <span>Nama Kakak:</span>
                    <input type="text" id="txtNama_kakak" name="txtNama_kakakEd" 
                           placeholder="Nama kakak" 
                           value="<?= htmlspecialchars($nama_kakak); ?>">
                </label>

                <label for="txtNama_adik">
                    <span>Nama Adik:</span>
                    <input type="text" id="txtNama_adik" name="txtNama_adikEd" 
                           placeholder="Nama adik" 
                           value="<?= htmlspecialchars($nama_adik); ?>">
                </label>

                <label for="txtCaptcha">
                    <span>Captcha 2 x 3 = ?</span>
                    <input type="number" id="txtCaptcha" name="txtCaptcha" 
                           placeholder="Jawab pertanyaan..." required>
                </label>

                <button type="submit">Update Biodata</button>
                <button type="reset">Batal</button>
                <a href="read_biodata.php" class="reset">Kembali</a>
            </form>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
