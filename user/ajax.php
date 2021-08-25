<script type="text/javascript">


	$(document).ready(function(){

		// ubah status
		$("body").on("click",".pilih-status",function(){
			var status = $(this).attr('id');
			var data = "&status="+status;
			$.ajax({
				type: 'POST',
				url: "ajax_status_pilih.php",
				data: data,
				success: function(html) {
					if(status == "online"){
						$(".avatar-saya").removeClass().addClass("avatar-saya avatar-saya-online");
					}else if(status == "diluar"){
						$(".avatar-saya").removeClass().addClass("avatar-saya avatar-saya-diluar");
					}else if(status == "sibuk"){
						$(".avatar-saya").removeClass().addClass("avatar-saya avatar-saya-sibuk");
					}else if(status == "offline"){
						$(".avatar-saya").removeClass().addClass("avatar-saya avatar-saya-offline");

					}
				}
			});
		});

		//tampilkan list teman
		$("body").on("click",".teman-list",function(){
			var id_user = $(this).attr('id');
			var data = "&id="+id_user;
			$.ajax({
				type: 'POST',
				url: "ajax_chat_tampil.php",
				data: data,
				success: function(html) {
					$(".pesan").html(html);
					$(".avatar-lawan").attr("id",id_user);
					var x = $(".pesan").height()+221000000000;
					$(".pesan").scrollTop(x);
					$("#balas-ketik").val("");
					$(".kotak-kiri-mobile").removeClass("d-block");
				}
			});

			$.ajax({
				type: 'POST',
				url: "ajax_lawan_tampil.php",
				data: data,
				success: function(html2) {
					$(".lawan").html(html2);
					$(".balas").removeClass('d-none')
				}
			});

		});

		// klik tombol kirim
		$("body").on("click",".balas-kirim",function(){
			var ketik = $("#balas-ketik").val();
			if(ketik.length > 0){
				var lawan = $(".avatar-lawan").attr('id');
				var data = "ketik="+ketik+"&lawan="+lawan;
				$.ajax({
					type: 'POST',
					url: "ajax_balas_kirim.php",
					data: data,
					success: function(html) {
						$("#balas-ketik").val("");
						$(".pesan").append(html);
						var x = $(".pesan").height()+221000;
						$(".pesan").scrollTop(x);
					}
				});
			}

		});

		// saat tekan enter di form balas chat
		$("#balas-ketik" ).on( "keydown", function(event) {
			if(event.which == 13){ 
				var ketik = $("#balas-ketik").val();
				if(ketik.length > 0){
					var lawan = $(".avatar-lawan").attr('id');
					var data = "ketik="+ketik+"&lawan="+lawan;
					$.ajax({
						type: 'POST',
						url: "ajax_balas_kirim.php",
						data: data,
						success: function(html) {
							$("#balas-ketik").val("");
							$(".pesan").append(html);
							var x = $(".pesan").height()+221000;
							$(".pesan").scrollTop(x);
							// console.log(html);
						}
					});
				}
			}
		});


		// upload gambar
		$("body").on("change",".upload_gambar",function(){
			var fd = new FormData();
			var lawan = $(".avatar-lawan").attr('id');
			fd.append('lawan',lawan);
			var files = $('#upload_gambar')[0].files[0];
			fd.append('upload_gambar',files);

			$.ajax({
				url: 'ajax_upload_gambar.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					// console.log(response);
					if(response != 0){
						var x = $(".pesan").height()+221000;
						$(".pesan").scrollTop(x);
					}else{
						alert('file not uploaded');
					}
					$(".upload_gambar").val('');
				}
			});

		});

		// upload file
		$("body").on("change",".upload_file",function(){
			var fd = new FormData();
			var lawan = $(".avatar-lawan").attr('id');
			fd.append('lawan',lawan);
			var files = $('#upload_file')[0].files[0];
			fd.append('upload_file',files);

			$.ajax({
				url: 'ajax_upload_file.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					if(response == "php"){
						alert("file dilarang!");
					}else{
						var x = $(".pesan").height()+221000;
						$(".pesan").scrollTop(x);
					}
					$(".upload_file").val('');
				}
			});

		});


		// saat pencarian
		$("body").on("keyup",".ketik-pencarian",function(){
			var ketik = $(this).val();
			if(ketik.length > 0){
				// alert(ketik);
				// var lawan = $(".avatar-lawan").attr('id');
				var data = "ketik="+ketik;
				$.ajax({
					type: 'POST',
					url: "ajax_pencarian.php",
					data: data,
					success: function(html3) {
						$(".teman").html(html3);
					}
				});
			}

		});

		// responsive - tampilkan tombol user pada halaman smartphone
		$("body").on("click",".tombol-tampil-user-mobile",function(){
			$(".kotak-kiri-mobile").addClass("d-block");
		});

		// responsive - sembunyikan tombol user pada halaman smartphone
		$("body").on("click",".tombol-sembunyi-user-mobile",function(){
			$(".kotak-kiri-mobile").removeClass("d-block");
		});

		// status sedang mengetik untuk lawan pada saat mengetik
		$("body").on("keyup","#balas-ketik",function(){
			var ketik = $(this).val();
			if(ketik.length > 0){

				var lawan = $(".avatar-lawan").attr('id');
				var data = "lawan="+lawan;

				$.ajax({
					type: 'POST',
					url: "ajax_mengetik.php",
					data: data,
					success: function(html) {
					
					}
				});

			}

		});


		// pilih emot
		$("body").on("click",".pilih-emot",function(){
			var $txt = $("#balas-ketik");
			var caretPos = $txt[0].selectionStart;
			var textAreaTxt = $txt.val();
			var txtToAdd = $(this).attr('id');
			$txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
		});


		// set interval berjalan setiap detik
		setInterval(function(){ 

			// reload chat
			var x = $(".avatar-lawan").attr("id");
			if(x != 0){
				var lawan = $(".avatar-lawan").attr('id');
				var data = "&id="+lawan;
				$.ajax({
					type: 'POST',
					url: "ajax_chat_tampil.php",
					data: data,
					success: function(html) {
						var isi = $(".pesan").html();
						if(isi != html){
							// var x = $(".pesan").height()+221000;
							// $(".pesan").scrollTop(x);
							$(".pesan").html(html);

						}
					}
				});
			}

			// update list teman saat pencarian
			var xx = "";
			var data2 = "&id="+xx;
			var ketik_pencarian = $(".ketik-pencarian").val();
			if(ketik_pencarian.length == 0){
				$.ajax({
					type: 'POST',
					url: "ajax_teman_tampil.php",
					data: data2,
					success: function(html2) {
						$(".teman").html(html2);
					}
				});
			}


			// cek jika tidak sedang mengetik
			var mengetik = $("#balas-ketik").val();
			if(mengetik.length == 0){

				var lawan = "";
				var data = "lawan="+lawan;

				$.ajax({
					type: 'POST',
					url: "ajax_mengetik_tidak.php",
					data: data,
					success: function(html) {
						// $("#balas-ketik").val("");
						// $(".pesan").append(html);
						// var x = $(".pesan").height()+221000;
						// $(".pesan").scrollTop(x);
					}
				});
				
			}


		}, 500);

	});
</script>