# pertemuan-05
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

    .menu-toggle {
      position: absolute;
      right: 20px;
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
    #contact {
      background-color: #003366;
      border-radius: 10px;
      padding: 20px;
      max-width: 700px;
      margin: 20px auto;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #about h2,
    #contact h2 {
      border-bottom: 2px solid #e6e6e6;
      padding-bottom: 6px;
      margin-top: 0;
      margin-bottom: 16px;
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
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="home">
      <h2>Selamat Datang</h2>
      <p>Ini contoh halaman dengan JavaScript eksternal.</p>
      <?php
        echo "Halo Dunia!<br>"
        echo "Nama Saya GALANG NURHAFIZD"
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
        ?>

      <h2>About GALANG NURHAFIZD</h2>
      <p><strong>NIM:</strong> <?php echo $NIM ?></p>
      <p><strong>Nama Lengkap:</strong> GALANG NURHAFIZD &#9787;</p>
      <p><strong>Tempat Lahir:</strong> PANGKALPINANG</p>
      <p><strong>Tanggal Lahir:</strong> 6 Mei 2007</p>
      <p><strong>Hobi:</strong> Tidur, Main Musik, Seni &#9787;</p>
      <p><strong>Pasangan:</strong> Belum Ada &#128546;</p>
      <p><strong>Pekerjaan:</strong> Kuliah di ISB ATMA LUHUR</p>
      <p><strong>Nama Orang Tua:</strong> Bapak Chandra dan Ibu Norma</p>
      <p><strong>Nama Kakak:</strong> GALANG NURHAFIZD</p>
      <p><strong>Nama Adik:</strong> Galang dan Nadila</p>
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
