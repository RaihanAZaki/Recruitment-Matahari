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
			$dataskills=admin_getDataSkills(decoded($_GET["candidate_id"]));


			$data=array();
			for($i=0;$i<count($dataskills);$i++) {
				$data[$i]["candidate_skill_id"] = (isset($_SESSION["session"]["candidate_skill_id"][$i]) && $_SESSION["session"]["candidate_skill_id"][$i] <> "")
				? $_SESSION["session"]["candidate_skill_id"][$i]
				: (isset($dataskills[$i]["candidate_skill_id"]) ? $dataskills[$i]["candidate_skill_id"] : "");
			  
			  $data[$i]["candidate_skill_name"] = (isset($_SESSION["session"]["candidate_skill_name"][$i]) && $_SESSION["session"]["candidate_skill_name"][$i] <> "")
				? $_SESSION["session"]["candidate_skill_name"][$i]
				: (isset($dataskills[$i]["candidate_skill_name"]) ? $dataskills[$i]["candidate_skill_name"] : "");
			  
			  $data[$i]["candidate_skill_level"] = (isset($_SESSION["session"]["candidate_skill_level"][$i]) && $_SESSION["session"]["candidate_skill_level"][$i] <> "")
				? $_SESSION["session"]["candidate_skill_level"][$i]
				: (isset($dataskills[$i]["candidate_skill_level"]) ? $dataskills[$i]["candidate_skill_level"] : "");
			  
			  $data[$i]["candidate_skill_notes"] = (isset($_SESSION["session"]["candidate_skill_notes"][$i]) && $_SESSION["session"]["candidate_skill_notes"][$i] <> "")
				? $_SESSION["session"]["candidate_skill_notes"][$i]
				: (isset($dataskills[$i]["candidate_skill_notes"]) ? $dataskills[$i]["candidate_skill_notes"] : "");
			  
			}
			/*
			print_r($data);
			exit;
			*/
			if(count($data)>0) $data=clean_view($data);
			?>
<script>
$(function(){
    $('#skills_add').on('click', function() {
              var data = $("#tb_skills tr:eq(1)").clone(true).show().appendTo("#tb_skills");
              data.find("input").val('');
     });
     $(document).on('click', '.skills_rem', function() {
         var trIndex = $(this).closest("tr").index();
            $(this).closest("tr").remove();
      });
});
</script>			
					<div class="bottom30">&nbsp;</div>

					<div><?php echo system_showAlert();?></div>
				
					<form name="orgskills" id="orgskills" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data">
						 <div class="row clearfix">
							<div class="col-md-12 column">
								<table  class="table small-text" id="tb_skills">
									<tr class="tr-header">
										<th>Skills Name</th>
										<th>Level</th>
										<th>Notes</th>
										<th><button type="button" class="btn btn-success btn-xs" id="skills_add"><i class="fa fa-plus"></i> Add</button></th>
									</tr>
									<tr style="display:none;">
										<td><input type="text" name="candidate_skill_name[]" class="form-control"></td>
										<td>
											<select name="candidate_skill_level[]" class="form-control">
												<option value="Beginner">Beginner</option>
												<option value="Intermediate">Intermediate</option>
												<option value="Advance">Advance</option>
												<option value="Master">Master</option>
											</select>
										</td>
										<td>
											<textarea class="form-control" style="width:100%;"  name="candidate_skill_notes[]" placeholder="Describe about your skills" title="Describe about your skills"></textarea>
											<input type="hidden" name="candidate_skill_id[]" value="0">
										</td>
										<td><a href='javascript:void(0);'  class='skills_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
									</tr>
									
									<?php
									if(isset($data) && count($data)>0) {
										for($sk=0;$sk<count($data);$sk++) {
									?>
										<tr>
											<td><input type="text" name="candidate_skill_name[]" class="form-control" value="<?php echo (isset($data[$sk]["candidate_skill_name"]) && $data[$sk]["candidate_skill_name"]<>"")?$data[$sk]["candidate_skill_name"]:"";?>"></td>
											<td>
												<select name="candidate_skill_level[]" class="form-control">
													<option value="Beginner" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Beginner")?"selected":"";?>>Beginner</option>
													<option value="Intermediate" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Intermediate")?"selected":"";?>>Intermediate</option>
													<option value="Advance" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Advance")?"selected":"";?>>Advance</option>
													<option value="Master" <?php echo (isset($data[$sk]["candidate_skill_level"]) && $data[$sk]["candidate_skill_level"]=="Master")?"selected":"";?>>Master</option>
												</select>
											</td>
											<td>
												<textarea class="form-control" style="width:100%;"  name="candidate_skill_notes[]" placeholder="Describe about your skills" title="Describe about your skills"><?php echo (isset($data[$sk]["candidate_skill_notes"]) && $data[$sk]["candidate_skill_notes"]<>"")?$data[$sk]["candidate_skill_notes"]:"";?></textarea>
												<input type="hidden" name="candidate_skill_id[]" value="<?php echo $data[$sk]["candidate_skill_id"];?>">
											</td>
											<td><a href='javascript:void(0);'  class='skills_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
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
													<option value="Beginner">Beginner</option>
													<option value="Intermediate">Intermediate</option>
													<option value="Advance">Advance</option>
													<option value="Master">Master</option>
												</select>
											</td>
											<td>
												<textarea class="form-control" style="width:100%;"  name="candidate_skill_notes[]" placeholder="Describe about your skills" title="Describe about your skills"></textarea>
												<input type="hidden" name="candidate_skill_id[]" value="0">
											</td>
											<td><a href='javascript:void(0);'  class='skills_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
										</tr>
									<?php
									}
									?>
								</table>
							</div>
						</div>
			
						<input type="hidden" name="mod" value="admin_editSkill"/>
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