<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}
?>

<?php
ini_set("error_reporting", E_ALL);
ini_set("display_errors",1);
$dataregistered=admin_getCandidateAll("register");
$dataactivate=admin_getCandidateAll("activate");
$dataapply=admin_getCandidateAll("apply");
$datajoin=admin_getCandidateAll("hired");



$datavacancy=admin_getJobAdv("","","","","open");
//print_r($datavacancy);
// print_r($dataapply);
?>

<div class="row bottom30">

<div><?php echo system_showAlert();?></div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-pie-chart"> &nbsp;Website overview</i></h2>
	</div>
	
	<div class="panel-body">
		<div class="col-md-3">
			<div class="col-md-10" style="text-align:center;">
				<div class="circle circle-solid circle-border" style="background-color:#FF99FD;">
				<!--<div class="circle circle-solid circle-border" style="background-color:#D9534F;">-->
					<div class="circle-inner">
						<div>
								<a class="linkputih score-text" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=register"><?php echo count($dataregistered);?></a>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-10" style="text-align:center;"> 
				<h4>REGISTER</h4>
				<span class="text-muted">Registered account but hasn't been activated.</span>
			</div>
		</div>

		
		<div class="col-md-3">
			<div class="col-md-10" style="text-align:center;">
				<div class="circle circle-solid circle-border">
				<!--<div class="circle circle-solid circle-border" style="background-color:#5CB85C;">-->
					 <div class="circle-inner">
						 <div>
						 <a class="linkputih score-text" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=activate"><?php echo count($dataactivate);?></a>
						 </div>
					 </div>
				</div>	
			</div>
			<div class="col-md-10" style="text-align:center;"> 
				<h4>ACTIVATE</h4>
				<span class="text-muted">Member whose account has been activated.</span>
			</div>
		</div>
		

		<div class="col-md-3">
			<div class="col-md-10" style="text-align:center;">
				<!--<div class="circle circle-solid circle-border" style="background-color:#31C9CC;">-->
				<div class="circle circle-solid circle-border" style="background-color:#5BC0DE;">				
					 <div class="circle-inner">
						 <div>
						 <a class="linkputih score-text" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=apply"><?php echo count($dataapply);?></a>
						 </div>
					 </div>
				</div>	
			</div>
			<div class="col-md-10" style="text-align:center;"> 
				<h4>APPLY</h4>
				<span class="text-muted">Member who apply for one (or more) open vacancy.</span>
			</div>
		</div>

		
		<div class="col-md-3">
			<div class="col-md-10" style="text-align:center;">
				<!--<div class="circle circle-solid circle-border" style="background-color:#6666ff;">-->
				<div class="circle circle-solid circle-border" style="background-color:#337AB7;">				
					 <div class="circle-inner">
						 <div>
						 <a class="linkputih score-text" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=hired"><?php echo count($datajoin);?></a>
						 </div>
					 </div>
				</div>	
			</div>
			<div class="col-md-10" style="text-align:center;"> 
				<h4>RECRUITED</h4>
				<span class="text-muted">Member who pass all stages and has been recruited.</span>
			</div>
		</div>
		
		
	</div>
</div>

<!-- bagian job adv -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h2 class="panel-title"><i class="fa fa-bookmark"> &nbsp;Open Position Summary</i></h2>
	</div>
	
	<div class="panel-body">
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<td><b>Vacant Position</b></td>
					<!--<td><b>City</b></td>-->
					<td><b>PIC</b></td>
					<td align="center"><b>Received CV</b></td>
					<td align="center"><b>HR Screening</b></td>
					<td align="center"><b>User Screening</b></td>
					<td align="center"><b>Psychotest</b></td>
					<td align="center"><b>HR Interview</b></td>
					<td align="center"><b>User Interview</b></td>
					<td align="center"><b>Background Checking</b></td>
					<td align="center"><b>Offering</b></td>
					<td align="center"><b>Rejected</b></td>
				</tr>
			</thead>
			
			<tbody>
			<?php
			if(count($datavacancy)>0) {
				for($i=0;$i<count($datavacancy);$i++) {
					$ntotalpervacancy=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],""));
					$nscreening=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"cv-screening"));
					//$nhrreview=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"hr-review"));
					$nuserscreening=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"user-screening"));
					$npsychotest=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"psychotest"));
					$nhrint=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"hr-interview"));
					$nuserint=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"user-interview"));
					$bgcheck=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"background-check"));
					$noffering=count(admin_getAppliedVacancy($datavacancy[$i]["job_vacancy_id"],"offering"));
					$nreject=count(admin_getStatusCandidate($datavacancy[$i]["job_vacancy_id"],"reject"));
				?>
					<tr>
						<td><a href="<?php echo _PATHURL;?>/detail/<?php echo $datavacancy[$i]["job_vacancy_id"];?>/<?php echo url_slug($datavacancy[$i]["job_vacancy_name"])?>/"><?php echo $datavacancy[$i]["job_vacancy_name"];?></a></td>
						<!--<td><?php echo $datavacancy[$i]["job_vacancy_city"];?></td>-->
						<td><?php echo $datavacancy[$i]["employee_name"];?></td>
						<td align="center" style="color:#009901;"><b><?php echo $ntotalpervacancy;?></b></td>
						<td align="center"><a <?php echo ($nscreening>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("cv-screening")."' class='btn btn-danger btn-xs' ":"";?> ><?php echo $nscreening;?></a></td>
						<td align="center"><a <?php echo ($nuserscreening>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("user-screening")."' class='btn btn-danger btn-xs' ":"";?> ><?php echo $nuserscreening;?></a></td>
						<td align="center"><a <?php echo ($npsychotest>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("psychotest")."' class='btn btn-warning btn-xs' ":"";?> ><?php echo $npsychotest;?></a></td>
						<td align="center"><a <?php echo ($nhrint>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("hr-interview")."' class='btn btn-warning btn-xs' ":"";?> ><?php echo $nhrint;?></a></td>
						<td align="center"><a <?php echo ($nuserint>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("user-interview")."' class='btn btn-warning btn-xs' ":"";?> ><?php echo $nuserint;?></a></td>
						<td align="center"><a <?php echo ($bgcheck>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("background-check")."' class='btn btn-warning btn-xs' ":"";?> ><?php echo $bgcheck;?></a></td>
						<td align="center"><a <?php echo ($noffering>0)?"href='"._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($datavacancy[$i]["job_vacancy_id"])."&candidate_apply_stage=".coded("offering")."' class='btn btn-success btn-xs' ":"";?> ><?php echo $noffering;?></a></td>
						<td align="center" style="color:#ff0000;"><b><?php echo $nreject;?></b></td>
					</tr>
				<?php
				}
			}
			else {
				echo '<tr><td colspan="8">No data</td></tr>';
			}
			?>
			</tbody>
			
		</table>
	</div>
</div>