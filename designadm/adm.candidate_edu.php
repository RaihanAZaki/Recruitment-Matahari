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
		
		$dataedu=admin_getDataEdu(decoded($_GET["candidate_id"]));
		//print_r($dataedu);exit;

		$data=array();
		for($i=0;$i<count($dataedu);$i++) {
		$data[$i]["candidate_edu_id"]=(isset($_SESSION["session"]["candidate_edu_id"][$i]) && $_SESSION["session"]["candidate_edu_id"][$i]<>"")?$_SESSION["session"]["candidate_edu_id"][$i]:((isset($dataedu[$i]["candidate_edu_id"]))?$dataedu[$i]["candidate_edu_id"]:"");
		$data[$i]["candidate_edu_degree"]=(isset($_SESSION["session"]["candidate_edu_degree"][$i]) && $_SESSION["session"]["candidate_edu_degree"][$i]<>"")?$_SESSION["session"]["candidate_edu_degree"][$i]:((isset($dataedu[$i]["candidate_edu_degree"]))?$dataedu[$i]["candidate_edu_degree"]:"");
		$data[$i]["candidate_edu_institution"]=(isset($_SESSION["session"]["candidate_edu_institution"][$i]) && $_SESSION["session"]["candidate_edu_institution"][$i]<>"")?$_SESSION["session"]["candidate_edu_institution"][$i]:((isset($dataedu[$i]["candidate_edu_institution"]))?$dataedu[$i]["candidate_edu_institution"]:"");
		$data[$i]["candidate_edu_major"]=(isset($_SESSION["session"]["candidate_edu_major"][$i]) && $_SESSION["session"]["candidate_edu_major"][$i]<>"")?$_SESSION["session"]["candidate_edu_major"][$i]:((isset($dataedu[$i]["candidate_edu_major"]))?$dataedu[$i]["candidate_edu_major"]:"");
		$data[$i]["candidate_edu_gpa"]=(isset($_SESSION["session"]["candidate_edu_gpa"][$i]) && $_SESSION["session"]["candidate_edu_gpa"][$i]<>"")?$_SESSION["session"]["candidate_edu_gpa"][$i]:((isset($dataedu[$i]["candidate_edu_gpa"]))?$dataedu[$i]["candidate_edu_gpa"]:"00.00");
		$data[$i]["candidate_edu_city"]=(isset($_SESSION["session"]["candidate_edu_city"][$i]) && $_SESSION["session"]["candidate_edu_city"][$i]<>"")?$_SESSION["session"]["candidate_edu_city"][$i]:((isset($dataedu[$i]["candidate_edu_city"]))?$dataedu[$i]["candidate_edu_city"]:"");
		$data[$i]["candidate_edu_start"]=(isset($_SESSION["session"]["candidate_edu_start"][$i]) && $_SESSION["session"]["candidate_edu_start"][$i]<>"")?$_SESSION["session"]["candidate_edu_start"][$i]:((isset($dataedu[$i]["candidate_edu_start"]))?$dataedu[$i]["candidate_edu_start"]:"");
		$data[$i]["candidate_edu_end"]=(isset($_SESSION["session"]["candidate_edu_end"][$i]) && $_SESSION["session"]["candidate_edu_end"][$i]<>"")?$_SESSION["session"]["candidate_edu_end"][$i]:((isset($dataedu[$i]["candidate_edu_end"]))?$dataedu[$i]["candidate_edu_end"]:"");
		$data[$i]["candidate_edu_notes"]=(isset($_SESSION["session"]["candidate_edu_notes"][$i]) && $_SESSION["session"]["candidate_edu_notes"][$i]<>"")?$_SESSION["session"]["candidate_edu_notes"][$i]:((isset($dataedu[$i]["candidate_edu_notes"]))?$dataedu[$i]["candidate_edu_notes"]:"");
		}
		/*
		print_r($data);
		exit;
		*/
		$array_edu=array('Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD');
		
