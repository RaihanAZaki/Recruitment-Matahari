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
		$datalob=getDataLob();
		$datajob=admin_getDataJob(decoded($_GET["candidate_id"]));
		
		//print_r($datajob);


		$data=array();
		for($i=0;$i<count($datajob);$i++) {
			$data[$i]["candidate_jobexp_id"] = (isset($_SESSION["session"]["candidate_jobexp_id"][$i]) && $_SESSION["session"]["candidate_jobexp_id"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_id"][$i]
			: (isset($datajob[$i]["candidate_jobexp_id"])
				? $datajob[$i]["candidate_jobexp_id"]
				: "");
		
			
			$data[$i]["candidate_jobexp_company"] = (isset($_SESSION["session"]["candidate_jobexp_company"][$i]) && $_SESSION["session"]["candidate_jobexp_company"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_company"][$i]
			: (isset($datajob[$i]["candidate_jobexp_company"]) ? $datajob[$i]["candidate_jobexp_company"] : "");
			  
			$data[$i]["candidate_jobexp_address"] = (isset($_SESSION["session"]["candidate_jobexp_address"][$i]) && $_SESSION["session"]["candidate_jobexp_address"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_address"][$i]
			: (isset($datajob[$i]["candidate_jobexp_address"]) ? $datajob[$i]["candidate_jobexp_address"] : "");
			  
			$data[$i]["candidate_jobexp_phone"] = (isset($_SESSION["session"]["candidate_jobexp_phone"][$i]) && $_SESSION["session"]["candidate_jobexp_phone"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_phone"][$i]
			: (isset($datajob[$i]["candidate_jobexp_phone"]) ? $datajob[$i]["candidate_jobexp_phone"] : "");
		  
		  $data[$i]["candidate_jobexp_lob"] = (isset($_SESSION["session"]["candidate_jobexp_lob"][$i]) && $_SESSION["session"]["candidate_jobexp_lob"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_lob"][$i]
			: (isset($datajob[$i]["candidate_jobexp_lob"]) ? $datajob[$i]["candidate_jobexp_lob"] : "00.00");
		  
		  $data[$i]["candidate_jobexp_numemployee"] = (isset($_SESSION["session"]["candidate_jobexp_numemployee"][$i]) && $_SESSION["session"]["candidate_jobexp_numemployee"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_numemployee"][$i]
			: (isset($datajob[$i]["candidate_jobexp_numemployee"]) ? $datajob[$i]["candidate_jobexp_numemployee"] : "");
		
			$data[$i]["candidate_jobexp_spvname"] = (isset($_SESSION["session"]["candidate_jobexp_spvname"][$i]) && $_SESSION["session"]["candidate_jobexp_spvname"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_spvname"][$i]
			: (isset($datajob[$i]["candidate_jobexp_spvname"]) ? $datajob[$i]["candidate_jobexp_spvname"] : "");
		  
		  $data[$i]["candidate_jobexp_spvposition"] = (isset($_SESSION["session"]["candidate_jobexp_spvposition"][$i]) && $_SESSION["session"]["candidate_jobexp_spvposition"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_spvposition"][$i]
			: (isset($datajob[$i]["candidate_jobexp_spvposition"]) ? $datajob[$i]["candidate_jobexp_spvposition"] : "");
		  
		  $data[$i]["candidate_jobexp_subposition"] = (isset($_SESSION["session"]["candidate_jobexp_subposition"][$i]) && $_SESSION["session"]["candidate_jobexp_subposition"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_subposition"][$i]
			: (isset($datajob[$i]["candidate_jobexp_subposition"]) ? $datajob[$i]["candidate_jobexp_subposition"] : "");
		  
		  $data[$i]["candidate_jobexp_subnumber"] = (isset($_SESSION["session"]["candidate_jobexp_subnumber"][$i]) && $_SESSION["session"]["candidate_jobexp_subnumber"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_subnumber"][$i]
			: (isset($datajob[$i]["candidate_jobexp_subnumber"]) ? $datajob[$i]["candidate_jobexp_subnumber"] : "");
		  
		  $data[$i]["candidate_jobexp_position"] = (isset($_SESSION["session"]["candidate_jobexp_position"][$i]) && $_SESSION["session"]["candidate_jobexp_position"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_position"][$i]
			: (isset($datajob[$i]["candidate_jobexp_position"]) ? $datajob[$i]["candidate_jobexp_position"] : "");
		  
		  $data[$i]["candidate_jobexp_desc"] = (isset($_SESSION["session"]["candidate_jobexp_desc"][$i]) && $_SESSION["session"]["candidate_jobexp_desc"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_desc"][$i]
			: (isset($datajob[$i]["candidate_jobexp_desc"]) ? $datajob[$i]["candidate_jobexp_desc"] : "");
		  
		  $data[$i]["candidate_jobexp_salary"] = (isset($_SESSION["session"]["candidate_jobexp_salary"][$i]) && $_SESSION["session"]["candidate_jobexp_salary"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_salary"][$i]
			: (isset($datajob[$i]["candidate_jobexp_salary"]) ? $datajob[$i]["candidate_jobexp_salary"] : "");
		  
		  $data[$i]["candidate_jobexp_start"] = (isset($_SESSION["session"]["candidate_jobexp_start"][$i]) && $_SESSION["session"]["candidate_jobexp_start"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_start"][$i]
			: (isset($datajob[$i]["candidate_jobexp_start"]) ? $datajob[$i]["candidate_jobexp_start"] : "");
		  
		  $data[$i]["candidate_jobexp_end"] = (isset($_SESSION["session"]["candidate_jobexp_end"][$i]) && $_SESSION["session"]["candidate_jobexp_end"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_end"][$i]
			: (isset($datajob[$i]["candidate_jobexp_end"]) ? $datajob[$i]["candidate_jobexp_end"] : "");
		  
		  $data[$i]["candidate_jobexp_leaving"] = (isset($_SESSION["session"]["candidate_jobexp_leaving"][$i]) && $_SESSION["session"]["candidate_jobexp_leaving"][$i] <> "")
			? $_SESSION["session"]["candidate_jobexp_leaving"][$i]
			: (isset($datajob[$i]["candidate_jobexp_leaving"]) ? $datajob[$i]["candidate_jobexp_leaving"] : "");
		  
		}
		/*
		print_r($data);
		exit;
		*/
		if(count($data)>0) $data=clean_view($data);

		?>
			
				<div><?php echo system_showAlert();?></div>
				
				<form class="form-horizontal" name="expform" id="expform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form">
					<div class="form-group">
						<div style="text-align:right;" class="col-md-12 top10 bottom30 asterisk">* <i><b>is required (mandatory field)</b></i> </div>
					</div>
					
						<?php
						for($i=0;$i<3;$i++) {
							$urut=$i+1;
							$mulai=(isset($data[$i]["candidate_jobexp_start"]) && $data[$i]["candidate_jobexp_start"]<>"")?explode("-",$data[$i]["candidate_jobexp_start"]):"";
							$selesai=(isset($data[$i]["candidate_jobexp_end"]) && $data[$i]["candidate_jobexp_end"]<>"")?explode("-",$data[$i]["candidate_jobexp_end"]):"";
						?>
							<div id="experience_<?php echo $i;?>" class="bottom10 top10">
								<!--<span style="text-align:right; color:#aaaaaa;"><cufonize><h2>#<?php echo $urut;?></h2></cufonize></span>-->
								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_company">Company:&nbsp;<span class="asterisk">*</span></label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_company_<?php echo $i;?>" id="candidate_jobexp_company_<?php echo $i;?>" class="form-control" value="<?php echo (isset($data[$i]["candidate_jobexp_company"]) && $data[$i]["candidate_jobexp_company"]<>"")?$data[$i]["candidate_jobexp_company"]:"";?>" placeholder="Name of the company" title="Name of the company">
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_start">Start / End:&nbsp;<span class="asterisk">*</span></label>
									<div class="col-md-2">
										<input type="text" id="candidate_jobexp_start_<?php echo $i;?>" placeholder="start" name="candidate_jobexp_start_<?php echo $i;?>" class="form-control validate[condRequired[candidate_jobexp_company_<?php echo $i;?>],funcCall[checkLEGAL]] datepicker" value="<?php echo (isset($mulai) && is_array($mulai))?$mulai[0]."-".$mulai[1]:"";?>" title="Join Date">
									</div>							
									<div class="col-md-2">
										<input type="text" id="candidate_jobexp_end_<?php echo $i;?>" placeholder="end" name="candidate_jobexp_end_<?php echo $i;?>" class="form-control validate[condRequired[candidate_jobexp_company_<?php echo $i;?>],funcCall[checkLEGAL]] datepicker" value="<?php echo (isset($selesai) && is_array($selesai))?$selesai[0]."-".$selesai[1]:"";?>" title="Resign Date">
									</div>							
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_lob">Industry:&nbsp;<span class="asterisk">*</span></label>
									<div class="col-sm-4">
										<div class="button-group">
											<input name="candidate_jobexp_lob_<?php echo $i;?>" id="jobexp_lob_<?php echo $i;?>" class="form-control" title="Line of business/ Industry">
										</div>
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_position">Position:&nbsp;<span class="asterisk">*</span></label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_position_<?php echo $i;?>" id="candidate_jobexp_position_<?php echo $i;?>" class="form-control validate[condRequired[candidate_jobexp_company_<?php echo $i;?>]]" value="<?php echo (isset($data[$i]["candidate_jobexp_position"]) && $data[$i]["candidate_jobexp_position"]<>"")?$data[$i]["candidate_jobexp_position"]:"";?>" placeholder="Your position" title="Your position">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_address">Address:</label>
									<div class="col-sm-4">
											<textarea class="form-control" style="width:100%;"  name="candidate_jobexp_address_<?php echo $i;?>" id="candidate_jobexp_address_<?php echo $i;?>" placeholder="Address of the company" title="Address of the company"><?php echo (isset($data[$i]["candidate_jobexp_address"]) && $data[$i]["candidate_jobexp_address"]<>"")?$data[$i]["candidate_jobexp_address"]:"";?></textarea>
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_desc">Job Description / Task:&nbsp;<span class="asterisk">*</span></label>
									<div class="col-sm-4">
											<textarea class="form-control validate[condRequired[candidate_jobexp_company_<?php echo $i;?>]]" style="width:100%;"  name="candidate_jobexp_desc_<?php echo $i;?>" id="candidate_jobexp_desc_<?php echo $i;?>" placeholder="Describe your task/ job description" title="Describe your task/ job description"><?php echo (isset($data[$i]["candidate_jobexp_desc"]) && $data[$i]["candidate_jobexp_desc"]<>"")?$data[$i]["candidate_jobexp_desc"]:"";?></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_phone">Phone:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_phone_<?php echo $i;?>" id="candidate_jobexp_phone_<?php echo $i;?>" class="form-control validate[custom[phone]]" value="<?php echo (isset($data[$i]["candidate_jobexp_phone"]) && $data[$i]["candidate_jobexp_phone"]<>"")?$data[$i]["candidate_jobexp_phone"]:"";?>" placeholder="Phone number of the company" title="Phone number of the company">
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_salary">Monthly Salary:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_salary_<?php echo $i;?>" id="candidate_jobexp_salary_<?php echo $i;?>" class="form-control validate[custom[integer],min[0]]" value="<?php echo (isset($data[$i]["candidate_jobexp_salary"]) && $data[$i]["candidate_jobexp_salary"]<>"")?$data[$i]["candidate_jobexp_salary"]:"";?>" placeholder="Your latest salary in this company" title="Your latest salary in this company">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_numemployee"># Employees:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_numemployee_<?php echo $i;?>" id="candidate_jobexp_numemployee_<?php echo $i;?>" class="form-control validate[custom[integer],min[1]]" value="<?php echo (isset($data[$i]["candidate_jobexp_numemployee"]) && $data[$i]["candidate_jobexp_numemployee"]<>"")?$data[$i]["candidate_jobexp_numemployee"]:"";?>" placeholder="Number of employees" title="Number of employees">
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_subnumber"># Subordinate:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_subnumber_<?php echo $i;?>" id="candidate_jobexp_subnumber_<?php echo $i;?>" class="form-control validate[custom[integer],min[0]]" value="<?php echo (isset($data[$i]["candidate_jobexp_subnumber"]) && $data[$i]["candidate_jobexp_subnumber"]<>"")?$data[$i]["candidate_jobexp_subnumber"]:"";?>" placeholder="Number of subordinate if any" title="Number of subordinate if any">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_spvname">Spv. Name:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_spvname_<?php echo $i;?>" id="candidate_jobexp_spvname_<?php echo $i;?>" class="form-control" value="<?php echo (isset($data[$i]["candidate_jobexp_spvname"]) && $data[$i]["candidate_jobexp_spvname"]<>"")?$data[$i]["candidate_jobexp_spvname"]:"";?>" placeholder="Name of your superior/ supervisor" title="Name of your superior/ supervisor">
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_subposition">Sub. position:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_subposition_<?php echo $i;?>" id="candidate_jobexp_subposition_<?php echo $i;?>" class="form-control" value="<?php echo (isset($data[$i]["candidate_jobexp_subposition"]) && $data[$i]["candidate_jobexp_subposition"]<>"")?$data[$i]["candidate_jobexp_subposition"]:"";?>" placeholder="Position name of your subordinate" title="Position name of your subordinate">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="candidate_jobexp_spvposition">Spv. Position:</label>
									<div class="col-sm-4">
											<input name="candidate_jobexp_spvposition_<?php echo $i;?>" id="candidate_jobexp_spvposition_<?php echo $i;?>" class="form-control" value="<?php echo (isset($data[$i]["candidate_jobexp_spvposition"]) && $data[$i]["candidate_jobexp_spvposition"]<>"")?$data[$i]["candidate_jobexp_spvposition"]:"";?>" placeholder="Position name of your superior/ spv" title="Position name of your superior/ spv">
									</div>
									<label class="control-label col-sm-2" for="candidate_jobexp_leaving">Leaving reason:</label>
									<div class="col-sm-4">
											<textarea class="form-control" style="width:100%;"  name="candidate_jobexp_leaving_<?php echo $i;?>" id="candidate_jobexp_leaving_<?php echo $i;?>" placeholder="Reason behind your resignation" title="Reason behind your resignation"><?php echo (isset($data[$i]["candidate_jobexp_leaving"]) && $data[$i]["candidate_jobexp_leaving"]<>"")?$data[$i]["candidate_jobexp_leaving"]:"";?></textarea>
									</div>
								</div>
								
							</div>
							
							<input type="hidden" name="candidate_jobexp_id_<?php echo $i;?>" value="<?php echo (isset($data[$i]["candidate_jobexp_id"]) && $data[$i]["candidate_jobexp_id"]<>"")?$data[$i]["candidate_jobexp_id"]:"0";?>">

							<hr>					
						
						<?php
						}
						?>
					<input type="hidden" name="mod" value="admin_editJobexp" />
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

<script>
	$(document).ready(function(){
		$("#expform").validationEngine();
	});
   
	var dateFormat = /^((?:19|20)\d\d)[- /.](0[1-9]|1[012])$/

	function checkLEGAL(field, rules, i, options){
		var match = field.val().match(dateFormat)
		console.log(match)
		if (!match) return "Please enter valid date (yyyy-mm)"
		
		var maksimal = '<?php echo date("Y-m");?>';
		var minimal = '<?php echo date("Y-m", strtotime('-25 year'));?>';
		if(field.val()>maksimal || field.val()<minimal) return "Allowed value between <?php echo date("Y-m", strtotime('-50 year'));?> and <?php echo date("Y-m");?>"
	}  
</script>


<script type="text/javascript">
$(document).ready(function(){
	<?php
	for($i=0;$i<5;$i++) {
	?>
	
	$("#candidate_jobexp_start_<?php echo $i;?>").datepicker( {
	    format: "yyyy-mm",
	    viewMode: "months", 
	    minViewMode: "months"
	});
	
	$("#candidate_jobexp_end_<?php echo $i;?>").datepicker( {
	    format: "yyyy-mm",
	    viewMode: "months", 
	    minViewMode: "months"
	});
	
	$('#jobexp_lob_<?php echo $i;?>').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.lob.php',
		name: 'candidate_jobexp_lob_<?php echo $i;?>',
		<?php
		if(isset($data[$i]["candidate_jobexp_lob"]) && $data[$i]["candidate_jobexp_lob"]<>"") {
		?>
		value: ['<?php echo $data[$i]["candidate_jobexp_lob"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Line of Business',
		<?php
		}
		?>
		title: 'Line of Business',
		valueField: 'lob_name',
	    displayField: 'lob_name'
	});		
	
	<?php	
	}
	?>
	
	
	
});
</script>