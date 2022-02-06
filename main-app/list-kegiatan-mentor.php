<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];
// get kelompok binaan 
$qKelompokBinaan = $link->query("SELECT * FROM tbl_kelompok_binaan WHERE id_mentor='$username';");
?>
<div id="divListKegiatanMentor">
    <h2 class="page__title">List Kegiatan</h2>
    <p class="welcome">
        List kegiatan yang di handle oleh mentor.
    </p>
    <div class="form__row">
        <div class="form__select">
            <label>Pilih Kelompok Binaan</label>
            <select name="selectoptions" class="required" id="txtKelompokBinaan" onchange="setKelompokBinaan()" style="border: 1px solid gray;border-radius:8px;">
                <option value="none">-- Pilih kelompok binaan --</option>
                <?php while($fk = $qKelompokBinaan -> fetch_assoc()){ ?>
                <option value="<?=$fk['id_kelompok_binaan']; ?>"><?=$fk['nama_kelompok_binaan']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form__row">
        <div class="form__select">
            <label>Pilih Kegiatan Binaan</label>
            <select name="selectoptions" class="required" id="txtJenisKegiatan" onchange="setKegiatan()" style="border: 1px solid gray;border-radius:8px;">
                <option value="none">Pilih Kegiatan</option>
                <option v-for="dk in dataKegiatan" v-bind:value="dk.token">{{dk.nama}}</option>
            </select>
        </div>
    </div>
    <div id="divDataAntrian">

    </div>

</div>

<script>
    var appKegiatan = new Vue({
        el : "#divListKegiatanMentor",
        data : {
            dataKegiatan : []
        }
    });
    function detailAtc(token) {
        loadPage('detail-kegiatan-mentor.php?token=' + token);
    }
    function setKelompokBinaan()
    {
        resetDataKegiatan();
        let idKelompokBinaan = document.querySelector("#txtKelompokBinaan").value;
        $.post(server + "api/getInfoKegiatan.php", {'idKelompokBinaan':idKelompokBinaan}, function(data){
            let obj = JSON.parse(data);
            for(let i = 0; i < obj.length; i++){
                appKegiatan.dataKegiatan.push({nama:obj[i].namaKegiatan, token:obj[i].tokenKegiatan});
            }
        });
    }
    function setKegiatan()
    {
        let idKegiatan = document.querySelector("#txtJenisKegiatan").value;
        if(idKegiatan === 'none'){
            return false;   
        }
        document.querySelector("#divDataAntrian").innerHTML = "Memuat ...";
        $("#divDataAntrian").load('data-list-antrian-mentor.php?idKegiatan='+idKegiatan);
    }
    function resetDataKegiatan()
    {
        for(let i = 0; i <= appKegiatan.dataKegiatan.length; i++){
            appKegiatan.dataKegiatan.splice(0, 1);
        }
    }
</script>