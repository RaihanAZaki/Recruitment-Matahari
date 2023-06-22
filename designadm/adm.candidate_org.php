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
			$dataorg=admin_getDataOrg(decoded($_GET["candidate_id"]));


			$data=array();
			for($i=0;$i<count($dataorg);$i++) {
			// $data[$i]["candidate_organization_id"]=(isset($_SESSION["session"]["candidate_organization_id"][$i]) && $_SESSION["session"]["candidate_organization_id"][$i]<>"")?$_SESSION["session"]["candidate_organization_id"][$i]:(isset($dataorg[$i]["candidate_organization_id"]))?$dataorg[$i]["candidate_organization_id"]:"";
			// $data[$i]["candidate_organization_name"]=(isset($_SESSION["session"]["candidate_organization_name"][$i]) && $_SESSION["session"]["candidate_organization_name"][$i]<>"")?$_SESSION["session"]["candidate_organization_name"][$i]:(isset($dataorg[$i]["candidate_organization_name"]))?$dataorg[$i]["candidate_organization_name"]:"";
			// $data[$i]["candidate_organization_role"]=(isset($_SESSION["session"]["candidate_organization_role"][$i]) && $_SESSION["session"]["candidate_organization_role"][$i]<>"")?$_SESSION["session"]["candidate_organization_role"][$i]:(isset($dataorg[$i]["candidate_organization_role"]))?$dataorg[$i]["candidate_organization_role"]:"";
			// $data[$i]["candidate_organization_start"]=(isset($_SESSION["session"]["candidate_organization_start"][$i]) && $_SESSION["session"]["candidate_organization_start"][$i]<>"")?$_SESSION["session"]["candidate_organization_start"][$i]:(isset($dataorg[$i]["candidate_organization_start"]))?$dataorg[$i]["candidate_organization_start"]:"";
			// $data[$i]["candidate_organization_end"]=(isset($_SESSION["session"]["candidate_organization_end"][$i]) && $_SESSION["session"]["candidate_organization_end"][$i]<>"")?$_SESSION["session"]["candidate_organization_end"][$i]:(isset($dataorg[$i]["candidate_organization_end"]))?$dataorg[$i]["candidate_organization_end"]:"";
			$data[$i]["candidate_organization_id"] = (isset($_SESSION["session"]["candidate_organization_id"][$i]) && $_SESSION["session"]["candidate_organization_id"][$i] <> "") ? $_SESSION["session"]["candidate_organization_id"][$i] : ((isset($dataorg[$i]["candidate_organization_id"])) ? $dataorg[$i]["candidate_organization_id"] : "");
			$data[$i]["candidate_organization_name"] = (isset($_SESSION["session"]["candidate_organization_name"][$i]) && $_SESSION["session"]["candidate_organization_name"][$i] <> "") ? $_SESSION["session"]["candidate_organization_name"][$i] : ((isset($dataorg[$i]["candidate_organization_name"])) ? $dataorg[$i]["candidate_organization_name"] : "");
			$data[$i]["candidate_organization_role"] = (isset($_SESSION["session"]["candidate_organization_role"][$i]) && $_SESSION["session"]["candidate_organization_role"][$i] <> "") ? $_SESSION["session"]["candidate_organization_role"][$i] : ((isset($dataorg[$i]["candidate_organization_role"])) ? $dataorg[$i]["candidate_organization_role"] : "");
			$data[$i]["candidate_organization_start"] = (isset($_SESSION["session"]["candidate_organization_start"][$i]) && $_SESSION["session"]["candidate_organization_start"][$i] <> "") ? $_SESSION["session"]["candidate_organization_start"][$i] : ((isset($dataorg[$i]["candidate_organization_start"])) ? $dataorg[$i]["candidate_organization_start"] : "");
			$data[$i]["candidate_organization_end"] = (isset($_SESSION["session"]["candidate_organization_end"][$i]) && $_SESSION["session"]["candidate_organization_end"][$i] <> "") ? $_SESSION["session"]["candidate_organization_end"][$i] : ((isset($dataorg[$i]["candidate_organization_end"])) ? $dataorg[$i]["candidate_organization_end"] : "");

			}
			/*
			print_r($data);
			exit;
			*/
			if(count($data)>0) $data=clean_view($data);
			?>
<script>
$(function(){
    $('#org_add').on('click', function() {
              var data = $("#tb_org tr:eq(1)").clone(true).show().appendTo("#tb_org");
              data.find("input").val('');
     });
     $(document).on('click', '.org_rem', function() {
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

					<form name="orgform" id="orgform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data">
						 <div class="row clearfix">
							<div class="col-md-12 column">
								<table  class="table small-text" id="tb_org">
									<tr class="tr-header">
										<th>Organization Name</th>
										<th>Start year</th>
										<th>End year</th>
										<th>Role</th>
										<th><button type="button" class="btn btn-success btn-xs" id="org_add"><i class="fa fa-plus"></i> Add</button></th>
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
										<td><a href='javascript:void(0);'  class='org_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
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
											<td><a href='javascript:void(0);'  class='org_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
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
										<td><a href='javascript:void(0);'  class='org_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
									</tr>
									<?php
									}
									?>
								</table>
							</div>
						</div>
						
						<input type="hidden" name="mod" value="admin_editOrg"/>
						<input type="hidden" name="job_vacancy_id" value="<?php echo (isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";?>" />
						<input type="hidden" name="candidate_apply_stage" value="<?php echo (isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";?>" />
						<input type="hidden" name="candidate_id" value="<?php echo (isset($_GET["candidate_id"]))?decoded($_GET["candidate_id"]):"";?>" />
						<input type="hidden" name="menu_name" value="<?php echo (isset($_GET["menu_name"]))?$_GET["menu_name"]:"";?>" />
						
						<div class="form-group"> 
							<div class="col-md-4">
								<button type="submit" class="btn btn-success">SAVE AND NEXT</button>
							</div>
						</div>
					</form>				
<?php
	}
}
?>