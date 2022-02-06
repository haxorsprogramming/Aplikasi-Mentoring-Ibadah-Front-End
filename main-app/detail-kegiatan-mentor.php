<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];
$idKegiatan = $_GET['token'];
// list peserta 
$qPeserta = $link -> query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan';");
?>

<h2 class="page__title">Detail Kegiatan</h2>
<p class="welcome">
    Detail kegiatan, disini mentor dapat mengubah status setoran dari binaan.
</p>
<hr/>
<h4>List Binaan</h4>
<?php while($fPer = $qPeserta -> fetch_assoc()){ ?>
<?php 
$idBinaan = $fPer['id_binaan'];
// cari data binaan 
$qBinaan = $link -> query("SELECT * FROM tbl_profile_member WHERE username='$idBinaan' LIMIT 0,1;");
$fBinaan = $qBinaan -> fetch_assoc();
?>
    <div class="card card--style-inline card--style-inline-bg">
        
        <div class="card__details" >
            <h4 class="card__title"><?=$fBinaan['nama_lengkap']; ?></h4>
            <p class="card__text">
                Kelompok : <strong>asd</strong><br/>
                Total Binaan : asd
            </p>
        </div>
        <p>
            <a href="javascript:void(0)">Detail</a><br/>
            <a href="javascript:void(0)">Hapus</a>
        </p>
    </div>
<?php } ?>