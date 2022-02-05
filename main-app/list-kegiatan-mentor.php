<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];
$qKegiatan = $link->query("SELECT * FROM tbl_kegiatan WHERE id_mentor='$username';");
?>
<h2 class="page__title">List Kegiatan</h2>
<p class="welcome">
    List kegiatan yang di handle oleh mentor.
</p>
<hr/>
<?php while ($fk = $qKegiatan->fetch_assoc()) { ?>
    <?php
    $idKelompokBinaan = $fk['id_kelompok_binaan'];
    $qKelompokBinaan = $link->query("SELECT * FROM tbl_kelompok_binaan WHERE id_kelompok_binaan='$idKelompokBinaan' LIMIT 0,1;");
    $fKb = $qKelompokBinaan->fetch_assoc();

    ?>
    <div class="card card--style-inline card--style-inline-bg card--style-round-corners">
        <div class="card__icon"><img src="<?= $server; ?>ladun/img/blocks.svg" alt="" title=""></div>
        <div class="card__details">
            <h4 class="card__title"><?= $fk['nama_kegiatan']; ?></h4>
            <p class="card__text"><strong><?= $fKb['nama_kelompok_binaan']; ?></strong> </p>

        </div>
        <p>
            <a href="javascript:void(0)" onclick='detailAtc("<?=$fk["token_kegiatan"]; ?>")'>Detail</a><br/>
            <a href="javascript:void(0)">Hapus</a>
        </p>
    </div>
    <hr/>
<?php } ?>

<script>
    function detailAtc(token)
    {
        console.log(token);
    }
</script>