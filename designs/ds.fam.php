<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

/*candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, 
candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
*/
//echo "candidate_id ".$_SESSION["candidate_id"]."<br>";
$datafam=getDataFam();
$datacity=getCity();

$data=array();
for($i=0;$i<count($datafam);$i++) {
// $data[$i]["candidate_family_id"]=(isset($_SESSION["session"]["candidate_family_id"][$i]) && $_SESSION["session"]["candidate_family_id"][$i]<>"")?$_SESSION["session"]["candidate_family_id"][$i]:(isset($datafam[$i]["candidate_family_id"]))?$datafam[$i]["candidate_family_id"]:"";
// $data[$i]["candidate_family_name"]=(isset($_SESSION["session"]["candidate_family_name"][$i]) && $_SESSION["session"]["candidate_family_name"][$i]<>"")?$_SESSION["session"]["candidate_family_name"][$i]:(isset($datafam[$i]["candidate_family_name"]))?$datafam[$i]["candidate_family_name"]:"";
// $data[$i]["candidate_family_relation"]=(isset($_SESSION["session"]["candidate_family_relation"][$i]) && $_SESSION["session"]["candidate_family_relation"][$i]<>"")?$_SESSION["session"]["candidate_family_relation"][$i]:(isset($datafam[$i]["candidate_family_relation"]))?$datafam[$i]["candidate_family_relation"]:"";
// $data[$i]["candidate_family_birthplace"]=(isset($_SESSION["session"]["candidate_family_birthplace"][$i]) && $_SESSION["session"]["candidate_family_birthplace"][$i]<>"")?$_SESSION["session"]["candidate_family_birthplace"][$i]:(isset($datafam[$i]["candidate_family_birthplace"]))?$datafam[$i]["candidate_family_birthplace"]:"";
// $data[$i]["candidate_family_birthdate"]=(isset($_SESSION["session"]["candidate_family_birthdate"][$i]) && $_SESSION["session"]["candidate_family_birthdate"][$i]<>"")?$_SESSION["session"]["candidate_family_birthdate"][$i]:(isset($datafam[$i]["candidate_family_birthdate"]))?$datafam[$i]["candidate_family_birthdate"]:"";
// $data[$i]["candidate_family_lastedu"]=(isset($_SESSION["session"]["candidate_family_lastedu"][$i]) && $_SESSION["session"]["candidate_family_lastedu"][$i]<>"")?$_SESSION["session"]["candidate_family_lastedu"][$i]:(isset($datafam[$i]["candidate_family_lastedu"]))?$datafam[$i]["candidate_family_lastedu"]:"";
// $data[$i]["candidate_family_lastjob"]=(isset($_SESSION["session"]["candidate_family_lastjob"][$i]) && $_SESSION["session"]["candidate_family_lastjob"][$i]<>"")?$_SESSION["session"]["candidate_family_lastjob"][$i]:(isset($datafam[$i]["candidate_family_lastjob"]))?$datafam[$i]["candidate_family_lastjob"]:"";
// $data[$i]["candidate_family_company"]=(isset($_SESSION["session"]["candidate_family_company"][$i]) && $_SESSION["session"]["candidate_family_company"][$i]<>"")?$_SESSION["session"]["candidate_family_company"][$i]:(isset($datafam[$i]["candidate_family_company"]))?$datafam[$i]["candidate_family_company"]:"";
// $data[$i]["candidate_family_rip"]=(isset($_SESSION["session"]["candidate_family_rip"][$i]) && $_SESSION["session"]["candidate_family_rip"][$i]<>"")?$_SESSION["session"]["candidate_family_rip"][$i]:(isset($datafam[$i]["candidate_family_rip"]))?$datafam[$i]["candidate_family_rip"]:"";
$data[$i]["candidate_family_id"] = (isset($_SESSION["session"]["candidate_family_id"][$i]) && $_SESSION["session"]["candidate_family_id"][$i] != "") ? $_SESSION["session"]["candidate_family_id"][$i] : (isset($datafam[$i]["candidate_family_id"]) ? $datafam[$i]["candidate_family_id"] : "");
$data[$i]["candidate_family_name"] = (isset($_SESSION["session"]["candidate_family_name"][$i]) && $_SESSION["session"]["candidate_family_name"][$i] != "") ? $_SESSION["session"]["candidate_family_name"][$i] : (isset($datafam[$i]["candidate_family_name"]) ? $datafam[$i]["candidate_family_name"] : "");
$data[$i]["candidate_family_relation"] = (isset($_SESSION["session"]["candidate_family_relation"][$i]) && $_SESSION["session"]["candidate_family_relation"][$i] != "") ? $_SESSION["session"]["candidate_family_relation"][$i] : (isset($datafam[$i]["candidate_family_relation"]) ? $datafam[$i]["candidate_family_relation"] : "");
$data[$i]["candidate_family_birthplace"] = (isset($_SESSION["session"]["candidate_family_birthplace"][$i]) && $_SESSION["session"]["candidate_family_birthplace"][$i] != "") ? $_SESSION["session"]["candidate_family_birthplace"][$i] : (isset($datafam[$i]["candidate_family_birthplace"]) ? $datafam[$i]["candidate_family_birthplace"] : "");
$data[$i]["candidate_family_birthdate"] = (isset($_SESSION["session"]["candidate_family_birthdate"][$i]) && $_SESSION["session"]["candidate_family_birthdate"][$i] != "") ? $_SESSION["session"]["candidate_family_birthdate"][$i] : (isset($datafam[$i]["candidate_family_birthdate"]) ? $datafam[$i]["candidate_family_birthdate"] : "");
$data[$i]["candidate_family_lastedu"] = (isset($_SESSION["session"]["candidate_family_lastedu"][$i]) && $_SESSION["session"]["candidate_family_lastedu"][$i] != "") ? $_SESSION["session"]["candidate_family_lastedu"][$i] : (isset($datafam[$i]["candidate_family_lastedu"]) ? $datafam[$i]["candidate_family_lastedu"] : "");
$data[$i]["candidate_family_lastjob"] = (isset($_SESSION["session"]["candidate_family_lastjob"][$i]) && $_SESSION["session"]["candidate_family_lastjob"][$i] != "") ? $_SESSION["session"]["candidate_family_lastjob"][$i] : (isset($datafam[$i]["candidate_family_lastjob"]) ? $datafam[$i]["candidate_family_lastjob"] : "");
$data[$i]["candidate_family_company"] = (isset($_SESSION["session"]["candidate_family_company"][$i]) && $_SESSION["session"]["candidate_family_company"][$i] != "") ? $_SESSION["session"]["candidate_family_company"][$i] : (isset($datafam[$i]["candidate_family_company"]) ? $datafam[$i]["candidate_family_company"] : "");
$data[$i]["candidate_family_rip"] = (isset($_SESSION["session"]["candidate_family_rip"][$i]) && $_SESSION["session"]["candidate_family_rip"][$i] != "") ? $_SESSION["session"]["candidate_family_rip"][$i] : (isset($datafam[$i]["candidate_family_rip"]) ? $datafam[$i]["candidate_family_rip"] : "");
}
/*
print_r($data);
exit;
*/
if(count($data)>0) $data=clean_view($data);
$array_edu=array('Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD');
?>
<div><?php echo system_showAlert();?></div>

