<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

/* candidate_id, log_auth_id, candidate_name, candidate_email, candidate_gender, candidate_religion, candidate_birthplace, candidate_birthdate, 
candidate_race, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_bodyheight, candidate_bodyweight, 
candidate_bloodtype, candidate_sim_a, candidate_sim_c, candidate_npwp, candidate_marital, candidate_p_address, candidate_p_city, candidate_p_postcode, 
candidate_c_address, candidate_c_city, candidate_c_postcode, candidate_hp1, candidate_hp2, candidate_phone, candidate_cp_name1, candidate_cp_relation1, 
candidate_cp_phone1, candidate_cp_name2, candidate_cp_relation2, candidate_cp_phone2, candidate_ref_name, candidate_ref_division, 
candidate_ref_position, candidate_expected_salary, candidate_hobby
*/
//echo $_SESSION["log_auth_id"];
$dataresume=getDataResume();
//print_r($dataresume);

//print_r($_SESSION);
//exit;


$datapplication = getDataApply();


$data=array();
$data["candidate_birthplace"]=(isset($_SESSION["session"]["candidate_birthplace"]) && $_SESSION["session"]["candidate_birthplace"]<>"")?$_SESSION["session"]["candidate_birthplace"]:$dataresume[0]["candidate_birthplace"];
		$data["candidate_religion"]=(isset($_SESSION["session"]["candidate_religion"]) && $_SESSION["session"]["candidate_religion"]<>"")?$_SESSION["session"]["candidate_religion"]:$dataresume[0]["candidate_religion"];
		$data["candidate_race"]=(isset($_SESSION["session"]["candidate_race"]) && $_SESSION["session"]["candidate_race"]<>"")?$_SESSION["session"]["candidate_race"]:$dataresume[0]["candidate_race"];

		$data["candidate_bodyheight"]=(isset($_SESSION["session"]["candidate_bodyheight"]) && $_SESSION["session"]["candidate_bodyheight"]<>"")?$_SESSION["session"]["candidate_bodyheight"]:$dataresume[0]["candidate_bodyheight"];
		$data["candidate_bodyweight"]=(isset($_SESSION["session"]["candidate_bodyweight"]) && $_SESSION["session"]["candidate_bodyweight"]<>"")?$_SESSION["session"]["candidate_bodyweight"]:$dataresume[0]["candidate_bodyweight"];

		$data["candidate_bloodtype"]=(isset($_SESSION["session"]["candidate_bloodtype"]) && $_SESSION["session"]["candidate_bloodtype"]<>"")?$_SESSION["session"]["candidate_bloodtype"]:$dataresume[0]["candidate_bloodtype"];
		$data["candidate_sim_a"]=(isset($_SESSION["session"]["candidate_sim_a"]) && $_SESSION["session"]["candidate_sim_a"]<>"")?$_SESSION["session"]["candidate_sim_a"]:$dataresume[0]["candidate_sim_a"];
		$data["candidate_sim_c"]=(isset($_SESSION["session"]["candidate_sim_c"]) && $_SESSION["session"]["candidate_sim_c"]<>"")?$_SESSION["session"]["candidate_sim_c"]:$dataresume[0]["candidate_sim_c"];
		$data["candidate_npwp"]=(isset($_SESSION["session"]["candidate_npwp"]) && $_SESSION["session"]["candidate_npwp"]<>"")?$_SESSION["session"]["candidate_npwp"]:$dataresume[0]["candidate_npwp"];
		$data["candidate_marital"]=(isset($_SESSION["session"]["candidate_marital"]) && $_SESSION["session"]["candidate_marital"]<>"")?$_SESSION["session"]["candidate_marital"]:$dataresume[0]["candidate_marital"];
		$data["candidate_p_address"]=(isset($_SESSION["session"]["candidate_p_address"]) && $_SESSION["session"]["candidate_p_address"]<>"")?$_SESSION["session"]["candidate_p_address"]:$dataresume[0]["candidate_p_address"];
		$data["candidate_p_city"]=(isset($_SESSION["session"]["candidate_p_city"]) && $_SESSION["session"]["candidate_p_city"]<>"")?$_SESSION["session"]["candidate_p_city"]:$dataresume[0]["candidate_p_city"];
		$data["candidate_p_postcode"]=(isset($_SESSION["session"]["candidate_p_postcode"]) && $_SESSION["session"]["candidate_p_postcode"]<>"")?$_SESSION["session"]["candidate_p_postcode"]:$dataresume[0]["candidate_p_postcode"];
		$data["candidate_c_address"]=(isset($_SESSION["session"]["candidate_c_address"]) && $_SESSION["session"]["candidate_c_address"]<>"")?$_SESSION["session"]["candidate_c_address"]:$dataresume[0]["candidate_c_address"];
		$data["candidate_c_city"]=(isset($_SESSION["session"]["candidate_c_city"]) && $_SESSION["session"]["candidate_c_city"]<>"")?$_SESSION["session"]["candidate_c_city"]:$dataresume[0]["candidate_c_city"];
		$data["candidate_c_postcode"]=(isset($_SESSION["session"]["candidate_c_postcode"]) && $_SESSION["session"]["candidate_c_postcode"]<>"")?$_SESSION["session"]["candidate_c_postcode"]:$dataresume[0]["candidate_c_postcode"];
		$data["candidate_hp2"]=(isset($_SESSION["session"]["candidate_hp2"]) && $_SESSION["session"]["candidate_hp2"]<>"")?$_SESSION["session"]["candidate_hp2"]:$dataresume[0]["candidate_hp2"];
		$data["candidate_phone"]=(isset($_SESSION["session"]["candidate_phone"]) && $_SESSION["session"]["candidate_phone"]<>"")?$_SESSION["session"]["candidate_phone"]:$dataresume[0]["candidate_phone"];
		$data["candidate_cp_name1"]=(isset($_SESSION["session"]["candidate_cp_name1"]) && $_SESSION["session"]["candidate_cp_name1"]<>"")?$_SESSION["session"]["candidate_cp_name1"]:$dataresume[0]["candidate_cp_name1"];
		$data["candidate_cp_relation1"]=(isset($_SESSION["session"]["candidate_cp_relation1"]) && $_SESSION["session"]["candidate_cp_relation1"]<>"")?$_SESSION["session"]["candidate_cp_relation1"]:$dataresume[0]["candidate_cp_relation1"];
		$data["candidate_cp_phone1"]=(isset($_SESSION["session"]["candidate_cp_phone1"]) && $_SESSION["session"]["candidate_cp_phone1"]<>"")?$_SESSION["session"]["candidate_cp_phone1"]:$dataresume[0]["candidate_cp_phone1"];
		$data["candidate_cp_name2"]=(isset($_SESSION["session"]["candidate_cp_name2"]) && $_SESSION["session"]["candidate_cp_name2"]<>"")?$_SESSION["session"]["candidate_cp_name2"]:$dataresume[0]["candidate_cp_name2"];
		$data["candidate_cp_relation2"]=(isset($_SESSION["session"]["candidate_cp_relation2"]) && $_SESSION["session"]["candidate_cp_relation2"]<>"")?$_SESSION["session"]["candidate_cp_relation2"]:$dataresume[0]["candidate_cp_relation2"];
		$data["candidate_cp_phone2"]=(isset($_SESSION["session"]["candidate_cp_phone2"]) && $_SESSION["session"]["candidate_cp_phone2"]<>"")?$_SESSION["session"]["candidate_cp_phone2"]:$dataresume[0]["candidate_cp_phone2"];
		$data["candidate_ref_name"]=(isset($_SESSION["session"]["candidate_ref_name"]) && $_SESSION["session"]["candidate_ref_name"]<>"")?$_SESSION["session"]["candidate_ref_name"]:$dataresume[0]["candidate_ref_name"];
		$data["candidate_ref_division"]=(isset($_SESSION["session"]["candidate_ref_division"]) && $_SESSION["session"]["candidate_ref_division"]<>"")?$_SESSION["session"]["candidate_ref_division"]:$dataresume[0]["candidate_ref_division"];
		$data["candidate_ref_position"]=(isset($_SESSION["session"]["candidate_ref_position"]) && $_SESSION["session"]["candidate_ref_position"]<>"")?$_SESSION["session"]["candidate_ref_position"]:$dataresume[0]["candidate_ref_position"];
		$data["candidate_expected_salary"]=(isset($_SESSION["session"]["candidate_expected_salary"]) && $_SESSION["session"]["candidate_expected_salary"]<>"")?$_SESSION["session"]["candidate_expected_salary"]:$dataresume[0]["candidate_expected_salary"];
		$data["candidate_hobby"]=(isset($_SESSION["session"]["candidate_hobby"]) && $_SESSION["session"]["candidate_hobby"]<>"")?$_SESSION["session"]["candidate_hobby"]:$dataresume[0]["candidate_hobby"];

