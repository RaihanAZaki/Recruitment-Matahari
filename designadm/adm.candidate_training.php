<?php
session_start();
	
include("../setconf.php");

if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {
	loadAllModules();

	if(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"") {
			$datatraining=admin_getDataTraining(decoded($_GET["candidate_id"]));


			$data=array();
			for($i=0;$i<count($datatraining);$i++) {
				$data[$i]["candidate_training_id"] = (isset($_SESSION["session"]["candidate_training_id"][$i]) && $_SESSION["session"]["candidate_training_id"][$i] <> "")
				? $_SESSION["session"]["candidate_training_id"][$i]
				: (isset($datatraining[$i]["candidate_training_id"]) ? $datatraining[$i]["candidate_training_id"] : "");
			  
			  $data[$i]["candidate_training_name"] = (isset($_SESSION["session"]["candidate_training_name"][$i]) && $_SESSION["session"]["candidate_training_name"][$i] <> "")
				? $_SESSION["session"]["candidate_training_name"][$i]
				: (isset($datatraining[$i]["candidate_training_name"]) ? $datatraining[$i]["candidate_training_name"] : "");
			  
			  $data[$i]["candidate_training_institution"] = (isset($_SESSION["session"]["candidate_training_institution"][$i]) && $_SESSION["session"]["candidate_training_institution"][$i] <> "")
				? $_SESSION["session"]["candidate_training_institution"][$i]
				: (isset($datatraining[$i]["candidate_training_institution"]) ? $datatraining[$i]["candidate_training_institution"] : "");
			  
			  $data[$i]["candidate_training_city"] = (isset($_SESSION["session"]["candidate_training_city"][$i]) && $_SESSION["session"]["candidate_training_city"][$i] <> "")
				? $_SESSION["session"]["candidate_training_city"][$i]
				: (isset($datatraining[$i]["candidate_training_city"]) ? $datatraining[$i]["candidate_training_city"] : "");
			  
			  $data[$i]["candidate_training_year"] = (isset($_SESSION["session"]["candidate_training_year"][$i]) && $_SESSION["session"]["candidate_training_year"][$i] <> "")
				? $_SESSION["session"]["candidate_training_year"][$i]
				: (isset($datatraining[$i]["candidate_training_year"]) ? $datatraining[$i]["candidate_training_year"] : "");
			  
			  $data[$i]["candidate_training_duration"] = (isset($_SESSION["session"]["candidate_training_duration"][$i]) && $_SESSION["session"]["candidate_training_duration"][$i] <> "")
				? $_SESSION["session"]["candidate_training_duration"][$i]
				: (isset($datatraining[$i]["candidate_training_duration"]) ? $datatraining[$i]["candidate_training_duration"] : "");
			  
			  $data[$i]["candidate_training_sponsor"] = (isset($_SESSION["session"]["candidate_training_sponsor"][$i]) && $_SESSION["session"]["candidate_training_sponsor"][$i] <> "")
				? $_SESSION["session"]["candidate_training_sponsor"][$i]
				: (isset($datatraining[$i]["candidate_training_sponsor"]) ? $datatraining[$i]["candidate_training_sponsor"] : "");
			  
			}
			/*
			print_r($data);
			exit;
			*/
			if(count($data)>0) $data=clean_view($data);

			?>
					<div><?php echo system_showAlert();?></div>
				
					<form class="form-horizontal" name="trainingform" id="trainingform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form">

						<div class="form-group">
							<div style="text-align:right;" class="col-md-12 top10 bottom30 asterisk">* <i><b>is required (mandatory field)</b></i> </div>
						</div>

						
							<?php
							for($i=0;$i<5;$i++) {
								$urut=$i+1;
							?>
								<div id="education_<?php echo $i;?>">
									<span style="text-align:right; color:#aaaaaa;"><cufonize><h2>training #<?php echo $urut;?></h2></cufonize></span>
									<div class="form-group">
										<label class="control-label col-sm-2" for="candidate_training_name">Name:&nbsp;<span class="asterisk">*</span></label>
										<div class="col-sm-4">
												<input name="candidate_training_name_<?php echo $i;?>" id="candidate_training_name_<?php echo $i;?>" class="form-control" value="<?php echo (isset($data[$i]["candidate_training_name"]) && $data[$i]["candidate_training_name"]<>"")?$data[$i]["candidate_training_name"]:"";?>" placeholder="Name of the training program" title="Name of the training program">
										</div>
										<label class="control-label col-sm-2" for="candidate_training_institution">Institution:&nbsp;<span class="asterisk">*</span></label>
										<div class="col-sm-2">
												<input name="candidate_training_institution_<?php echo $i;?>" id="candidate_training_institution_<?php echo $i;?>" class="form-control validate[condRequired[candidate_training_name_<?php echo $i;?>]]" value="<?php echo (isset($data[$i]["candidate_training_institution"]) && $data[$i]["candidate_training_institution"]<>"")?$data[$i]["candidate_training_institution"]:"";?>" placeholder="Institution which organize the training" title="Institution which organize the training">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="candidate_training_year">Year:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control input-group-md validate[condRequired[candidate_training_name_<?php echo $i;?>]]"  name="candidate_training_year_<?php echo $i;?>" id="candidate_training_year_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_training_year"]) && $data[$i]["candidate_training_year"]<>"")?$data[$i]["candidate_training_year"]:"1950";?>"/>
										</div>
										<label class="control-label col-sm-2" for="candidate_training_city">City:&nbsp;<span class="asterisk">*</span></label>
										<div class="col-sm-4">
											<div class="button-group">
												<input name="candidate_training_city_<?php echo $i;?>" id="training_city_<?php echo $i;?>" class="form-control validate[condRequired[candidate_training_name_<?php echo $i;?>]]">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" for="candidate_training_duration">Duration:&nbsp;<span class="asterisk">*</span></label>
										<div class="col-sm-4">
											<input type="text" class="form-control input-group-md validate[condRequired[candidate_training_name_<?php echo $i;?>]]"  name="candidate_training_duration_<?php echo $i;?>" id="candidate_training_duration_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_training_duration"]) && $data[$i]["candidate_training_duration"]<>"")?$data[$i]["candidate_training_duration"]:"";?>"/>
										</div>						
										<label class="control-label col-sm-2" for="candidate_training_sponsor">Sponsor:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="candidate_training_sponsor_<?php echo $i;?>" id="candidate_training_sponsor_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_training_sponsor"]) && $data[$i]["candidate_training_sponsor"]<>"")?$data[$i]["candidate_training_sponsor"]:"";?>">
										</div>										
									</div>
									
									<input type="hidden" name="candidate_training_id_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_training_id"]) && $data[$i]["candidate_training_id"]<>"")?$data[$i]["candidate_training_id"]:"0";?>">
									
								</div>
								<hr>					
							
							<?php
							}
							?>
						<input type="hidden" name="mod" value="admin_editTraining"/>
						<input type="hidden" name="job_vacancy_id" value="<?php echo (isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";?>" />
						<input type="hidden" name="candidate_apply_stage" value="<?php echo (isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";?>" />
						<input type="hidden" name="candidate_id" value="<?php echo (isset($_GET["candidate_id"]))?decoded($_GET["candidate_id"]):"";?>" />
						<input type="hidden" name="menu_name" value="<?php echo (isset($_GET["menu_name"]))?$_GET["menu_name"]:"";?>" />
						
						<div class="form-group"> 
							<div class="col-md-offset-2 col-md-4">
								<button type="submit" class="btn btn-success">SAVE AND NEXT</button>
							</div>
						</div>
					</form>				

<?php
	}
}
?>
<script type="text/javascript">
$(document).ready(function(){
	<?php
	for($i=0;$i<5;$i++) {
	?>
	
	$("input[name='candidate_training_year_<?php echo $i;?>']").TouchSpin({
		min: 1950,
		max: <?php echo date("Y");?>,
		step: 1,
		decimals: 0
	});
	
	
	$('#training_city_<?php echo $i;?>').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'candidate_training_city_<?php echo $i;?>',
		<?php
		if(isset($data[$i]["candidate_training_city"]) && $data[$i]["candidate_training_city"]<>"") {
		?>
		value: ['<?php echo $data[$i]["candidate_training_city"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Location',
		<?php
		}
		?>
		valueField: 'city_name',
	    displayField: 'city_name'
	});	
		
	<?php	
	}
	?>
	
	
	
});
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#trainingform").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>