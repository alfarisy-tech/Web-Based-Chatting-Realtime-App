<?php
include("../koneksi.php");

session_start();

$user = $_SESSION['user_id'];

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = md5($_POST['password']);

mysqli_query($koneksi, "update user set user_nama='$nama', user_email='$email' where user_id='$user'");

// update password jika diganti
if($_POST['password'] != ""){
	mysqli_query($koneksi, "update user set user_password='$password' where user_id='$user'");
}

// update foto jika diganti
// upload foto
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename_foto = $_FILES['foto']['name'];
$ext = pathinfo($filename_foto, PATHINFO_EXTENSION);

if($filename_foto!=""){
	if(in_array($ext,$allowed) ) {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/'.$rand.'_'.$filename_foto);
		$x = $rand.'_'.$filename_foto;

		mysqli_query($koneksi,"UPDATE user SET user_foto='$x' WHERE user_id='$user'"); 
		
	}
}


header("Location:index.php");

?>