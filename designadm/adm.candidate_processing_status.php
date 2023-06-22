<?php
//candidate_processing_status
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

	$job_vacancy_id=(isset($_GET["job_vacancy_id"]) && $_GET["job_vacancy_id"]<>"")?decoded($_GET["job_vacancy_id"]):"";
	$candidate_apply_id=(isset($_GET["candidate_apply_id"]) && $_GET["candidate_apply_id"]<>"")?decoded($_GET["candidate_apply_id"]):"";
	$candidate_apply_stage=(isset($_GET["candidate_apply_stage"]) && $_GET["candidate_apply_stage"]<>"")?decoded($_GET["candidate_apply_stage"]):"";
	$candidate_apply_date=(isset($_GET["candidate_apply_date"]) && $_GET["candidate_apply_date"]<>"")?decoded($_GET["candidate_apply_date"]):"";
	$candidate_apply_status=(isset($_GET["candidate_apply_status"]) && $_GET["candidate_apply_status"]<>"")?decoded($_GET["candidate_apply_status"]):"";
	
	// echo $job_vacancy_id."<br>";
	// echo $candidate_apply_id."<br>";
	// echo $candidate_apply_stage."<br>";
	// echo $candidate_apply_date."<br>";
	// echo $candidate_apply_status."<br>";
	
	$candidate_id=(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"")?decoded($_GET["candidate_id"]):"";
		
	$datavacancy=admin_getJobAdv($job_vacancy_id,"detail");
	$dataresume=admin_getDetailCandidate($candidate_id);
	$datatemplate=admin_getMailTemplate();
	$datarecruiter=admin_getEmployee("pic");
	
	//tambahan shakti 30 mei 2018
	$homebase=admin_getHomeBase();
	
	/*$forjsonhomebase=array();
	for($h=0;$h<count($homebase);$h++) {
		$forjsonhomebase[]=$homebase[$h]["city_name"];
	}*/

	//print_r($forjsonhomebase);
	//$jsonhomebase=json_encode($forjsonhomebase);
	//echo($jsonhomebase);
	
	$mpass="";
	$mreject="";
	
	
	for($m=0;$m<count($datatemplate);$m++) {
		if($datatemplate[$m]["mail_template_status"]=="reject") {
			$rejectcontent=$datatemplate[$m]["mail_template_content"];
			$rejecttitle=$datatemplate[$m]["mail_template_title"];
			$rejectcontent = str_replace(array("\r", "\n"), '', $rejectcontent);
			$rejectcontent=html_entity_decode($rejectcontent);
			$rejecttitle = str_replace(array("\r", "\n"), '', $rejecttitle);
			
		}
		
		if($datatemplate[$m]["mail_template_status"]=="pass") {
			$passcontent=$datatemplate[$m]["mail_template_content"];
			$passtitle=$datatemplate[$m]["mail_template_title"];
			$passcontent = str_replace(array("\r", "\n"), '', $passcontent);
			$passcontent=html_entity_decode($passcontent);
			$passtitle = str_replace(array("\r", "\n"), '', $passtitle);
		}
	}
	
	/*echo "Pass = ".$passcontent."<br><br><br>";
	echo "Reject = ".$rejectcontent."<br><br><br>";
	exit;*/
	//print_r($datatemplate);exit;
	//print_r($datavacancy);
	//print_r($datarecruiter);
	//print_r($dataresume); exit;
	
	
	//tambahan shakti 2017-08-31
	$OrgCode=array();
	$JobTtlCode="";
	for($s=0;$s<count($datavacancy);$s++) {	
		if(isset($datavacancy[$s]["job_vacancy_titlecode"]) && !empty($datavacancy[$s]["job_vacancy_titlecode"]) ) {
			$explodeddata=explode("[",$datavacancy[$s]["job_vacancy_titlecode"]);
			$JobTtlCode=trim($explodeddata[0]);
			$dataOrg=str_replace("]","", $explodeddata[1]);
			$OrgCode=explode("|",$dataOrg);
			$tipeEmployee=$datavacancy[$s]["job_vacancy_type"];
		}	
	}
	//print_r($tipeEmployee);
	//print_r($OrgCode);