$array_religion=array('Islam', 'Roman Catholic', 'Protestant', 'Hindu', 'Budhist', 'Confucianism');

//echo "c city: ".$data["candidate_c_city"];
//print_r($data["candidate_c_city"]);
/*
echo "session hp2".$_SESSION["session"]["candidate_hp2"]."<br><br>";
echo "data ".$data["candidate_hp2"];
exit;
//print_r($data);
*/
if(count($data)>0) $data=clean_view($data);

?>


<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-user"></i>&nbsp;Basic Information</cufonize></h2>
		<div class="caption_indo">Informasi Dasar</div>
	</div>
	
	<?php
		$datapplication = getDataApply();
		// Memeriksa kondisi tahap "offering"
		if (is_array($datapplication) && count($datapplication) > 0) {
			// Memeriksa kondisi tahap "offering"
			if ($datapplication[0]["candidate_apply_stage"] !== "offering") {
			// Jika belum mencapai tahap "offering", tampilkan pesan atau elemen HTML lainnya
			echo '<div class="alert alert-warning" role="alert">Harap tunggu tahap "offering" untuk mengisi personal data.</div>';
		} else {
    // Jika sudah mencapai tahap "offering", tampilkan form
    ?>
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">		
		<form class="form-horizontal" name="resumeform" id="resumeform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form">
			
			<div><?php echo system_showAlert();?></div>
			
			<div class="form-group">
				<div style="text-align:right;" class="col-md-12 top30 asterisk">* <i><b>is required (wajib diisi)</b></i> </div>
			</div>
		
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Email address</div>
					<div class="right caption_indo80 novpadding">Alamat email</div>
				</div>
				<div class="col-md-8">
					<input type="email" class="form-control" name="email1" id="email1" value="<?php echo (isset($dataresume[0]["candidate_email"]) && $dataresume[0]["candidate_email"]<>"")?$dataresume[0]["candidate_email"]:"";?>" readonly="readonly">
				</div>
			</div>
						
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Full name</div>
					<div class="right caption_indo80 novpadding">Nama lengkap</div>
				</div>
				<div class="col-md-8">
						<input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo (isset($dataresume[0]["candidate_name"]) && $dataresume[0]["candidate_name"]<>"")?$dataresume[0]["candidate_name"]:"";?>" readonly="readonly">
				</div>
				
			</div>
			
			
			<div class="form-group">
						<label class="control-label col-md-3" for="birthplace">Place of birth: &nbsp;<span class="asterisk">*</span></label>
						<div class="col-md-4">
							<div class="button-group">
								<input name="place_of_birth" id="birthplace" class="form-control validate[required]">
							</div>
						</div>
						<span><small class="text-info"><i>(As shown on ID Card)</i></small></span>

					</div>

			<div class="form-group">
						<label class="control-label col-md-3" for="birthdate">Date of birth: &nbsp;<span class="asterisk">*</span></label>

						<div class="col-md-4">
							<input type="text" id="birthdate" placeholder="dd-mm-yyyy" name="birthdate" class="form-control validate[required,funcCall[checkLEGAL]] date" value="<?php echo (isset($dataresume[0]["candidate_birthdate"]))?reverseDate($dataresume[0]["candidate_birthdate"]):"";?>">
						</div>
						<span><small class="text-info"><i>(As shown on ID Card)</i></small></span>

					</div>

					<div class="form-group">
						<label class="control-label col-md-3" for="sex">Gender: &nbsp;<span class="asterisk">*</span></label>
						<div class="col-md-4">
							<label class="radio-inline"><input type="radio" name="candidate_gender" id="male" value="male" class="validate[required]"  <?php echo (isset($dataresume[0]["candidate_gender"]) && $dataresume[0]["candidate_gender"]=="male")?"checked":"";?> >Male</label>
							<label class="radio-inline"><input type="radio" name="candidate_gender" id="female" value="female" class="validate[required]" <?php echo (isset($dataresume[0]["candidate_gender"]) && $dataresume[0]["candidate_gender"]=="female")?"checked":"";?>>Female</label>
						</div>
					</div>
			
			<div class="form-group">
						<label class="control-label col-md-3" for="full_name">Nationality: &nbsp;<span class="asterisk">*</span></label>
						<div class="col-md-4">
							<label class="radio-inline"><input type="radio" name="candidate_nationality" id="wni" value="wni" class="validate[required]" <?php echo (isset($dataresume[0]["candidate_nationality"]) && $dataresume[0]["candidate_nationality"]=="wni")?"checked":"";?>>Indonesian</label>
							<label class="radio-inline"><input type="radio" name="candidate_nationality" id="wna" value="wna" class="validate[required]" <?php echo (isset($dataresume[0]["candidate_nationality"]) && $dataresume[0]["candidate_nationality"]=="wna")?"checked":"";?>>Expatriat</label>
						</div>
					</div>
					<!-- muncul jika pilih WNI -->
					<div id="partwni" class="form-group" style="<?php echo (isset($dataresume[0]["candidate_nationality"]) && $dataresume[0]["candidate_nationality"]=="wni")?"":"display:none";?>">
						<label class="control-label col-md-3" for="nomor_ktp">ID Number (KTP): &nbsp;<span class="asterisk"></span></label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor_ktp" id="nomor_ktp" placeholder="Please enter your valid ID Number" value="<?php echo (isset($dataresume[0]["candidate_idcard"]) && $dataresume[0]["candidate_idcard"]<>"")?$dataresume[0]["candidate_idcard"]:"";?>">
						</div>
					</div>

					<!-- muncul jika pilih WNA -->
					<div id="partwna" class="form-group" style="<?php echo (isset($dataresume[0]["candidate_nationality"]) && $dataresume[0]["candidate_nationality"]=="wna")?"":"display:none";?>">
						<label class="control-label col-md-3" for="candidate_country">Country: &nbsp;<span class="asterisk">*</span></label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="candidate_country" id="candidate_country" placeholder="Country of origin" value="<?php echo (isset($dataresume[0]["candidate_country"]))?$dataresume[0]["candidate_country"]:"";?>">
						</div>
					
						<label class="control-label col-md-2" for="nomor_passport">Passport Number: &nbsp;<span class="asterisk"></span></label>
						<div class="col-md-3">
							<input type="text" class="form-control" name="nomor_passport" id="nomor_passport" placeholder="Please enter your valid Passport Number" value="<?php echo (isset($dataresume[0]["candidate_idcard"]))?$dataresume[0]["candidate_idcard"]:"";?>">
						</div>
					</div>
					<!-- akhir part WNA -->
					
					<div class="form-group">
						<label class="control-label col-md-3" for="candidate_hp1">Cellular number: &nbsp;<span class="asterisk">*</span></label>
						<div class="col-md-4">
							<input type="text" class="form-control validate[required,custom[phone]]" name="candidate_hp1" id="candidate_hp1" value="<?php echo (isset($dataresume[0]["candidate_hp1"]) && $dataresume[0]["candidate_hp1"]<>"")?$dataresume[0]["candidate_hp1"]:"";?>">
						</div>
					</div>
					
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Cellular number</div>
					<div class="right caption_indo80 novpadding">Nomor ponsel</div>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control validate[required]" name="candidate_hp1" id="candidate_hp1" value="<?php echo (isset($dataresume[0]["candidate_hp1"]) && $dataresume[0]["candidate_hp1"]<>"")?$dataresume[0]["candidate_hp1"]:"";?>" readonly="readonly">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Religion &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding">Agama &nbsp; &nbsp;&nbsp;</div>
				</div>
				<div class="col-md-3">
					<div class="button-group">
						<select name="candidate_religion" id="candidate_religion" class="form-control validate[required]">
							<option value="">Choose religion</option>
							<?php
							for($r=0;$r<count($array_religion);$r++) {
								if($data["candidate_religion"]==$array_religion[$r]) {
									$terpilih="selected";
								}
								else {
									$terpilih="";
								}
							?>
							<option value="<?php echo $array_religion[$r];?>" <?php echo $terpilih; ?>><?php echo $array_religion[$r];?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Race or Ethnicity</div>
					<div class="right caption_indo80 novpadding">Suku bangsa atau Etnis</div>
				</div>

				<div class="col-md-4">
					<input type="text" class="form-control" name="candidate_race" id="candidate_race">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Marital status &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding">Status pernikahan &nbsp; &nbsp;&nbsp;</div>
				</div>
				<div class="col-md-3">
					<div class="button-group">
						<input name="candidate_marital" id="candidate_marital" class="form-control validate[required]">
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Blood type</div>
					<div class="right caption_indo80 novpadding">Golongan darah</div>
				</div>				
				<div class="col-md-3">
					<div class="button-group">
						<input name="candidate_bloodtype" id="candidate_bloodtype" class="form-control">
					</div>
				</div>
			</div>

			<hr>
			
			
			<div class="form-group">
				<div class="col-md-6 nopadding">
					<div class="col-md-6">
						<div class="right bold"><span class="asterisk">*</span>&nbsp;Permanent Address<br><small class="text-info"><i>(As shown on ID Card)</i></small></div>
						<div class="right caption_indo80 novpadding">&nbsp; &nbsp;&nbsp;Alamat tetap sesuai KTP</div>
					</div>	
					<div class="col-sm-6">
							<textarea class="form-control validate[required]" style="width:100%;"  name="candidate_p_address" id="candidate_p_address" placeholder="Address as shown on your ID Card"><?php echo (isset($data["candidate_p_address"]) && $data["candidate_p_address"]<>"")?$data["candidate_p_address"]:"";?></textarea>
					</div>					
				</div>
				<div class="col-md-6 form-group">
					<div class="col-md-4">
						<div class="right bold">City &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Kota &nbsp; &nbsp;&nbsp;</div>
					</div>
					<div class="col-md-8 bottom10">
						<div class="button-group">
							<input name="candidate_p_city" id="p_city" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="right bold">Postcode</div>
						<div class="right caption_indo80 novpadding">Kode pos</div>
					</div>				

					<div class="col-md-8">
						<div class="button-group">
							<input name="candidate_p_postcode" id="candidate_p_postcode" class="form-control validate[custom[integer],min[10000],max[99999],minSize[5],maxSize[5]]" placeholder="Postcode as shown on your ID" value="<?php echo (isset($data["candidate_p_postcode"]) && $data["candidate_p_postcode"]<>"")?$data["candidate_p_postcode"]:"";?>">
						</div>
					</div>
				</div>
			</div>
			

			<div class="form-group">
				<div class="col-md-6 nopadding">
					<div class="col-md-6">
						<div class="right bold"><span class="asterisk">*</span> Mailing Address</div>
						<div class="right caption_indo80 novpadding">&nbsp; &nbsp;&nbsp;Alamat surat menyurat</div>
					</div>
					<div class="col-sm-6">
							<textarea class="form-control validate[required]" style="width:100%;"  name="candidate_c_address" id="candidate_c_address" placeholder="Your mailing address"><?php echo (isset($data["candidate_c_address"]) && $data["candidate_c_address"]<>"")?$data["candidate_c_address"]:"";?></textarea>
					</div>					
				</div>
				<div class="col-md-6 form-group">
					<div class="col-md-4">
						<div class="right bold">City &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Kota</div>
					</div>
					<div class="col-md-8 bottom10">
						<div class="button-group">
							<input name="candidate_c_city" id="c_city" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="right bold">Postcode</div>
						<div class="right caption_indo80 novpadding">Kode pos</div>
					</div>	
					<div class="col-md-8">
						<div class="button-group">
							<input name="candidate_c_postcode" id="candidate_c_postcode" class="form-control validate[custom[integer],min[10000],max[99999],minSize[5],maxSize[5]]" placeholder="Mailing postcode" value="<?php echo (isset($data["candidate_c_postcode"]) && $data["candidate_c_postcode"]<>"")?$data["candidate_c_postcode"]:"";?>">
						</div>
					</div>
				</div>
			</div>

			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Driver Licence (SIM A)</div>
					<div class="right caption_indo80 novpadding">Surat Izin Mengemudi A</div>
				</div>	
				<div class="col-md-4">
					<input type="text" class="form-control validate[custom[integer],min[000109000000],max[991299999999],minSize[12],maxSize[12]]" name="candidate_sim_a" id="candidate_sim_a" value="<?php echo (isset($data["candidate_sim_a"]) && $data["candidate_sim_a"]<>"")?$data["candidate_sim_a"]:"";?>" placeholder="Enter your A driver license number">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Driver Licence (SIM C)</div>
					<div class="right caption_indo80 novpadding">Surat Izin Mengemudi C</div>
				</div>	
				<div class="col-md-4">
					<input type="text" class="form-control validate[custom[integer],min[000109000000],max[991299999999],minSize[12],maxSize[12]]" name="candidate_sim_c" id="candidate_sim_c" value="<?php echo (isset($data["candidate_sim_c"]) && $data["candidate_sim_c"]<>"")?$data["candidate_sim_c"]:"";?>" placeholder="Enter your C driver license number">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Taxpayer Regist. Number</div>
					<div class="right caption_indo80 novpadding">NPWP</div>
				</div>	
				<div class="col-md-4">
					<input type="text" class="form-control validate[custom[integer],min[0],max[999999999999999],minSize[15],maxSize[15]]" name="candidate_npwp" id="candidate_npwp" value="<?php echo (isset($data["candidate_npwp"]) && $data["candidate_npwp"]<>"")?$data["candidate_npwp"]:"";?>" placeholder="Enter your NPWP number">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Expected Salary</div>
					<div class="right caption_indo80 novpadding">Gaji yang diharapkan</div>
				</div>	

				<div class="col-md-4">
					<input type="text" class="form-control validate[custom[integer],min[0],max[1000000000]]" name="candidate_expected_salary" id="candidate_expected_salary" value="<?php echo (isset($data["candidate_expected_salary"]) && $data["candidate_expected_salary"]<>"")?$data["candidate_expected_salary"]:"";?>" placeholder="Numbers only, no dot . or commas , ">
				</div>
			</div>
			
			<hr>
			
			<div class="form-group nopadding">
				<div class="col-md-12"><cufonize><h4>Contact person in case of emergency</h4></cufonize></div>
				<div class="col-md-12 title_indo">Orang yang dapat dihubungi dalam keadaan darurat</div>
				<div class="col-md-12" style="height:20px;"></div>
				
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Contact Name #1 &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Nama kontak #1&nbsp; &nbsp; &nbsp;</div>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control validate[required]" name="candidate_cp_name1" id="candidate_cp_name1" value="<?php echo (isset($data["candidate_cp_name1"]) && $data["candidate_cp_name1"]<>"")?$data["candidate_cp_name1"]:"";?>" placeholder="Name of your contact person">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Relation #1 &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Relasi #1&nbsp; &nbsp; &nbsp;</div>
					</div>
					<div class="col-md-4">
						<div class="button-group">
							<input name="candidate_cp_relation1" class="form-control validate[required]" id="candidate_cp_relation1" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Contact phone #1 &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Nomor telepon kontak #1&nbsp; &nbsp; &nbsp;</div>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control validate[required,custom[phone]]" name="candidate_cp_phone1" id="candidate_cp_phone1"  value="<?php echo (isset($data["candidate_cp_phone1"]) && $data["candidate_cp_phone1"]<>"")?$data["candidate_cp_phone1"]:"";?>" placeholder="Phone number of contact person">
					</div>
				</div>
				
				<div class="form-group" style="height:20px;"></div>
				
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Contact Name #2 &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Nama kontak #2&nbsp; &nbsp; &nbsp;</div>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" name="candidate_cp_name2" id="candidate_cp_name2" value="<?php echo (isset($data["candidate_cp_name2"]) && $data["candidate_cp_name2"]<>"")?$data["candidate_cp_name2"]:"";?>" placeholder="Name of your contact person">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Relation #2 &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Relasi #2&nbsp; &nbsp; &nbsp;</div>
					</div>
					<div class="col-md-4">
						<div class="button-group">
							<input name="candidate_cp_relation2" id="candidate_cp_relation2" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Contact phone #2 &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding">Nomor telepon kontak #2&nbsp; &nbsp; &nbsp;</div>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control validate[custom[phone]]" name="candidate_cp_phone2" id="candidate_cp_phone2"  value="<?php echo (isset($data["candidate_cp_phone2"]) && $data["candidate_cp_phone2"]<>"")?$data["candidate_cp_phone2"]:"";?>" placeholder="Phone number of contact person">
					</div>
				</div>				
			</div>
			
			<hr>
			
			<div class="form-group nopadding">
				<div class="col-md-12"><cufonize><h4>Reference</h4></cufonize></div>
				<div class="col-md-12"><i>Orang internal perusahaan yang me-referensi-kan Anda</i></div>
				<div class="col-md-12" style="height:20px;"></div>
				
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Reference Name</div>
						<div class="right caption_indo80 novpadding">Nama pemberi referensi</div>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" name="candidate_ref_name" id="candidate_ref_name" value="<?php echo (isset($data["candidate_ref_name"]) && $data["candidate_ref_name"]<>"")?$data["candidate_ref_name"]:"";?>" placeholder="Name of your reference">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Department/ Division</div>
						<div class="right caption_indo80 novpadding">Departemen/ Divisi</div>
					</div>					
					<div class="col-md-4">
						<input type="text" class="form-control" name="candidate_ref_division" id="candidate_ref_division" value="<?php echo (isset($data["candidate_ref_division"]) && $data["candidate_ref_division"]<>"")?$data["candidate_ref_division"]:"";?>" placeholder="His/ Her Department or Division">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-3">
						<div class="right bold">Position</div>
						<div class="right caption_indo80 novpadding">Jabatan</div>
					</div>					
					<div class="col-md-4">
						<input type="text" class="form-control" name="candidate_ref_position" id="candidate_ref_position" value="<?php echo (isset($data["candidate_ref_position"]) && $data["candidate_ref_position"]<>"")?$data["candidate_ref_position"]:"";?>" placeholder="His/ Her Position in this company">
					</div>
				</div>
			</div>
			
			<hr>
			
			<div class="form-group nopadding">
				<div class="col-md-12"><cufonize><h4>Personal Interest/ Hobby</h4></cufonize></div>
				<div class="col-md-12"><i>Tuliskan minat dan hobby/ kegemaran Anda</i></div>
				<div class="col-md-12" style="height:20px;"></div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-7">
						<div class="field span5">
						<textarea name="candidate_hobby" id="candidate_hobby" class="form-control" placeholder="Summarize your personal interests or hobbies"><?php echo (isset($data["candidate_hobby"]) && $data["candidate_hobby"]<>"")?$data["candidate_hobby"]:"";?></textarea>
						</div>
					</div>
				</div>
			</div>
			
			
			<input type="hidden" name="mod" value="update_candidateResume"/>
			
			
			<div class="form-group"> 
				<div class="col-md-offset-3 col-md-4">
					<button type="submit" class="btn btn-success">SAVE ( SIMPAN )</button>
				</div>
			</div>
		</form>				
	</div>
	<!-- akhir panel body -->
	<?php 
	}
}
	?>
</div>

<script type="text/javascript">
$(function() {

	$('#birthplace').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'place_of_birth',
		<?php
		if(isset($_SESSION["session"]["place_of_birth"]) && $_SESSION["session"]["place_of_birth"]<>"") {
		?>
		value: ['<?php echo $_SESSION["session"]["place_of_birth"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Please choose from the available list',
		<?php
		}
		?>		
		valueField: 'city_name',
	    displayField: 'city_name'
	});	
	
	$('#birthdate').datepicker({
		format:"dd-mm-yyyy"
	});
	

});
</script>

