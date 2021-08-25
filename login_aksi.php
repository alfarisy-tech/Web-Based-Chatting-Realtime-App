<?php
include "koneksi.php";

$email = $_POST['email'];
$password = md5($_POST['password']);


$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE user_email='$email' AND user_password='$password'"); 

$cek = mysqli_num_rows($sql);

if($cek == 1) { 
	session_start();
	$data = mysqli_fetch_assoc($sql);

	$_SESSION['user_id'] = $data['user_id']; 
	$_SESSION['user_status'] = 'login'; 
	header("Location:user/index.php");
	return;
}else{
	header("location:index.php?alert=gagal");
}

?>