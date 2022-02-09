<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];
// query info profile 
$qDataProfile = $link -> query("SELECT * FROM tbl_profile_member WHERE username='$username' LIMIT 0,1;");
$fProfile = $qDataProfile -> fetch_assoc();
$namaLengkap = $fProfile['nama_lengkap'];
$hp = $fProfile['nomor_handphone'];
$email = $fProfile['email'];
$jk = $fProfile['jk'];
?>
<div class="user-profile mb-20">
    <?php if($jk == "P"){ ?>
        <div class="user-profile__thumb"><img src="../img/ukti.jpg" alt="" title=""></div>
    <?php }else{ ?>
        <div class="user-profile__thumb"><img src="../img/akhi.jpg" alt="" title=""></div>
    <?php } ?>
    
    <div class="user-profile__name"><?=$namaLengkap; ?></div>
    <div class="buttons buttons--centered">
        <div class="info-box"><span>No Hp</span> <?=$hp; ?></div>
        <div class="info-box"><span>Email</span> <?=$email; ?></div>
    </div>
</div>