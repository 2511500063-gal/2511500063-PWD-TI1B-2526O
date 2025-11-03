document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("menuToggle");
  const nav = document.querySelector("nav");

  menuToggle.addEventListener("click", function () {
    nav.classList.toggle("active");

    if (nav.classList.contains("active")) {
      this.textContent = "\u2716"; 
    } else {
      this.textContent = "\u2630"; 
    }
  });

  const homeSection = document.getElementById("home");
  const ucapan = document.createElement("p");
  ucapan.textContent = "Halo! Selamat datang di halaman saya!";
  homeSection.appendChild(ucapan);

  document.getElementById("output").innerHTML = "<h2>Halo Dunia!</h2>";


  document.getElementById("tanyaBtn").addEventListener("click", tanyaNama);
  document.getElementById("ubahTeksBtn").addEventListener("click", ubahTeks);
  document.getElementById("cekBtn").addEventListener("click", cekNama);

  const form = document.querySelector("form");
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const nama = document.getElementById("txtNama");
    const email = document.getElementById("txtEmail");
    const pesan = document.getElementById("txtPesan");

    document.querySelectorAll(".error-msg").forEach(el => el.remove());
    [nama, email, pesan].forEach(el => (el.style.border = ""));

    let isValid = true;

    if (nama.value.trim().length < 3) {
      showError(nama, "Nama minimal 3 huruf dan tidak boleh kosong.");
      isValid = false;
    } else if (!/^[A-Za-z\s]+$/.test(nama.value.trim())) {
      showError(nama, "Nama hanya boleh berisi huruf dan spasi.");
      isValid = false;
    }

    if (email.value.trim() === "") {
      showError(email, "Email wajib diisi.");
      isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
      showError(email, "Format email tidak valid. Contoh: nama@mail.com");
      isValid = false;
    }

    if (pesan.value.trim().length < 10) {
      showError(pesan, "Pesan minimal 10 karakter agar lebih jelas.");
      isValid = false;
    }

    if (isValid) {
      alert("Terima kasih, " + nama.value + "!\nPesan Anda telah dikirim.");
      form.reset();
    }
  });

  
  document.getElementById("txtPesan").addEventListener("input", function () {
    const panjang = this.value.length;
    document.getElementById("charCount").textContent = panjang + "/200 karakter";
  });

  
  alert("Halo, Selamat Datang!");
});


function tanyaNama() {
  let nama = prompt("Siapa nama kamu?");
  alert(nama ? "Halo, " + nama + "!" : "Nama tidak diisi.");
}

function ubahTeks() {
  document.getElementById("pesan").innerText = "Teks berhasil diubah!";
}

function cekNama() {
  let nama = document.getElementById("namaLatihan").value;
  alert(nama ? "Halo, " + nama + "!" : "Nama tidak boleh kosong!");
}

function showError(inputElement, message) {
  const label = inputElement.closest("label");
  if (!label) return;

  const small = document.createElement("small");
  small.className = "error-msg";
  small.textContent = message;
  small.style.color = "red";
  small.style.display = "block";
  small.style.marginTop = "4px";

  label.appendChild(small);
  inputElement.style.border = "1px solid red";
}
