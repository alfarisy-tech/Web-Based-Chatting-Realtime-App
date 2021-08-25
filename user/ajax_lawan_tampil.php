<?php 
include '../koneksi.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$id_saya = $_SESSION['user_id'];
$id_user = $_POST['id'];

$lawan = mysqli_query($koneksi,"SELECT * FROM user WHERE user_id='$id_user'");
$l = mysqli_fetch_assoc($lawan);
?>
<div class="avatar-lawan" id="<?php echo $l['user_id'] ?>" data-toggle="modal" data-target="#modal_foto_lawan_<?php echo $l['user_id'] ?>">
	<?php 
	if($l['user_foto'] == ""){
		?>
		<img class="avatar-icon" src="../gambar/default/user.png">
		<?php
	}else{
		?>
		<img class="avatar-icon" src="../gambar/user/<?php echo $l['user_foto'] ?>">
		<?php
	}
	?>
	<span class="ml-2 mt-5"><?php echo $l['user_nama']; ?></span>

</div>


<!-- modal foto lawan -->
<div class="modal fade" id="modal_foto_lawan_<?php echo $l['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal_foto_lawan_<?php echo $l['user_id'] ?>Label" aria-hidden="true"  data-backdrop="false">
	<div class="modal-dialog modal-l" role="document">
		<div class="modal-content">
			<div class="modal-header p-2">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-bdy">
				<?php 
				if($l['user_foto'] == ""){
					?>
					<img style="width: 100%;height: auto;" src="../gambar/default/user.png">
					<?php
				}else{
					?>
					<img style="width: 100%;height: auto;" src="../gambar/user/<?php echo $l['user_foto'] ?>">
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>