?>
<style type="text/css">
.modal-body {
    max-height:400px;
    overflow:auto;
}
.modal-content {
    height: 100%;
}
</style>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/js/jquery_1_11_1.min.js"></script> 
	<link href="<?php echo _PATHURL;?>/includes/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/datepicker/js/bootstrap-datetimepicker.min.js"></script> 

	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/summernote/summernote.min.js"></script> 

	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/select2_4.0.6/select2.min.js"></script> 
	<link href="<?php echo _PATHURL;?>/includes/select2_4.0.6/select2.min.css" rel="stylesheet" type="text/css">
		  
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				 <h4 class="modal-title">Processing Status for <?php echo $dataresume[0]["candidate_name"];?></h4>
			</div>			<!-- /modal-header -->
			<div class="modal-body">
				<fieldset <?php echo ($candidate_apply_stage=="offering" && $candidate_apply_status<>"ongoing")?"disabled":"";?> >
				<form name="processfrm" id="processfrm" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data" >
					<table border="0">
						<tr>
							<td style="width:150px; padding-bottom:20px;">Position</td>
							<td style="width:10px; padding-bottom:20px;">:</td>
							<td style="padding-bottom:20px;"><?php echo $datavacancy[0]["job_vacancy_name"];?></td>
							<td style="padding-bottom:20px;" colspan="2"></td>
						</tr>
						<tr>
							<td style="width:150px; padding-bottom:20px;">PIC</td>
							<td style="width:10px; padding-bottom:20px;">:</td>
							<td style="padding-bottom:20px;" colspan="3">
								<select class="form-control validate[condRequired[send_invitation]]" name="job_vacancy_pic" id="job_vacancy_pic">
									<option value="">Choose recruiter</option>
									<?php
									for($d=0;$d<count($datarecruiter);$d++) {
									?>
									<option value="<?php echo $datarecruiter[$d]["log_auth_id"];?>" <?php echo (isset($datavacancy[0]["log_auth_id"]) && $datarecruiter[$d]["log_auth_id"]==$datavacancy[0]["log_auth_id"])?"selected":"";?> ><?php echo $datarecruiter[$d]["employee_name"];?></option>
									<?php
									}
									?>
								</select>											
							</td>
						</tr>
						
						<tr>
							<td style="width:150px; padding-bottom:20px;">Stage</td>
							<td style="width:10px; padding-bottom:20px;">:</td>
							<td style="padding-bottom:20px;"><?php echo showStageName($candidate_apply_stage);?></td>
							<td style="padding-bottom:20px; padding-left:25px; text-align:right; width:250px;">Completion Date : </td>
							<td style="padding-bottom:20px; padding-left:5px;">
								<input type="hidden" name="candidate_schedule_date_cvscreening" value="<?php echo (isset($candidate_apply_stage) && $candidate_apply_stage=="cv-screening")?$candidate_apply_date:"";?>">
								<input type="text" id="candidate_completed_date" name="candidate_completed_date" class="form-control validate[required] input-sm" placeholder="yyyy-mm-dd hh:ii" style="width:150px;" onClick="pickCompleted();">
							</td>
						</tr>
						<tr>
							<td style="width:150px; padding-bottom:20px;">Processing Status</td>
							<td style="width:10px; padding-bottom:20px;">:</td>
							<td style="padding-bottom:20px;">
								<?php
								if($candidate_apply_stage=="offering") {
								?>
								<select name="candidate_apply_status" id="candidate_apply_status" class="form-control input-sm" <?php echo ($candidate_apply_stage=="offering")?"onChange='ifJoin(this);'":""; ?>>
									<option value="ongoing" <?php echo ($candidate_apply_status=="ongoing")?"selected":"";?> >ON GOING</option>
									<option value="join" <?php echo ($candidate_apply_status=="join")?"selected":"";?> >JOIN</option>
									<option value="disjoin" <?php echo ($candidate_apply_status=="disjoin")?"selected":"";?> >DISJOIN</option>
								</select>
								<?php
								}
								else {
								?>	
								<select name="candidate_apply_status" id="candidate_apply_status1" class="form-control input-sm" onChange="ifPassOrReject(this);">
									<option value="ongoing" <?php echo ($candidate_apply_status=="ongoing")?"selected":"";?> >ON GOING</option>
									<option value="pending" <?php echo ($candidate_apply_status=="pending")?"selected":"";?> >PENDING</option>
									<option value="reject" <?php echo ($candidate_apply_status=="reject")?"selected":"";?> >REJECT</option>
									<option value="pass" <?php echo ($candidate_apply_status=="pass")?"selected":"";?> >PASS</option>	
								</select>										
								<?php
								}
								?>
															
							</td>
							<td style="padding-bottom:20px; padding-left:25px; text-align:right;">Scheduled Date for next step : </td>
							<td style="padding-bottom:20px; padding-left:5px;"><input type="text" id="candidate_schedule_date" placeholder="yyyy-mm-dd hh:ii" name="candidate_schedule_date" class="form-control validate[required] input-sm" style="width:150px;" onClick="pickScheduled();"></td>
						</tr>
						<tr>
							<td style="width:150px; padding-bottom:20px;">Add notes to history</td>
							<td style="width:10px; padding-bottom:20px;">:</td>
							<td style="padding-bottom:20px;" colspan="3">
								<textarea  name="apply_history_notes" class="form-control validate[condRequired[candidate_schedule_date]]" style="height:40px; min-height:40px; max-height:40px;"></textarea>
							</td>
							
						</tr>
						<tr id="partpass" style="display:none;">
							<td colspan="5" style="padding:0; margin:0;">
								<table width="100%">
									<tr>
										<td style="width:150px; padding-bottom:20px;">Test Location</td>
										<td style="width:10px; padding-bottom:20px;">:</td>
										<td style="padding-bottom:20px;">
											<textarea  name="test_location" id="test_location" class="form-control validate[condRequired[send_invitation]]" style="height:40px; min-height:40px; max-height:40px;" disabled="disabled"></textarea>
										</td>
									</tr>
									
									<tr>
										<td></td>
										<td></td>
										<td style="padding-bottom:20px;">
											<input type="checkbox" name="send_invitation" id="send_invitation" disabled="disabled" value="y" OnClick="ShowPartSend(this);" />
											<label for="send_invitation">Send e-mail</label>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<hr>
						<tr>
							<td colspan="2"></td>
							<td colspan="3">
							<!-- part yang muncul jika status-nya PASS -->
								
								
								<div id="part_send" style="display:none;">
									<div style="float:left; width:100px;">Email title : </div>
									<div style="float:left;">
										<input type="text" name="mail_template_title" id="mail_template_title" disabled="disabled" class="form-control input-sm" style="width:200px;">
									</div>
									<div style="clear:both; height:15px;"></div>
									
									<div style="float:left; width:100px;">Email content : </div>
									<div style="float:left;">
										<textarea name="mail_template_content" id="mail_template_content" class="summernote"></textarea>
									</div>
									<div style="clear:both; height:15px;"></div>
									
								</div>
								
							</td>
						</tr>
						
						
						<!-- part yang muncul hanya jika statusnya join ketika offering -->						
						<tr id="partjoin" style="display:none;">
							<td colspan="5" style="padding:0; margin:0;" align="left">
								<table border="0" width="100%">
									<tr>
										<td style="width:150px; padding-bottom:20px;">Organization Code</td>
										<td style="width:10px; padding-bottom:20px;">:</td>
										<td style="padding-bottom:20px;">
											<select name="OrgCode" id="OrgCode" class="form-control input-sm" onChange="ifOrgSelected(this);">
												<option value="">Choose Organization</option>
											<?php
											for($s=0;$s<count($OrgCode);$s++) {
											?>
												<option value="<?php echo $OrgCode[$s]; ?>"><?php echo $OrgCode[$s]; ?></option>
											<?php
											}
											?>
											</select>
										</td>
										<td style="padding-bottom:20px; padding-left:25px; text-align:right;">Job Title Code :</td>
										<td style="padding-bottom:20px; padding-left:5px;"><input name="JobTtlCode" id="JobTtlCode" value="<?php echo $JobTtlCode; ?>" class="form-control input-sm" readonly="readonly"></td>
										
										
									</tr>

									<tr>
										<td style="width:150px; padding-bottom:20px;">Placement Location</td>
										<td style="width:10px; padding-bottom:20px;">:</td>										
										<td style="padding-bottom:20px;"><input name="LocationCode" id="LocationCode" class="form-control input-sm"></td>
										<!-- tambahan shakti 30 Mei 2018 -->
										<td style="padding-bottom:20px; padding-left:25px; text-align:right;">HomeBase Location :</td>
										<td style="padding-bottom:20px; padding-left:5px;">
											<select name="candidate_homebase" id="c_homebase" class="form-control input-sm">
												<option value="">Choose HomeBase</option>
											<?php
											for($h=0;$h<count($homebase);$h++) {
											?>
												<option value="<?php echo $homebase[$h]["city_code"]; ?>"><?php echo $homebase[$h]["city_name"]; ?></option>
											<?php
											}
											?>
											</select>
											
											<!--<input name="candidate_homebase" id="c_homebase" class="form-control"  onClick="pickHomeBase();">-->
											
										</td>
										<!--  akhir tambahan shakti 30 Mei 2018 -->
									</tr>
									
									<tr>
										<td style="width:150px; padding-bottom:20px;">Contract Start - End</td>
										<td style="width:10px; padding-bottom:20px;">:</td>
										<td style="padding-bottom:20px;"><input type="text" id="ContractStart" placeholder="yyyy-mm-dd" name="ContractStart" class="form-control input-sm" style="width:150px;" onClick="pickStart();"></td>
										<td style="padding-bottom:20px; padding-left:5px;" colspan="2"><input type="text" id="ContractEnd" placeholder="yyyy-mm-dd" name="ContractEnd" class="form-control input-sm" style="width:150px;" onClick="pickEnd();"> </td>
									</tr>
									
								</table>
							</td>
						</tr>
						<!-- end of part yang hanya muncul jika join pas offering -->
						
						
						<tr>
							<td></td>
							<td></td>
							<td>
								<input type="hidden" name="mod" value="adm_processCandidate">
								<input type="hidden" name="candidate_apply_id" value="<?php echo $candidate_apply_id;?>">
								<input type="hidden" name="job_vacancy_id" value="<?php echo $job_vacancy_id;?>">
								<input type="hidden" name="existing_apply_stage" value="<?php echo $candidate_apply_stage;?>">
								<input type="hidden" name="existing_apply_status" value="<?php echo $candidate_apply_status;?>">
								<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
								<input type="hidden" name="candidate_email" value="<?php echo $dataresume[0]["candidate_email"];?>">
								<input type="hidden" name="candidate_name" value="<?php echo $dataresume[0]["candidate_name"];?>">
								<input type="submit" class="btn btn-primary" value="PROCESS">
							</td>
							<td style="padding-bottom:20px;" colspan="2"></td>
						</tr>
						
					</table>
				</form>
				</fieldset>
			</div>			<!-- /modal-body -->
			<div class="modal-footer">
				<!-- <a href="<?php echo _PATHURL;?>/index.php?mod=listperstage&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>" class="btn btn-default">Close</a> -->
				<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		
	<script>
		$(document).on("hidden.bs.modal", function (e) {
			$(e.target).removeData("bs.modal").find(".modal-content").empty();
		});
	</script>


