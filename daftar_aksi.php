<?php
include("koneksi.php");

$nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
$email = mysqli_real_escape_string($koneksi,$_POST['email']);
$password = md5($_POST['password']);

$cek = mysqli_query($koneksi,"SELECT * FROM user WHERE user_email='$email'");
if(mysqli_num_rows($cek) > 0){
	header("Location:daftar.php?alert=duplikat");
}else{
	// daftar user
	$sql = mysqli_query($koneksi,"INSERT INTO user (user_email,user_nama,user_password,user_foto,user_status) VALUES ('$email','$nama','$password','','online')"); 
	header("Location:index.php?alert=registered");
}

?>