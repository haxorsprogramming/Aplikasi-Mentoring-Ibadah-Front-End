<?php
session_start();
include('../config/db.php');
$userLogin = $_SESSION['userLogin'];
$qJenisAmalan = $link->query("SELECT * FROM tbl_jenis_amalan;");
// get id binaan 
$qDataBinaan = $link -> query("SELECT * FROM tbl_kelompok_binaan_anggota WHERE id_binaan='$userLogin' LIMIT 0,1");
$fDataBinaan = $qDataBinaan -> fetch_assoc();
$idKelompokBinaan = $fDataBinaan['id_kelompok_binaan'];
// get kegiatan 
$qKegiatan = $link -> query("SELECT * FROM tbl_kegiatan WHERE id_kelompok_binaan='$idKelompokBinaan';");
?>
<div>
    <h2 class="page__title">Pendaftaran Kegiatan</h2>
    <p class="welcome">
        Silahkan pilih jenis amalan yang akan di daftarkan, setelah mendaftarkan amalan, lihat status approve & antrian di history amalan.
    </p>
    <div class="form__row">
        <div class="form__select">
            <label>Pilih Kegiatan</label>
            <select name="selectoptions" class="required" id="txtJenisKegiatan">
                <?php while($fKegiatan = $qKegiatan -> fetch_assoc()){ ?>
                <option value="<?=$fKegiatan['token_kegiatan']; ?>"><?=$fKegiatan['nama_kegiatan']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form__row">
        <div class="form__select">
            <label>Pilih Amalan</label>
            <select name="selectoptions" class="required" id="txtJenisAmalan">
                <?php
                while ($fAmalan = $qJenisAmalan->fetch_assoc()) { ?>
                    <option value="<?= $fAmalan['kd_amalan']; ?>"><?= $fAmalan['nama_amalan']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form__row mt-40">
        <a class="form__submit button button--main button--full" onclick="prosesDaftarKegiatanAtc()">Proses Pendaftaran Kegiatan</a>
    </div>
</div>

<script>
    function prosesDaftarKegiatanAtc() {
        let jenisAmalan = document.querySelector("#txtJenisAmalan").value;
        let jenisKegiatan = document.querySelector("#txtJenisKegiatan").value;
        let ds = {'jenisAmalan':jenisAmalan, 'jenisKegiatan':jenisKegiatan, 'username':'<?=$userLogin;?>', 'idKb' : '<?=$idKelompokBinaan; ?>'}
        axios.post(serverApi + "api/kegiatan/pendaftaran/proses", ds).then(function(res){
            
        });
    }
</script>