<script type="text/javascript">
	function ifJoin(sel)
	{
		//alert(sel.value);
		//tambahan Shakti 6 September 2017 untuk yg join.
		if($("#candidate_apply_status").val()== "join") {
			$("#partjoin").show();
			//$("#candidate_schedule_date").attr("readonly", "readonly");
			//$("#candidate_completed_date").attr("readonly", "readonly");	
			$("#OrgCode").addClass("validate[required]");
			$("#JobTtlCodeCode").addClass("validate[required]");
			$("#LocationCode").addClass("validate[required]");
			$("#ContractStart").addClass("validate[required]");
			$("#ContractEnd").addClass("validate[required]");
			
		}
		else{
			$("#partpass").hide();
			$("#send_invitation").removeAttr("checked");
			$("#send_invitation").attr("disabled", "disabled");
			$("#part_send").hide();
			$("#mail_template_title").val("");
			$("#mail_template_content").val("");
			$("#test_location").val("");
			$("#time_test").val("");
			
			$("#mail_template_title").attr("disabled", "disabled");
			$("#test_location").attr("disabled", "disabled");
			$("#time_test").attr("disabled", "disabled");

			//tambahan Shakti 6 September 2017 untuk yg join.
			$("#partjoin").hide();
			$("#OrgCode").removeAttr("selected");
			$("#JobTtlCode").val("");
			$("#LocationCode").val("");
			$("#candidate_schedule_date").removeAttr("readonly");
			$("#candidate_completed_date").removeAttr("readonly");			

			$("#OrgCode").removeClass("validate[required]");
			$("#JobTtlCodeCode").removeClass("validate[required]");
			$("#LocationCode").removeClass("validate[required]");
			$("#ContractStart").removeClass("validate[required]");
			$("#ContractEnd").removeClass("validate[required]");
			
			
		}
	}
	
	function ifOrgSelected(org)
	{
		//alert(org.value);
		var res = org.value;
		var loc=res.substring(2, 5);
		$("#LocationCode").val(loc);
	}
	
	$(document).ready(function pickStart()
	{
		$("#ContractStart").datetimepicker( {
	    format: "yyyy-mm-dd hh:ii",
		autoclose: true
		});
	});
	
	$(document).ready(function pickEnd()
	{
		$("#ContractEnd").datetimepicker( {
	    format: "yyyy-mm-dd hh:ii",
		autoclose: true
		});
	});
	
	$(document).ready(function pickCompleted()
	{
		$("#candidate_completed_date").datetimepicker( {
	    format: "yyyy-mm-dd",
		autoclose: true
		});
	});

	$(document).ready(function pickScheduled()
	{
		$("#candidate_schedule_date").datetimepicker( {
	    format: "yyyy-mm-dd",
		autoclose: true
		});
	});

	
	function ShowPartSend(sel){
		
		if($("#send_invitation").val()=='y'){
			$("#part_send").show();
			$("#mail_template_title").removeAttr("disabled");
			//$("#mail_template_content").removeAttr("disabled");
			$('#mail_template_content').summernote('enable');		
			$("#test_location").removeAttr("disabled");
			
		} else {
			$("#part_send").hide();
			
			$("#mail_template_title").val("");
			$("#mail_template_content").val("");
			//$("#test_location").val("");

			$("#mail_template_title").attr("disabled", "disabled");
			//$("#mail_template_content").attr("disabled", "disabled");
			$('#mail_template_content').summernote('disable');
			//$("#test_location").attr("disabled", "disabled");
		}

	}
	
