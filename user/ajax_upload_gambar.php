<?php
include("../koneksi.php");

session_start();
date_default_timezone_set('Asia/Jakarta');

// update upload_gambar jika diganti
// upload upload_gambar
$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');
$filename_upload_gambar = $_FILES['upload_gambar']['name'];
$ext = pathinfo($filename_upload_gambar, PATHINFO_EXTENSION);

if($filename_upload_gambar!=""){
	if(in_array($ext,$allowed) ) {
		$x = $rand.'.'.$ext;
		move_uploaded_file($_FILES['upload_gambar']['tmp_name'], '../gambar/chat/'.$x);

		$pengirim = $_SESSION['user_id'];
		$penerima = $_POST['lawan'];
		// $isi = "Asd";
		$isi = "<img class=\'pesan-gambar\' src=\'../gambar/chat/".$x."\'>";
		$waktu = date('Y-m-d H:i:s');
		$status = 0;
		$tipe = "gambar";

		mysqli_query($koneksi,"INSERT INTO chat (chat_pengirim,chat_penerima,chat_isi,chat_waktu,chat_status,chat_tipe) values('$pengirim','$penerima','$isi','$waktu','$status','$tipe')")or die(mysqli_error($koneksi));

	}
}
echo "oke";
?>