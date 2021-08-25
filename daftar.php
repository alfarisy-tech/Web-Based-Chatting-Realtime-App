<?php include 'header.php'; ?>

<div class="container">

	<div class="row">

		<div class="col-12 col-lg-4 mx-auto">
			<center>
				<a href="index.php"><img src="gambar/sistem/logo4.png" style="width:auto; height: 150px;"></a>
			</center>
			<br>
			<center><h5>Daftar</h5></center>

			<?php 
			if(isset($_GET['alert'])){
				if($_GET['alert'] == "duplikat"){
					?>
					<div class="alert alert-danger text-center">
						<span class="font-weight-bold">Email sudah pernah digunakan</span>. 
						<br> 
						<span class="font-weight-light">Silahkan gunakan email lain.</span>
					</div>
					<?php
				}
			}
			?>
			<div class="">

				<form action="daftar_aksi.php" method="post">

					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" name="nama" class="form-control" required='required' autocomplete="off" placeholder="Masukkan nama lengkap ..">
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required='required' autocomplete="off" placeholder="Masukkan email ..">
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required='required' autocomplete="off" placeholder="Masukkan password ..">
					</div>

					<input type="submit" class="btn btn-primary btn-block mt-4" value="DAFTAR">
					<p class="text-center mt-3">
						Sudah punya akun? 
						<br>
						<small><a href="index.php">Login</a></small>
					</p>

				</form>
			</div>
		</div>

	</div>


</div>
<?php include 'footer.php'; ?>