</script>	
	
<script type="text/javascript">
	function ifPassOrReject(sel)
	{
		//alert(sel.value);
		//tambahan Shakti 6 October 2017 untuk yg pass or reject.
		if($("#candidate_apply_status1").val() =="pass" || $("#candidate_apply_status1").val() =="reject"){
						
			//alert($(this).attr("value"));
			
			$("#test_location").removeAttr("disabled");
			$("#mail_template_content").code('');
			
			var candidate_name = "<?php echo $dataresume[0]["candidate_name"];?>";
			var candidate_apply_stage = "<?php ($candidate_apply_stage!="Offering")?showStageName(adm_getNextStage($candidate_apply_stage))." stage ":" Offering stage ";?>";
			var jadwal = $("#candidate_schedule_date").val();
			var pecah = jadwal.split(" ");
			var candidate_schedule_date = new Date(pecah[0]).toDateString();
			
			//alert(new Date(candidate_schedule_date).toDateString());
			
			var candidate_schedule_time = pecah[1];
			var candidate_test_location = $('#test_location').val();
			var job_vacancy_pic = $("#job_vacancy_pic option:selected").text();	
			
			//alert(job_vacancy_pic);
			
			$("#partpass").show();
			/* $("#send_invitation").addClass(" validate[condRequired[candidate_apply_status]"); */
			$("#send_invitation").removeAttr("disabled");
			
			
			
			if($("#candidate_apply_status1").val() == "pass") {
				/*alert('sini pass');*/
				
				passtitle="<?php echo  $passtitle;?>";
				passcontent="<?php echo  $passcontent;?>";
				
				passcontent=passcontent.replace("[candidate_name]",candidate_name);
				passcontent=passcontent.replace("[candidate_apply_stage]",candidate_apply_stage);
				passcontent=passcontent.replace("[candidate_schedule_date]",candidate_schedule_date);
				passcontent=passcontent.replace("[candidate_schedule_time]",candidate_schedule_time);
				passcontent=passcontent.replace("[candidate_test_location]",candidate_test_location);
				passcontent=passcontent.replace("[recruiter_name]",job_vacancy_pic);							
				
				$("#mail_template_title").val(passtitle);
				
				//$("#mail_template_content").val(passcontent);
				$('#mail_template_content').code(passcontent);
				//alert('sini pass');
				

			}
			if($("#candidate_apply_status1").val()== "reject") {
				//alert('sini reject');
				var rejecttitle;
				var rejectcontent;

				rejecttitle="<?php echo  $rejecttitle;?>";
				rejectcontent="<?php echo  $rejectcontent;?>";
				
				rejectcontent=rejectcontent.replace("[candidate_name]",candidate_name);
				rejectcontent=rejectcontent.replace("[recruiter_name]",job_vacancy_pic);
				
				$("#mail_template_title").val(rejecttitle);
				$("#mail_template_content").code(rejectcontent);
				//$('#mail_template_content').summernote('insertText', rejectcontent);

			}
			
			
		}
		else {
			$("#partpass").hide();
			$("#send_invitation").removeAttr("checked");
			$("#send_invitation").attr("disabled", "disabled");
			$("#part_send").hide();
			$("#mail_template_title").val("");
			$("#mail_template_content").val("");
			$("#test_location").val("");
			$("#time_test").val("");
			
			$("#mail_template_title").attr("disabled", "disabled");
			$("#test_location").attr("disabled", "disabled");
			$("#time_test").attr("disabled", "disabled");		

			//tambahan Shakti 6 October 2017 untuk yg join.
			$("#partjoin").hide();
			$("#OrgCode").removeAttr("selected");
			$("#JobTtlCode").val("");
			$("#LocationCode").val("");
			$("#ContractStart").val("");
			$("#ContractEnd").val("");

			
		}
	}
