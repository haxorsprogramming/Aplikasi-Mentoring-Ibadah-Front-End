<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];
$qAntrian = $link -> query("SELECT * FROM tbl_peserta WHERE id_binaan='$username';");
?>

<div>
    <h2 class="page__title">Status Amalan</h2>
    <p class="welcome">
        Status amalan.
    </p>
    <hr/>
    <?php while($fAntrian = $qAntrian -> fetch_assoc()){ ?>
    <?php
        $idKegiatan = $fAntrian['id_kegiatan'];
        $idAmalan = $fAntrian['id_jenis_amalan'];
        
        // cari data kegiatan 
        $qKegiatan = $link -> query("SELECT * FROM tbl_kegiatan WHERE token_kegiatan='$idKegiatan' LIMIT 0, 1;");
        $fKegiatan = $qKegiatan -> fetch_assoc();
        // cari data jenis amalan 
        $qJenisAmalan = $link -> query("SELECT * FROM tbl_jenis_amalan WHERE kd_amalan='$idAmalan' LIMIT 0,1;");
        $fAmalan = $qJenisAmalan -> fetch_assoc();
        // cari total antrian 
        $qTotalAntrian = $link -> query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan' AND status_setoran='ANTRIAN';");
        $tAntrian = mysqli_num_rows($qTotalAntrian);
        // cari nomor antrian 
        $nomorAntrian = $fAntrian['ordinal'];
    ?>
    <div class="card card--style-inline card--style-inline-bg">
        <div class="card__icon"><img src="<?= $server; ?>ladun/img/blocks.svg" style="width:40px;" alt="" title=""></div>
        <div class="card__details">
            <h4 class="card__title"><?=$fAmalan['nama_amalan']; ?></h4>
            <p class="card__text"><strong><?=$fKegiatan['nama_kegiatan']; ?></strong> </p>
            <p class="card__text">Tanggal Kegiatan : <?=$fKegiatan['tanggal_kegiatan']; ?>
            <br/>Mulai : <?=$fKegiatan['waktu_mulai']; ?><br/>Selesai : <?=$fKegiatan['waktu_selesai']; ?><br/>
            Nomor Antrian : <?=$nomorAntrian; ?><br/>
            Total Antrian : <?=$tAntrian; ?><br/>
            Status : <b>Menunggu Antrian</b>
            <p>
        </p>
        </div>
        <p>
            <a href="javascript:void(0)">Detail</a><br/>
        </p>
    </div>
    <hr/>
    <?php } ?>
</div>