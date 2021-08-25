<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$id_saya = $_SESSION['user_id'];
$ketik = $_POST['ketik'];
$k = "%".$ketik."%";

$arr_user = array();

// $teman = mysqli_query($koneksi,"select * from user,chat where user_id!='$id_saya' and (user_id=chat_pengirim or user_id=chat_penerima) and (chat_isi like '$k' or user_nama like '$k') order by chat_id desc");
$teman = mysqli_query($koneksi,"select * from user,chat where user_id!='$id_saya' and (user_id=chat_pengirim or user_id=chat_penerima) and chat_isi like '$k' order by chat_id desc");
if(mysqli_num_rows($teman) > 0){
	while($t = mysqli_fetch_array($teman)){



		if(!in_array($t['user_id'], $arr_user)){
			?>
			<div class="row teman-list" id="<?php echo $t['user_id']; ?>">
				<div class="col-sm-3 col-xs-3 teman-avatar">
					<div class="avatar-icon">
						<span class="lingkaran"></span>
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
				<div class="col-sm-9 col-xs-9 teman-main">

					<?php 
					$id_user = $t['user_id'];
					?>
					<div class="row">
						<div class="col-sm-9 col-xs-8 teman-data">
							<span class="nama-meta font-weight-bold"><?php echo $t['user_nama'] ?></span>
							<?php 
							if($t['chat_tipe'] == "gambar"){
								?>
								<span class="chat-meta text-muted"><i class="fa fa-camera"></i> Gambar</span>
								<?php
							}elseif($t['chat_tipe'] == "file"){
								?>
								<span class="chat-meta text-muted"><i class="fa fa-paperclip"></i> File</span>
								<?php
							}else{
								?>
								<span class="chat-meta text-muted"><?php echo str_replace($ketik, "<b>".$ketik."</b>", $t['chat_isi']) ?></span>
								<?php
							}
							?>
						</div>
						<div class="col-sm-3 col-xs-4 pull-right teman-time">

							<span class="time-meta pull-right">
								<?php echo date('H:i', strtotime($t['chat_waktu'])); ?>
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

				</div>
			</div>	
			<?php 
			array_push($arr_user, $t['user_id']);
		}

	}
}else{

	$teman = mysqli_query($koneksi,"select * from user where user_id!='$id_saya' and user_nama like '$k'");
	while($t = mysqli_fetch_array($teman)){


		if(!in_array($t['user_id'], $arr_user)){
			?>
			<div class="row teman-list" id="<?php echo $t['user_id']; ?>">
				<div class="col-sm-3 col-xs-3 teman-avatar">
					<div class="avatar-icon">
						<span class="lingkaran"></span>
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
				<div class="col-sm-9 col-xs-9 teman-main">

					<?php 
					$id_user = $t['user_id'];
					?>
					<div class="row">
						<div class="col-sm-9 col-xs-8 teman-data">
							<span class="nama-meta font-weight-bold"><?php echo $t['user_nama'] ?></span>
						</div>
						<div class="col-sm-3 col-xs-4 pull-right teman-time">


						</div>
					</div>

				</div>
			</div>	
			<?php 
			array_push($arr_user, $t['user_id']);
		}
	}

}
?>
