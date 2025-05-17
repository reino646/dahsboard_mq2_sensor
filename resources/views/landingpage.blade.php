<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SmokePeek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="icon" type="image/png" href="/img/fire.png" />
  </head>
  <body class="font-sans">
    <!-- Header -->
    <header class="fixed w-full z-50 bg-gradient-to-r from-red-500 via-orange-400 to-yellow-400 backdrop-blur-lg shadow-lg px-4 py-3">
      <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <img src="/img/Logo TRK.png" alt="Logo SmokePeek" class="h-12" />

        <!-- Navigation Desktop -->
        <nav class="hidden md:flex gap-6 items-center">
          <a href="home.html" class="text-red-500 font-bold hover:text-red-500">Home</a>
          <a href="aboutus.html" class="text-orange-100 font-bold hover:text-red-500">About Us</a>
          <a href="contactus.html" class="text-orange-100 font-bold hover:text-red-500">Contact Us</a>

          <!-- Login Button with User Icon -->
          <a
            href="/login"
            class="border border-red-500 text-white px-2 py-2 rounded bg-red-500 font-semibold transition-colors duration-300 flex items-center justify-center gap-2"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a8.25 8.25 0 0115 0" />
            </svg>
          </a>
        </nav>

        <!-- Mobile Menu Toggle -->
        <div class="md:hidden">
          <button id="menuToggle" class="text-gray-600">
            <i class="bi bi-list text-2xl"></i>
          </button>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div id="mobileMenu" class="hidden md:hidden flex-col gap-2 px-4 pb-3">
        <a href="home.html" class="block text-gray-600 font-semibold">Home</a>
        <a href="aboutus.html" class="block text-gray-600 font-semibold">About Us</a>
        <a href="contactus.html" class="block text-gray-600 font-semibold">Contact Us</a>
      </div>
    </header>

    <!-- Hero -->
    <section class="bg-orange-100 h-screen flex flex-col lg:flex-row items-center justify-between px-6 text-black">
      <!-- Konten Teks -->
      <div data-aos="fade-up" class="w-full lg:w-1/2 lg:pl-20 mb-8 lg:mb-0 text-left mt-10">
        <h1 class="text-4xl md:text-6xl font-bold text-red-600 mt-10">SmokePeek <br />Anti <span class="text-orange-500">Kebakaran!</span></h1>
        <p class="mt-4 text-lg md:text-md opacity-50">Platform digital yang menyediakan informasi cuaca lengkap dan real-time di sekitar lokasimu. Dengan HujanGa, kamu bisa selalu siap menghadapi perubahan cuaca kapan pun.</p>

        <!-- Tombol -->
        <div class="mt-6 flex flex-col sm:flex-row gap-4">
          <a
            href="/login"
            class="inline-block border border-red-500 text-white px-6 py-2 rounded bg-gradient-to-r from-red-500 via-orange-400 to-yellow-400 hover:from-yellow-500 hover:via-orange-500 hover:to-red-500 font-semibold transition-colors duration-300"
          >
            Login
          </a>

          <a href="/users" class="inline-block border border-red-500 text-orange-500 px-6 py-2 font-semibold rounded hover:bg-red-600 hover:text-white transition-colors duration-300"> Sign Up </a>
        </div>

        <!-- Statistik -->
        <div class="mt-10 flex gap-10">
          <div class="text-center">
            <h3 class="text-red-500 text-2xl font-bold">1.0</h3>
            <p class="text-sm">Versi</p>
          </div>
          <div class="border-l border-slate-300 h-full"></div>
          <div class="text-center">
            <h3 class="text-red-500 text-2xl font-bold">200+</h3>
            <p class="text-sm">Pengguna</p>
          </div>
          <div class="border-l border-slate-300 h-full"></div>
          <div class="text-center">
            <h3 class="text-red-500 text-2xl font-bold">10</h3>
            <p class="text-sm">Penghargaan</p>
          </div>
        </div>
      </div>

      <!-- Gambar -->
      <div class="w-full lg:w-1/2 justify-center" data-aos="fade-up" data-aos-delay="100">
        <div class="w-fit h-[350px] sm:h-[450px] lg:h-[500px] rounded-lg flex items-center shadow-xl border border-orange-100 transition-colors">
          <img src="/img/fire.png" alt="Logo SmokePeek" class="object-contain h-full" />
        </div>
      </div>
    </section>

<!-- Latar Belakang -->
<section class="bg-orange-100 py-16" id="latarbelakang">
  <div class="max-w-6xl mx-auto text-center px-4 lg:px-8">
    
    <!-- Badge Sejarah -->
    <div class="flex justify-center mb-4" data-aos="fade-up">
      <h1 class="rounded-2xl px-5 py-2 text-white font-semibold bg-red-600">
        Sejarah
      </h1>
    </div>

    <!-- Judul -->
    <h2 class="text-red-600 text-2xl md:text-3xl font-bold mb-6" data-aos="fade-up">
      Kenapa Smoke Peek?
    </h2>

    <!-- Isi Konten -->
    <div class="bg-white rounded-xl shadow-xl p-6 md:p-10 w-30" data-aos="fade-up" data-aos-delay="100">
      <p class="text-sm leading-relaxed text-gray-800">
        <strong>SmokePeek</strong> adalah sistem IoT untuk memantau gas berbahaya secara real-time menggunakan sensor <strong>MQ2</strong> dan mikrokontroler <strong>ESP8266</strong>.
        Data dikirim via WiFi ke <strong>Firebase</strong> dan ditampilkan di antarmuka web responsif dengan grafik interaktif. Fitur <strong>threshold management</strong> mengatur ambang
        untuk buzzer, kipas, dan servo, serta mengirim notifikasi otomatis sebagai peringatan dini.
      </p>
    </div>

  </div>
