<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}
?>

<div class="bottom10 left10 right10">
	<div class="col-md-12"><?php echo system_showAlert();?></div>
	
	<div class="col-md-12">
		<form name="changepwdform" id="changepwdform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
				
		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="cpasswd" id="cpasswd"><i class="fa fa-key"></i></span>
				  <input type="password" name="curpasswd" id="curpasswd" class="form-control col-md-12 validate[required]" placeholder="Current password" aria-describedby="cpasswd">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="passwd" id="passwd"><i class="fa fa-key"></i></span>
				  <input type="password" name="newpass" id="newpass" class="form-control col-md-12 validate[required]" placeholder="New password" aria-describedby="passwd">
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="passwd2" id="passwd2"><i class="fa fa-key"></i></span>
				  <input type="password" name="newpass2" id="newpass2" class="form-control col-md-12 validate[required,equals[newpass]]" placeholder="Retype new password" aria-describedby="passwd2">
				</div>
			</div>
		</div>
				
		<div class="form-group bottom10">
			<div class="col-md-6">
				<div class="input-group">
				  <input type="hidden" name="mod" value="admin_changePassword">
				  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-sign-in fa-fw"></i> CHANGE PASSWORD</button>
				</div>
			</div>
		</div>


		</form>
	</div>
</div>
<!--
<script>
$(document).ready(function(){
    $("#changepwdform").validationEngine();
   });
</script>
-->