<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/sapateman.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/popper.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>

	<title>SapaTeman - Aplikasi Chatting</title>

</head>
<body>
	<?php 
	date_default_timezone_set('Asia/Jakarta');
	include "../koneksi.php";
	session_start();
	if($_SESSION['user_status'] != "login"){
		session_destroy();
		header("location:../index.php?alert=login-dulu");
	}
	$id_user = $_SESSION['user_id'];
	$s = mysqli_query($koneksi,"select * from user where user_id='$id_user'");
	$saya = mysqli_fetch_assoc($s);
	?>
	<div class="container-fluid p-0">
		
		<div class="row kotak">

			<div class="col-12 col-md-3 kotak-kiri d-none d-sm-none d-md-block">

				<div class="kotak-kiri-sidebar">

					<nav class="navbar navbar-expand-lg navbar-light bg-light">

						<div class="dropdown">
							<div class="avatar-saya avatar-saya-<?php echo $saya['user_status']; ?>" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="tre" aria-expanded="flse">
								<?php 
								if($saya['user_foto'] == ""){
									?>
									<img src="../gambar/default/user.png">
									<?php
								}else{
									?>
									<img src="../gambar/user/<?php echo $saya['user_foto'] ?>">
									<?php
								}
								?>
							</div>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item pilih-status" id="online"><span class="status status-online mr-2"></span> Online</a>
								<a class="dropdown-item pilih-status" id="diluar"><span class="status status-diluar mr-2"></span> Di luar</a>
								<a class="dropdown-item pilih-status" id="sibuk"><span class="status status-sibuk mr-2"></span> Sibuk</a>
								<a class="dropdown-item pilih-status" id="offline"><span class="status status-offline mr-2"></span> Offline</a>
							</div>
						</div>

						<div class="dropdown ml-auto">
							<div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="tre" aria-expanded="flse">
								<i class="fa fa-cog"></i>
							</div>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#staticBackdrop">Profile</a>
								<a class="dropdown-item" href="logout.php">Keluar</a>
							</div>
						</div>

					</nav>


					<div class="pencarian">
						<div class="pencarian-inner">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
								</div>
								<input type="text" class="form-control ketik-pencarian" placeholder="Masukkan Pencarian .." aria-label="Masukkan Pencarian .." aria-describedby="basic-addon1">
							</div>
						</div>
					</div>

					<div class="teman"></div>
				</div>

			</div>


			<!-- sidebar mobile -->
			<div class="col-12 col-md-3 kotak-kiri kotak-kiri-mobile d-none d-md-none">
				<div class="kotak-kiri-sidebar">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<div class="dropdown">
							<div class="avatar-saya avatar-saya-<?php echo $saya['user_status']; ?>" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="tre" aria-expanded="flse">
								<?php 
								if($saya['user_foto'] == ""){
									?>
									<img src="../gambar/default/user.png">
									<?php
								}else{
									?>
									<img src="../gambar/user/<?php echo $saya['user_foto'] ?>">
									<?php
								}
								?>
							</div>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item pilih-status" id="online"><span class="status status-online mr-2"></span> Online</a>
								<a class="dropdown-item pilih-status" id="diluar"><span class="status status-diluar mr-2"></span> Di luar</a>
								<a class="dropdown-item pilih-status" id="sibuk"><span class="status status-sibuk mr-2"></span> Sibuk</a>
								<a class="dropdown-item pilih-status" id="offline"><span class="status status-offline mr-2"></span> Offline</a>
							</div>
						</div>
						<div class="dropdown ml-auto">
							<div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="tre" aria-expanded="flse">
								<i class="fa fa-cog"></i>
							</div>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#staticBackdrop">Profile</a>
								<a class="dropdown-item" href="logout.php">Keluar</a>
							</div>
						</div>
						<div class="dropdown float-right ml-4">
							<button class="btn btn-secondary float-right tombol-sembunyi-user-mobile"><i class="fa fa-envelope"></i></button>
						</div>
					</nav>
					<div class="pencarian">
						<div class="pencarian-inner">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
								</div>
								<input type="text" class="form-control ketik-pencarian" placeholder="Masukkan Pencarian .." aria-label="Masukkan Pencarian .." aria-describedby="basic-addon1">
							</div>
						</div>
					</div>
					<div class="teman"></div>
				</div>
			</div>
			<!-- end sidebar mobile -->


			<div class="col-md-9 col-12 conversation">

				<nav class="navbar navbar-expand-lg navbar-light bg-light" style="min-height: 70px">

					<div class="dropdown">
						<div class="lawan" href="#">

						</div>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item pilih-status" id="online"><span class="status status-online mr-2"></span> Online</a>
							<a class="dropdown-item pilih-status" id="diluar"><span class="status status-diluar mr-2"></span> Di luar</a>
							<a class="dropdown-item pilih-status" id="sibuk"><span class="status status-sibuk mr-2"></span> Sibuk</a>
							<a class="dropdown-item pilih-status" id="offline"><span class="status status-offline mr-2"></span> Offline</a>
						</div>
					</div>

					<div class="dropdown float-right ml-4 d-block d-md-none">
						<button class="btn btn-secondary float-right tombol-tampil-user-mobile"><i class="fa fa-users"></i></button>
					</div>

				</nav>


				<div class="pesan" id="conversation">



				</div>

				<div class="row balas py-2 d-none">

					<div class="col-sm-2 col-2">
						<div class="upload-btn-main">
							<div class="upload-btn-wrapper">
								<button class="upload-btn p-2"><i class="fa fa-camera"></i></button>
								<form action="" method="POST" enctype="multipart/form-data">
									<input class="upload_gambar" id="upload_gambar" type="file" name="upload_gambar" accept="image/*"/>
								</form>
							</div>

							<div class="upload-btn-wrapper">
								<button class="upload-btn p-2"><i class="fa fa-paperclip"></i></button>
								<form action="" method="POST" enctype="multipart/form-data">
									<input class="upload_file" id="upload_file" type="file" name="upload_file"/>
								</form>
							</div>
						</div>
					</div>

					<div class="col-sm-8 col-6">
						<textarea class="form-control" id="balas-ketik" placeholder="Ketik pesan .."></textarea>
					</div>

					<div class="col-sm-2 col-4">
						<span class="dropdown dropdown-emoji">
							<button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								&#128522;
							</button>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<span class='pilih-emot' id="&#128512;">&#128512;</span>
								<span class='pilih-emot' id="&#128513;">&#128513;</span>
								<span class='pilih-emot' id="&#128514;">&#128514;</span>
								<span class='pilih-emot' id="&#128515;">&#128515;</span>
								<span class='pilih-emot' id="&#128516;">&#128516;</span>
								<span class='pilih-emot' id="&#128517;">&#128517;</span>
								<span class='pilih-emot' id="&#128518;">&#128518;</span>
								<span class='pilih-emot' id="&#128519;">&#128519;</span>
								<span class='pilih-emot' id="&#128520;">&#128520;</span>
								<span class='pilih-emot' id="&#128521;">&#128521;</span>
								<span class='pilih-emot' id="&#128522;">&#128522;</span>
								<span class='pilih-emot' id="&#128523;">&#128523;</span>
								<span class='pilih-emot' id="&#128524;">&#128524;</span>
								<span class='pilih-emot' id="&#128525;">&#128525;</span>
								<span class='pilih-emot' id="&#128526;">&#128526;</span>
								<span class='pilih-emot' id="&#128527;">&#128527;</span>
								<span class='pilih-emot' id="&#128528;">&#128528;</span>
								<span class='pilih-emot' id="&#128529;">&#128529;</span>
								<span class='pilih-emot' id="&#128530;">&#128530;</span>
								<span class='pilih-emot' id="&#128531;">&#128531;</span>
								<span class='pilih-emot' id="&#128532;">&#128532;</span>
								<span class='pilih-emot' id="&#128533;">&#128533;</span>
								<span class='pilih-emot' id="&#128534;">&#128534;</span>
								<span class='pilih-emot' id="&#128535;">&#128535;</span>
								<span class='pilih-emot' id="&#128536;">&#128536;</span>
								<span class='pilih-emot' id="&#128537;">&#128537;</span>
								<span class='pilih-emot' id="&#128538;">&#128538;</span>
								<span class='pilih-emot' id="&#128539;">&#128539;</span>
								<span class='pilih-emot' id="&#128540;">&#128540;</span>
								<span class='pilih-emot' id="&#128541;">&#128541;</span>
								<span class='pilih-emot' id="&#128542;">&#128542;</span>
								<span class='pilih-emot' id="&#128543;">&#128543;</span>
								<span class='pilih-emot' id="&#128544;">&#128544;</span>
								<span class='pilih-emot' id="&#128545;">&#128545;</span>
								<span class='pilih-emot' id="&#128546;">&#128546;</span>
								<span class='pilih-emot' id="&#128547;">&#128547;</span>
								<span class='pilih-emot' id="&#128548;">&#128548;</span>
								<span class='pilih-emot' id="&#128549;">&#128549;</span>
								<span class='pilih-emot' id="&#128550;">&#128550;</span>
								<span class='pilih-emot' id="&#128551;">&#128551;</span>
								<span class='pilih-emot' id="&#128552;">&#128552;</span>
								<span class='pilih-emot' id="&#128553;">&#128553;</span>
								<span class='pilih-emot' id="&#128554;">&#128554;</span>
								<span class='pilih-emot' id="&#128555;">&#128555;</span>
								<span class='pilih-emot' id="&#128556;">&#128556;</span>
								<span class='pilih-emot' id="&#128557;">&#128557;</span>
								<span class='pilih-emot' id="&#128558;">&#128558;</span>
								<span class='pilih-emot' id="&#128559;">&#128559;</span>
								<span class='pilih-emot' id="&#128560;">&#128560;</span>
								<span class='pilih-emot' id="&#128561;">&#128561;</span>
								<span class='pilih-emot' id="&#128562;">&#128562;</span>
								<span class='pilih-emot' id="&#128563;">&#128563;</span>
								<span class='pilih-emot' id="&#128564;">&#128564;</span>
								<span class='pilih-emot' id="&#128565;">&#128565;</span>
								<span class='pilih-emot' id="&#128566;">&#128566;</span>
								<span class='pilih-emot' id="&#128567;">&#128567;</span>
								<span class='pilih-emot' id="&#128577;">&#128577;</span>
								<span class='pilih-emot' id="&#128578;">&#128578;</span>
								<span class='pilih-emot' id="&#128579;">&#128579;</span>
								<span class='pilih-emot' id="&#128580;">&#128580;</span>
								<span class='pilih-emot' id="&#129296;">&#129296;</span>
								<span class='pilih-emot' id="&#129297;">&#129297;</span>
								<span class='pilih-emot' id="&#129298;">&#129298;</span>
								<span class='pilih-emot' id="&#129299;">&#129299;</span>
								<span class='pilih-emot' id="&#129300;">&#129300;</span>
								<span class='pilih-emot' id="&#129301;">&#129301;</span>
								<span class='pilih-emot' id="&#129312;">&#129312;</span>
								<span class='pilih-emot' id="&#129313;">&#129313;</span>
								<span class='pilih-emot' id="&#129314;">&#129314;</span>
								<span class='pilih-emot' id="&#129315;">&#129315;</span>
								<span class='pilih-emot' id="&#129316;">&#129316;</span>
								<span class='pilih-emot' id="&#129317;">&#129317;</span>
								<span class='pilih-emot' id="&#129319;">&#129319;</span>
								<span class='pilih-emot' id="&#129320;">&#129320;</span>
								<span class='pilih-emot' id="&#129321;">&#129321;</span>
								<span class='pilih-emot' id="&#129322;">&#129322;</span>
								<span class='pilih-emot' id="&#129323;">&#129323;</span>
								<span class='pilih-emot' id="&#129324;">&#129324;</span>
								<span class='pilih-emot' id="&#129325;">&#129325;</span>
								<span class='pilih-emot' id="&#129326;">&#129326;</span>
								<span class='pilih-emot' id="&#129327;">&#129327;</span>
								<span class='pilih-emot' id="&#129488;">&#129488;</span>
							</div>
						</span>
						<button class="btn btn-primary p-2 balas-kirim"><i class="fa fa-send"></i></button>
					</div>

				</div>


			</div>

		</div>

	</div>

	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="profil_update.php" method="post" enctype="multipart/form-data">
					<div class="modal-header">
						<h6 class="modal-title" id="staticBackdropLabel">Edit profil</h6>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label class="col-lg-2">Nama</label>
							<div class="col-lg-10" >
								<input type="text" name="nama" class="form-control" value="<?php echo $saya['user_nama']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2">Email</label>
							<div class="col-lg-10" >
								<input type="text" name="email" class="form-control" value="<?php echo $saya['user_email']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2">Password</label>
							<div class="col-lg-10" >
								<input type="text" name="password" class="form-control">
								<small class="text-muted font-italic">Kosongkan jika tidak ingin mengganti password.</small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2">Foto</label>
							<div class="col-lg-10" >
								<input type="file" name="foto">
								<div><small class="text-muted font-italic">Kosongkan jika tidak ingin mengganti foto profil.</small></div>
							</div>
						</div>
						<div class="text-right mt-5 mb-3">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<?php include 'ajax.php'; ?>

</body>
</html>