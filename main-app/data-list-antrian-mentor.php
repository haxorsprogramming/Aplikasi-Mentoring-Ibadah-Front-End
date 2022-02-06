<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];
$idKegiatan = $_GET['idKegiatan'];
// query cari antrian 
$qPeserta = $link -> query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan';");
// queery kegiatan 
$qKegiatan = $link -> query("SELECT * FROM tbl_kegiatan WHERE token_kegiatan='$idKegiatan' LIMIT 0,1;");
$fKegiatan = $qKegiatan -> fetch_assoc();
?>
<hr/>
<h4>Detail Kegiatan</h4>
Nama Kegiatan : <?=$fKegiatan['nama_kegiatan']; ?><br/>
Waktu Mulai : <?=$fKegiatan['waktu_mulai']; ?><br/>
Waktu Selesai : <?=$fKegiatan['waktu_selesai']; ?><br/>
<hr />
<?php while ($fPeserta = $qPeserta->fetch_assoc()) { ?>
    <?php
    $tokenAntrian = $fPeserta['token_antrian'];
    $idBinaan = $fPeserta['id_binaan'];
    $idJenisAmalan = $fPeserta['id_jenis_amalan'];
    $idKegiatan = $fPeserta['id_kegiatan'];
    // cari data binaan 
    $qBinaan = $link->query("SELECT * FROM tbl_profile_member WHERE username='$idBinaan' LIMIT 0,1;");
    $fBinaan = $qBinaan->fetch_assoc();
    // cari jenis amalan 
    $qJenisAmalan = $link->query("SELECT * FROM tbl_jenis_amalan WHERE kd_amalan='$idJenisAmalan' LIMIT 0,1;");
    $fAmalan = $qJenisAmalan->fetch_assoc();
    // cek setoran dulu 
    $qCekSetoran = $link -> query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan' AND status_setoran='ANTRIAN';");
    $tSetoran = mysqli_num_rows($qCekSetoran);
    if($tSetoran > 0){
        // cari record yang pertama
        $qTokenPertamaAntrian = $link -> query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan' AND status_setoran='ANTRIAN' LIMIT 0,1;");
        $fTokenPertama = $qTokenPertamaAntrian->fetch_assoc();
        $tokenPertama = $fTokenPertama['token_antrian'];
        // cek apakah ada amalan yang sedang berlangsung 
        $qCekAmalanBerlangsung = $link->query("SELECT * FROM tbl_peserta WHERE id_kegiatan='$idKegiatan' AND status_setoran='BERLANGSUNG';");
        $tAmalanBerlangsung = mysqli_num_rows($qCekAmalanBerlangsung);
    }else{

    }
    
    
    ?>
    <div class="card card--style-inline card--style-inline-bg">
        <div class="card__details">
            <h4 class="card__title">Antrian <?= $fPeserta['ordinal']; ?></h4>
            <p class="card__text">
                Nama Binaan : <strong><?= $fBinaan['nama_lengkap']; ?></strong><br />
                Jenis Amalan : <strong><?= $fAmalan['nama_amalan']; ?></strong><br />
                <?php if ($fPeserta['status_setoran'] == 'ANTRIAN') {
                    echo "Status : <b>Menungu Antrian</b>";
                } elseif ($fPeserta['status_setoran'] == 'BERLANGSUNG') {
                    echo "Status : <b>Sedang melaksanakan amalan</b>";
                } else {
                    echo "Status : <b>Selesai</b><br/>";
                    echo "Waktu selesai : ".$fPeserta['waktu_selesai'];
                }
                ?>
                <br/>
            </p>
        </div>
        <p>
            <?php
            // if($statusPertama == true){
            //     echo "Approve";
            // }
            if ($fPeserta['status_setoran'] == 'SELESAI') {
            } elseif ($fPeserta['status_setoran'] == 'BERLANGSUNG') { ?>
                <a href="javascript:void(0)" onclick='tandaiSelesaiAtc("<?=$tokenAntrian; ?>")'>Tandai selesai</a>
            <?php } elseif ($tokenPertama == $tokenAntrian) { ?>
                <a href="javascript:void(0)" onclick='rejectAtc("<?=$tokenAntrian; ?>")'> Reject</a>
            <?php } elseif ($fPeserta['status_setoran'] == 'ANTRIAN') { ?>
                <a href="javascript:void(0)" onclick='rejectAtc("<?=$tokenAntrian; ?>")'>Reject</a>
            <?php } ?>
        </p>
    </div>
    <hr />
<?php } ?>

<div>
    <a class="form__submit button button--main button--full" id="btnProses" onclick="exportPdf()">Export PDF</a>
</div>

<script>
    var idKegiatan = "<?=$idKegiatan; ?>";

    function tandaiSelesaiAtc(token)
    {
        confirmQuest('info', 'Konfirmasi', 'Konfirmasi selesai amalan untuk binaan ini?', function (x) {finishConfirm(token)});
    }
    function finishConfirm(token)
    {
        let ds = {'token':token}
        axios.post(serverApi + "api/kegiatan/amalan/selesai/proses", ds).then(function(res){
            pesanUmumApp('success', 'Sukses', 'Sukses mengupdate status antrian ..');
            $("#divDataAntrian").load('data-list-antrian-mentor.php?idKegiatan='+idKegiatan);
        });
    }
    function exportPdf()
    {
        let urlExport = serverApi + "api/pdf/export/"+idKegiatan;
        window.open(urlExport);
    }
    function rejectAtc(token)
    {
        confirmQuest('info', 'Konfirmasi', 'Konfirmasi reject (keluarkan) binaan untuk melakukan setoran?', function (x) {rejectConfirm(token)});
    }
    function rejectConfirm(token)
    {
        let ds = {'token':token}
        axios.post(serverApi + "api/kegiatan/amalan/reject/proses", ds).then(function(res){
            pesanUmumApp('success', 'Sukses', 'Sukses mengahpus salah satu antrian ..');
            $("#divDataAntrian").load('data-list-antrian-mentor.php?idKegiatan='+idKegiatan);
        });
    }
    function confirmQuest(icon, title, text, x)
    {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.value) {
                x();
            }
        });
    }
</script>