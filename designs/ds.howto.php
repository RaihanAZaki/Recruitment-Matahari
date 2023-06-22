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
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_01.png">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label left">2. Untuk Pendaftaran/ Registrasi, Pilih menu Start Here di sudut kanan atas, kemudian klik pilihan Registration.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_02.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">3. Lengkapi semua kolom bertanda * yang ditampilkan dalam lembar isian Registration Form.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_03.png">
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
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_04.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">9. Jika proses login berhasil, maka Anda akan dibawa ke halaman member sebagai berikut: </label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_05.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">10. Silahkan klik alamat email Anda di pojok kanan atas (berwarna merah muda), kemudian klik Personal Data</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_06.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">11. Silahkan melakukan pengisian form aplikasi secara on line dimulai dari menu PERSONAL DATA (isilah data diri Anda dengan benar dan lengkap).</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_07.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">12. Lanjutkan dengan melengkapi data Educational Background, Working Experience, Organizational Experiences, Training and Certification, Skills, Language Profieciency, Family Background, Upload Document, dan Questionaire.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_08.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">13. Questionaire harus Anda lengkapi</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_09.png">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label left">14. Jika semua data telah Anda isi dengan lengkap, Anda dapat mulai melamar posisi yang Anda inginkan melalui menu Job Vacancy yang terdapat pada menubar bagian atas. Akan muncul daftar lowongan pekerjaan yang ditawarkan.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_10.png">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label left">15. Klik salah satu posisi yang Anda inginkan untuk melihat detail dari lowongan tersebut. Kemudian Klik tombol "Apply for This Position" untuk melamar posisi tersebut.</label>
			<div class="left">
				<img src="<?php echo _IMAGEWEBPATH;?>/guide_11.png">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label left">16. Anda diperbolehkan melamar maksimal 3 posisi. Status lamaran Anda akan muncul di homepage member area Anda (halaman pertama yang muncul ketika Anda berhasil login).</label>
		</div>
		
	</div>
	
</div>