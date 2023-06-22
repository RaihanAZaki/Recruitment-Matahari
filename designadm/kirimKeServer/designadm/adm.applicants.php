<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}
	$item_per_page=15;
	$type=(isset($_GET["type"]) && $_GET["type"]<>"")?$_GET["type"]:"apply";

	$datatotal=admin_getListCandidate($type,"","");
		
	$total_records = count($datatotal);  
	$pages = ceil($total_records / $item_per_page);
	
	
	// echo "masuk ke sini";
	// print_r($datatotal);
	// echo "<br><br>Datatotal= ".$total_records."<br>";
	// echo "Pages= ".$pages."<br>";
	

	
?>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/bootpag/js/jquery.bootpag.min.js"></script> 

	<script type="text/javascript">
	$(document).ready(function() {
		$("#results").load("<?php echo _PATHURL;?>/designadm/adm.fetch_pages.php?type=<?php echo $type; ?>");  //initial page number to load
		$(".pagination").bootpag({
		   total: <?php echo $pages; ?>,
		   page: 1,
		   maxVisible: 10 
		}).on("page", function(e, num){
			e.preventDefault();
			$("#results").prepend('<div class="loading-indication"><img src="<?php echo _PATHURL;?>/includes/bootpag/ajax-loader.gif" /> Loading...</div>');
			$("#results").load("<?php echo _PATHURL;?>/designadm/adm.fetch_pages.php?type=<?php echo $type;?>", {'page':num});
		});

	});
	</script>

	<div class="row bottom30">

	<!-- bagian list job adv -->
	<div class="panel panel-default">
		<div class="panel-body">
		
			<div><?php echo system_showAlert();?></div>
		
			<div class="col-md-4" style="padding:10px; text-align:left;"><h3>List of <?php echo strtoupper($type);?> member</h3></div>
			<div class="col-md-5" style="padding:10px; text-align:left;">
				<div>
				<?php
				if($type=="hired") {
				?>	<div class="col-md-6" style="padding:10px; text-align:right;">
						<a type="button" class="btn btn-sm btn-danger" href="http://192.168.200.62:7790/?id=<?php echo code4csharp($_SESSION["log_auth_name"]);?>" target="_blank">Upload to Proint</a>	
					</div>
					<div class="col-md-6" style="padding:10px; text-align:left;">
						<form name="downloadResume2" method="post" action="<?php echo _PATHURL;?>/letsprocess.php">															
							<input type="hidden" name="mod" value="adm_exportExcelForProint">
							<input type="hidden" name="type" value="<?php echo $type;?>">
							<button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure to export  <?php echo $type;?> candidate?')" title="Export list to excel file." ><i class="fa fa-file-excel-o"></i>&nbsp;Export</button>
						</form>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="col-md-3" style="padding:10px; text-align:right;">
					<div class="btn-group" role="group">
						<a type="button" class="btn btn-sm btn-danger" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=register">Register</a>
						<a type="button" class="btn btn-sm btn-success" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=activate">Activate</a>
						<a type="button" class="btn btn-sm btn-info" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=apply">Apply</a>
						<a type="button" class="btn btn-sm btn-primary" href="<?php echo _PATHURL;?>/index.php?mod=applicants&type=hired">Join</a>
					</div>		
			</div>
			<hr>
			
			<div id="results"></div>
			<div class="pagination"></div>
			
		</div>
	</div>