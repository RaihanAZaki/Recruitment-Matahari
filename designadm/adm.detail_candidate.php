<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {

	if(isset($_GET)){
		$_GET  = sanitize_get($_GET);
	}
	else $_GET=array();
	
	//print_r($_GET);exit;
	
	$job_vacancy_id=(isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";
	$candidate_apply_stage=(isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";
	
	$datavacancy=($job_vacancy_id<>"")?admin_getJobAdv($job_vacancy_id,"detail"):"";
	
	$dataresume=(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"")?admin_getDetailCandidate(decoded($_GET["candidate_id"])):"";
	//print_r($dataresume);
	
?>	
	<div><h3><i><?php echo $dataresume[0]["candidate_name"];?></i></h3></div>
	<div class="panel panel-default">
		<?php
		if($job_vacancy_id<>"" && $candidate_apply_stage<>"") {
		?>
		<div class="panel-heading">
			<h2 class="panel-title"><label class="control-label"><i class="fa fa-users"></i>&nbsp;<?php echo $datavacancy[0]["job_vacancy_name"];?> <i>[ <?php echo showStageName($candidate_apply_stage);?> ]</i></label></h2>
		</div>
		<?php
		}
		?>
		<div class="panel-body">
			<div><?php echo system_showAlert();?></div>

		<?php
		//jika ada candidate_id
		if(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"") {
			
			//print_r($_GET);
			//echo $_GET["job_vacancy_id"];
			
			//$dataresume=admin_getDetailCandidate(decoded($_GET["candidate_id"]));
			$menutab=admin_getMenuTabs();
		?>
			
			
			<!-- create tab di sini -->
			<div class="container-fluid">
				<ul class="nav nav-tabs" id="myTabs">
						<li class="active"><a href="#<?php echo $menutab[0]["menu_name"];?>" data-url="<?php echo _PATHURL;?>/designadm/<?php echo $menutab[0]["menu_filename"];?>?candidate_id=<?php echo $_GET["candidate_id"];?>&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&menu_name=<?php echo $menutab[0]["menu_name"];?>"><?php echo $menutab[0]["menu_title"];?></a></li>
				
					<?php
					for($i=1;$i<count($menutab);$i++) {
					?>
						<li><a href="#<?php echo $menutab[$i]["menu_name"];?>" data-url="<?php echo _PATHURL;?>/designadm/<?php echo $menutab[$i]["menu_filename"];?>?candidate_id=<?php echo $_GET["candidate_id"];?>&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&menu_name=<?php echo $menutab[$i]["menu_name"];?>"><?php echo $menutab[$i]["menu_title"];?></a></li>
					<?php
					}
					?>
				</ul>
			  
			<div class="tab-content">
				
				<div class="tab-pane active" id="<?php echo $menutab[0]["menu_name"];?>">Loading...</div>			
				<?php
					for($i=1;$i<count($menutab);$i++) {
				?>
				<div class="tab-pane" id="<?php echo $menutab[$i]["menu_name"];?>">Loading...</div>
				<?php
				}
				?>
			</div>		
		
		<?php
		}
		else {
			echo "no data";
		}
		?>
		</div>
	</div>
<?php
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#myTabs a').click(function (e) {
		e.preventDefault();
	  
		var url = $(this).attr("data-url");
		var href = this.hash;
		var pane = $(this);
		
		// ajax load from data-url
		$(href).load(url,function(result){      
			pane.tab('show');
		});
	});

	// load first tab content
	$('#<?php echo $menutab[0]["menu_name"];?>').load($('.active a').attr("data-url"),function(result){
	  $('.active a').tab('show');
	});
});
</script>