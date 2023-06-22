<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}


$array_edu=array('Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD');

//update by Shakti 2017_09_10
$array_emptype=array('Daily Worker', 'Internship', 'Contract', 'Permanent', 'Contract Retirement', 'M T P', 'Probation', 'LAKU PANDAI');
//$array_emptype=array('DAILY WORKER', 'KONTRAK', 'KONTRAK PENSIUN', 'M T P', 'MAGANG', 'PERCOBAAN', 'TETAP');


$array_adstatus=array('Pending', 'Open', 'Finished', 'Closed');

$array_marital=array('Single', 'Married', 'Divorce', 'Separated');
$array_grade=array('1A', '1B', '1C', '2A', '2B', '2C', '3A', '3B', '3C', '4A', '4B', '4C', '5A', '5B', '5C', '6A', '6B', '6C', '6D', '7 CEO');

$datavacancy=(isset($_GET["job_vacancy_id"]) && $_GET["job_vacancy_id"]<>"")?admin_getJobAdv($_GET["job_vacancy_id"],"detail"):"";
//echo $_GET["type"]."<br>";
$type=(isset($_GET["type"]) && $_GET["type"]=="edit")?"edit":"add";

$status_id=(isset($_GET["view"]) && $_GET["view"]<>"")?decoded($_GET["view"]):"open";
$page=(isset($_GET["page"]) && $_GET["page"]<>"")?$_GET["page"]:"1";

$datadivision=admin_getDivision();
$datarecruiter=admin_getEmployee("pic");
$dataapprover=admin_getEmployee("hrd");

//print_r($dataapprover);exit;

//print_r($_SESSION);

/* job_vacancy_id, job_vacancy_name, job_vacancy_city, job_vacancy_desc, job_vacancy_brief, job_vacancy_degree, job_vacancy_type, 
job_vacancy_startdate, job_vacancy_enddate, log_auth_id, status_id */

//echo "type= ".$type;exit;

