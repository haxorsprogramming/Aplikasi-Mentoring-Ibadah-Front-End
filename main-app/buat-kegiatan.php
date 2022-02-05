<?php
session_start();
include('../config/db.php');
$userLogin = $_SESSION['userLogin'];

$qKelompokBinaan = $link->query("SELECT * FROM tbl_kelompok_binaan WHERE id_mentor='$userLogin';");

?>
<div>
    <h2 class="page__title">Tambah Kegiatan</h2>
    <p class="welcome">
        Silahkan buat kegiatan yang akan digunakan untuk binaan dalam menyetor amalan.
    </p>
    <div class="form__row">
        <div class="form__select">
            <label>Kelompok Binaan</label>
            <select name="selectoptions" class="required" id="txtKelompokBinaan">
                <?php while ($fKb = $qKelompokBinaan->fetch_assoc()) { ?>
                    <option value="<?= $fKb['id_kelompok_binaan']; ?>"><?= $fKb['nama_kelompok_binaan']; ?></option>
                <?php } ?>
            </select>
        </div>

    </div>
    <div class="form__row">
        <label>Nama Kegiatan</label>
        <input type="text" id="txtNamaKegiatan" value="" class="form__input required" placeholder="Nama Kegiatan">
    </div>
    <div class="form__row">
        <label>Tanggal</label>
        <input type="date" id="txtTanggal" value="" class="form__input required">
    </div>
    <div class="form__row">
        <label>Waktu Mulai</label>
        <input type="time" id="txtMulai" value="" class="form__input required">
    </div>
    <div class="form__row">
        <label>Waktu Selesai</label>
        <input type="time" id="txtSelesai" value="" class="form__input required">
    </div>
    <div class="form__row mt-40" style="text-align: center;display:none;" id="divStatusProses">
        <h4>Memproses ...</h4>
    </div>
    <div class="form__row mt-40" id="divBtnKegiatan">
        <a class="form__submit button button--main button--full" id="btnProses" onclick="prosesBuatKegiatanAtc()">Proses</a>
    </div>
</div>
<script>
    function prosesBuatKegiatanAtc() {
        let kelompokBinaan = document.querySelector("#txtKelompokBinaan").value;
        let namaKegiatan = document.querySelector("#txtNamaKegiatan").value;
        let tanggal = document.querySelector("#txtTanggal").value;
        let mulai = document.querySelector("#txtMulai").value;
        let selesai = document.querySelector("#txtSelesai").value;
        if(namaKegiatan === '' || tanggal === '' || mulai === '' || selesai === ''){
            pesanUmumApp('warning', 'Isi field !!!', 'Harap isi semua field !!! ..');
        }else{
            let ds = {'kb':kelompokBinaan, 'nama':namaKegiatan, 'tanggal':tanggal, 'mulai':mulai, 'selesai':selesai, 'username':'<?=$userLogin; ?>'}
            console.log(ds);
            $("#divBtnKegiatan").hide();
            $("#divStatusProses").show();
            setTimeout(function(){
                axios.post(serverApi + "api/kegiatan/tambah/proses", ds).then(function(res){
                    pesanUmumApp('success', 'Sukses', 'Sukses membuat kegiatan ..');
                    loadPage("list-kegiatan-mentor.php");
                });
            }, 2000);
        }
    }
</script>