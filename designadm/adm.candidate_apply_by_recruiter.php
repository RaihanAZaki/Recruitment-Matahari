<?php
//candidate_processing_status
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

	$candidate_id=(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"")?decoded($_GET["candidate_id"]):"";
		
	$datavacancy=admin_getJobAdv();
	$dataresume=admin_getDetailCandidate($candidate_id);
	$numApply=admin_getNumApply("open_project",$candidate_id);
	
	//print_r($datavacancy);
	
	//print_r($dataresume);

?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		 <h4 class="modal-title">Applying a position for <?php echo $dataresume[0]["candidate_name"];?></h4>
	</div>			<!-- /modal-header -->
	
	<div class="modal-body">
		<!--<?php echo "numApply= ".$numApply;?>-->
	<?php
	if($numApply<_MAXAPPLY) {
		
	?>

		<fieldset>
		<form name="applyfrm" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data" >
			<table border="0">
				<tr>
					<td style="width:150px; padding-bottom:20px;">Position</td>
					<td style="width:10px; padding-bottom:20px;">:</td>
					<td style="padding-bottom:20px;">
						<select name="job_vacancy_id" class="form-control">
							<?php
							for($i=0;$i<count($datavacancy);$i++) {
							?>
							<option value="<?php echo $datavacancy[$i]["job_vacancy_id"];?>"><?php echo $datavacancy[$i]["job_vacancy_name"];?></option>
							<?php
							}
							?>
						</select>
						
					</td>
				</tr>
				<tr>
					<td style="width:150px; padding-bottom:20px;">Add notes to history</td>
					<td style="width:10px; padding-bottom:20px;">:</td>
					<td style="padding-bottom:20px;">
						<textarea name="apply_history_notes" class="form-control"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<input type="hidden" name="mod" value="adm_applyForCandidate">
						<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
						<input type="hidden" name="candidate_email" value="<?php echo $dataresume[0]["candidate_email"];?>">
						<input type="submit" class="btn btn-primary" value="UPDATE">
					</td>
				</tr>
				
			</table>
		</form>
		</fieldset>
	<?php
	}
	else
	{
	?>
		<div>Sorry, <br><?php echo $dataresume[0]["candidate_name"];?> has reached the limit (<?php echo _MAXAPPLY;?>) of maximum application. Please reject some of <?php echo ($dataresume[0]["candidate_gender"]=="male")?"his":"her";?> application before applying another vacancy for <?php echo ($dataresume[0]["candidate_gender"]=="male")?"him":"her";?></div>
	<?php
	}
	?>
		
	</div>			<!-- /modal-body -->
	<div class="modal-footer">
		<!-- <a href="<?php echo _PATHURL;?>/index.php?mod=listperstage&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>" class="btn btn-default">Close</a> -->
		<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
	
	
	
	<script>
		$(document).on("hidden.bs.modal", function (e) {
			$(e.target).removeData("bs.modal").find(".modal-content").empty();
		});
	</script>
	
<?php
}
?>