<?php
session_start();
include('../config/db.php');
$username = $_SESSION['userLogin'];

?>
<div class="user-profile mb-20">
    <div class="user-profile__thumb"><img src="https://mobiokit.com/assets/images/photos/image-21.jpg" alt="" title=""></div>
    <div class="user-profile__name">Alexandra Joy</div>
    <div class="buttons buttons--centered">
        <div class="info-box"><span>Followers</span> 25k</div>
        <div class="info-box"><span>Following</span> 9k</div>
    </div>
</div>