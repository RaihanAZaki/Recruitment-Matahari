<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}


$datahowto=admin_getHowTo();
//print_r($datahowto);
//print_r($dataapprover);exit;

	$data["howto_desc"]=(isset($datahowto[0]["howto_desc"]) && $datahowto[0]["howto_desc"]<>"")?$datahowto[0]["howto_desc"]:"";


//if(count($data)>0) $data=clean_view($data);

?>
<div class="row bottom30">

		<form name="updhowto" id="updhowto" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form" enctype="multipart/form-data" onsubmit="return postForm()>
			
			<div><?php echo system_showAlert();?></div>
			
			<div class="form-group">
				<div style="color:#FA9C0E; text-align:right;" class="col-md-12 top30"><i class="fa fa-exclamation-triangle warningsign"></i> <i><b>is required (mandatory field)</b></i> </div>
			</div>
					
			<div class="form-group">
				<label class="control-label col-md-3" for="howto_desc"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Job description :</label>
				<div class="col-md-9">
					<textarea class="form-control validate[required] summernote" name="howto_desc" id="howto_desc"><?php echo (isset($data["howto_desc"]) && $data["howto_desc"]<>"")?$data["howto_desc"]:"";?></textarea>
				</div>
			</div>
						
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9 top30">
					<input type="hidden" name="howto_id" value="<?php echo (isset($datahowto[0]["howto_id"]) && $datahowto[0]["howto_id"]<>"")?$datahowto[0]["howto_id"]:"";?>">
					<input type="hidden" name="mod" value="adm_updateHowTo">
					<input type="submit" class="btn btn-md btn-success" value="UPDATE" style="margin-right:30px;">
				</div>
			</div>
			
			
		</form>

<script type="text/javascript">
$(document).ready(function() {
	$('.summernote').summernote({
		height: "500px"
	});
});
var postForm = function() {
	var content = $('textarea[name="howto_desc"]').html($('.summernote').code());
}
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#updhowto").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>
