<?php
session_start();
require_once __DIR__ . '/fungsi.php';

/* -------- FLASH & OLD BIODATA -------- */
$flash_sukses_bio = $_SESSION['flash_sukses_bio'] ?? '';
$flash_error_bio  = $_SESSION['flash_error_bio']  ?? '';
$old_bio          = $_SESSION['old_bio']          ?? [];
unset($_SESSION['flash_sukses_bio'], $_SESSION['flash_error_bio'], $_SESSION['old_bio']);

/* -------- FLASH & OLD CONTACT -------- */
$flash_sukses = $_SESSION['flash_sukses'] ?? '';
$flash_error  = $_SESSION['flash_error']  ?? '';
$old          = $_SESSION['old']          ?? [];
unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']);

/* -------- BIODATA UNTUK ABOUT -------- */
$biodata = $_SESSION["biodata"] ?? [];

$fieldConfig = [
  "nim"      => ["label" => "NIM:",            "suffix" => ""],
  "nama"     => ["label" => "Nama Lengkap:",   "suffix" => " &#128526;"],
  "tempat"   => ["label" => "Tempat Lahir:",   "suffix" => ""],
  "tanggal"  => ["label" => "Tanggal Lahir:",  "suffix" => ""],
  "hobi"     => ["label" => "Hobi:",           "suffix" => " &#127926;"],
  "pasangan" => ["label" => "Pasangan:",       "suffix" => " &hearts;"],
  "pekerjaan"=> ["label" => "Pekerjaan:",      "suffix" => " &copy; 2025"],
  "ortu"     => ["label" => "Nama Orang Tua:", "suffix" => ""],
  "kakak"    => ["label" => "Nama Kakak:",     "suffix" => ""],
  "adik"     => ["label" => "Nama Adik:",      "suffix" => ""],
];
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
      <li><a href="#contact">Kontak</a></li>
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

  <!-- ================= BIODATA ================= -->
  <section id="biodata">
    <h2>Biodata Sederhana Mahasiswa</h2>

    <?php if (!empty($flash_sukses_bio)): ?>
      <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
        <?= $flash_sukses_bio; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($flash_error_bio)): ?>
      <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
        <?= $flash_error_bio; ?>
      </div>
    <?php endif; ?>

    <form action="proses.php" method="POST">
      <input type="hidden" name="form_type" value="biodata">

      <label for="txtnim"><span>NIM:</span>
        <input type="text" id="txtnim" name="txtnim" placeholder="Masukkan NIM" required
               value="<?= isset($old_bio['nim']) ? htmlspecialchars($old_bio['nim']) : '' ?>">
      </label>

      <label for="txtnama_lengkap"><span>Nama Lengkap:</span>
        <input type="text" id="txtnama_lengkap" name="txtnama_lengkap" placeholder="Masukkan Nama Lengkap" required
               value="<?= isset($old_bio['nama_lengkap']) ? htmlspecialchars($old_bio['nama_lengkap']) : '' ?>">
      </label>

      <label for="txttempat_lahir"><span>Tempat Lahir:</span>
        <input type="text" id="txttempat_lahir" name="txttempat_lahir" placeholder="Masukkan Tempat Lahir" required
               value="<?= isset($old_bio['tempat_lahir']) ? htmlspecialchars($old_bio['tempat_lahir']) : '' ?>">
      </label>

      <label for="txttanggal_lahir"><span>Tanggal Lahir:</span>
        <input type="text" id="txttanggal_lahir" name="txttanggal_lahir" placeholder="Masukkan Tanggal Lahir" required
               value="<?= isset($old_bio['tanggal_lahir']) ? htmlspecialchars($old_bio['tanggal_lahir']) : '' ?>">
      </label>

      <label for="txtHobi"><span>Hobi:</span>
        <input type="text" id="txtHobi" name="txtHobi" placeholder="Masukkan Hobi" required
               value="<?= isset($old_bio['hobi']) ? htmlspecialchars($old_bio['hobi']) : '' ?>">
      </label>

      <label for="txtPasangan"><span>Pasangan:</span>
        <input type="text" id="txtPasangan" name="txtPasangan" placeholder="Masukkan Pasangan" required
               value="<?= isset($old_bio['pasangan']) ? htmlspecialchars($old_bio['pasangan']) : '' ?>">
      </label>

      <label for="txtpekerjaan"><span>Pekerjaan:</span>
        <input type="text" id="txtpekerjaan" name="txtpekerjaan" placeholder="Masukkan Pekerjaan" required
               value="<?= isset($old_bio['pekerjaan']) ? htmlspecialchars($old_bio['pekerjaan']) : '' ?>">
      </label>

      <label for="txtnama_orang_tua"><span>Nama Orang Tua:</span>
        <input type="text" id="txtnama_orang_tua" name="txtnama_orang_tua" placeholder="Masukkan Nama Orang Tua" required
               value="<?= isset($old_bio['nama_orang_tua']) ? htmlspecialchars($old_bio['nama_orang_tua']) : '' ?>">
      </label>

      <label for="txtnama_kakak"><span>Nama Kakak:</span>
        <input type="text" id="txtnama_kakak" name="txtnama_kakak" placeholder="Masukkan Nama Kakak" required
               value="<?= isset($old_bio['nama_kakak']) ? htmlspecialchars($old_bio['nama_kakak']) : '' ?>">
      </label>

      <label for="txtnama_adik"><span>Nama Adik:</span>
        <input type="text" id="txtnama_adik" name="txtnama_adik" placeholder="Masukkan Nama Adik" required
               value="<?= isset($old_bio['nama_adik']) ? htmlspecialchars($old_bio['nama_adik']) : '' ?>">
      </label>

      <button type="submit">Kirim</button>
      <button type="reset">Batal</button>
    </form>
  </section>

  <!-- ================= ABOUT ================= -->
  <section id="about">
    <h2>Tentang Saya</h2>
    <?= tampilkanBiodata($fieldConfig, $biodata) ?>
  </section>

  <!-- ================= CONTACT ================= -->
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
      <input type="hidden" name="form_type" value="contact">

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

    <br>
    <hr>
    <h2>Yang menghubungi kami</h2>
    <?php include 'read.php'; ?>
  </section>
</main>

<footer>
  <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
</footer>

<script src="script.js"></script>
</body>
</html>
