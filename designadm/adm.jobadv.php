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
$status_id=(isset($_GET["view"]) && $_GET["view"]<>"")?decoded($_GET["view"]):"open";
$limit=15;
$page=(isset($_GET["page"]) && $_GET["page"]<>"")?$_GET["page"]:"1";

$start_from = ($page-1) * $limit;  

//echo "page=".$page."   start=".$start_from;

$datavacancy=admin_getJobAdv("","",$start_from,$limit,$status_id);

//print_r($datavacancy);

	
?>


<div class="row bottom30">

<!-- bagian list job adv -->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label-control"><i class="fa fa-bookmark"> &nbsp;Job Advertisement</i></span>
	</div>
	
	<div class="panel-body">
	
		<div><?php echo system_showAlert();?></div>
	
		<div class="col-md-12">
			<div class="col-md-10">
				<div class="btn-group" role="group">
				  <a href="<?php echo _PATHURL;?>/index.php?mod=jobadv&view=<?php echo coded("open");?>" type="button" class="btn btn-sm btn-success">Open</a>
				  <a href="<?php echo _PATHURL;?>/index.php?mod=jobadv&view=<?php echo coded("pending");?>" type="button" class="btn btn-sm btn-warning">Pending</a>
				  <a href="<?php echo _PATHURL;?>/index.php?mod=jobadv&view=<?php echo coded("finished");?>" type="button" class="btn btn-sm btn-primary">Finished</a>
				  <a href="<?php echo _PATHURL;?>/index.php?mod=jobadv&view=<?php echo coded("closed");?>" type="button" class="btn btn-sm btn-danger">Closed</a>
				</div>
			</div>
			<div class="col-md-2">
				<span style="text-align:right;">
					<a href="<?php echo _PATHURL;?>/index.php?mod=updateadv&type=add" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp; Post Job Advertisement</a>
				</span>
			</div>
		</div>
		<div class="row"></div>
		<hr>
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<td><b><?php echo (isset($_GET["view"]) && $_GET["view"]<>"")?ucfirst(decoded($_GET["view"])):"Open";?> Position</b></td>
					<td><b>City</b></td>
					<td><b>PIC</b></td>
					<td align="center"><b>Opening Date</b></td>
					<td align="center"><b>Closing Date</b></td>
					<td align="center"><b>Status</b></td>
					<td align="center"><b>Action</b></td>
				</tr>
			</thead>
			
			<tbody>
			<?php
			if(count($datavacancy)>0) {
				for($i=0;$i<count($datavacancy);$i++) {
				?>
					<tr>
						<td><a href="<?php echo _PATHURL;?>/detail/<?php echo $datavacancy[$i]["job_vacancy_id"];?>/<?php echo url_slug($datavacancy[$i]["job_vacancy_name"])?>/"><?php echo $datavacancy[$i]["job_vacancy_name"];?></a></td>
						<td><?php echo $datavacancy[$i]["job_vacancy_city"];?></td>
						<td><?php echo $datavacancy[$i]["employee_name"];?></td>
						<td align="center"><?php echo date("M d, Y",strtotime($datavacancy[$i]["job_vacancy_startdate"]));?></td>
						<td align="center"><?php echo date("M d, Y",strtotime($datavacancy[$i]["job_vacancy_enddate"]));?></td>
						<td align="center"><?php echo $datavacancy[$i]["status_id"];?></td>
						<td align="center">
							
							<form name="delvacancyfrm" method="post" action="<?php echo _PATHURL;?>/letsprocess.php">
								<a href="<?php echo _PATHURL;?>/index.php?mod=updateadv&type=edit&job_vacancy_id=<?php echo $datavacancy[$i]["job_vacancy_id"];?>&view=<?php echo coded($status_id);?>&page=<?php echo $page;?>" class="btn btn-success btn-xs">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>
								<input type="hidden" name="job_vacancy_id" value="<?php echo $datavacancy[$i]["job_vacancy_id"];?>">
								<input type="hidden" name="mod" value="adm_delJobAdv">
								<input type="hidden" name="view" value="<?php echo coded($status_id);?>">
								<input type="hidden" name="page" value="<?php echo $page;?>">
								<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete <?php echo $datavacancy[$i]["job_vacancy_name"];?> ?')" >&nbsp;<i class="fa fa-trash-o"></i>&nbsp;</button>
							</form>
						</td>
					</tr>
				<?php
				}
			}
			else {
				echo '<tr><td colspan="7">No data</td></tr>';
			}
			?>
			</tbody>
			
		</table>
	</div>
	
	<div class="panel-footer">
	
		<?php  
		$datatotal=admin_getJobAdv("","","","",$status_id);
		
		$total_records = count($datatotal);  
		$total_pages = ceil($total_records / $limit);  
		
		if($page>=2) {
			$prev=$page-1;
			$link="href='"._PATHURL."/index.php?mod=jobadv&view=".coded($status_id)."&page=".$prev."'";
		}
		else {
			$link="";
		}
		
		if($page>=$total_pages) {
			$linknext="";
		}
		else {
			$next=$page+1;
			$linknext="href='"._PATHURL."/index.php?mod=jobadv&view=".coded($status_id)."&page=".$next."'";
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
		
				<li class="<?php echo ($page==$i)?"active":"";?>"><a href="<?php echo _PATHURL;?>/index.php?mod=jobadv&view=<?php echo coded($status_id);?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
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