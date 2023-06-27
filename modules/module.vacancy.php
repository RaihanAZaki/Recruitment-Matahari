<?php
function vacancy_getJobAdv($job_vacancy_id,$type) {
	
	if(isset($job_vacancy_id) && $job_vacancy_id<>"" && $type=="detail") {
		$query=querying("SELECT job_vacancy_id, job_vacancy_name, job_vacancy_city, job_vacancy_desc, job_vacancy_brief, job_vacancy_degree, job_vacancy_type, 
		job_vacancy_startdate, job_vacancy_enddate FROM m_job_vacancy WHERE job_vacancy_id=? ORDER BY job_vacancy_id DESC LIMIT 1", array($job_vacancy_id));	
	}
	else if ($type=="featured"){
		$query=querying("SELECT job_vacancy_id, job_vacancy_name, job_vacancy_city, job_vacancy_startdate, job_vacancy_enddate
	FROM m_job_vacancy WHERE job_vacancy_enddate>=now() AND status_id=? ORDER BY job_vacancy_enddate ASC LIMIT 5",array("open"));
	}	
	else {
		$query=querying("SELECT job_vacancy_id, job_vacancy_name, job_vacancy_desc, job_vacancy_brief, job_vacancy_city, job_vacancy_startdate, job_vacancy_enddate
	FROM m_job_vacancy WHERE job_vacancy_startdate<=now() AND job_vacancy_enddate>=now() AND status_id=? ORDER BY job_vacancy_enddate ASC",array("open"));
	}
	if($data=sqlGetData($query) ) {
	// var_dump($data);
		return $data;}
	else return false;
	
}

function vacancy_requiredItem() {
	$query=querying("SELECT required_id, required_name, status_id FROM m_required", array());
	$data = sqlGetData($query);
	if(count($data)>0) {
		return $data;
	}
	else return false;
}


function vacancy_requiredData($menu_name)
{
	// if($menu_name=="education") {
	// 	$data=	getDataEdu();
	// }
	// if($menu_name=="workingexp") {
	// 	$data=	getDataJob();
	// }
	// if($menu_name=="family") {
	// 	$data=	getDataFam();
	// }
	// if($menu_name=="language") {
	// 	$data=	getDataLanguage();
	// }
	// if($menu_name=="organization") {
	// 	$data=	getDataOrg();
	// }
	// if($menu_name=="training") {
	// 	$data=	getDataTraining();
	// }
	// if($menu_name=="skills") {
	// 	$data=	getDataSkills();
	// }
	// if($menu_name=="passphoto") {
	// 	$data=	getRequiredDocs("passphoto");
	// }
	// if($menu_name=="transcript") {
	// 	$data=	getRequiredDocs("transcript");
	// }
	// if($menu_name=="ijazah") {
	// 	$data=	getRequiredDocs("ijazah");
	// }
	if($menu_name=="resume") {
		$data=	getRequiredResume();
	}
	// if($menu_name=="coverletter") {
	// 	$data=	getRequiredDocs("coverletter");
	// }
	// if($menu_name=="idcard") {
	// 	$data=	getRequiredDocs("idcard");
	// }
	// if($menu_name=="questionaire") {
	// 	$data=	getRequiredQuestionaire();
	// }
	
	
	
	
	$requiredok=(is_countable($data)>0)?"complete":"incomplete";
	return $requiredok;
}


function vacancy_isApplied($candidate_id, $candidate_email, $job_vacancy_id) {
	if(isset($job_vacancy_id) && $job_vacancy_id<>"") {
		$query = querying("SELECT candidate_apply_id, candidate_id, candidate_email, job_vacancy_id, candidate_apply_date, candidate_apply_stage, candidate_apply_status
	FROM t_candidate_apply WHERE candidate_id=? and candidate_email=? and job_vacancy_id=? ORDER BY candidate_id ASC LIMIT 1",array($candidate_id,$candidate_email,$job_vacancy_id));
	}
	else {
		$query = querying("SELECT candidate_apply_id, candidate_id, candidate_email, job_vacancy_id, candidate_apply_date, candidate_apply_stage, candidate_apply_status
	FROM t_candidate_apply WHERE candidate_id=? and candidate_email=? ORDER BY candidate_id ASC",array($candidate_id,$candidate_email));
	}
	$data = sqlGetData($query);
	if(count($data)>0) {
		return $data;
	}
	else return false;
}

// function vacancy_candidateApply()
// {
//     $data = getDataResume();

//     $datacandidate = $data[0];
//     $datacandidate["log_auth_name"] = $_SESSION["log_auth_name"];
//     $datacandidate["job_vacancy_id"] = $_POST["job_vacancy_id"];

//     $datavacancy = vacancy_getJobAdv($datacandidate["job_vacancy_id"], "detail");
//     $datacandidate["job_vacancy_name"] = $datavacancy[0]["job_vacancy_name"];

//     $datarequired = vacancy_requiredItem();
    
//     $galat = 0;
//     $mess = "";

//     // Mengecek batas maksimum jumlah lamaran
//     if (isset($_POST["numApply"]) && $_POST["numApply"] > _MAXAPPLY) {
//         $galat++;
//         $mess .= "<a href='"._PATHURL."/vacancy/'>You have applied for "._MAXAPPLY." position. You are not allowed to apply more than "._MAXAPPLY." position.</a><br>";
//     }

//     // Mengecek kelengkapan data yang dibutuhkan
//     foreach ($datarequired as $requiredItem) {
//         $requiredName = $requiredItem["required_name"];
//         $statusId = $requiredItem["status_id"];
		
//         if (vacancy_requiredData($requiredName) == "incomplete" && $statusId == 1) {
//             $galat++;
//             $mess .= "<a href='"._PATHURL."/" . $requiredName . "/'>Please click here to complete your " . ucfirst($requiredName) . ".</a><br>";
//         }
//     }

// 	if ($galat == 0) {
// 		if (vacancy_insertToApply($datacandidate) && vacancy_insertToHistory($datacandidate)) {
// 			// Proses pengiriman email konfirmasi
// 			$emailSent = sendConfirmationEmail($datacandidate);
// 			if ($emailSent) {
// 				unset($_SESSION["session"]);
// 				header("location: "._PATHURL."/index.php?mod=detail&mess=".coded("Your application has been sent to our recruitment team. Thank you."));
// 				exit;
// 			} else {
// 				$mess = "Sending application failed. Please try again later.";
// 			}
// 		} else {
// 			$mess = "Sending application failed. Please try again later.";
// 		}
// 	} else {
// 		$mess = "Sending application failed. Please try again later.";
// 	}
	
// 	header("location: "._PATHURL."/index.php?mod=detail&gal=".coded("1")."&job_vacancy_id=".$datacandidate["job_vacancy_id"]."&mess=".coded($mess));
// 	exit;
	
//     // if ($galat == 0) {
//     //     if (vacancy_insertToApply($datacandidate) && vacancy_insertToHistory($datacandidate)) {
//     //         // Proses pengiriman email konfirmasi
//     //         $emailSent = sendConfirmationEmail($datacandidate);
//     //         if ($emailSent) {
//     //             unset($_SESSION["session"]);
//     //             header("location: "._PATHURL."/index.php?mod=detail&mess=".coded("Your application has been sent to our recruitment team. Thank you."));
//     //             exit;
//     //         } else {
//     //             $mess = "Sending application failed. Please try again later.";
//     //         }
//     //     } else {
//     //         $mess = "Sending application failed. Please try again later.";
//     //     }
//     // }

//     // header("location: "._PATHURL."/index.php?mod=detail&gal=".coded("1")."&job_vacancy_id=".$datacandidate["job_vacancy_id"]."&mess=".coded($mess));
//     // exit;
// }
// ?>

<?php

function sendConfirmationEmail($data)
{
    $variablemail = array();
    $variablemail["sender"] = 'rhnashil@gmail.com';
    $variablemail["from"] = "rhnashil@gmail.com";
    $variablemail["fromname"] = "Recruitment PT. Matahari Putra Prima";
    $variablemail["to"] = $data["candidate_email"];
    $variablemail["toName"] = $data["candidate_name"];
    // $variablemail["bcc"] = "shakti.santoso@hypermart.co.id";
    $variablemail["subject"] = "[PT. Matahari Putra Prima] Job Application";
    $variablemail["content"] = "
        <p>Dear ".$data["candidate_name"].", Thank you for applying for ".$data["job_vacancy_name"]." position.<br><br>
        Your application has been sent to our recruitment team on ".date("d F Y H:i:s").".
        We will review your application and contact you if you are selected for further selection process.<br><br>
        Sincerely,<br>
        Recruitment PT. Matahari Putra Prima</p>";

    $emailSent = function_sending_email($variablemail);

    return $emailSent;
}

function vacancy_candidateApply() {
	$data=getDataResume();

	$datacandidate=$data[0];
	$datacandidate["log_auth_name"]=$_SESSION["log_auth_name"];
	$datacandidate["job_vacancy_id"]=$_POST["job_vacancy_id"];
	
	$datavacancy=vacancy_getJobAdv($datacandidate["job_vacancy_id"],"detail");
	$datacandidate["job_vacancy_name"]=$datavacancy[0]["job_vacancy_name"];
	
	$datarequired=vacancy_requiredItem();
	
	//print_r($datarequired);exit;
	/*
	print_r($datacandidate);
	print_r($datavacancy);
	exit;
	*/

	for($i=0;$i<count($datarequired);$i++) {
		// if($datarequired[$i]["required_name"]=="education") {
		// 	$required["education"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="workingexp") {
		// 	$required["workingexp"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="family") {
		// 	$required["family"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="language") {
		// 	$required["language"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="organization") {
		// 	$required["organization"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="training") {
		// 	$required["training"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="skills") {
		// 	$required["skills"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="passphoto") {
		// 	$required["passphoto"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="transcript") {
		// 	$required["transcript"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="ijazah") {
		// 	$required["ijazah"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="resume") {
		// 	$required["resume"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="coverletter") {
		// 	$required["coverletter"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="idcard") {
		// 	$required["idcard"]=$datarequired[$i]["status_id"];
		// }
		// if($datarequired[$i]["required_name"]=="questionaire") {
		// 	$required["questionaire"]=$datarequired[$i]["status_id"];
		// }
		
	}
	/*
	echo "klik apply<br>";	
	echo "nglamar : ".$_POST["job_vacancy_id"]; 
	print_r($datacandidate);
	
	//sebaiknya perlu dicek dulu field2 apa yg wajib diisi sbelum apply
	*/
	$galat=0;
	$mess="";
	
	// if(isset($_POST["numApply"]) && $_POST["numApply"]>_MAXAPPLY) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/vacancy/'>You have applied for "._MAXAPPLY." position. You are not allowed to apply more than "._MAXAPPLY." position.</a><br>";
	// }
	
	//print_r($required);exit;
	// if( (vacancy_requiredData("education")=="incomplete") && $required["education"]==1) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/education/'>Please click here to complete your Educational Background.</a><br>";
	// }
	// if( (vacancy_requiredData("workingexp")=="incomplete") && $required["workingexp"]==1) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/workingexp/'>Please click here to complete your Working Experience.</a><br>";
	// }
	// if( (vacancy_requiredData("family")=="incomplete") && $required["family"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/family/'>Please click here to complete your Family Background.</a><br>";
	// }
	// if( (vacancy_requiredData("language")=="incomplete") && $required["language"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/language/'>Please click here to complete your Language Skills.</a><br>";
	// }
	// if( (vacancy_requiredData("organization")=="incomplete") && $required["organization"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/organization/'>Please click here to complete your Organization Experience.</a><br>";
	// }
	// if( (vacancy_requiredData("training")=="incomplete") && $required["training"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/training/'>Please click here to complete your Training Experience.</a><br>";
	// }
	// if( (vacancy_requiredData("skills")=="incomplete") && $required["skills"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/refference/'>Please click here to complete your Skills.</a><br>";
	// }
	
	// if( (vacancy_requiredData("passphoto")=="incomplete") && $required["passphoto"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/documents/#passphoto'>Please click here to upload your Passphoto.</a><br>";
	// }
	
	// if( (vacancy_requiredData("transcript")=="incomplete") && $required["transcript"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/documents/#transcript'>Please click here to upload your Transcript.</a><br>";
	// }
	
	// if( (vacancy_requiredData("ijazah")=="incomplete") && $required["ijazah"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/documents/#ijazah'>Please click here to upload your Ijazah.</a><br>";
	// }

	// if( (vacancy_requiredData("coverletter")=="incomplete") && $required["coverletter"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/documents/#coverletter'>Please click here to upload your Application Letter.</a><br>";
	// }

	// if( (vacancy_requiredData("idcard")=="incomplete") && $required["idcard"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/documents/#idcard'>Please click here to upload your ID Card.</a><br>";
	// }
	
	// if( (vacancy_requiredData("resume")=="incomplete") && $required["resume"]==1 ) {
	// 	$galat++;
	// 	$mess.="<a href='"._PATHURL."/resume/'>Please click here to complete your full Resume.</a><br>";
	// }

	// $questionnaireData = vacancy_requiredData("questionaire");
	// if ((is_countable($questionnaireData) && count($questionnaireData) == 0) && $required["questionaire"] == 1) {
	// 	$galat++;
	// 	$mess .= "<a href='" . _PATHURL . "/questionaire/'>Please click here to complete your Questionaire.</a><br>";
	// }

	
	// var_dump($galat);exit;
	if ($galat == 0) {
		if(vacancy_insertToApply($datacandidate) && vacancy_insertToHistory($datacandidate))
		{
			//part kirim email
			$variablemail = array();
			$variablemail["sender"] 	= 'recruitment@hypermart.co.id';
			$variablemail["from"] 		= "recruitment@hypermart.co.id";
			$variablemail["fromname"] 	= "Recruitment PT. Matahari Putra Prima";
			$variablemail["to"] 		= $datacandidate["candidate_email"];
			$variablemail["toName"]		= $datacandidate["candidate_name"];
			$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
			$variablemail["subject"] 	= "[PT. Matahari Putra Prima] Job Application";
			$variablemail["content"] 	= "
				<p>Dear ".$datacandidate["candidate_name"].", Thank you for applying for ".$datacandidate["job_vacancy_name"]." position<br><br>
				Your application has been sent to our recruitment team on ".date("l, d M Y",strtotime(date("d-m-Y")))." at ".date("H:i:s")." Indonesian Western Time.<br><br>
				In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
			<b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></p>";
			
			//echo ($variablemail["content"]);exit;
			if (function_sending_email($variablemail))
			{
				unset($_SESSION["session"]);
				unset($variablemail);
				header("location: "._PATHURL."/index.php?mod=detail&job_vacancy_id=".$datacandidate["job_vacancy_id"]."&mess=".coded("Your application has been sent to our recruitment team. Thank You."));
				exit;	
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detail&gal=".coded("1")."&job_vacancy_id=".$datacandidate["job_vacancy_id"]."&mess=".coded("Sending application failed. Please try again later."));
				exit;	
			}	
			
			
		}
		else
		{
			header("location: "._PATHURL."/index.php?mod=detail&gal=".coded("1")."&job_vacancy_id=".$datacandidate["job_vacancy_id"]."&mess=".coded("Sending application failed. Please try again later."));
			exit;	
		}	
	}

	else 	header("location: "._PATHURL."/index.php?mod=detail&gal=".coded("1")."&job_vacancy_id=".$datacandidate["job_vacancy_id"]."&mess=".coded($mess));
	exit;	
}


	function vacancy_insertToApply($data){		
			if (querying("INSERT INTO t_candidate_apply
	(candidate_id, candidate_email, job_vacancy_id, candidate_apply_date, candidate_apply_stage, candidate_apply_status, candidate_schedule_date, candidate_completed_date, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, NOW(), ?, ?, NOW(), ?, ?, NOW(), ?, NOW())",
				array($data["candidate_id"], $data["candidate_email"], $data["job_vacancy_id"], "cv-screening", "ongoing", "0000-00-00 00:00:00", $data["log_auth_id"], $data["log_auth_id"]) )) return true;
				else return false;
	}
	
	function vacancy_insertToHistory($data) {
		if (querying("INSERT INTO t_apply_history
	(candidate_id, candidate_email, job_vacancy_id, apply_history_date, apply_history_stage, apply_history_status, apply_history_notes, candidate_schedule_date, candidate_completed_date, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, NOW(), ?, ?, ?, NOW(), ?, ?, NOW(), ?, NOW())",
			array($data["candidate_id"], $data["candidate_email"], $data["job_vacancy_id"], "cv-screening", "ongoing", "", "0000-00-00 00:00:00", $data["log_auth_id"], $data["log_auth_id"]) )) return true;
			else return false;
	}

	
	function vacancy_updateApproval() {
		if(isset($_GET["usr"]) && $_GET["usr"]<>"") {
			$usr=decoded($_GET["usr"]);
			//echo $usr;
			$pecah=explode("|",$usr);
			$job_vacancy_approver=$pecah[0];
			$status_id=$pecah[1];
			$job_vacancy_id=$pecah[2];
			$expiry_date=$pecah[3];
			//$expiry_date="2015-10-25";
			//echo "job_vacancy_approver=".$job_vacancy_approver."<br>status_id=".$status_id."<br>job_vacancy_id=".$job_vacancy_id."<br>expiry_date=".$expiry_date;
			
			if($expiry_date<date("Y-m-d")) {
				header("location: "._PATHURL."/index.php?mod=detail&gal=".coded("1")."&job_vacancy_id=".$job_vacancy_id."&mess=".coded("Your link has been expired. Kindly login to your account and update the vacancy from your account."));
				exit;	
			}
			else {
				//update di sini
				$query=querying("UPDATE m_job_vacancy
								SET status_id=?, user_update=?, date_update=NOW()
								WHERE job_vacancy_id=? AND job_vacancy_approver=?", array($status_id,$job_vacancy_approver,$job_vacancy_id,$job_vacancy_approver));
				if($query) {
					header("location: "._PATHURL."/index.php?mod=vacancy&mess=".coded("Data approval has been updated."));
					exit;
				}
				else {
					header("location: "._PATHURL."/index.php?mod=vacancy&gal=".coded("1")."&mess=".coded("Data approval failed. Please try again later."));
					exit;	
				}
			}
			
		}
		else {
			header("location: "._PATHURL."/index.php");
			exit;		
		}
	}

?>