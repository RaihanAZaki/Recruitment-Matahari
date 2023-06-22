<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {

	if(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"") {
		
	$job_vacancy_id=(isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";
	$candidate_apply_stage=(isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";
	$type=(isset($_GET["type"]) && $_GET["type"]=="showall")?"showall":"";
	$datavacancy=($job_vacancy_id<>"")?admin_getJobAdv($job_vacancy_id,"detail"):"";
	
	$dataresume=(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"")?admin_getDetailCandidate(decoded($_GET["candidate_id"])):"";
	
	//echo $job_vacancy_id;exit;
	//$datahistory=($job_vacancy_id<>"")?admin_getHistory(decoded($_GET["candidate_id"]), $job_vacancy_id):admin_getHistory(decoded($_GET["candidate_id"]));
	$datajob=($job_vacancy_id<>"" && $type<>"showall")?admin_getVacancyByCandidate(decoded($_GET["candidate_id"]),$job_vacancy_id):admin_getVacancyByCandidate(decoded($_GET["candidate_id"]));
	//print_r($datahistory);
	//print_r($datajob);
		
?>
		<div class="form-group">
			<div class="col-md-6"><h3><i><?php echo $dataresume[0]["candidate_name"];?></i></h3></div>
			<?php
			if($job_vacancy_id<>""){
				if($type<>"showall") {
			?>
				<div class="col-md-6" style="text-align:right;"><a href="<?php echo _PATHURL;?>/index.php?mod=historycandidate&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&candidate_id=<?php echo $_GET["candidate_id"];?>&type=showall" class="btn btn-info">Show full history</a></div>
			<?php
				}
				else {
			?>
				<div class="col-md-6" style="text-align:right;"><a href="<?php echo _PATHURL;?>/index.php?mod=historycandidate&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&candidate_id=<?php echo $_GET["candidate_id"];?>" class="btn btn-info">Back to <?php echo $datajob[0]["job_vacancy_name"];?> Only</a></div>
			<?php
				}
			}
			?>
		</div>
		<div style="clear:both;"></div>
		<?php
		for($i=0;$i<count($datajob);$i++) {
			$datahistory=($datajob[$i]["job_vacancy_id"]<>"")?admin_getHistory($dataresume[0]["candidate_id"], $datajob[$i]["job_vacancy_id"]):admin_getHistory($datajob[$i]["candidate_id"]);
			
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title"><label class="control-label"><i class="fa fa-bookmark"></i>&nbsp;<?php echo $datajob[$i]["job_vacancy_name"];?></label></h2>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td align="center"><b>Stage</b></td>
						<td align="center"><b>Schedule Date</b></td>
						<td align="center"><b>Completion Date</b></td>
						<td align="center"><b>Status</b></td>
						<td align="center"><b>Notes</b></td>
					</tr>
					<?php
					for($j=0;$j<count($datahistory);$j++) {
					?>
					<tr>
						<td align="left"><?php echo showStageName($datahistory[$j]["apply_history_stage"]);?></td>
						<td align="center"><?php echo (isset($datahistory[$j]["candidate_schedule_date"]) && $datahistory[$j]["candidate_schedule_date"]<>"0000-00-00 00:00:00")?date("M d, Y",strtotime($datahistory[$j]["candidate_schedule_date"])):"N/A";?></td>
						<td align="center"><?php echo (isset($datahistory[$j]["candidate_completed_date"]) && $datahistory[$j]["candidate_completed_date"]<>"0000-00-00 00:00:00")?date("M d, Y",strtotime($datahistory[$j]["candidate_completed_date"])):"Not Completed";?></td>
						<td align="center"><?php echo showAsButton($datahistory[$j]["apply_history_status"]);?></td>
						<td align="left"><?php echo $datahistory[$j]["apply_history_notes"];?></td>
					</tr>
					<?php
					}
					?>
						
				</table>
				
				
			</div>
		</div>
		<?php
		}
	}
}
?>