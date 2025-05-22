<?php

session_start();


include(__DIR__ . '/../config/database.php');


// Cek Perubahan Bahasa---------------------------------------------------
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];}


// Inisisasi Bahasa Default
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


// Peneliti --------------------------------------------------------------
$queryPeneliti = "
    SELECT 
        pp.id_peneliti,
        pp.nama_peneliti, 
        ppb.bidang_minat
    FROM 
        profil_peneliti pp
    JOIN 
        profil_peneliti_bahasa ppb ON pp.id_peneliti = ppb.id_peneliti
    WHERE 
        ppb.kode_bahasa = :lang
";
$stmtPeneliti = $pdo->prepare($queryPeneliti);
$stmtPeneliti->execute(['lang' => $lang]);
$profiles = $stmtPeneliti->fetchAll(PDO::FETCH_ASSOC);
$profile = [];
foreach ($profiles as $rowprofile) {
    $profile[] = $rowprofile;
}


// ID Peneliti
$id_peneliti = isset($_GET['id_peneliti']) 
    ? $_GET['id_peneliti'] 
    : (!empty($profile) ? $profile[0]['id_peneliti'] : null);


// Tautan Peneliti -----------------------------------------------------------
$queryTautan = "SELECT * FROM tautan_peneliti";
$stmtTautan = $pdo->query($queryTautan);
$tautan = $stmtTautan->fetchAll(PDO::FETCH_ASSOC);


// Publikasi Peneliti Individu ---------------------------------------------------------
$queryPublikasi = "
    SELECT 
        tahun_publikasi,
        nama_publikasi,
        nama_peneliti,
        hari_tanggal_publikasi,
        tempat_publikasi,
        tautan_publikasi 
    FROM
        publikasi_peneliti_individu";
$stmtPublikasi = $pdo->query($queryPublikasi);
$publikasi = $stmtPublikasi->fetchAll(PDO::FETCH_ASSOC);
$kelompok_publikasi = [];
foreach ($publikasi as $rowpublikasi) {
    $kelompok_publikasi[$rowpublikasi['tahun_publikasi']][] = $rowpublikasi;
}

// Publikasi Peneliti Bersama---------------------------------------------------------
$queryPublikasiBersama = "
SELECT 
    pbp.id_publikasi_bersama_parent,
    pbp.tahun_publikasi,
    pbp.nama_publikasi,
    pbp.hari_tanggal_publikasi,
    pbp.tempat_publikasi,
    pbp.tautan_publikasi,
    GROUP_CONCAT(DISTINCT pbc.nama_peneliti SEPARATOR ', ') AS nama_peneliti
FROM 
    publikasi_bersama_parent pbp
JOIN 
    publikasi_bersama_child pbc ON pbp.id_publikasi_bersama_parent = pbc.id_publikasi_bersama_parent
GROUP BY 
    pbp.id_publikasi_bersama_parent;";
$stmtPublikasiBersama = $pdo->prepare($queryPublikasiBersama);
$stmtPublikasiBersama->execute();
$selected_publikasi_bersama = $stmtPublikasiBersama->fetchAll(PDO::FETCH_ASSOC);
$kelompok_publikasi_bersama = [];
foreach ($selected_publikasi_bersama as $rowpublikasibersama) {
    $kelompok_publikasi_bersama[$rowpublikasibersama['tahun_publikasi']][] = $rowpublikasibersama;
}


// Header-------------------------------------------------------------------------
$queryHeader = "
    SELECT
        pph.id_header, 
        pph.nama_header, 
        pphb.header, 
        pphb.sub_header 
    FROM 
        publikasi_peneliti_header pph
    JOIN
        publikasi_peneliti_header_bahasa pphb ON pph.id_header = pphb.id_header
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
$navigasiData[$rowsNavigasi['nama_header']] = [
    'header' => $rowsNavigasi['header']];}
    