<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-graduation-cap"></i>&nbsp;Please list your Family member.</cufonize></h2>
		<div class="caption_indo">Mohon tuliskan anggota keluarga Anda (orang tua, saudara kandung, pasangan, anak).</div>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">
	
		<form class="form-horizontal" name="famform" id="famform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
			 <div class="row clearfix">
				<div class="col-md-12 column">
					<table  class="table small-text" id="tb_fam">
						<tr class="tr-header">
							<th>Family Member <i>(Anggota Keluarga)</i>: </th>
							<th><button type="button" class="btn btn-success btn-xs" id="fam_add"><i class="fa fa-plus"></i> Add/Tambah</button></th>
						</tr>
						<tr style="display:none;">
							<td>
								<div class="form-group top10">
									<div class="col-md-2">
										<div class="right bold">Name</div>
										<div class="right caption_indo80 novpadding">Nama</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="candidate_family_name[]" class="form-control">
									</div>
								
									<div class="col-md-2">
										<div class="right bold">Relation</div>
										<div class="right caption_indo80 novpadding">Relasi</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="candidate_family_relation[]">
											<option value="">Choose Relation/ Pilih Relasi</option>
											<option value="Father">Father/ Ayah</option>
											<option value="Mother">Mother/ Ibu</option>
											<option value="Spouse">Spouse/ Pasangan</option>
											<option value="Brother">Brother/ Saudara pria</option>
											<option value="Sister">Sister/ Saudara wanita</option>
											<option value="Son">Son/ Anak laki-laki</option>
											<option value="Daughter">Daughter/ Anak perempuan</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-2">
										<div class="right bold">Birth place</div>
										<div class="right caption_indo80 novpadding">Lahir di</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="candidate_family_birthplace[]">
											<option value="">Kota / Kabupaten</option>
											<?php
											for($i=0;$i<count($datacity);$i++) {
											?>
											<option value="<?php echo $datacity[$i]["city_name"];?>"><?php echo $datacity[$i]["city_name"];?></option>
											<?php
											}
											?>
										</select>
									</div>
								
									<div class="col-md-2">
										<div class="right bold">Birth date</div>
										<div class="right caption_indo80 novpadding">Tgl lahir</div>
									</div>
									<div class="col-md-4">
										<div class="col-md-12 input-group">
											<div class="col-md-4 nopadding">
												<select class="form-control nopadding" name="dob_tgl[]"><option value="00">dd</option>
													<?php for ($i=1;$i<=31;$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'">'.$i.'</option>';?>
												</select>
											</div>
											<div class="col-md-4 nopadding">
												<select class="form-control nopadding" name="dob_bln[]"><option value="00">mm</option>
													<?php for ($i=1;$i<=12;$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'">'.$i.'</option>';?>
												</select>
											</div>
											<div class="col-md-4 nopadding">
												<select class="form-control nopadding" name="dob_thn[]"><option value="0000">yyyy</option>
													<?php for ($i=1930;$i<=date('Y');$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'">'.$i.'</option>';?>
												</select>
											</div>
										</div>
									</div>
								
								</div>
								
								<div class="form-group">
									<div class="col-md-2">
										<div class="right bold">Position</div>
										<div class="right caption_indo80 novpadding">Jabatan</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="candidate_family_lastjob[]" class="form-control">
									</div>
									<div class="col-md-2">
										<div class="right bold">Company</div>
										<div class="right caption_indo80 novpadding">Perusahaan</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="candidate_family_company[]" class="form-control">
									</div>
									
								</div>
								
								<div class="form-group bottom10">
									<div class="col-md-2">
										<div class="right bold">Education</div>
										<div class="right caption_indo80 novpadding">Pendidikan</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="candidate_family_lastedu[]">
										<option value="">Choose degree</option>
											<?php
											for($ed=0;$ed<count($array_edu);$ed++) {
											?>
											<option value="<?php echo $array_edu[$ed];?>" <?php echo (isset($data[$i]["candidate_edu_degree"]) && $array_edu[$ed]==$data[$i]["candidate_edu_degree"])?"selected":"";?> ><?php echo $array_edu[$ed];?></option>
											<?php
											}
											?>
										</select>									
									</div>								
									<label class="control-label col-md-2" for="candidate_family_rip">Status:</label>
									<div class="col-md-4" style="text-align:left;">
										<select class="form-control" name="candidate_family_rip[]">
											<option value="Alive">Alive/ Masih hidup</option>
											<option value="RIP">R.I.P/ Meninggal</option>
										</select>
									</div>
								</div>
								
							</td>
							<td>
								<div class="top10">
								<a href='javascript:void(0);'  class='fam_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
								<input type="hidden" name="candidate_family_id[]" value="0">
								</div>
							</td>
						</tr>
						
						<?php
						if(isset($data) && count($data)>0) {
							for($fam=0;$fam<count($data);$fam++) {
							$pecah=(isset($data[$fam]["candidate_family_birthdate"]) && $data[$fam]["candidate_family_birthdate"]<>"")?explode("-",$data[$fam]["candidate_family_birthdate"]):"";

						?>
							<tr>
								<td>
									<div class="form-group top10">
										<div class="col-md-2">
											<div class="right bold">Name</div>
											<div class="right caption_indo80 novpadding">Nama</div>
										</div>
										<div class="col-md-4">
											<input type="text" name="candidate_family_name[]" class="form-control" value="<?php echo (isset($data[$fam]["candidate_family_name"]) && $data[$fam]["candidate_family_name"]<>"")?$data[$fam]["candidate_family_name"]:"";?>">
										</div>
									
										<div class="col-md-2">
											<div class="right bold">Relation</div>
											<div class="right caption_indo80 novpadding">Relasi</div>
										</div>

										<div class="col-md-4">
											<select class="form-control" name="candidate_family_relation[]">
												<option value="">Choose relation/ Pilih Relasi</option>
												<option value="Father" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Father")?"selected":"";?>>Father/ Ayah</option>
												<option value="Mother" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Mother")?"selected":"";?>>Mother/ Ibu</option>
												<option value="Spouse" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Spouse")?"selected":"";?>>Spouse/ Pasangan</option>
												<option value="Brother" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Brother")?"selected":"";?>>Brother/ Saudara pria</option>
												<option value="Sister" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Sister")?"selected":"";?>>Sister/ Saudara wanita</option>
												<option value="Son" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Son")?"selected":"";?>>Son/ Anak laki-laki</option>
												<option value="Daughter" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Daughter")?"selected":"";?>>Daughter/ Anak perempuan</option>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-2">
											<div class="right bold">Birth place</div>
											<div class="right caption_indo80 novpadding">Lahir di</div>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="candidate_family_birthplace[]">
												<option value="">Kota / Kabupaten</option>
												<?php
												for($i=0;$i<count($datacity);$i++) {
												?>
												<option value="<?php echo $datacity[$i]["city_name"];?>" <?php echo (isset($data[$fam]["candidate_family_birthplace"]) && $data[$fam]["candidate_family_birthplace"]==$datacity[$i]["city_name"])?"selected":"";?>><?php echo $datacity[$i]["city_name"];?></option>
												<?php
												}
												?>
											</select>
										</div>
									
										<div class="col-md-2">
											<div class="right bold">Birth date</div>
											<div class="right caption_indo80 novpadding">Tgl lahir</div>
										</div>
										<div class="col-md-4">
											<div class="col-md-12 input-group">
												<div class="col-md-4 nopadding">
													<select class="form-control nopadding" name="dob_tgl[]"><option value="00">dd</option>
														<?php for ($i=1;$i<=31;$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'" '.(($i==$pecah[2])?"selected":"").'>'.$i.'</option>';?>
													</select>
												</div>
												<div class="col-md-4 nopadding">
													<select class="form-control nopadding" name="dob_bln[]"><option value="00">mm</option>
														<?php for ($i=1;$i<=12;$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'" '.(($i==$pecah[1])?"selected":"").'>'.(($i<10)?"0".$i:$i).'</option>';?>
													</select>
												</div>
												<div class="col-md-4 nopadding">
													<select class="form-control nopadding" name="dob_thn[]"><option value="0000">yyyy</option>
														<?php for ($i=1930;$i<=date('Y');$i++) echo '<option value="'.$i.'" '.(($i==$pecah[0])?"selected":"").'>'.$i.'</option>';?>
													</select>
												</div>
											</div>
										</div>
									
									</div>
									
									<div class="form-group">
										<div class="col-md-2">
											<div class="right bold">Position</div>
											<div class="right caption_indo80 novpadding">Jabatan</div>
										</div>
										<div class="col-md-4">
											<input type="text" name="candidate_family_lastjob[]" class="form-control" value="<?php echo (isset($data[$fam]["candidate_family_lastjob"]) && $data[$fam]["candidate_family_lastjob"]<>"")?$data[$fam]["candidate_family_lastjob"]:"";?>">
										</div>
										<div class="col-md-2">
											<div class="right bold">Company</div>
											<div class="right caption_indo80 novpadding">Perusahaan</div>
										</div>
										<div class="col-md-4">
											<input type="text" name="candidate_family_company[]" class="form-control" value="<?php echo (isset($data[$fam]["candidate_family_company"]) && $data[$fam]["candidate_family_company"]<>"")?$data[$fam]["candidate_family_company"]:"";?>">
										</div>
										
									</div>
									
									<div class="form-group bottom10">
										<div class="col-md-2">
											<div class="right bold">Education</div>
											<div class="right caption_indo80 novpadding">Pendidikan</div>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="candidate_family_lastedu[]">
											<option value="">Choose degree</option>
											<?php
											for($ed=0;$ed<count($array_edu);$ed++) {
											?>
											<option value="<?php echo $array_edu[$ed];?>" <?php echo (isset($data[$i]["candidate_edu_degree"]) && $array_edu[$ed]==$data[$i]["candidate_edu_degree"])?"selected":"";?> ><?php echo $array_edu[$ed];?></option>
											<?php
											}
											?>
											</select>									
										</div>								
										<label class="control-label col-md-2" for="candidate_family_rip">Status:</label>
										<div class="col-md-4" style="text-align:left;">
											<select class="form-control" name="candidate_family_rip[]">
												<option value="Alive" <?php echo (isset($data[$fam]["candidate_family_rip"]) && $data[$fam]["candidate_family_rip"]=="Alive")?"selected":"";?>>Alive/ Masih hidup</option>
												<option value="RIP" <?php echo (isset($data[$fam]["candidate_family_rip"]) && $data[$fam]["candidate_family_rip"]=="RIP")?"selected":"";?>>R.I.P/ Meninggal</option>
											</select>
										</div>
									</div>
									
								</td>
								<td>
									<div class="top10">
									<a href='javascript:void(0);'  class='fam_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
									<input type="hidden" name="candidate_family_id[]" value="<?php echo $data[$fam]["candidate_family_id"];?>">
									</div>
								</td>
							</tr>
						<?php
							}
						}
						else {
						?>
						<tr>
							<td>
								<div class="form-group top10">
									<div class="col-md-2">
										<div class="right bold">Name</div>
										<div class="right caption_indo80 novpadding">Nama</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="candidate_family_name[]" class="form-control">
									</div>
								
									<div class="col-md-2">
										<div class="right bold">Relation</div>
										<div class="right caption_indo80 novpadding">Relasi</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="candidate_family_relation[]">
											<option value="">Choose relation/ Pilih Relasi</option>
											<option value="Father">Father/ Ayah</option>
											<option value="Mother">Mother/ Ibu</option>
											<option value="Spouse">Spouse/ Pasangan</option>
											<option value="Brother">Brother/ Saudara pria</option>
											<option value="Sister">Sister/ Saudara wanita</option>
											<option value="Son">Son/ Anak laki-laki</option>
											<option value="Daughter">Daughter/ Anak perempuan</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-2">
										<div class="right bold">Birth place</div>
										<div class="right caption_indo80 novpadding">Lahir di</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="candidate_family_birthplace[]">
											<option value="">Kota / Kabupaten</option>
											<?php
											for($i=0;$i<count($datacity);$i++) {
											?>
											<option value="<?php echo $datacity[$i]["city_name"];?>"><?php echo $datacity[$i]["city_name"];?></option>
											<?php
											}
											?>
										</select>
									</div>
								
									<div class="col-md-2">
										<div class="right bold">Birth date</div>
										<div class="right caption_indo80 novpadding">Tgl lahir</div>
									</div>
									<div class="col-md-4">
										<div class="col-md-12 input-group">
											<div class="col-md-4 nopadding">
												<select class="form-control nopadding" name="dob_tgl[]"><option value="00">dd</option>
													<?php for ($i=1;$i<=31;$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'">'.$i.'</option>';?>
												</select>
											</div>
											<div class="col-md-4 nopadding">
												<select class="form-control nopadding" name="dob_bln[]"><option value="00">mm</option>
													<?php for ($i=1;$i<=12;$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'">'.$i.'</option>';?>
												</select>
											</div>
											<div class="col-md-4 nopadding">
												<select class="form-control nopadding" name="dob_thn[]"><option value="0000">yyyy</option>
													<?php for ($i=1930;$i<=date('Y');$i++) echo '<option value="'.(($i<10)?"0".$i:$i).'">'.$i.'</option>';?>
												</select>
											</div>
										</div>
									</div>
								
								</div>
								
								<div class="form-group">
									<div class="col-md-2">
										<div class="right bold">Position</div>
										<div class="right caption_indo80 novpadding">Jabatan</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="candidate_family_lastjob[]" class="form-control">
									</div>
									<div class="col-md-2">
										<div class="right bold">Company</div>
										<div class="right caption_indo80 novpadding">Perusahaan</div>
									</div>
									<div class="col-md-4">
										<input type="text" name="candidate_family_company[]" class="form-control">
									</div>
									
								</div>
								
								<div class="form-group bottom10">
									<div class="col-md-2">
										<div class="right bold">Education</div>
										<div class="right caption_indo80 novpadding">Pendidikan</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="candidate_family_lastedu[]">
										<option value="">Choose degree</option>
										<?php
											for($ed=0;$ed<count($array_edu);$ed++) {
										?>
										<option value="<?php echo $array_edu[$ed];?>" <?php echo (isset($data[$i]["candidate_edu_degree"]) && $array_edu[$ed]==$data[$i]["candidate_edu_degree"])?"selected":"";?> ><?php echo $array_edu[$ed];?></option>
										<?php
											}
										?>
										</select>									
									</div>								
									<label class="control-label col-md-2" for="candidate_family_rip">Status:</label>
									<div class="col-md-4" style="text-align:left;">
										<select class="form-control" name="candidate_family_rip[]">
											<option value="Alive">Alive/ Masih hidup</option>
											<option value="RIP">R.I.P/ Meninggal</option>
										</select>
									</div>
								</div>
								
							</td>
							<td>
								<div class="top10">
								<a href='javascript:void(0);'  class='fam_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
								<input type="hidden" name="candidate_family_id[]" value="0">
								</div>
							</td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			
			<input type="hidden" name="mod" value="update_candidateFam"/>
			
			
			<div class="form-group"> 
				<div class="col-md-offset-2 col-md-4">
					<button type="submit" class="btn btn-success">SAVE ( SIMPAN )</button>
				</div>
			</div>
		</form>				
	</div>
	<!-- akhir panel body -->
	
</div>

<!--
<script>
$(document).ready(function(){
    $("#registerform").validationEngine();
   });
</script>
-->
