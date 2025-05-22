<?php include 'backend/publikasi_backend.php' ?>

<!DOCTYPE html>
<!-- saved from url=(0032)https://trawaca.id/publikasi.php -->
<html lang="<?php echo $lang; ?>">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TRAWACA - Publikasi</title>
  <link rel="shortcut icon" href="https://trawaca.id/images/trawaca_small.png">

  <!-- Bootstrap core CSS -->
  <link href="trawaca_bootstrap/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="trawaca_bootstrap/business-frontpage.css" rel="stylesheet">
  <link href="trawaca_bootstrap/css" rel="stylesheet">
  <!-- Animate.css (Sesuaikan path jika perlu) -->
  <link href="lib/animate/animate.min.css" rel="stylesheet" />

  <style>
    html {
      height: 100%;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
      overflow-x: hidden;
    }

    .content-wrapper {
      flex-grow: 1;
      padding-top: 70px;
      /* Navbar height + buffer */
    }

    footer {
      flex-shrink: 0;
    }

    /* Tambahan style untuk card publikasi jika diperlukan agar animasi lebih halus */
    .publikasi-card {
      transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
    }

    .publikasi-card:hover {
      /* transform: translateY(-5px); */
      /* Efek hover jika diinginkan, bisa bentrok dengan WOW */
      /* box-shadow: 0 10px 20px rgba(0,0,0,0.1); */
    }
  </style>
</head>


