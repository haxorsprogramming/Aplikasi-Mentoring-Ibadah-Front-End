<?php 
session_start();
header("Access-Control-Allow-Origin: *");
include('../config/db.php');
$username = $_SESSION['userLogin'];
$idKelompokBinaan = $_POST['idKelompokBinaan'];

//get info kegiatan 
$qKegiatan = $link -> query("SELECT * FROM tbl_kegiatan WHERE id_kelompok_binaan='$idKelompokBinaan';");

$data = array();

while($fk = $qKegiatan -> fetch_assoc()){
    $arrTemp['namaKegiatan'] = $fk['nama_kegiatan'];
    $arrTemp['tokenKegiatan'] = $fk['token_kegiatan'];
    $arrTemp['tanggal'] = $fk['tanggal_kegiatan'];
    $data[] = $arrTemp;
}

// $dr = ['status' => $idKelompokBinaan];

echo json_encode($data);

?>