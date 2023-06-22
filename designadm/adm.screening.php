<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

$array_edu=array('Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD');
$array_religion=array('Islam', 'Roman Catholic', 'Protestant', 'Hindu', 'Budhist','Confucianism');
?>

<div class="row bottom30">

	<div class="panel panel-default">
		<div class="panel-body" style="text-align:left;">
		
			<div><?php echo system_showAlert();?></div>
		
			<h4><cufonize>Choose criteria(s) for screening</cufonize></h4>
			<hr>
			
			<form name="frmsearch" id="frmsearch" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
							
				<div class="form-group left30">
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_name" name="chk_candidate_name" value="1">Candidate's name</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-sm" name="candidate_name" id="candidate_name" disabled="">
							</div>
						</div>
					</div>
					<div class="col-md-1 nopadding"></div>
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_email" name="chk_candidate_email" value="1">Candidate's email</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-sm" name="candidate_email" id="candidate_email" disabled="">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group left30">
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_edu_degree" name="chk_candidate_edu_degree" value="1">Education degree</label>
							<div class="col-md-8">
								<select class="form-control input-sm" name="candidate_edu_degree" id="candidate_edu_degree" disabled="">
									<option value="">Choose degree</option>
									<?php
									for($ed=0;$ed<count($array_edu);$ed++) {
									?>
									<option value="<?php echo $array_edu[$ed];?>"><?php echo $array_edu[$ed];?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-1 nopadding"></div>
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_jobexp_lob" name="chk_candidate_jobexp_lob" value="1">Line of Business</label>
							<div class="col-md-8">
								<input name="candidate_jobexp_lob" id="jobexp_lob" class="form-control input-sm" title="Line of business/ Industry">
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group left30">
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_edu_major" name="chk_candidate_edu_major" value="1">Education major</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-sm" name="candidate_edu_major" id="candidate_edu_major" disabled="">
							</div>
						</div>
					</div>
					<div class="col-md-1 nopadding"></div>
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_graduate" name="chk_graduate" value="1">Graduation year</label>
							<div class="col-md-8">
								<div class="col-md-5 nopadding"><input name="candidate_edu_end1" id="candidate_edu_end1" class="form-control input-sm" title="Graduation year" disabled="" style="width:100px;"></div>
								<div class="col-md-2 nopadding">up to</div>
								<div class="col-md-5 nopadding"><input name="candidate_edu_end2" id="candidate_edu_end2" class="form-control input-sm" title="Graduation year" disabled="" style="width:100px;"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group left30">
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_jobexp_position" name="chk_candidate_jobexp_position" value="1">Job Position</label>
							<div class="col-md-8">
								<input name="candidate_jobexp_position" id="candidate_jobexp_position" class="form-control input-sm" title="Latest job position" disabled="">
							</div>
						</div>
					</div>
					<div class="col-md-1 nopadding"></div>
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_c_city" name="chk_candidate_c_city" value="1">Current city</label>
							<div class="col-md-8">
								<input name="candidate_c_city" id="candidate_c_city" class="form-control input-sm" title="Current city">
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group left30">
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_religion" name="chk_candidate_religion" value="1">Religion</label>
							<div class="col-md-8">
								<select class="form-control input-sm" name="candidate_religion" id="candidate_religion" disabled="">
									<option value="">Choose religion</option>
									<?php
									for($r=0;$r<count($array_religion);$r++) {
									?>
									<option value="<?php echo $array_religion[$r];?>"><?php echo $array_religion[$r];?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-1 nopadding"></div>
					<div class="col-md-5 nopadding">
						<div class="checkbox nopadding">
							<label class="control-label col-md-4" style="text-align:left;"><input type="checkbox" id="chk_candidate_gender" name="chk_candidate_gender" value="1">Candidate's sex</label>
							<div class="col-md-8">
								<select class="form-control input-sm" name="candidate_gender" id="candidate_gender" disabled="">
									<option value="">Choose gender</option>
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group top30"> 
					<div class="col-md-12" style="text-align:center;">
						<input type="hidden" name="mod" value="adm_search"/>
						<button type="submit" class="btn btn-success"><i class="fa fa-search"></i> &nbsp;SEARCH</button>
					</div>
				</div>
				
				
			</form>
		
		</div>
	</div>
	
</div>
<script>
	$('#chk_candidate_name').change(function(){
	   $("#candidate_name").prop("disabled", !$(this).is(':checked'));
	});

	$('#chk_candidate_email').change(function(){
	   $("#candidate_email").prop("disabled", !$(this).is(':checked'));
	});

	$('#chk_candidate_edu_degree').change(function(){
	   $("#candidate_edu_degree").prop("disabled", !$(this).is(':checked'));
	});

	$('#chk_candidate_jobexp_position').change(function(){
	   $("#candidate_jobexp_position").prop("disabled", !$(this).is(':checked'));
	});

	$('#chk_candidate_religion').change(function(){
	   $("#candidate_religion").prop("disabled", !$(this).is(':checked'));
	});

	$('#chk_candidate_gender').change(function(){
	   $("#candidate_gender").prop("disabled", !$(this).is(':checked'));
	});
	
	$('#chk_candidate_edu_major').change(function(){
	   $("#candidate_edu_major").prop("disabled", !$(this).is(':checked'));
	});
	
	$('#chk_graduate').change(function(){
	   $("#candidate_edu_end1").prop("disabled", !$(this).is(':checked'));
	   $("#candidate_edu_end2").prop("disabled", !$(this).is(':checked'));
	   $("#candidate_edu_end1").val(<?php echo date("Y");?>);
	   $("#candidate_edu_end2").val(<?php echo date("Y");?>);
	});

	
	$('#chk_candidate_jobexp_lob').change(function(){
		var ms = $('#jobexp_lob').magicSuggest({});
		if(this.checked) {
			ms.enable();
		}
		else {
			ms.disable();
		}
	});
	
	$('#chk_candidate_c_city').change(function(){
		var ms = $('#candidate_c_city').magicSuggest({});
		if(this.checked) {
			ms.enable();
		}
		else {
			ms.disable();
		}
	});

	$('#jobexp_lob').magicSuggest({
	    resultAsString: true,
	    maxSelection: 1,
		disabled: true,
	    data: '<?php echo _PATHURL;?>/application/api.lob.php',
		name: 'candidate_jobexp_lob',
		placeholder: 'Line of Business',
		title: 'Line of Business',
		valueField: 'lob_name',
	    displayField: 'lob_name'
	});		
	$('#candidate_c_city').magicSuggest({
	    resultAsString: true,
	    maxSelection: 1,
		disabled: true,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'candidate_c_city',
		placeholder: 'Current city',
		title: 'Current city',
		valueField: 'city_name',
	    displayField: 'city_name'
	});		


</script>