if($type=="edit") {
	$data["job_vacancy_city"]=(isset($datavacancy[0]["job_vacancy_city"]) && $datavacancy[0]["job_vacancy_city"]<>"")?$datavacancy[0]["job_vacancy_city"]:"";
	$data["job_vacancy_name"]=(isset($datavacancy[0]["job_vacancy_name"]) && $datavacancy[0]["job_vacancy_name"]<>"")?$datavacancy[0]["job_vacancy_name"]:"";
	$data["job_vacancy_desc"]=(isset($datavacancy[0]["job_vacancy_desc"]) && $datavacancy[0]["job_vacancy_desc"]<>"")?$datavacancy[0]["job_vacancy_desc"]:"";
	$data["job_vacancy_brief"]=(isset($datavacancy[0]["job_vacancy_brief"]) && $datavacancy[0]["job_vacancy_brief"]<>"")?$datavacancy[0]["job_vacancy_brief"]:"";
	$data["job_vacancy_degree"]=(isset($datavacancy[0]["job_vacancy_degree"]) && $datavacancy[0]["job_vacancy_degree"]<>"")?$datavacancy[0]["job_vacancy_degree"]:"";
	$data["job_vacancy_type"]=(isset($datavacancy[0]["job_vacancy_type"]) && $datavacancy[0]["job_vacancy_type"]<>"")?$datavacancy[0]["job_vacancy_type"]:"";
	$data["job_vacancy_startdate"]=(isset($datavacancy[0]["job_vacancy_startdate"]) && $datavacancy[0]["job_vacancy_startdate"]<>"")?$datavacancy[0]["job_vacancy_startdate"]:"";
	$data["job_vacancy_enddate"]=(isset($datavacancy[0]["job_vacancy_enddate"]) && $datavacancy[0]["job_vacancy_enddate"]<>"")?$datavacancy[0]["job_vacancy_enddate"]:"";
	$data["status_id"]=(isset($datavacancy[0]["status_id"]) && $datavacancy[0]["status_id"]<>"")?$datavacancy[0]["status_id"]:"";
	$data["job_vacancy_id"]=(isset($datavacancy[0]["job_vacancy_id"]) && $datavacancy[0]["job_vacancy_id"]<>"")?$datavacancy[0]["job_vacancy_id"]:"";
	$data["job_vacancy_gender"]=(isset($datavacancy[0]["job_vacancy_gender"]) && $datavacancy[0]["job_vacancy_gender"]<>"")?$datavacancy[0]["job_vacancy_gender"]:"";
	$data["job_vacancy_agemax"]=(isset($datavacancy[0]["job_vacancy_agemax"]) && $datavacancy[0]["job_vacancy_agemax"]<>"")?$datavacancy[0]["job_vacancy_agemax"]:"";
	$data["job_vacancy_marital"]=(isset($datavacancy[0]["job_vacancy_marital"]) && $datavacancy[0]["job_vacancy_marital"]<>"")?$datavacancy[0]["job_vacancy_marital"]:"";
	$data["job_vacancy_experience"]=(isset($datavacancy[0]["job_vacancy_experience"]) && $datavacancy[0]["job_vacancy_experience"]<>"")?$datavacancy[0]["job_vacancy_experience"]:"";
	$data["job_vacancy_requestby"]=(isset($datavacancy[0]["job_vacancy_requestby"]) && $datavacancy[0]["job_vacancy_requestby"]<>"")?$datavacancy[0]["job_vacancy_requestby"]:"";
	$data["job_vacancy_minsalary"]=(isset($datavacancy[0]["job_vacancy_minsalary"]) && $datavacancy[0]["job_vacancy_minsalary"]<>"")?$datavacancy[0]["job_vacancy_minsalary"]:"";
	$data["job_vacancy_maxsalary"]=(isset($datavacancy[0]["job_vacancy_maxsalary"]) && $datavacancy[0]["job_vacancy_maxsalary"]<>"")?$datavacancy[0]["job_vacancy_maxsalary"]:"";
	$data["job_vacancy_grade"]=(isset($datavacancy[0]["job_vacancy_grade"]) && $datavacancy[0]["job_vacancy_grade"]<>"")?$datavacancy[0]["job_vacancy_grade"]:"";
	$data["job_vacancy_headcount"]=(isset($datavacancy[0]["job_vacancy_headcount"]) && $datavacancy[0]["job_vacancy_headcount"]<>"")?$datavacancy[0]["job_vacancy_headcount"]:"";
	$data["job_vacancy_titlecode"]=(isset($datavacancy[0]["job_vacancy_titlecode"]) && $datavacancy[0]["job_vacancy_titlecode"]<>"")?$datavacancy[0]["job_vacancy_titlecode"]:"";
	$data["job_vacancy_titlename"]=(isset($datavacancy[0]["job_vacancy_titlename"]) && $datavacancy[0]["job_vacancy_titlename"]<>"")?$datavacancy[0]["job_vacancy_titlename"]:"";
	$data["job_vacancy_pic"]=(isset($datavacancy[0]["log_auth_id"]) && $datavacancy[0]["log_auth_id"]<>"")?$datavacancy[0]["log_auth_id"]:"";
	$data["job_vacancy_approver"]=(isset($datavacancy[0]["job_vacancy_approver"]) && $datavacancy[0]["job_vacancy_approver"]<>"")?$datavacancy[0]["job_vacancy_approver"]:"";
}
else {
	$data["job_vacancy_city"]=(isset($_SESSION["session"]["job_vacancy_city"][0]) && $_SESSION["session"]["job_vacancy_city"][0]<>"")?$_SESSION["session"]["job_vacancy_city"][0]:"";
	$data["job_vacancy_name"]=(isset($_SESSION["session"]["job_vacancy_name"]) && $_SESSION["session"]["job_vacancy_name"]<>"")?$_SESSION["session"]["job_vacancy_name"]:"";	
	$data["job_vacancy_desc"]=(isset($_SESSION["session"]["job_vacancy_desc"]) && $_SESSION["session"]["job_vacancy_desc"]<>"")?$_SESSION["session"]["job_vacancy_desc"]:"";	
	$data["job_vacancy_brief"]=(isset($_SESSION["session"]["job_vacancy_brief"]) && $_SESSION["session"]["job_vacancy_brief"]<>"")?$_SESSION["session"]["job_vacancy_brief"]:"";	
	$data["job_vacancy_degree"]=(isset($_SESSION["session"]["job_vacancy_degree"]) && $_SESSION["session"]["job_vacancy_degree"]<>"")?$_SESSION["session"]["job_vacancy_degree"]:"";	
	$data["job_vacancy_type"]=(isset($_SESSION["session"]["job_vacancy_type"]) && $_SESSION["session"]["job_vacancy_type"]<>"")?$_SESSION["session"]["job_vacancy_type"]:"";	
	$data["job_vacancy_startdate"]=(isset($_SESSION["session"]["job_vacancy_startdate"]) && $_SESSION["session"]["job_vacancy_startdate"]<>"")?$_SESSION["session"]["job_vacancy_startdate"]:"";	
	$data["job_vacancy_enddate"]=(isset($_SESSION["session"]["job_vacancy_enddate"]) && $_SESSION["session"]["job_vacancy_enddate"]<>"")?$_SESSION["session"]["job_vacancy_enddate"]:"";	
	$data["status_id"]=(isset($_SESSION["session"]["status_id"]) && $_SESSION["session"]["status_id"]<>"")?$_SESSION["session"]["status_id"]:"";	
	$data["job_vacancy_gender"]=(isset($_SESSION["session"]["job_vacancy_gender"]) && $_SESSION["session"]["job_vacancy_gender"]<>"")?$_SESSION["session"]["job_vacancy_gender"]:"";	
	$data["job_vacancy_agemax"]=(isset($_SESSION["session"]["job_vacancy_agemax"]) && $_SESSION["session"]["job_vacancy_agemax"]<>"")?$_SESSION["session"]["job_vacancy_agemax"]:"";	
	$data["job_vacancy_marital"]=(isset($_SESSION["session"]["job_vacancy_marital"]) && $_SESSION["session"]["job_vacancy_marital"]<>"")?$_SESSION["session"]["job_vacancy_marital"]:"";	
	$data["job_vacancy_experience"]=(isset($_SESSION["session"]["job_vacancy_experience"]) && $_SESSION["session"]["job_vacancy_experience"]<>"")?$_SESSION["session"]["job_vacancy_experience"]:"";	
	$data["job_vacancy_requestby"]=(isset($_SESSION["session"]["job_vacancy_requestby"]) && $_SESSION["session"]["job_vacancy_requestby"]<>"")?$_SESSION["session"]["job_vacancy_requestby"]:"";	
	$data["job_vacancy_minsalary"]=(isset($_SESSION["session"]["job_vacancy_minsalary"]) && $_SESSION["session"]["job_vacancy_minsalary"]<>"")?$_SESSION["session"]["job_vacancy_minsalary"]:"";	
	$data["job_vacancy_maxsalary"]=(isset($_SESSION["session"]["job_vacancy_maxsalary"]) && $_SESSION["session"]["job_vacancy_maxsalary"]<>"")?$_SESSION["session"]["job_vacancy_maxsalary"]:"";	
	$data["job_vacancy_grade"]=(isset($_SESSION["session"]["job_vacancy_grade"]) && $_SESSION["session"]["job_vacancy_grade"]<>"")?$_SESSION["session"]["job_vacancy_grade"]:"";	
	$data["job_vacancy_headcount"]=(isset($_SESSION["session"]["job_vacancy_headcount"]) && $_SESSION["session"]["job_vacancy_headcount"]<>"")?$_SESSION["session"]["job_vacancy_headcount"]:"";	
	$data["job_vacancy_titlecode"]=(isset($_SESSION["session"]["job_vacancy_titlecode"]) && $_SESSION["session"]["job_vacancy_titlecode"]<>"")?$_SESSION["session"]["job_vacancy_titlecode"]:"";	
	$data["job_vacancy_titlename"]=(isset($_SESSION["session"]["job_vacancy_titlename"]) && $_SESSION["session"]["job_vacancy_titlename"]<>"")?$_SESSION["session"]["job_vacancy_titlename"]:"";	
	$data["job_vacancy_pic"]=(isset($_SESSION["session"]["job_vacancy_pic"]) && $_SESSION["session"]["job_vacancy_pic"]<>"")?$_SESSION["session"]["job_vacancy_pic"]:$_SESSION["log_auth_id"];	
	$data["job_vacancy_approver"]=(isset($_SESSION["session"]["job_vacancy_approver"]) && $_SESSION["session"]["job_vacancy_approver"]<>"")?$_SESSION["session"]["job_vacancy_approver"]:"";	
}