<script type="text/javascript">
$(document).ready(function(){

	
	$('#candidate_marital').magicSuggest({
	    resultAsString: true,
		required: true,
		allowFreeEntries: false,
	    maxSelection: 1,
	    data: ['Single', 'Married', 'Divorce', 'Separated'],
		name: 'candidate_marital',
		<?php
		if(isset($data["candidate_marital"]) && $data["candidate_marital"]<>"") {
		?>
		value: ['<?php echo $data["candidate_marital"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Please choose marital status from available list',
		<?php
		}
		?>
	    maxDropHeight: 100,
		displayField: 'marital_status',
		editable: 'false'
	});	
	
	$('#candidate_bloodtype').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: ['A+', 'B+', 'AB+', 'O+','A-', 'B-', 'AB-', 'O-', 'A', 'B', 'AB', 'O'],
		name: 'candidate_bloodtype',
		<?php
		if(isset($data["candidate_bloodtype"]) && $data["candidate_bloodtype"]<>"") {
		?>
		value: ['<?php echo $data["candidate_bloodtype"];?>'],
		<?php
		}
		else {
		?>	
		placeholder: 'Please choose your blood type',
		<?php
		}
		?>
	    maxDropHeight: 100,
		displayField: 'candidate_bloodtype',
		editable: 'false'
	});	
		
	$('#p_city').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'candidate_p_city',
		<?php
		if(isset($data["candidate_p_city"]) && $data["candidate_p_city"]<>"") {
		?>
		value: ['<?php echo $data["candidate_p_city"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'City as shown on your ID',
		<?php
		}
		?>
		valueField: 'city_name',
	    displayField: 'city_name'
	});	
	
	$('#c_city').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'candidate_c_city',
		<?php
		if(isset($data["candidate_c_city"]) && $data["candidate_c_city"]<>"") {
		?>
		value: ['<?php echo $data["candidate_c_city"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Mailing city',
		<?php
		}
		?>
		valueField: 'city_name',
	    displayField: 'city_name'
	});	
		
	$('#candidate_cp_relation1').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: ['Father', 'Mother', 'Brother', 'Sister', 'Husband', 'Wife', 'Relatives', 'Best Friend', 'Fiance', 'Sibling', 'Family', 'Boyfriend', 'Girlfriend', 'Son', 'Daughter'],
		name: 'candidate_cp_relation1',
		<?php
		if(isset($data["candidate_cp_relation1"]) && $data["candidate_cp_relation1"]<>"") {
		?>
		value: ['<?php echo $data["candidate_cp_relation1"];?>'],
		<?php
		}
		else {
		?>	
		placeholder: 'Relation to you',
		<?php
		}
		?>		
	    maxDropHeight: 100,
		displayField: 'candidate_cp_relation1'
	});	
	
	$('#candidate_cp_relation2').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: ['Father', 'Mother', 'Brother', 'Sister', 'Husband', 'Wife', 'Relatives', 'Best Friend', 'Fiance', 'Sibling', 'Family', 'Boyfriend', 'Girlfriend', 'Son', 'Daughter'],
		name: 'candidate_cp_relation2',
		<?php
		if(isset($data["candidate_cp_relation2"]) && $data["candidate_cp_relation2"]<>"") {
		?>
		value: ['<?php echo $data["candidate_cp_relation2"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Relation to you',
		<?php
		}
		?>
	    maxDropHeight: 100,
		displayField: 'candidate_cp_relation2'
	});	
	/*
	$('.summernote').summernote({
	  toolbar: [
		//[groupname, [button list]]
		['para', ['ul', 'ol']]
	  ],
	  height: 100
	});
	*/
	
	$('#candidate_race').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.race.php',
		name: 'candidate_race',
		<?php
		if(isset($data["candidate_race"]) && $data["candidate_race"]<>"") {
		?>
		value: ['<?php echo $data["candidate_race"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Race/ Suku',
		<?php
		}
		?>
		valueField: 'Race',
	    displayField: 'Race'
	});	

	
		
});
</script>
<!--
<script>
$(document).ready(function(){
    $("#registerform").validationEngine();
   });
