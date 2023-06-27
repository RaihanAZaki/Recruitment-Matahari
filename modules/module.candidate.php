<?php
//module.candidate.php

function getDataResume() {
	$query=querying("SELECT candidate_id, log_auth_id, candidate_name, candidate_email, candidate_gender, candidate_religion, candidate_birthplace, 
	candidate_birthdate, candidate_race, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_bodyheight, 
	candidate_bodyweight, candidate_bloodtype, candidate_sim_a, candidate_sim_c, candidate_npwp, candidate_marital, candidate_p_address, 
	candidate_p_city, candidate_p_postcode, candidate_c_address, candidate_c_city, candidate_c_postcode, candidate_hp1, candidate_hp2, 
	candidate_phone, candidate_cp_name1, candidate_cp_relation1, candidate_cp_phone1, candidate_cp_name2, candidate_cp_relation2, 
	candidate_cp_phone2, candidate_ref_name, candidate_ref_division, candidate_ref_position, candidate_expected_salary, candidate_hobby
	FROM m_candidate WHERE log_auth_id=? AND status_id=? ORDER BY candidate_id DESC LIMIT 1", array($_SESSION["log_auth_id"],"active"));
	if($data=sqlGetData($query)){
		return $data;
	}
	else {
		return false;
	}
}

function getDataEdu() {
	$query=querying("SELECT candidate_edu_id, candidate_id, candidate_edu_degree, candidate_edu_institution, candidate_edu_major, candidate_edu_gpa, candidate_edu_city, candidate_edu_start, candidate_edu_end, candidate_edu_notes
	FROM m_candidate_edu WHERE candidate_id=? ORDER BY FIELD (candidate_edu_degree,'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD')", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataJob() {
	$query=querying("SELECT candidate_jobexp_id, candidate_id, candidate_jobexp_company, candidate_jobexp_address, candidate_jobexp_phone, candidate_jobexp_lob, candidate_jobexp_numemployee, candidate_jobexp_position, candidate_jobexp_start, candidate_jobexp_end, candidate_jobexp_desc, candidate_jobexp_salary, candidate_jobexp_spvname, candidate_jobexp_spvposition, candidate_jobexp_subposition, candidate_jobexp_subnumber, candidate_jobexp_leaving
	FROM m_candidate_jobexp WHERE candidate_id=? ORDER BY candidate_jobexp_end DESC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataLob() {
	$query=querying("SELECT lob_id, lob_name
	FROM m_lob ORDER BY lob_name ASC", array());
	$data=sqlGetData($query);
	return $data;
}

function getDataTraining() {
	$query=querying("SELECT candidate_training_id, candidate_id, candidate_training_name, candidate_training_institution, candidate_training_city, candidate_training_year, candidate_training_duration, candidate_training_sponsor
	FROM m_candidate_training WHERE candidate_id=? ORDER BY candidate_training_year DESC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataOrg() {
	$query=querying("SELECT candidate_organization_id, candidate_id, candidate_organization_name, candidate_organization_role, candidate_organization_start, candidate_organization_end
	FROM m_candidate_organization WHERE candidate_id=? ORDER BY candidate_organization_end DESC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataSkills() {
	$query=querying("SELECT candidate_skill_id, candidate_id, candidate_skill_name, candidate_skill_level, candidate_skill_notes
	FROM m_candidate_skill WHERE candidate_id=? ORDER BY candidate_skill_id ASC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataLanguage() {
	$query=querying("SELECT candidate_language_id, candidate_id, candidate_language_name, candidate_language_read, candidate_language_write, candidate_language_conversation
	FROM m_candidate_language WHERE candidate_id=? ORDER BY candidate_language_id ASC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataFam() {
	$query=querying("SELECT candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
	FROM m_candidate_family WHERE candidate_id=? ORDER BY FIELD(candidate_family_relation,'Father','Mother','Spouse','Brother','Sister','Son','Daughter') ASC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataDoc() {
	$query=querying("SELECT candidate_file_id, candidate_id, candidate_file_name, candidate_file_type, candidate_file_notes
	FROM m_candidate_file WHERE candidate_id=?", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}

function getDataOthers() {
	$query=querying("SELECT candidate_file_id, candidate_id, candidate_file_name, candidate_file_notes
	FROM m_candidate_fileothers WHERE candidate_id=?", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}


function getRequiredDocs($type) {
	$query=querying("SELECT candidate_file_id, candidate_id, candidate_file_name, candidate_file_type
	FROM m_candidate_file WHERE candidate_id=? AND candidate_file_type=?", array($_SESSION["candidate_id"],$type));
	$data=sqlGetData($query);
	return $data;
}


function getRequiredQuestionaire() {
	$soal=getDataQuestion();
	$jawab=getDataAnswer();
	$complete = "";
	
	if(count($soal)==count($jawab)) {
		$complete[0]="complete";
	}
	return $complete;
}


function getRequiredResume() {
	$query = querying("SELECT * FROM m_candidate WHERE candidate_id=? and candidate_email=? ORDER BY candidate_id LIMIT 1",array($_SESSION['candidate_id'], $_SESSION["log_auth_name"]));
	$dataresume=sqlGetData($query);
	
	//bagian mandatory
	/*candidate_religion, candidate_race, candidate_marital, candidate_bodyheight, candidate_bodyweight, 
	candidate_p_address, candidate_p_city, candidate_c_address, candidate_c_city, candidate_cp_name1, candidate_cp_relation1, candidate_cp_phone1
	*/
	if($dataresume[0]["candidate_religion"]<>"" && 
	   //$dataresume[0]["candidate_race"]<>"" && 
	   $dataresume[0]["candidate_marital"]<>"" && 
	   //$dataresume[0]["candidate_bodyheight"]<>"" && 
	   //$dataresume[0]["candidate_bodyweight"]<>"" && 
	   $dataresume[0]["candidate_p_address"]<>"" && 
	   $dataresume[0]["candidate_p_city"]<>"" && 
	   $dataresume[0]["candidate_c_address"]<>"" && 
	   $dataresume[0]["candidate_c_city"]<>"" && 
	   $dataresume[0]["candidate_cp_name1"]<>"" && 
	   $dataresume[0]["candidate_cp_relation1"]<>"" && 
	   $dataresume[0]["candidate_cp_phone1"]<>"") {
		
	   $complete[0]="complete";
	}

	return $complete;
}

function getDataApply($type="") {

	if(isset($type) && $type=="open_project") {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, a.candidate_apply_stage, 
		a.candidate_apply_status, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, b.job_vacancy_brief, b.job_vacancy_degree, 
		b.job_vacancy_type, b.job_vacancy_startdate, b.job_vacancy_enddate, b.log_auth_id
		FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=? AND a.candidate_apply_status<>? ORDER BY b.job_vacancy_enddate DESC",
		array($_SESSION["candidate_id"],"reject"));
	}
	else {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, a.candidate_apply_stage, 
		a.candidate_apply_status, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, b.job_vacancy_brief, b.job_vacancy_degree, 
		b.job_vacancy_type, b.job_vacancy_startdate, b.job_vacancy_enddate, b.log_auth_id
		FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=? ORDER BY b.job_vacancy_enddate DESC",
		array($_SESSION["candidate_id"]));
	}
	$data=sqlGetData($query);
	return $data;
}

function getNumApply($type) {
	$datApply=getDataApply($type);
	$numApply=count($datApply);
	return $numApply;
}

function getDataChapter() {
	$query=querying("SELECT question_chapter 
	FROM m_question WHERE status_id=? GROUP BY question_chapter ORDER BY question_chapter ASC", array("active"));
	$data=sqlGetData($query);
	return $data;
}

function getDataQuestion() {
	$query=querying("SELECT question_id, question_chapter, question_desc, question_deskripsi, question_type, question_order, question_required
	FROM m_question WHERE status_id=? ORDER BY question_chapter ASC, question_order ASC", array("active"));
	$data=sqlGetData($query);
	return $data;
}

function getDataAnswer() {
	$query=querying("SELECT answer_id, candidate_id, question_id, answer_yn, answer_desc
	FROM t_answer WHERE candidate_id=? ORDER BY question_id ASC", array($_SESSION["candidate_id"]));
	$data=sqlGetData($query);
	return $data;
}


function error_notice($i) {
	$warn[] = "Full Name <i>(Nama lengkap)</i>"; //0
	$warn[] = "Email"; //1
	$warn[] = "Gender <i>(Jenis kelamin)</i>"; //2
	$warn[] = "Religion <i>(Agama)</i>"; //3
	$warn[] = "Birth Place <i>(Tempat lahir)</i>"; //4
	$warn[] = "Birth Date <i>(Tanggal lahir)</i>"; //5
	$warn[] = "Race <i>(Suku bangsa)</i>"; //6
	$warn[] = "Nationality <i>(Warga negara)</i>"; //7
	$warn[] = "Country <i>(Negara)</i>"; //8
	$warn[] = "ID Type <i>(Tipe kartu pengenal)</i>"; //9
	$warn[] = "ID Card <i>(Nomor kartu pengenal)</i>"; //10
	$warn[] = "Height <i>(Tinggi badan)</i>"; //11
	$warn[] = "Weight <i>(Berat badan)</i>"; //12
	$warn[] = "Blood Type <i>(Golongan darah)</i>"; //13
	$warn[] = "SIM A"; //14
	$warn[] = "SIM C"; //15
	$warn[] = "NPWP"; //16
	$warn[] = "Marital <i>(Status pernikahan)</i>"; //17
	$warn[] = "Permanent Address <i>(Alamat tetap)</i>"; //18
	$warn[] = "Permanent City <i>(Kota sesuai KTP)</i>"; //19
	$warn[] = "Permanent PostCode <i>(Kode pos sesuai KTP)</i>"; //20
	$warn[] = "Current Address <i>(Alamat domisili)</i>"; //21
	$warn[] = "Current City <i>(Kota domisili)</i>"; //22
	$warn[] = "Current PostCode <i>(Kode pos domisili)</i>"; //23
	$warn[] = "Cellular phone 1 <i>(Nomor telepon genggam 1)</i>"; //24
	$warn[] = "Cellular phone 2 <i>(Nomor telepon genggam 2)</i>"; //25
	$warn[] = "Home phone <i>(Nomor telepon rumah)</i>"; //26
	$warn[] = "Contact person name 1 <i>(Nama kontak 1)</i>"; //27
	$warn[] = "Contact person relation 1 <i>(Hubungan kontak 1)</i>"; //28
	$warn[] = "Contact person phone 1 <i>(Nomor kontak 1)</i>"; //29
	$warn[] = "Contact person name 2 <i>(Nama kontak 2)</i>"; //30
	$warn[] = "Contact person relation 2 <i>(Hubungan kontak 2)</i>"; //31
	$warn[] = "Contact person phone 2 <i>(Nomor kontak 2)</i>"; //32
	$warn[] = "Hobby"; //33
	$warn[] = "Format email <i>(Penulisan email)</i>"; //34
	$warn[] = "Retype email is required <i>(Email harus diketik ulang)</i>"; //35
	$warn[] = "Retype email mismatch <i>(Email yang dimasukkan tidak sama)</i>"; //36
	$warn[] = "ID Card tidak sesuai ketentuan yang berlaku"; //37 /*harusnya KTP 16 digit, mulai digit ke-7 adalah ddmmyy, untuk yy, perempuan ditambah 40*/
	$warn[] = "ID Card sudah terdaftar"; //38
	$warn[] = "Password is required (minimal 6 digit)"; //39
	$warn[] = "Retype password is required <i>(Password harus diketik ulang)</i>"; //40
	$warn[] = "Retype password mismatch <i>(Password harus diketikkan sama persis)</i>"; //41
	$warn[] = "Email sudah terdaftar"; //42
	$warn[] = "Cellular phone is required <i>(Nomor telepon genggam 1 harus diisi)</i>"; //43
	$warn[] = "Cellular phone has been used by other user. <i>(Nomor telepon genggam sudah terdaftar)</i>"; //44
	$warn[] = "Captcha code is failed <i>(Kode captcha salah)</i>"; //45
	$warn[] = "Message is required <i>(Pesan harus diisi)</i>"; //46
	
	
	$warn[] = "Position name is required <i>(Nama jabatan harus diisi)</i>"; //47
	$warn[] = "Placement city is required <i>(Kota penempatan harus diisi)</i>"; //48
	$warn[] = "Job description is required <i>(Deskripsi pekerjaan harus diisi)</i>"; //49
	$warn[] = "Brief description is required <i>(Deskripsi ringkas harus diisi)</i>"; //50
	$warn[] = "Minimum degree is required <i>(Jenjang minimum harus diisi)</i>"; //51
	$warn[] = "Employment type is required <i>(Tipe status kontrak harus diisi)</i>"; //52
	$warn[] = "Ads start date is required <i>(Tanggal mulai lowongan harus diisi)</i>"; //53
	$warn[] = "Ads end date is required <i>(Batas akhir lowongan harus diisi)</i>"; //54
	$warn[] = "Advertisement status is required <i>(Status lowongan harus diisi)</i>"; //55
	$warn[] = "PIC of ads is required <i>(PIC harus diisi)</i>"; //56
	$warn[] = "NIK or Barcode is required <i>(NIK atau Barcode harus diisi)</i>"; //57
	$warn[] = "Role is required <i>(Peran harus diisi)</i>"; //58
	$warn[] = "Division is required <i>(Divisi harus diisi)</i>"; //59
	$warn[] = "NIK has already been used <i>(NIK telah digunakan)</i>"; //60

	$warn[] = "How to description is required <i>(Deskripsi HOW TO harus diisi)</i>"; //61
	
	if ($i <> "") return $warn[$i];
	else return false;
}



// /* Bagian Update Resume */
// function update_candidateResume() {
	
// 	$_POST = sanitize_post($_POST);
// 	$_GET  = sanitize_get($_GET);
	
	
// 	//print_r($_POST); exit;
// 	/* candidate_name, candidate_email, candidate_gender, candidate_religion, candidate_birthplace, candidate_birthdate, 
// candidate_race, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_bodyheight, candidate_bodyweight, 
// candidate_bloodtype, candidate_sim_a, candidate_sim_c, candidate_npwp, candidate_marital, candidate_p_address, candidate_p_city, candidate_p_postcode, 
// candidate_c_address, candidate_c_city, candidate_c_postcode, candidate_hp1, candidate_hp2, candidate_phone, candidate_cp_name1, candidate_cp_relation1, 
// candidate_cp_phone1, candidate_cp_name2, candidate_cp_relation2, candidate_cp_phone2, 
// candidate_ref_name, candidate_ref_division, candidate_ref_position, candidate_expected_salary, candidate_hobby */
	
// 	$missteps = array();
// 	//if (!isset($_POST["candidate_name"]) or $_POST["candidate_name"] == "") 	$missteps[] = 0;
// 	//if (!isset($_POST["candidate_email"]) or $_POST["candidate_email"] == "") 		$missteps[] = 1;
// 	if (!isset($_POST["candidate_gender"]) or $_POST["candidate_gender"] == "") 		$missteps[] = 2;
// 	if (!isset($_POST["candidate_religion"]) or $_POST["candidate_religion"] == "") 		$missteps[] = 3;
// 	if (!isset($_POST["candidate_birthplace"]) or $_POST["candidate_birthplace"] == "") 		$missteps[] = 4;
// 	if (!isset($_POST["candidate_birthdate"]) or $_POST["candidate_birthdate"] == "") 		$missteps[] = 5;
// 	//if (!isset($_POST["candidate_race"]) or $_POST["candidate_race"] == "") 		$missteps[] = 6;
// 	// if (!isset($_POST["candidate_nationality"]) or $_POST["candidate_nationality"] == "") 		$missteps[] = 7;
// 	// if (!isset($_POST["candidate_country"]) or $_POST["candidate_country"] == "") 		$missteps[] = 8;
// 	// if (!isset($_POST["candidate_idtype"]) or $_POST["candidate_idtype"] == "") 		$missteps[] = 9;
// 	// if (!isset($_POST["candidate_idcard"]) or $_POST["candidate_idcard"] == "") 		$missteps[] = 10;
// 	//if (!isset($_POST["candidate_bodyheight"]) or $_POST["candidate_bodyheight"] == "") 		$missteps[] = 11;
// 	//if (!isset($_POST["candidate_bodyweight"]) or $_POST["candidate_bodyweight"] == "") 		$missteps[] = 12;
// 	//if (!isset($_POST["candidate_bloodtype"]) or $_POST["candidate_bloodtype"] == "") 		$missteps[] = 13;
// 	//if (!isset($_POST["candidate_sim_a"]) or $_POST["candidate_sim_a"] == "") 		$missteps[] = 14;
// 	//if (!isset($_POST["candidate_sim_c"]) or $_POST["candidate_sim_c"] == "") 		$missteps[] = 15;
// 	//if (!isset($_POST["candidate_npwp"]) or $_POST["candidate_npwp"] == "") 		$missteps[] = 16;
// 	if (!isset($_POST["candidate_marital"]) or $_POST["candidate_marital"] == "") 		$missteps[] = 17;
// 	if (!isset($_POST["candidate_p_address"]) or $_POST["candidate_p_address"] == "") 		$missteps[] = 18;
// 	if (!isset($_POST["candidate_p_city"]) or $_POST["candidate_p_city"] == "") 		$missteps[] = 19;
// 	//if (!isset($_POST["candidate_p_postcode"]) or $_POST["candidate_p_postcode"] == "") 		$missteps[] = 20;
// 	if (!isset($_POST["candidate_c_address"]) or $_POST["candidate_c_address"] == "") 		$missteps[] = 21;
// 	if (!isset($_POST["candidate_c_city"]) or $_POST["candidate_c_city"] == "") 		$missteps[] = 22;
// 	//if (!isset($_POST["candidate_c_postcode"]) or $_POST["candidate_c_postcode"] == "") 		$missteps[] = 23;
// 	//if (!isset($_POST["candidate_hp1"]) or $_POST["candidate_hp1"] == "") 		$missteps[] = 24;
// 	//if (!isset($_POST["candidate_hp2"]) or $_POST["candidate_hp2"] == "") 		$missteps[] = 25;
// 	//if (!isset($_POST["candidate_phone"]) or $_POST["candidate_phone"] == "") 		$missteps[] = 26;
// 	if (!isset($_POST["candidate_cp_name1"]) or $_POST["candidate_cp_name1"] == "") 		$missteps[] = 27;
// 	if (!isset($_POST["candidate_cp_relation1"]) or $_POST["candidate_cp_relation1"] == "") 		$missteps[] = 28;
// 	if (!isset($_POST["candidate_cp_phone1"]) or $_POST["candidate_cp_phone1"] == "") 		$missteps[] = 29;
// 	//if (!isset($_POST["candidate_cp_name2"]) or $_POST["candidate_cp_name2"] == "") 		$missteps[] = 30;
// 	//if (!isset($_POST["candidate_cp_relation2"]) or $_POST["candidate_cp_relation2"] == "") 		$missteps[] = 31;
// 	//if (!isset($_POST["candidate_cp_phone2"]) or $_POST["candidate_cp_phone2"] == "") 		$missteps[] = 32;
// 	//if (!isset($_POST["candidate_hobby"]) or $_POST["candidate_hobby"] == "") 		$missteps[] = 33;
	
	
// 	if (count($missteps)>0)
// 	{
// 		for ($i=0;$i<count($missteps);$i++) {
// 			$notice[] = error_notice($missteps[$i]);
// 		}
// 		$notice = json_encode($notice);
		
// 		$_SESSION["session"] = $_POST;	
// 		//print_r($_SESSION); exit;
		
// 		if(isset($_POST["candidate_c_city"]) && is_array($_POST["candidate_c_city"])) {
// 				$_SESSION["session"]["candidate_c_city"]=$_POST["candidate_c_city"][0];
// 		}
// 		if(isset($_POST["candidate_p_city"]) && is_array($_POST["candidate_p_city"])) {
// 				$_SESSION["session"]["candidate_p_city"]=$_POST["candidate_p_city"][0];
// 		}
// 		if(isset($_POST["candidate_marital"]) && is_array($_POST["candidate_marital"])) {
// 				$_SESSION["session"]["candidate_marital"]=$_POST["candidate_marital"][0];
// 		}
// 		/*if(isset($_POST["candidate_religion"]) && is_array($_POST["candidate_religion"])) {
// 				$_SESSION["session"]["candidate_religion"]=$_POST["candidate_religion"][0];
// 		}*/
// 		if(isset($_POST["candidate_bloodtype"]) && is_array($_POST["candidate_bloodtype"])) {
// 				$_SESSION["session"]["candidate_bloodtype"]=$_POST["candidate_bloodtype"][0];
// 		}
// 		if(isset($_POST["candidate_cp_relation1"]) && is_array($_POST["candidate_cp_relation1"])) {
// 				$_SESSION["session"]["candidate_cp_relation1"]=$_POST["candidate_cp_relation1"][0];
// 		}
// 		if(isset($_POST["candidate_cp_relation2"]) && is_array($_POST["candidate_cp_relation2"])) {
// 				$_SESSION["session"]["candidate_cp_relation2"]=$_POST["candidate_cp_relation2"][0];
// 		}
		
// 		//print_r($_SESSION);exit;
// 		header("location: "._PATHURL."/index.php?mod=resume&gal=".coded("1")."&missteps=".coded($notice));
// 		exit;
// 	}	
	
// 	else {
// 		$data=array();
// 		$data["candidate_c_city"]=(isset($_POST["candidate_c_city"]) && is_array($_POST["candidate_c_city"]))?$_POST["candidate_c_city"][0]:"";
// 		$data["candidate_p_city"]=(isset($_POST["candidate_p_city"]) && is_array($_POST["candidate_p_city"]))?$_POST["candidate_p_city"][0]:"";
// 		$data["candidate_marital"]=(isset($_POST["candidate_marital"]) && is_array($_POST["candidate_marital"]))?$_POST["candidate_marital"][0]:"";
// 		/*$data["candidate_religion"]=(isset($_POST["candidate_religion"]) && is_array($_POST["candidate_religion"]))?$_POST["candidate_religion"][0]:"";*/
// 		$data["candidate_bloodtype"]=(isset($_POST["candidate_bloodtype"]) && is_array($_POST["candidate_bloodtype"]))?$_POST["candidate_bloodtype"][0]:"";
// 		$data["candidate_cp_relation1"]=(isset($_POST["candidate_cp_relation1"]) && is_array($_POST["candidate_cp_relation1"]))?$_POST["candidate_cp_relation1"][0]:"";
// 		$data["candidate_cp_relation2"]=(isset($_POST["candidate_cp_relation2"]) && is_array($_POST["candidate_cp_relation2"]))?$_POST["candidate_cp_relation2"][0]:"";
// 		$data["candidate_race"]=(isset($_POST["candidate_race"]) && is_array($_POST["candidate_race"]))?$_POST["candidate_race"][0]:"";


		
// 		//proses update database
// 		$query=querying("UPDATE m_candidate
// 			SET
// 				candidate_birthplace=?,
// 				candidate_birthdate=?,
// 				candidate_gender=?,
// 				candidate_nationality=?,
// 				candidate_religion=?,
// 				candidate_race=?,
// 				candidate_marital=?,
// 				candidate_bodyheight=?,
// 				candidate_bodyweight=?,
// 				candidate_bloodtype=?,
// 				candidate_sim_a=?,
// 				candidate_sim_c=?,
// 				candidate_npwp=?,
// 				candidate_p_address=?,
// 				candidate_p_city=?,
// 				candidate_p_postcode=?,
// 				candidate_c_address=?,
// 				candidate_c_city=?,
// 				candidate_c_postcode=?,
// 				candidate_hp1=?,
// 				candidate_hp2=?,
// 				candidate_phone=?,
// 				candidate_cp_name1=?,
// 				candidate_cp_relation1=?,
// 				candidate_cp_phone1=?,
// 				candidate_cp_name2=?,
// 				candidate_cp_relation2=?,
// 				candidate_cp_phone2=?,
// 				candidate_ref_name=?, 
// 				candidate_ref_division=?, 
// 				candidate_ref_position=?, 
// 				candidate_expected_salary=?, 
// 				candidate_hobby=?,
// 				user_update=?,
// 				date_update=NOW()
// 			WHERE candidate_id=?", array($_POST["candidate_birthplace"],$_POST["candidate_birthdate"],$_POST["candidate_gender"],$_POST["candidate_religion"], $data["candidate_race"], $data["candidate_marital"], $_POST["candidate_bodyheight"], 
// 			$_POST["candidate_bodyweight"], $data["candidate_bloodtype"], $_POST["candidate_sim_a"], $_POST["candidate_sim_c"], $_POST["candidate_npwp"], $_POST["candidate_p_address"], 
// 			$data["candidate_p_city"], $_POST["candidate_p_postcode"], $_POST["candidate_c_address"], $data["candidate_c_city"], $_POST["candidate_c_postcode"], 
// 			$_POST["candidate_hp1"], $_POST["candidate_hp2"], $_POST["candidate_cp_name1"], $data["candidate_cp_relation1"], $_POST["candidate_cp_phone1"], 
// 			$_POST["candidate_cp_name2"], $data["candidate_cp_relation2"], $_POST["candidate_cp_phone2"], $_POST["candidate_ref_name"]
// 			, $_POST["candidate_ref_division"], $_POST["candidate_ref_position"], $_POST["candidate_expected_salary"], $_POST["candidate_hobby"], $_SESSION["log_auth_id"], $_SESSION["candidate_id"]));
		
// 		if($query) {
// 			unset($_SESSION["session"]);
// 			header("location: "._PATHURL."/index.php?mod=education&mess=".coded("Personal Data has been updated.<br><i>Data pribadi telah berhasil diperbaharui.</i>"));
// 			exit;
// 		}
// 		else {
// 			header("location: "._PATHURL."/index.php?mod=resume&gal=".coded("1")."&mess=".coded("Personal Data update failed.<br><i>Pembaharuan data pribadi tidak berhasil dilakukan.</i>"));
// 			exit;
// 		}
		
// 	}
// }

/* Bagian Update Resume */
/* Bagian Update Resume */
function update_candidateResume() {
	
	$_POST = sanitize_post($_POST);
	$_GET  = sanitize_get($_GET);
	
	
	// print_r($_POST); exit;
	/* candidate_name, candidate_email, candidate_gender, candidate_religion, candidate_birthplace, candidate_birthdate, 
candidate_race, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_bodyheight, candidate_bodyweight, 
candidate_bloodtype, candidate_sim_a, candidate_sim_c, candidate_npwp, candidate_marital, candidate_p_address, candidate_p_city, candidate_p_postcode, 
candidate_c_address, candidate_c_city, candidate_c_postcode, candidate_hp1, candidate_hp2, candidate_phone, candidate_cp_name1, candidate_cp_relation1, 
candidate_cp_phone1, candidate_cp_name2, candidate_cp_relation2, candidate_cp_phone2, 
candidate_ref_name, candidate_ref_division, candidate_ref_position, candidate_expected_salary, candidate_hobby */
	
	$missteps = array();
	//if (!isset($_POST["candidate_name"]) or $_POST["candidate_name"] == "") 	$missteps[] = 0;
	//if (!isset($_POST["candidate_email"]) or $_POST["candidate_email"] == "") 		$missteps[] = 1;
	if (!isset($_POST["candidate_gender"]) or $_POST["candidate_gender"] == "") 		$missteps[] = 2;
	if (!isset($_POST["candidate_religion"]) or $_POST["candidate_religion"] == "") 		$missteps[] = 3;
	if (!isset($_POST["place_of_birth"]) or $_POST["place_of_birth"] == "") 		$missteps[] = 4;
	if (!isset($_POST["birthdate"]) or $_POST["birthdate"] == "") 		$missteps[] = 5;
	//if (!isset($_POST["candidate_race"]) or $_POST["candidate_race"] == "") 		$missteps[] = 6;
	//if (!isset($_POST["candidate_nationality"]) or $_POST["candidate_nationality"] == "") 		$missteps[] = 7;
	//if (!isset($_POST["candidate_country"]) or $_POST["candidate_country"] == "") 		$missteps[] = 8;
	//if (!isset($_POST["candidate_idtype"]) or $_POST["candidate_idtype"] == "") 		$missteps[] = 9;
	//if (!isset($_POST["candidate_idcard"]) or $_POST["candidate_idcard"] == "") 		$missteps[] = 10;
	//if (!isset($_POST["candidate_bodyheight"]) or $_POST["candidate_bodyheight"] == "") 		$missteps[] = 11;
	//if (!isset($_POST["candidate_bodyweight"]) or $_POST["candidate_bodyweight"] == "") 		$missteps[] = 12;
	//if (!isset($_POST["candidate_bloodtype"]) or $_POST["candidate_bloodtype"] == "") 		$missteps[] = 13;
	//if (!isset($_POST["candidate_sim_a"]) or $_POST["candidate_sim_a"] == "") 		$missteps[] = 14;
	//if (!isset($_POST["candidate_sim_c"]) or $_POST["candidate_sim_c"] == "") 		$missteps[] = 15;
	//if (!isset($_POST["candidate_npwp"]) or $_POST["candidate_npwp"] == "") 		$missteps[] = 16;
	if (!isset($_POST["candidate_marital"]) or $_POST["candidate_marital"] == "") 		$missteps[] = 17;
	if (!isset($_POST["candidate_p_address"]) or $_POST["candidate_p_address"] == "") 		$missteps[] = 18;
	if (!isset($_POST["candidate_p_city"]) or $_POST["candidate_p_city"] == "") 		$missteps[] = 19;
	//if (!isset($_POST["candidate_p_postcode"]) or $_POST["candidate_p_postcode"] == "") 		$missteps[] = 20;
	if (!isset($_POST["candidate_c_address"]) or $_POST["candidate_c_address"] == "") 		$missteps[] = 21;
	if (!isset($_POST["candidate_c_city"]) or $_POST["candidate_c_city"] == "") 		$missteps[] = 22;
	//if (!isset($_POST["candidate_c_postcode"]) or $_POST["candidate_c_postcode"] == "") 		$missteps[] = 23;
	if (!isset($_POST["candidate_hp1"]) or $_POST["candidate_hp1"] == "") 		$missteps[] = 24;
	//if (!isset($_POST["candidate_hp2"]) or $_POST["candidate_hp2"] == "") 		$missteps[] = 25;
	//if (!isset($_POST["candidate_phone"]) or $_POST["candidate_phone"] == "") 		$missteps[] = 26;
	if (!isset($_POST["candidate_cp_name1"]) or $_POST["candidate_cp_name1"] == "") 		$missteps[] = 27;
	if (!isset($_POST["candidate_cp_relation1"]) or $_POST["candidate_cp_relation1"] == "") 		$missteps[] = 28;
	// if (!isset($_POST["candidate_cp_phone1"]) or $_POST["candidate_cp_phone1"] == "") 		$missteps[] = 29;
	//if (!isset($_POST["candidate_cp_name2"]) or $_POST["candidate_cp_name2"] == "") 		$missteps[] = 30;
	//if (!isset($_POST["candidate_cp_relation2"]) or $_POST["candidate_cp_relation2"] == "") 		$missteps[] = 31;
	//if (!isset($_POST["candidate_cp_phone2"]) or $_POST["candidate_cp_phone2"] == "") 		$missteps[] = 32;
	//if (!isset($_POST["candidate_hobby"]) or $_POST["candidate_hobby"] == "") 		$missteps[] = 33;
	
	
	if (count($missteps)>0)
	{
		for ($i=0;$i<count($missteps);$i++) {
			$notice[] = error_notice($missteps[$i]);
		}
		$notice = json_encode($notice);
		
		$_SESSION["session"] = $_POST;	
		//print_r($_SESSION); exit;

		if(isset($_POST["place_of_birth"]) && is_array($_POST["place_of_birth"])) {
			$_SESSION["session"]["candidate_birthplace"]=$_POST["candidate_birthplace"][0];
		}
		if(isset($_POST["candidate_c_city"]) && is_array($_POST["candidate_c_city"])) {
				$_SESSION["session"]["candidate_c_city"]=$_POST["candidate_c_city"][0];
		}
		if(isset($_POST["candidate_p_city"]) && is_array($_POST["candidate_p_city"])) {
				$_SESSION["session"]["candidate_p_city"]=$_POST["candidate_p_city"][0];
		}
		if(isset($_POST["candidate_marital"]) && is_array($_POST["candidate_marital"])) {
				$_SESSION["session"]["candidate_marital"]=$_POST["candidate_marital"][0];
		}
		/*if(isset($_POST["candidate_religion"]) && is_array($_POST["candidate_religion"])) {
				$_SESSION["session"]["candidate_religion"]=$_POST["candidate_religion"][0];
		}*/
		if(isset($_POST["candidate_bloodtype"]) && is_array($_POST["candidate_bloodtype"])) {
				$_SESSION["session"]["candidate_bloodtype"]=$_POST["candidate_bloodtype"][0];
		}
		if(isset($_POST["candidate_cp_relation1"]) && is_array($_POST["candidate_cp_relation1"])) {
				$_SESSION["session"]["candidate_cp_relation1"]=$_POST["candidate_cp_relation1"][0];
		}
		if(isset($_POST["candidate_cp_relation2"]) && is_array($_POST["candidate_cp_relation2"])) {
				$_SESSION["session"]["candidate_cp_relation2"]=$_POST["candidate_cp_relation2"][0];
		}
		
		//print_r($_SESSION);exit;
		header("location: "._PATHURL."/index.php?mod=resume&gal=".coded("1")."&missteps=".coded($notice));
		exit;
	}	
	
	else {
		$data=array();
		$data["candidate_birthplace"]=(isset($_POST["place_of_birth"]) && is_array($_POST["place_of_birth"]))?$_POST["place_of_birth"][0]:"";
		$data["candidate_c_city"]=(isset($_POST["candidate_c_city"]) && is_array($_POST["candidate_c_city"]))?$_POST["candidate_c_city"][0]:"";
		$data["candidate_p_city"]=(isset($_POST["candidate_p_city"]) && is_array($_POST["candidate_p_city"]))?$_POST["candidate_p_city"][0]:"";
		$data["candidate_marital"]=(isset($_POST["candidate_marital"]) && is_array($_POST["candidate_marital"]))?$_POST["candidate_marital"][0]:"";
		/*$data["candidate_religion"]=(isset($_POST["candidate_religion"]) && is_array($_POST["candidate_religion"]))?$_POST["candidate_religion"][0]:"";*/
		$data["candidate_bloodtype"]=(isset($_POST["candidate_bloodtype"]) && is_array($_POST["candidate_bloodtype"]))?$_POST["candidate_bloodtype"][0]:"";
		$data["candidate_cp_relation1"]=(isset($_POST["candidate_cp_relation1"]) && is_array($_POST["candidate_cp_relation1"]))?$_POST["candidate_cp_relation1"][0]:"";
		$data["candidate_cp_relation2"]=(isset($_POST["candidate_cp_relation2"]) && is_array($_POST["candidate_cp_relation2"]))?$_POST["candidate_cp_relation2"][0]:"";
		$data["candidate_race"]=(isset($_POST["candidate_race"]) && is_array($_POST["candidate_race"]))?$_POST["candidate_race"][0]:"";


		$birthdate=reverseDate($_POST["birthdate"]);
		//proses update database
		$query=querying("UPDATE m_candidate
			SET
				candidate_gender=?,
				candidate_birthplace=?,
				candidate_birthdate=?,
				candidate_religion=?,
				candidate_race=?,
				candidate_marital=?,
				candidate_bloodtype=?,
				candidate_sim_a=?,
				candidate_sim_c=?,
				candidate_npwp=?,
				candidate_p_address=?,
				candidate_p_city=?,
				candidate_p_postcode=?,
				candidate_c_address=?,
				candidate_c_city=?,
				candidate_c_postcode=?,
				candidate_hp1=?,
				candidate_cp_name1=?,
				candidate_cp_relation1=?,
				candidate_cp_phone1=?,
				candidate_cp_name2=?,
				candidate_cp_relation2=?,
				candidate_cp_phone2=?,
				candidate_ref_name=?, 
				candidate_ref_division=?, 
				candidate_ref_position=?, 
				candidate_expected_salary=?, 
				candidate_hobby=?,
				user_update=?,
				date_update=NOW()
			WHERE candidate_id=?", array($_POST["candidate_gender"], $data["candidate_birthplace"], $birthdate, $_POST["candidate_religion"], $data["candidate_race"], $data["candidate_marital"],$data["candidate_bloodtype"],
			 $_POST["candidate_sim_a"], $_POST["candidate_sim_c"], $_POST["candidate_npwp"], $_POST["candidate_p_address"], 
			$data["candidate_p_city"], $_POST["candidate_p_postcode"], $_POST["candidate_c_address"], $data["candidate_c_city"], $_POST["candidate_c_postcode"], 
			$_POST["candidate_hp1"], $_POST["candidate_cp_name1"], $data["candidate_cp_relation1"], $_POST["candidate_cp_phone1"], 
			$_POST["candidate_cp_name2"], $data["candidate_cp_relation2"], $_POST["candidate_cp_phone2"], $_POST["candidate_ref_name"]
			, $_POST["candidate_ref_division"], $_POST["candidate_ref_position"], $_POST["candidate_expected_salary"], $_POST["candidate_hobby"], $_SESSION["log_auth_id"], $_SESSION["candidate_id"]));
		
		if($query) {
			unset($_SESSION["session"]);
			header("location: "._PATHURL."/index.php?mod=education&mess=".coded("Personal Data has been updated.<br><i>Data pribadi telah berhasil diperbaharui.</i>"));
			exit;
		}
		else {
			header("location: "._PATHURL."/index.php?mod=resume&gal=".coded("1")."&mess=".coded("Personal Data update failed.<br><i>Pembaharuan data pribadi tidak berhasil dilakukan.</i>"));
			exit;
		}
		
	}
}


function disableFunction($innername) {
    if (is_callable($innername == education)) {
        // Rename the original function with a unique name
        $disabledFunctionName = $innername . '_disabled_' . uniqid();
        rename($innername, $disabledFunctionName);
        
        // Create a new function that throws an exception when called
        eval("function $innername() { throw new Exception('Function $functionName has been disabled.'); }");
    }
}

function enableFunction($functionName) {
    if (is_callable($functionName)) {
        // Get the disabled function name
        $disabledFunctionName = $functionName . '_disabled_*';
        
        // Get the list of disabled functions
        $disabledFunctions = glob($disabledFunctionName);
        
        // Get the most recent disabled function (original function)
        $originalFunction = end($disabledFunctions);
        
        if ($originalFunction) {
            // Get the original function name
            $originalFunctionName = str_replace('_disabled_', '', $originalFunction);
            
            // Restore the original function
            rename($originalFunction, $originalFunctionName);
        }
    }
}
//part update organization
	function update_candidateOrg() {

		$candidate_organization_start = (isset($_POST["candidate_organization_start"]) AND $_POST["candidate_organization_start"] <> "") ? $_POST["candidate_organization_start"] : "";
		$candidate_organization_end = (isset($_POST["candidate_organization_end"]) AND $_POST["candidate_organization_end"] <> "") ? $_POST["candidate_organization_end"] : "";
		$candidate_organization_role = (isset($_POST["candidate_organization_role"]) AND $_POST["candidate_organization_role"] <> "") ? $_POST["candidate_organization_role"] : "";
		$candidate_organization_id = (isset($_POST["candidate_organization_id"]) AND $_POST["candidate_organization_id"] <> "") ? $_POST["candidate_organization_id"] : "";
		$candidate_organization_name = (isset($_POST["candidate_organization_name"]) AND $_POST["candidate_organization_name"] <> "") ? $_POST["candidate_organization_name"] : "";
		
		//print_r($candidate_organization_name);exit;
		// Search candidate_organization_id in DB, insert to array id_found
			$query = querying("SELECT candidate_organization_id FROM m_candidate_organization WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_organization_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_organization_id"];
			}
			//print_r ($id_found); exit;
			
			$remove_array_kenol=array();
			for ($i=1;$i<count($candidate_organization_id);$i++) {
				$remove_array_kenol[]=$candidate_organization_id[$i];
			}
			
			/*
			print_r ($candidate_organization_id);
			echo "yg ada di database = ";print_r ($id_found); 
			echo "<br>yg data baru utuh = ";print_r ($candidate_organization_id); print_r($candidate_organization_start);
			echo "<br>tanpa array ke nol = ";print_r ($remove_array_kenol); 
			exit;
			*/
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_organization_id=0, or edit if candidate_organization_id <> 0, and insert the edited candidate_organization_id to array newID
			//candidate_organization_id, candidate_id, candidate_organization_name, candidate_organization_role, candidate_organization_start, candidate_organization_end, user_insert, date_insert, user_update, date_update

			for($i=0;$i<count($candidate_organization_name);$i++)
			{
				$candidate_organization_name[$i]=sanitize_post($candidate_organization_name[$i]);
				$candidate_organization_role[$i]=sanitize_post($candidate_organization_role[$i]);
				$candidate_organization_start[$i]=sanitize_post($candidate_organization_start[$i]);
				$candidate_organization_end[$i]=sanitize_post($candidate_organization_end[$i]);
				
				if($candidate_organization_name[$i] <> "")
				{
					if($candidate_organization_id[$i] > 0)			//update
					{
						if(querying("UPDATE m_candidate_organization SET candidate_organization_name=?, candidate_organization_role=?, 
						candidate_organization_start=?, candidate_organization_end=?, user_update=?, date_update = now() WHERE candidate_organization_id = ?", 
						array($candidate_organization_name[$i], $candidate_organization_role[$i], $candidate_organization_start[$i], $candidate_organization_end[$i], 
						$_SESSION["log_auth_id"], $candidate_organization_id[$i])))
						{
							$sukses ++;
							$array_insert[] = $candidate_organization_id[$i];
						}
					}
					if($candidate_organization_id[$i] == 0)			//insert
					{
						if(querying("INSERT into m_candidate_organization(candidate_id, candidate_organization_name, candidate_organization_role, 
						candidate_organization_start, candidate_organization_end, user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], $candidate_organization_name[$i], $candidate_organization_role[$i], $candidate_organization_start[$i], 
						$candidate_organization_end[$i], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
							$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_organization WHERE candidate_organization_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=training&mess=".coded("Organizational Experiences has been updated.<br><i>Pengalaman Organisasi telah berhasil diperbaharui</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=organization&gal=".coded("1")."&mess=".coded("Organizational Experiences update failed.<br><i>Pengalaman Organisasi gagal diperbaharui.</i>"));
				exit;
			}
			
	}

//part update skills
	function update_candidateSkill() {
		/* candidate_skill_id, candidate_id, candidate_skill_name, candidate_skill_level, candidate_skill_notes, user_insert, date_insert, user_update, date_update */
		$candidate_skill_notes = (isset($_POST["candidate_skill_notes"]) AND $_POST["candidate_skill_notes"] <> "") ? $_POST["candidate_skill_notes"] : "";
		$candidate_skill_level = (isset($_POST["candidate_skill_level"]) AND $_POST["candidate_skill_level"] <> "") ? $_POST["candidate_skill_level"] : "";
		$candidate_skill_id = (isset($_POST["candidate_skill_id"]) AND $_POST["candidate_skill_id"] <> "") ? $_POST["candidate_skill_id"] : "";
		$candidate_skill_name = (isset($_POST["candidate_skill_name"]) AND $_POST["candidate_skill_name"] <> "") ? $_POST["candidate_skill_name"] : "";
		
		//print_r($candidate_skill_name);exit;
		// Search candidate_skill_id in DB, insert to array id_found
			$query = querying("SELECT candidate_skill_id FROM m_candidate_skill WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_skill_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_skill_id"];
			}
			//print_r ($id_found); exit;
			
			$remove_array_kenol=array();
			for ($i=1;$i<count($candidate_skill_id);$i++) {
				$remove_array_kenol[]=$candidate_skill_id[$i];
			}
			
			/*
			print_r ($candidate_skill_id);
			echo "yg ada di database = ";print_r ($id_found); 
			echo "<br>yg data baru utuh = ";print_r ($candidate_skill_id); print_r($candidate_skill_notes);
			echo "<br>tanpa array ke nol = ";print_r ($remove_array_kenol); 
			exit;
			*/
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_skill_id=0, or edit if candidate_skill_id <> 0, and insert the edited candidate_skill_id to array newID
			//candidate_skill_id, candidate_id, candidate_skill_name, candidate_skill_level, candidate_skill_notes, user_insert, date_insert, user_update, date_update

			for($i=0;$i<count($candidate_skill_name);$i++)
			{
				$candidate_skill_name[$i]=sanitize_post($candidate_skill_name[$i]);
				$candidate_skill_level[$i]=sanitize_post($candidate_skill_level[$i]);
				$candidate_skill_notes[$i]=sanitize_post($candidate_skill_notes[$i]);
				
				if($candidate_skill_name[$i] <> "")
				{
					if($candidate_skill_id[$i] > 0)			//update
					{
						if(querying("UPDATE m_candidate_skill SET candidate_skill_name=?, candidate_skill_level=?, 
						candidate_skill_notes=?, user_update=?, date_update = now() WHERE candidate_skill_id = ?", 
						array($candidate_skill_name[$i], $candidate_skill_level[$i], $candidate_skill_notes[$i], 
						$_SESSION["log_auth_id"], $candidate_skill_id[$i])))
						{
							$sukses ++;
							$array_insert[] = $candidate_skill_id[$i];
						}
					}
					if($candidate_skill_id[$i] == 0)			//insert
					{
						if(querying("INSERT into m_candidate_skill(candidate_id, candidate_skill_name, candidate_skill_level, 
						candidate_skill_notes, user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], $candidate_skill_name[$i], $candidate_skill_level[$i], 
						$candidate_skill_notes[$i], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
							$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_skill WHERE candidate_skill_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=language&mess=".coded("Skills has been updated.<br><i>Data keahlian/ketrampilan telah berhasil diperbaharui.</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=skills&gal=".coded("1")."&mess=".coded("Skills update failed.<br><i>Data keahlian/ketrampilan tidak berhasil diperbaharui</i>"));
				exit;
			}
			
	}


//part update language
	function update_candidateLang() {

		/* candidate_language_id, candidate_id, candidate_language_name, candidate_language_read, candidate_language_write, candidate_language_conversation, 
		user_insert, date_insert, user_update, date_update */
		$candidate_language_read = (isset($_POST["candidate_language_read"]) AND $_POST["candidate_language_read"] <> "") ? $_POST["candidate_language_read"] : "";
		$candidate_language_write = (isset($_POST["candidate_language_write"]) AND $_POST["candidate_language_write"] <> "") ? $_POST["candidate_language_write"] : "";
		$candidate_language_conversation = (isset($_POST["candidate_language_conversation"]) AND $_POST["candidate_language_conversation"] <> "") ? $_POST["candidate_language_conversation"] : "";
		$candidate_language_id = (isset($_POST["candidate_language_id"]) AND $_POST["candidate_language_id"] <> "") ? $_POST["candidate_language_id"] : "";
		$candidate_language_name = (isset($_POST["candidate_language_name"]) AND $_POST["candidate_language_name"] <> "") ? $_POST["candidate_language_name"] : "";
		
		//print_r($candidate_language_name);exit;
		// Search candidate_language_id in DB, insert to array id_found
			$query = querying("SELECT candidate_language_id FROM m_candidate_language WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_language_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_language_id"];
			}
			//print_r ($id_found); exit;
			
			$remove_array_kenol=array();
			for ($i=1;$i<count($candidate_language_id);$i++) {
				$remove_array_kenol[]=$candidate_language_id[$i];
			}
			
			/*
			print_r ($candidate_language_id);
			echo "yg ada di database = ";print_r ($id_found); 
			echo "<br>yg data baru utuh = ";print_r ($candidate_language_id); print_r($candidate_language_read);
			echo "<br>tanpa array ke nol = ";print_r ($remove_array_kenol); 
			exit;
			*/
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_language_id=0, or edit if candidate_language_id <> 0, and insert the edited candidate_language_id to array newID
			//candidate_language_id, candidate_id, candidate_language_name, candidate_language_conversation, candidate_language_read, candidate_language_write, user_insert, date_insert, user_update, date_update

			for($i=0;$i<count($candidate_language_name);$i++)
			{
				$candidate_language_name[$i]=sanitize_post($candidate_language_name[$i]);
				$candidate_language_conversation[$i]=sanitize_post($candidate_language_conversation[$i]);
				$candidate_language_read[$i]=sanitize_post($candidate_language_read[$i]);
				$candidate_language_write[$i]=sanitize_post($candidate_language_write[$i]);
				
				if($candidate_language_name[$i] <> "")
				{
					if($candidate_language_id[$i] > 0)			//update
					{
						if(querying("UPDATE m_candidate_language SET candidate_language_name=?, candidate_language_conversation=?, 
						candidate_language_read=?, candidate_language_write=?, user_update=?, date_update = now() WHERE candidate_language_id = ?", 
						array($candidate_language_name[$i], $candidate_language_conversation[$i], $candidate_language_read[$i], $candidate_language_write[$i], 
						$_SESSION["log_auth_id"], $candidate_language_id[$i])))
						{
							$sukses ++;
							$array_insert[] = $candidate_language_id[$i];
						}
					}
					if($candidate_language_id[$i] == 0)			//insert
					{
						if(querying("INSERT into m_candidate_language(candidate_id, candidate_language_name, candidate_language_conversation, 
						candidate_language_read, candidate_language_write, user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], $candidate_language_name[$i], $candidate_language_conversation[$i], $candidate_language_read[$i], 
						$candidate_language_write[$i], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
							$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_language WHERE candidate_language_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=family&mess=".coded("Language Profeciency has been updated.<br><i>Data kemampuan bahasa telah berhasil diperbaharui.</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=language&gal=".coded("1")."&mess=".coded("Language Profeciency update failed.<br><i>Data kemampuan bahasa tidak berhasil diperbaharui.</i>"));
				exit;
			}
			
	}


//part update Family
	function update_candidateFam() {

		$candidate_family_relation = (isset($_POST["candidate_family_relation"]) AND $_POST["candidate_family_relation"] <> "") ? $_POST["candidate_family_relation"] : "";
		$candidate_family_birthplace = (isset($_POST["candidate_family_birthplace"]) AND $_POST["candidate_family_birthplace"] <> "") ? $_POST["candidate_family_birthplace"] : "";

		$dob_tgl = (isset($_POST["dob_tgl"]) AND $_POST["dob_tgl"] <> "") ? $_POST["dob_tgl"] : "00";
		$dob_bln = (isset($_POST["dob_bln"]) AND $_POST["dob_bln"] <> "") ? $_POST["dob_bln"] : "00";
		$dob_thn = (isset($_POST["dob_thn"]) AND $_POST["dob_thn"] <> "") ? $_POST["dob_thn"] : "0000";
				
		$candidate_family_id = (isset($_POST["candidate_family_id"]) AND $_POST["candidate_family_id"] <> "") ? $_POST["candidate_family_id"] : "";
		$candidate_family_name = (isset($_POST["candidate_family_name"]) AND $_POST["candidate_family_name"] <> "") ? $_POST["candidate_family_name"] : "";
		$candidate_family_lastedu = (isset($_POST["candidate_family_lastedu"]) AND $_POST["candidate_family_lastedu"] <> "") ? $_POST["candidate_family_lastedu"] : "";
		$candidate_family_lastjob = (isset($_POST["candidate_family_lastjob"]) AND $_POST["candidate_family_lastjob"] <> "") ? $_POST["candidate_family_lastjob"] : "";
		$candidate_family_company = (isset($_POST["candidate_family_company"]) AND $_POST["candidate_family_company"] <> "") ? $_POST["candidate_family_company"] : "";
		$candidate_family_rip = (isset($_POST["candidate_family_rip"]) AND $_POST["candidate_family_rip"] <> "") ? $_POST["candidate_family_rip"] : "";
		
		//print_r($candidate_family_name);exit;
		// Search candidate_family_id in DB, insert to array id_found
			$query = querying("SELECT candidate_family_id FROM m_candidate_family WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_family_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_family_id"];
			}
			//print_r ($id_found); exit;
			
			$remove_array_kenol=array();
			for ($i=1;$i<count($candidate_family_id);$i++) {
				$remove_array_kenol[]=$candidate_family_id[$i];
			}
			
			/*
			print_r ($candidate_family_id);
			echo "yg ada di database = ";print_r ($id_found); 
			echo "<br>yg data baru utuh = ";print_r ($candidate_family_id); print_r($candidate_family_relation);
			echo "<br>tanpa array ke nol = ";print_r ($remove_array_kenol); 
			exit;
			*/
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_family_id=0, or edit if candidate_family_id <> 0, and insert the edited candidate_family_id to array newID
			/* candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, 
		candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip, user_insert, date_insert, 
		user_update, date_update */
		
			for($i=0;$i<count($candidate_family_name);$i++)
			{
				$candidate_family_name[$i]=sanitize_post($candidate_family_name[$i]);
				$candidate_family_birthdate[$i]=$dob_thn[$i]."-".$dob_bln[$i]."-".$dob_tgl[$i];
				$candidate_family_relation[$i]=sanitize_post($candidate_family_relation[$i]);
				$candidate_family_birthplace[$i]=sanitize_post($candidate_family_birthplace[$i]);
				$candidate_family_lastedu[$i] = sanitize_post($candidate_family_lastedu[$i]);
				$candidate_family_lastjob[$i] = sanitize_post($candidate_family_lastjob[$i]);
				$candidate_family_company[$i] = sanitize_post($candidate_family_company[$i]);
				$candidate_family_rip[$i] = sanitize_post($candidate_family_rip[$i]);
				
				if($candidate_family_name[$i] <> "")
				{
					if($candidate_family_id[$i] > 0)			//update
					{
						if(querying("UPDATE m_candidate_family SET candidate_family_name=?, candidate_family_birthdate=?, 
						candidate_family_relation=?, candidate_family_birthplace=?, candidate_family_lastedu=?, 
						candidate_family_lastjob=?, candidate_family_company=?, candidate_family_rip=?, user_update=?, 
						date_update = now() WHERE candidate_family_id = ?", 
						array($candidate_family_name[$i], $candidate_family_birthdate[$i], $candidate_family_relation[$i], $candidate_family_birthplace[$i], 
						$candidate_family_lastedu[$i], $candidate_family_lastjob[$i], $candidate_family_company[$i], $candidate_family_rip[$i], 
						$_SESSION["log_auth_id"], $candidate_family_id[$i])))
						{
							$sukses ++;
							$array_insert[] = $candidate_family_id[$i];
						}
					}
					if($candidate_family_id[$i] == 0)			//insert
					{
						if(querying("INSERT into m_candidate_family(candidate_id, candidate_family_name, candidate_family_birthdate, 
						candidate_family_relation, candidate_family_birthplace, candidate_family_lastedu, candidate_family_lastjob, 
						candidate_family_company, candidate_family_rip, user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], $candidate_family_name[$i], $candidate_family_birthdate[$i], $candidate_family_relation[$i], 
						$candidate_family_birthplace[$i], $candidate_family_lastedu[$i], $candidate_family_lastjob[$i], $candidate_family_company[$i], 
						$candidate_family_rip[$i], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
							$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_family WHERE candidate_family_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=documents&mess=".coded("Family member has been updated.<br><i>Data Keluarga berhasil diperbaharui.</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=family&gal=".coded("1")."&mess=".coded("Family member update failed.<br><i>Pembaharuan data keluarga gagal.</i>"));
				exit;
			}
			
	}
	
//part update Training
	function update_candidateTraining() {

		/* candidate_training_id, candidate_id, candidate_training_name, candidate_training_institution, candidate_training_city, 
		candidate_training_year, candidate_training_duration, candidate_training_sponsor, user_insert, date_insert, user_update, date_update */
		for($i=0;$i<5;$i++) {
			
			${"candidate_training_institution_" . $i} = (isset($_POST["candidate_training_institution_".$i]) AND $_POST["candidate_training_institution_".$i] <> "") ? $_POST["candidate_training_institution_".$i] : "";
			${"candidate_training_city_" . $i} = (isset($_POST["candidate_training_city_".$i]) AND $_POST["candidate_training_city_".$i] <> "") ? $_POST["candidate_training_city_".$i] : "";
			if(is_array(${"candidate_training_city_" . $i})) {
					${"candidate_training_city_" . $i}=$_POST["candidate_training_city_".$i][0];
			}

			
			${"candidate_training_year_" . $i} = (isset($_POST["candidate_training_year_".$i]) AND $_POST["candidate_training_year_".$i] <> "") ? $_POST["candidate_training_year_".$i] : "";
			${"candidate_training_id_" . $i} = (isset($_POST["candidate_training_id_".$i]) AND $_POST["candidate_training_id_".$i] <> "") ? $_POST["candidate_training_id_".$i] : "";
			${"candidate_training_name_" . $i} = (isset($_POST["candidate_training_name_".$i]) AND $_POST["candidate_training_name_".$i] <> "") ? $_POST["candidate_training_name_".$i] : "";
			${"candidate_training_duration_" . $i} = (isset($_POST["candidate_training_duration_".$i]) AND $_POST["candidate_training_duration_".$i] <> "") ? $_POST["candidate_training_duration_".$i] : "";
			${"candidate_training_sponsor_" . $i} = (isset($_POST["candidate_training_sponsor_".$i]) AND $_POST["candidate_training_sponsor_".$i] <> "") ? $_POST["candidate_training_sponsor_".$i] : "";
		}
		
		//exit;

		// Search candidate_training_id in DB, insert to array id_found
			$query = querying("SELECT candidate_training_id FROM m_candidate_training WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_training_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_training_id"];
			}
			//print_r ($id_found); exit;
			
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_training_id=0, or edit if candidate_training_id <> 0, and insert the edited candidate_training_id to array newID
			/* candidate_training_id, candidate_id, candidate_training_name, candidate_training_institution, candidate_training_city, 
			candidate_training_year, candidate_training_duration, candidate_training_sponsor, user_insert, date_insert, user_update, date_update */
			
			for($i=0;$i<5;$i++)
			{
				${"candidate_training_institution_" . $i} = sanitize_post(${"candidate_training_institution_" . $i});
				${"candidate_training_city_" . $i} = sanitize_post(${"candidate_training_city_" . $i});
				${"candidate_training_year_" . $i} = sanitize_post(${"candidate_training_year_" . $i});
				${"candidate_training_id_" . $i} = sanitize_post(${"candidate_training_id_" . $i});
				${"candidate_training_name_" . $i} = sanitize_post(${"candidate_training_name_" . $i});
				${"candidate_training_duration_" . $i} = sanitize_post(${"candidate_training_duration_" . $i});
				${"candidate_training_sponsor_" . $i} = sanitize_post(${"candidate_training_sponsor_" . $i});
				
				if(${"candidate_training_name_" . $i} <> "")
				{
					if(${"candidate_training_id_" . $i} > 0)			//update
					{
						if(querying("UPDATE m_candidate_training SET candidate_training_name=?, candidate_training_year=?, 
						candidate_training_institution=?, candidate_training_city=?, candidate_training_duration=?, candidate_training_sponsor=?, 
						user_update=?, date_update = now() WHERE candidate_training_id = ?", 
						array(${"candidate_training_name_" . $i}, ${"candidate_training_year_" . $i}, ${"candidate_training_institution_" . $i}, 
						${"candidate_training_city_" . $i}, ${"candidate_training_duration_" . $i},	${"candidate_training_sponsor_" . $i},
						$_SESSION["log_auth_id"], ${"candidate_training_id_" . $i})))
						{
							$sukses ++;
							$array_insert[] = ${"candidate_training_id_" . $i};
						}
					}
					if(${"candidate_training_id_" . $i} == 0)			//insert
					{
						if(querying("INSERT into m_candidate_training(candidate_id, candidate_training_name, candidate_training_year, 
						candidate_training_institution, candidate_training_city, candidate_training_duration, candidate_training_sponsor, 
						user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], ${"candidate_training_name_" . $i}, ${"candidate_training_year_" . $i}, 
						${"candidate_training_institution_" . $i}, ${"candidate_training_city_" . $i}, ${"candidate_training_duration_" . $i},	
						${"candidate_training_sponsor_" . $i}, $_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
						$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_training WHERE candidate_training_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=skills&mess=".coded("Training experience(s) has been updated.<br><i>Pengalaman pelatihan berhasil diperbaharui.</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=training&gal=".coded("1")."&mess=".coded("Training experience(s) update failed.<br><i>Pembaharuan data training gagal dilakukan.</i>"));
				exit;
			}
			
	}

//part update Education
	function update_candidateEdu() {

		/* candidate_edu_id, candidate_id, candidate_edu_degree, candidate_edu_institution, candidate_edu_major, candidate_edu_gpa, candidate_edu_city, 
		candidate_edu_start, candidate_edu_end, candidate_edu_notes, user_insert, date_insert, user_update, date_update */
		for($i=0;$i<5;$i++) {
			
			${"candidate_edu_institution_" . $i} = (isset($_POST["candidate_edu_institution_".$i]) AND $_POST["candidate_edu_institution_".$i] <> "") ? $_POST["candidate_edu_institution_".$i] : "";
			if(is_array(${"candidate_edu_institution_" . $i})) {
					${"candidate_edu_institution_" . $i}=$_POST["candidate_edu_institution_".$i][0];
			}
			
			${"candidate_edu_city_" . $i} = (isset($_POST["candidate_edu_city_".$i]) AND $_POST["candidate_edu_city_".$i] <> "") ? $_POST["candidate_edu_city_".$i] : "";
			if(is_array(${"candidate_edu_city_" . $i})) {
					${"candidate_edu_city_" . $i}=$_POST["candidate_edu_city_".$i][0];
			}

			${"candidate_edu_major_" . $i} = (isset($_POST["candidate_edu_major_".$i]) AND $_POST["candidate_edu_major_".$i] <> "") ? $_POST["candidate_edu_major_".$i] : "";
			if(is_array(${"candidate_edu_major_" . $i})) {
					${"candidate_edu_major_" . $i}=$_POST["candidate_edu_major_".$i][0];
			}

			
			${"candidate_edu_start_" . $i} = (isset($_POST["candidate_edu_start_".$i]) AND $_POST["candidate_edu_start_".$i] <> "") ? $_POST["candidate_edu_start_".$i] : "";
			${"candidate_edu_id_" . $i} = (isset($_POST["candidate_edu_id_".$i]) AND $_POST["candidate_edu_id_".$i] <> "") ? $_POST["candidate_edu_id_".$i] : "";
			${"candidate_edu_degree_" . $i} = (isset($_POST["candidate_edu_degree_".$i]) AND $_POST["candidate_edu_degree_".$i] <> "") ? $_POST["candidate_edu_degree_".$i] : "";
			${"candidate_edu_gpa_" . $i} = (isset($_POST["candidate_edu_gpa_".$i]) AND $_POST["candidate_edu_gpa_".$i] <> "") ? $_POST["candidate_edu_gpa_".$i] : "";
			${"candidate_edu_end_" . $i} = (isset($_POST["candidate_edu_end_".$i]) AND $_POST["candidate_edu_end_".$i] <> "") ? $_POST["candidate_edu_end_".$i] : "";
			${"candidate_edu_notes_" . $i} = (isset($_POST["candidate_edu_notes_".$i]) AND $_POST["candidate_edu_notes_".$i] <> "") ? $_POST["candidate_edu_notes_".$i] : "";
		}
		
		//exit;

		// Search candidate_edu_id in DB, insert to array id_found
			$query = querying("SELECT candidate_edu_id FROM m_candidate_edu WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_edu_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_edu_id"];
			}
			//print_r ($id_found); exit;
			
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_edu_id=0, or edit if candidate_edu_id <> 0, and insert the edited candidate_edu_id to array newID
			/* candidate_edu_id, candidate_id, candidate_edu_degree, candidate_edu_institution, candidate_edu_major, candidate_edu_gpa, candidate_edu_city, 
		candidate_edu_start, candidate_edu_end, candidate_edu_notes, user_insert, date_insert, user_update, date_update */
			
			for($i=0;$i<5;$i++)
			{
				${"candidate_edu_institution_" . $i} = sanitize_post(${"candidate_edu_institution_" . $i});
				${"candidate_edu_city_" . $i} = sanitize_post(${"candidate_edu_city_" . $i});
				${"candidate_edu_start_" . $i} = sanitize_post(${"candidate_edu_start_" . $i});
				${"candidate_edu_id_" . $i} = sanitize_post(${"candidate_edu_id_" . $i});
				${"candidate_edu_degree_" . $i} = sanitize_post(${"candidate_edu_degree_" . $i});
				${"candidate_edu_major_" . $i} = sanitize_post(${"candidate_edu_major_" . $i});
				${"candidate_edu_gpa_" . $i} = sanitize_post(${"candidate_edu_gpa_" . $i});
				${"candidate_edu_end_" . $i} = sanitize_post(${"candidate_edu_end_" . $i});
				${"candidate_edu_notes_" . $i} = sanitize_post(${"candidate_edu_notes_" . $i});
				
				if(${"candidate_edu_degree_" . $i} <> "")
				{
					if(${"candidate_edu_id_" . $i} > 0)			//update
					{
						if(querying("UPDATE m_candidate_edu SET candidate_edu_degree=?, candidate_edu_start=?, 
						candidate_edu_institution=?, candidate_edu_city=?, candidate_edu_major=?, candidate_edu_gpa=?, 
						candidate_edu_end=?, candidate_edu_notes=?, 
						user_update=?, date_update = now() WHERE candidate_edu_id = ?", 
						array(${"candidate_edu_degree_" . $i}, ${"candidate_edu_start_" . $i}, ${"candidate_edu_institution_" . $i}, 
						${"candidate_edu_city_" . $i}, ${"candidate_edu_major_" . $i},	${"candidate_edu_gpa_" . $i}, 
						${"candidate_edu_end_" . $i}, ${"candidate_edu_notes_" . $i},
						$_SESSION["log_auth_id"], ${"candidate_edu_id_" . $i})))
						{
							$sukses ++;
							$array_insert[] = ${"candidate_edu_id_" . $i};
						}
					}
					if(${"candidate_edu_id_" . $i} == 0)			//insert
					{
						if(querying("INSERT into m_candidate_edu(candidate_id, candidate_edu_degree, candidate_edu_start, 
						candidate_edu_institution, candidate_edu_city, candidate_edu_major, candidate_edu_gpa, candidate_edu_end, 
						candidate_edu_notes, user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], ${"candidate_edu_degree_" . $i}, ${"candidate_edu_start_" . $i}, 
						${"candidate_edu_institution_" . $i}, ${"candidate_edu_city_" . $i}, ${"candidate_edu_major_" . $i},	
						${"candidate_edu_gpa_" . $i}, ${"candidate_edu_end_" . $i}, ${"candidate_edu_notes_" . $i}, 
						$_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
						$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_edu WHERE candidate_edu_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=workingexp&mess=".coded("Education history has been updated.<br><i>Riwayat pendidikan telah berhasil diperbaharui.</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=education&gal=".coded("1")."&mess=".coded("Education history update failed.<br><i>Pembaharuan riwayat pendidikan gagal.</i>"));
				exit;
			}
			
	}


//part update Job Experiences
	function update_candidateJobexp() {

		//echo "masuk"; exit;
		
		/* candidate_jobexp_id, candidate_id, candidate_jobexp_company, candidate_jobexp_address, candidate_jobexp_phone, candidate_jobexp_lob, 
		candidate_jobexp_numemployee, candidate_jobexp_position, candidate_jobexp_start, candidate_jobexp_end, candidate_jobexp_desc, 
		candidate_jobexp_salary, candidate_jobexp_spvname, candidate_jobexp_spvposition, candidate_jobexp_subposition, candidate_jobexp_subnumber, 
		candidate_jobexp_leaving, user_insert, date_insert, user_update, date_update */
		for($i=0;$i<5;$i++) {
			
			${"candidate_jobexp_company_" . $i} = (isset($_POST["candidate_jobexp_company_".$i]) AND $_POST["candidate_jobexp_company_".$i] <> "") ? $_POST["candidate_jobexp_company_".$i] : "";
			${"candidate_jobexp_address_" . $i} = (isset($_POST["candidate_jobexp_address_".$i]) AND $_POST["candidate_jobexp_address_".$i] <> "") ? $_POST["candidate_jobexp_address_".$i] : "";			
			${"candidate_jobexp_start_" . $i} = (isset($_POST["candidate_jobexp_start_".$i]) AND $_POST["candidate_jobexp_start_".$i] <> "") ? $_POST["candidate_jobexp_start_".$i] : "";
			${"candidate_jobexp_id_" . $i} = (isset($_POST["candidate_jobexp_id_".$i]) AND $_POST["candidate_jobexp_id_".$i] <> "") ? $_POST["candidate_jobexp_id_".$i] : "";
			${"candidate_jobexp_phone_" . $i} = (isset($_POST["candidate_jobexp_phone_".$i]) AND $_POST["candidate_jobexp_phone_".$i] <> "") ? $_POST["candidate_jobexp_phone_".$i] : "";
			
			${"candidate_jobexp_lob_" . $i} = (isset($_POST["candidate_jobexp_lob_".$i]) AND $_POST["candidate_jobexp_lob_".$i] <> "") ? $_POST["candidate_jobexp_lob_".$i] : "";
			if(is_array(${"candidate_jobexp_lob_" . $i})) {
					${"candidate_jobexp_lob_" . $i}=$_POST["candidate_jobexp_lob_".$i][0];
			}

			${"candidate_jobexp_numemployee_" . $i} = (isset($_POST["candidate_jobexp_numemployee_".$i]) AND $_POST["candidate_jobexp_numemployee_".$i] <> "") ? $_POST["candidate_jobexp_numemployee_".$i] : "0";
			${"candidate_jobexp_end_" . $i} = (isset($_POST["candidate_jobexp_end_".$i]) AND $_POST["candidate_jobexp_end_".$i] <> "") ? $_POST["candidate_jobexp_end_".$i] : "";
			${"candidate_jobexp_position_" . $i} = (isset($_POST["candidate_jobexp_position_".$i]) AND $_POST["candidate_jobexp_position_".$i] <> "") ? $_POST["candidate_jobexp_position_".$i] : "";
			${"candidate_jobexp_desc_" . $i} = (isset($_POST["candidate_jobexp_desc_".$i]) AND $_POST["candidate_jobexp_desc_".$i] <> "") ? $_POST["candidate_jobexp_desc_".$i] : "";
			${"candidate_jobexp_salary_" . $i} = (isset($_POST["candidate_jobexp_salary_".$i]) AND $_POST["candidate_jobexp_salary_".$i] <> "") ? $_POST["candidate_jobexp_salary_".$i] : "0";			
			${"candidate_jobexp_spvname_" . $i} = (isset($_POST["candidate_jobexp_spvname_".$i]) AND $_POST["candidate_jobexp_spvname_".$i] <> "") ? $_POST["candidate_jobexp_spvname_".$i] : "";
			${"candidate_jobexp_spvposition_" . $i} = (isset($_POST["candidate_jobexp_spvposition_".$i]) AND $_POST["candidate_jobexp_spvposition_".$i] <> "") ? $_POST["candidate_jobexp_spvposition_".$i] : "";
			${"candidate_jobexp_subposition_" . $i} = (isset($_POST["candidate_jobexp_subposition_".$i]) AND $_POST["candidate_jobexp_subposition_".$i] <> "") ? $_POST["candidate_jobexp_subposition_".$i] : "";
			${"candidate_jobexp_subnumber_" . $i} = (isset($_POST["candidate_jobexp_subnumber_".$i]) AND $_POST["candidate_jobexp_subnumber_".$i] <> "") ? $_POST["candidate_jobexp_subnumber_".$i] : "0";
			${"candidate_jobexp_leaving_" . $i} = (isset($_POST["candidate_jobexp_leaving_".$i]) AND $_POST["candidate_jobexp_leaving_".$i] <> "") ? $_POST["candidate_jobexp_leaving_".$i] : "";



			}
		
		/*
		for($i=0;$i<5;$i++) {
			echo ${"candidate_jobexp_leaving_" . $i}."<br>";
		}
		exit;
		*/
		// Search candidate_jobexp_id in DB, insert to array id_found
			$query = querying("SELECT candidate_jobexp_id FROM m_candidate_jobexp WHERE candidate_id = ?", array($_SESSION["candidate_id"]));
			$id_found = array();

			/*
			while($p = mysql_fetch_object($q))
				$id_found[] = $p->candidate_jobexp_id;
			*/
			$data=sqlGetData($query);
			for($d=0;$d<count($data);$d++) {
				$id_found[] = $data[$d]["candidate_jobexp_id"];
			}
			//print_r ($id_found); exit;
			
			$sukses = 0;
			$array_insert = array();

			// Looping data, insert if candidate_jobexp_id=0, or edit if candidate_jobexp_id <> 0, and insert the edited candidate_jobexp_id to array newID
			/* candidate_jobexp_id, candidate_id, candidate_jobexp_company, candidate_jobexp_address, candidate_jobexp_phone, candidate_jobexp_lob, 
		candidate_jobexp_numemployee, candidate_jobexp_position, candidate_jobexp_start, candidate_jobexp_end, candidate_jobexp_desc, 
		candidate_jobexp_salary, candidate_jobexp_spvname, candidate_jobexp_spvposition, candidate_jobexp_subposition, candidate_jobexp_subnumber, 
		candidate_jobexp_leaving, user_insert, date_insert, user_update, date_update */
			
			for($i=0;$i<5;$i++)
			{
				${"candidate_jobexp_company_" . $i} = sanitize_post(${"candidate_jobexp_company_" . $i});
				${"candidate_jobexp_address_" . $i} = sanitize_post(${"candidate_jobexp_address_" . $i});
				${"candidate_jobexp_start_" . $i} = sanitize_post(${"candidate_jobexp_start_" . $i})."-01";
				${"candidate_jobexp_end_" . $i} = sanitize_post(${"candidate_jobexp_end_" . $i})."-01";
				${"candidate_jobexp_id_" . $i} = sanitize_post(${"candidate_jobexp_id_" . $i});
				${"candidate_jobexp_phone_" . $i} = sanitize_post(${"candidate_jobexp_phone_" . $i});
				${"candidate_jobexp_lob_" . $i} = sanitize_post(${"candidate_jobexp_lob_" . $i});
				${"candidate_jobexp_numemployee_" . $i} = sanitize_post(${"candidate_jobexp_numemployee_" . $i});
				${"candidate_jobexp_position_" . $i} = sanitize_post(${"candidate_jobexp_position_" . $i});
				${"candidate_jobexp_desc_" . $i} = sanitize_post(${"candidate_jobexp_desc_" . $i});
				${"candidate_jobexp_salary_" . $i} = sanitize_post(${"candidate_jobexp_salary_" . $i});
				${"candidate_jobexp_spvname_" . $i} = sanitize_post(${"candidate_jobexp_spvname_" . $i});
				${"candidate_jobexp_spvposition_" . $i} = sanitize_post(${"candidate_jobexp_spvposition_" . $i});
				${"candidate_jobexp_subposition_" . $i} = sanitize_post(${"candidate_jobexp_subposition_" . $i});
				${"candidate_jobexp_subnumber_" . $i} = sanitize_post(${"candidate_jobexp_subnumber_" . $i});
				${"candidate_jobexp_leaving_" . $i} = sanitize_post(${"candidate_jobexp_leaving_" . $i});
				
				if(${"candidate_jobexp_company_" . $i} <> "")
				{
					if(${"candidate_jobexp_id_" . $i} > 0)			//update
					{
						if(querying("UPDATE m_candidate_jobexp SET candidate_jobexp_phone=?, candidate_jobexp_start=?, 
						candidate_jobexp_company=?, candidate_jobexp_address=?, candidate_jobexp_lob=?, candidate_jobexp_numemployee=?, 
						candidate_jobexp_end=?, candidate_jobexp_position=?, candidate_jobexp_desc=?, candidate_jobexp_salary=?, 
						candidate_jobexp_spvname=?, candidate_jobexp_spvposition=?, candidate_jobexp_subposition=?, 
						candidate_jobexp_subnumber=?, candidate_jobexp_leaving=?, 
						user_update=?, date_update = now() WHERE candidate_jobexp_id = ?", 
						array(${"candidate_jobexp_phone_" . $i}, ${"candidate_jobexp_start_" . $i}, ${"candidate_jobexp_company_" . $i}, 
						${"candidate_jobexp_address_" . $i}, ${"candidate_jobexp_lob_" . $i},	${"candidate_jobexp_numemployee_" . $i}, 
						${"candidate_jobexp_end_" . $i}, ${"candidate_jobexp_position_" . $i}, ${"candidate_jobexp_desc_" . $i}, 
						${"candidate_jobexp_salary_" . $i}, ${"candidate_jobexp_spvname_" . $i}, ${"candidate_jobexp_spvposition_" . $i}, 
						${"candidate_jobexp_subposition_" . $i}, ${"candidate_jobexp_subnumber_" . $i}, ${"candidate_jobexp_leaving_" . $i},
						$_SESSION["log_auth_id"], ${"candidate_jobexp_id_" . $i})))
						{
							$sukses ++;
							$array_insert[] = ${"candidate_jobexp_id_" . $i};
						}
					}
					if(${"candidate_jobexp_id_" . $i} == 0)			//insert
					{
						if(querying("INSERT into m_candidate_jobexp(candidate_id, candidate_jobexp_phone, candidate_jobexp_start, 
						candidate_jobexp_company, candidate_jobexp_address, candidate_jobexp_lob, candidate_jobexp_numemployee, candidate_jobexp_end, 
						candidate_jobexp_position, candidate_jobexp_desc, candidate_jobexp_salary, candidate_jobexp_spvname, 
						candidate_jobexp_spvposition, candidate_jobexp_subposition, candidate_jobexp_subnumber, candidate_jobexp_leaving, 
						user_insert, date_insert, user_update, date_update) 
						values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?, now())", 
						array($_SESSION["candidate_id"], ${"candidate_jobexp_phone_" . $i}, ${"candidate_jobexp_start_" . $i}, 
						${"candidate_jobexp_company_" . $i}, ${"candidate_jobexp_address_" . $i}, ${"candidate_jobexp_lob_" . $i},	
						${"candidate_jobexp_numemployee_" . $i}, ${"candidate_jobexp_end_" . $i}, ${"candidate_jobexp_position_" . $i}, 
						${"candidate_jobexp_desc_" . $i}, ${"candidate_jobexp_salary_" . $i}, ${"candidate_jobexp_spvname_" . $i}, 
						${"candidate_jobexp_spvposition_" . $i}, ${"candidate_jobexp_subposition_" . $i}, ${"candidate_jobexp_subnumber_" . $i}, 
						${"candidate_jobexp_leaving_" . $i}, $_SESSION["log_auth_id"], $_SESSION["log_auth_id"])))
						$sukses ++;
					}
					
				}
			}
			//echo "<br>array_insert= ";print_r($array_insert);
			// Looping as much as id_found, check, if it is not in newID, delete the record
			for($i=0;$i<count($id_found);$i++)
			{
				//echo "<br>id_found= ".$id_found[$i];
				if(!in_array($id_found[$i],$array_insert))
				querying("DELETE from m_candidate_jobexp WHERE candidate_jobexp_id = ?", array($id_found[$i]));					
			}
			//exit;
			
			if($sukses > 0)
			{
				header("location: "._PATHURL."/index.php?mod=organization&mess=".coded("Working experience(s) has been updated.<br><i>Pengalaman Kerja telah berhasil diperbaharui.</i>"));
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=workingexp&gal=".coded("1")."&mess=".coded("Working experience(s) update failed.<br><i>Pembaharuan pengalaman kerja gagal dilakukan.</i>"));
				exit;
			}
			
	}


function update_candidateQuestion() {
	//echo "masuk";exit;
	//print_r($_POST);exit;
	
	$dataanswer=getDataAnswer();
	
	$question_id=$_POST["question_id"];
	$answer_yn=$_POST["answer"];
	$answer_desc=$_POST["answer_desc"];
	$answer_id=$_POST["answer_id"];
	$question_type=$_POST["question_type"];
	
	for($i=0;$i<count($question_id);$i++) {
		$answered_yn[$i]=(isset($answer_yn[$i]) && $answer_yn[$i]<>"")?$answer_yn[$i]:"";
		$answered_desc[$i]=(isset($answer_desc[$i]) && $answer_desc[$i]<>"")?$answer_desc[$i]:"";
	}
	
	$sukses=0;
	$gagal=0;

	for($i=0;$i<count($question_id);$i++) {
		if($answer_id[$i]>0) {
			
			if( ($question_type[$i]=="yn_desc" && $answered_yn[$i]<>"") || ($question_type[$i]=="txt_area" && $answer_desc[$i]<>"") || ($question_type[$i]=="txt_box_int" && $answer_desc[$i]<>"") || ($question_type[$i]=="txt_box_cur" && $answer_desc[$i]<>"") ) {
				$query=querying("UPDATE t_answer SET
				answer_yn=?, answer_desc=?, user_update=?, date_update=NOW() WHERE answer_id=?", array($answered_yn[$i],	sanitize_post($answered_desc[$i]), $_SESSION["log_auth_id"], $answer_id[$i]));
			}
		}
		else {
			if( ($question_type[$i]=="yn_desc" && $answered_yn[$i]<>"") || ($question_type[$i]=="txt_area" && $answer_desc[$i]<>"") || ($question_type[$i]=="txt_box_int" && $answer_desc[$i]<>"") || ($question_type[$i]=="txt_box_cur" && $answer_desc[$i]<>"") ) {
			
				$query=querying("INSERT INTO t_answer
				(candidate_id, question_id, answer_yn, answer_desc, answer_date, user_insert, date_insert, user_update, date_update)
				VALUES (?, ?, ?, ?, NOW(), ?, NOW(), ?, NOW())", array($_SESSION["candidate_id"], $question_id[$i],
				$answered_yn[$i],	sanitize_post($answered_desc[$i]), $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
			}
		}
				
		
		if($query) $sukses++;
		else {
			$gagal++;
		}
	}

	if($gagal > 0)
	{
		header("location: "._PATHURL."/index.php?mod=questionaire&gal=".coded("1")."&mess=".coded("There's ".$gagal." item failed to be updated.<br><i>Ada ".$gagal." jawaban yang tidak berhasil diperbaharui.</i>"));				
		exit;
	}
	else
	{
		header("location: "._PATHURL."/index.php?mod=questionaire&mess=".coded("Your answers has been updated.<br><i>Jawaban kuesioner Anda telah diperbaharui.</i>"));
		exit;
	}
	
}	

function candidate_forgotPwd() {
	$server = $_SERVER['SERVER_NAME'];
	$_POST = sanitize_post($_POST);

	if(_WITHCAPTCHA=="y") {
		include_once(_PATHDIRECTORY."/includes/recaptcha/recaptchalib.php");
		$privatekey = "6Lcrf8YSAAAAAH-uRUwTCScklNp_0ppd6dWD3WlN";
		$response = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if(isset($response->is_valid) && $response->is_valid != true) {			
			system_log_badattempt();
			header("location: "._PATHURL."/index.php?mod=forgotpwd&gal=".coded("1")."&mess=".coded("Security Code (captcha) is incorrect"));
			return false;
			exit;	
		}
	}
	
	$missteps=array();
	if (_WITHCAPTCHA=="y" && isset($response->is_valid) && $response->is_valid != true) $missteps[] = 45;
	if (!isset($_POST["email"]) or $_POST["email"] == "") 		$missteps[] = 1;
	if (isset($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))	$missteps[] = 34;
	

		if (count($missteps)>0)
		{
			for ($i=0;$i<count($missteps);$i++) {
				$notice[] = error_notice($missteps[$i]);
			}
			$notice = json_encode($notice);
			$_SESSION["session"] = $_POST;
			
			header("location: "._PATHURL."/index.php?mod=forgotpwd&gal=".coded("1")."&missteps=".coded($notice));
			exit;
		}
		else {
				//check apakah dia sudah ada di tabel log_auth(udah teraktivasi)
				$query = querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_passwd, a.register_id, a.register_date, a.register_activation_code,
				a.register_activation_date, b.candidate_name
				FROM log_auth a LEFT JOIN m_candidate b ON a.log_auth_id=b.log_auth_id WHERE a.log_auth_name=b.candidate_email AND a.log_auth_name=? ORDER BY a.log_auth_id DESC LIMIT 1",array($_POST["email"]));
				$data = sqlGetData($query);
				if(count($data)>0) {
					//echo "sudah mempunyai user pass"; //exit;
					//berikan link untuk reset password

					$variablemail = array();
					$variablemail["sender"] 	= 'rhnashil@gmail.com';
					$variablemail["from"] 		= "rhnashil@gmail.com";
					$variablemail["fromname"] 	= "Online Recruitment PT. Matahari Putra Prima";
					$variablemail["to"] 		= $_POST["email"];
					$variablemail["toName"]		= $data[0]["candidate_name"];
					// $variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
					$variablemail["subject"] 	= "[PT. Matahari Putra Prima] Reset Password";
					$variablemail["content"] 	= "
					<p>Dear ".$data[0]["candidate_name"].", We have received a request to reset your login account. Kindly click the below link to reset your password.<br><br>
					<a href="._PATHURL."/rstpwd.php?usr=".coded($_POST["email"])."&a=".coded($data[0]["register_activation_date"]).">
					RESET my Password</a><br><br>
					or you may copy and paste below link to your browser,<br><br>
					 "._PATHURL."/rstpwd.php?usr=".coded($_POST["email"])."&a=".coded($data[0]["register_activation_date"])."
					<br><br>In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
					<b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></p><hr>
					<p>Yth. ".$data[0]["candidate_name"].", Kami menerima email permintaan <i>reset</i> kata kunci untuk akun Anda. Silakan klik tautan berikut untuk mendapatkan kembali password Anda.<br><br>
					<a href="._PATHURL."/rstpwd.php?usr=".coded($_POST["email"])."&a=".coded($data[0]["register_activation_date"]).">
					Atur ulang Password</a><br><br>
					atau Anda dapat membuka tautan berikut ini langsung dari browser Anda,<br><br>
					 "._PATHURL."/rstpwd.php?usr=".coded($_POST["email"])."&a=".coded($data[0]["register_activation_date"])."
					<br><br>Jika email kami masuk ke folder SPAM/ Bulk/ Trash, mohon klik tombol \"Not Spam\" agar selanjutnya email kami dapat terkirim langsung ke inbox Anda.<br><br><br><br>
			<b>Hormat kami,<br><br/>Tim Rekrutmen Matahari Putra Prima</b></p>
					";
					
					// echo function_sending_email($variablemail);exit;
					if (function_sending_email($variablemail))
					{
						unset($variablemail);
						header("location: "._PATHURL."/index.php?mod=forgotpwd&mess=".coded("Please kindly check your email and find the reset link we had sent.<br><i>Silahkan periksa email Anda dan gunakan link yang kami kirimkan tersebut untuk mengatur ulang kata kunci Anda.</i>"));
						exit;	
					}
					else
					{
						header("location: "._PATHURL."/index.php?mod=forgotpwd&gal=".coded("1")."&mess=".coded("We find difficulties in sending your reset link. Please try again later.<br><i>Sistem tidak berhasil mengirimkan tautan untuk mengatur ulang kata kunci Anda.</i>"));
						exit;	
					}	

					
				}
			
				
				
				else {
					//belum ada di tabel registrasi	
					header("location: "._PATHURL."/index.php?mod=register&gal=".coded("1")."&mess=".coded("Your email has not been registered in our database. Please register your account using the form below.<br><i>Email Anda belum terdaftar dalam basis data kami. Silahkan daftarkan akun Anda melalui formulir berikut ini.</i>"));
					exit;
				}
		}
	
}


function candidate_resetPasswd() {
	//print_r($_POST);exit;
	$query=querying("SELECT log_auth_id, log_auth_passwd, register_id, log_auth_name FROM log_auth WHERE log_auth_name=? AND register_activation_date=?
					ORDER BY log_auth_id ASC LIMIT 1", array($_POST["log_auth_name"],$_POST["register_activation_date"]));
	$data=sqlGetData($query);
	

	//print_r($data);
	if(count($data)>0) {
		$newpass=sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["newpass2"]);

		//echo $newpass;exit;
	
		if($_POST["newpass"]==$_POST["newpass2"]) {			
			if(querying("UPDATE log_auth SET log_auth_passwd=? WHERE log_auth_id=?",array(sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["newpass2"]),$data[0]["log_auth_id"]))) {
				header("location: "._PATHURL."/index.php?mod=forgotpwd&mess=".coded("Your password had been updated."));
				exit;
			}
			else {
				header("location: "._PATHURL."/index.php?gal=".coded("1")."&mod=forgotpwd&mess=".coded("Update password failed.<br><i>Pembaharuan kata kunci gagal.</i>"));
				return false;
				exit;
			}
		}
		else {
				header("location: "._PATHURL."/index.php?gal=".coded("1")."&mod=forgotpwd&mess=".coded("Field retype password do not match.<br><i>Kolom tulis ulang kata kunci tidak cocok.</i>"));
				return false;
				exit;			
		}
	}
	else {
		header("location: "._PATHURL."/index.php?gal=".coded("1")."&mod=forgotpwd&mess=".coded("It seems that the given link is invalid, please try again later.<br><i>Tautan yang Anda gunakan salah.</i>"));
		return false;
		exit;			
		
	}
}


?>