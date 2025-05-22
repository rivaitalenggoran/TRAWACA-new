<?php

session_start();


include(__DIR__ . '/../config/database.php');


// Cek Perubahan Bahasa-----------------------------------------------------
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];}


// Inisisasi Bahasa Default--------------------------------------------------
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'id';


// Bahasa--------------------------------------------------------------------
$queryBahasa = "
    SELECT
        nama_bahasa,
        link_bahasa,
        disable
    FROM
        bahasa";

$stmtbahasa = $pdo->prepare($queryBahasa);
$stmtbahasa->execute();
$Bahasa = $stmtbahasa->fetchAll(PDO::FETCH_ASSOC);

// Aplikasi--------------------------------------------------------------------
$queryAplikasi = "
    SELECT
        nama_aplikasi,
        link_aplikasi,
        disable,
        jenis_aplikasi
    FROM
        aplikasi";

$stmtaplikasi = $pdo->prepare($queryAplikasi);
$stmtaplikasi->execute();
$Aplikasi = $stmtaplikasi->fetchAll(PDO::FETCH_ASSOC);

// Peneliti------------------------------------------------------------------
$queryPeneliti = "
    SELECT 
        pp.nama_peneliti, 
        ppb.bidang_minat
    FROM 
        profil_peneliti pp
    JOIN 
        profil_peneliti_bahasa ppb ON pp.id_peneliti = ppb.id_peneliti
    WHERE 
        ppb.kode_bahasa = :lang";
$stmtPeneliti = $pdo->prepare($queryPeneliti);
$stmtPeneliti->execute(['lang' => $lang]);
$penelitiBahasa = $stmtPeneliti->fetchAll(PDO::FETCH_ASSOC);


// Kontributor-----------------------------------------------------------------
$queryKontributor = "
    SELECT 
        * 
    FROM 
        kontributor";
$stmtKontributor = $pdo->prepare($queryKontributor);
$stmtKontributor->execute();
$Kontributor = $stmtKontributor->fetchAll(PDO::FETCH_ASSOC);

// Kontak----------------------------------------------------------------------
$queryKontak = "
    SELECT 
        * 
    FROM 
        kontak_trawaca";
$stmtKontak = $pdo->prepare($queryKontak);
$stmtKontak->execute();
$Kontak = $stmtKontak->fetchAll(PDO::FETCH_ASSOC);

// Kegiatan--------------------------------------------------------------------
// data kegiatan
$queryKegiatan = "
    SELECT
        kl.gambar_kegiatan_luaran,
        kl.waktu_kegiatan_luaran,
        kl.link_kegiatan_luaran,
        klt.nama_kegiatan_luaran,
        klt.deskripsi_kegiatan_luaran,
        klt.nama_link
    FROM
        kegiatan_luaran kl
    JOIN
        kegiatan_luaran_bahasa klt
        ON kl.id_kegiatan = klt.id_kegiatan
    WHERE
        klt.kode_bahasa = :lang";
$stmtKegiatan = $pdo->prepare($queryKegiatan);
$stmtKegiatan->execute(['lang' => $lang]);
$Kegiatan = $stmtKegiatan->fetchAll(PDO::FETCH_ASSOC);

// Sahabat----------------------------------------------------------------------
$querySahabat = "
    SELECT 
        sh.nama_sahabat, 
        sht.nama_waktu_kerjasama
    FROM 
        sahabat_trawaca sh
    JOIN 
        sahabat_trawaca_bahasa sht ON sh.id_sahabat = sht.id_sahabat
    WHERE 
        sht.kode_bahasa = :lang";
$stmtSahabat = $pdo->prepare($querySahabat);
$stmtSahabat->execute(['lang' => $lang]);
$Sahabat = $stmtSahabat->fetchAll(PDO::FETCH_ASSOC);

// Header-------------------------------------------------------------------------
$queryHeader = "
    SELECT
        bh.id_header, 
        bh.nama_header, 
        bhb.header, 
        bhb.sub_header 
    FROM 
        beranda_header bh
    JOIN
        beranda_header_bahasa bhb ON bh.id_header = bhb.id_header
    WHERE 
        kode_bahasa = :lang";
$stmtHeader = $pdo->prepare($queryHeader);
$stmtHeader->execute(['lang' => $lang]);
$headers = $stmtHeader->fetchAll(PDO::FETCH_ASSOC);
$headerData = [];
foreach ($headers as $rowHeaders) {
    $headerData[$rowHeaders['nama_header']] = [
        'header' => $rowHeaders['header'],
        'sub_header' => $rowHeaders['sub_header']];}


// Navigasi------------------------------------------------------------------------
$queryNavigasi ="
    SELECT
        nama_header,
        header
    FROM
        navigasi
    WHERE
        kode_bahasa = :lang";
$stmtNavigasi = $pdo->prepare($queryNavigasi);
$stmtNavigasi->execute(['lang' => $lang]);
$navigasi = $stmtNavigasi->fetchAll(PDO::FETCH_ASSOC);
$navigasiData = [];
foreach ($navigasi as $rowsNavigasi) {
    $navigasiData[$rowsNavigasi['nama_header']] = 
    ['header' => $rowsNavigasi['header']];}


