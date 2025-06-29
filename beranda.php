<?php include 'backend/beranda_backend.php' ?>

<!DOCTYPE html>
<!-- saved from url=(0019)https://trawaca.id/ -->
<html lang="<?php echo $lang; ?>">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TRAWACA - Beranda</title>
  <link rel="shortcut icon" href="https://trawaca.id/images/trawaca_small_8.png">

  <!-- Bootstrap core CSS -->
  <link href="trawaca_bootstrap/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="trawaca_bootstrap/business-frontpage.css" rel="stylesheet">
  <link href="trawaca_bootstrap/css" rel="stylesheet">
  <!-- Animate.css (Sesuaikan path jika perlu) -->
  <link href="lib/animate/animate.min.css" rel="stylesheet" />
  <!-- Font Awesome (Jika menggunakan ikon untuk tombol navigasi scroll) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    /* CSS Header dengan Parallax */
    header.trawaca-custom-header {
      position: relative;
      width: 100%;
      background-image: url('trawaca_bootstrap/trawaca_400_8.png');
      background-color: #e0d4bc;
      background-repeat: no-repeat;
      background-position: center center;
      background-size: contain;
      background-attachment: fixed;
      padding-top: 100px;
      padding-bottom: 100px;
      min-height: 60vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #333;
    }
    header.trawaca-custom-header::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(224, 212, 188, 0.65); /* Overlay semi-transparan */
      z-index: 1;
    }
    header.trawaca-custom-header .container {
      position: relative;
      z-index: 2;
      text-align: center;
    }
    header.trawaca-custom-header .section-header { margin-bottom: 20px; }
    header.trawaca-custom-header .section-header h2 {
      color: #E31245;
      text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.7), 0 0 5px rgba(0,0,0,0.15);
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 0.75rem;
      opacity: 1;
    }
    header.trawaca-custom-header .header-main-text p {
      color: #403029;
      font-size: 1.25rem;
      line-height: 1.6;
      max-width: 750px;
      margin-left: auto;
      margin-right: auto;
      opacity: 1;
    }

    /* CSS untuk Bagian Kegiatan dan Luaran (Adaptasi dari Testimonial) */
    .kegiatan-luaran-section {
      position: relative;
      padding: 45px 0 15px 0; /* Kurangi padding bawah untuk tombol Show All */
    }
    .kegiatan-luaran-section .section-title h2 {
      color:#E31245;
      text-shadow: 1px 1px 1px #dddddd;
      margin-bottom: 1rem; /* Sesuaikan jika perlu */
    }
    .kegiatan-card-custom .card {
      margin-bottom: 0; /* Dihapus karena margin diatur oleh .kegiatan-card-custom-col */
      border: 1px solid rgba(0, 0, 0, 0.07);
      background: #ffffff;
      transition: all 0.3s ease;
      display: flex; /* Untuk memastikan h-100 bekerja dengan baik */
      flex-direction: column; /* Untuk memastikan h-100 bekerja dengan baik */
    }
    .kegiatan-card-custom .card:hover {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    .kegiatan-card-custom .card-img-top {
      height: 200px; /* Tinggi tetap untuk gambar */
      object-fit: cover;
    }
    .kegiatan-card-custom .card-body {
      padding: 20px; /* Sedikit dikurangi */
      text-align: left;
      flex-grow: 1; /* Agar card body mengisi sisa ruang */
      display: flex;
      flex-direction: column;
    }
    .kegiatan-card-custom .card-title {
      font-size: 1.15rem; /* Sedikit disesuaikan */
      font-weight: 600;
      color: #914b34;
      margin-bottom: 10px;
    }
    .kegiatan-card-custom .card-text {
      font-size: 0.9rem; /* Sedikit disesuaikan */
      color: #555555;
      margin-bottom: 10px;
      flex-grow: 1; /* Agar paragraf deskripsi mengisi ruang */
    }
    .kegiatan-card-custom .cilik {
      color: #777777;
      font-size: 0.8rem;
      margin-bottom: 15px; /* Jarak ke footer */
    }
    .kegiatan-card-custom .card-footer {
      background: transparent;
      border-top: 1px solid rgba(0, 0, 0, 0.07);
      padding: 15px 20px;
    }
    .kegiatan-card-custom .btn-danger {
      background-color: #E31245;
      border-color: #E31245;
      font-weight: 500;
      font-size: 0.9rem;
    }
    .kegiatan-card-custom .btn-danger:hover {
        background-color: #c90f3c;
        border-color: #c90f3c;
    }

    /* CSS untuk Horizontal Scroll Pagination Kegiatan */
    .kegiatan-scroll-wrapper {
      overflow: hidden;
      position: relative;
      margin-bottom: 15px; /* Jarak sebelum tombol navigasi */
    }
    .kegiatan-scroll-container {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      padding-bottom: 15px; /* Untuk menyembunyikan scrollbar dengan trik margin negatif */
      margin-bottom: -15px;
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
    .kegiatan-scroll-container::-webkit-scrollbar {
      display: none;
    }
    .kegiatan-card-custom-col {
        flex: 0 0 calc(100% / 3 - 10px); /* 3 card per view, dikurangi sedikit untuk gap */
        margin-right: 15px; /* Jarak antar card */
    }
    .kegiatan-card-custom-col:last-child {
        margin-right: 0; /* Hapus margin kanan pada item terakhir */
    }

    @media (max-width: 991.98px) { /* md and down */
        .kegiatan-card-custom-col {
            flex: 0 0 calc(50% - 7.5px); /* 2 card per view */
            margin-right: 15px;
        }
    }
    
    /* MODIFIKASI: Penyesuaian untuk tampilan mobile */
    @media (max-width: 767.98px) { /* sm and down */
        .kegiatan-card-custom-col {
            flex: 0 0 100%; /* Menampilkan 1 card penuh */
            margin-right: 0; /* Hapus margin agar pas */
            padding: 0 8px; /* Beri sedikit padding agar tidak menempel di tepi layar */
        }
        .kegiatan-scroll-container {
          /* Sesuaikan padding container agar konsisten dengan padding item */
          padding-left: 0;
          padding-right: 0;
        }
    }

    .kegiatan-nav-buttons {
      text-align: center;
      margin-top: 20px;
      margin-bottom: 15px;
    }
    .kegiatan-nav-buttons button {
      background-color: #914b34;
      color: white;
      border: none;
      padding: 8px 15px;
      margin: 0 5px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .kegiatan-nav-buttons button:hover {
      background-color: #7a3f2b;
    }
    .kegiatan-nav-buttons button:disabled {
      background-color: #cccccc;
      cursor: not-allowed;
    }
    .show-all-kegiatan-btn-container {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 30px;
    }
    .show-all-kegiatan-btn {
        background-color: #E31245;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border:none;
    }
     .show-all-kegiatan-btn:hover {
        background-color: #c90f3c;
        color: white;
    }

    /* Styling untuk mode 'Show All' */
    .kegiatan-grid-view .kegiatan-card-custom-col {
        flex-basis: auto !important; /* Override flex-basis */
        margin-right: 0 !important; /* Override margin-right */
    }


    body, html {
      overflow-x: hidden;
    }
  </style>
</head>

<body data-new-gr-c-s-check-loaded="14.1220.0" data-gr-ext-installed="">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#914b34;">
    <div class="container">
      <a class="navbar-brand wow pulse" data-wow-delay="0.5s" href="beranda.php">TRAWACA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active" style="background-color:#E31245;border-bottom: 2px solid white;">
            <a class="nav-link " href="beranda.php"><?php echo $navigasiData['navigasi_beranda']['header']; ?></a>
          </li>
          <li class="nav-item " style="">
            <a class="nav-link " href="publikasi.php"><?php echo $navigasiData['navigasi_publikasi']['header']; ?></a>
          </li>

          <li class="nav-item dropdown">
            <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButtonAplikasi" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none;">
              <?php echo $navigasiData['navigasi_aplikasi']['header']; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAplikasi">
              <?php foreach ($Aplikasi as $aplikasi) : ?>
                <?php if ($aplikasi["disable"] == 0 && $aplikasi["jenis_aplikasi"] == "non-purwarupa"): ?>
                  <li><a class="dropdown-item" href="<?= $aplikasi["link_aplikasi"] ?>"><?= $aplikasi["nama_aplikasi"] ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
              <span class="cilik pupus"> ::: Purwarupa</span>
              <?php foreach ($Aplikasi as $aplikasi) : ?>
                <?php if ($aplikasi["disable"] == 0 && $aplikasi["jenis_aplikasi"] == "purwarupa"): ?>
                  <li><a class="dropdown-item" href="<?= $aplikasi["link_aplikasi"] ?>"><?= $aplikasi["nama_aplikasi"] ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuButtonBahasa" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none;">
              <?php echo $navigasiData['navigasi_bahasa']['header']; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonBahasa">
              <?php foreach ($Bahasa as $bahasa) : ?>
                <?php if ($bahasa["disable"] == 0): ?>
                  <li><a class="dropdown-item" href="<?= $bahasa["link_bahasa"] ?>"><?= $bahasa["nama_bahasa"] ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header BARU dengan Efek Parallax -->
  <header class="trawaca-custom-header wow fadeIn" data-wow-duration="1.5s">
    <div class="container">
      <div class="section-header">
        <h2 class="wow fadeInUp" data-wow-delay="0.4s"><?php echo $headerData['header_1']['header']; ?></h2>
      </div>
      <div class="header-main-text">
        <p class="mb-0 wow fadeInUp" data-wow-delay="0.6s"><?php echo $headerData['header_1']['sub_header']; ?></p>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container main-page-content">
    <div class="row mt-5">
      <!-- tentang trawaca -->
      <div class="col-md-8 col-sm-12 mb-5 wow fadeInLeft" data-wow-delay="0.1s">
        <h2 style="color:#E31245; text-shadow: 1px 1px 1px #dddddd;"><?php echo $headerData['header_2']['header']; ?></h2>
        <hr>
        <p><?php echo $headerData['header_2']['sub_header']; ?></p>
      </div>
      <!-- tentang trawaca selesai -->

      <!-- tim trawaca -->
      <div class="col-md-4 col-sm-12 mb-5 sijisiji wow fadeInRight" data-wow-delay="0.1s">
        <h2 style="color:#E31245; text-shadow: 1px 1px 1px #dddddd;"><?php echo $headerData['header_3']['header']; ?></h2>
        <hr>
        <h4><b><?php echo $headerData['header_4']['header']; ?></b></h4>
        <p class="abuabu">
          <?php foreach ($penelitiBahasa as $peneliti) : ?>
            <strong><?= $peneliti['nama_peneliti'] ?></strong><br>
            <?= $peneliti['bidang_minat'] ?><br>
          <?php endforeach ?>
        </p>
        <h4><b><?php echo $headerData['header_5']['header']; ?></b></h4>
        <p class="abuabu">
          <?php foreach ($Kontributor as $kontributor) : ?>
            <?= $kontributor['nama_kontributor'] ?><span class="cilik pupus"> :: <?= $kontributor['semester_kontributor'] ?></span><br>
          <?php endforeach ?>
        </p>
        <strong><?php echo $headerData['header_6']['header']; ?></strong>
        <?php foreach ($Kontak as $kontak) :?>
          <a href="mailto:<?= $kontak['link_kontak'] ?>"><?= $kontak['nama_kontak'] ?></a><br>
        <?php endforeach ?>
      </div>
      <!-- tim trawaca selesai -->
    </div>

    <!-- KEGIATAN DAN LUARAN dengan Scroll Pagination -->
    <div class="row kegiatan-luaran-section">
      <div class="col-12 mt-2 mb-3 wow fadeInUp section-title" data-wow-delay="0.2s"> <!-- Menggunakan col-12 -->
        <h2 style="color:#E31245; text-shadow: 1px 1px 1px #dddddd;"><?php echo $headerData['header_7']['header']; ?></h2>
        <hr>
      </div>
      <div class="col-12"> <!-- Kolom baru untuk wrapper dan container scroll -->
        <div class="kegiatan-scroll-wrapper">
          <div class="kegiatan-scroll-container" id="kegiatanContainer">
            <?php if (!empty($Kegiatan)): ?>
                <?php foreach ($Kegiatan as $index => $kegiatan) : ?>
                  <div class="kegiatan-card-custom-col wow fadeInUp kegiatan-card-custom" data-wow-delay="<?php echo 0.3 + ($index * 0.1); ?>s">
                    <div class="card h-100">
                      <img class="card-img-top" src="<?= $kegiatan['gambar_kegiatan_luaran'] ?>" alt="Gambar Kegiatan">
                      <div class="card-body">
                        <h4 class="card-title"><?= $kegiatan['nama_kegiatan_luaran'] ?></h4>
                        <p class="card-text"><?= $kegiatan['deskripsi_kegiatan_luaran'] ?></p>
                        <p class="cilik"><?= $kegiatan['waktu_kegiatan_luaran'] ?></p>
                      </div>
                      <div class="card-footer text-center"> <!-- text-center untuk tombol -->
                        <a href="<?= htmlspecialchars($kegiatan['link_kegiatan_luaran']) ?>" target="_blank" class="btn btn-outline-danger btn-sm"><?php echo htmlspecialchars($kegiatan['nama_link']); ?></a>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 wow fadeInUp" data-wow-delay="0.2s"><p class="text-center">Tidak ada kegiatan atau luaran saat ini.</p></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- pagination -->
      <?php if (!empty($Kegiatan)): ?>
      <div class="col-12 kegiatan-nav-buttons wow fadeInUp" data-wow-delay="0.2s">
          <button id="kegiatanPrevBtn" title="Sebelumnya"><i class="fas fa-chevron-left"></i></button>
          <button id="kegiatanNextBtn" title="Berikutnya"><i class="fas fa-chevron-right"></i></button>
      </div>
      <div class="col-12 show-all-kegiatan-btn-container wow fadeInUp" data-wow-delay="0.2s">
          <button class="btn show-all-kegiatan-btn" id="showAllKegiatan">Tampilkan Semua</button>
      </div>
      <?php endif; ?>
    </div>
    
    <!-- Bagian Sahabat -->
    <div class="row wow fadeInUp" data-wow-delay="0.2s">
        <div class="col-12 mt-2 mb-3"> <!-- Tambah mt-4 untuk jarak -->
          <h2 style="color:#E31245; text-shadow: 1px 1px 1px #dddddd;"><?php echo $headerData['header_8']['header']; ?></h2>
          <hr>
          <p class="card-text sepasi">
            <?php foreach ($Sahabat as $sahabat): ?>
              <?= $sahabat['nama_sahabat'] ?> |<span class="cilik"> <?= $sahabat['nama_waktu_kerjasama'] ?></span><br>
            <?php endforeach; ?>
          </p>
        </div>
    </div>

  </div> <!-- Penutup <div class="container main-page-content"> -->

  <!-- jQuery, Popper, Bootstrap JS, WOW JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script>
    new WOW().init();

    // MODIFIKASI: Seluruh logika scroll diperbarui agar responsif
    $(document).ready(function() {
        const kegiatanScrollWrapper = $('.kegiatan-scroll-wrapper');
        const kegiatanContainer = $('#kegiatanContainer');
        const allKegiatanItems = kegiatanContainer.children('.kegiatan-card-custom-col');
        
        let autoScrollInterval;
        let currentScrollPosition = 0;
        let itemsPerScroll = 3; // Default untuk desktop

        // BARU: Fungsi untuk mengatur jumlah item scroll berdasarkan lebar layar
        function updateResponsiveSettings() {
            const windowWidth = $(window).width();
            if (windowWidth < 768) {
                itemsPerScroll = 1; // 1 item untuk mobile
            } else if (windowWidth < 992) {
                itemsPerScroll = 2; // 2 item untuk tablet
            } else {
                itemsPerScroll = 3; // 3 item untuk desktop
            }
            updateNavButtons();
        }

        function getCardWidthPlusMargin() {
            if (kegiatanContainer.children('.kegiatan-card-custom-col').length > 0) {
                // Untuk mobile, lebar kartu adalah lebar container itu sendiri
                if ($(window).width() < 768) {
                  return kegiatanContainer.innerWidth();
                }
                return kegiatanContainer.children('.kegiatan-card-custom-col').first().outerWidth(true);
            }
            return 0;
        }

        function updateNavButtons() {
            if (!kegiatanContainer.length || kegiatanContainer.children('.kegiatan-card-custom-col').length === 0) {
                $('#kegiatanPrevBtn, #kegiatanNextBtn').prop('disabled', true);
                return;
            }
            const scrollLeft = kegiatanContainer.scrollLeft();
            const scrollWidth = kegiatanContainer[0].scrollWidth;
            const containerWidth = kegiatanContainer.innerWidth();

            $('#kegiatanPrevBtn').prop('disabled', scrollLeft <= 0);
            $('#kegiatanNextBtn').prop('disabled', scrollLeft >= (scrollWidth - containerWidth - 1));
        }

        function scrollToTarget(targetScrollLeft) {
            kegiatanContainer.stop().animate({ scrollLeft: targetScrollLeft }, 500, function() {
                currentScrollPosition = kegiatanContainer.scrollLeft();
                updateNavButtons();
            });
        }

        $('#kegiatanNextBtn').on('click', function() {
            stopAutoScroll();
            const cardWidth = getCardWidthPlusMargin();
            if (cardWidth === 0) return;
            let newScrollPosition = kegiatanContainer.scrollLeft() + (cardWidth * itemsPerScroll);
            const maxScroll = kegiatanContainer[0].scrollWidth - kegiatanContainer.innerWidth();
            scrollToTarget(Math.min(newScrollPosition, maxScroll));
        });

        $('#kegiatanPrevBtn').on('click', function() {
            stopAutoScroll();
            const cardWidth = getCardWidthPlusMargin();
            if (cardWidth === 0) return;
            let newScrollPosition = kegiatanContainer.scrollLeft() - (cardWidth * itemsPerScroll);
            scrollToTarget(Math.max(0, newScrollPosition));
        });

        function startAutoScroll() {
            // MODIFIKASI: Cek jumlah total item terhadap itemsPerScroll yang dinamis
            if (!kegiatanContainer.length || allKegiatanItems.length <= itemsPerScroll) {
                updateNavButtons();
                return;
            }
            stopAutoScroll();
            autoScrollInterval = setInterval(function() {
                if (!kegiatanContainer.is(':visible')) {
                    stopAutoScroll();
                    return;
                }
                
                const scrollLeft = kegiatanContainer.scrollLeft();
                const scrollWidth = kegiatanContainer[0].scrollWidth;
                const containerWidth = kegiatanContainer.innerWidth();

                if (scrollLeft >= (scrollWidth - containerWidth - 1)) {
                    scrollToTarget(0); // Kembali ke awal jika sudah di akhir
                } else {
                    $('#kegiatanNextBtn').trigger('click'); // Memicu klik tombol next
                }
            }, 7000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        kegiatanContainer.on('scroll', function() {
            currentScrollPosition = $(this).scrollLeft();
            updateNavButtons();
        });
        
        // BARU: Event listener untuk window resize
        $(window).on('resize', function() {
            // Hentikan scroll, perbarui pengaturan, lalu mulai lagi jika perlu
            stopAutoScroll();
            updateResponsiveSettings();
            // Posisikan ulang scroll ke kelipatan terdekat agar rapi
            const cardWidth = getCardWidthPlusMargin();
            if (cardWidth > 0) {
              const newPos = Math.round(kegiatanContainer.scrollLeft() / cardWidth) * cardWidth;
              scrollToTarget(newPos);
            }
            startAutoScroll();
        }).trigger('resize'); // Panggil sekali saat load untuk inisialisasi

        if (allKegiatanItems.length > 0) {
            $('.kegiatan-nav-buttons, .show-all-kegiatan-btn-container').show();
            startAutoScroll(); // Mulai auto scroll setelah semua siap
        } else {
            $('.kegiatan-nav-buttons, .show-all-kegiatan-btn-container').hide();
        }

        // Logika Tombol "Show All" (tidak berubah, tapi dipastikan tetap berfungsi)
        let isShowingAll = false;
        const kegiatanRowParent = $('.kegiatan-luaran-section .section-title').next('.col-12');

        $('#showAllKegiatan').on('click', function() {
            stopAutoScroll();

            if (!isShowingAll) {
                kegiatanScrollWrapper.hide();
                if ($('#kegiatanGridContainer').length === 0) {
                    kegiatanRowParent.append('<div class="row" id="kegiatanGridContainer"></div>');
                }
                const kegiatanGridContainer = $('#kegiatanGridContainer').empty().show();

                allKegiatanItems.each(function() {
                    const clonedItem = $(this).clone();
                    clonedItem.removeClass('kegiatan-card-custom-col wow fadeInUp')
                               .addClass('col-md-4 mb-4 kegiatan-card-custom')
                               .css({
                                   'flex-basis': '',
                                   'margin-right': '',
                                   'padding': '' // Reset padding juga
                               });
                    kegiatanGridContainer.append(clonedItem);
                });

                $('.kegiatan-nav-buttons').hide();
                $(this).text('Tampilkan Lebih Sedikit');
                isShowingAll = true;
            } else {
                if ($('#kegiatanGridContainer').length > 0) {
                    $('#kegiatanGridContainer').empty().hide();
                }
                kegiatanScrollWrapper.show();

                kegiatanContainer.children('.kegiatan-card-custom').each(function(){
                    $(this).removeClass('col-md-4 mb-4').addClass('kegiatan-card-custom-col wow fadeInUp');
                });
                
                $(window).trigger('resize'); // Panggil resize untuk mengatur ulang scroll
                $(this).text('Tampilkan Semua');
                isShowingAll = false;
            }
        });
    });
  </script>

  <!-- Footer -->
  <footer class="py-2 bg-dark wow fadeIn" data-wow-delay="0.3s">
    <div class="container">
      <p class="m-0 text-center text-white siji">Copyright © Tim TRAWACA 2025</p>
    </div>
  </footer>

  <deepl-input-controller><template shadowrootmode="open">
      <link rel="stylesheet" href="chrome-extension://cofdbpoegempjloogbagkncekinflcnj/build/content.css">
      <div dir="ltr" style="visibility: initial !important;">
        <div class="dl-input-translation-container svelte-95aucy">
          <div></div>
        </div>
      </div>
    </template></deepl-input-controller>
</body><grammarly-desktop-integration data-grammarly-shadow-root="true"><template shadowrootmode="open">
    <style>
      div.grammarly-desktop-integration {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      div.grammarly-desktop-integration:before {
        content: attr(data-content);
      }
    </style>
    <div aria-label="grammarly-integration" role="group" tabindex="-1" class="grammarly-desktop-integration" data-content='{"mode":"full","isActive":true,"isUserDisabled":false}'></div>
  </template></grammarly-desktop-integration>
</html>