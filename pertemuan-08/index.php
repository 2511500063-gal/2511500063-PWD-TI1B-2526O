<?php
session_start();
$sesnama = $_SESSION["sesnama"] ?? "";
$sesemail = $_SESSION["sesemail"] ?? "";
$sespesan = $_SESSION["sespesan"] ?? "";

$sesnim = $_SESSION["nim"] ?? "";
$sesnama = $_SESSION["nama"] ?? "";
$ses_tempat = $_SESSION["tempat"] ?? "";
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
  <title>Judul Halaman</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Ini Header</h1>
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
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
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
      <input type="text" name="pasangan" placeholder="Masukkan Nama Pasangan" required>
    </label>

    <label><span>Pekerjaan:</span>
      <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan" required>
    </label>

    <label><span>Nama Orang Tua:</span>
      <input type="text" name="ortu" placeholder="Masukkan Nama Orang Tua" required>
    </label>

    <label><span>Nama Kakak:</span>
      <input type="text" name="kakak" placeholder="Masukkan Nama Kakak" required>
    </label>

    <label><span>Nama Adik:</span>
      <input type="text" name="adik" placeholder="Masukkan Nama Adik" required>
    </label>

    <button type="submit" name="submit_data">Kirim</button>
    <button type="reset">Batal</button>
  </form>
</section>

<section id="about">
  <h2>Data Mahasiswa</h2>
  <p><strong>NIM:</strong> <?= htmlspecialchars($sesnim) ?></p>
  <p><strong>Nama Lengkap:</strong> <?= htmlspecialchars($sesnama) ?></p>
  <p><strong>Tempat Lahir:</strong> <?= htmlspecialchars($_SESSION["tempat"] ?? "") ?></p>
  <p><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($sestgl_lahir) ?></p>
  <p><strong>Hobi:</strong> <?= htmlspecialchars($seshobi) ?></p>
  <p><strong>Pasangan:</strong> <?= htmlspecialchars($sespasangan) ?></p>
  <p><strong>Pekerjaan:</strong> <?= htmlspecialchars($sespekerjaan) ?></p>
  <p><strong>Nama Orang Tua:</strong> <?= htmlspecialchars($sesortu) ?></p>
  <p><strong>Nama Kakak:</strong> <?= htmlspecialchars($seskakak) ?></p>
  <p><strong>Nama Adik:</strong> <?= htmlspecialchars($sesadik) ?></p>
</section>


    <section id="about">
      <?php
      $nim = 2511500010;
      $NIM = '0344300002';
      $nama = "Say'yid Abdullah";
      $Nama = 'Al\'kautar Benyamin';
      $tempat = "Jebus";
      ?>
      <h2>Tentang Saya</h2>
      <p><strong>NIM:</strong>
        <?php
        echo $NIM;
        ?>
      </p>
      <p><strong>Nama Lengkap:</strong>
        <?php
        echo $Nama;
        ?> &#128526;
      </p>
      <p><strong>Tempat Lahir:</strong> <?php echo $tempat; ?></p>
      <p><strong>Tanggal Lahir:</strong> 1 Januari 2000</p>
      <p><strong>Hobi:</strong> Memasak, coding, dan bermain musik &#127926;</p>
      <p><strong>Pasangan:</strong> Belum ada &hearts;</p>
      <p><strong>Pekerjaan:</strong> Dosen di ISB Atma Luhur &copy; 2025</p>
      <p><strong>Nama Orang Tua:</strong> Bapak Setiawan dan Ibu Maria</p>
      <p><strong>Nama Kakak:</strong> Antonius Setiawan</p>
      <p><strong>Nama Adik:</strong> <?php echo $sespesan ?></p>
    </section>

    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="proses.php" method="POST">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>

      <?php if (!empty($sesnama)): ?>
        <br><hr>
        <h2>Yang menghubungi kami</h2>
        <p><strong>Nama :</strong> <?php echo $sesnama ?></p>
        <p><strong>Email :</strong> <?php echo $sesemail ?></p>
        <p><strong>Pesan :</strong> <?php echo $sespesan ?></p>
      <?php endif; ?>



    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>