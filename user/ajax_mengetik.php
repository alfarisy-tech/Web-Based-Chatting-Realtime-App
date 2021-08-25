<?php
include("../koneksi.php");

session_start();
date_default_timezone_set('Asia/Jakarta');
$user = $_SESSION['user_id'];
$lawan = $_POST['lawan'];

// update online user
$cek = mysqli_query($koneksi,"select * from online where online_pengirim='$user' and online_penerima='$lawan'");
$c = mysqli_num_rows($cek);
if($c == 0){
	mysqli_query($koneksi,"INSERT INTO online (online_pengirim,online_penerima) values('$user','$lawan')")or die(mysqli_error($koneksi));
}

// mysqli_query($koneksi, "update user set user_online='tidak'");
// mysqli_query($koneksi, "update user set user_online='ya' where user_id='$user'");
