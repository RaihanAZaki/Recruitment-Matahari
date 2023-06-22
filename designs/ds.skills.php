<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

/*candidate_skill_id, candidate_id, candidate_skill_name, candidate_skill_level, candidate_skill_notes
*/
//echo "candidate_id ".$_SESSION["candidate_id"]."<br>";
$dataskills=getDataSkills();


$data=array();
for($i=0;$i<count($dataskills);$i++) {
// $data[$i]["candidate_skill_id"]=(isset($_SESSION["session"]["candidate_skill_id"][$i]) && $_SESSION["session"]["candidate_skill_id"][$i]<>"")?$_SESSION["session"]["candidate_skill_id"][$i]:(isset($dataskills[$i]["candidate_skill_id"]))?$dataskills[$i]["candidate_skill_id"]:"";
// $data[$i]["candidate_skill_name"]=(isset($_SESSION["session"]["candidate_skill_name"][$i]) && $_SESSION["session"]["candidate_skill_name"][$i]<>"")?$_SESSION["session"]["candidate_skill_name"][$i]:(isset($dataskills[$i]["candidate_skill_name"]))?$dataskills[$i]["candidate_skill_name"]:"";
// $data[$i]["candidate_skill_level"]=(isset($_SESSION["session"]["candidate_skill_level"][$i]) && $_SESSION["session"]["candidate_skill_level"][$i]<>"")?$_SESSION["session"]["candidate_skill_level"][$i]:(isset($dataskills[$i]["candidate_skill_level"]))?$dataskills[$i]["candidate_skill_level"]:"";
// $data[$i]["candidate_skill_notes"]=(isset($_SESSION["session"]["candidate_skill_notes"][$i]) && $_SESSION["session"]["candidate_skill_notes"][$i]<>"")?$_SESSION["session"]["candidate_skill_notes"][$i]:(isset($dataskills[$i]["candidate_skill_notes"]))?$dataskills[$i]["candidate_skill_notes"]:"";
$data[$i]["candidate_skill_id"] = (isset($_SESSION["session"]["candidate_skill_id"][$i]) && $_SESSION["session"]["candidate_skill_id"][$i] != "") ? $_SESSION["session"]["candidate_skill_id"][$i] : (isset($dataskills[$i]["candidate_skill_id"]) ? $dataskills[$i]["candidate_skill_id"] : "");
$data[$i]["candidate_skill_name"] = (isset($_SESSION["session"]["candidate_skill_name"][$i]) && $_SESSION["session"]["candidate_skill_name"][$i] != "") ? $_SESSION["session"]["candidate_skill_name"][$i] : (isset($dataskills[$i]["candidate_skill_name"]) ? $dataskills[$i]["candidate_skill_name"] : "");
$data[$i]["candidate_skill_level"] = (isset($_SESSION["session"]["candidate_skill_level"][$i]) && $_SESSION["session"]["candidate_skill_level"][$i] != "") ? $_SESSION["session"]["candidate_skill_level"][$i] : (isset($dataskills[$i]["candidate_skill_level"]) ? $dataskills[$i]["candidate_skill_level"] : "");
$data[$i]["candidate_skill_notes"] = (isset($_SESSION["session"]["candidate_skill_notes"][$i]) && $_SESSION["session"]["candidate_skill_notes"][$i] != "") ? $_SESSION["session"]["candidate_skill_notes"][$i] : (isset($dataskills[$i]["candidate_skill_notes"]) ? $dataskills[$i]["candidate_skill_notes"] : "");
}
/*
print_r($data);
exit;
*/
if(count($data)>0) $data=clean_view($data);
?>
<div><?php echo system_showAlert();?></div>

