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
$limit=30;
$page=(isset($_GET["page"]) && $_GET["page"]<>"")?$_GET["page"]:"1";

$start_from = ($page-1) * $limit;  

//echo "page=".$page."   start=".$start_from."<br><br>";
$datacandidate=adm_getSearchResult($start_from,$limit);
		/*echo "datacandidate=";
		print_r($datacandidate);
		echo "<br><br>";*/

//print_r($datacandidate);
//exit;

	
?>


<div class="row bottom30">

<!-- bagian list job adv -->
<div class="panel panel-default">
	<div class="panel-body">
	
		<div><?php echo system_showAlert();?></div>
	
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
	</div>
	
	<div class="panel-footer">
	
		<?php  
		$linknya="index.php?mod=admsearch";

		if(isset($_GET["candidate_name"]) && $_GET["candidate_name"]<>"") {
			$linknya .="&candidate_name=".$_GET["candidate_name"];
		}
		if(isset($_GET["candidate_email"]) && $_GET["candidate_email"]<>"") {
			$linknya .="&candidate_email=".$_GET["candidate_email"];
		}
		
		if(isset($_GET["candidate_edu_degree"]) && $_GET["candidate_edu_degree"]<>"") {
			$linknya .="&candidate_edu_degree=".$_GET["candidate_edu_degree"];
		}
		if(isset($_GET["candidate_jobexp_lob"]) && $_GET["candidate_jobexp_lob"]<>"") {
			$linknya .="&candidate_jobexp_lob=".$_GET["candidate_jobexp_lob"];
		}
		if(isset($_GET["candidate_jobexp_position"]) && $_GET["candidate_jobexp_position"]<>"") {
			$linknya .="&candidate_jobexp_position=".$_GET["candidate_jobexp_position"];
		}
		if(isset($_GET["candidate_c_city"]) && $_GET["candidate_c_city"]<>"") {
			$linknya .="&candidate_c_city=".$_GET["candidate_c_city"];
		}
		if(isset($_GET["candidate_religion"]) && $_GET["candidate_religion"]<>"") {
			$linknya .="&candidate_religion=".$_GET["candidate_religion"];
		}
		if(isset($_GET["candidate_gender"]) && $_GET["candidate_gender"]<>"") {
			$linknya .="&candidate_gender=".$_GET["candidate_gender"];
		}
		
		$linknya .="&status_id=active";
		
		
		
		
		
		
		
		$datatotal=adm_getSearchResult("","");
		
		/*echo "datatotal=";
		print_r($datatotal);*/
		
		$total_records = count($datatotal);  
		$total_pages = ceil($total_records / $limit);  
		
		if($page>=2) {
			$prev=$page-1;
			$link="href='"._PATHURL."/".$linknya."&page=".$prev."'";
		}
		else {
			$link="";
		}
		
		if($page>=$total_pages) {
			$linknext="";
		}
		else {
			$next=$page+1;
			$linknext="href='"._PATHURL."/".$linknya."&page=".$next."'";
		}
		?>
		<nav>
			<ul class="pagination">
				<li class="<?php echo ($page<=1)?"disabled":"";?>">
					<a <?php echo $link;?> aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>		
		
		<?php		
		for ($i=1; $i<=$total_pages; $i++) {  
		?>
		
				<li class="<?php echo ($page==$i)?"active":"";?>"><a href="<?php echo _PATHURL;?>/<?php echo $linknya;?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
		<?php
		}  
		?>
				<li class="<?php echo ($page>=$total_pages)?"disabled":"";?>">
				  <a <?php echo $linknext;?> aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				  </a>
				</li>		
		
			</ul>
		</nav>
	
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
		
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>