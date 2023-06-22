<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	//exit;
}
else {

$datapplication=getDataApply();
//print_r($datapplication);
?>

<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-bar-chart"></i>&nbsp;Application Status</cufonize></h2>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">	
		<table class="table">
			<thead>
				<tr>
					<td><b>No.</b></td>
					<td><b>Position</b></td>
					<td><b>Applied Date</b></td>
					<td><b>Stage</b></td>
					<td><b>Status</b></td>
				</tr>
			</thead>
			<tbody>
			<?php
			$nourut=0;
			for($i=0;$i<count($datapplication);$i++) {
			$nourut++;
			?>
				<tr>
					<td><?php echo $nourut;?></td>
					<td><a href="<?php echo _PATHURL;?>/detail/<?php echo $datapplication[$i]["job_vacancy_id"];?>/<?php echo url_slug($datapplication[$i]["job_vacancy_name"])?>/" class="linkbiru"><?php echo $datapplication[$i]["job_vacancy_name"];?></a></td>
					<td><?php echo date("d M Y",strtotime($datapplication[$i]["job_vacancy_enddate"]));?> </td>
					<td><?php echo $datapplication[$i]["candidate_apply_stage"];?></td>
					<td><?php echo showAsButton($datapplication[$i]["candidate_apply_status"]);?></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>

<div class="form-horizontal left30" role="form">
	<div class="form-group row">
		<h2 class="panel-title"><cufonize><i class="fa fa-info-circle"></i>&nbsp;Notes</cufonize></h2>
	</div>
	<div class="form-group row">	
		<div class="col-md-2"><span class="btn btn-info btn-xs">ON GOING</span></div>
		<div class="col-md-8">Your application is in progress</div>
	</div>
	<div class="form-group row">	
		<div class="col-md-2"><span class="btn btn-warning btn-xs">PENDING</span></div>
		<div class="col-md-8">Your application has been reviewed and still waiting for further process.</div>
	</div>
	<div class="form-group row">	
		<div class="col-md-2"><span class="btn btn-danger btn-xs">REJECT</span></div>
		<div class="col-md-8">Thank you for applying for the position. However, this is the end of your application process.</div>
	</div>
	<div class="form-group row">	
		<div class="col-md-2"><span class="btn btn-success btn-xs">JOIN</span></div>
		<div class="col-md-8">Congratulation, Succeed candidate.</div>
	</div>
</div>

<?php
}
?>