?>
		<div><?php echo system_showAlert();?></div>
	
		<form class="form-horizontal" name="eduform" id="eduform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form">
		
			<div class="form-group">
				<div style="text-align:right;" class="col-md-12 top10 bottom30 asterisk">* <i><b>is required (mandatory field)</b></i> </div>
			</div>
		
				<?php
				for($i=0;$i<5;$i++) {
					$urut=$i+1;
				?>
					<div id="education_<?php echo $i;?>">
						<span style="text-align:right; color:#aaaaaa;"><cufonize><h2>education #<?php echo $urut;?></h2></cufonize></span>
						<div class="form-group">
							<label class="control-label col-sm-2" for="candidate_edu_degree">Degree: &nbsp;<span class="asterisk">*</span></label>
							<div class="col-sm-3">
								<select class="form-control" name="candidate_edu_degree_<?php echo $i;?>" id="candidate_edu_degree_<?php echo $i;?>">
									<option value="">Choose degree</option>
									<?php
									for($ed=0;$ed<count($array_edu);$ed++) {
									?>
									<option value="<?php echo $array_edu[$ed];?>" <?php echo (isset($data[$i]["candidate_edu_degree"]) && $array_edu[$ed]==$data[$i]["candidate_edu_degree"])?"selected":"";?> ><?php echo $array_edu[$ed];?></option>
									<?php
									}
									?>
								</select>
								<!--<input type="text" class="form-control" name="candidate_edu_degree_<?php echo $i;?>" id="candidate_edu_degree_<?php echo $i;?>">-->
							</div>
							<label class="control-label col-sm-2" for="candidate_edu_institution">Institution: &nbsp;<span class="asterisk">*</span></label>
							<!--<div class="col-sm-5">
								<input type="text" class="form-control validate[condRequired[candidate_edu_degree_<?php echo $i;?>]]" name="candidate_edu_institution_<?php echo $i;?>" id="candidate_edu_institution_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_institution"]) && $data[$i]["candidate_edu_institution"]<>"")?$data[$i]["candidate_edu_institution"]:"";?>">
							</div>-->
							<div class="col-sm-5">
								<div class="button-group">
									<input name="candidate_edu_institution_<?php echo $i;?>" id="edu_institution_<?php echo $i;?>" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="candidate_edu_start">Start year: &nbsp;<span class="asterisk">*</span></label>
							<div class="col-sm-3">
								<input type="text" class="form-control input-group-md"  name="candidate_edu_start_<?php echo $i;?>" id="candidate_edu_start_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_start"]) && $data[$i]["candidate_edu_start"]<>"")?$data[$i]["candidate_edu_start"]:"1950";?>"/>
							</div>
							<label class="control-label col-sm-2" for="candidate_edu_city">City: &nbsp;<span class="asterisk">*</span></label>
							<div class="col-sm-5">
								<div class="button-group">
									<input name="candidate_edu_city_<?php echo $i;?>" id="edu_city_<?php echo $i;?>" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="candidate_edu_end">End year: &nbsp;<span class="asterisk">*</span></label>
							<div class="col-sm-3">
								<input type="text" class="form-control input-group-md"  name="candidate_edu_end_<?php echo $i;?>" id="candidate_edu_end_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_end"]) && $data[$i]["candidate_edu_end"]<>"")?$data[$i]["candidate_edu_end"]:"1950";?>"/>
							</div>						
							<label class="control-label col-sm-2" for="candidate_edu_notes">Notes:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="candidate_edu_notes_<?php echo $i;?>" id="candidate_edu_notes_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_notes"]) && $data[$i]["candidate_edu_notes"]<>"")?$data[$i]["candidate_edu_notes"]:"";?>">
							</div>										
						</div>
						
						<!-- part khusus mahasiswa -->
						<div class="form-group" id="partmhs_<?php echo $i;?>" style="display:none;">
							<label class="control-label col-sm-2" for="candidate_edu_gpa">GPA: &nbsp;<span class="asterisk">*</span></label>
							<div class="col-sm-3">
								<input type="text" class="form-control input-group-md"  name="candidate_edu_gpa_<?php echo $i;?>" id="candidate_edu_gpa_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_gpa"]) && $data[$i]["candidate_edu_gpa"]<>"")?$data[$i]["candidate_edu_gpa"]:"0.00";?>"/>
							</div>
							<label class="control-label col-sm-2" for="candidate_edu_major">Major: &nbsp;<span class="asterisk">*</span></label>
							<!--<div class="col-sm-5">
								<input type="text" class="form-control" name="candidate_edu_major_<?php echo $i;?>" id="candidate_edu_major_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_major"]) && $data[$i]["candidate_edu_major"]<>"")?$data[$i]["candidate_edu_major"]:"";?>">
							</div>-->	
							<div class="col-sm-5">
								<div class="button-group">
									<input name="candidate_edu_major_<?php echo $i;?>" id="edu_major_<?php echo $i;?>" class="form-control">
								</div>
							</div>							
						</div>
						<!-- end of part khusus mahasiswa -->
						
					</div>
					
					<input type="hidden" name="candidate_edu_id_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_edu_id"]) && $data[$i]["candidate_edu_id"]<>"")?$data[$i]["candidate_edu_id"]:"0";?>">
					
					<hr>					
				
				<?php
				}
				?>
					<input type="hidden" name="mod" value="admin_editEdu"/>
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
	
	$("input[name='candidate_edu_start_<?php echo $i;?>']").TouchSpin({
		min: 1950,
		max: <?php echo date("Y");?>,
		step: 1,
		decimals: 0
	});
	
	$("input[name='candidate_edu_end_<?php echo $i;?>']").TouchSpin({
		min: 1950,
		max: <?php echo date("Y");?>,
		step: 1,
		decimals: 0
	});

	$("input[name='candidate_edu_gpa_<?php echo $i;?>']").TouchSpin({
		min: 1,
		max: 4,
		step: 0.01,
		decimals: 2
	});
	
	$('#edu_city_<?php echo $i;?>').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'candidate_edu_city_<?php echo $i;?>',
		<?php
		if(isset($data[$i]["candidate_edu_city"]) && $data[$i]["candidate_edu_city"]<>"") {
		?>
		value: ['<?php echo $data[$i]["candidate_edu_city"];?>'],
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
	
	$('#edu_institution_<?php echo $i;?>').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.eduinstitution.php',
		name: 'candidate_edu_institution_<?php echo $i;?>',
		<?php
		if(isset($data[$i]["candidate_edu_institution"]) && $data[$i]["candidate_edu_institution"]<>"") {
		?>
		value: ['<?php echo $data[$i]["candidate_edu_institution"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'institution',
		<?php
		}
		?>
		valueField: 'university_name',
	    displayField: 'university_name'
	});	
	
	$('#edu_major_<?php echo $i;?>').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.edumajor.php',
		name: 'candidate_edu_major_<?php echo $i;?>',
		<?php
		if(isset($data[$i]["candidate_edu_major"]) && $data[$i]["candidate_edu_major"]<>"") {
		?>
		value: ['<?php echo $data[$i]["candidate_edu_major"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'major',
		<?php
		}
		?>
		valueField: 'EduMjrName',
	    displayField: 'EduMjrName'
	});	
	
	
    $("#candidate_edu_degree_<?php echo $i;?>").change(function(){
                $( "#candidate_edu_degree_<?php echo $i;?> option:selected").each(function(){
                    if($(this).attr("value")=="Doctoral - S3" || $(this).attr("value")=="Master - S2" || $(this).attr("value")=="Bachelor - S1" || $(this).attr("value")=="Diploma"){
                        $("#partmhs_<?php echo $i?>").show();
						$("#candidate_edu_major_<?php echo $i;?>").addClass(" validate[condRequired[candidate_edu_degree_<?php echo $i;?>]]");
						$("#candidate_edu_major_<?php echo $i;?>").removeAttr("disabled");
                    }
					else {
                        $("#partmhs_<?php echo $i?>").hide();
						$("#candidate_edu_major_<?php echo $i;?>").attr("disabled", "disabled")
						
					}
                });
	}).change();
	
	
	<?php	
	}
	?>
	
	
	
});
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#eduform").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});

	var dateFormat = /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.]((?:19|20)\d\d)$/

	function checkLEGAL(field, rules, i, options){
		var match = field.val().match(dateFormat)
		console.log(match)
		if (!match) return "Please enter valid date (dd-mm-yyyy)"
		var bd=new Date(match[3], match[2]-1, match[1])
		console.log(bd)
		var diff = Math.floor((new Date).getTime() - bd.getTime());
		var day = 1000* 60 * 60 * 24

		var days = Math.floor(diff/day)
		var months = Math.floor(days/31)
		var years = Math.floor(months/12)
		console.log(days,months,years)
		if (years<16) return "You have to be at least 17 year old to register"
	}
</script>