if(count($data)>0) $data=clean_view($data);

?>
<div class="row bottom30">

<!-- bagian list job adv -->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label-control"><i class="fa fa-bookmark"> &nbsp;<?php echo ($type=="edit")?"Edit":"Add";?> Job Advertisement <?php echo ($type=="edit" && $data["job_vacancy_name"])?": ".$data["job_vacancy_name"]:"";?></i></span>
	</div>
	
	<div class="panel-body">
		<form name="updvacancy" id="updvacancy" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
			
			<div><?php echo system_showAlert();?></div>
			
			<div class="form-group">
				<div style="color:#FA9C0E; text-align:right;" class="col-md-12 top30"><i class="fa fa-exclamation-triangle warningsign"></i> <i><b>is required (mandatory field)</b></i> </div>
			</div>
		
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_name"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Position name :</label>
				<div class="col-md-6">
					<input type="text" class="form-control validate[required]" name="job_vacancy_name" id="job_vacancy_name" value="<?php echo (isset($data["job_vacancy_name"]) && $data["job_vacancy_name"]<>"")?$data["job_vacancy_name"]:"";?>" >
				</div>
			</div>
				
			<div class="form-group">
				<label class="control-label col-md-3" for="v_city"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Placement City :</label>
				<div class="col-md-6 bottom10">
					<div class="button-group">
						<input name="job_vacancy_city" id="v_city" class="form-control">
					</div>
				</div>
			</div>

			
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_desc"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Job description :</label>
				<div class="col-md-6">
					<textarea class="form-control validate[required] summernote" name="job_vacancy_desc" id="job_vacancy_desc"><?php echo (isset($data["job_vacancy_desc"]) && $data["job_vacancy_desc"]<>"")?$data["job_vacancy_desc"]:"";?></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_brief"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Brief description :</label>
				<div class="col-md-6">
					<textarea class="form-control validate[required] summernote" name="job_vacancy_brief" id="job_vacancy_brief"><?php echo (isset($data["job_vacancy_brief"]) && $data["job_vacancy_brief"]<>"")?$data["job_vacancy_brief"]:"";?></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="job_vacancy_degree"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Minimum Degree :</label>
				<div class="col-sm-3">
					<select class="form-control validate[required]" name="job_vacancy_degree" id="job_vacancy_degree">
						<option value="">Choose degree</option>
						<?php
						for($ed=0;$ed<count($array_edu);$ed++) {
						?>
						<option value="<?php echo $array_edu[$ed];?>" <?php echo (isset($data["job_vacancy_degree"]) && $array_edu[$ed]==$data["job_vacancy_degree"])?"selected":"";?> ><?php echo $array_edu[$ed];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-3" for="job_vacancy_gender">Gender :</label>
				<div class="col-sm-3">
					<select class="form-control" name="job_vacancy_gender" id="job_vacancy_gender">
						<option value="" <?php echo (isset($data["job_vacancy_gender"]) && $data["job_vacancy_gender"]=="")?"selected":"";?> >Male/ Female</option>
						<option value="male" <?php echo (isset($data["job_vacancy_gender"]) && $data["job_vacancy_gender"]=="male")?"selected":"";?>>Male</option>
						<option value="female" <?php echo (isset($data["job_vacancy_gender"]) && $data["job_vacancy_gender"]=="female")?"selected":"";?>>Female</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_agemax">Maximum age :</label>
				<div class="col-sm-3">
					<div class="input-group">
						<input type="text" class="form-control validate[custom[integer],min[17],max[60],minSize[2],maxSize[2]]" name="job_vacancy_agemax" id="job_vacancy_agemax" value="<?php echo (isset($data["job_vacancy_agemax"]) && $data["job_vacancy_agemax"]<>"")?$data["job_vacancy_agemax"]:"";?>"  aria-describedby="basic-addon2">
						<span class="input-group-addon" id="basic-addon2">years old</span>
					</div>
				</div>
			</div>
			

			<div class="form-group">
				<label for="job_vacancy_marital" class="col-md-3 control-label">Marital status:</label>
				<div class="col-md-3">
					<select class="form-control" name="job_vacancy_marital" id="job_vacancy_marital">
						<option value="">Marital Status</option>
						<?php
						for($g=0;$g<count($array_marital);$g++) {
						?>
						<option value="<?php echo $array_marital[$g];?>" <?php echo (isset($data["job_vacancy_marital"]) && $array_marital[$g]==$data["job_vacancy_marital"])?"selected":"";?> ><?php echo $array_marital[$g];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_experience">Working experience :</label>
				<div class="col-sm-2">
					<div class="input-group">
						<input type="text" class="form-control validate[custom[integer],min[0],max[60],minSize[1],maxSize[2]]" name="job_vacancy_experience" id="job_vacancy_experience" value="<?php echo (isset($data["job_vacancy_experience"]) && $data["job_vacancy_experience"]<>"")?$data["job_vacancy_experience"]:"";?>"  aria-describedby="basic-addon3">
						<span class="input-group-addon" id="basic-addon3">years</span>
					</div>
				</div>
			</div>


			<div class="form-group">
				<label for="candidate_weight" class="col-sm-3 control-label">Range of salary</label>
				<div class="col-sm-4">
						<input type="text" class="form-control input-group-md"  name="job_vacancy_minsalary" id="job_vacancy_minsalary" value="<?php echo (isset($data["job_vacancy_minsalary"]) && $data["job_vacancy_minsalary"]<>"")?$data["job_vacancy_minsalary"]:"0";?>"/>
				</div>
				<div class="col-sm-4">
						<input type="text" class="form-control input-group-md"  name="job_vacancy_maxsalary" id="job_vacancy_maxsalary" value="<?php echo (isset($data["job_vacancy_maxsalary"]) && $data["job_vacancy_maxsalary"]<>"")?$data["job_vacancy_maxsalary"]:"0";?>"/>
				</div>
				
			</div>

			
			<div class="form-group">
				<label class="control-label col-sm-3" for="job_vacancy_type"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Employment type :</label>
				<div class="col-sm-3">
					<select class="form-control validate[required]" name="job_vacancy_type" id="job_vacancy_type">
						<option value="">Choose Employment Type</option>
						<?php
						for($t=0;$t<count($array_emptype);$t++) {
						?>
						<option value="<?php echo $array_emptype[$t];?>" <?php echo (isset($data["job_vacancy_type"]) && $array_emptype[$t]==$data["job_vacancy_type"])?"selected":"";?> ><?php echo $array_emptype[$t];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			
			<div class="form-group">
				<label for="job_vacancy_marital" class="col-md-3 control-label"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Level/ Grade:</label>
				<div class="col-md-3">
					<select class="form-control validate[required]" name="job_vacancy_grade" id="job_vacancy_grade">
						<option value="">Choose Grade</option>
						<?php
						for($g=0;$g<count($array_grade);$g++) {
						?>
						<option value="<?php echo $array_grade[$g];?>" <?php echo (isset($data["job_vacancy_grade"]) && $array_grade[$g]==$data["job_vacancy_grade"])?"selected":"";?> ><?php echo $array_grade[$g];?></option>
						<?php
						}
						?>
					</select>
				
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_headcount"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> MPP / Headcount :</label>
				<div class="col-sm-2">
					<div class="input-group">
						<input type="text" class="form-control validate[custom[integer],min[0],max[99],minSize[1],maxSize[2]]" name="job_vacancy_headcount" id="job_vacancy_headcount" value="<?php echo (isset($data["job_vacancy_headcount"]) && $data["job_vacancy_headcount"]<>"")?$data["job_vacancy_headcount"]:"";?>"  aria-describedby="basic-addon3">
						<span class="input-group-addon" id="basic-addon3">person(s)</span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_titlecode"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> HRIS Job Title Code :</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="job_vacancy_titlecode" id="job_vacancy_titlecode" value="<?php echo (isset($data["job_vacancy_titlecode"]) && $data["job_vacancy_titlecode"]<>"")?$data["job_vacancy_titlecode"]:"";?>" >
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-9" style="font-size:smaller; color:#337AB7"><b>Format: JobTitleCode [OrgCode1|OrgCode2|...]</b><i> example: BHB000001 [BS880AST.APT|BS839.AST.APT|BS865.AST.APT]</i></div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="job_vacancy_titlename"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> HRIS Job Title Name :</label>
				<div class="col-md-6">
					<input type="text" class="form-control validate[required]" name="job_vacancy_titlename" id="job_vacancy_titlename" value="<?php echo (isset($data["job_vacancy_titlename"]) && $data["job_vacancy_titlename"]<>"")?$data["job_vacancy_titlename"]:"";?>" >
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-md-3" for="date1"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Opening Date : </label>
				<div class="col-md-3">
					<input value="<?php echo ( isset($data["job_vacancy_startdate"]) && $data["job_vacancy_startdate"]<>"" )?date("d-m-Y",strtotime($data["job_vacancy_startdate"])):"";?>" name="job_vacancy_startdate" class="form-control validate[required] date" type="text" id="date1" placeholder="dd-mm-yyyy" />
				</div>
				
				<label class="control-label col-md-2" for="date2"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Closing Date : </label>
				<div class="col-md-3">
					<input value="<?php echo ( isset($data["job_vacancy_enddate"]) && $data["job_vacancy_enddate"]<>"" )?date("d-m-Y",strtotime($data["job_vacancy_enddate"])):"";?>" name="job_vacancy_enddate" class="form-control validate[required] date" type="text" id="date2" placeholder="dd-mm-yyyy" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="job_vacancy_requestby"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Requested by :</label>
				<div class="col-sm-3">
					<select class="form-control" name="job_vacancy_requestby" id="job_vacancy_requestby">
						<?php
						for($d=0;$d<count($datadivision);$d++) {
						?>
						<option value="<?php echo $datadivision[$d]["division_id"];?>" <?php echo (isset($data["job_vacancy_requestby"]) && $datadivision[$d]["division_id"]==$data["job_vacancy_requestby"])?"selected":"";?> ><?php echo $datadivision[$d]["division_name"];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="job_vacancy_pic"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> PIC Recruiter :</label>
				<div class="col-sm-3">
					<select class="form-control validate[required]" name="job_vacancy_pic" id="job_vacancy_pic">
						<option value="">Choose recruiter</option>
						<?php
						for($d=0;$d<count($datarecruiter);$d++) {
						?>
						<option value="<?php echo $datarecruiter[$d]["log_auth_id"];?>" <?php echo (isset($data["job_vacancy_pic"]) && $datarecruiter[$d]["log_auth_id"]==$data["job_vacancy_pic"])?"selected":"";?> ><?php echo $datarecruiter[$d]["employee_name"];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="job_vacancy_approver"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Approval Official :</label>
				<div class="col-sm-3">
					<select class="form-control validate[required]" name="job_vacancy_approver" id="job_vacancy_approver">
						<option value="">Choose approver</option>
						<?php
						for($d=0;$d<count($dataapprover);$d++) {
						?>
						<option value="<?php echo $dataapprover[$d]["log_auth_id"];?>" <?php echo (isset($data["job_vacancy_approver"]) && $dataapprover[$d]["log_auth_id"]==$data["job_vacancy_approver"])?"selected":"";?> ><?php echo $dataapprover[$d]["employee_name"];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="status_id"><i class="fa fa-exclamation-triangle warningsign" style="font-size:.7em;"></i> Advertisement status :</label>
				<div class="col-sm-3">
					<select class="form-control" name="status_id" id="status_id">
						<!-- <option value="">Advertisement status</option> -->
						<?php
						for($t=0;$t<count($array_adstatus);$t++) {
						?>
						<option value="<?php echo strtolower($array_adstatus[$t]);?>" <?php echo (isset($data["status_id"]) && strtolower($array_adstatus[$t])==$data["status_id"])?"selected":"";?> ><?php echo $array_adstatus[$t];?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9 top30">
					<input type="hidden" name="job_vacancy_id" value="<?php echo (isset($data["job_vacancy_id"]) && $data["job_vacancy_id"]<>"")?$data["job_vacancy_id"]:"";?>">
					<input type="hidden" name="mod" value="adm_updateJobAdv">
					<input type="hidden" name="page" value="<?php echo $page;?>">
					<input type="hidden" name="upd_type" value="<?php echo $type;?>">
					<input type="submit" class="btn btn-md btn-success" value="SUBMIT" style="margin-right:30px;">
					<a href="<?php echo _PATHURL;?>/index.php?mod=jobadv&view=<?php echo coded($status_id);?>&page=<?php echo $page;?>" class="btn btn-info btn-md"  role="button">Return to List of Job Vacancy</a>
				</div>
			</div>
			
			
		</form>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#v_city').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'job_vacancy_city',
		<?php
		if(isset($data["job_vacancy_city"]) && $data["job_vacancy_city"]<>"") {
		?>
		value: ['<?php echo $data["job_vacancy_city"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Placement city',
		<?php
		}
		?>
		valueField: 'city_name',
	    displayField: 'city_name'
	});	
	
	$('#date1').datepicker({
		format:"dd-mm-yyyy"
	});

	$('#date2').datepicker({
		format:"dd-mm-yyyy"
	});
	
	/*
	$('#job_vacancy_marital').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: ['Single', 'Married', 'Divorce', 'Separated'],
		name: 'job_vacancy_marital',
		<?php
		if(isset($data["job_vacancy_marital"]) && $data["job_vacancy_marital"]<>"") {
		?>
		value: ['<?php echo $data["job_vacancy_marital"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Choose marital status from available list',
		<?php
		}
		?>
	    maxDropHeight: 100,
		displayField: 'marital_status',
		editable: 'false'
	});	
	
	$('#job_vacancy_grade').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: ['1A', '1B', '1C', '2A', '2B', '2C', '3A', '3B', '3C', '4A', '4B', '4C', '5A', '5B', '5C', '6A', '6B', '6C', '6D', '7 CEO'],
		name: 'job_vacancy_grade',
		<?php
		if(isset($data["job_vacancy_grade"]) && $data["job_vacancy_grade"]<>"") {
		?>
		value: ['<?php echo $data["job_vacancy_grade"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Choose grade',
		<?php
		}
		?>
	    maxDropHeight: 100,
		displayField: 'job_grade',
		editable: 'false'
	});	
	*/


    $("input[name='job_vacancy_minsalary']").TouchSpin({
        min: 0,
        max: 1000000000,
        step: 50000,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'Rp Minimum'
    });

    $("input[name='job_vacancy_maxsalary']").TouchSpin({
        min: 0,
        max: 1000000000,
        step: 50000,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'Rp Maximum'
    });
	
	
	$('.summernote').summernote({
	  toolbar: [
		//[groupname, [button list]]
		['para', ['ul', 'ol']]
	  ],
	  height: 300
	});
	
	
});
</script>


<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#updvacancy").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>