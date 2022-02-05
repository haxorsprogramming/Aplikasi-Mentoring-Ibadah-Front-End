<?php 
header("Access-Control-Allow-Origin: *");
include('../config/db.php');
// {'kb':kelompokBinaan, 'nama':namaKegiatan, 'tanggal':tanggal, 'mulai':mulai, 'selesai':selesai}
$kb = $_POST['kb'];
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$mulai = $tanggal.$_POST['mulai'];
$selesai = $tanggal.$_POST['selesai'];
$tokenKegiatan = uniqid();

$waktu = date("Y-m-d h:i:sa");

$link -> query("INSERT INTO tbl_kegiatan (id, token_kegiatan, nama_kegiatan, tanggal_kegiatan, id_kelompok_binaan, waktu_mulai, waktu_selesai, created_at, updated_at, active) VALUES(null, '$tokenKegiatan','$nama','$tanggal','$kb','$waktu','$waktu','$waktu','$waktu','1');");

$dr = ['status' => $waktu];

echo json_encode($dr);

?>