</script>
-->

<script type="text/javascript">
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="wni"){
            $("#partwni").show();
			$("#nomor_ktp").addClass(" validate[required,minSize[16],maxSize[16]]");
			$("#nomor_ktp").removeAttr("disabled");
			
            $("#partwna").hide();
			$("#nomor_passport").attr("disabled", "disabled");
			$("#country").attr("disabled", "disabled");			
			
        }
        if($(this).attr("value")=="wna"){
            $("#partwni").hide();
			$("#nomor_ktp").attr("disabled", "disabled")
			
            $("#partwna").show();
			$("#nomor_passport").addClass(" validate[required]");
			$("#country").addClass(" validate[required]");			
			$("#nomor_passport").removeAttr("disabled");
			$("#country").removeAttr("disabled");			
			
        }
    });	
	
});
</script>


<script>
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#resumeform").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});

	var dateFormat = /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.]((?:19|20)\d\d)$/

	function checkLEGAL(field, rules, i, options){
		var match = field.val().match(dateFormat)
		console.log(match)
		if (!match) return "Please enter valid date (dd-mm-yyyy)"
		var bd=new Date(match[3], match[2]-1, match[1])
		console.log(bd)
		var diff = Math.floor((new Date).getTime() - bd.getTime());
		var day = 1000* 60 * 60 * 24

		var days = Math.floor(diff/day)
		var months = Math.floor(days/31)
		var years = Math.floor(months/12)
		console.log(days,months,years)
		if (years<16) return "You have to be at least 17 year old to register"
	}
</script>

<script>
    $("input[name='candidate_bodyheight']").TouchSpin({
        min: 0,
        max: 250,
        step: 0.05,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'cm'
    });
	
    $("input[name='candidate_bodyweight']").TouchSpin({
        min: 0,
        max: 250,
        step: 0.05,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'kg'
    });
</script>