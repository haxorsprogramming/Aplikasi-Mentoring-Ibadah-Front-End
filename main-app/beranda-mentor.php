<div class="cards cards--11" style="text-align: center;">
    <div class="card card--style-cover card--style-round-corners">

        <img src="http://s3.jagoanstorage.com/aditia-storage/asset/logo/uinsu.png" style="width:100px;">
        <h2 class="page__title">LDK AL-Izzah Uinsu</h2>
        <h3 id="capUser">Selamat Datang, </h3>

    </div>
</div>

<p class="welcome"></p>
<h3>Fitur aplikasi (Mentor)</h3>
<div class="cards cards--12">
    <div class="card card--style-icon card--style-round-corners" onclick="buatKegiatanAtc()">
        <div class="card__icon"><img src="../ladun/assets/images/icons/blue/form.svg" alt="" title="" />
        </div>
        <h4 class="card__title">Buat Kegiatan</h4>
        <p class="card__text">Buat kegiatan amalan untuk digunakan oleh binaan</p>
    </div>
    <div class="card card--style-icon card--style-round-corners" onclick="listKegiatanMentorAtc()">
        <div class="card__icon"><img src="../ladun/assets/images/icons/blue/listing.svg" alt="" title="" />
        </div>
        <h4 class="card__title">Daftar Kegiatan</h4>
        <p class="card__text">Daftar antrian untuk binaan</p>
    </div>
    <div class="card card--style-icon card--style-round-corners">
        <div class="card__icon"><img src="../ladun/assets/images/icons/blue/pencil.svg" alt="" title="" />
        </div>
        <h4 class="card__title">Daftar Antrian</h4>
        <p class="card__text">Cek dan pantau info terbaru seputar pelaksanaan PPDB 2021</p>
    </div>
    <div class="card card--style-icon card--style-round-corners">
        <div class="card__icon"><img src="../ladun/assets/images/icons/blue/user.svg" alt="" title="" />
        </div>
        <h4 class="card__title">Cetak History Kegiatan</h4>
        <p class="card__text">Cek status pendaftaran PPDB yang telah kami lakukan</p>
    </div>
</div>

<script>
    var rGetInfoLogin = server + "api/getInfoLogin.php";
    var ds = {
        'username': username
    }
    $.post(rGetInfoLogin, ds, function(data) {
        let obj = JSON.parse(data);
        document.querySelector("#capUser").innerHTML = "Selamat datang, " + obj.namaUser;
    });

    function buatKegiatanAtc()
    {
        loadPage('buat-kegiatan.php');
    }
    function listKegiatanMentorAtc()
    {
        loadPage('list-kegiatan-mentor.php');
    }
</script>