<?php
session_start();

$sesnama = $_SESSION["sesnama"] ?? "";
$sesemail = $_SESSION["sesemail"] ?? "";
$sespesan = $_SESSION["sespesan"] ?? "";

$sesnim = $_SESSION["nim"] ?? "";
$sesnama_mhs = $_SESSION["nama"] ?? "";
$sestempat = $_SESSION["tempat"] ?? "";
$sestgl_lahir = $_SESSION["tgl_lahir"] ?? "";
$seshobi = $_SESSION["hobi"] ?? "";
$sespasangan = $_SESSION["pasangan"] ?? "";
$sespekerjaan = $_SESSION["pekerjaan"] ?? "";
$sesortu = $_SESSION["ortu"] ?? "";
$seskakak = $_SESSION["kakak"] ?? "";
$sesadik = $_SESSION["adik"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entry Data Mahasiswa</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Data Mahasiswa ISB Atma Luhur</h1>
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
      &#9776;
    </button>
    <nav>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#Data">Entry Data</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    
    <section id="home">
      <h2>Selamat Datang</h2>
      <p>Halo dunia! Ini adalah contoh halaman PHP untuk mengelola data mahasiswa.</p>
    </section>

    
    <section id="Data">
      <h2>Entry Data Mahasiswa</h2>
      <form action="proses.php" method="POST">

        <label><span>NIM:</span>
          <input type="text" name="nim" placeholder="Masukkan NIM" required>
        </label>

        <label><span>Nama Lengkap:</span>
          <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
        </label>

        <label><span>Tempat Lahir:</span>
          <input type="text" name="tempat" placeholder="Masukkan Tempat Lahir" required>
        </label>

        <label><span>Tanggal Lahir:</span>
          <input type="text" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" required>
        </label>

        <label><span>Hobi:</span>
          <input type="text" name="hobi" placeholder="Masukkan Hobi" required>
        </label>

        <label><span>Pasangan:</span>
          <input type="text" name="pasangan" placeholder="Masukkan Nama Pasangan">
        </label>

        <label><span>Pekerjaan:</span>
          <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan">
        </label>

        <label><span>Nama Orang Tua:</span>
          <input type="text" name="ortu" placeholder="Masukkan Nama Orang Tua" required>
        </label>

        <label><span>Nama Kakak:</span>
          <input type="text" name="kakak" placeholder="Masukkan Nama Kakak">
        </label>

        <label><span>Nama Adik:</span>
          <input type="text" name="adik" placeholder="Masukkan Nama Adik">
        </label>

        <button type="submit" name="submit_data">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>

    
    <section id="about">
      <h2>Data Mahasiswa</h2>
      <?php if (!empty($sesnim)): ?>
        <p><strong>NIM:</strong> <?= htmlspecialchars($sesnim) ?></p>
        <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($sesnama_mhs) ?></p>
        <p><strong>Tempat Lahir:</strong> <?= htmlspecialchars($sestempat) ?></p>
        <p><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($sestgl_lahir) ?></p>
        <p><strong>Hobi:</strong> <?= htmlspecialchars($seshobi) ?></p>
        <p><strong>Pasangan:</strong> <?= htmlspecialchars($sespasangan) ?></p>
        <p><strong>Pekerjaan:</strong> <?= htmlspecialchars($sespekerjaan) ?></p>
        <p><strong>Nama Orang Tua:</strong> <?= htmlspecialchars($sesortu) ?></p>
        <p><strong>Nama Kakak:</strong> <?= htmlspecialchars($seskakak) ?></p>
        <p><strong>Nama Adik:</strong> <?= htmlspecialchars($sesadik) ?></p>
      <?php else: ?>
        <p>Belum ada data yang dimasukkan.</p>
      <?php endif; ?>
    </section>

    
    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="proses.php" method="POST">
        <label><span>Nama:</span>
          <input type="text" name="txtNama" placeholder="Masukkan Nama" required>
        </label>

        <label><span>Email:</span>
          <input type="email" name="txtEmail" placeholder="Masukkan Email" required>
        </label>

        <label><span>Pesan Anda:</span>
          <textarea name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
        </label>

        <button type="submit" name="submit_contact">Kirim</button>
        <button type="reset">Batal</button>
      </form>

      <?php if (!empty($sesnama)): ?>
        <hr>
        <h3>Yang Menghubungi Kami:</h3>
        <p><strong>Nama:</strong> <?= htmlspecialchars($sesnama) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($sesemail) ?></p>
        <p><strong>Pesan:</strong> <?= htmlspecialchars($sespesan) ?></p>
      <?php endif; ?>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
