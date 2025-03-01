<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Track Paket Tazza Paket Express</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= base_url() ?>Logis/assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>Logis/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>Logis/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>Logis/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>Logis/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url() ?>Logis/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>Logis/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>Logis/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <link href="<?= base_url() ?>css/custom-table.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main CSS File -->
  <link href="<?= base_url() ?>Logis/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Logis
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
  .help-icon {
    position: fixed;
    bottom: 60px;
    right: 20px;
    padding: 30px;
    background-color:rgb(6, 2, 255);
    color: #fff;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .help-icon i {
    font-size: 24px;
  }

  .help-icon:hover {
    background-color: #0056b3;
  }
</style>


</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Tazza Paket Express</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="<?= base_url() ?>Logis/assets/img/world-dotted-map.png" alt="" class="hero-bg" data-aos="fade-in">

      <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2 data-aos="fade-up">Cek Paket Anda</h2>
            <p data-aos="fade-up" data-aos-delay="100">Silahkan Masukan nomer resi pengiriman</p>

            <form action="" method="GET" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
              <input type="text" name="no_resi" class="form-control" placeholder="Ketikan Resi" value="<?= !empty($_GET['no_resi']) ? $_GET['no_resi'] : '' ?>" required>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>


          </div>

          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="<?= base_url() ?>Logis/assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
          </div>

        </div>
      </div>

    </section><!-- /Hero Section -->

    <?php if ($pengiriman) : ?>
      <?php foreach ($pengiriman as $key => $row) : ?>
        <div id="trxResi" class="container mt-5 mb-5">
          <h3 class="fw-bold text-center">Hasil Pencarian: #P0001</h3>
          <div class="table-wrap">
            <table class="table table-responsive-xl">
              <thead>
                <tr>
                  <th>No Resi</th>
                  <th>Tanggal</th>
                  <th>Paket</th>
                  <th>Checkpoint</th>
                  <th>Status</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr class="alert" role="alert">
                  <td class="d-flex">
                    <span><a href="#"><?= $row->no_pengiriman ?></a></span>
                  </td>
                  <td><?= $row->tanggal ?></td>
                  <td><?= $row->nama_barang ?></td>
                  <td><?= $row->alamat_penerima ?></td>
                  <!-- <td class="status"><span class="active">Active</span></td> -->
                  <td class="status"><span class="waiting"><?= $row->status ?></span></td>
                 
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
        

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-cart-flatbed"></i></div>
            <div>
              <h4 class="title">Pengiriman Cepat</h4>
              <p class="description">Kami memastikan paket Anda sampai dengan aman dan tepat waktu ke tujuan.</p>
              <a href="#" class="readmore stretched-link"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <!-- End Service Item -->

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-truck"></i></div>
            <div>
              <h4 class="title">Layanan Profesional</h4>
              <p class="description">Tim kami siap memberikan pelayanan terbaik dengan jaringan pengiriman yang luas.</p>
              <a href="#" class="readmore stretched-link"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="icon flex-shrink-0"><i class="fa-solid fa-truck-ramp-box"></i></div>
            <div>
              <h4 class="title">Keamanan Terjamin</h4>
              <p class="description">Setiap paket dilindungi dengan sistem keamanan yang ketat untuk mencegah kehilangan atau kerusakan.</p>
              <a href="#" class="readmore stretched-link"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <a href="<?= base_url()?> komplain/tambah" class="help-icon ms-3">
      <i class="ri-customer-service-2-fill fs-4 "></i>
    </a>

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
            <img src="<?= base_url() ?>Logis/assets/img/about.jpg" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
            <h3>Tentang Kami</h3>
            <p>
              <?= $setting->about_content ?>
            </p>
            <ul>
              <li>
                <i class="bi bi-diagram-3"></i>
                <div>
                  <h5>Jangkauan Luas & Tepat Waktu</h5>
                  <p>Layanan kami mencakup berbagai daerah dengan komitmen ketepatan waktu.</p>
                </div>
              </li>
              <li>
                <i class="bi bi-fullscreen-exit"></i>
                <div>
                  <h5>Proses Mudah & Efisien</h5>
                  <p>Pengiriman mudah dengan sistem tracking real-time.</p>
                </div>
              </li>
              <li>
                <i class="bi bi-broadcast"></i>
                <div>
                  <h5>Keamanan Terjamin</h5>
                  <p>Paket Anda dilindungi dengan asuransi dan keamanan terbaik.</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->


  </main>

  <footer id="footer" class="footer dark-background">
    <a href="<?= base_url()?> komplain/tambah" class="help-icon ms-3">
      <i class="ri-customer-service-2-fill fs-4 "></i>
    </a>

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="<?= base_url()?> komplain/tambah" class="logo d-flex align-items-center">
            <span class="sitename">Tazza Paket Express</span>
          </a>
          <?= $setting->footer_content ?>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Logis</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>Logis/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>Logis/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url() ?>Logis/assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url() ?>Logis/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url() ?>Logis/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url() ?>Logis/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= base_url() ?>Logis/assets/js/main.js"></script>

  <script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    const succesSessionFlashMsg = '<?= session()->getFlashdata('success_message') ?>';
    const errorSessionFlashMsg = '<?= session()->getFlashdata('error_message') ?>';
    const trxResiFlashMsg = '<?= session()->getFlashdata('tracking_resi') ?>';
    window.onload = function () {
      if (trxResiFlashMsg !== '') {
        const target = document.getElementById("trxResi");
        target.scrollIntoView({ behavior: "smooth", block: "center" });
      }
    };

    if (succesSessionFlashMsg !== '') {
        Toast.fire({
            icon: 'success',
            title: succesSessionFlashMsg
        })
    }

    if (errorSessionFlashMsg !== '') {
      console.log('ok');
      
        Toast.fire({
            icon: 'warning',
            title: errorSessionFlashMsg
        })
    }

  </script>

</body>

</html>