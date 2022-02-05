<?php 
header("Access-Control-Allow-Origin: *");
include('../config/db.php');
// {'username':username, 'password':password}
$username = $_POST['username'];

$qUser = $link -> query("SELECT * FROM tbl_profile_member WHERE username='$username' LIMIT 0,1;");
$fUser = $qUser -> fetch_assoc();

$qProfile = $link -> query("SELECT * FROM tbl_user WHERE username='$username' LIMIT 0,1;");
$fProfile = $qProfile -> fetch_assoc();

$dr = ['namaUser' => $fUser['nama_lengkap'], 'role' => $fProfile['role']];

echo json_encode($dr);

?>