<?php
	//print_r($_POST);exit;
	session_start();
	include_once("setconf.php");
	ini_set("display_errors",1);
	
	loadAllModules();
	is_it_locked();
	
	if(isset($_POST["mod"]) && $_POST["mod"]<>"")
	{
		$mod = $_POST["mod"];
	}
	else
	{
		$mod="";	
	}

	//echo "mod=".$mod;exit;
	
	$moveext = 0; // flag transfer submit
	if (isset($mod) && $mod<>"")
	{
		switch ($mod)
		{
			//guest
			case "register_signUp":register_signUp(); break;
			case "register_resendAct":register_resendAct(); break;
			case "system_contactUs":system_contactUs(); break;			
			
			// authenticated user
			case "system.usrlogin":system_usrlogin(); break;	
			case "candidate_forgotPwd":candidate_forgotPwd(); break;	
			case "candidate_resetPasswd":candidate_resetPasswd(); break;	
			case "system.resetpwd":system_resetPasswd(); break;
			case "vacancy_candidateApply":vacancy_candidateApply(); break;
			case "referall":referall(); break;
			
			
			case "update_candidateResume":update_candidateResume(); break;
			case "update_candidateOrg":update_candidateOrg(); break;
			case "update_candidateSkill":update_candidateSkill(); break;
			case "update_candidateLang":update_candidateLang(); break;
			case "update_candidateFam":update_candidateFam(); break;
			case "update_candidateTraining":update_candidateTraining(); break;
			case "update_candidateEdu":update_candidateEdu(); break;
			case "update_candidateJobexp":update_candidateJobexp(); break;
			case "update_candidateQuestion":update_candidateQuestion(); break;
			
			
			
			//upload documents
			case "upload_candidatePassphoto":upload_candidatePassphoto(); break;
			case "upload_candidateFile":upload_candidateFile(); break;
			case "upload_candidateFileOthers":upload_candidateFileOthers(); break;
			case "upload_candidateDelFileOthers":upload_candidateDelFileOthers(); break;
			
			
			//part pic hr
			case "adm_updateJobAdv":adm_updateJobAdv(); break;
			case "adm_delJobAdv":adm_delJobAdv(); break;
			
			case "admin_registerCandidate":admin_registerCandidate(); break;
			case "adm_activateRegistrant":adm_activateRegistrant(); break;
			
			
			case "admin_editResume":admin_editResume(); break;
			case "admin_editEdu":admin_editEdu(); break;
			case "admin_editJobexp":admin_editJobexp(); break;
			case "admin_editOrg":admin_editOrg(); break;
			case "admin_editTraining":admin_editTraining(); break;
			case "admin_editSkill":admin_editSkill(); break;
			case "admin_editLang":admin_editLang(); break;
			case "admin_editFam":admin_editFam(); break;
			case "admin_editQuestionaire":admin_editQuestionaire(); break;
			case "adm_downloadResume":adm_downloadResume(); break;
			case "adm_downloadFullTabel":adm_downloadFullTabel(); break;
			case "adm_exportExcel":adm_exportExcel(); break;
			case "adm_exportExcelForProint":adm_exportExcelForProint(); break;
			
			
			
			case "adm_sendCvToUser":adm_sendCvToUser(); break;
			case "adm_emailCvToUser":adm_emailCvToUser(); break;
			
			
			case "adm_processCandidate":adm_processCandidate(); break;
			case "admin_upload_candidateFile":admin_upload_candidateFile(); break;
			case "admin_upload_candidateFileOthers":admin_upload_candidateFileOthers(); break;
			case "admin_upload_candidateDelFileOthers":admin_upload_candidateDelFileOthers(); break;
			case "adm_applyForCandidate":adm_applyForCandidate(); break;
			case "admin_updateUser":admin_updateUser(); break;
			case "adm_delUser":adm_delUser(); break;
			case "admin_changePassword":admin_changePassword(); break;

			case "adm_updateHowTo":adm_updateHowTo(); break;
			case "adm_editBanner":adm_editBanner(); break;
			case "adm_addBanner":adm_addBanner(); break;

			case "adm_search":adm_search(); break;
			
			
		}
	}
	else {header("location: "._PATHURL);} // hacker attempt
	exit;
?>