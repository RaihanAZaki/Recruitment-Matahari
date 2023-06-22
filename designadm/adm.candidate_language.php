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
			$datalang=admin_getDataLanguage(decoded($_GET["candidate_id"]));


			$data=array();
			for($i=0;$i<count($datalang);$i++) {
			
				$data[$i]["candidate_language_id"]=(isset($_SESSION["session"]["candidate_language_id"][$i]) && $_SESSION["session"]["candidate_language_id"][$i]<>"")?$_SESSION["session"]["candidate_language_id"][$i]:((isset($datalang[$i]["candidate_language_id"]))?$datalang[$i]["candidate_language_id"]:"");
			
				$data[$i]["candidate_language_name"]=(isset($_SESSION["session"]["candidate_language_name"][$i]) && $_SESSION["session"]["candidate_language_name"][$i]<>"")?$_SESSION["session"]["candidate_language_name"][$i]:((isset($datalang[$i]["candidate_language_name"]))?$datalang[$i]["candidate_language_name"]:"");
			
				$data[$i]["candidate_language_read"]=(isset($_SESSION["session"]["candidate_language_read"][$i]) && $_SESSION["session"]["candidate_language_read"][$i]<>"")?$_SESSION["session"]["candidate_language_read"][$i]:((isset($datalang[$i]["candidate_language_read"]))?$datalang[$i]["candidate_language_read"]:"");
			
				$data[$i]["candidate_language_write"]=(isset($_SESSION["session"]["candidate_language_write"][$i]) && $_SESSION["session"]["candidate_language_write"][$i]<>"")?$_SESSION["session"]["candidate_language_write"][$i]:((isset($datalang[$i]["candidate_language_write"]))?$datalang[$i]["candidate_language_write"]:"");
			
				$data[$i]["candidate_language_conversation"]=(isset($_SESSION["session"]["candidate_language_conversation"][$i]) && $_SESSION["session"]["candidate_language_conversation"][$i]<>"")?$_SESSION["session"]["candidate_language_conversation"][$i]:((isset($datalang[$i]["candidate_language_conversation"]))?$datalang[$i]["candidate_language_conversation"]:"");
			}
			/*
			print_r($data);
			exit;
			*/
			if(count($data)>0) $data=clean_view($data);
			?>
