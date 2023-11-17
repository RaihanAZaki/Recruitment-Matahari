<?php
session_start();
include_once("../setconf.php");
loadAllModules();
$usrRequest = array();
$usrRequest = system_initiateRequest();
ini_set("display_errors",1);
//sanitize post value
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1;
}

	$type=(isset($_GET["type"]) && $_GET["type"]<>"")?$_GET["type"]:"apply";
	$type=(isset($_GET["type"]) && $_GET["type"]<>"")?$_GET["type"]:"hired";

$item_per_page=15;
//get current starting point of records
$position = (($page_number-1) * $item_per_page);
$datacandidate=admin_getListCandidate($type,$position,$item_per_page);

// print_r($datacandidate);

?>

		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<td><b>Candidate's Name</b></td>
					<td><b>Email</b></td>
					<?php
					if ($type=="register") {
					?>
					<td align="center"><b>Register Date</b></td>
					<?php
					}
					if ($type=="activate") {
					?>
					<td align="center"><b>Activation Date</b></td>
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
					<td><?php echo $datacandidate[$i]["candidate_email"];?></td>	
					<?php
					if ($type=="register") {
					?>					
					<td align="center"><?php echo date("M d, Y",strtotime($datacandidate[$i]["register_date"]));?></td>
					<?php
					}
					if ($type=="activate") {
					?>
					<td align="center"><?php echo date("M d, Y",strtotime($datacandidate[$i]["register_activation_date"]));?></td>					
					<?php
					}
					?>					
					<td align="center">
						<?php
						if($type=="register") {
						?>
							<form name="activate<?php echo $i;?>" method="post" action="<?php echo _PATHURL;?>/letsprocess.php">							
								<input type="hidden" name="mod" value="adm_activateRegistrant">
								<input type="hidden" name="register_id" value="<?php echo $datacandidate[$i]["register_id"];?>">
								<input type="hidden" name="candidate_email" value="<?php echo $datacandidate[$i]["candidate_email"];?>">
								<button type="submit" class="btn btn-success btn-xs" onclick="return confirm('Are you sure to activate <?php echo $datacandidate[$i]["candidate_name"];?> ?')" title="Activate registrant">&nbsp;<i class="fa fa-power-off"></i>&nbsp;</button>
							</form>
						
						<?php
						}
						else {
						?>
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
						<?php
							if($type=="hired"){
							?>
							<form name="exportExcel" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left; padding-left:4px;">															
								<input type="hidden" name="mod" value="adm_exportExcel">
								<input type="hidden" name="type" value="<?php echo $type;?>">
								<input type="hidden" name="candidate_id" value="<?php echo $datacandidate[$i]["candidate_id"];?>">
								<button type="submit"class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to export  <?php echo $type;?> candidate?')" title="Export to excel file." >&nbsp;<i class="fa fa-file-excel-o"></i>&nbsp;</button>
							</form>
							
							<?php
							$disableMenu = false;
							$query = querying("SELECT * FROM m_candidate WHERE candidate_id = ?", array($datacandidate[$i]["candidate_id"]));

							if ($query) {
								$datajoin = mysqli_fetch_assoc($query);

								if (isset($datajoin["export_flag"]) && $datajoin["export_flag"] == 1) {
									$disableMenu = true;
								}
							}
						?>
						<form name="exportExcelProint" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left; padding-left:4px;">                                                        
							<input type="hidden" name="mod" value="executeAll">
							<input type="hidden" name="type" value="<?php echo $type;?>">
							<input type="hidden" name="candidate_id" value="<?php echo $datacandidate[$i]["candidate_id"];?>">
							<button type="submit" class="btn btn-success btn-xs" onclick="return confirm('Are you sure to export <?php echo $type;?> candidate?')" title="Export to all file." <?php if($disableMenu) echo "disabled";  ?>> &nbsp;<i class="fa fa-download"></i>&nbsp;
							</button>
						</form>
<!-- 
							<form name="exportExcelProint" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" style="float:left; padding-left:4px;">															
								<input type="hidden" name="mod" value="createZipFile">
								<input type="hidden" name="type" value="<?php echo $type;?>">
								<input type="hidden" name="candidate_id" value="<?php echo $datacandidate[$i]["candidate_id"];?>">
								<button type="submit" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure to export  <?php echo $type;?> candidate?')" title="Export to ZIP file." >&nbsp;<i class="fa fa-file-archive-o"></i>&nbsp;</button>
							</form> -->

							<?php
							}
						
						} 
						?>
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