<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || $_SESSION["priv_id"]<>"admin" ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.forbiddenpage.php");
	exit;
}

$array_role=array("candid","pic","admin","hrd");
$array_status=array("active","inactive");

$datauser=(isset($_GET["log_auth_id"]) && $_GET["log_auth_id"]<>"")?admin_getEmployee("",decoded($_GET["log_auth_id"])):"";
//echo $_GET["type"]."<br>";
$type=(isset($_GET["type"]) && $_GET["type"]=="edit")?"edit":"add";

$log_auth_role=(isset($_GET["view"]) && $_GET["view"]<>"")?decoded($_GET["view"]):"open";
$page=(isset($_GET["page"]) && $_GET["page"]<>"")?$_GET["page"]:"1";

$datadivision=admin_getDivision();

//print_r($datauser);

//print_r($_SESSION);

/* log_auth_id, employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, 
register_activation_code, register_activation_date, status_id, user_insert, date_insert, user_update, date_update
 */

//echo "type= ".$type;exit;

if($type=="edit") {
	$data["log_auth_id"]=(isset($datauser[0]["log_auth_id"]) && $datauser[0]["log_auth_id"]<>"")?$datauser[0]["log_auth_id"]:"";
	$data["log_auth_name"]=(isset($datauser[0]["log_auth_name"]) && $datauser[0]["log_auth_name"]<>"")?$datauser[0]["log_auth_name"]:"";
	$data["log_auth_role"]=(isset($datauser[0]["log_auth_role"]) && $datauser[0]["log_auth_role"]<>"")?$datauser[0]["log_auth_role"]:"";
	$data["status_id"]=(isset($datauser[0]["status_id"]) && $datauser[0]["status_id"]<>"")?$datauser[0]["status_id"]:"";
	$data["employee_name"]=(isset($datauser[0]["employee_name"]) && $datauser[0]["employee_name"]<>"")?$datauser[0]["employee_name"]:"";
	$data["division_id"]=(isset($datauser[0]["division_id"]) && $datauser[0]["division_id"]<>"")?$datauser[0]["division_id"]:"";
	$data["employee_nik"]=(isset($datauser[0]["employee_nik"]) && $datauser[0]["employee_nik"]<>"")?$datauser[0]["employee_nik"]:"";
	$data["employee_id"]=(isset($datauser[0]["employee_id"]) && $datauser[0]["employee_id"]<>"")?$datauser[0]["employee_id"]:"";
}
else {
	$data["log_auth_name"]=(isset($_SESSION["session"]["log_auth_name"]) && $_SESSION["session"]["log_auth_name"]<>"")?$_SESSION["session"]["log_auth_name"]:"";
	$data["log_auth_role"]=(isset($_SESSION["session"]["log_auth_role"]) && $_SESSION["session"]["log_auth_role"]<>"")?$_SESSION["session"]["log_auth_role"]:"";	
	$data["status_id"]=(isset($_SESSION["session"]["status_id"]) && $_SESSION["session"]["status_id"]<>"")?$_SESSION["session"]["status_id"]:"";	
	$data["employee_name"]=(isset($_SESSION["session"]["employee_name"]) && $_SESSION["session"]["employee_name"]<>"")?$_SESSION["session"]["employee_name"]:"";
	$data["division_id"]=(isset($_SESSION["session"]["division_id"]) && $_SESSION["session"]["division_id"]<>"")?$_SESSION["session"]["division_id"]:"";
	$data["employee_nik"]=(isset($_SESSION["session"]["employee_nik"]) && $_SESSION["session"]["employee_nik"]<>"")?$_SESSION["session"]["employee_nik"]:"";
	$data["employee_id"]=(isset($_SESSION["session"]["employee_id"]) && $_SESSION["session"]["employee_id"]<>"")?$_SESSION["session"]["employee_id"]:"";
}

//print_r($data);

if(count($data)>0) $data=clean_view($data);

?>
<div class="row bottom30">

<!-- 
	m_employee: division_id, employee_name, employee_nik, employee_email, status_id 
	log_auth:	employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, 
				register_id, register_date, register_activation_code, register_activation_date
