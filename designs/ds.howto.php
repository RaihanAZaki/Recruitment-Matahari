<?php
	function howto_getdata()
	{
		$qup = querying("SELECT howto_id, howto_desc FROM m_howto ORDER BY howto_id ASC", array());
		$data = sqlGetData($qup);
		return $data;
	}
?>
<div id="content">
<!--
	<div class="col-md-6">
		<div class="col-md-12">
                    	<?php
						$data=howto_getdata();
						for($i=0;$i<count($data);$i++) {
						?>
                            <div><?php echo $data[$i]["howto_desc"];?></div>
                            <div style="height:10px;"></div>
						<?php
						}
						?>
		</div>
	</div>
-->
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label left">1. Buka website recruitment.hypermart.co.id</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide01_.png">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label left">2. Untuk Pendaftaran/ Registrasi, Pilih menu Start Here di sudut kanan atas, kemudian klik pilihan Registration.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide02_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">3. Lengkapi semua kolom bertanda * yang ditampilkan dalam lembar isian Registration Form.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide03_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">4. Setelah melakukan registrasi (melengkapi semua kolom dan menekan tombol REGISTER di bagian akhir form), kami akan mengirimkan activation code ke email yang Anda daftarkan pada proses Registrasi.</label>
		</div>

		<div class="form-group">
			<label class="control-label left">5. Silakan login ke email pribadi Anda (misalnya yahoo, gmail, Hotmail) dan buka email aktivasi dari kami yang berjudul [PT. Matahari Putra Prima] Email Activation.</label>
		</div>

		<div class="form-group">
			<label class="control-label left">6. Silakan klik link Activate my account yang terdapat di dalam email tersebut.</label>
		</div>
		
		<div class="form-group">
			<label class="control-label left">7. Link tersebut akan mengaktivasi akun Anda dan membawa Anda masuk ke HOME website kami kembali.</label>
		</div>

		<div class="form-group">
			<label class="control-label left">8. Jika Anda sudah pernah melakukan registrasi dan telah melakukkan aktivasi, silahkan Anda LOG IN menggunakan email dan password yang sudah Anda buat sebelumnya.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide04_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">9. Jika proses login berhasil, maka Anda akan dibawa ke halaman member sebagai berikut: </label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide05_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">10. Silahkan klik menu Job Vacancy, kemudian akan tampil berbagai macam list posisi yang terbuka.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide06_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">11. Terdapat berbagai macam lowongan yang dibuka, kemudian pilih yang sesuai dengan keinginan Anda.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide07_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">12. Selanjutnya akan terdapat Job Description dan Pendidikan Minimal, selain itu Anda dapat memberikan rekomendasi melalui Referall Person.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide08_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">13. Lengkapi kolom dibawah ini sesuai dengan kriteria.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide09_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">14. Setelah melakukan referall person (melengkapi semua kolom dan menekan tombol SUBMIT di bagian akhir form), kami akan mengirimkan email berupa informasi dan link kepada rekomendasi yang Anda daftarkan pada proses Referall Person.</label>
		</div>
		
		<div class="form-group">
			<label class="control-label left">15. Jika tahap lamaran anda sudah "Offering" silahkan klik alamat email Anda di pojok kanan atas (berwarna merah muda), kemudian klik Personal Data.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide10_.png">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label left">16. Silahkan melakukan pengisian form aplikasi secara on line dimulai dari menu PERSONAL DATA (isilah data diri Anda dengan benar dan lengkap).</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide11_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">17.Lanjutkan dengan melengkapi data Educational Background, Working Experience, Organizational Experiences, Training and Certification, Skills, Language Profieciency, Family Background, Upload Document, dan Questionaire.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide12_.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">18. Questionaire harus Anda lengkapi</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide13_.png">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label left">19. Anda diperbolehkan melamar maksimal 3 posisi. Status lamaran Anda akan muncul di homepage member area Anda (halaman pertama yang muncul ketika Anda berhasil login).</label>
		</div>
		
	</div>
	
</div>