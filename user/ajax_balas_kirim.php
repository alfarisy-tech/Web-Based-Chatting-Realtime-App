<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$id_saya = $_SESSION['user_id'];
$ketik = $_POST['ketik'];
$penerima = $_POST['lawan'];

$pengirim = $id_saya;
$penerima = $penerima;
$isi = mysqli_real_escape_string($koneksi,$ketik);
$waktu = date('Y-m-d H:i:s');
$status = 0;
$tipe = "text";


mysqli_query($koneksi,"INSERT INTO chat (chat_pengirim,chat_penerima,chat_isi,chat_waktu,chat_status,chat_tipe) values('$pengirim','$penerima','$isi','$waktu','$status','$tipe')")or die(mysqli_error($koneksi));
?>
<div class="row">
	<div class="col-12">
		<div class="media pesan-item mb-2 pesan-saya">							
			<div class="media-body">
				<?php echo $isi ?>
				<div class="pesan-waktu"><small><?php echo date('H:i',strtotime($waktu)); ?></small></div>
			</div>
		</div>
	</div>
</div>