</section>


    <!-- Fitur Unggulan -->
    <section id="fitur" class="py-24 pb-40 px-4 bg-orange-100">
      <div class="max-w-7xl mx-auto">
        <div class="flex justify-center mb-4" data-aos="fade-up">
          <h1 class="rounded-2xl px-5 py-2 text-white font-semibold bg-red-600">Our Features</h1>
        </div>
        <h2 class="text-red-600 text-2xl md:text-3xl font-bold text-center mb-12" data-aos="fade-up">Memenuhi Semua Kebutuhan Anda!</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white rounded-xl shadow p-6 text-center" data-aos="zoom-in" data-aos-delay="100">
            <i class="bi bi-graph-up-arrow text-3xl text-blue-500 mb-3"></i>
            <h5 class="font-bold">Monitoring Real-time</h5>
            <p>Data gas ditampilkan langsung dari sensor ke dashboard secara instan.</p>
          </div>

          <div class="bg-white rounded-xl shadow p-6 text-center" data-aos="zoom-in" data-aos-delay="200">
            <i class="bi bi-bell-fill text-3xl text-red-500 mb-3"></i>
            <h5 class="font-bold">Notifikasi Bahaya</h5>
            <p>Memberikan peringatan ketika tingkat gas melebihi batas aman.</p>
          </div>

          <div class="bg-white rounded-xl shadow p-6 text-center" data-aos="zoom-in" data-aos-delay="300">
            <i class="bi bi-people-fill text-3xl text-blue-400 mb-3"></i>
            <h5 class="font-bold">Manajemen User</h5>
            <p>Admin dapat melihat, mengatur role, dan mengelola akses user (CRUD).</p>
          </div>

          <div class="bg-white rounded-xl shadow p-6 text-center" data-aos="zoom-in" data-aos-delay="400">
            <i class="bi bi-sliders text-3xl text-blue-500 mb-3"></i>
            <h5 class="font-bold">Threshold Management</h5>
            <p>Atur ambang batas PPM, output yang dihasilkan, dan riwayatnya (CRUD).</p>
          </div>

          <div class="bg-white rounded-xl shadow p-6 text-center" data-aos="zoom-in" data-aos-delay="500">
            <i class="bi bi-clock-history text-3xl text-red-500 mb-3"></i>
            <h5 class="font-bold">History Monitoring</h5>
            <p>Melihat, filter, dan hapus riwayat grafik berdasarkan waktu atau rentang tertentu.</p>
          </div>

          <div class="bg-white rounded-xl shadow p-6 text-center" data-aos="zoom-in" data-aos-delay="600">
            <i class="bi bi-file-earmark-arrow-down text-3xl text-green-500 mb-3"></i>
            <h5 class="font-bold">Ekspor & Filter Data</h5>
            <p>Filter dan unduh data berdasarkan kebutuhan untuk analisis lanjutan.</p>
          </div>
        </div>
      </div>
    </section>

<!-- Tim Kami -->
<section class="py-12 bg-orange-100">
  <div class="max-w-7xl mx-auto px-4 text-center">

    <!-- Badge -->
    <div class="flex justify-center mb-4" data-aos="fade-up">
      <h1 class="rounded-2xl px-5 py-2 text-white font-semibold bg-red-600">
        Our Team
      </h1>
    </div>

    <!-- Subjudul -->
    <h2 class="text-red-600 text-2xl md:text-3xl font-bold mb-10" data-aos="fade-up">
      Siapa Orang Dibalik SmokePeek?
    </h2>

    <!-- Card Tim -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-40">
      <!-- Card 1 -->
      <div class="bg-white p-6 rounded-xl shadow-2xl hover:shadow-3xl transition duration-300" data-aos="fade-up" data-aos-delay="100">
        <img src="/img/Reino.jpg" alt="Reino Aimar Rafif"
          class="w-full h-80 object-cover rounded-xl mb-4" />
        <h5 class=" text-lg font-semibold">Reino Aimar Rafif</h5>
        <p class="text-gray-500">Fullstack Developer</p>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-6 rounded-xl shadow-2xl hover:shadow-3xl transition duration-300" data-aos="fade-up" data-aos-delay="200">
        <img src="/img/Azizul.jpg" alt="Mohamad Azizul Hakim"
          class="w-full h-80 object-cover rounded-xl mb-4" />
        <h5 class="text-lg font-semibold">Mohamad Azizul Hakim</h5>
        <p class="text-gray-500">Backend Developer</p>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-6 rounded-xl shadow-2xl hover:shadow-3xl transition duration-300" data-aos="fade-up" data-aos-delay="300">
        <img src="/img/Rfiki.jpg" alt="Muhammad Rifki Munawar"
          class="w-full h-80 object-cover rounded-xl mb-4" />
        <h5 class="text-lg font-semibold">Muhammad Rifki Munawar</h5>
        <p class="text-gray-500">UI/UX Designer</p>
      </div>
    </div>

  </div>