<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-trophy"></i>&nbsp;Please list your Skill(s).</cufonize></h2>
		<div class="caption_indo">Mohon tuliskan keahlian dan ketrampilan yang Anda kuasai.</div>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">
	
		<form name="orgskills" id="orgskills" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data">
			 <div class="row clearfix">
				<div class="col-md-12 column">
					<table  class="table small-text" id="tb_skills">
						<tr class="tr-header">
							<th>
								Skills Name
								<div class="caption_indo80 nopadding">Nama Ketrampilan</div>
							</th>
							<th>
								Level
								<div class="caption_indo80 nopadding">Tingkat</div>
							</th>
							<th>
								Notes
								<div class="caption_indo80 nopadding">Keterangan</div>
							</th>
							<th><button type="button" class="btn btn-success btn-xs" id="skills_add"><i class="fa fa-plus"></i> Add / Tambah</button></th>
						</tr>
						<tr style="display:none;">
							<td><input type="text" name="candidate_skill_name[]" class="form-control"></td>
							<td>
								<select name="candidate_skill_level[]" class="form-control">
									<option value="Beginner">Beginner / Pemula</option>
									<option value="Intermediate">Intermediate / Menengah</option>
									<option value="Advance">Advance / Tingkat Lanjut</option>
									<option value="Master">Master / Ahli</option>
								</select>
							</td>
							<td>
								<textarea class="form-control" style="width:100%;"  name="candidate_skill_notes[]" placeholder="Describe about your skills" title="Describe about your skills"></textarea>
								<input type="hidden" name="candidate_skill_id[]" value="0">
							</td>
							<td><a href='javascript:void(0);'  class='skills_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
						</tr>
						
						<?php
						if(isset($data) && count($data)>0) {
							for($sk=0;$sk<count($data);$sk++) {
						?>
							<tr>
								<td><input type="text" name="candidate_skill_name[]" class="form-control" value="<?php echo (isset($data[$sk]["candidate_skill_name"]) && $data[$sk]["candidate_skill_name"]<>"")?$data[$sk]["candidate_skill_name"]:"";?>"></td>
								<td>
									<select name="candidate_skill_level[]" class="form-control">
										<option value="Beginner" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Beginner")?"selected":"";?>>Beginner / Pemula</option>
										<option value="Intermediate" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Intermediate")?"selected":"";?>>Intermediate / Menengah</option>
										<option value="Advance" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Advance")?"selected":"";?>>Advance / Tingkat Lanjut</option>
										<option value="Master" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Master")?"selected":"";?>>Master / Ahli</option>
									</select>
								</td>
								<td>
									<textarea class="form-control" style="width:100%;"  name="candidate_skill_notes[]" placeholder="Describe about your skills" title="Describe about your skills"><?php echo (isset($data[$sk]["candidate_skill_notes"]) && $data[$sk]["candidate_skill_notes"]<>"")?$data[$sk]["candidate_skill_notes"]:"";?></textarea>
									<input type="hidden" name="candidate_skill_id[]" value="<?php echo $data[$sk]["candidate_skill_id"];?>">
								</td>
								<td><a href='javascript:void(0);'  class='skills_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
							</tr>
						<?php
							}
						}
						else {
						?>
							<tr>
								<td><input type="text" name="candidate_skill_name[]" class="form-control"></td>
								<td>
									<select name="candidate_skill_level[]" class="form-control">
										<option value="Beginner">Beginner / Pemula</option>
										<option value="Intermediate">Intermediate / Menengah</option>
										<option value="Advance">Advance / Tingkat Lanjut</option>
										<option value="Master">Master / Ahli</option>
									</select>
								</td>
								<td>
									<textarea class="form-control" style="width:100%;"  name="candidate_skill_notes[]" placeholder="Describe about your skills" title="Describe about your skills"></textarea>
									<input type="hidden" name="candidate_skill_id[]" value="0">
								</td>
								<td><a href='javascript:void(0);'  class='skills_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			
			<input type="hidden" name="mod" value="update_candidateSkill"/>
			
			
			<div class="form-group"> 
				<div class="col-md-4">
					<button type="submit" class="btn btn-success">SAVE ( SIMPAN )</button>
				</div>
			</div>
		</form>				
	</div>
	<!-- akhir panel body -->
	
</div>