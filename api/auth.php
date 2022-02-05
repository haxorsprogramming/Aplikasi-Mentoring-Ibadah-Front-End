<?php 
header("Access-Control-Allow-Origin: *");
include('../config/db.php');
// {'username':username, 'password':password}
$username = $_POST['username'];
$password = $_POST['password'];

$qCekUser = $link -> query("SELECT id FROM tbl_user WHERE username='$username';");
$tUser = mysqli_num_rows($qCekUser);

if($tUser < 1){
    $status = "NO_USER";
}else{
    $qUser = $link -> query("SELECT * FROM tbl_user WHERE username='$username' LIMIT 0,1;");
    $fUser = $qUser -> fetch_assoc();
    $passwordDB = $fUser['password'];
    $cekPw = password_verify($password, $passwordDB);
    if($cekPw == true){
        $status = "ACCES_GRANTED";
    }else{
        $status = "WRONG_PASSWORD";
    }
}

$dr = ['status' => $status];
echo json_encode($dr);

?>