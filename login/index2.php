<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta
    name="author"
    content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
  <meta name="generator" content="Astro v5.13.2" />
  <title>Album example · Bootstrap v5.3</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    rel="canonical"
    href="https://getbootstrap.com/docs/5.3/examples/album/" />
  <script src="assets/js/color-modes.js"></script>
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <meta name="theme-color" content="#fd5dcd" />
  
</head>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path
        d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
    </symbol>
  </svg>
  <div
    class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <ul
      class="dropdown-menu dropdown-menu-end shadow"
      aria-labelledby="bd-theme-text">
      <li>
        <button
          type="button"
          class="dropdown-item d-flex align-items-center"
          data-bs-theme-value="light"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#sun-fill"></use>
          </svg>
          Light
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button
          type="button"
          class="dropdown-item d-flex align-items-center"
          data-bs-theme-value="dark"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#moon-stars-fill"></use>
          </svg>
          Dark
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button
          type="button"
          class="dropdown-item d-flex align-items-center active"
          data-bs-theme-value="auto"
          aria-pressed="true">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#circle-half"></use>
          </svg>
          Auto
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
    </ul>
  </div>
  <header class="sticky-top z-50">
    <div class="collapse" id="navbarHeader" style="background: rgba(255,255,255,0.7); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(255,255,255,0.5);">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 style="color: #be185d; font-weight: 700;"><i class="fa-solid fa-heart me-2"></i>Tentang Kami</h4>
            <p style="color: #4b5563; font-weight: 500;">
              Selamat datang di toko interaktif kami. Kami menyediakan produk berkualitas tinggi dengan pengalaman berbelanja yang nyaman, aman, dan tentunya didesain khusus agar Anda betah. Selamat berbelanja!
            </p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 style="color: #be185d; font-weight: 700;"><i class="fa-solid fa-address-book me-2"></i>Kontak & Menu</h4>
            <ul class="list-unstyled" style="font-weight: 500;">
              <li><a href="keranjang.php" class="text-decoration-none" style="color: #f43f5e;"><i class="fa-solid fa-cart-shopping me-2"></i>Keranjang Saya</a></li>
              <li><a href="transaksi.php" class="text-decoration-none" style="color: #f43f5e;"><i class="fa-solid fa-receipt me-2"></i>Riwayat Transaksi</a></li>
              <li><a href="profil.php" class="text-decoration-none" style="color: #f43f5e;"><i class="fa-solid fa-user me-2"></i>Profil Saya</a></li>
              <li><a href="logout.php" class="text-decoration-none" style="color: #be123c;"><i class="fa-solid fa-door-open me-2"></i>Keluar</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar shadow-sm" style="background: rgba(255,255,255,0.4) !important; backdrop-filter: blur(15px); border-bottom: 1px solid rgba(255,255,255,0.5);">
      <div class="container">
        <a href="#" class="navbar-brand d-flex align-items-center" style="color: #be185d !important; font-weight: 700; font-size: 1.4rem;">
          <i class="fa-solid fa-store me-2"></i>
          <strong>AFNI Shop</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation" style="border-color: rgba(190, 24, 93, 0.3);">
          <i class="fa-solid fa-bars" style="color: #be185d;"></i>
        </button>
      </div>
    </div>
  </header>
  <main>
    <section class="py-5 text-center container relative z-10">
      <div class="row py-lg-5">
        <div class="col-lg-8 col-md-10 mx-auto glass-panel p-5" style="border-radius: 2rem; backdrop-filter: blur(20px);">
          <div class="mb-4">
            <i class="fa-solid fa-store" style="font-size: 3rem; color: #be185d;"></i>
          </div>
          <h1 class="fw-bold" style="color: #be185d; font-family: 'Poppins', sans-serif; font-size: 2.5rem; text-shadow: 0 2px 10px rgba(255,255,255,0.5);">Selamat Datang di AFNI Shop</h1>
          <p class="lead mt-3 mb-4" style="color: #ff79bc; font-weight: 500;">
            Temukan koleksi terbaik dan terlucu dengan harga yang sangat bersahabat. 
            Nikmati pengalaman belanja interaktif yang didesain khusus untuk Anda.
          </p>
          <p>
            <a href="#produk" class="btn btn-primary my-2 px-4 py-2" style="border-radius: 1rem; font-weight: 600;"><i class="fa-solid fa-bag-shopping me-2"></i>Mulai Belanja</a>
            <a href="keranjang.php" class="btn btn-secondary my-2 px-4 py-2" style="border-radius: 1rem; font-weight: 600; border: 2px solid rgba(255, 106, 175, 0.8);"><i class="fa-solid fa-cart-shopping me-2"></i>Cek Keranjang</a>
          </p>
        </div>
      </div>
    </section>

    <!-- produk kategori 1 -->
    <div id="produk" class="album py-5" style="background: transparent !important; position: relative; z-index: 10;">
      <div class="container">
        <div class="text-center mb-5"><span class="badge" style="background: linear-gradient(to right, #f472b6, #f43f5e); padding: 12px 30px; border-radius: 30px; font-size: 1.4rem; font-family: 'Poppins', sans-serif; font-weight: 700; box-shadow: 0 6px 15px rgba(244,63,94,0.3); letter-spacing: 0.5px;"><i class="fa-solid fa-star me-2"></i>Koleksi Terbaru</span></div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
          <?php
          include 'koneksi.php';
          $query = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_kategori='1'");
          while ($data = mysqli_fetch_array($query)) {
          ?>



            <div class="col">
              <div class="card h-100 border-0" style="transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="padding: 12px; padding-bottom: 0;">
                  <img src="dashboard/img/<?= htmlspecialchars($data['poto']) ?>" class="card-img-top shadow-sm" style="height: 220px; object-fit: cover; border-radius: 1rem;" alt="<?= htmlspecialchars($data['nama']) ?>">
                </div>
                <div class="card-body d-flex flex-column text-center">
                  <h5 class="card-title fw-bold" style="color: #be185d; font-family: 'Poppins', sans-serif;"><?= htmlspecialchars($data['nama']) ?></h5>
                  <div class="text-muted small mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= htmlspecialchars($data['deskripsi']) ?></div>
                  <div class="fw-bold fs-5 mb-4" style="color: #f43f5e;">Rp <?= number_format($data['harga'], 0, ',','.') ?></div>
                  
                  <div class="mt-auto w-100">
                    <a href="detail1.php?id=<?= $data['id'] ?>" class="btn btn-primary w-100" style="border-radius: 1rem; font-weight: 600;">
                      <i class="fa-solid fa-eye me-2"></i>Lihat Detail
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <!-- produk kategori 2 -->
    <div id="produk" class="album py-5" style="background: transparent !important; position: relative; z-index: 10;">
      <div class="container">
        <div class="text-center mb-5 mt-5"><span class="badge" style="background: linear-gradient(to right, #f472b6, #f43f5e); padding: 12px 30px; border-radius: 30px; font-size: 1.4rem; font-family: 'Poppins', sans-serif; font-weight: 700; box-shadow: 0 6px 15px rgba(244,63,94,0.3); letter-spacing: 0.5px;"><i class="fa-solid fa-heart me-2"></i>Pilihan Favorit</span></div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
          <?php
          include 'koneksi.php';
          $query = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_kategori='2'");
          while ($data = mysqli_fetch_array($query)) {
          ?>



            <div class="col">
              <div class="card h-100 border-0" style="transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="padding: 12px; padding-bottom: 0;">
                  <img src="dashboard/img/<?= htmlspecialchars($data['poto']) ?>" class="card-img-top shadow-sm" style="height: 220px; object-fit: cover; border-radius: 1rem;" alt="<?= htmlspecialchars($data['nama']) ?>">
                </div>
                <div class="card-body d-flex flex-column text-center">
                  <h5 class="card-title fw-bold" style="color: #be185d; font-family: 'Poppins', sans-serif;"><?= htmlspecialchars($data['nama']) ?></h5>
                  <div class="text-muted small mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= htmlspecialchars($data['deskripsi']) ?></div>
                  <div class="fw-bold fs-5 mb-4" style="color: #f43f5e;">Rp <?= number_format($data['harga'], 0, ',','.') ?></div>
                  
                  <div class="mt-auto w-100">
                    <a href="detail1.php?id=<?= $data['id'] ?>" class="btn btn-primary w-100" style="border-radius: 1rem; font-weight: 600;">
                      <i class="fa-solid fa-eye me-2"></i>Lihat Detail
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <!-- produk kategori 3 -->
    <div id="produk" class="album py-5" style="background: transparent !important; position: relative; z-index: 10;">
      <div class="container">
        <div class="text-center mb-5 mt-5"><span class="badge" style="background: linear-gradient(to right, #f472b6, #f43f5e); padding: 12px 30px; border-radius: 30px; font-size: 1.4rem; font-family: 'Poppins', sans-serif; font-weight: 700; box-shadow: 0 6px 15px rgba(244,63,94,0.3); letter-spacing: 0.5px;"><i class="fa-solid fa-fire me-2"></i>Rekomendasi Spesial</span></div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
          <?php
          include 'koneksi.php';
          $query = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_kategori='3'");
          while ($data = mysqli_fetch_array($query)) {
          ?>



            <div class="col">
              <div class="card h-100 border-0" style="transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="padding: 12px; padding-bottom: 0;">
                  <img src="dashboard/img/<?= htmlspecialchars($data['poto']) ?>" class="card-img-top shadow-sm" style="height: 220px; object-fit: cover; border-radius: 1rem;" alt="<?= htmlspecialchars($data['nama']) ?>">
                </div>
                <div class="card-body d-flex flex-column text-center">
                  <h5 class="card-title fw-bold" style="color: #be185d; font-family: 'Poppins', sans-serif;"><?= htmlspecialchars($data['nama']) ?></h5>
                  <div class="text-muted small mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= htmlspecialchars($data['deskripsi']) ?></div>
                  <div class="fw-bold fs-5 mb-4" style="color: #f43f5e;">Rp <?= number_format($data['harga'], 0, ',','.') ?></div>
                  
                  <div class="mt-auto w-100">
                    <a href="detail1.php?id=<?= $data['id'] ?>" class="btn btn-primary w-100" style="border-radius: 1rem; font-weight: 600;">
                      <i class="fa-solid fa-eye me-2"></i>Lihat Detail
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

  </main>
  <footer class="py-5 mt-5" style="background: rgba(255,255,255,0.4); backdrop-filter: blur(10px); border-top: 1px solid rgba(255,255,255,0.5);">
    <div class="container text-center" style="color: #4b5563; font-weight: 500;">
      <p class="float-end mb-1">
        <a href="#" class="btn btn-sm btn-primary rounded-circle shadow-sm" style="width: 40px; height: 40px; line-height: 28px;"><i class="fa-solid fa-arrow-up"></i></a>
      </p>
      <p class="mb-1">&copy; 2025 <strong>AFNI Shop</strong>. Dibuat dengan <i class="fa-solid fa-heart" style="color: #f43f5e;"></i> untuk pengalaman berbelanja terbaik.</p>
      <p class="mb-0">
        Tetap terhubung bersama kami <a href="#" style="color: #f43f5e; text-decoration: none; font-weight: 700;"><i class="fa-brands fa-instagram mx-1"></i></a> <a href="#" style="color: #f43f5e; text-decoration: none; font-weight: 700;"><i class="fa-brands fa-tiktok mx-1"></i></a>
      </p>
    </div>
  </footer>
  <script
    src="assets/dist/js/bootstrap.bundle.min.js"
    class="astro-vvvwv3sm"></script>
</body>

</html>














