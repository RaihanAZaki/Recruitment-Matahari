<?php
session_start();
	
include("../setconf.php");

if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {
	loadAllModules();

	if(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"") {
			$datafam=admin_getDataFam(decoded($_GET["candidate_id"]));
			$datacity=getCity();

			$data=array();
			for($i=0;$i<count($datafam);$i++) {
			$data[$i]["candidate_family_id"]=((isset($_SESSION["session"]["candidate_family_id"][$i]) && $_SESSION["session"]["candidate_family_id"][$i]<>"")?$_SESSION["session"]["candidate_family_id"][$i]:(isset($datafam[$i]["candidate_family_id"])))?$datafam[$i]["candidate_family_id"]:"";
			$data[$i]["candidate_family_name"]=((isset($_SESSION["session"]["candidate_family_name"][$i]) && $_SESSION["session"]["candidate_family_name"][$i]<>"")?$_SESSION["session"]["candidate_family_name"][$i]:(isset($datafam[$i]["candidate_family_name"])))?$datafam[$i]["candidate_family_name"]:"";
			$data[$i]["candidate_family_relation"]=((isset($_SESSION["session"]["candidate_family_relation"][$i]) && $_SESSION["session"]["candidate_family_relation"][$i]<>"")?$_SESSION["session"]["candidate_family_relation"][$i]:(isset($datafam[$i]["candidate_family_relation"])))?$datafam[$i]["candidate_family_relation"]:"";
			$data[$i]["candidate_family_birthplace"]=((isset($_SESSION["session"]["candidate_family_birthplace"][$i]) && $_SESSION["session"]["candidate_family_birthplace"][$i]<>"")?$_SESSION["session"]["candidate_family_birthplace"][$i]:(isset($datafam[$i]["candidate_family_birthplace"])))?$datafam[$i]["candidate_family_birthplace"]:"";
			$data[$i]["candidate_family_birthdate"]=((isset($_SESSION["session"]["candidate_family_birthdate"][$i]) && $_SESSION["session"]["candidate_family_birthdate"][$i]<>"")?$_SESSION["session"]["candidate_family_birthdate"][$i]:(isset($datafam[$i]["candidate_family_birthdate"])))?$datafam[$i]["candidate_family_birthdate"]:"";
			$data[$i]["candidate_family_lastedu"]=((isset($_SESSION["session"]["candidate_family_lastedu"][$i]) && $_SESSION["session"]["candidate_family_lastedu"][$i]<>"")?$_SESSION["session"]["candidate_family_lastedu"][$i]:(isset($datafam[$i]["candidate_family_lastedu"])))?$datafam[$i]["candidate_family_lastedu"]:"";
			$data[$i]["candidate_family_lastjob"]=((isset($_SESSION["session"]["candidate_family_lastjob"][$i]) && $_SESSION["session"]["candidate_family_lastjob"][$i]<>"")?$_SESSION["session"]["candidate_family_lastjob"][$i]:(isset($datafam[$i]["candidate_family_lastjob"])))?$datafam[$i]["candidate_family_lastjob"]:"";
			$data[$i]["candidate_family_company"]=((isset($_SESSION["session"]["candidate_family_company"][$i]) && $_SESSION["session"]["candidate_family_company"][$i]<>"")?$_SESSION["session"]["candidate_family_company"][$i]:(isset($datafam[$i]["candidate_family_company"])))?$datafam[$i]["candidate_family_company"]:"";
			$data[$i]["candidate_family_rip"]=((isset($_SESSION["session"]["candidate_family_rip"][$i]) && $_SESSION["session"]["candidate_family_rip"][$i]<>"")?$_SESSION["session"]["candidate_family_rip"][$i]:(isset($datafam[$i]["candidate_family_rip"])))?$datafam[$i]["candidate_family_rip"]:"";
			}
			/*
			print_r($data);
			exit;
			*/
			if(count($data)>0) $data=clean_view($data);

			?>
<script>			
$(function(){
    $('#fam_add').on('click', function() {
              var data = $("#tb_fam tr:eq(1)").clone(true).show().appendTo("#tb_fam");
              data.find("input").val('');
     });
     $(document).on('click', '.fam_rem', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>2) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});
</script>
					<div class="bottom30">&nbsp;</div>

					<div><?php echo system_showAlert();?></div>
				
					<form class="form-horizontal" name="famform" id="famform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
						 <div class="row clearfix">
							<div class="col-md-12 column">
								<table  class="table small-text" id="tb_fam">
									<tr class="tr-header">
										<th>Family Member: </th>
										<th><button type="button" class="btn btn-success btn-xs" id="fam_add"><i class="fa fa-plus"></i> Add</button></th>
									</tr>
									<tr style="display:none;">
										<td>
											<div class="form-group top10">
												<label class="control-label col-md-2" for="candidate_family_name">Family name:</label>
												<div class="col-md-4">
													<input type="text" name="candidate_family_name[]" class="form-control">
												</div>
											
												<label class="control-label col-md-2" for="candidate_family_relation">Relation:</label>
												<div class="col-md-4">
													<select class="form-control" name="candidate_family_relation[]">
														<option value="">Choose relation</option>
														<option value="Father">Father</option>
														<option value="Mother">Mother</option>
														<option value="Spouse">Spouse</option>
														<option value="Brother">Brother</option>
														<option value="Sister">Sister</option>
														<option value="Son">Son</option>
														<option value="Daughter">Daughter</option>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-md-2" for="candidate_family_birthplace">Birth place:</label>
												<div class="col-md-4">
													<select class="form-control" name="candidate_family_birthplace[]">
														<option value="">Choose Kota / Kabupaten</option>
														<?php
														for($i=0;$i<count($datacity);$i++) {
														?>
														<option value="<?php echo $datacity[$i]["city_name"];?>"><?php echo $datacity[$i]["city_name"];?></option>
														<?php
														}
														?>
													</select>
												</div>
											
												<label class="control-label col-md-2" for="candidate_family_birthdate">Birth date:</label>
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
												<label class="control-label col-md-2" for="candidate_family_lastjob">Position:</label>
												<div class="col-md-4">
													<input type="text" name="candidate_family_lastjob[]" class="form-control">
												</div>
												<label class="control-label col-md-2" for="candidate_family_company">Company:</label>
												<div class="col-md-4">
													<input type="text" name="candidate_family_company[]" class="form-control">
												</div>
												
											</div>
											
											<div class="form-group bottom10">
												<label class="control-label col-md-2" for="candidate_family_lastedu">Education:</label>
												<div class="col-md-4">
													<select class="form-control" name="candidate_family_lastedu[]">
														<option value="">Latest Education</option>
														<option value="Post Doctoral">Post Doctoral</option>
														<option value="Doctoral - S3">Doctoral - S3</option>
														<option value="Master - S2">Master Degree - S2</option>
														<option value="Bachelor - S1">Bachelor Degree - S1</option>
														<option value="Diploma">Diploma</option>
														<option value="Highschool - SMA">Highschool - SMA</option>
														<option value="Junior Highschool - SMP">Junior Highschool - SMP</option>
														<option value="Elementary - SD">Elementary - SD</option>
													</select>									
												</div>								
												<label class="control-label col-md-2" for="candidate_family_rip">Status:</label>
												<div class="col-md-4" style="text-align:left;">
													<select class="form-control" name="candidate_family_rip[]">
														<option value="Alive">Alive</option>
														<option value="RIP">R.I.P</option>
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
									if(isset($data) && count($data)>0) {
										for($fam=0;$fam<count($data);$fam++) {
										$pecah=(isset($data[$fam]["candidate_family_birthdate"]) && $data[$fam]["candidate_family_birthdate"]<>"")?explode("-",$data[$fam]["candidate_family_birthdate"]):"";

									?>
										<tr>
											<td>
												<div class="form-group top10">
													<label class="control-label col-md-2" for="candidate_family_name">Family name:</label>
													<div class="col-md-4">
														<input type="text" name="candidate_family_name[]" class="form-control" value="<?php echo (isset($data[$fam]["candidate_family_name"]) && $data[$fam]["candidate_family_name"]<>"")?$data[$fam]["candidate_family_name"]:"";?>">
													</div>
												
													<label class="control-label col-md-2" for="candidate_family_relation">Relation:</label>
													<div class="col-md-4">
														<select class="form-control" name="candidate_family_relation[]">
															<option value="">Choose relation</option>
															<option value="Father" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Father")?"selected":"";?>>Father</option>
															<option value="Mother" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Mother")?"selected":"";?>>Mother</option>
															<option value="Spouse" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Spouse")?"selected":"";?>>Spouse</option>
															<option value="Brother" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Brother")?"selected":"";?>>Brother</option>
															<option value="Sister" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Sister")?"selected":"";?>>Sister</option>
															<option value="Son" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Son")?"selected":"";?>>Son</option>
															<option value="Daughter" <?php echo (isset($data[$fam]["candidate_family_relation"]) && $data[$fam]["candidate_family_relation"]=="Daughter")?"selected":"";?>>Daughter</option>
														</select>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label col-md-2" for="candidate_family_birthplace">Birth place:</label>
													<div class="col-md-4">
														<select class="form-control" name="candidate_family_birthplace[]">
															<option value="">Choose Kota / Kabupaten</option>
															<?php
															for($i=0;$i<count($datacity);$i++) {
															?>
															<option value="<?php echo $datacity[$i]["city_name"];?>" <?php echo (isset($data[$fam]["candidate_family_birthplace"]) && $data[$fam]["candidate_family_birthplace"]==$datacity[$i]["city_name"])?"selected":"";?>><?php echo $datacity[$i]["city_name"];?></option>
															<?php
															}
															?>
														</select>
													</div>
												
													<label class="control-label col-md-2" for="candidate_family_birthdate">Birth date:</label>
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
													<label class="control-label col-md-2" for="candidate_family_lastjob">Position:</label>
													<div class="col-md-4">
														<input type="text" name="candidate_family_lastjob[]" class="form-control" value="<?php echo (isset($data[$fam]["candidate_family_lastjob"]) && $data[$fam]["candidate_family_lastjob"]<>"")?$data[$fam]["candidate_family_lastjob"]:"";?>">
													</div>
													<label class="control-label col-md-2" for="candidate_family_company">Company:</label>
													<div class="col-md-4">
														<input type="text" name="candidate_family_company[]" class="form-control" value="<?php echo (isset($data[$fam]["candidate_family_company"]) && $data[$fam]["candidate_family_company"]<>"")?$data[$fam]["candidate_family_company"]:"";?>">
													</div>
													
												</div>
												
												<div class="form-group bottom10">
													<label class="control-label col-md-2" for="candidate_family_lastedu">Education:</label>
													<div class="col-md-4">
														<select class="form-control" name="candidate_family_lastedu[]">
															<option value="">Latest Education</option>
															<option value="Post Doctoral" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && $data[$fam]["candidate_family_lastedu"]=="Post Doctoral")?"selected":"";?>>Post Doctoral</option>
															<option value="Doctoral - S3" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && $data[$fam]["candidate_family_lastedu"]=="Doctoral - S3")?"selected":"";?>>Doctoral - S3</option>
															<option value="Master - S2" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && ($data[$fam]["candidate_family_lastedu"]=="Master Degree - S2" || $data[$fam]["candidate_family_lastedu"]=="Master - S2" ))?"selected":"";?>>Master Degree - S2</option>
															<option value="Bachelor - S1" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && ($data[$fam]["candidate_family_lastedu"]=="Bachelor Degree - S1" || $data[$fam]["candidate_family_lastedu"]=="Master - S2" ))?"selected":"";?>>Bachelor Degree - S1</option>
															<option value="Diploma" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && $data[$fam]["candidate_family_lastedu"]=="Diploma")?"selected":"";?>>Diploma</option>
															<option value="Highschool - SMA" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && $data[$fam]["candidate_family_lastedu"]=="Highschool - SMA")?"selected":"";?>>Highschool - SMA</option>
															<option value="Junior Highschool - SMP" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && $data[$fam]["candidate_family_lastedu"]=="Junior Highschool - SMP")?"selected":"";?>>Junior Highschool - SMP</option>
															<option value="Elementary - SD" <?php echo (isset($data[$fam]["candidate_family_lastedu"]) && $data[$fam]["candidate_family_lastedu"]=="Elementary - SD")?"selected":"";?>>Elementary - SD</option>
														</select>									
													</div>								
													<label class="control-label col-md-2" for="candidate_family_rip">Status:</label>
													<div class="col-md-4" style="text-align:left;">
														<select class="form-control" name="candidate_family_rip[]">
															<option value="Alive" <?php echo (isset($data[$fam]["candidate_family_rip"]) && $data[$fam]["candidate_family_rip"]=="Alive")?"selected":"";?>>Alive</option>
															<option value="RIP" <?php echo (isset($data[$fam]["candidate_family_rip"]) && $data[$fam]["candidate_family_rip"]=="RIP")?"selected":"";?>>R.I.P</option>
														</select>
													</div>
												</div>
												
											</td>
											<td>
												<div class="top10">
												<a href='javascript:void(0);'  class='fam_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
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
												<label class="control-label col-md-2" for="candidate_family_name">Family name:</label>
												<div class="col-md-4">
													<input type="text" name="candidate_family_name[]" class="form-control">
												</div>
											
												<label class="control-label col-md-2" for="candidate_family_relation">Relation:</label>
												<div class="col-md-4">
													<select class="form-control" name="candidate_family_relation[]">
														<option value="">Choose relation</option>
														<option value="Father">Father</option>
														<option value="Mother">Mother</option>
														<option value="Spouse">Spouse</option>
														<option value="Brother">Brother</option>
														<option value="Sister">Sister</option>
														<option value="Son">Son</option>
														<option value="Daughter">Daughter</option>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<label class="control-label col-md-2" for="candidate_family_birthplace">Birth place:</label>
												<div class="col-md-4">
													<select class="form-control" name="candidate_family_birthplace[]">
														<option value="">Choose Kota / Kabupaten</option>
														<?php
														for($i=0;$i<count($datacity);$i++) {
														?>
														<option value="<?php echo $datacity[$i]["city_name"];?>"><?php echo $datacity[$i]["city_name"];?></option>
														<?php
														}
														?>
													</select>
												</div>
											
												<label class="control-label col-md-2" for="candidate_family_birthdate">Birth date:</label>
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
												<label class="control-label col-md-2" for="candidate_family_lastjob">Position:</label>
												<div class="col-md-4">
													<input type="text" name="candidate_family_lastjob[]" class="form-control">
												</div>
												<label class="control-label col-md-2" for="candidate_family_company">Company:</label>
												<div class="col-md-4">
													<input type="text" name="candidate_family_company[]" class="form-control">
												</div>
												
											</div>
											
											<div class="form-group bottom10">
												<label class="control-label col-md-2" for="candidate_family_lastedu">Education:</label>
												<div class="col-md-4">
													<select class="form-control" name="candidate_family_lastedu[]">
														<option value="">Latest Education</option>
														<option value="Post Doctoral">Post Doctoral</option>
														<option value="Doctoral - S3">Doctoral - S3</option>
														<option value="Master Degree - S2">Master Degree - S2</option>
														<option value="Bachelor Degree - S1">Bachelor Degree - S1</option>
														<option value="Diploma">Diploma</option>
														<option value="Highschool - SMA">Highschool - SMA</option>
														<option value="Junior Highschool - SMP">Junior Highschool - SMP</option>
														<option value="Elementary - SD">Elementary - SD</option>
													</select>									
												</div>								
												<label class="control-label col-md-2" for="candidate_family_rip">Status:</label>
												<div class="col-md-4" style="text-align:left;">
													<select class="form-control" name="candidate_family_rip[]">
														<option value="Alive">Alive</option>
														<option value="RIP">R.I.P</option>
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
						
						<input type="hidden" name="mod" value="admin_editFam"/>
						<input type="hidden" name="job_vacancy_id" value="<?php echo (isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";?>" />
						<input type="hidden" name="candidate_apply_stage" value="<?php echo (isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";?>" />
						<input type="hidden" name="candidate_id" value="<?php echo (isset($_GET["candidate_id"]))?decoded($_GET["candidate_id"]):"";?>" />
						<input type="hidden" name="menu_name" value="<?php echo (isset($_GET["menu_name"]))?$_GET["menu_name"]:"";?>" />
						
						
						<div class="form-group"> 
							<div class="col-md-offset-2 col-md-4">
								<button type="submit" class="btn btn-success">SAVE AND NEXT</button>
							</div>
						</div>
					</form>				
<?php
	}
}
?>