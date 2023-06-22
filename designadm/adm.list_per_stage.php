<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {
	//echo "muncul ini";
	//print_r($_GET);
	$_GET  = (isset($_GET))?sanitize_get($_GET):array();
	
	$job_vacancy_id=(isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";
	$candidate_apply_stage=(isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";

	$datavacancy=admin_getJobAdv($job_vacancy_id,"detail");
	$datalist=admin_getAppliedVacancy($job_vacancy_id, $candidate_apply_stage);
	//print_r($datalist);
	
	// echo "job vacancy ".$job_vacancy_id."<br>";
	// echo $candidate_apply_id."<br>";
	// echo "apply stage ".$candidate_apply_stage."<br>";
	// echo $candidate_apply_date."<br>";
	// echo $candidate_apply_status."<br>";

	
	//print_r($datavacancy);
?>	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><label class="control-label"><i class="fa fa-users"></i>&nbsp;<?php echo $datavacancy[0]["job_vacancy_name"];?> <i>[ <?php echo showStageName($candidate_apply_stage);?> ]</i></label></h2>
		</div>

		<div class="panel-body">
			<div><?php echo system_showAlert();?></div>

			<table class="table table-striped">
				<thead>
					<tr>
						<?php
						if(isset($candidate_apply_stage) && $candidate_apply_stage=="user-screening") {
						?>
						<td></td>
						<?php
						}
						?>
						<td>No.</td>
						<td>Candidate Name</td>
						<td>Email</td>
						<td>Apply Date</td>
						<td>Status</td>
						<td>Action</td>
					<tr>
				</thead>
				<tbody>
					<?php
					$n=0;
					//$send_for_screening=array();
					for($i=0;$i<count($datalist);$i++) {
						$n++;
					?>
					<tr>
						<?php
						if(isset($candidate_apply_stage) && $candidate_apply_stage=="user-screening") {
						?>
						<td><input type="checkbox" class="chkbx" name="chkbx_<?php echo $i; ?>" id="chkbx_<?php echo $i; ?>" value="<? echo $datalist[$i]["candidate_id"];?>" ></td>
						<?php
						}
						?>
						<td><?php echo $n;?></td>
						<td><?php echo $datalist[$i]["candidate_name"];?></td>
						<td><?php echo $datalist[$i]["candidate_email"]?></td>
						<td><?php echo date("M d, Y",strtotime($datalist[$i]["candidate_apply_date"]));?></td>
						<td><?php echo showAsButton($datalist[$i]["candidate_apply_status"]);?></td>
						<td>
							<form name="downloadResume" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left;">							
								<a href="<?php echo _PATHURL;?>/index.php?mod=detailcandidate&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&candidate_id=<?php echo coded($datalist[$i]["candidate_id"]);?>" class="btn btn-success btn-xs" title="Edit Candidate">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>
								<a href="<?php echo _PATHURL;?>/index.php?mod=historycandidate&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&candidate_id=<?php echo coded($datalist[$i]["candidate_id"]);?>" class="btn btn-info btn-xs" title="Show History of the Candidate">&nbsp;<i class="fa fa-clock-o"></i>&nbsp;</a>
								<a data-toggle="modal" class="btn btn-warning btn-xs" href="<?php echo _PATHURL;?>/designadm/adm.candidate_processing_status.php?job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&candidate_apply_status=<?php echo coded($datalist[$i]["candidate_apply_status"]);?>&candidate_apply_id=<?php echo coded($datalist[$i]["candidate_apply_id"]);?>&candidate_id=<?php echo coded($datalist[$i]["candidate_id"]);?>&candidate_apply_date=<?php echo coded($datalist[$i]["candidate_apply_date"]);?>" data-target="#myModal" title="Process the Candidate">&nbsp;<i class="fa fa-gavel"></i>&nbsp;</a>
								
								<input type="hidden" name="job_vacancy_id" value="<?php echo $job_vacancy_id;?>">
								<input type="hidden" name="mod" value="adm_downloadResume">
								<input type="hidden" name="candidate_apply_stage" value="<?php echo $candidate_apply_stage;?>">
								<input type="hidden" name="candidate_apply_date" value="<?php echo $datalist[$i]["candidate_apply_date"];?>">
								<input type="hidden" name="candidate_id" value="<?php echo $datalist[$i]["candidate_id"];?>">
								<button type="submit" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to download <?php echo $datalist[$i]["candidate_name"];?> ?')"  title="Download Resume CV Style">&nbsp;<i class="fa fa-download"></i>&nbsp;</button>
							</form>
							<form name="downloadResume2" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left; padding-left:4px;">															
								<input type="hidden" name="job_vacancy_id" value="<?php echo $job_vacancy_id;?>">
								<input type="hidden" name="mod" value="adm_downloadFullTabel">
								<input type="hidden" name="candidate_apply_stage" value="<?php echo $candidate_apply_stage;?>">
								<input type="hidden" name="candidate_id" value="<?php echo $datalist[$i]["candidate_id"];?>">
								<button type="submit" class="btn btn-info btn-xs" onclick="return confirm('Are you sure to download <?php echo $datalist[$i]["candidate_name"];?> ?')"  title="Download Application Form">&nbsp;<i class="fa fa-download"></i>&nbsp;</button>
							</form>							
						</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td colspan="7" align="left">
						<form name="sendToUser" method="post" action="<?php echo _PATHURL;?>/letsprocess.php">	
							<input type="hidden" name="send_for_screening" id="send_for_screening" value="">
							<input type="hidden" name="job_vacancy_id" value="<?php echo $job_vacancy_id;?>">
							<input type="hidden" name="mod" value="adm_sendCvToUser">
							<input type="hidden" name="candidate_apply_stage" value="<?php echo $candidate_apply_stage;?>">
							<input type="submit" id="btnSubmitToUser" class="btn btn-primary btn-sm" value="SEND CHECKED CANDIDATE TO USER" disabled="disabled">
						</form>
						</td>
					</tr>
				</tbody>
			</table>
			
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
		
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

$(document).ready(function(){	
	
	
	$('.chkbx').click(function(){
		var text = "";
		$('.chkbx:checked').each(function(){
			text += $(this).val()+'|';
		});
		text = text.substring(0,text.length-1);
		
		$('#send_for_screening').val(text);
		
		if(text=="") {
			$('#btnSubmitToUser').attr('disabled','disabled');
		}
		else {
			$('#btnSubmitToUser').removeAttr('disabled');
		}
		
	});
	
	
});
</script>

<?php	
}
?>