<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$id_saya = $_SESSION['user_id'];

// $teman = mysqli_query($koneksi,"select * from user,chat where user_id!='$id_saya' and (user_id=chat_pengirim or user_id=chat_penerima) order by chat_id desc");
$teman = mysqli_query($koneksi,"select * from user where user_id!='$id_saya'");
while($t = mysqli_fetch_array($teman)){
	?>
	<div class="row teman-list" id="<?php echo $t['user_id']; ?>">
		<div class="col-3 col-sm-3 col-xs-3 teman-avatar">
			<div class="avatar-icon">
				<span class="lingkaran status-<?php echo $t['user_status']; ?>"></span>
				<?php 
				if($t['user_foto'] == ""){
					?>
					<img class="avatar-icon-<?php echo $t['user_status']; ?>" src="../gambar/default/user.png">
					<?php
				}else{
					?>
					<img class="avatar-icon-<?php echo $t['user_status']; ?>" src="../gambar/user/<?php echo $t['user_foto'] ?>">
					<?php
				}
				?>
			</div>
		</div>
		<div class="col-9 col-sm-9 col-xs-9 teman-main">

			<!-- chat terakhir teman dengan user yang sedang login (saya) -->
			<?php 
			$id_user = $t['user_id'];
			$terakhir = mysqli_query($koneksi,"SELECT * FROM chat WHERE (chat_pengirim='$id_saya' AND chat_penerima='$id_user') or (chat_pengirim='$id_user' AND chat_penerima='$id_saya') ORDER BY chat_id DESC LIMIT 1");
			$ter = mysqli_fetch_assoc($terakhir);

			if(mysqli_num_rows($terakhir) > 0){
				?>


				<div class="row">

					<div class="col-sm-9 col-xs-8 teman-data">
						<span class="nama-meta font-weight-bold"><?php echo $t['user_nama'] ?></span>

						<?php 
						$id_lawan = $t['user_id'];
						$cek = mysqli_query($koneksi,"select * from online where online_penerima='$id_saya' and online_pengirim='$id_lawan'");
						$c = mysqli_num_rows($cek);
						if($c > 0){
							?>

							<span class="chat-meta text-muted">Sedang mengetik ..</span>

							<?php
						}else{
							?>

							<?php 
							if($ter['chat_tipe'] == "gambar"){
								?>
								<span class="chat-meta text-muted"><i class="fa fa-camera"></i> Gambar</span>
								<?php
							}elseif($ter['chat_tipe'] == "file"){
								?>
								<span class="chat-meta text-muted"><i class="fa fa-paperclip"></i> File</span>
								<?php
							}else{
								?>
								<span class="chat-meta text-muted"><?php echo htmlspecialchars($ter['chat_isi']) ?></span>
								<?php
							}
							?>

							<?php 
						}
						?>
					</div>
					<div class="col-sm-3 col-xs-4 pull-right teman-time">

						<span class="time-meta pull-right">
							<?php echo date('H:i', strtotime($ter['chat_waktu'])); ?>
							<br>
							<?php 
						// chat yang belum di baca
							$belum_terbaca = mysqli_query($koneksi,"SELECT * FROM chat WHERE chat_status=0 AND chat_pengirim='$id_user' AND chat_penerima='$id_saya'");
							$jumlah_belum_terbaca = mysqli_num_rows($belum_terbaca);
							if($jumlah_belum_terbaca > 0){
								?>

								<div class="badge badge-danger"><?php echo $jumlah_belum_terbaca;?></div>

								<?php
							}
							?>
						</span>
					</div>




				</div>

				<?php 
			}
			?>

		</div>
	</div>	
	<?php 
}
?>
