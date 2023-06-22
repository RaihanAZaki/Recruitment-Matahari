<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}


$databanner=admin_getBanner();
/*print_r($databanner);
exit;*/
?>
<div class="row bottom30">
				
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-picture-o"> &nbsp;Add Pictures for Banner</i></h2>
		</div>
					
		<div class="panel-body">
			<div><?php echo system_showAlert();?></div>
		
			<div class="col-md-12">
			
				<form name="addbanner" id="addbanner" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-md-5">
							<b>Requirements:</b>
							<ul>
								<li>Dimension 1000px * 200px (portrait).</li>
								<li>Image will be cropped if its dimension is bigger than 1000px * 200px.</li>
								<li>File in JPEG/JPG or PNG format, Maximum size is 500 KB</li>
							</ul>
						</div>
						<div class="col-md-1">
							<input type="hidden" name="mod" value="adm_addBanner">
							<input type="hidden" name="maxsize" value="512000">
							<input type="hidden" name="maxWidth" value="1000">
						</div>
						<div class="col-md-4"><input type="file" name="banner_name" class="form-control input-sm"></div>
						<div class="col-md-2"><input type="submit" class="btn btn-sm btn-success" value="SUBMIT"></div>
					</div>
				</form>
			
			</div>
		</div>
	</div>
		
		
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><i class="fa fa-picture-o"> &nbsp;List of Existing Pictures</i></h2>
		</div>
					
		<div class="panel-body">			
			<form name="editbanner" id="editbanner" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form" enctype="multipart/form-data">
				
				<div class="form-group">					
					<table class="table table-striped table-condensed">
						<thead>
							<tr>
								<td><b>Image</b></td>
								<td><b>Active</b></td>
							</tr>
						</thead>
						
						<tbody>
							<?php
							for($i=0;$i<count($databanner);$i++) {
								if(isset($databanner[$i]["banner_active"]) && $databanner[$i]["banner_active"]=="y") {
									$ischecked="checked";
								}
								else {
									$ischecked="";
								}
							?>
							<script>
							function checkBanner(j) {
								
								if (document.getElementById('chk_banner_' + j).checked) 
								  {
									  document.getElementById('banner_active_' + j).value = "y";
								  } 
								else {
									  document.getElementById('banner_active_' + j).value = "n";
								  }
							}
							</script>
							<tr>
								<td>
									<img src=<?php echo _IMAGEWEBPATH;?>/<?php echo $databanner[$i]["banner_name"];?> style="width:200px;">
									<input type="hidden" name="banner_id[]" id="banner_id_<?php echo $i;?>" value=<?php echo $databanner[$i]["banner_id"];?> >
									<input type="hidden" name="banner_active[]" id="banner_active_<?php echo $i;?>" value="<?php echo $databanner[$i]["banner_active"]; ?>">
								</td>
								<td><label><input class="validate[maxCheckbox[4]]" type="checkbox" id="chk_banner_<?php echo $i;?>" name="chk_banner[]" onClick="checkBanner(<?php echo $i;?>);" value="y" <?php echo $ischecked; ?> >Active</label></td>
							</tr>
							
							<?php
							}
							?>
							<tr>
								<td></td>
								<td align="left">
									<input type="hidden" name="mod" value="adm_editBanner">
									<input type="submit" class="btn btn-md btn-success" value="UPDATE" style="margin-right:30px;">
								</td>
							</tr>
						</tbody>
					</table>
				
				</div>
		
			</form>
		
		</div>
						
	</div>

</div>				
<script>
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#editbanner").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>