<?php
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>latihan_php1</title>
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        /* Tambahkan CSS untuk mengubah warna latar belakang saat tema gelap */
        
        .bg-danger-subtle.dark-theme {
            background-color: white !important;
            /* Ubah warna latar belakang menjadi putih */
            color: black !important;
            /* Ubah warna teks menjadi hitam */
        }
        /* Tambahkan CSS untuk mengubah warna ikon saat tema gelap */
        
        .dark-theme .bi {
            color: white !important;
            /* Ubah warna ikon menjadi putih */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <b> <a class="navbar-brand" href="/">Mengenal Asia Tenggara</a> </b>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about me">About Me</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="login.php" target="_blank">Login</a>
                    </li>
                    <button id="dark" type="button" class="btn btn-dark">
              <i class="bi bi-moon-stars"></i>
            </button>
                    <button id="light" type="button" class="btn btn-light">
              <i class="bi bi-brightness-high"></i>
            </button>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="text-center p-5 bg-danger-subtle text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="assets/asean.jpg" class="asean" width="300" height="400" />
                <div>
                    <h1 class="fw-bold fs-2">Negara Di Asia Tenggara</h1>
                    <h4 class="lead fs-4">
                        Asia Tenggara adalah wilayah yang terletak di bagian tenggara benua Asia. Wilayah ini mencakup Semenanjung Indochina dan Semenanjung Malaka, serta Kepulauan Nusantara.Asia Tenggara terletak di dekat persimpangan lempeng tektonik, dengan aktivitas seismik
                        dan vulkanik yang tinggi.
                    </h4>
                    <h6>
                        <span id="tanggal"></span>
                        <span id="jam"> </span>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    
    <!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->

    <section id="galery" class="text-center p-5 bg-danger-subtle">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                src="assets/asean2.jpg"
                class="d-block w-100"
                alt="asean2"
              />
            </div>
            <div class="carousel-item">
              <img
                src="assets/asean3.jpg"
                class="d-block w-100"
                alt="asean3"
              />
            </div>
            <div class="carousel-item">
              <img src="assets/asean4.webp"
              class="d-block w-100" 
              alt="asean4" />
            </div>
            <div class="carousel-item">
              <img
                src="assets/asean5.webp"
                class="d-block w-100"
                alt="asean6"
              />
            </div>
            <div class="carousel-item">
              <img src="assets/asean6.webp" 
              class="d-block w-100" 
              alt="asean7" />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </section>
    <main class="container text-center my-5">
      <section id="schedule" class="text-center p-5">
      <h2 class="fw-bold display-4"> Schedule</h2>
      <div class="row mt-4">
        <!-- Monday Schedule -->
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-danger text-white">SENIN</div>
            <div class="card-body">
              <p>Basis Data<br>10.20-12.00 | H.5.14</p>
              <hr>
              <p>Technopreneurship<br>12.30-14.10 | KULINO</p>
            </div>
          </div>
        </div>
        <!-- Tuesday Schedule -->
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-danger text-white">SELASA</div>
            <div class="card-body">
              <p>Basis Data<br>10.20-12.00 | D.3.M</p>
              <hr>
              <p>Pendidikan Kewarnegaraan<br>12.30-12.10 | AULA.H7</p>
              <hr>
              <p>Sistem Operasi<br>15.30-18.00 | H.4.7</p>
            </div>
          </div>
        </div>
        <!-- Wednesday Schedule -->
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-danger text-white">RABU</div>
            <div class="card-body">
              <p>Logika Informatika<br>15.30-18.00 | H.4.10</p>
            </div>
          </div>
        </div>
        <!-- Thursday Schedule -->
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-danger text-white">KAMIS</div>
            <div class="card-body">
              <p>Pemrograman Berbasi Web<br>10.20-10.20 | D.2.J</p>
              <hr>
              <p>Rekayasa Perangkat Lunak<br>12.30-15.00 | H.5.4</p>
            </div>
          </div>
        </div>
        <!-- Friday Schedule -->
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-danger text-white">JUMAT</div>
            <div class="card-body">
              <p>Probabilitas dan Statistik<br>10.20-12.00 | H.3.8</p>
            </div>
          </div>
        </div>
        <!-- Saturday Schedule -->
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header bg-danger text-white">SABTU</div>
            <div class="card-body">
              <p>FREE</p>
            </div>
          </div>
        </div>
      </div>
    
    <section id="about me" class="text-center p-5 bg-danger-subtle">
      <div class="container">
        <div>
          <div class="row row-cols-1 row-cols-md-2 mx-auto">
              <img src="assets/windah.jpg" alt="" class="rounded-circle w-auto mx-0 mx-md-5" style="height: 270px;">
              <div class="text-center my-3 my-md-auto text-md-start"> <!-- Ubah dari text-start ke text-start dan text-md-center -->
                <p class="fs-5 m-0">A11.2023.15455</p>
                <b><p class="fs-2 m-0">Dede Nur Fikri</p></b>
                <p class="fs-5 m-0">Teknik Informatika</p>
                <b><p class="fs-5 m-0">Universitas Dian Nuswantoro</p></b>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="text-center p-5" style="background-color: #000;">
      <div>
        <a href=""><i class="bi bi-instagram h2 p-2 text-white"></i></a> <!-- Ubah text-dark menjadi text-white -->
        <a href=""><i class="bi bi-twitter-x h2 p-2 text-white"></i></a> <!-- Ubah text-dark menjadi text-white -->
        <a href=""><i class="bi bi-whatsapp h2 p-2 text-white"></i></a> <!-- Ubah text-dark menjadi text-white -->
      </div>
      <div class="mt-2"><span class="text-white">Dede Nur Fikri © 2023</span></div> <!-- Tambahkan class text-white -->
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      window.setTimeout("tampilWaktu()", 1000);

      function tampilWaktu() {
          var waktu = new Date();
          var bulan = waktu.getMonth() + 1;

          setTimeout("tampilWaktu()", 1000);
          document.getElementById("tanggal").innerHTML =
              waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
          document.getElementById("jam").innerHTML =
              waktu.getHours() +
              ":" +
              waktu.getMinutes() +
              ";" +
              waktu.getSeconds();
      }
    </script>

    <script type="text/javascript">
      document.getElementById("dark").onclick = function () {
        document.body.classList.add("bg-dark", "text-white");
        document.body.classList.remove("bg-light", "text-dark");
        document.querySelectorAll('.bg-danger-subtle').forEach(function(element) {
            element.classList.add('dark-theme');
        });
      };
      document.getElementById("light").onclick = function () {
        document.body.classList.add("bg-light", "text-dark");
        document.body.classList.remove("bg-dark", "text-white");
        document.querySelectorAll('.bg-danger-subtle').forEach(function(element) {
            element.classList.remove('dark-theme');
        });
      };
    </script>
  </body>
</html>