-->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label-control"><i class="fa fa-user"> &nbsp;<?php echo ($type=="edit")?"Edit":"Add";?> &nbsp; <?php echo ($type=="edit" && $data["employee_name"])?": ".$data["employee_name"]:"";?></i></span>
	</div>
	
	<div class="panel-body">
		<form name="upduser" id="upduser" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
			
			<div><?php echo system_showAlert();?></div>
			
			<div class="form-group">
				<div style="color:#FA9C0E; text-align:right;" class="col-md-12 top30"><i class="fa fa-exclamation-triangle warningsign"></i> <i><b>is required (mandatory field)</b></i> </div>
			</div>
		
			<div class="form-group">
				<label class="control-label col-md-3" for="employee_name"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Employee name :</label>
				<div class="col-md-6 bottom10">
						<input type="text" name="employee_name" id="employee_name" class="form-control validate[required]" value="<?php echo (isset($data["employee_name"]) && $data["employee_name"]<>"")?$data["employee_name"]:"";?>" >
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3" for="employee_nik"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> NIK / Barcode :</label>
				<div class="col-md-6 bottom10">
						<input type="text" name="employee_nik" id="employee_nik" class="form-control validate[required]" value="<?php echo (isset($data["employee_nik"]) && $data["employee_nik"]<>"")?$data["employee_nik"]:"";?>" <?php echo (isset($type) && $type=="edit")?"readonly":"";?> >
				</div>
			</div>
				
			
			<div class="form-group">
				<label class="control-label col-md-3" for="v_city"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Email :</label>
				<div class="col-md-6 bottom10">
						<input type="text" name="log_auth_name" id="log_auth_name" class="form-control validate[required, custom[email]]" value="<?php echo (isset($data["log_auth_name"]) && $data["log_auth_name"]<>"")?$data["log_auth_name"]:"";?>" <?php echo (isset($type) && $type=="edit")?"readonly":"";?> >
						<small class="text-muted"><i>( e-mail will be use as user id for login purpose )</i></small>
				</div>
			</div>
						
			<div class="form-group">
				<label class="control-label col-sm-3" for="log_auth_role"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Role :</label>
				<div class="col-sm-3">
					<select class="form-control validate[required]" name="log_auth_role" id="log_auth_role">
						<option value="">Choose role</option>
						<?php
						for($i=0;$i<count($array_role);$i++) {
						?>
						<option value="<?php echo $array_role[$i];?>" <?php echo (isset($data["log_auth_role"]) && $array_role[$i]==$data["log_auth_role"])?"selected":"";?> ><?php echo showRoleName($array_role[$i]);?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-3" for="division_id"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Division :</label>
				<div class="col-sm-4">
					<select class="form-control" name="division_id" id="division_id">
						<option value="">Choose division</option>
						<?php
						for($d=0;$d<count($datadivision);$d++) {
						?>
						<option value="<?php echo $datadivision[$d]["division_id"];?>" <?php echo (isset($data["division_id"]) && $datadivision[$d]["division_id"]==$data["division_id"])?"selected":"";?> ><?php echo $datadivision[$d]["division_name"];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="status_id"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Status :</label>
				<div class="col-sm-3">
					<select class="form-control validate[required]" name="status_id" id="status_id">
						<?php
						for($i=0;$i<count($array_status);$i++) {
						?>
						<option value="<?php echo $array_status[$i];?>" <?php echo (isset($data["status_id"]) && $array_status[$i]==$data["status_id"])?"selected":"";?> ><?php echo $array_status[$i];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9 top30">
					<input type="hidden" name="log_auth_id" value="<?php echo (isset($data["log_auth_id"]) && $data["log_auth_id"]<>"")?$data["log_auth_id"]:"";?>">
					<input type="hidden" name="employee_id" value="<?php echo (isset($data["employee_id"]) && $data["employee_id"]<>"")?$data["employee_id"]:"";?>">
					<input type="hidden" name="mod" value="admin_updateUser">
					<input type="hidden" name="page" value="<?php echo $page;?>">
					<input type="hidden" name="upd_type" value="<?php echo $type;?>">
					<input type="submit" class="btn btn-md btn-success" value="SUBMIT" style="margin-right:30px;">
					<a href="<?php echo _PATHURL;?>/index.php?mod=adminmgmt&view=<?php echo coded($log_auth_role);?>&page=<?php echo $page;?>" class="btn btn-info btn-md"  role="button">Return to List of User</a>
				</div>
			</div>
			
			
		</form>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#upduser").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>