</section>



<!-- Contact Section -->
<section class="py-16 bg-orange-100" id="contact">
  <div class="max-w-7xl mx-auto px-4">
    
    <!-- Badge -->
    <div class="flex justify-center mb-4" data-aos="fade-up">
      <h1 class="rounded-2xl px-5 py-2 text-white font-semibold bg-red-600">
        Our Contact
      </h1>
    </div>

    <!-- Subjudul -->
    <h2 class="text-red-600 text-2xl md:text-3xl font-bold mb-4 text-center" data-aos="fade-up">
      Hubungi Kami Segera!
    </h2>
    
    <p class="text-center text-gray-600 mb-10 max-w-2xl mx-auto" data-aos="fade-up">
      Punya pertanyaan, kritik, saran, atau sekadar ingin memberi apresiasi? Kami siap mendengarkan. Jangan ragu untuk menghubungi kami melalui form di bawah ini!
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      
      <!-- Formulir -->
      <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8" data-aos="fade-right">
        <form id="contact-form">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Nama Anda"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
              required
            />
          </div>

          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="email@domain.com"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
              required
            />
          </div>

          <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
            <textarea
              id="message"
              name="message"
              rows="5"
              placeholder="Tulis pesan Anda di sini..."
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
              required
            ></textarea>
          </div>

          <button
            type="submit"
            class="bg-gradient-to-r from-red-500 via-orange-400 to-yellow-400 hover:from-yellow-500 hover:to-red-500 text-white font-semibold py-2 px-6 rounded-md transition-all duration-300"
          >
            Kirim Pesan
          </button>
        </form>
      </div>

      <!-- Informasi Kontak -->
      <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8" data-aos="fade-left">
        <div class="space-y-6 text-gray-700 text-sm md:text-base">
          
          <div>
            <h5 class="font-semibold flex items-center mb-1">
              <i class="fas fa-map-marker-alt text-red-500 mr-2"></i> Alamat
            </h5>
            <p>Jl. Kumbang No.14, RT.02/RW.06, Babakan, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat</p>
          </div>

          <div>
            <h5 class="font-semibold flex items-center mb-1">
              <i class="fas fa-envelope text-blue-500 mr-2"></i> Email
            </h5>
            <p>
              <a href="mailto:azizulkjool@gmail.com" class="hover:underline">azizulkjool@gmail.com</a>
            </p>
          </div>

          <div>
            <h5 class="font-semibold flex items-center mb-1">
              <i class="fab fa-instagram text-pink-500 mr-2"></i> Instagram
            </h5>
            <p>
              <a href="#" class="hover:underline">@smokepeek.id</a>
            </p>
          </div>

          <div>
            <h5 class="font-semibold flex items-center mb-1">
              <i class="fas fa-clock text-yellow-500 mr-2"></i> Jam Operasional
            </h5>
            <p>Senin - Jumat: 08.00 - 17.00 WIB</p>
          </div>
          
        </div>
      </div>

    </div>
  </div>

  <!-- EmailJS -->
  <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
  <script>
    (function () {
      emailjs.init("8TJ8lh7CuXk3Xh78C");
    })();

    function sendMail(e) {
      e.preventDefault();

      emailjs.sendForm('service_l763hus', 'template_49mu0g6', '#contact-form')
        .then(function (response) {
          alert("Pesan berhasil dikirim!");
        }, function (error) {
          alert("Gagal mengirim pesan: " + JSON.stringify(error));
        });
    }

    document.getElementById("contact-form").addEventListener("submit", sendMail);
  </script>
</section>



    <!-- Footer -->
    <footer class="bg-white text-gray-600 mt-10">
      <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="flex items-center gap-3">
          <img src="/img/fire.png" alt="Logo Api" class="w-8 h-8" />
          <h4 class="text-lg font-bold text-red-600">SmokePeek</h4>
        </div>
        <div>
          <h5 class="font-bold mb-3">Tautan</h5>
          <ul class="space-y-1">
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="contactus.html">Contact Us</a></li>
          </ul>
        </div>
        <div>
          <h5 class="font-bold mb-3">Follow Us</h5>
          <ul class="space-y-1">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Instagram</a></li>
          </ul>
        </div>
        <div>
          <h5 class="font-bold mb-3">Legal</h5>
          <ul class="space-y-1">
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
        </div>
      </div>
      <div class="border-t py-4 text-center text-sm">&copy; 2025 SmokePeek. All Rights Reserved.</div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script>
      document.getElementById('menuToggle').addEventListener('click', () => {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
      });
    </script>
  </body>
</html>
