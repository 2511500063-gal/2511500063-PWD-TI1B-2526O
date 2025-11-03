# pertemuan-06
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galang Nurhafizd</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #003366;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    header {
      background-color: #001f33;
      padding: 20px;
      color: #fff;
      text-align: center;
      position: relative;
    }

    .menuToggle {
      position: absolute;
      left: 20px;
      top: 20px;
      background: none;
      color: #fff;
      font-size: 24px;
      border: none;
      cursor: pointer;
      display: none;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
      margin: 10px 0 0 0;
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-weight: bold;
    }

    nav a:hover {
      text-decoration: underline;
    }

    section {
      padding: 20px;
      color: #e6e6e6;
    }

    #about,
    #contact,
    #ipk {
      background-color: #fff;
      border-radius: 10px;
      padding: 20px;
      max-width: 700px;
      margin: 20px auto;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: right;
    }

    #about h2,
    #contact h2,
    #ipk h2 {
      border-bottom: 2px solid #e6e6e6;
      padding-bottom: 6px;
      margin-top: 0;
      margin-bottom: 16px;
      text-align: left;
    }

    #about p,
    #contact label {
      display: flex;
      justify-content: flex-start;
      align-items: baseline;
      margin: 0;
      padding: 6px 0;
      border-bottom: 1px solid #e6e6e6;
    }

    #about strong,
    #contact label>span {
      min-width: 180px;
      font-weight: 600;
      text-align: right;
      padding-right: 16px;
      flex-shrink: 0;
    }

    #contact input,
    #contact textarea {
      flex: 1;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 8px;
      color: #000;
      margin: 0;
      box-sizing: border-box;
    }

    #contact button {
      margin-top: 10px;
      display: inline-block;
      padding: 10px 24px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      border: none;
      transition: all 0.3s ease;
      margin-right: 8px;
    }

    #contact button[type="submit"] {
      background-color: maroon;
      color: #fff;
      font-weight: 600;
    }

    #contact button[type="reset"] {
      background-color: #e6e6e6;
      color: #000;
      font-weight: 500;
    }

    #contact button[type="submit"]:hover {
      background-color: #0379ee;
      transform: translateY(-1px);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    #contact button[type="reset"]:hover {
      background-color: darkred;
      transform: translateY(-1px);
      color: #fff;
    }

    footer {
      background-color: #001f33;
      color: #e6e6e6;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }

    #output {
      text-align: center;
      color: yellow;
      font-weight: bold;
      margin-top: 20px;
    }

    @media (max-width:600px) {
      .menu-toggle {
        display: block;
      }

      nav ul {
        flex-direction: column;
        display: none;
      }

      nav.active ul {
        display: flex;
      }

      #about p,
      #contact label {
        flex-direction: column;
        align-items: flex-start;
      }

      #about strong,
      #contact label>span {
        text-align: left;
        margin-bottom: 4px;
      }

      #contact input,
      #contact textarea,
      #contact button {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <header>
    <h1>GALANG NURHAFIZD</h1>
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">&#9776;</button>
    <nav>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#ipk">Nilai Saya</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="home">
      <h2>Selamat Datang</h2>
      
      <?php
        echo "Halo Dunia!<br>"
      ?>

      <div id="output"></div>

      <button id="tanyaBtn">Tanya Nama</button>
      <button id="ubahTeksBtn">Ubah Teks</button>
      <p id="pesan">Teks awal</p>
      <input type="text" id="namaLatihan" placeholder="Masukkan nama">
      <button id="cekBtn">Cek Nama</button>
    </section>

    <section id="about">
      <?php
        $NIM = "2511500063";
        $nim = "2511500063";
        $nama = "GALANG NURHAFIZD";
        $tempat = "PANGKALPINANG";
        $tanggal = "6 Mei 2007";
        $Hobi = "Tidur, Musik, Seni";
        $Pasangan = "Belum Ada";
        $Pekerjaan = "Kuliah di ISB ATMA LUHUR";
        $Namaorangtua = "Bapak Chandra dan Ibu Norma";
        $Namakakak = "GALANG NURHAFIZD";
        $Namaadik = "Galang dan Nadila";
        ?>

      <h2>About GALANG NURHAFIZD</h2>
      <p><strong>NIM:</strong><?php echo $NIM ?></p>
      <p><strong>Nama Lengkap:</strong><?php echo $nama ?> &#9787;</p>
      <p><strong>Tempat Lahir:</strong><?php echo $tempat ?></p>
      <p><strong>Tanggal Lahir:</strong><?php echo $tanggal ?></p>
      <p><strong>Hobi:</strong><?php echo $Hobi ?> &#9787;</p>
      <p><strong>Pasangan:</strong><?php echo $Pasangan ?> &#128546;</p>
      <p><strong>Pekerjaan:</strong><?php echo $Pekerjaan ?></p>
      <p><strong>Nama Orang Tua:</strong><?php echo $Namaorangtua ?></p>
      <p><strong>Nama Kakak:</strong><?php echo $Namakakak ?></p>
      <p><strong>Nama Adik:</strong><?php echo $Namaadik ?></p>
    </section>

    <section id="ipk">
      <h2>Nilai Saya</h2>
      <?php
      $namaMatkul1 = "Algoritma dan Struktur Data";
      $namaMatkul2 = "Agama";
      $namaMatkul3 = "Konsep Basis Data";
      $namaMatkul4 = "Kalkulus";
      $namaMatkul5 = "Pemrograman Web Dasar";

      $sksMatkul1 = 4;
      $sksMatkul2 = 2;
      $sksMatkul3 = 4;
      $sksMatkul4 = 3;
      $sksMatkul5 = 3;

      $nilaiHadir1 = 90; $nilaiTugas1 = 60; $nilaiUTS1 = 80; $nilaiUAS1 = 70;
      $nilaiHadir2 = 70; $nilaiTugas2 = 50; $nilaiUTS2 = 60; $nilaiUAS2 = 80;
      $nilaiHadir3 = 80; $nilaiTugas3 = 70; $nilaiUTS3 = 85; $nilaiUAS3 = 90;
      $nilaiHadir4 = 85; $nilaiTugas4 = 75; $nilaiUTS4 = 70; $nilaiUAS4 = 80;
      $nilaiHadir5 = 69; $nilaiTugas5 = 80; $nilaiUTS5 = 90; $nilaiUAS5 = 100;

      function hitungNilaiAkhir($hadir, $tugas, $uts, $uas) {
        return (0.1 * $hadir) + (0.2 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
      }

      function tentukanGrade($nilaiAkhir, $nilaiHadir) {
        if ($nilaiHadir < 70) return 'E';
        if ($nilaiAkhir >= 85) return 'A';
        elseif ($nilaiAkhir >= 80) return 'A-';
        elseif ($nilaiAkhir >= 75) return 'B+';
        elseif ($nilaiAkhir >= 70) return 'B';
        elseif ($nilaiAkhir >= 65) return 'B-';
        elseif ($nilaiAkhir >= 60) return 'C+';
        elseif ($nilaiAkhir >= 55) return 'C';
        elseif ($nilaiAkhir >= 50) return 'C-';
        elseif ($nilaiAkhir >= 45) return 'D';
        else return 'E';
      }

      function nilaiMutu($grade) {
        switch ($grade) {
          case 'A': return 4.00;
          case 'A-': return 3.75;
          case 'B+': return 3.50;
          case 'B': return 3.00;
          case 'B-': return 2.70;
          case 'C+': return 2.50;
          case 'C': return 2.25;
          case 'C-': return 2.00;
          case 'D': return 1.00;
          default: return 0.00;
        }
      }

      function statusKelulusan($grade) {
        return in_array($grade, ['A','A-','B+','B','B-','C+','C','C-']) ? 'Lulus' : 'Gagal';
      }

      for ($i = 1; $i <= 5; $i++) {
        ${"nilaiAkhir$i"} = round(hitungNilaiAkhir(${"nilaiHadir$i"}, ${"nilaiTugas$i"}, ${"nilaiUTS$i"}, ${"nilaiUAS$i"}));
        ${"grade$i"} = tentukanGrade(${"nilaiAkhir$i"}, ${"nilaiHadir$i"});
        ${"mutu$i"} = nilaiMutu(${"grade$i"});
        ${"bobot$i"} = ${"mutu$i"} * ${"sksMatkul$i"};
        ${"status$i"} = statusKelulusan(${"grade$i"});
      }

      $totalSKS = $sksMatkul1 + $sksMatkul2 + $sksMatkul3 + $sksMatkul4 + $sksMatkul5;
      $totalBobot = $bobot1 + $bobot2 + $bobot3 + $bobot4 +$bobot5;
      $IPK = $totalBobot / $totalSKS;

      ?>

      <?php for ($i = 1; $i <= 5; $i++) { ?>
      <p><strong>Nama Matakuliah ke-<?= $i ?> :</strong> <?= ${"namaMatkul$i"} ?></p>
      <p><strong>SKS :</strong> <?= ${"sksMatkul$i"} ?></p>
      <p><strong>Kehadiran :</strong> <?= ${"nilaiHadir$i"} ?></p>
      <p><strong>Tugas :</strong> <?= ${"nilaiTugas$i"} ?></p>
      <p><strong>UTS :</strong> <?= ${"nilaiUTS$i"} ?></p>
      <p><strong>UAS :</strong> <?= ${"nilaiUAS$i"} ?></p>
      <p><strong>Nilai Akhir :</strong> <?= ${"nilaiAkhir$i"} ?></p>
      <p><strong>Grade :</strong> <?= ${"grade$i"} ?></p>
      <p><strong>Angka Mutu :</strong> <?= number_format(${"mutu$i"}, 2) ?></p>
      <p><strong>Bobot :</strong> <?= number_format(${"bobot$i"}, 2) ?></p>
      <p><strong>Status :</strong> <?= ${"status$i"} ?></p>
      <hr style="border:1px solid #ccc; margin:10px 0;">
    <?php } ?> 

    <p><strong>Total Bobot :</strong> <?= number_format($totalBobot, 2) ?></p>
    <p><strong>Total SKS :</strong> <?= $totalSKS ?></p>
    <p><strong>IPK :</strong> <?= number_format($IPK, 2) ?></p>

    </section>

    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="#" method="get">
        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>
        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>
        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200</small>
        </label>
        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 GALANG NURHAFIZD {2511500063}</p>
  </footer>

  <!-- JavaScript eksternal -->
  <script src="script.js" defer></script>
</body>
</html>
