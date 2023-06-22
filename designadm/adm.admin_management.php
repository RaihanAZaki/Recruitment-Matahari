<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || $_SESSION["priv_id"]<>"admin" ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.forbiddenpage.php");
	exit;
}
?>

<?php
//$nourut=0;
$limit=10;
$page=(isset($_GET["page"]) && $_GET["page"]<>"")?$_GET["page"]:"1";

$start_from = ($page-1) * $limit;  

//echo "page=".$page."   start=".$start_from;
//exit;

$datauser=admin_getUser($start_from,$limit);

//print_r($datauser);
//exit;

?>


<div class="row bottom30">

<!-- bagian list job adv -->
<div class="panel panel-default">
	<div class="panel-body">
	
		<div><?php echo system_showAlert();?></div>
	
		<div class="col-md-12" style="margin-left:0px; padding-left:0px;">
			<div class="col-md-5" style="margin-left:0px; padding-left:0px;">
				<!-- ini untuk import file .xls , belum dibuat 
				<form name="importuser" id="importuser" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
					
					<div class="input-group input-group-sm" style="margin-left:0px; padding-left:0px;">
							<input type="file" name="user_file" id="user_file" class="form-control" placeholder="Import xls user">
							<span class="input-group-btn">
								<input type="submit" class="btn btn-success" value="Import User from .xls">
							</span>
					</div>
				</form>
				-- akhir dari part import file -->
			</div>
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<span style="text-align:right;">
					<a href="<?php echo _PATHURL;?>/index.php?mod=updateuser" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp; Add a New User</a>
				</span>
			</div>
		</div>
		<div class="row"></div>
		<hr>
		<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<td><b>User's Name</b></td>
					<td><b>Email</b></td>
					<td align="center"><b>Role</b></td>
					<td align="center"><b>Action</b></td>
				</tr>
			</thead>
			
			<tbody>
			<?php
			for($i=0;$i<count($datauser);$i++) {
			?>
				<tr>
					<td><?php echo $datauser[$i]["employee_name"];?><small><i> [<?php echo $datauser[$i]["employee_nik"];?>]</i></small></a></td>
					<td><?php echo $datauser[$i]["employee_email"];?></td>
					<td><?php echo showRoleName($datauser[$i]["log_auth_role"]);?></td>
					<td align="center">
						
						<form name="deluser" method="post" action="<?php echo _PATHURL;?>/letsprocess.php">
							<a href="<?php echo _PATHURL;?>/index.php?mod=updateuser&type=edit&log_auth_id=<?php echo coded($datauser[$i]["log_auth_id"]);?>&view=<?php echo coded($datauser[$i]["log_auth_role"]);?>&page=<?php echo $page;?>" class="btn btn-success btn-xs">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>
							<input type="hidden" name="employee_id" value="<?php echo $datauser[$i]["employee_id"];?>">
							<input type="hidden" name="log_auth_id" value="<?php echo $datauser[$i]["log_auth_id"];?>">
							<input type="hidden" name="mod" value="adm_delUser">
							<input type="hidden" name="view" value="<?php echo coded($datauser[$i]["log_auth_role"]);?>">
							<input type="hidden" name="page" value="<?php echo $page;?>">
							<button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete <?php echo $datauser[$i]["employee_name"];?> ?')" >&nbsp;<i class="fa fa-trash-o"></i>&nbsp;</button>
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
		$datatotal=admin_getUser("","");
		
		$total_records = count($datatotal);  
		$total_pages = ceil($total_records / $limit);  
		
		if($page>=2) {
			$prev=$page-1;
			$link="href='"._PATHURL."/index.php?mod=adminmgmt&page=".$prev."'";
		}
		else {
			$link="";
		}
		
		if($page>=$total_pages) {
			$linknext="";
		}
		else {
			$next=$page+1;
			$linknext="href='"._PATHURL."/index.php?mod=adminmgmt&page=".$next."'";
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
		
				<li class="<?php echo ($page==$i)?"active":"";?>"><a href="<?php echo _PATHURL;?>/index.php?mod=adminmgmt&page=<?php echo $i;?>"><?php echo $i;?></a></li>
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