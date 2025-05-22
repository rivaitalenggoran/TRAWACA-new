<?php

session_start();


include(__DIR__ . '/../config/database.php');


// Cek Perubahan Bahasa-----------------------------------------------------
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];}
  

// Inisisasi Bahasa Default-------------------------------------------------
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


// Peneliti ----------------------------------------------------------------
$queryPeneliti = "
    SELECT 
        pp.id_peneliti,
        pp.nama_peneliti,
        pp.email_peneliti,
        pp.keterangan_tambahan, 
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


// ID Peneliti-----------------------------------------------------------------
$id_peneliti = isset($_GET['id_peneliti']) 
    ? $_GET['id_peneliti'] 
    : (!empty($profile) ? $profile[0]['id_peneliti'] : null);
   

// Ambil Data Profil berdasarkan ID--------------------------------------------
$selected_profile = null;
foreach ($profiles as $profile) {
    if ($profile['id_peneliti'] == $id_peneliti) {
        $selected_profile = $profile;
        break;
    }
}


// Tautan Peneliti -------------------------------------------------------------
$queryTautan = "SELECT * FROM tautan_peneliti";
$stmtTautan = $pdo->query($queryTautan);
$tautan = $stmtTautan->fetchAll(PDO::FETCH_ASSOC);


// Pendidikan-------------------------------------------------------------------
$queryPendidikan = "
    SELECT 
        pp.id_peneliti,
        ppb.nama_instansi,
        ppb.gelar,
        ppb.fakultas,
        ppb.tugas_akhir
    FROM 
        pendidikan_peneliti pp
    JOIN 
        pendidikan_peneliti_bahasa ppb ON ppb.id_pendidikan = pp.id_pendidikan
    WHERE 
        kode_bahasa = :lang 
    AND 
    id_peneliti = $id_peneliti
";
$stmtPendidikan = $pdo->prepare($queryPendidikan);
$stmtPendidikan->execute(['lang' => $lang]);
$pendidikan = $stmtPendidikan->fetchAll(PDO::FETCH_ASSOC);


// Pekerjaan--------------------------------------------------------------------
$queryPekerjaan = "
    SELECT 
        pp.id_peneliti,
        ppb.nama_instansi,
        ppb.pekerjaan,
        ppb.waktu_pekerjaan,
        ppb.keterangan_tambahan
    FROM 
        pekerjaan_peneliti pp
    JOIN 
        pekerjaan_peneliti_bahasa ppb ON ppb.id_pekerjaan = pp.id_pekerjaan
    WHERE 
        kode_bahasa = :lang 
    AND 
    id_peneliti = $id_peneliti
";
$stmtPekerjaan = $pdo->prepare($queryPekerjaan);
$stmtPekerjaan->execute(['lang' => $lang]);
$pekerjaan = $stmtPekerjaan->fetchAll(PDO::FETCH_ASSOC);


// Minat--------------------------------------------------------------------------
$queryMinat = "
    SELECT 
        mp.id_peneliti,
        mpb.nama_minat,
        mpb.subtopik_minat
    FROM 
        minat_peneliti mp

    JOIN 
        minat_peneliti_bahasa mpb ON mpb.id_minat = mpb.id_minat
    WHERE 
        kode_bahasa = :lang 
    AND 
        id_peneliti = $id_peneliti
";
$stmtMinat = $pdo->prepare($queryMinat);
$stmtMinat->execute(['lang' => $lang]);
$minat = $stmtMinat->fetchAll(PDO::FETCH_ASSOC);


// Karya---------------------------------------------------------------------------
$queryKarya = "
    SELECT 
        ky.id_peneliti,
        ky.tahun_pengerjaan_karya, 
        ky.tautan_karya,
        kyb.nama_karya,
        kyb.deskripsi_karya,
        kyb.nama_tautan_karya
    FROM 
        karya_peneliti ky
    JOIN 
        karya_peneliti_bahasa kyb ON ky.id_karya = kyb.id_karya
    WHERE 
        kyb.kode_bahasa = :lang
    AND 
        ky.id_peneliti = $id_peneliti
";
$stmtKarya = $pdo->prepare($queryKarya);
$stmtKarya->execute(['lang' => $lang]);
$karya = $stmtKarya->fetchAll(PDO::FETCH_ASSOC);


// //Publikasi Peneliti Individu----------------------------------------------------------
$queryPublikasi = "
    SELECT 
        id_peneliti,
        tahun_publikasi,
        nama_publikasi,
        nama_peneliti,
        hari_tanggal_publikasi,
        tempat_publikasi,
        tautan_publikasi 
    FROM 
        publikasi_peneliti_individu
    WHERE 
        id_peneliti = $id_peneliti
";
$stmtPublikasi = $pdo->query($queryPublikasi);
$publikasi = $stmtPublikasi->fetchAll(PDO::FETCH_ASSOC);
$kelompok_publikasi = [];
foreach ($publikasi as $rowpublikasi) {
    $kelompok_publikasi[$rowpublikasi['tahun_publikasi']][] = $rowpublikasi;}


// Publikasi Peneliti Bersama---------------------------------------------------------
// Ambil semua publikasi bersama milik peneliti ini
$queryPublikasiBersama = "
    SELECT 
        pbp.id_publikasi_bersama_parent,
        pbp.tahun_publikasi,
        pbp.nama_publikasi,
        pbp.hari_tanggal_publikasi,
        pbp.tempat_publikasi,
        pbp.tautan_publikasi,
        pbc.id_publikasi_bersama_child,
        pbc.nama_peneliti
    FROM 
        publikasi_bersama_parent pbp
    JOIN 
        publikasi_bersama_child pbc ON pbp.id_publikasi_bersama_parent = pbc.id_publikasi_bersama_parent
    WHERE 
        pbc.id_peneliti = ?
";
$stmtPublikasiBersama = $pdo->prepare($queryPublikasiBersama);
$stmtPublikasiBersama->execute([$id_peneliti]);
$selected_publikasi_bersama = $stmtPublikasiBersama->fetchAll(PDO::FETCH_ASSOC);
$kelompok_publikasi_bersama = [];
foreach ($selected_publikasi_bersama as $rowpublikasibersama) {
    $kelompok_publikasi_bersama[$rowpublikasibersama['tahun_publikasi']][] = $rowpublikasibersama;
}

    
// Header-------------------------------------------------------------------------
$queryHeader = "
    SELECT
        ph.id_header, 
        ph.nama_header, 
        phb.header, 
        phb.sub_header 
    FROM 
        profil_peneliti_header ph
    JOIN
        profil_peneliti_header_bahasa phb ON ph.id_header = phb.id_header
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
?>