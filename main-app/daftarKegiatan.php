<?php
header("Access-Control-Allow-Origin: *");
include('../config/db.php');

$qJenisAmalan = $link->query("SELECT * FROM tbl_jenis_amalan;");
?>
<div>
    <h2 class="page__title">Pendaftaran Kegiatan</h2>
    <p class="welcome">
        Silahkan pilih jenis amalan yang akan di daftarkan, setelah mendaftarkan amalan, lihat status approve & antrian di history amalan.
    </p>
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
        <div class="form__row mt-40">
            <a class="form__submit button button--main button--full" onclick="prosesDaftarKegiatanAtc()">Proses</a>
        </div>
    </div>
</div>

<script>
    function prosesDaftarKegiatanAtc()
    {
        let jenisAmalan = document.querySelector("#txtJenisAmalan").value;
        pesanUmumApp('success', 'Sukses', 'Berhasil mendaftarkan kegiatan');
    }
</script>