<?php
session_start();
include_once("../setconf.php");
loadAllModules();
$usrRequest = array();
$usrRequest = system_initiateRequest();
	
//sanitize post value
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1;
}

	
$item_per_page=15;
//get current starting point of records
$position = (($page_number-1) * $item_per_page);
$datacandidate=adm_getSearchResult($position,$item_per_page);
?>

		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<td><b>Candidate's Name</b></td>
					<?php
					if(isset($_GET["candidate_edu_degree"]) && $_GET["candidate_edu_degree"]<>"") {
					?>
					<td><b>Degree</b></td>
					<td align="center"><b>Institution</b></td>
					<?php
					}
					?>
					<td align="left"><b>Action</b></td>
				</tr>
			</thead>
			
			<tbody>
			<?php
			for($i=0;$i<count($datacandidate);$i++) {
			?>
				<tr>
					<td><?php echo $datacandidate[$i]["candidate_name"];?></a></td>
					<?php
					if(isset($_GET["candidate_edu_degree"]) && $_GET["candidate_edu_degree"]<>"") {
					?>
					<td><?php echo $datacandidate[$i]["candidate_edu_degree"];?></td>	
					<td><?php echo $datacandidate[$i]["candidate_edu_institution"];?></td>	
					<?php
					}
					?>
					<td align="center">
							<form name="downloadResume<?php echo $i;?>" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left;">							
								<a href="<?php echo _PATHURL;?>/index.php?mod=detailcandidate&candidate_id=<?php echo coded($datacandidate[$i]["candidate_id"]);?>" class="btn btn-success btn-xs" title="Edit Candidate">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>
								<a href="<?php echo _PATHURL;?>/index.php?mod=historycandidate&candidate_id=<?php echo coded($datacandidate[$i]["candidate_id"]);?>" class="btn btn-info btn-xs" title="View History of the Candidate">&nbsp;<i class="fa fa-clock-o"></i>&nbsp;</a>
								<a data-toggle="modal" class="btn btn-warning btn-xs" href="<?php echo _PATHURL;?>/designadm/adm.candidate_apply_by_recruiter.php?candidate_id=<?php echo coded($datacandidate[$i]["candidate_id"]);?>" data-target="#myModal" title="Apply a job for the Candidate">&nbsp;<i class="fa fa-bookmark"></i>&nbsp;</a>
								
								<input type="hidden" name="mod" value="adm_downloadResume">
								<input type="hidden" name="candidate_id" value="<?php echo $datacandidate[$i]["candidate_id"];?>">
								<button type="submit" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to download <?php echo $datacandidate[$i]["candidate_name"];?> ?')"  title="Download Resume CV Style">&nbsp;<i class="fa fa-download"></i>&nbsp;</button>
							</form>
							<form name="downloadResume2" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left; padding-left:4px;">															
								<input type="hidden" name="mod" value="adm_downloadFullTabel">
								<input type="hidden" name="candidate_id" value="<?php echo $datacandidate[$i]["candidate_id"];?>">
								<button type="submit" class="btn btn-info btn-xs" onclick="return confirm('Are you sure to download <?php echo $datacandidate[$i]["candidate_name"];?> ?')" title="Download Application Form" >&nbsp;<i class="fa fa-download"></i>&nbsp;</button>
							</form>							
					</td>
				</tr>
			<?php
			}
			?>
			</tbody>
			
		</table>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
		
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>