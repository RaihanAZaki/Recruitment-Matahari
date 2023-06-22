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
	$item_per_page=15;
	
	$datatotal=	admin_getCandidateByRecruiter("","");
	$total_records = count($datatotal);  
	$pages = ceil($total_records / $item_per_page);
	
?>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/bootpag/js/jquery.bootpag.min.js"></script> 
	<script type="text/javascript">
	$(document).ready(function() {
		$("#results").load("<?php echo _PATHURL;?>/designadm/adm.fetch_by_recruiter.php");  //initial page number to load
		$(".pagination").bootpag({
		   total: <?php echo $pages; ?>,
		   page: 1,
		   maxVisible: 10 
		}).on("page", function(e, num){
			e.preventDefault();
			$("#results").prepend('<div class="loading-indication"><img src="<?php echo _PATHURL;?>/includes/bootpag/ajax-loader.gif" /> Loading...</div>');
			$("#results").load("<?php echo _PATHURL;?>/designadm/adm.fetch_by_recruiter.php", {'page':num});
		});

	});
	</script>

	
	
	<!-- bagian list candidate by recruiter -->
	<div class="panel panel-default">
		<div class="panel-body">
		
			<div><?php echo system_showAlert();?></div>
		
			<div class="col-md-12">
				<div class="col-md-10"></div>
				<div class="col-md-2">
					<span style="text-align:right;">
						<a href="<?php echo _PATHURL;?>/index.php?mod=registeringcandidate" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp; Add a New Candidate</a>
					</span>
				</div>
			</div>
			<div class="row"></div>
			<hr>
			
			<div id="results"></div>
			<div class="pagination"></div>
			
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