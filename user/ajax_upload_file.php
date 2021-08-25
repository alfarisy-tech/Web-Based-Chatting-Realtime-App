<?php
include("../koneksi.php");

session_start();
date_default_timezone_set('Asia/Jakarta');

// update upload_file jika diganti
// upload upload_file
$rand = rand();
$filename_upload_file = $_FILES['upload_file']['name'];
$ext = pathinfo($filename_upload_file, PATHINFO_EXTENSION);

if($filename_upload_file!=""){
	if($ext != "php"){
		$x = $rand.'.'.$ext;
		move_uploaded_file($_FILES['upload_file']['tmp_name'], '../gambar/file/'.$x);

		$pengirim = $_SESSION['user_id'];
		$penerima = $_POST['lawan'];
		// $isi = "Asd";
		$isi = $x;
		$waktu = date('Y-m-d H:i:s');
		$status = 0;
		$tipe = "file";

		mysqli_query($koneksi,"INSERT INTO chat (chat_pengirim,chat_penerima,chat_isi,chat_waktu,chat_status,chat_tipe) values('$pengirim','$penerima','$isi','$waktu','$status','$tipe')")or die(mysqli_error($koneksi));

	}else{
		echo "php";
	}
}

?>