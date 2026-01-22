<?php
session_start();
require_once __DIR__ . '/fungsi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judul Halaman</title>
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
                <li><a href="#biodata">Biodata</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li><a href="read_biodata.php">Lihat Semua Biodata</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="home">
            <h2>Selamat Datang</h2>
            <?php
            echo "halo dunia!<br>";
            echo "nama saya hadi";
            ?>
            <p>Ini contoh paragraf HTML.</p>
        </section>

        <!-- FORM BIODATA YANG SUDAH DICOCOKKAN -->
        <section id="biodata">
            <h2>Biodata Pengunjung</h2>
            
            <?php
            // FLASH MESSAGE UNTUK BIODATA
            $flash_sukses_biodata = $_SESSION['flash_sukses'] ?? '';
            $flash_error_biodata  = $_SESSION['flash_error'] ?? '';
            $old_biodata = $_SESSION['old'] ?? [];
            unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']);
            ?>

            <?php if (!empty($flash_sukses_biodata)): ?>
                <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
                    <?= $flash_sukses_biodata; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($flash_error_biodata)): ?>
                <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
                    <?= $flash_error_biodata; ?>
                </div>
            <?php endif; ?>

            <!-- FORM BIODATA YANG SESUAI DENGAN proses_biodata.php -->
            <form action="proses_biodata.php" method="POST">
                <label for="txtNim">
                    <span>NIM:</span>
                    <input type="text" id="txtNim" name="txtNim" 
                           placeholder="Masukkan NIM" required 
                           value="<?= htmlspecialchars($old_biodata['nim'] ?? ''); ?>">
                </label>

                <label for="txtNama_lengkap">
                    <span>Nama Lengkap:</span>
                    <input type="text" id="txtNama_lengkap" name="txtNama_lengkap" 
                           placeholder="Masukkan nama lengkap" required 
                           value="<?= htmlspecialchars($old_biodata['nama_lengkap'] ?? ''); ?>">
                </label>

                <label for="txtTempat_Lahir">
                    <span>Tempat Lahir:</span>
                    <input type="text" id="txtTempat_Lahir" name="txtTempat_Lahir" 
                           placeholder="Contoh: Jakarta" required 
                           value="<?= htmlspecialchars($old_biodata['tempat_lahir'] ?? ''); ?>">
                </label>

                <label for="txtTanggal_lahir">
                    <span>Tanggal Lahir:</span>
                    <input type="date" id="txtTanggal_lahir" name="txtTanggal_lahir" required>
                </label>

                <label for="txtHobi">
                    <span>Hobi:</span>
                    <input type="text" id="txtHobi" name="txtHobi" 
                           placeholder="Contoh: Baca buku, olahraga" 
                           value="<?= htmlspecialchars($old_biodata['hobi'] ?? ''); ?>">
                </label>

                <label for="txtPasangan">
                    <span>Pasangan:</span>
                    <input type="text" id="txtPasangan" name="txtPasangan" 
                           placeholder="Nama pasangan (opsional)" 
                           value="<?= htmlspecialchars($old_biodata['pasangan'] ?? ''); ?>">
                </label>

                <label for="txtPekerjaan">
                    <span>Pekerjaan:</span>
                    <input type="text" id="txtPekerjaan" name="txtPekerjaan" 
                           placeholder="Contoh: Mahasiswa, Programmer" 
                           value="<?= htmlspecialchars($old_biodata['pekerjaan'] ?? ''); ?>">
                </label>

                <label for="txtNama_orang_tua">
                    <span>Nama Orang Tua:</span>
                    <input type="text" id="txtNama_orang_tua" name="txtNama_orang_tua" 
                           placeholder="Nama ayah/ibu" 
                           value="<?= htmlspecialchars($old_biodata['nama_orang_tua'] ?? ''); ?>">
                </label>

                <label for="txtNama_kakak">
                    <span>Nama Kakak:</span>
                    <input type="text" id="txtNama_kakak" name="txtNama_kakak" 
                           placeholder="Nama kakak (opsional)" 
                           value="<?= htmlspecialchars($old_biodata['nama_kakak'] ?? ''); ?>">
                </label>

                <label for="txtNama_adik">
                    <span>Nama Adik:</span>
                    <input type="text" id="txtNama_adik" name="txtNama_adik" 
                           placeholder="Nama adik (opsional)" 
                           value="<?= htmlspecialchars($old_biodata['nama_adik'] ?? ''); ?>">
                </label>

                <!-- CAPTCHA WAJIB (jawab 5 untuk 2+3) -->
                <label for="txtCaptcha">
                    <span>Captcha: 2 + 3 = ?</span>
                    <input type="number" id="txtCaptcha" name="txtCaptcha" 
                           placeholder="Jawab 5" required 
                           value="<?= htmlspecialchars($old_biodata['captcha'] ?? ''); ?>">
                </label>

                <button type="submit">Simpan Biodata</button>
                <button type="reset">Reset Form</button>
                <a href="#biodata" class="reset">Kembali ke atas</a>
            </form>
        </section>

        <!-- BAGIAN SESSION BIODATA LAMA (bisa dihapus kalau tidak perlu) -->
        <?php
        $biodata = $_SESSION["biodata"] ?? [];
        $fieldConfig = [
            "kodepen" => ["label" => "Kode Pengunjung:", "suffix" => ""],
            "nama" => ["label" => "Nama Pengunjung:", "suffix" => " &#128526;"],
            "alamat" => ["label" => "Alamat Rumah:", "suffix" => ""],
            "tanggal" => ["label" => "Tanggal Kunjungan:", "suffix" => ""],
            "hobi" => ["label" => "Hobi:", "suffix" => " &#127926;"],
            "slta" => ["label" => "Asal SLTA:", "suffix" => " &hearts;"],
            "pekerjaan" => ["label" => "Pekerjaan:", "suffix" => " &copy; 2025"],
            "ortu" => ["label" => "Nama Orang Tua:", "suffix" => ""],
            "pacar" => ["label" => "Nama Pacar:", "suffix" => ""],
            "mantan" => ["label" => "Nama Mantan:", "suffix" => ""],
        ];
        ?>

        <section id="about">
            <h2>Tentang Saya</h2>
            <?= tampilkanBiodata($fieldConfig, $biodata) ?>
        </section>

        <!-- FORM KONTAK (tetap seperti semula) -->
        <?php
        $flash_sukses = $_SESSION['flash_sukses'] ?? '';
        $flash_error  = $_SESSION['flash_error'] ?? '';
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']);
        ?>

        <section id="contact">
            <h2>Kontak Kami</h2>

            <?php if (!empty($flash_sukses)): ?>
                <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
                    <?= $flash_sukses; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($flash_error)): ?>
                <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
                    <?= $flash_error; ?>
                </div>
            <?php endif; ?>

            <form action="proses.php" method="POST">
                <label for="txtNama"><span>Nama:</span>
                    <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama"
                        required autocomplete="name"
                        value="<?= isset($old['nama']) ? htmlspecialchars($old['nama']) : '' ?>">
                </label>

                <label for="txtEmail"><span>Email:</span>
                    <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email"
                        required autocomplete="email"
                        value="<?= isset($old['email']) ? htmlspecialchars($old['email']) : '' ?>">
                </label>

                <label for="txtPesan"><span>Pesan Anda:</span>
                    <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..."
                        required><?= isset($old['pesan']) ? htmlspecialchars($old['pesan']) : '' ?></textarea>
                    <small id="charCount">0/200 karakter</small>
                </label>

                <label for="txtCaptcha"><span>Captcha 2 + 3 = ?</span>
                    <input type="number" id="txtCaptcha" name="txtCaptcha" placeholder="Jawab Pertanyaan..."
                        required
                        value="<?= isset($old['captcha']) ? htmlspecialchars($old['captcha']) : '' ?>">
                </label>

                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
            </form>

            <br><hr>
            <h2>Yang menghubungi kami</h2>
            <?php include 'read_inc.php'; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