<script>
$(function(){
    $('#lang_add').on('click', function() {
              var data = $("#tb_lang tr:eq(1)").clone(true).show().appendTo("#tb_lang");
              data.find("input").val('');
     });
     $(document).on('click', '.lang_rem', function() {
         var trIndex = $(this).closest("tr").index();
            
             $(this).closest("tr").remove();
      });
});
</script>			
					<div class="bottom30">&nbsp;</div>

			
					<div><?php echo system_showAlert();?></div>
				
					<form name="langskills" id="langskills" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data">
						 <div class="row clearfix">
							<div class="col-md-12 column">
								<table  class="table small-text" id="tb_lang">
									<tr class="tr-header">
										<th>Language</th>
										<th>Reading</th>
										<th>Writing</th>
										<th>Conversation</th>
										<th><button type="button" class="btn btn-success btn-xs" id="lang_add"><i class="fa fa-plus"></i> Add</button></th>
									</tr>
									<tr style="display:none;">
										<td><input type="text" name="candidate_language_name[]" class="form-control"></td>
										<td>
											<select name="candidate_language_read[]" class="form-control">
												<option value="Beginner">Beginner</option>
												<option value="Elementary">Elementary</option>
												<option value="Intermediate">Intermediate</option>
												<option value="Upper Intermediate">Upper Intermediate</option>
												<option value="Advance">Advance</option>
												<option value="Master">Master</option>
											</select>
										</td>
										<td>
											<select name="candidate_language_write[]" class="form-control">
												<option value="Beginner">Beginner</option>
												<option value="Elementary">Elementary</option>
												<option value="Intermediate">Intermediate</option>
												<option value="Upper Intermediate">Upper Intermediate</option>
												<option value="Advance">Advance</option>
												<option value="Master">Master</option>
											</select>
										</td>
										<td>
											<select name="candidate_language_conversation[]" class="form-control">
												<option value="Beginner">Beginner</option>
												<option value="Elementary">Elementary</option>
												<option value="Intermediate">Intermediate</option>
												<option value="Upper Intermediate">Upper Intermediate</option>
												<option value="Advance">Advance</option>
												<option value="Master">Master</option>
											</select>
											<input type="hidden" name="candidate_language_id[]" value="0">
										</td>
										<td><a href='javascript:void(0);'  class='lang_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
									</tr>
									
									<?php
									if(isset($data) && count($data)>0) {
										for($l=0;$l<count($data);$l++) {
									?>
										<tr>
											<td><input type="text" name="candidate_language_name[]" class="form-control" value="<?php echo (isset($data[$l]["candidate_language_name"]) && $data[$l]["candidate_language_name"]<>"")?$data[$l]["candidate_language_name"]:"";?>"></td>
											<td>
												<select name="candidate_language_read[]" class="form-control">
													<option value="Beginner" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Beginner")?"selected":"";?>>Beginner</option>
													<option value="Elementary" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Elementary")?"selected":"";?>>Elementary</option>
													<option value="Intermediate" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Intermediate")?"selected":"";?>>Intermediate</option>
													<option value="Upper Intermediate" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Upper Intermediate")?"selected":"";?>>Upper Intermediate</option>
													<option value="Advance" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Advance")?"selected":"";?>>Advance</option>
													<option value="Master" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Master")?"selected":"";?>>Master</option>
												</select>
											</td>
											<td>
												<select name="candidate_language_write[]" class="form-control">
													<option value="Beginner" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Beginner")?"selected":"";?>>Beginner</option>
													<option value="Elementary" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Elementary")?"selected":"";?>>Elementary</option>
													<option value="Intermediate" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Intermediate")?"selected":"";?>>Intermediate</option>
													<option value="Upper Intermediate" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Upper Intermediate")?"selected":"";?>>Upper Intermediate</option>
													<option value="Advance" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Advance")?"selected":"";?>>Advance</option>
													<option value="Master" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Master")?"selected":"";?>>Master</option>
												</select>
											</td>								
											<td>
												<select name="candidate_language_conversation[]" class="form-control">
													<option value="Beginner" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Beginner")?"selected":"";?>>Beginner</option>
													<option value="Elementary" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Elementary")?"selected":"";?>>Elementary</option>
													<option value="Intermediate" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Intermediate")?"selected":"";?>>Intermediate</option>
													<option value="Upper Intermediate" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Upper Intermediate")?"selected":"";?>>Upper Intermediate</option>
													<option value="Advance" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Advance")?"selected":"";?>>Advance</option>
													<option value="Master" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Master")?"selected":"";?>>Master</option>
												</select>
												<input type="hidden" name="candidate_language_id[]" value="<?php echo $data[$l]["candidate_language_id"]?>">
											</td>
											<td><a href='javascript:void(0);'  class='lang_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
										</tr>
									<?php
										}
									}
									else {
									?>
										<tr>
											<td><input type="text" name="candidate_language_name[]" class="form-control"></td>
											<td>
												<select name="candidate_language_read[]" class="form-control">
													<option value="Beginner">Beginner</option>
													<option value="Elementary">Elementary</option>
													<option value="Intermediate">Intermediate</option>
													<option value="Upper Intermediate">Upper Intermediate</option>
													<option value="Advance">Advance</option>
													<option value="Master">Master</option>
												</select>
											</td>
											<td>
												<select name="candidate_language_write[]" class="form-control">
													<option value="Beginner">Beginner</option>
													<option value="Elementary">Elementary</option>
													<option value="Intermediate">Intermediate</option>
													<option value="Upper Intermediate">Upper Intermediate</option>
													<option value="Advance">Advance</option>
													<option value="Master">Master</option>
												</select>
											</td>
											<td>
												<select name="candidate_language_conversation[]" class="form-control">
													<option value="Beginner">Beginner</option>
													<option value="Elementary">Elementary</option>
													<option value="Intermediate">Intermediate</option>
													<option value="Upper Intermediate">Upper Intermediate</option>
													<option value="Advance">Advance</option>
													<option value="Master">Master</option>
												</select>
												<input type="hidden" name="candidate_language_id[]" value="0">
											</td>
											<td><a href='javascript:void(0);'  class='lang_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
										</tr>
									<?php
									}
									?>
								</table>
							</div>
						</div>
						
						<input type="hidden" name="mod" value="admin_editLang"/>
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