</script>	
	
<script type="text/javascript">
$(document).ready(function(){
	
	$("#candidate_completed_date").datetimepicker( {
	    format: "yyyy-mm-dd hh:ii",
		autoclose: true
	});
	
	$("#candidate_schedule_date").datetimepicker( {
	    format: "yyyy-mm-dd hh:ii",
		autoclose: true
	});
	
	$('#mail_template_content').summernote({
	  toolbar: [
		//[groupname, [button list]]
		['para', ['ul', 'ol']]
	  ],
	  height: 150,
	  width: 500
	});
		
	
	$('#candidate_schedule_date').change(function() {
		var jadwal=$("#candidate_schedule_date").val();
		var pecah = jadwal.split(" ");
		var candidate_schedule_date = new Date(pecah[0]).toDateString();
		var candidate_schedule_time=pecah[1];
		var passcontent="<?php echo  $passcontent;?>";

		var candidate_name = "<?php echo $dataresume[0]["candidate_name"];?>";
		var candidate_apply_stage = "<?php ($candidate_apply_stage!="Offering")?showStageName(adm_getNextStage($candidate_apply_stage)). " stage ":" Offering stage ";?>";
		var candidate_test_location=$('#test_location').val();
		var job_vacancy_pic = $("#job_vacancy_pic option:selected").text();				


		passcontent=passcontent.replace("[candidate_name]",candidate_name);
		passcontent=passcontent.replace("[candidate_apply_stage]",candidate_apply_stage);
		passcontent=passcontent.replace("[candidate_schedule_date]",candidate_schedule_date);
		passcontent=passcontent.replace("[candidate_schedule_time]",candidate_schedule_time);
		passcontent=passcontent.replace("[candidate_test_location]",candidate_test_location);
		passcontent=passcontent.replace("[recruiter_name]",job_vacancy_pic);							


		
		if($("#candidate_apply_status1").val() == "pass") {
			$('#mail_template_content').code(passcontent);
		}
		
		if($("#candidate_apply_status1").val()== "reject") {
			//alert('sini reject');
			var rejecttitle;
			var rejectcontent;

			rejecttitle="<?php echo  $rejecttitle;?>";
			rejectcontent="<?php echo  $rejectcontent;?>";
			
			rejectcontent=rejectcontent.replace("[candidate_name]",candidate_name);
			rejectcontent=rejectcontent.replace("[recruiter_name]",job_vacancy_pic);
			
			$("#mail_template_title").val(rejecttitle);
			$("#mail_template_content").code(rejectcontent);
			//$('#mail_template_content').summernote('insertText', rejectcontent);

		}
		//alert(candidate_name);
		//alert(candidate_apply_stage);
		//alert(jadwal);
		//alert(tgl_jadwal);
		//alert(jam_jadwal);
		
		
		
	});
	
	
	$('#test_location').change(function() {
		var jadwal=$("#candidate_schedule_date").val();
		var pecah = jadwal.split(" ");
		var candidate_schedule_date = new Date(pecah[0]).toDateString();
		var candidate_schedule_time=pecah[1];
		var passcontent="<?php echo  $passcontent;?>";

		var candidate_name = "<?php echo $dataresume[0]["candidate_name"];?>";
		var candidate_apply_stage = "<?php ($candidate_apply_stage!="Offering")?showStageName(adm_getNextStage($candidate_apply_stage))." stage ":" Offering stage ";?>";
		var candidate_test_location=$('#test_location').val();
		var job_vacancy_pic = $("#job_vacancy_pic option:selected").text();				


		passcontent=passcontent.replace("[candidate_name]",candidate_name);
		passcontent=passcontent.replace("[candidate_apply_stage]",candidate_apply_stage);
		passcontent=passcontent.replace("[candidate_schedule_date]",candidate_schedule_date);
		passcontent=passcontent.replace("[candidate_schedule_time]",candidate_schedule_time);
		passcontent=passcontent.replace("[candidate_test_location]",candidate_test_location);
		passcontent=passcontent.replace("[recruiter_name]",job_vacancy_pic);							
		
		if($("#candidate_apply_status1").val() == "pass") {
			$('#mail_template_content').code(passcontent);
		}
		
		if($("#candidate_apply_status1").val()== "reject") {
			//alert('sini reject');
			var rejecttitle;
			var rejectcontent;

			rejecttitle="<?php echo  $rejecttitle;?>";
			rejectcontent="<?php echo  $rejectcontent;?>";
			
			rejectcontent=rejectcontent.replace("[candidate_name]",candidate_name);
			rejectcontent=rejectcontent.replace("[recruiter_name]",job_vacancy_pic);
			
			$("#mail_template_title").val(rejecttitle);
			$("#mail_template_content").code(rejectcontent);
			//$('#mail_template_content').summernote('insertText', rejectcontent);

		}

		
	});
	
	$('#job_vacancy_pic').change(function() {
		var jadwal=$("#candidate_schedule_date").val();
		var pecah = jadwal.split(" ");
		var candidate_schedule_date = new Date(pecah[0]).toDateString();
		var candidate_schedule_time=pecah[1];
		var passcontent="<?php echo  $passcontent;?>";

		var candidate_name = "<?php echo $dataresume[0]["candidate_name"];?>";
		var candidate_apply_stage = "<?php ($candidate_apply_stage!="Offering")?showStageName(adm_getNextStage($candidate_apply_stage))." stage ":" Offering stage ";?>";
		var candidate_test_location=$('#test_location').val();
		var job_vacancy_pic = $("#job_vacancy_pic option:selected").text();				


		passcontent=passcontent.replace("[candidate_name]",candidate_name);
		passcontent=passcontent.replace("[candidate_apply_stage]",candidate_apply_stage);
		passcontent=passcontent.replace("[candidate_schedule_date]",candidate_schedule_date);
		passcontent=passcontent.replace("[candidate_schedule_time]",candidate_schedule_time);
		passcontent=passcontent.replace("[candidate_test_location]",candidate_test_location);
		passcontent=passcontent.replace("[recruiter_name]",job_vacancy_pic);							
		
		if($("#candidate_apply_status1").val() == "pass") {
			$('#mail_template_content').code(passcontent);
		}
		if($("#candidate_apply_status1").val()== "reject") {
			//alert('sini reject');
			var rejecttitle;
			var rejectcontent;

			rejecttitle="<?php echo  $rejecttitle;?>";
			rejectcontent="<?php echo  $rejectcontent;?>";
			
			rejectcontent=rejectcontent.replace("[candidate_name]",candidate_name);
			rejectcontent=rejectcontent.replace("[recruiter_name]",job_vacancy_pic);
			
			$("#mail_template_title").val(rejecttitle);
			$("#mail_template_content").code(rejectcontent);
			//$('#mail_template_content').summernote('insertText', rejectcontent);

		}
		
		
	});
	
	
	
	
	
});	
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#processfrm").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>

<?php
}
?>