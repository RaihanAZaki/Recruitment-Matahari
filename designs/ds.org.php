<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

/*candidate_organization_id, candidate_id, candidate_organization_name, candidate_organization_role, candidate_organization_stillactive
*/
//echo "candidate_id ".$_SESSION["candidate_id"]."<br>";
$dataorg=getDataOrg();


$data=array();
for($i=0;$i<count($dataorg);$i++) {
// $data[$i]["candidate_organization_id"]=(isset($_SESSION["session"]["candidate_organization_id"][$i]) && $_SESSION["session"]["candidate_organization_id"][$i]<>"")?$_SESSION["session"]["candidate_organization_id"][$i]:(isset($dataorg[$i]["candidate_organization_id"]))?$dataorg[$i]["candidate_organization_id"]:"";
// $data[$i]["candidate_organization_name"]=(isset($_SESSION["session"]["candidate_organization_name"][$i]) && $_SESSION["session"]["candidate_organization_name"][$i]<>"")?$_SESSION["session"]["candidate_organization_name"][$i]:(isset($dataorg[$i]["candidate_organization_name"]))?$dataorg[$i]["candidate_organization_name"]:"";
// $data[$i]["candidate_organization_role"]=(isset($_SESSION["session"]["candidate_organization_role"][$i]) && $_SESSION["session"]["candidate_organization_role"][$i]<>"")?$_SESSION["session"]["candidate_organization_role"][$i]:(isset($dataorg[$i]["candidate_organization_role"]))?$dataorg[$i]["candidate_organization_role"]:"";
// $data[$i]["candidate_organization_start"]=(isset($_SESSION["session"]["candidate_organization_start"][$i]) && $_SESSION["session"]["candidate_organization_start"][$i]<>"")?$_SESSION["session"]["candidate_organization_start"][$i]:(isset($dataorg[$i]["candidate_organization_start"]))?$dataorg[$i]["candidate_organization_start"]:"";
// $data[$i]["candidate_organization_end"]=(isset($_SESSION["session"]["candidate_organization_end"][$i]) && $_SESSION["session"]["candidate_organization_end"][$i]<>"")?$_SESSION["session"]["candidate_organization_end"][$i]:(isset($dataorg[$i]["candidate_organization_end"]))?$dataorg[$i]["candidate_organization_end"]:"";
$data[$i]["candidate_organization_id"] = (isset($_SESSION["session"]["candidate_organization_id"][$i]) && $_SESSION["session"]["candidate_organization_id"][$i] != "") ? $_SESSION["session"]["candidate_organization_id"][$i] : (isset($dataorg[$i]["candidate_organization_id"]) ? $dataorg[$i]["candidate_organization_id"] : "");
$data[$i]["candidate_organization_name"] = (isset($_SESSION["session"]["candidate_organization_name"][$i]) && $_SESSION["session"]["candidate_organization_name"][$i] != "") ? $_SESSION["session"]["candidate_organization_name"][$i] : (isset($dataorg[$i]["candidate_organization_name"]) ? $dataorg[$i]["candidate_organization_name"] : "");
$data[$i]["candidate_organization_role"] = (isset($_SESSION["session"]["candidate_organization_role"][$i]) && $_SESSION["session"]["candidate_organization_role"][$i] != "") ? $_SESSION["session"]["candidate_organization_role"][$i] : (isset($dataorg[$i]["candidate_organization_role"]) ? $dataorg[$i]["candidate_organization_role"] : "");
$data[$i]["candidate_organization_start"] = (isset($_SESSION["session"]["candidate_organization_start"][$i]) && $_SESSION["session"]["candidate_organization_start"][$i] != "") ? $_SESSION["session"]["candidate_organization_start"][$i] : (isset($dataorg[$i]["candidate_organization_start"]) ? $dataorg[$i]["candidate_organization_start"] : "");
$data[$i]["candidate_organization_end"] = (isset($_SESSION["session"]["candidate_organization_end"][$i]) && $_SESSION["session"]["candidate_organization_end"][$i] != "") ? $_SESSION["session"]["candidate_organization_end"][$i] : (isset($dataorg[$i]["candidate_organization_end"]) ? $dataorg[$i]["candidate_organization_end"] : "");
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
		<h2 class="panel-title"><cufonize><i class="fa fa-graduation-cap"></i>&nbsp;Please list your Organizational experience(s).</cufonize></h2>
		<div class="caption_indo">Mohon tuliskan pengalaman organisasi Anda.</div>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">	

		<form name="orgform" id="orgform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data">
			 <div class="row clearfix">
				<div class="col-md-12 column">
					<table  class="table small-text" id="tb_org">
						<tr class="tr-header">
							<th>
								Organization Name
								<div class="caption_indo80 nopadding">Nama Organisasi</div>
							</th>
							<th>
								Start year
								<div class="caption_indo80 nopadding">Tahun mulai</div>
							</th>
							<th>
								End year
								<div class="caption_indo80 nopadding">Tahun selesai</div>
							</th>
							<th>
								Role
								<div class="caption_indo80 nopadding">Peran</div>								
							</th>
							<th><button type="button" class="btn btn-success btn-xs" id="org_add"><i class="fa fa-plus"></i> Add <i>(Tambah)</i></button></th>
						</tr>
						<tr style="display:none;">
							<td><input type="text" name="candidate_organization_name[]" class="form-control"></td>
							<td>
								<select name="candidate_organization_start[]" class="form-control">
									<?php
									for($y=date("Y", strtotime('-25 year'));$y<date("Y", strtotime('+1 year'));$y++) {
									?>	
									<option value="<?php echo $y;?>"><?php echo $y;?></option>
									<?php
									}
									?>
								</select>
							</td>
							<td>
								<select name="candidate_organization_end[]" class="form-control">
									<option value="active">Still Active</option>
									<?php
									for($y=date("Y", strtotime('-25 year'));$y<date("Y", strtotime('+1 year'));$y++) {
									?>	
									<option value="<?php echo $y;?>"><?php echo $y;?></option>
									<?php
									}
									?>									
								</select>
							</td>
							<td>
								<select name="candidate_organization_role[]" class="form-control">
									<option value="President">President</option>
									<option value="Vice President">Vice President</option>
									<option value="Officer">Officer</option>
									<option value="Member">Member</option>
								</select>
								<input type="hidden" name="candidate_organization_id[]" value="0">
							</td>
							<td><a href='javascript:void(0);'  class='org_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
						</tr>
						
						<?php
						if(isset($data) && count($data)>0) {
							for($org=0;$org<count($data);$org++) {
						?>
							<tr>
								<td><input type="text" name="candidate_organization_name[]" class="form-control" value="<?php echo (isset($data[$org]["candidate_organization_name"]) && $data[$org]["candidate_organization_name"]<>"")?$data[$org]["candidate_organization_name"]:"";?>"></td>
								<td>
									<select name="candidate_organization_start[]" class="form-control">
										<?php
										for($y=date("Y", strtotime('-25 year'));$y<date("Y", strtotime('+1 year'));$y++) {
										?>	
										<option value="<?php echo $y;?>" <?php echo (isset($data[$org]["candidate_organization_start"]) && $y==$data[$org]["candidate_organization_start"])?"selected":"";?>><?php echo $y;?></option>
										<?php
										}
										?>
									</select>
								</td>
								<td>
									<select name="candidate_organization_end[]" class="form-control">
										<option value="active" <?php echo (isset($data[$org]["candidate_organization_end"]) && $data[$org]["candidate_organization_end"]=="active")?"selected":"";?>>Still Active</option>
										<?php
										for($y=date("Y", strtotime('-25 year'));$y<date("Y", strtotime('+1 year'));$y++) {
										?>	
										<option value="<?php echo $y;?>" <?php echo (isset($data[$org]["candidate_organization_end"]) && $y==$data[$org]["candidate_organization_end"])?"selected":"";?>><?php echo $y;?></option>
										<?php
										}
										?>									
									</select>
								</td>
								<td>
									<select name="candidate_organization_role[]" class="form-control">
										<option value="President" <?php echo (isset($data[$org]["candidate_organization_role"]) && $data[$org]["candidate_organization_role"]=="President")?"selected":"";?>>President</option>
										<option value="Vice President" <?php echo (isset($data[$org]["candidate_organization_role"]) && $data[$org]["candidate_organization_role"]=="Vice President")?"selected":"";?>>Vice President</option>
										<option value="Officer" <?php echo (isset($data[$org]["candidate_organization_role"]) && $data[$org]["candidate_organization_role"]=="Officer")?"selected":"";?>>Officer</option>
										<option value="Member" <?php echo (isset($data[$org]["candidate_organization_role"]) && $data[$org]["candidate_organization_role"]=="Member")?"selected":"";?>>Member</option>
									</select>
									<input type="hidden" name="candidate_organization_id[]"  value="<?php echo $data[$org]["candidate_organization_id"];?>">
								</td>
								<td><a href='javascript:void(0);'  class='org_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
							</tr>
						<?php
							}
						}
						else {
						?>
						<tr>
							<td><input type="text" name="candidate_organization_name[]" class="form-control"></td>
							<td>
								<select name="candidate_organization_start[]" class="form-control">
									<?php
									for($y=date("Y", strtotime('-25 year'));$y<date("Y", strtotime('+1 year'));$y++) {
									?>	
									<option value="<?php echo $y;?>"><?php echo $y;?></option>
									<?php
									}
									?>
								</select>
							</td>
							<td>
								<select name="candidate_organization_end[]" class="form-control">
									<option value="active">Still Active</option>
									<?php
									for($y=date("Y", strtotime('-25 year'));$y<date("Y", strtotime('+1 year'));$y++) {
									?>	
									<option value="<?php echo $y;?>"><?php echo $y;?></option>
									<?php
									}
									?>									
								</select>
							</td>
							<td>
								<select name="candidate_organization_role[]" class="form-control">
									<option value="President">President</option>
									<option value="Vice President">Vice President</option>
									<option value="Officer">Officer</option>
									<option value="Member">Member</option>
								</select>
								<input type="hidden" name="candidate_organization_id[]" value="0">
							</td>
							<td><a href='javascript:void(0);'  class='org_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			
			<input type="hidden" name="mod" value="update_candidateOrg"/>
			
			
			<div class="form-group"> 
				<div class="col-md-4">
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