<body data-new-gr-c-s-check-loaded="14.1221.0" data-gr-ext-installed="">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#914b34;">
    <div class="container">
      <a class="navbar-brand wow pulse" data-wow-delay="0.3s" href="beranda.php">TRAWACA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link " href="beranda.php"><?php echo $navigasiData['navigasi_beranda']['header']; ?></a>
          </li>
          <li class="nav-item active" style="background-color:#E31245;border-bottom: 2px solid white;">
            <a class="nav-link " href="publikasi.php"><?php echo $navigasiData['navigasi_publikasi']['header']; ?></a>
          </li>

          <li class="nav-item dropdown">
            <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuAplikasi" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none;">
              <?php echo $navigasiData['navigasi_aplikasi']['header']; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuAplikasi">
              <?php foreach ($Aplikasi as $aplikasi) : ?>
                <?php if ($aplikasi["disable"] == 0 && $aplikasi["jenis_aplikasi"] == "non-purwarupa"): ?>
                  <li><a class="dropdown-item" href="<?= $aplikasi["link_aplikasi"] ?>"><?= $aplikasi["nama_aplikasi"] ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
              <span class="cilik pupus">  ::: Purwarupa</span>
              <?php foreach ($Aplikasi as $aplikasi) : ?>
                <?php if ($aplikasi["disable"] == 0 && $aplikasi["jenis_aplikasi"] == "purwarupa"): ?>
                  <li><a class="dropdown-item" href="<?= $aplikasi["link_aplikasi"] ?>"><?= $aplikasi["nama_aplikasi"] ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <button class="btn btn-drop dropdown-toggle" type="button" id="dropdownMenuBahasa" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none;">
              <?php echo $navigasiData['navigasi_bahasa']['header']; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuBahasa">
              <?php foreach ($Bahasa as $bahasa) : ?>
                <?php if ($bahasa["disable"] == 0): ?>
                  <li><a class="dropdown-item" href="<?= $bahasa["link_bahasa"] ?>"><?= $bahasa["nama_bahasa"] ?>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Wrapper untuk konten utama -->
  <div class="content-wrapper">
    <!-- Page Content Publikasi Individu dan bersama -->
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8 col-sm-12">
          <h2 class="wow fadeInDown" data-wow-delay="0.2s" style="color:#E31245; text-shadow: 1px 1px 1px #dddddd;"><?php echo $headerData['header_1']['header']; ?></h2>
          <hr class="wow fadeInLeft" data-wow-delay="0.3s">

          <?php
          $delay_counter_individu = 0; // Counter untuk delay animasi publikasi individu
          foreach ($kelompok_publikasi as $tahun => $publikasi_tahun) { ?>
            <div class="card publikasi-card wow fadeInUp" data-wow-delay="<?php echo 0.4 + ($delay_counter_individu * 0.2); ?>s">
              <div class="card-header">
                <strong><?= $tahun ?></strong> <span class="badge badge-danger"><?= count($publikasi_tahun) ?></span>
              </div>
              <div class="card-body border border-top-0 border-right-0 border-left-0 border-bottom">
                <?php
                $inner_delay_counter = 0; // Counter untuk delay item di dalam card
                foreach ($publikasi_tahun as $publikasi) { ?>
                  <div class="publikasi-item wow fadeIn" data-wow-delay="<?php echo 0.5 + ($delay_counter_individu * 0.2) + ($inner_delay_counter * 0.1); ?>s">
                    <h5 class="card-title"><?= htmlspecialchars($publikasi['nama_publikasi']) ?><br><small class="coklat"><?= htmlspecialchars($publikasi['nama_peneliti']) ?></small></h5>
                    <p class="card-text siji abuabu">
                      <?= htmlspecialchars($publikasi['hari_tanggal_publikasi']) ?><br>
                      <?= htmlspecialchars($publikasi['tempat_publikasi']) ?> <br>
                    </p>
                    <a href="<?= htmlspecialchars($publikasi['tautan_publikasi']) ?>" target="_blank" class="btn btn-outline-danger btn-sm"><?php echo htmlspecialchars($headerData['header_1']['sub_header']); ?></a>
                    <?php if (next($publikasi_tahun)): // Tambahkan <hr> hanya jika bukan item terakhir 
                    ?>
                      <hr>
                    <?php endif; ?>
                  </div>
                <?php
                  $inner_delay_counter++;
                } ?>
              </div>
            </div>
            <br>
          <?php
            $delay_counter_individu++;
          } ?>
          <?php ?>


          <hr class="wow fadeInLeft" data-wow-delay="0.3s">
          <?php
          $delay_counter_bersama = 0; // Counter untuk delay animasi publikasi bersama
          foreach ($kelompok_publikasi_bersama as $tahun => $publikasi_tahun) { ?>
            <div class="card publikasi-card wow fadeInUp" data-wow-delay="<?php echo 0.4 + ($delay_counter_bersama * 0.2); ?>s">
              <div class="card-header">
                <strong><?= $tahun ?></strong> <span class="badge badge-danger"><?= count($publikasi_tahun) ?></span>
              </div>
              <div class="card-body border border-top-0 border-right-0 border-left-0 border-bottom">
                <?php
                $inner_delay_counter_bersama = 0;
                foreach ($publikasi_tahun as $publikasi) { ?>
                  <div class="publikasi-item wow fadeIn" data-wow-delay="<?php echo 0.5 + ($delay_counter_bersama * 0.2) + ($inner_delay_counter_bersama * 0.1); ?>s">
                    <h5 class="card-title"><?= htmlspecialchars($publikasi['nama_publikasi']) ?><br><small class="coklat"><?= htmlspecialchars($publikasi['nama_peneliti']) ?></small></h5>
                    <p class="card-text siji abuabu">
                      <?= htmlspecialchars($publikasi['hari_tanggal_publikasi']) ?><br>
                      <?= htmlspecialchars($publikasi['tempat_publikasi']) ?> <br>
                    </p>
                    <a href="<?= htmlspecialchars($publikasi['tautan_publikasi']) ?>" class="btn btn-outline-danger btn-sm" target="_blank"><?php echo htmlspecialchars($headerData['header_1']['sub_header']); ?></a>
                    <?php if (next($publikasi_tahun)): // Tambahkan <hr> hanya jika bukan item terakhir 
                    ?>
                      <hr>
                    <?php endif; ?>
                  </div>
                <?php
                  $inner_delay_counter_bersama++;
                } ?>
              </div>
            </div>
            <br>
          <?php
            $delay_counter_bersama++;
          } ?>
          <?php ?>
        </div>


        <div class="col-md-4 col-sm-12 sijisiji wow fadeInRight" data-wow-delay="0.2s">
          <h2 class="wow fadeInDown" data-wow-delay="0.3s"> </h2>
          <hr class="wow fadeInLeft" data-wow-delay="0.4s">
          <h4 class="wow fadeInUp" data-wow-delay="0.5s"><b><?php echo $headerData['header_2']['header']; ?></b></h4>
          <div class="wow fadeInUp" data-wow-delay="0.6s">
            <p class="abuabu">
              <?php foreach ($profiles as $index_profile => $profile): ?>
            <div class="mb-3 wow fadeIn" data-wow-delay="<?php echo 0.7 + ($index_profile * 0.1); ?>s">
              <a class="button" href="profil.php?id_peneliti=<?= $profile['id_peneliti']; ?>">
                <strong><?= htmlspecialchars($profile['nama_peneliti']); ?></strong>
              </a><br>
              <?= htmlspecialchars($profile['bidang_minat']); ?><br>
              <?php foreach ($tautan as $link): ?>
                <?php if ($link['id_peneliti'] == $profile['id_peneliti']): ?>
                  <a href="<?= htmlspecialchars($link['link_tautan']) ?>" class="btn btn-primary btn-sm mt-2" target="_blank"><?= htmlspecialchars($link['nama_tautan']) ?></a> <br>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
          </p>
          </div>
          <div class="wow fadeInUp" data-wow-delay="0.8s">
            <a class="btn btn-primary btn-sm mt-2" href="login.php"> Login</a>
          </div>

        </div>
      </div>
    </div> <!-- /.container -->
  </div> <!-- Akhir dari content-wrapper -->

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <!-- Bootstrap 4 JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- WOW JS (Sesuaikan path jika perlu) -->
  <script src="lib/wow/wow.min.js"></script>
  <script>
    // Inisialisasi WOW.js
    new WOW().init();
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