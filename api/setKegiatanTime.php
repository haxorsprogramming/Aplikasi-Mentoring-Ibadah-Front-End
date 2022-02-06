<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
header("Access-Control-Allow-Origin: *");
include('../config/db.php');
$waktuSekarang = date("Y-m-d H:i:s");
$timeSekarang = date("H:i:s");
// get kegiatan 
$qKegiatan = $link -> query("SELECT * FROM tbl_kegiatan;");
echo "Waktu Sekarang".$waktuSekarang."<br/><br/>";

while($fKegiatan = $qKegiatan -> fetch_assoc()){
    $idKegiatan = $fKegiatan['token_kegiatan'];
    $waktuMulai = $fKegiatan['waktu_mulai'];
    $tanggalKegiatan = $fKegiatan['tanggal_kegiatan'];
    // $dMulai = date($tanggalKegiatan.' '.$waktuMulai.':00');
    $dMulai = date($tanggalKegiatan.' '.$waktuMulai.':00');

    echo $fKegiatan['nama_kegiatan'].". Waktu Mulai : ".$dMulai."<br/>";
    echo "List binaan : <br/>";
    // cari detail peserta 
    $qPeserta = $link -> query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan';");
    // $menitBaruBuat = 0;
    $waBanget = date($tanggalKegiatan.' '.$waktuMulai.':00');
    while($fPeserta = $qPeserta -> fetch_assoc()){
        $tokenAntrian = $fPeserta['token_antrian'];
        $idBinaan = $fPeserta['id_binaan'];
        $idJenisAmalan = $fPeserta['id_jenis_amalan'];
        $qAmalan = $link -> query("SELECT * FROM tbl_jenis_amalan WHERE kd_amalan='$idJenisAmalan' LIMIT 0,1;");
        $fAmalan = $qAmalan -> fetch_assoc();
        
        $menitBaru = date('H:i:s', strtotime($waBanget. '+'.$fAmalan['durasi'].' minutes'));
        $waBanget = $menitBaru;
        if(strtotime($waktuSekarang) > strtotime($waBanget)){
            // $link -> query("UPDATE tbl_peserta SET status_setoran='SELESAI' WHERE token_antrian='$tokenAntrian';");
            $statusWaktu = "Sudah lewat";
        }else{
            $statusWaktu = "Belum lewat";
        }
        echo "<li>".$idBinaan.". Burst Time : ".$fAmalan['durasi']." menit. Perkiraan waktu selesai : ".$menitBaru.". Status Waktu : ".$statusWaktu."</li>";
    }
    // cari data teratas 
    $qTokenPertamaAntrian = $link->query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan' AND status_setoran='ANTRIAN' LIMIT 0,1;");
    $fTokenPertama = $qTokenPertamaAntrian -> fetch_assoc();
    $tokenPertama = $fTokenPertama['token_antrian'];
    // $link -> query("UPDATE tbl_peserta SET status_setoran='BERLANGSUNG' WHERE token_antrian='$tokenPertama';");
    echo "<hr/>";
}

?>