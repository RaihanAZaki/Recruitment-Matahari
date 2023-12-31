<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	ini_set('memory_limit', '2048M');
	
	function export_DataEdu() {
		
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {		
			$query=querying("SELECT a.*
			FROM m_candidate_edu a LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
			LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 
			WHERE a.export_flag=? AND a.candidate_id=? AND c.status_id=? AND b.candidate_apply_status=? ORDER BY a.candidate_id, FIELD (candidate_edu_degree,'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD')", 
			array('0',$_REQUEST["candidate_id"],'open','join'));	
		}
		
		else {
		$query=querying("SELECT a.*
		FROM m_candidate_edu a LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 
		WHERE a.export_flag=? AND c.status_id=? AND b.candidate_apply_status=? ORDER BY a.candidate_id, FIELD (candidate_edu_degree,'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD')", 
		array('0','open','join'));	
		}
		
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataEduRev($candidate_id) {
			$query=querying("SELECT a.*
			FROM m_candidate_edu a LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
			LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 
			WHERE a.export_flag=? AND a.candidate_id=? AND c.status_id=? AND b.candidate_apply_status=? ORDER BY a.candidate_id, FIELD (candidate_edu_degree,'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD')", 
			array('0',$candidate_id,'open','join'));	
			
		$data=sqlGetData($query);
		return $data;
	}
	
	
	function export_DataFam() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT a.* FROM m_candidate_family a 
		LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 		
		WHERE a.export_flag=? AND a.candidate_id=? AND c.status_id=? AND b.candidate_apply_status=? ORDER BY a.candidate_id, candidate_family_birthdate", 
		array('0',$_REQUEST["candidate_id"],'open','join'));
		}
		else {
		$query=querying("SELECT a.* FROM m_candidate_family a 
		LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 		
		WHERE a.export_flag=? AND c.status_id=? AND b.candidate_apply_status=? 
		ORDER BY a.candidate_id, candidate_family_birthdate", array('0','open','join'));			
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataFamRev($candidate_id) {
		$query=querying("SELECT a.* FROM m_candidate_family a 
		LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 		
		WHERE a.export_flag=? AND a.candidate_id=? AND c.status_id=? AND b.candidate_apply_status=? ORDER BY a.candidate_id, candidate_family_birthdate", 
		array('0',$candidate_id,'open','join'));
		$data=sqlGetData($query);
		return $data;
	}
	
	
	
	function export_DataJob() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT a.* FROM m_candidate_jobexp a 
		LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 	
		WHERE a.export_flag=? AND a.candidate_id=? AND c.status_id=? AND b.candidate_apply_status=?
		ORDER BY a.candidate_id, candidate_jobexp_end", array('0',$_REQUEST["candidate_id"],'open','join'));
		}
		else {
		$query=querying("SELECT a.* FROM m_candidate_jobexp a 
		LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 	
		WHERE a.export_flag=? AND c.status_id=? AND b.candidate_apply_status=? 
		ORDER BY a.candidate_id, candidate_jobexp_end", array('0','open','join'));			
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataJobRev($candidate_id) {
		$query=querying("SELECT a.* FROM m_candidate_jobexp a 
		LEFT JOIN t_candidate_apply b ON a.candidate_id=b.candidate_id
		LEFT JOIN m_job_vacancy c ON b.job_vacancy_id=c.job_vacancy_id 		
		WHERE a.export_flag=? AND a.candidate_id=? AND c.status_id=? AND b.candidate_apply_status=? ORDER BY a.candidate_id, candidate_jobexp_end", 
		array('0',$candidate_id,'open','join'));
		$data=sqlGetData($query);
		return $data;
	}
	
	
	function export_DataOrg() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT * FROM m_candidate_organization WHERE export_flag=? AND candidate_id=?  ORDER BY candidate_id, candidate_organization_end", array('0',$_REQUEST["candidate_id"]));
		}
		else {
		$query=querying("SELECT * FROM m_candidate_organization WHERE export_flag=? ORDER BY candidate_id, candidate_organization_end", array('0'));			
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataLang() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT * FROM m_candidate_language WHERE export_flag=? AND candidate_id=? ORDER BY candidate_id, candidate_language_id", array('0',$_REQUEST["candidate_id"]));
		}
		else {
		$query=querying("SELECT * FROM m_candidate_language WHERE export_flag=? ORDER BY candidate_id, candidate_language_id", array('0'));
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataFile() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT * FROM m_candidate_file WHERE export_flag=? AND candidate_id=? ORDER BY candidate_id, candidate_file_id", array('0', $_REQUEST["candidate_id"]));
		}
		else {
		$query=querying("SELECT * FROM m_candidate_file WHERE export_flag=? ORDER BY candidate_id, candidate_file_id", array('0'));
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataFileOther() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT * FROM m_candidate_fileothers WHERE export_flag=? AND candidate_id=? ORDER BY candidate_id, candidate_file_id", array('0',$_REQUEST["candidate_id"]));
		}
		else {
		$query=querying("SELECT * FROM m_candidate_fileothers WHERE export_flag=? ORDER BY candidate_id, candidate_file_id", array('0'));
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataSkill() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT * FROM m_candidate_skill WHERE export_flag=? AND candidate_id=? ORDER BY candidate_id, candidate_skill_id", array('0',$_REQUEST["candidate_id"]));
		}
		else {
		$query=querying("SELECT * FROM m_candidate_skill WHERE export_flag=? ORDER BY candidate_id, candidate_skill_id", array('0'));
		}
		$data=sqlGetData($query);
		return $data;
	}
	
	function export_DataCandidate() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			a.OrgCode, a.JobTtlCode, a.LocationCode, a.ContractStart, a.ContractEnd,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, c.*
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? AND c.export_flag=? AND c.candidate_id=? GROUP BY a.candidate_id ORDER BY a.candidate_id ASC",
			array("open","0",$_REQUEST["candidate_id"]));	
		}
		else {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			a.OrgCode, a.JobTtlCode, a.LocationCode, a.ContractStart, a.ContractEnd,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, c.*
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? AND c.export_flag=? GROUP BY a.candidate_id ORDER BY a.candidate_id ASC",
			array("open","0"));				
		}
			
		$data=sqlGetData($query);
		return $data;

	}
	
	//tambahan shakti 2017_09_10
	function export_DataCandidateJoin() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			a.OrgCode, a.JobTtlCode, a.LocationCode, a.ContractStart, a.ContractEnd, a.candidate_homebase,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, b.job_vacancy_grade, c.*,
			d.log_auth_id, e.employee_nik
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			LEFT JOIN log_auth d ON b.log_auth_id=d.log_auth_id
			LEFT JOIN m_employee e ON d.employee_id=e.employee_id
			WHERE b.status_id=? AND c.export_flag=? AND c.candidate_id=? AND a.candidate_apply_status=? GROUP BY a.candidate_id ORDER BY a.candidate_id ASC",
			array("open","0",$_REQUEST["candidate_id"],"join"));	
		}
		else {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			a.OrgCode, a.JobTtlCode, a.LocationCode, a.ContractStart, a.ContractEnd, a.candidate_homebase, 
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, b.job_vacancy_grade, c.*,
			d.log_auth_id, e.employee_nik
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			LEFT JOIN log_auth d ON b.log_auth_id=d.log_auth_id
			LEFT JOIN m_employee e ON d.employee_id=e.employee_id
			WHERE b.status_id=? AND c.export_flag=? AND a.candidate_apply_status=? GROUP BY a.candidate_id ORDER BY a.candidate_id ASC",
			array("open","0","join"));				
		}
			
		$data=sqlGetData($query);
		return $data;

	}
	
	function getCityCode($CityName)
	{
		$query=querying("SELECT CityCode FROM City 
			WHERE CityName=? LIMIT 1",
			array($CityName));		
		
		if($data=sqlGetData($query))
		{
			$datanya=$data[0]["CityCode"];
		}
		else
		{
			$datanya="NULL";
		}
		
		return $datanya;
	}
	
	function getEduInstitution($candidate_edu_institution)
	{
		$query=querying("SELECT EduInsCode FROM EduInstitution 
			WHERE EduInsName=? LIMIT 1",
			array($candidate_edu_institution));		
			
		if($data=sqlGetData($query))
		{
			$datanya=$data[0]["EduInsCode"];
		}
		else{
			$datanya="NULL";
		}
		return $datanya;
	}
	
	function getEduMajor($candidate_edu_major)
	{
		$query=querying("SELECT EduMjrCode FROM EduMajor 
			WHERE EduMjrName=? LIMIT 1",
			array($candidate_edu_major));		
			
		if($data=sqlGetData($query))
		{
			$datanya=$data[0]["EduMjrCode"];
		}
		else{
			$datanya="NULL";
		}
		return $datanya;
	}
	
	//tambahan shakti 2017_09_13
	function getCandidateSex($candidate_id)
	{
		$query=querying("SELECT candidate_gender FROM m_candidate 
			WHERE candidate_id=? LIMIT 1",
			array($candidate_id));		
			
		if($data=sqlGetData($query))
		{
			$datanya=($data[0]["candidate_gender"]=="male")?"M":"F";
		}
		else{
			$datanya="NULL";
		}
		return $datanya;
	}
	
	function getCandidateDob($candidate_id)
	{
		$query=querying("SELECT candidate_birthdate FROM m_candidate 
			WHERE candidate_id=? LIMIT 1",
			array($candidate_id));		
			
		if($data=sqlGetData($query))
		{
			$datanya=$data[0]["candidate_birthdate"];
		}
		else{
			$datanya="NULL";
		}
		return $datanya;
	}

	function getRelationCode($candidate_family_relation)
	{
		$query=querying("SELECT FamRelCode FROM FamilyRelation 
			WHERE FamRelName=? LIMIT 1",
			array($candidate_family_relation));		
		
		if($data=sqlGetData($query))
		{
			$datanya=$data[0]["FamRelCode"];
		}
		else
		{
			$datanya="NULL";
		}
		
		return $datanya;
	}
	
	
	function export_DataSuccessfulCandidate() {
		if(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.job_vacancy_grade, b.job_vacancy_titlecode, b.job_vacancy_titlename, b.log_auth_id, 
			c.*
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? AND c.export_flag=? AND c.candidate_id=? GROUP BY a.candidate_id ORDER BY a.candidate_id ASC",
			array("open","0",$_REQUEST["candidate_id"]));	
		}
		else {
		$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.job_vacancy_grade, b.job_vacancy_titlecode, b.job_vacancy_titlename, b.log_auth_id, 
			c.*
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? AND c.export_flag=? GROUP BY a.candidate_id ORDER BY a.candidate_id ASC",
			array("open","0"));				
		}
			
		$data=sqlGetData($query);
		return $data;

	}
	
	

	/* UPDATE RAIHAN 2023 */
	function adm_exportExcel() {
		if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
			$datacandidate = export_DataCandidate();
			$dataedu = export_DataEdu();
			$datafam = export_DataFam();
			$datajobexp = export_DataJob();
			$dataorg = export_DataOrg();
			$datalang = export_DataLang();
			$datafile = export_DataFile();
			$datafileother = export_DataFileOther();
			$dataskill = export_DataSkill();
			// print_r($datacandidate);exit;


			require './vendor/autoload.php';
			$spreadsheet = new Spreadsheet([
				'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR
			]);

			$namafile=(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"")?"candidate_".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".xls":"candidate_".$_REQUEST["type"]."_".date("YmdHis").".xls";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$namafile.'"');
			header('Cache-Control: max-age=0');

			$spreadsheet->getProperties()
			->setCreator("MPPA Recruitment")
			->setLastModifiedBy("MPPA Recruitment")
			->setTitle("Titlenya")
			->setSubject("Subjectnya")
			->setDescription("Generate by system.")
			->setKeywords("proposed candidate")
			->setCategory("User Screening");

			$worksheet1 = $spreadsheet->getActiveSheet();
			$worksheet2 = $spreadsheet->createSheet();
			$worksheet3 = $spreadsheet->createSheet();
			$worksheet4 = $spreadsheet->createSheet();
			$worksheet5 = $spreadsheet->createSheet();
			$worksheet6 = $spreadsheet->createSheet();
			$worksheet7 = $spreadsheet->createSheet();
			$worksheet8 = $spreadsheet->createSheet();

			$worksheet1 
			->setCellValue('A1', 'CanId.')
			->setCellValue('B1', 'CanStatus')
			->setCellValue('C1', 'CanName')
			->setCellValue('D1', 'CanDateBirth')
			->setCellValue('E1', 'CanSex')
			->setCellValue('F1', 'CanIsFore')			
			->setCellValue('G1', 'CanMaritalStatus')
			->setCellValue('H1', 'CanCityBirth')			
			->setCellValue('I1', 'CanBloodType')			
			->setCellValue('J1', 'CanRace')			
			->setCellValue('K1', 'CanReligion')					
			->setCellValue('L1', 'CanResAddress')			
			->setCellValue('M1', 'CanResCity')			
			->setCellValue('N1', 'CanResZipCode')			
			->setCellValue('O1', 'CanResStatus')			
			->setCellValue('P1', 'CanResStart')			
			->setCellValue('Q1', 'CanResPhone')			
			->setCellValue('R1', 'CanOriAddress')			
			->setCellValue('S1', 'CanOriCity')			
			->setCellValue('T1', 'CanOriZipCode')			
			->setCellValue('U1', 'CanOriStatus')			
			->setCellValue('V1', 'CanOriStart')			
			->setCellValue('W1', 'CanOriPhone')			
			->setCellValue('X1', 'CanHandphone')			
			->setCellValue('Y1', 'CanEmail')			
			->setCellValue('Z1', 'CanCitizen.')
			->setCellValue('AA1', 'CanSource.')
			->setCellValue('AB1', 'CanSourceNote.')
			->setCellValue('AC1', 'CanFrontTitle.')
			->setCellValue('AD1', 'CanEndTitle.')
			->setCellValue('AE1', 'CanEntryDate.')
			->setCellValue('AF1', 'CanApplyDate.')
			->setCellValue('AG1', 'CanCurrency.')
			->setCellValue('AH1', 'CanExpSal.')
			->setCellValue('AI1', 'CanAdvNo.')
			->setCellValue('AJ1', 'UpdDate.')
			->setCellValue('AK1', 'CanOrg.')
			->setCellValue('AL1', 'UpdUser.')
			->setCellValue('AM1', 'UpdFlag.')
			->setCellValue('AN1', 'CanLocRecruit.')
			->setCellValue('AO1', 'CanLocRecruitCity.')
			->setCellValue('AP1', 'CanExpType.')
			->setCellValue('AQ1', 'CanAvailability.')			
			;
			/* Sheet Candidate */

			$rows=1;	
			for($i=0;$i<count($datacandidate);$i++) {
				$rows++;
				$worksheet1->setCellValue('A'.$rows, $datacandidate[$i]["candidate_id"]);	
				$worksheet1->getStyle('A'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('B'.$rows, $datacandidate[$i]["status_id"]);	
				$worksheet1->getStyle('B'.$rows)->getAlignment()->setWrapText(true);

				$worksheet1->setCellValue('C'.$rows, $datacandidate[$i]["candidate_name"]);	
				//$objPHPExcel->getStyle('C'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('D'.$rows, $datacandidate[$i]["candidate_birthdate"]);	
				$worksheet1->setCellValue('E'.$rows, $datacandidate[$i]["candidate_gender"]);	
				$worksheet1->setCellValue('F'.$rows, $datacandidate[$i]["candidate_nationality"]);	
				$worksheet1->setCellValue('G'.$rows, $datacandidate[$i]["candidate_marital"]);	
				$worksheet1->setCellValue('H'.$rows, $datacandidate[$i]["candidate_birthplace"]);	
				$worksheet1->getStyle('H'.$rows)->getAlignment()->setWrapText(true);

				$worksheet1->setCellValue('I'.$rows, $datacandidate[$i]["candidate_bloodtype"]);	
				$worksheet1->setCellValue('J'.$rows, $datacandidate[$i]["candidate_race"]);	
				$worksheet1->setCellValue('K'.$rows, $datacandidate[$i]["candidate_religion"]);	
				$worksheet1->getStyle('K'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('L'.$rows, $datacandidate[$i]["candidate_c_address"]);
				$worksheet1->getStyle('L'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('M'.$rows, $datacandidate[$i]["candidate_c_city"]);	
				$worksheet1->getStyle('M'.$rows)->getAlignment()->setWrapText(true);				
				
				$worksheet1->setCellValue('N'.$rows, $datacandidate[$i]["candidate_c_postcode"]);	
				$worksheet1->setCellValue('O'.$rows, "");	
				$worksheet1->setCellValue('P'.$rows, "");	
				$worksheet1->setCellValue('Q'.$rows, "");	
				$worksheet1->setCellValue('R'.$rows, $datacandidate[$i]["candidate_p_address"]);	
				$worksheet1->getStyle('R'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('S'.$rows, $datacandidate[$i]["candidate_p_city"]);	
				$worksheet1->getStyle('S'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('T'.$rows, $datacandidate[$i]["candidate_p_postcode"]);	
				$worksheet1->setCellValue('U'.$rows, "");	
				$worksheet1->setCellValue('V'.$rows, "");	
				$worksheet1->setCellValue('W'.$rows, "");	
				$worksheet1->setCellValue('X'.$rows, $datacandidate[$i]["candidate_hp1"]);	
				$worksheet1->setCellValue('Y'.$rows, $datacandidate[$i]["candidate_email"]);	
				$worksheet1->setCellValue('Z'.$rows, $datacandidate[$i]["candidate_country"]);	
				$worksheet1->getStyle('Z'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('AA'.$rows, "");	
				$worksheet1->setCellValue('AB'.$rows, "");	
				$worksheet1->setCellValue('AC'.$rows, "");	
				$worksheet1->setCellValue('AD'.$rows, "");	
				$worksheet1->setCellValue('AE'.$rows, $datacandidate[$i]["date_insert"]);	
				$worksheet1->setCellValue('AF'.$rows, "");	
				$worksheet1->setCellValue('AG'.$rows, "");	
				$worksheet1->setCellValue('AH'.$rows, $datacandidate[$i]["candidate_expected_salary"]);	
				$worksheet1->setCellValue('AI'.$rows, "");	
				$worksheet1->setCellValue('AJ'.$rows, $datacandidate[$i]["date_update"]);	
				$worksheet1->setCellValue('AK'.$rows, "");	
				$worksheet1->setCellValue('AL'.$rows, $datacandidate[$i]["user_update"]);	
				$worksheet1->setCellValue('AM'.$rows, "");	
				$worksheet1->setCellValue('AN'.$rows, "");	
				$worksheet1->setCellValue('AO'.$rows, "");	
				$worksheet1->setCellValue('AP'.$rows, "");	
				$worksheet1->setCellValue('AQ'.$rows, "");	
				//tambahan untuk input ke tabel t_sync_proint 29 April 2016
				querying("INSERT INTO t_sync_proint (candidate_id, t_sync_status, date_insert, user_insert, date_update, user_update)
				VALUES (?, 0, NOW(), ?, NOW(), ?)",array($datacandidate[$i]["candidate_id"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
				
				querying("UPDATE m_candidate SET export_flag=? WHERE candidate_id=?", array('1',$datacandidate[$i]["candidate_id"]));
			}

			for ($col = 'A'; $col !== 'AS'; $col++) {
				$worksheet1->getColumnDimension($col)->setAutoSize(true);
			}
			
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
					)
				)
			);
			
			$worksheet1->getStyle(
				'A1:' .
				$worksheet1->getHighestColumn() .
				$worksheet1->getHighestRow()
			)->applyFromArray($styleArray);

			// Rename worksheet
			$worksheet1->setTitle('Candidate');
			

			/* SHEET EDUCATION */
			$worksheet2
			->setCellValue('A1', 'CanId.')
			->setCellValue('B1', 'EduStatus')
			->setCellValue('C1', 'CanEduSeq')
			->setCellValue('D1', 'EduLevel')
			->setCellValue('E1', 'EduMajor')
			->setCellValue('F1', 'EduCity')			
			->setCellValue('G1', 'EduInstitution')
			->setCellValue('H1', 'EduGraduate')			
			->setCellValue('I1', 'EduName')			
			->setCellValue('J1', 'EduGrade')			
			->setCellValue('K1', 'EduResult')			
			->setCellValue('L1', 'EduFrontTitle')			
			->setCellValue('M1', 'EduEndTitle')			
			->setCellValue('N1', 'FgLastEdu')			
			->setCellValue('O1', 'UpdDate')			
			->setCellValue('P1', 'UpdUser')			
			->setCellValue('Q1', 'UpdFlag')			
			;

			$rows=1;	
			for($i=0;$i<count($dataedu);$i++) {
				$rows++;
				$worksheet2->setCellValue('A'.$rows, $dataedu[$i]["candidate_id"]);	
				
				$worksheet2->setCellValue('B'.$rows, "");	

				$worksheet2->setCellValue('C'.$rows, "");	
				
				$worksheet2->setCellValue('D'.$rows, $dataedu[$i]["candidate_edu_degree"]);	
				$worksheet2->setCellValue('E'.$rows, $dataedu[$i]["candidate_edu_major"]);	
				$worksheet2->setCellValue('F'.$rows, $dataedu[$i]["candidate_edu_city"]);	
				
				$worksheet2->setCellValue('G'.$rows, $dataedu[$i]["candidate_edu_institution"]);	
				$worksheet2->getStyle('G'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet2->setCellValue('H'.$rows, $dataedu[$i]["candidate_edu_end"]);	
				
				$worksheet2->setCellValue('I'.$rows, $dataedu[$i]["candidate_edu_notes"]);	
				$worksheet2->getStyle('I'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet2->setCellValue('J'.$rows, $dataedu[$i]["candidate_edu_gpa"]);	
				$worksheet2->setCellValue('K'.$rows, "");	
				$worksheet2->setCellValue('L'.$rows, "");	
				$worksheet2->setCellValue('M'.$rows, "");	
				$worksheet2->setCellValue('N'.$rows, "");	
				$worksheet2->setCellValue('O'.$rows, $dataedu[$i]["date_update"]);	
				$worksheet2->setCellValue('P'.$rows, $dataedu[$i]["user_update"]);	
				$worksheet2->setCellValue('Q'.$rows, "");	
				
				querying("UPDATE m_candidate_edu SET export_flag=? WHERE candidate_edu_id=?", array('1',$dataedu[$i]["candidate_edu_id"]));

			}
			foreach(range('A','Q') as $columnID) {
				$worksheet2->getColumnDimension($columnID)
					->setAutoSize(true);
			}

			$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						)
					)
				);

			$worksheet2->getStyle(
				'A1:' . 
				$worksheet2->getHighestColumn() . 
				$worksheet2->getHighestRow()
			)->applyFromArray($styleArray);	  
				
			// Rename worksheet
			$worksheet2->setTitle('CanEdu');


			/* Sheet CanFamily */
				$worksheet3
				->setCellValue('A1', 'CanId.')
				->setCellValue('B1', 'FamRelation')
				->setCellValue('C1', 'FamName')
				->setCellValue('D1', 'FamDateBirth')
				->setCellValue('E1', 'FamSex')
				->setCellValue('F1', 'FamAddress')			
				->setCellValue('G1', 'FamPhone')
				->setCellValue('H1', 'FamOccupation')			
				->setCellValue('I1', 'FamAlive')			
				->setCellValue('J1', 'UpdDate')			
				->setCellValue('K1', 'UpdUser')			
				->setCellValue('L1', 'UpdFlag')			
				->setCellValue('M1', 'FamCityBirth')			
				->setCellValue('N1', 'FamMaritalSt')			
				->setCellValue('O1', 'FamMaritalDate')			
				->setCellValue('P1', 'FamEmploymentSt')			
				->setCellValue('Q1', 'FamComp')			
				->setCellValue('R1', 'FamCompAddr')			
				->setCellValue('S1', 'FamEdu')			
				->setCellValue('T1', 'FamEduIns')			
				->setCellValue('U1', 'FamFgSchool')			
				->setCellValue('V1', 'FamIdCard')			
				->setCellValue('W1', 'FamResAddr')			
				->setCellValue('X1', 'FamHp')			
				;

				$rows=1;	
				for($i=0;$i<count($datafam);$i++) {
					$rows++;
					$worksheet3->setCellValue('A'.$rows, $datafam[$i]["candidate_id"]);	
					$worksheet3->setCellValue('B'.$rows, $datafam[$i]["candidate_family_relation"]);	
					$worksheet3->setCellValue('C'.$rows, $datafam[$i]["candidate_family_name"]);	
					$worksheet3->setCellValue('D'.$rows, $datafam[$i]["candidate_family_birthdate"]);	
					$worksheet3->setCellValue('E'.$rows, "");	
					$worksheet3->setCellValue('F'.$rows, "");	
					$worksheet3->setCellValue('G'.$rows, "");	
					$worksheet3->setCellValue('H'.$rows, $datafam[$i]["candidate_family_lastjob"]);	
					$worksheet3->setCellValue('I'.$rows, $datafam[$i]["candidate_family_rip"]);	
					$worksheet3->setCellValue('J'.$rows, $datafam[$i]["date_update"]);	
					$worksheet3->setCellValue('K'.$rows, $datafam[$i]["user_update"]);	
					$worksheet3->setCellValue('L'.$rows, "");	
					$worksheet3->setCellValue('M'.$rows, $datafam[$i]["candidate_family_birthplace"]);	
					$worksheet3->setCellValue('N'.$rows, "");	
					$worksheet3->setCellValue('O'.$rows, "");	
					$worksheet3->setCellValue('P'.$rows, "");	
					$worksheet3->setCellValue('Q'.$rows, $datafam[$i]["candidate_family_company"]);	
					$worksheet3->setCellValue('R'.$rows, "");	
					$worksheet3->setCellValue('S'.$rows, $datafam[$i]["candidate_family_lastedu"]);	
					$worksheet3->setCellValue('T'.$rows, "");	
					$worksheet3->setCellValue('U'.$rows, "");	
					$worksheet3->setCellValue('V'.$rows, "");	
					$worksheet3->setCellValue('W'.$rows, "");	
					$worksheet3->setCellValue('X'.$rows, "");	
					
					querying("UPDATE m_candidate_family SET export_flag=? WHERE candidate_family_id=?", array('1',$datafam[$i]["candidate_family_id"]));
					
				}
				foreach(range('A','X') as $columnID) {
					$worksheet3->getColumnDimension($columnID)
						->setAutoSize(true);
				}			
	
				$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
							)
						)
					);

				$worksheet3->getStyle(
					'A1:' . 
					$worksheet3->getHighestColumn() . 
					$worksheet3->getHighestRow()
				)->applyFromArray($styleArray);	  					
				// Rename worksheet
				$worksheet3->setTitle('CanFamily');
	
	
				/* Sheet CanExperience */
				$worksheet4
				->setCellValue('A1', 'CanId.')
				->setCellValue('B1', 'Sequence')
				->setCellValue('C1', 'CompanyName')
				->setCellValue('D1', 'CompanyAddress')
				->setCellValue('E1', 'CompanyCity')
				->setCellValue('F1', 'CompanyZipCode')			
				->setCellValue('G1', 'CompanyPhone')
				->setCellValue('H1', 'JobStart')			
				->setCellValue('I1', 'JobEnd')			
				->setCellValue('J1', 'JobTitle')			
				->setCellValue('K1', 'SalaryStart')			
				->setCellValue('L1', 'SalaryEnd')			
				->setCellValue('M1', 'TerminationReason')			
				->setCellValue('N1', 'UpdDate')			
				->setCellValue('O1', 'UpdUser')			
				->setCellValue('P1', 'UpdFlag')			
				->setCellValue('Q1', 'Description')			
				->setCellValue('R1', 'FgCase')			
				->setCellValue('S1', 'Performance')			
				->setCellValue('T1', 'SprName')			
				->setCellValue('U1', 'SprPhone')			
				;

				$rows=1;	
				for($i=0;$i<count($datajobexp);$i++) {
					$rows++;
					$worksheet4->setCellValue('A'.$rows, $datajobexp[$i]["candidate_id"]);	
					$worksheet4->setCellValue('B'.$rows, "");	
					$worksheet4->setCellValue('C'.$rows, $datajobexp[$i]["candidate_jobexp_company"]);	
					$worksheet4->setCellValue('D'.$rows, $datajobexp[$i]["candidate_jobexp_address"]);
					$worksheet4->getStyle('D'.$rows)->getAlignment()->setWrapText(true);				
					
					$worksheet4->setCellValue('E'.$rows, "");	
					$worksheet4->setCellValue('F'.$rows, "");	
					$worksheet4->setCellValue('G'.$rows, $datajobexp[$i]["candidate_jobexp_phone"]);	
					$worksheet4->setCellValue('H'.$rows, $datajobexp[$i]["candidate_jobexp_start"]);	
					$worksheet4->setCellValue('I'.$rows, $datajobexp[$i]["candidate_jobexp_end"]);	
					$worksheet4->setCellValue('J'.$rows, $datajobexp[$i]["candidate_jobexp_spvposition"]);	
					$worksheet4->setCellValue('K'.$rows, "");	
					$worksheet4->setCellValue('L'.$rows, $datajobexp[$i]["candidate_jobexp_salary"]);	
					$worksheet4->setCellValue('M'.$rows, $datajobexp[$i]["candidate_jobexp_leaving"]);	
					$worksheet4->getStyle('M'.$rows)->getAlignment()->setWrapText(true);				
					
					$worksheet4->setCellValue('N'.$rows, $datajobexp[$i]["date_update"]);	
					$worksheet4->setCellValue('O'.$rows, $datajobexp[$i]["user_update"]);	
					$worksheet4->setCellValue('P'.$rows, "");	
					
					$worksheet4->setCellValue('Q'.$rows, $datajobexp[$i]["candidate_jobexp_desc"]);	
					$worksheet4->getStyle('Q'.$rows)->getAlignment()->setWrapText(true);				

					$worksheet4->setCellValue('R'.$rows, "");	
					$worksheet4->setCellValue('S'.$rows, "");	
					$worksheet4->setCellValue('T'.$rows, $datajobexp[$i]["candidate_jobexp_spvname"]);	
					$worksheet4->setCellValue('U'.$rows, "");	
					
					querying("UPDATE m_candidate_jobexp SET export_flag=? WHERE candidate_jobexp_id=?", array('1',$datajobexp[$i]["candidate_jobexp_id"]));
				}
				foreach(range('A','U') as $columnID) {
					$worksheet4->getColumnDimension($columnID)
						->setAutoSize(true);
				}			
	
				$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
							)
						)
					);

				$worksheet4->getStyle(
					'A1:' . 
					$worksheet4->getHighestColumn() . 
					$worksheet4->getHighestRow()
				)->applyFromArray($styleArray);	  					
				// Rename worksheet
				$worksheet4->setTitle('CanExperience');			
	
	
	
				/* Sheet CanExOrganization */
				$worksheet5
				->setCellValue('A1', 'CanId.')
				->setCellValue('B1', 'OrgName')
				->setCellValue('C1', 'CanPosition')
				->setCellValue('D1', 'CanOrgStart')
				->setCellValue('E1', 'CanOrgEnd')
				->setCellValue('F1', 'UpdDate')			
				->setCellValue('G1', 'UpdUser')
				->setCellValue('H1', 'UpdFlag')			
				;

				$rows=1;	
				for($i=0;$i<count($dataorg);$i++) {
					$rows++;
					$worksheet5->setCellValue('A'.$rows, $dataorg[$i]["candidate_id"]);	
					$worksheet5->setCellValue('B'.$rows, $dataorg[$i]["candidate_organization_name"]);	
					$worksheet5->setCellValue('C'.$rows, $dataorg[$i]["candidate_organization_role"]);	
					$worksheet5->setCellValue('D'.$rows, $dataorg[$i]["candidate_organization_start"]);	
					$worksheet5->setCellValue('E'.$rows, $dataorg[$i]["candidate_organization_end"]);	
					$worksheet5->setCellValue('F'.$rows, $dataorg[$i]["date_update"]);	
					$worksheet5->setCellValue('G'.$rows, $dataorg[$i]["user_update"]);					
					$worksheet5->setCellValue('H'.$rows, "");	
					
					querying("UPDATE m_candidate_organization SET export_flag=? WHERE candidate_organization_id=?", array('1',$dataorg[$i]["candidate_organization_id"]));
				}
				foreach(range('A','H') as $columnID) {
					$worksheet5->getColumnDimension($columnID)
						->setAutoSize(true);
				}

				$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
							)
						)
					);

				$worksheet5->getStyle(
					'A1:' . 
					$worksheet5->getHighestColumn() . 
					$worksheet5->getHighestRow()
				)->applyFromArray($styleArray);	  
					
				// Rename worksheet
				$worksheet5->setTitle('CanExOrganization');
				
	
				/* Sheet CanLang */
				$worksheet6
				->setCellValue('A1', 'CanId.')
				->setCellValue('B1', 'CanLangCode')
				->setCellValue('C1', 'CanLangRead')
				->setCellValue('D1', 'CanLangWrite')
				->setCellValue('E1', 'CanLangSpeak')
				->setCellValue('F1', 'UpdDate')			
				->setCellValue('G1', 'UpdUser')
				->setCellValue('H1', 'UpdFlag')			
				;

				$rows=1;	
				for($i=0;$i<count($datalang);$i++) {
					$rows++;
					$worksheet6->setCellValue('A'.$rows, $datalang[$i]["candidate_id"]);	
					$worksheet6->setCellValue('B'.$rows, $datalang[$i]["candidate_language_name"]);	
					$worksheet6->setCellValue('C'.$rows, $datalang[$i]["candidate_language_read"]);	
					$worksheet6->setCellValue('D'.$rows, $datalang[$i]["candidate_language_write"]);	
					$worksheet6->setCellValue('E'.$rows, $datalang[$i]["candidate_language_conversation"]);	
					$worksheet6->setCellValue('F'.$rows, $datalang[$i]["date_update"]);	
					$worksheet6->setCellValue('G'.$rows, $datalang[$i]["user_update"]);					
					$worksheet6->setCellValue('H'.$rows, "");
					
					querying("UPDATE m_candidate_language SET export_flag=? WHERE candidate_language_id=?", array('1',$datalang[$i]["candidate_language_id"]));
				}
				foreach(range('A','H') as $columnID) {
					$worksheet6->getColumnDimension($columnID)
						->setAutoSize(true);
				}

				$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
							)
						)
					);

				$worksheet6->getStyle(
					'A1:' . 
					$worksheet6->getHighestColumn() . 
					$worksheet6->getHighestRow()
				)->applyFromArray($styleArray);	  
						
				// Rename worksheet
				$worksheet6->setTitle('CanLang');
				

				/* Sheet CanDocument */
				$worksheet7
				->setCellValue('A1', 'CanId.')
				->setCellValue('B1', 'CanDocSeq')
				->setCellValue('C1', 'CanDocDesc')
				->setCellValue('D1', 'CanDocFile')
				->setCellValue('E1', 'UpdDate')
				->setCellValue('F1', 'UpdUser')			
				->setCellValue('G1', 'UpdFlag')
				->setCellValue('H1', 'CanDoc')			
				;

				$rows=1;	
				for($i=0;$i<count($datafile);$i++) {
					$rows++;
					$worksheet7->setCellValue('A'.$rows, $datafile[$i]["candidate_id"]);	
					$worksheet7->setCellValue('B'.$rows, "");	
					$worksheet7->setCellValue('C'.$rows, $datafile[$i]["candidate_file_notes"]);	
					$worksheet7->setCellValue('D'.$rows, $datafile[$i]["candidate_file_name"]);	
					$worksheet7->setCellValue('E'.$rows, $datafile[$i]["date_update"]);	
					$worksheet7->setCellValue('F'.$rows, $datafile[$i]["user_update"]);	
					$worksheet7->setCellValue('G'.$rows, "");					
					$worksheet7->setCellValue('H'.$rows, $datafile[$i]["candidate_file_type"]);		

					querying("UPDATE m_candidate_file SET export_flag=? WHERE candidate_file_id=?", array('1',$datafile[$i]["candidate_file_id"]));
					
				}

				for($i=0;$i<count($datafileother);$i++) {
					$rows++;
					$worksheet7->setCellValue('A'.$rows, $datafileother[$i]["candidate_id"]);	
					$worksheet7->setCellValue('B'.$rows, "");	
					$worksheet7->setCellValue('C'.$rows, $datafileother[$i]["candidate_file_notes"]);	
					$worksheet7->setCellValue('D'.$rows, $datafileother[$i]["candidate_file_name"]);	
					$worksheet7->setCellValue('E'.$rows, $datafileother[$i]["date_update"]);	
					$worksheet7->setCellValue('F'.$rows, $datafileother[$i]["user_update"]);	
					$worksheet7->setCellValue('G'.$rows, "");					
					$worksheet7->setCellValue('H'.$rows, "others");		

					querying("UPDATE m_candidate_fileothers SET export_flag=? WHERE candidate_file_id=?", array('1',$datafileother[$i]["candidate_file_id"]));
					
				}
	
	
				foreach(range('A','H') as $columnID) {
					$worksheet7->getColumnDimension($columnID)
						->setAutoSize(true);
				}

				$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
							)
						)
					);

				$worksheet7->getStyle(
					'A1:' . 
					$worksheet7->getHighestColumn() . 
					$worksheet7->getHighestRow()
				)->applyFromArray($styleArray);	  
				
				// Rename worksheet
				$worksheet7->setTitle('CanDocument');


		/* Sheet CanSkill */
				$worksheet8
				->setCellValue('A1', 'CanId')
				->setCellValue('B1', 'CanSkillCode')
				->setCellValue('C1', 'CanSkillGrade')
				->setCellValue('D1', 'UpdDate')
				->setCellValue('E1', 'UpdUser')
				->setCellValue('F1', 'UpdFlag')			
				;

				$rows=1;	
				for($i=0;$i<count($dataskill);$i++) {
					$rows++;
					$worksheet8->setCellValue('A'.$rows, $dataskill[$i]["candidate_id"]);	
					$worksheet8->setCellValue('B'.$rows, $dataskill[$i]["candidate_skill_name"]);	
					$worksheet8->setCellValue('C'.$rows, $dataskill[$i]["candidate_skill_level"]);	
					$worksheet8->setCellValue('D'.$rows, $dataskill[$i]["date_update"]);	
					$worksheet8->setCellValue('E'.$rows, $dataskill[$i]["user_update"]);	
					$worksheet8->setCellValue('F'.$rows, "");	
					
					querying("UPDATE m_candidate_skill SET export_flag=? WHERE candidate_skill_id=?", array('1',$dataskill[$i]["candidate_skill_id"]));
				}
				
				foreach(range('A','F') as $columnID) {
					$worksheet8->getColumnDimension($columnID)
						->setAutoSize(true);
				}

				$styleArray = array(
						'borders' => array(
							'allborders' => array(
								'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
							)
						)
					);

				$worksheet8->getStyle(
					'A1:' . 
					$worksheet8->getHighestColumn() . 
					$worksheet8->getHighestRow()
				)->applyFromArray($styleArray);	  
				
				// Rename worksheet
				$worksheet8->setTitle('CanSkill');

		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->save($namafile);

		// Mengirimkan file Excel sebagai unduhan
		ob_end_clean();
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="' . $namafile . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
		exit;
	}
}
	

// 	function adm_exportExcel() {
// 		//echo "module download";
// 		if(isset($_REQUEST["type"]) && $_REQUEST["type"]<>"") {

// 			$datacandidate=export_DataCandidate();
// 			$dataedu=export_DataEdu();
// 			$datafam=export_DataFam();
// 			$datajobexp=export_DataJob();
// 			$dataorg=export_DataOrg();
// 			$datalang=export_DataLang();
// 			$datafile=export_DataFile();
// 			$datafileother=export_DataFileOther();
// 			$dataskill=export_DataSkill();
// 			// print_r($datacandidate);exit;
// 			/** Include PHPExcel */
// 			// require_once(_INCLUDEDIRECTORY."/excel/PHPExcel.php");	
// 			// require_once(_INCLUDEDIRECTORY."/excel/PHPExcel.php");	
// 			require './vendor/autoload.php';
// 			// Create new PHPExcel object
// 			// $objPHPExcel = new PHPExcel();
// 			$objPHPExcel = new Spreadsheet();
			
// 			$namafile=(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"")?"candidate_".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".xls":"candidate_".$_REQUEST["type"]."_".date("YmdHis").".xls";
// 			header('Content-Type: application/vnd.ms-excel');
// 			header('Content-Disposition: attachment;filename="'.$namafile.'"');
// 			header('Cache-Control: max-age=0');

			
// 			$objPHPExcel->getProperties()->setCreator("MPPA Recruitment")
// 										 ->setLastModifiedBy("MPPA Recruitment")
// 										 ->setTitle("Titlenya")
// 										 ->setSubject("Subjectnya")
// 										 ->setDescription("Generate by system.")
// 										 ->setKeywords("proposed candidate")
// 										 ->setCategory("User Screening");


// 			$objPHPExcel->createSheet(0);
// 			$objPHPExcel->createSheet(1);
// 			$objPHPExcel->createSheet(2);
// 			$objPHPExcel->createSheet(3);
// 			$objPHPExcel->createSheet(4);
// 			$objPHPExcel->createSheet(5);
// 			$objPHPExcel->createSheet(6);
// 			/* Sheet Candidate */
// 			$objPHPExcel->setActiveSheetIndex(0)
// 						->setCellValue('A1', 'CanId.')
// 						->setCellValue('B1', 'CanStatus')
// 						->setCellValue('C1', 'CanName')
// 						->setCellValue('D1', 'CanDateBirth')
// 						->setCellValue('E1', 'CanSex')
// 						->setCellValue('F1', 'CanIsFore')			
// 						->setCellValue('G1', 'CanMaritalStatus')
// 						->setCellValue('H1', 'CanCityBirth')			
// 						->setCellValue('I1', 'CanBloodType')			
// 						->setCellValue('J1', 'CanRace')			
// 						->setCellValue('K1', 'CanReligion')			
// 						->setCellValue('L1', 'CanHeight')			
// 						->setCellValue('M1', 'CanWeight')			
// 						->setCellValue('N1', 'CanResAddress')			
// 						->setCellValue('O1', 'CanResCity')			
// 						->setCellValue('P1', 'CanResZipCode')			
// 						->setCellValue('Q1', 'CanResStatus')			
// 						->setCellValue('R1', 'CanResStart')			
// 						->setCellValue('S1', 'CanResPhone')			
// 						->setCellValue('T1', 'CanOriAddress')			
// 						->setCellValue('U1', 'CanOriCity')			
// 						->setCellValue('V1', 'CanOriZipCode')			
// 						->setCellValue('W1', 'CanOriStatus')			
// 						->setCellValue('X1', 'CanOriStart')			
// 						->setCellValue('Y1', 'CanOriPhone')			
// 						->setCellValue('Z1', 'CanHandphone')			
// 						->setCellValue('AA1', 'CanEmail')			
// 						->setCellValue('AB1', 'CanCitizen.')
// 						->setCellValue('AC1', 'CanSource.')
// 						->setCellValue('AD1', 'CanSourceNote.')
// 						->setCellValue('AE1', 'CanFrontTitle.')
// 						->setCellValue('AF1', 'CanEndTitle.')
// 						->setCellValue('AG1', 'CanEntryDate.')
// 						->setCellValue('AH1', 'CanApplyDate.')
// 						->setCellValue('AI1', 'CanCurrency.')
// 						->setCellValue('AJ1', 'CanExpSal.')
// 						->setCellValue('AK1', 'CanAdvNo.')
// 						->setCellValue('AL1', 'UpdDate.')
// 						->setCellValue('AM1', 'CanOrg.')
// 						->setCellValue('AN1', 'UpdUser.')
// 						->setCellValue('AO1', 'UpdFlag.')
// 						->setCellValue('AP1', 'CanLocRecruit.')
// 						->setCellValue('AQ1', 'CanLocRecruitCity.')
// 						->setCellValue('AR1', 'CanExpType.')
// 						->setCellValue('AS1', 'CanAvailability.')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($datacandidate);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $datacandidate[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('A'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, $datacandidate[$i]["status_id"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('B'.$rows)->getAlignment()->setWrapText(true);

// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datacandidate[$i]["candidate_name"]);	
// 				//$objPHPExcel->getActiveSheet()->getStyle('C'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datacandidate[$i]["candidate_birthdate"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $datacandidate[$i]["candidate_gender"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $datacandidate[$i]["candidate_nationality"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, $datacandidate[$i]["candidate_marital"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, $datacandidate[$i]["candidate_birthplace"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('H'.$rows)->getAlignment()->setWrapText(true);

// 				$objPHPExcel->getActiveSheet()->setCellValue('I'.$rows, $datacandidate[$i]["candidate_bloodtype"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('J'.$rows, $datacandidate[$i]["candidate_race"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('K'.$rows, $datacandidate[$i]["candidate_religion"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('K'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('L'.$rows, $datacandidate[$i]["candidate_bodyheight"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('M'.$rows, $datacandidate[$i]["candidate_bodyweight"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('N'.$rows, $datacandidate[$i]["candidate_c_address"]);
// 				$objPHPExcel->getActiveSheet()->getStyle('N'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('O'.$rows, $datacandidate[$i]["candidate_c_city"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('O'.$rows)->getAlignment()->setWrapText(true);				
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('P'.$rows, $datacandidate[$i]["candidate_c_postcode"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('R'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('S'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('T'.$rows, $datacandidate[$i]["candidate_p_address"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('T'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('U'.$rows, $datacandidate[$i]["candidate_p_city"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('U'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('V'.$rows, $datacandidate[$i]["candidate_p_postcode"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('W'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('X'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('Y'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$rows, $datacandidate[$i]["candidate_hp1"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AA'.$rows, $datacandidate[$i]["candidate_email"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AB'.$rows, $datacandidate[$i]["candidate_country"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('AB'.$rows)->getAlignment()->setWrapText(true);
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('AC'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AD'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AE'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AF'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AG'.$rows, $datacandidate[$i]["date_insert"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AH'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AI'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$rows, $datacandidate[$i]["candidate_expected_salary"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AK'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AL'.$rows, $datacandidate[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AM'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AN'.$rows, $datacandidate[$i]["user_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AO'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AP'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AR'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('AS'.$rows, "");	
// 				//tambahan untuk input ke tabel t_sync_proint 29 April 2016
// 				querying("INSERT INTO t_sync_proint (candidate_id, t_sync_status, date_insert, user_insert, date_update, user_update)
// 	VALUES (?, 0, NOW(), ?, NOW(), ?)",array($datacandidate[$i]["candidate_id"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
				
// 				querying("UPDATE m_candidate SET export_flag=? WHERE candidate_id=?", array('1',$datacandidate[$i]["candidate_id"]));
// 			}

// 			for($col = 'A'; $col !== 'AS'; $col++) {
// 				$objPHPExcel->getActiveSheet()
// 					->getColumnDimension($col)
// 					->setAutoSize(true);
// 			}			
			
// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  
				  
					
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('Candidate');
			
			
			
// 			/* Sheet CanEdu */
			// $objPHPExcel->setActiveSheetIndex(1)
			// 			->setCellValue('A1', 'CanId.')
			// 			->setCellValue('B1', 'EduStatus')
			// 			->setCellValue('C1', 'CanEduSeq')
			// 			->setCellValue('D1', 'EduLevel')
			// 			->setCellValue('E1', 'EduMajor')
			// 			->setCellValue('F1', 'EduCity')			
			// 			->setCellValue('G1', 'EduInstitution')
			// 			->setCellValue('H1', 'EduGraduate')			
			// 			->setCellValue('I1', 'EduName')			
			// 			->setCellValue('J1', 'EduGrade')			
			// 			->setCellValue('K1', 'EduResult')			
			// 			->setCellValue('L1', 'EduFrontTitle')			
			// 			->setCellValue('M1', 'EduEndTitle')			
			// 			->setCellValue('N1', 'FgLastEdu')			
			// 			->setCellValue('O1', 'UpdDate')			
			// 			->setCellValue('P1', 'UpdUser')			
			// 			->setCellValue('Q1', 'UpdFlag')			
			// 			;

			// $rows=1;	
			// for($i=0;$i<count($dataedu);$i++) {
			// 	$rows++;
			// 	$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $dataedu[$i]["candidate_id"]);	
				
			// 	$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, "");	

			// 	$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, "");	
				
			// 	$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $dataedu[$i]["candidate_edu_degree"]);	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $dataedu[$i]["candidate_edu_major"]);	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $dataedu[$i]["candidate_edu_city"]);	
				
			// 	$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, $dataedu[$i]["candidate_edu_institution"]);	
			// 	$objPHPExcel->getActiveSheet()->getStyle('G'.$rows)->getAlignment()->setWrapText(true);
				
			// 	$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, $dataedu[$i]["candidate_edu_end"]);	
				
			// 	$objPHPExcel->getActiveSheet()->setCellValue('I'.$rows, $dataedu[$i]["candidate_edu_notes"]);	
			// 	$objPHPExcel->getActiveSheet()->getStyle('I'.$rows)->getAlignment()->setWrapText(true);
				
			// 	$objPHPExcel->getActiveSheet()->setCellValue('J'.$rows, $dataedu[$i]["candidate_edu_gpa"]);	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('K'.$rows, "");	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('L'.$rows, "");	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('M'.$rows, "");	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('N'.$rows, "");	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('O'.$rows, $dataedu[$i]["date_update"]);	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('P'.$rows, $dataedu[$i]["user_update"]);	
			// 	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rows, "");	
				
			// 	querying("UPDATE m_candidate_edu SET export_flag=? WHERE candidate_edu_id=?", array('1',$dataedu[$i]["candidate_edu_id"]));

			// }
			// foreach(range('A','Q') as $columnID) {
			// 	$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			// 		->setAutoSize(true);
			// }

			// $styleArray = array(
			// 		  'borders' => array(
			// 			  'allborders' => array(
			// 				//   'style' => PHPExcel_Style_Border::BORDER_THIN
			// 			  )
			// 		  )
			// 	  );

			// $objPHPExcel->getActiveSheet()->getStyle(
			// 	'A1:' . 
			// 	$objPHPExcel->getActiveSheet()->getHighestColumn() . 
			// 	$objPHPExcel->getActiveSheet()->getHighestRow()
			// )->applyFromArray($styleArray);	  
				  
					
			// // Rename worksheet
			// $objPHPExcel->getActiveSheet()->setTitle('CanEdu');
			
			
// 			/* Sheet CanFamily */
// 			$objPHPExcel->setActiveSheetIndex(2)
// 						->setCellValue('A1', 'CanId.')
// 						->setCellValue('B1', 'FamRelation')
// 						->setCellValue('C1', 'FamName')
// 						->setCellValue('D1', 'FamDateBirth')
// 						->setCellValue('E1', 'FamSex')
// 						->setCellValue('F1', 'FamAddress')			
// 						->setCellValue('G1', 'FamPhone')
// 						->setCellValue('H1', 'FamOccupation')			
// 						->setCellValue('I1', 'FamAlive')			
// 						->setCellValue('J1', 'UpdDate')			
// 						->setCellValue('K1', 'UpdUser')			
// 						->setCellValue('L1', 'UpdFlag')			
// 						->setCellValue('M1', 'FamCityBirth')			
// 						->setCellValue('N1', 'FamMaritalSt')			
// 						->setCellValue('O1', 'FamMaritalDate')			
// 						->setCellValue('P1', 'FamEmploymentSt')			
// 						->setCellValue('Q1', 'FamComp')			
// 						->setCellValue('R1', 'FamCompAddr')			
// 						->setCellValue('S1', 'FamEdu')			
// 						->setCellValue('T1', 'FamEduIns')			
// 						->setCellValue('U1', 'FamFgSchool')			
// 						->setCellValue('V1', 'FamIdCard')			
// 						->setCellValue('W1', 'FamResAddr')			
// 						->setCellValue('X1', 'FamHp')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($datafam);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $datafam[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, $datafam[$i]["candidate_family_relation"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datafam[$i]["candidate_family_name"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datafam[$i]["candidate_family_birthdate"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, $datafam[$i]["candidate_family_lastjob"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('I'.$rows, $datafam[$i]["candidate_family_rip"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('J'.$rows, $datafam[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('K'.$rows, $datafam[$i]["user_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('L'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('M'.$rows, $datafam[$i]["candidate_family_birthplace"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('N'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('O'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('P'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rows, $datafam[$i]["candidate_family_company"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('R'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('S'.$rows, $datafam[$i]["candidate_family_lastedu"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('T'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('U'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('V'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('W'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('X'.$rows, "");	
				
// 				querying("UPDATE m_candidate_family SET export_flag=? WHERE candidate_family_id=?", array('1',$datafam[$i]["candidate_family_id"]));
				
// 			}
// 			foreach(range('A','X') as $columnID) {
// 				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
// 					->setAutoSize(true);
// 			}			
			
// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'style' => PHPExcel_Style_Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  					
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('CanFamily');
			
			
// 			/* Sheet CanExperience */
// 			$objPHPExcel->setActiveSheetIndex(3)
// 						->setCellValue('A1', 'CanId.')
// 						->setCellValue('B1', 'Sequence')
// 						->setCellValue('C1', 'CompanyName')
// 						->setCellValue('D1', 'CompanyAddress')
// 						->setCellValue('E1', 'CompanyCity')
// 						->setCellValue('F1', 'CompanyZipCode')			
// 						->setCellValue('G1', 'CompanyPhone')
// 						->setCellValue('H1', 'JobStart')			
// 						->setCellValue('I1', 'JobEnd')			
// 						->setCellValue('J1', 'JobTitle')			
// 						->setCellValue('K1', 'SalaryStart')			
// 						->setCellValue('L1', 'SalaryEnd')			
// 						->setCellValue('M1', 'TerminationReason')			
// 						->setCellValue('N1', 'UpdDate')			
// 						->setCellValue('O1', 'UpdUser')			
// 						->setCellValue('P1', 'UpdFlag')			
// 						->setCellValue('Q1', 'Description')			
// 						->setCellValue('R1', 'FgCase')																																																
// 						->setCellValue('S1', 'Performance')			
// 						->setCellValue('T1', 'SprName')			
// 						->setCellValue('U1', 'SprPhone')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($datajobexp);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $datajobexp[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datajobexp[$i]["candidate_jobexp_company"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datajobexp[$i]["candidate_jobexp_address"]);
// 				$objPHPExcel->getActiveSheet()->getStyle('D'.$rows)->getAlignment()->setWrapText(true);				
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, $datajobexp[$i]["candidate_jobexp_phone"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, $datajobexp[$i]["candidate_jobexp_start"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('I'.$rows, $datajobexp[$i]["candidate_jobexp_end"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('J'.$rows, $datajobexp[$i]["candidate_jobexp_spvposition"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('K'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('L'.$rows, $datajobexp[$i]["candidate_jobexp_salary"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('M'.$rows, $datajobexp[$i]["candidate_jobexp_leaving"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('M'.$rows)->getAlignment()->setWrapText(true);				
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('N'.$rows, $datajobexp[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('O'.$rows, $datajobexp[$i]["user_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('P'.$rows, "");	
				
// 				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rows, $datajobexp[$i]["candidate_jobexp_desc"]);	
// 				$objPHPExcel->getActiveSheet()->getStyle('Q'.$rows)->getAlignment()->setWrapText(true);				

// 				$objPHPExcel->getActiveSheet()->setCellValue('R'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('S'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('T'.$rows, $datajobexp[$i]["candidate_jobexp_spvname"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('U'.$rows, "");	
				
// 				querying("UPDATE m_candidate_jobexp SET export_flag=? WHERE candidate_jobexp_id=?", array('1',$datajobexp[$i]["candidate_jobexp_id"]));
// 			}
// 			foreach(range('A','U') as $columnID) {
// 				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
// 					->setAutoSize(true);
// 			}			
			
// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'style' => PHPExcel_Style_Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  					
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('CanExperience');			
			
			
			
// 			/* Sheet CanExOrganization */
// 			$objPHPExcel->setActiveSheetIndex(4)
// 						->setCellValue('A1', 'CanId.')
// 						->setCellValue('B1', 'OrgName')
// 						->setCellValue('C1', 'CanPosition')
// 						->setCellValue('D1', 'CanOrgStart')
// 						->setCellValue('E1', 'CanOrgEnd')
// 						->setCellValue('F1', 'UpdDate')			
// 						->setCellValue('G1', 'UpdUser')
// 						->setCellValue('H1', 'UpdFlag')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($dataorg);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $dataorg[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, $dataorg[$i]["candidate_organization_name"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $dataorg[$i]["candidate_organization_role"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $dataorg[$i]["candidate_organization_start"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $dataorg[$i]["candidate_organization_end"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $dataorg[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, $dataorg[$i]["user_update"]);					
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, "");	
				
// 				querying("UPDATE m_candidate_organization SET export_flag=? WHERE candidate_organization_id=?", array('1',$dataorg[$i]["candidate_organization_id"]));
// 			}
// 			foreach(range('A','H') as $columnID) {
// 				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
// 					->setAutoSize(true);
// 			}

// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'style' => PHPExcel_Style_Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  
				  
					
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('CanExOrganization');
			
			
			
// 			/* Sheet CanLang */
// 			$objPHPExcel->setActiveSheetIndex(5)
// 						->setCellValue('A1', 'CanId.')
// 						->setCellValue('B1', 'CanLangCode')
// 						->setCellValue('C1', 'CanLangRead')
// 						->setCellValue('D1', 'CanLangWrite')
// 						->setCellValue('E1', 'CanLangSpeak')
// 						->setCellValue('F1', 'UpdDate')			
// 						->setCellValue('G1', 'UpdUser')
// 						->setCellValue('H1', 'UpdFlag')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($datalang);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $datalang[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, $datalang[$i]["candidate_language_name"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datalang[$i]["candidate_language_read"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datalang[$i]["candidate_language_write"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $datalang[$i]["candidate_language_conversation"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $datalang[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, $datalang[$i]["user_update"]);					
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, "");
				
// 				querying("UPDATE m_candidate_language SET export_flag=? WHERE candidate_language_id=?", array('1',$datalang[$i]["candidate_language_id"]));
// 			}
// 			foreach(range('A','H') as $columnID) {
// 				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
// 					->setAutoSize(true);
// 			}

// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'style' => PHPExcel_Style_Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  
				  
					
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('CanLang');
			
// 			/* Sheet CanDocument */
// 			$objPHPExcel->setActiveSheetIndex(6)
// 						->setCellValue('A1', 'CanId.')
// 						->setCellValue('B1', 'CanDocSeq')
// 						->setCellValue('C1', 'CanDocDesc')
// 						->setCellValue('D1', 'CanDocFile')
// 						->setCellValue('E1', 'UpdDate')
// 						->setCellValue('F1', 'UpdUser')			
// 						->setCellValue('G1', 'UpdFlag')
// 						->setCellValue('H1', 'CanDoc')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($datafile);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $datafile[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datafile[$i]["candidate_file_notes"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datafile[$i]["candidate_file_name"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $datafile[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $datafile[$i]["user_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, "");					
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, $datafile[$i]["candidate_file_type"]);		

// 				querying("UPDATE m_candidate_file SET export_flag=? WHERE candidate_file_id=?", array('1',$datafile[$i]["candidate_file_id"]));
				
// 			}

// 			for($i=0;$i<count($datafileother);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $datafileother[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, "");	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datafileother[$i]["candidate_file_notes"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datafileother[$i]["candidate_file_name"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $datafileother[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $datafileother[$i]["user_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rows, "");					
// 				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rows, "others");		

// 				querying("UPDATE m_candidate_fileothers SET export_flag=? WHERE candidate_file_id=?", array('1',$datafileother[$i]["candidate_file_id"]));
				
// 			}
			
			
// 			foreach(range('A','H') as $columnID) {
// 				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
// 					->setAutoSize(true);
// 			}

// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'style' => PHPExcel_Style_Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  
			
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('CanDocument');
			
// 			/* Sheet CanSkill 
								
// */
// 			$objPHPExcel->setActiveSheetIndex(7)
// 						->setCellValue('A1', 'CanId')
// 						->setCellValue('B1', 'CanSkillCode')
// 						->setCellValue('C1', 'CanSkillGrade')
// 						->setCellValue('D1', 'UpdDate')
// 						->setCellValue('E1', 'UpdUser')
// 						->setCellValue('F1', 'UpdFlag')			
// 						;

// 			$rows=1;	
// 			for($i=0;$i<count($dataskill);$i++) {
// 				$rows++;
// 				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $dataskill[$i]["candidate_id"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, $dataskill[$i]["candidate_skill_name"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $dataskill[$i]["candidate_skill_level"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $dataskill[$i]["date_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $dataskill[$i]["user_update"]);	
// 				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, "");	
				
// 				querying("UPDATE m_candidate_skill SET export_flag=? WHERE candidate_skill_id=?", array('1',$dataskill[$i]["candidate_skill_id"]));
// 			}
			
// 			foreach(range('A','F') as $columnID) {
// 				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
// 					->setAutoSize(true);
// 			}

// 			$styleArray = array(
// 					  'borders' => array(
// 						  'allborders' => array(
// 							//   'style' => PHPExcel_Style_Border::BORDER_THIN
// 						  )
// 					  )
// 				  );

// 			$objPHPExcel->getActiveSheet()->getStyle(
// 				'A1:' . 
// 				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
// 				$objPHPExcel->getActiveSheet()->getHighestRow()
// 			)->applyFromArray($styleArray);	  
			
// 			// Rename worksheet
// 			$objPHPExcel->getActiveSheet()->setTitle('CanSkill');
			
			

// 			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
// 			$objPHPExcel->setActiveSheetIndex(0);


// 			// Save Excel 95 file
// 			$callStartTime = microtime(true);

// 			$objWriter = IOFactory::createWriter($objPHPExcel, 'Xls');
// 			$objWriter->save('php://output');
// 			$callEndTime = microtime(true);
// 			$callTime = $callEndTime - $callStartTime;
// 		}
// 	}	
	
	//tambahan shakti 2017-09-10
	function adm_exportExcelForProint() {
		//echo "module download for Proint";
		if(isset($_REQUEST["type"]) && $_REQUEST["type"]<>"") {
			//tambahan shakti 25 Juni 2018
			$recruit_pic=getRecruiterPic($_SESSION["log_auth_id"]);
			
			$datacandidate=export_DataCandidateJoin();
			$datajobexp=export_DataJob();

			// Create new PHPExcel object
			require './vendor/autoload.php';
			$spreadsheet = new Spreadsheet();
			
			$namafile=(isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"")?"candidate_".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".xls":"candidate_".$_REQUEST["type"]."_".date("YmdHis").".xls";
			// $file = fopen($namafile, 'w');
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$namafile.'"');
			header('Cache-Control: max-age=0');

			
			$spreadsheet->getProperties()
			->setCreator("MPPA Recruitment")
			->setLastModifiedBy("MPPA Recruitment")
			->setTitle("Titlenya")
			->setSubject("Subjectnya")
			->setDescription("Generate by system.")
			->setKeywords("proposed candidate")
			->setCategory("User Screening");
			// ->setTempDir(sys_get_temp_dir().DIRECTORY_SEPARATOR."");
        // ->save($path);

			$worksheet1 = $spreadsheet->getActiveSheet();
			$worksheet2 = $spreadsheet->createSheet();
			$worksheet3 = $spreadsheet->createSheet();
			$worksheet4 = $spreadsheet->createSheet();
			$worksheet5 = $spreadsheet->createSheet();

			/* Sheet Candidate */
			
			$worksheet1->setCellValue('A1', 'CanId.')
						->setCellValue('B1', 'EmpName')
						->setCellValue('C1', 'EmpOrganization')
						->setCellValue('D1', 'EmpJobTitle')
						->setCellValue('E1', 'EmpJobLevel')
						->setCellValue('F1', 'EmpType')			
						->setCellValue('G1', 'EmpCompany')
						->setCellValue('H1', 'EmpLocation')			
						->setCellValue('I1', 'EmpLabour')			
						->setCellValue('J1', 'EmpCostCtre')			
						->setCellValue('K1', 'EmpDateBirth')			
						->setCellValue('L1', 'EmpCityBirth')			
						->setCellValue('M1', 'EmpSex')			
						->setCellValue('N1', 'EmpBloodType')			
						->setCellValue('O1', 'EmpCitizen')			
						->setCellValue('P1', 'EmpRace')			
						->setCellValue('Q1', 'EmpReligion')			
						->setCellValue('R1', 'EmpMaritalSt')			
						->setCellValue('S1', 'EmpStartDate')			
						->setCellValue('T1', 'EmpSignDate')			
						->setCellValue('U1', 'EmpJoinDate')			
						->setCellValue('V1', 'EmpDecision')			
						->setCellValue('W1', 'EmpCreateDate')			
						->setCellValue('X1', 'EmpDescription')			
						->setCellValue('Y1', 'EmpEffecDate')			
						->setCellValue('Z1', 'EmpInitiator')			
						->setCellValue('AA1', 'EmpDecStart')			
						->setCellValue('AB1', 'EmpDecEnd')
						->setCellValue('AC1', 'EmpPhoto')
						->setCellValue('AD1', 'EmpContractStart')
						->setCellValue('AE1', 'EmpContractEnd')
						->setCellValue('AF1', 'EmpSKType')
						->setCellValue('AG1', 'EmpEmail')
						->setCellValue('AH1', 'EmpLocRecruit')
						->setCellValue('AI1', 'EmpWinLogin')
						->setCellValue('AJ1', 'EmpWinPassword')
						->setCellValue('AK1', 'EmpWinLoginFlag')
						->setCellValue('AL1', 'SKCostCtre')
						->setCellValue('AM1', 'UserGroup')
						->setCellValue('AN1', 'FgForeignLabor')
						->setCellValue('AO1', 'OUCode')
						->setCellValue('AP1', 'UpdDate')
						->setCellValue('AQ1', 'UpdUser')
						->setCellValue('AR1', 'UpdFlag')
						->setCellValue('AS1', 'RefNmbr')			
						->setCellValue('AT1', 'EmpResAddr')			
						->setCellValue('AU1', 'EmpResCity')			
						->setCellValue('AV1', 'EmpResZipCode')			
						->setCellValue('AW1', 'EmpResPhone')			
						->setCellValue('AX1', 'EmpResStatus')			
						->setCellValue('AY1', 'EmpResStart')			
						->setCellValue('AZ1', 'EmpOriAddr.')		
						->setCellValue('BA1', 'EmpOriCity')			
						->setCellValue('BB1', 'EmpOriZipCode')
						->setCellValue('BC1', 'EmpOriPhone')
						->setCellValue('BD1', 'EmpOriStatus')
						->setCellValue('BE1', 'EmpOriStart')
						->setCellValue('BF1', 'FgStatus')
						->setCellValue('BG1', 'AuthTemp')
						->setCellValue('BH1', 'RejectBy')
						->setCellValue('BI1', 'RejectDesc')
						->setCellValue('BJ1', 'ReportTo')
						->setCellValue('BK1', 'EmpLocRecruitCity')
						->setCellValue('BL1', 'EmpValId')
						->setCellValue('BM1', 'EmpValJobTtl')
						->setCellValue('BN1', 'EmpValOrg')
						->setCellValue('BO1', 'EmpApprId')
						->setCellValue('BP1', 'EmpApprJobTtl')
						->setCellValue('BQ1', 'EmpApprOrg')
						->setCellValue('BR1', 'RefSource')
						->setCellValue('BS1', 'RefName')									
						;
			
			//print_r($datacandidate);exit;
			
			$rows=1;	
			for($i=0;$i<count($datacandidate);$i++) {
				$rows++;
				
				 $gender=($datacandidate[$i]["candidate_gender"]=="male")?"M":"F";
				 
				 //tambahan Shakti 21 Juni 2018
				 $candidate_homebase=(isset($datacandidate[$i]["candidate_homebase"]) && $datacandidate[$i]["candidate_homebase"]!="" && $datacandidate[$i]["candidate_homebase"]!=NULL)?$datacandidate[$i]["candidate_homebase"]:"1411";
				
				 $agama=NULL;
				 //Islam', 'Roman Catholic', 'Protestant', 'Hindu', 'Budhist
				 if($datacandidate[$i]["candidate_religion"]=="Islam") $agama="ISLAM";
				 else if($datacandidate[$i]["candidate_religion"]=="Roman Catholic") $agama="KATHOLIK";
				 else if($datacandidate[$i]["candidate_religion"]=="Protestant") $agama="KRISTEN";
				 else if($datacandidate[$i]["candidate_religion"]=="Hindu") $agama="HINDU";
				 else if($datacandidate[$i]["candidate_religion"]=="Budhist") $agama="BUDDHA";
				 else if($datacandidate[$i]["candidate_religion"]=="Confucianism") $agama="KONG HU CU";
				 else $agama="LAINNYA";
				
				 $statusnikah=NULL;
				 //'Single', 'Married', 'Divorce', 'Separated'
				 if($datacandidate[$i]["candidate_marital"]=="Single") $statusnikah="BELUM NIKAH";
				 if($datacandidate[$i]["candidate_marital"]=="Married") $statusnikah="NIKAH";
				 if( ($datacandidate[$i]["candidate_marital"]=="Divorce" || $datacandidate[$i]["candidate_marital"]=="Separated") && $gender=="M" ) $statusnikah="DUDA";
				 if( ($datacandidate[$i]["candidate_marital"]=="Divorce" || $datacandidate[$i]["candidate_marital"]=="Separated") && $gender=="F" ) $statusnikah="JANDA";
				
				 $warganegara=($datacandidate[$i]["candidate_nationality"]=='wni')?'INA':'WNA';
				 				 
				 $pcity=(isset($datacandidate[$i]["candidate_p_city"]) && $datacandidate[$i]["candidate_p_city"]!="")?getCityCode($datacandidate[$i]["candidate_p_city"]):"NULL";
				 $ccity=(isset($datacandidate[$i]["candidate_c_city"]) && $datacandidate[$i]["candidate_c_city"]!="")?getCityCode($datacandidate[$i]["candidate_c_city"]):"NULL";
				 $birthplace=(isset($datacandidate[$i]["candidate_birthplace"]) && $datacandidate[$i]["candidate_birthplace"]!="")?getCityCode($datacandidate[$i]["candidate_birthplace"]):"NULL";
				
				 switch ($datacandidate[$i]["job_vacancy_type"]) {
					case "Daily Worker":
						$emptype="DAILY WORKER";
						break;
					case "Internship":
						$emptype="MAGANG";
						break;
					case "Contract":
						$emptype="KONTRAK";
						break;
					case "Permanent":
						$emptype="TETAP";
						break;
					case "Contract Retirement":
						$emptype="KONTRAK PENSIUN";
						break;
					case "M T P":
						$emptype="M T P";
						break;
					case "Probation":
						$emptype="PERCOBAAN";
						break;
					case "LAKU PANDAI":
						$emptype="LAKU PANDAI";
						break;						
					default:
						$emptype="DAILY WORKER";
				 }
				 
				//print_r($pcity);
				
				//print_r($datacandidate);exit;
				
				$worksheet1->setCellValue('A'.$rows, $datacandidate[$i]["candidate_id"]);	
				$worksheet1->getStyle('A'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('B'.$rows, strtoupper($datacandidate[$i]["candidate_name"]));	
				$worksheet1->getStyle('B'.$rows)->getAlignment()->setWrapText(true);

				$worksheet1->setCellValue('C'.$rows, strtoupper($datacandidate[$i]["OrgCode"]));	
				//$worksheet1->getStyle('C'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('D'.$rows, strtoupper($datacandidate[$i]["JobTtlCode"]));	
				$worksheet1->setCellValue('E'.$rows, strtoupper($datacandidate[$i]["job_vacancy_grade"]));	
				$worksheet1->setCellValue('F'.$rows, strtoupper($emptype));	
				$worksheet1->setCellValue('G'.$rows, 'HHPR');	
				$worksheet1->setCellValue('H'.$rows, strtoupper($datacandidate[$i]["LocationCode"]));	
				$worksheet1->getStyle('H'.$rows)->getAlignment()->setWrapText(true);

				$worksheet1->setCellValue('I'.$rows, "NULL");	
				$worksheet1->setCellValue('J'.$rows, 'costcenter');	
				$worksheet1->setCellValue('K'.$rows, $datacandidate[$i]["candidate_birthdate"]);	
				$worksheet1->getStyle('K'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('L'.$rows, strtoupper($birthplace));	
				$worksheet1->setCellValue('M'.$rows, strtoupper($gender));	
				$worksheet1->setCellValue('N'.$rows, strtoupper($datacandidate[$i]["candidate_bloodtype"]));
				$worksheet1->getStyle('N'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('O'.$rows, $warganegara);	
				$worksheet1->getStyle('O'.$rows)->getAlignment()->setWrapText(true);				
				
				$worksheet1->setCellValue('P'.$rows, strtoupper($datacandidate[$i]["candidate_race"]));	//if candidate_race tidak ada di table maka "NULL"
				$worksheet1->setCellValue('Q'.$rows, strtoupper($agama));	
				$worksheet1->setCellValue('R'.$rows, strtoupper($statusnikah));	
				$worksheet1->setCellValue('S'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->setCellValue('T'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->getStyle('T'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('U'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->getStyle('U'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('V'.$rows, "NULL");	
				$worksheet1->setCellValue('W'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->setCellValue('X'.$rows, "NULL");	
				$worksheet1->setCellValue('Y'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->setCellValue('Z'.$rows, $datacandidate[$i]["employee_nik"]);	
				$worksheet1->setCellValue('AA'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->setCellValue('AB'.$rows, "NULL");	
				$worksheet1->getStyle('AB'.$rows)->getAlignment()->setWrapText(true);
				
				$worksheet1->setCellValue('AC'.$rows, "NULL");	
				$worksheet1->setCellValue('AD'.$rows, $datacandidate[$i]["ContractStart"]);	
				$worksheet1->setCellValue('AE'.$rows, $datacandidate[$i]["ContractEnd"]);	
				$worksheet1->setCellValue('AF'.$rows, "REKRUT");	
				$worksheet1->setCellValue('AG'.$rows, strtoupper($datacandidate[$i]["candidate_email"]));	
				$worksheet1->setCellValue('AH'.$rows, "901");	
				$worksheet1->setCellValue('AI'.$rows, "NULL");	
				$worksheet1->setCellValue('AJ'.$rows, "NULL");	
				$worksheet1->setCellValue('AK'.$rows, "NULL");	
				$worksheet1->setCellValue('AL'.$rows, "NULL");	
				$worksheet1->setCellValue('AM'.$rows, "NULL");	
				$worksheet1->setCellValue('AN'.$rows, ($warganegara=="INA")?"N":"Y");	
				$worksheet1->setCellValue('AO'.$rows, "NULL");	
				$worksheet1->setCellValue('AP'.$rows, date("Y-m-d H:i:s"));	
				$worksheet1->setCellValue('AQ'.$rows, $recruit_pic);	
				$worksheet1->setCellValue('AR'.$rows, "Y");	
				$worksheet1->setCellValue('AS'.$rows, "NULL");	
				$worksheet1->setCellValue('AT'.$rows, strtoupper($datacandidate[$i]["candidate_c_address"]));	
				$worksheet1->setCellValue('AU'.$rows, $ccity);	
				$worksheet1->setCellValue('AV'.$rows, $datacandidate[$i]["candidate_c_postcode"]);	
				$worksheet1->setCellValue('AW'.$rows, $datacandidate[$i]["candidate_hp1"]);	
				$worksheet1->setCellValue('AX'.$rows, "NULL");	
				$worksheet1->setCellValue('AY'.$rows, "NULL");	
				$worksheet1->setCellValue('AZ'.$rows, strtoupper($datacandidate[$i]["candidate_p_address"]));	
				$worksheet1->setCellValue('BA'.$rows, $pcity);	
				$worksheet1->setCellValue('BB'.$rows, $datacandidate[$i]["candidate_p_postcode"]);	
				$worksheet1->setCellValue('BC'.$rows, $datacandidate[$i]["candidate_phone"]);	
				$worksheet1->setCellValue('BD'.$rows, "NULL");	
				$worksheet1->setCellValue('BE'.$rows, "NULL");	
				$worksheet1->setCellValue('BF'.$rows, "NULL");	
				$worksheet1->setCellValue('BG'.$rows, "NULL");	
				$worksheet1->setCellValue('BH'.$rows, "NULL");	
				$worksheet1->setCellValue('BI'.$rows, "NULL");	
				$worksheet1->setCellValue('BJ'.$rows, "NULL");	
				$worksheet1->setCellValue('BK'.$rows, $candidate_homebase);	
				$worksheet1->setCellValue('BL'.$rows, "NULL");	
				$worksheet1->setCellValue('BM'.$rows, "NULL");	
				$worksheet1->setCellValue('BN'.$rows, "NULL");	
				$worksheet1->setCellValue('BO'.$rows, "NULL");	
				$worksheet1->setCellValue('BP'.$rows, "NULL");	
				$worksheet1->setCellValue('BQ'.$rows, "NULL");	
				$worksheet1->setCellValue('BR'.$rows, "NULL");	
				$worksheet1->setCellValue('BS'.$rows, "NULL");	
				//tambahan untuk input ke tabel t_sync_proint 29 April 2016
				querying("INSERT INTO t_sync_proint (candidate_id, t_sync_status, date_insert, user_insert, date_update, user_update)
	VALUES (?, 0, NOW(), ?, NOW(), ?)",array($datacandidate[$i]["candidate_id"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
				
				querying("UPDATE m_candidate SET export_flag=? WHERE candidate_id=?", array('1',$datacandidate[$i]["candidate_id"]));
			}			
			
			for($col = 'A'; $col !== 'BS'; $col++) {
				$worksheet1
					->getColumnDimension($col)
					->setAutoSize(true);
			}			
			
			$styleArray = array(
					  'borders' => array(
						  'allborders' => array(
							  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						  )
					  )
				  );

			$worksheet1->getStyle(
				'A1:' . 
				$worksheet1->getHighestColumn() . 
				$worksheet1->getHighestRow()
			)->applyFromArray($styleArray);	  
				  
					
			// Rename worksheet
			$worksheet1->setTitle('Candidate');

			
			
			/* Sheet CanEdu */
			
			$worksheet2->setCellValue('A1', 'CanId.')
						->setCellValue('B1', 'EmpEduStatus')
						->setCellValue('C1', 'EmpEduSeq')
						->setCellValue('D1', 'EmpEduLevel')
						->setCellValue('E1', 'EmpEduMajor')
						->setCellValue('F1', 'EmpEduName')			
						->setCellValue('G1', 'EmpEduIns')
						->setCellValue('H1', 'EmpEduCity')			
						->setCellValue('I1', 'EmpEduGraduate')			
						->setCellValue('J1', 'EmpEduGrade')			
						->setCellValue('K1', 'EmpEduResult')			
						->setCellValue('L1', 'EmpEduFrontTitle')			
						->setCellValue('M1', 'EmpEduEndTitle')			
						->setCellValue('N1', 'FgDefault')			
						->setCellValue('O1', 'UpdDate')			
						->setCellValue('P1', 'UpdUser')			
						->setCellValue('Q1', 'UpdFlag')			
						;
						
			
				//Ambil data edu sesuai dengan list candidate_id nya
				$rows=1;	
				for($j=0;$j<count($datacandidate);$j++)
				{
					$dataedu=export_DataEduRev($datacandidate[$j]["candidate_id"]);
					$k=0;
					

					for($i=0;$i<count($dataedu);$i++) 
					{
						$lastedu="N";
						$rows++;
						$k++;
						switch ($dataedu[$i]["candidate_edu_degree"]) {
							case "Doctoral - S3":
								$degree="S3";
								break;
							case "Master - S2":
								$degree="S2";
								break;
							case "Bachelor - S1":
								$degree="S1";
								break;
							case "Diploma":
								$degree="D3";
								break;
							case "Highschool - SMA":
								$degree="SLTA";
								break;
							case "Junior Highschool - SMP":
								$degree="SLTP";
								break;
							case "Elementary - SD":
								$degree="SD";
								break;
							default:
								$degree="SLTA";
						 }
						
						if($k=="1"){$lastedu="Y";}
						
						$worksheet2->setCellValue('A'.$rows, $dataedu[$i]["candidate_id"]);	
						
						$worksheet2->setCellValue('B'.$rows, "F");	

						$worksheet2->setCellValue('C'.$rows, $k);	
						//$worksheet2->setCellValue('C'.$rows, '=COUNTIFS($A$2:A2,A2)');
						
						$worksheet2->setCellValue('D'.$rows, $degree);	
						// $worksheet2->setCellValue('E'.$rows, (isset($dataedu[$i]["candidate_edu_major"]) && $dataedu[$i]["candidate_edu_major"]!="")?getEduMajor($dataedu[$i]["candidate_edu_major"]):$dataedu[$i]["candidate_edu_major"]);	
						$worksheet2->setCellValue('E'.$rows, (isset($dataedu[$i]["candidate_edu_major"]) && $dataedu[$i]["candidate_edu_major"]!="")?strtoupper($dataedu[$i]["candidate_edu_major"]):"NULL");	
						$worksheet2->setCellValue('F'.$rows, "NULL");	
						
						// $worksheet2->setCellValue('G'.$rows, (isset($dataedu[$i]["candidate_edu_institution"]) && $dataedu[$i]["candidate_edu_institution"]!="")?getEduInstitution($dataedu[$i]["candidate_edu_institution"]):$dataedu[$i]["candidate_edu_institution"]);	
						$worksheet2->setCellValue('G'.$rows, (isset($dataedu[$i]["candidate_edu_institution"]) && $dataedu[$i]["candidate_edu_institution"]!="")?strtoupper($dataedu[$i]["candidate_edu_institution"]):"NULL");	
						$worksheet2->getStyle('G'.$rows)->getAlignment()->setWrapText(true);
						
						$worksheet2->setCellValue('H'.$rows, (isset($dataedu[$i]["candidate_edu_city"]) && $dataedu[$i]["candidate_edu_city"]!="")?getCityCode($dataedu[$i]["candidate_edu_city"]):$dataedu[$i]["candidate_edu_city"]);	
						
						$worksheet2->setCellValue('I'.$rows, $dataedu[$i]["candidate_edu_end"]);	
						$worksheet2->getStyle('I'.$rows)->getAlignment()->setWrapText(true);
						
						$worksheet2->setCellValue('J'.$rows, $dataedu[$i]["candidate_edu_gpa"]);	
						$worksheet2->setCellValue('K'.$rows, "BERIJAZAH");	
						$worksheet2->setCellValue('L'.$rows, "NULL");	
						$worksheet2->setCellValue('M'.$rows, "NULL");	
						$worksheet2->setCellValue('N'.$rows, $lastedu);	
						$worksheet2->setCellValue('O'.$rows, $dataedu[$i]["date_update"]);	
						$worksheet2->setCellValue('P'.$rows, $recruit_pic);	
						$worksheet2->setCellValue('Q'.$rows, "Y");	
						
						querying("UPDATE m_candidate_edu SET export_flag=? WHERE candidate_edu_id=?", array('1',$dataedu[$i]["candidate_edu_id"]));

					}
				}
									
									
									
									
			foreach(range('A','Q') as $columnID) {
				$worksheet2->getColumnDimension($columnID)
					->setAutoSize(true);
			}

			$styleArray = array(
					  'borders' => array(
						  'allborders' => array(
							  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						  )
					  )
				  );

			$worksheet2->getStyle(
				'A1:' . 
				$worksheet2->getHighestColumn() . 
				$worksheet2->getHighestRow()
			)->applyFromArray($styleArray);	  
				  
					
			// Rename worksheet
			$worksheet2->setTitle('CanEdu');
			
			
			/* Sheet CanFamily */
			
			$worksheet3 ->setCellValue('A1', 'CanId.')
						->setCellValue('B1', 'EmpFamRelation')
						->setCellValue('C1', 'EmpFamName')
						->setCellValue('D1', 'EmpFamEmpId')
						->setCellValue('E1', 'EmpFamCityBirth')
						->setCellValue('F1', 'EmpFamDateBrith')			
						->setCellValue('G1', 'EmpFamSex')
						->setCellValue('H1', 'EmpFamAddress')			
						->setCellValue('I1', 'EmpFamResAddr')			
						->setCellValue('J1', 'EmpFamPhone')			
						->setCellValue('K1', 'EmpFamHp')			
						->setCellValue('L1', 'EmpFamIdCard')			
						->setCellValue('M1', 'EmpFamEdu')			
						->setCellValue('N1', 'EmpFamEduIns')			
						->setCellValue('O1', 'EmpFamOccupation')			
						->setCellValue('P1', 'EmpFamComp')			
						->setCellValue('Q1', 'EmpCompAddr')			
						->setCellValue('R1', 'EmpFamAlive')			
						->setCellValue('S1', 'EmpFamNo')			
						->setCellValue('T1', 'MaritalSt')			
						->setCellValue('U1', 'EmpFamMaritalDate')			
						->setCellValue('V1', 'EmploymentSt')			
						->setCellValue('W1', 'FgMedical')			
						->setCellValue('X1', 'FgSchool')			
						->setCellValue('Y1', 'EmpPTKP')			
						->setCellValue('Z1', 'UpdDate')			
						->setCellValue('AA1', 'UpdUser')			
						->setCellValue('AB1', 'UpdFlag')			
						;

			$rows=1;	
			for($j=0;$j<count($datacandidate);$j++)
			{
				$datafam=export_DataFamRev($datacandidate[$j]["candidate_id"]);
				$kakak=0;
				$adik=0;
				$anak=0;
								for($i=0;$i<count($datafam);$i++) {
									$rows++;
									
									switch ($datafam[$i]["candidate_family_lastedu"]) {
										case "Doctoral - S3":
											$degree="S3";
											break;
										case "Master - S2":
											$degree="S2";
											break;
										case "Bachelor - S1":
											$degree="S1";
											break;
										case "Diploma":
											$degree="D3";
											break;
										case "Highschool - SMA":
											$degree="SLTA";
											break;
										case "Junior Highschool - SMP":
											$degree="SLTP";
											break;
										case "Elementary - SD":
											$degree="SD";
											break;
										default:
											$degree="SLTA";
									}
									
									//cek jenis kelamin candidate
									$candidatesex=getCandidateSex($datafam[$i]["candidate_id"]);
									$candidatedob=getCandidateDob($datafam[$i]["candidate_id"]);
									
																	
									if($candidatesex=="M" && $datafam[$i]["candidate_family_relation"]=="Spouse") 
									{
										$fmrelation="ISTRI";
										$fmsex="F";
									}
									if($candidatesex=="F" && $datafam[$i]["candidate_family_relation"]=="Spouse") 
									{
										$fmrelation="SUAMI";
										$fmsex="M";
									}
									if($candidatedob>$datafam[$i]["candidate_family_birthdate"] && $datafam[$i]["candidate_family_relation"]!="Spouse" && $datafam[$i]["candidate_family_relation"]!="Father" && $datafam[$i]["candidate_family_relation"]!="Mother" && $datafam[$i]["candidate_family_relation"]!="Son" && $datafam[$i]["candidate_family_relation"]!="Daughter") 
									{
										$kakak++;
										$fmrelation="KAKAK KE-".$kakak;
									}
									if($candidatedob<=$datafam[$i]["candidate_family_birthdate"] && $datafam[$i]["candidate_family_relation"]!="Spouse" && $datafam[$i]["candidate_family_relation"]!="Father" && $datafam[$i]["candidate_family_relation"]!="Mother" && $datafam[$i]["candidate_family_relation"]!="Son" && $datafam[$i]["candidate_family_relation"]!="Daughter") 
									{
										$adik++;
										$fmrelation="ADIK KE-".$adik;
									}
									if($datafam[$i]["candidate_family_relation"]=="Son" || $datafam[$i]["candidate_family_relation"]=="Daughter")
									{
										$anak++;
										$fmrelation="ANAK KE-".$anak;
									}
									if($datafam[$i]["candidate_family_relation"]=="Father")
									{
										$fmrelation="AYAH";
									}
									if($datafam[$i]["candidate_family_relation"]=="Mother")
									{
										$fmrelation="IBU";
									}
									
									if($datafam[$i]["candidate_family_relation"]=="Brother" || $datafam[$i]["candidate_family_relation"]=="Son" || $datafam[$i]["candidate_family_relation"]=="Father")
									{
										$fmsex="M";
									}
									if($datafam[$i]["candidate_family_relation"]=="Sister" || $datafam[$i]["candidate_family_relation"]=="Daughter" || $datafam[$i]["candidate_family_relation"]=="Mother")
									{
										$fmsex="F";
									}
									
										
									
									
									
									$worksheet3->setCellValue('A'.$rows, $datafam[$i]["candidate_id"]);	
									$worksheet3->setCellValue('B'.$rows, (isset($fmrelation) && $fmrelation!="")?getRelationCode($fmrelation):"NULL");	
									$worksheet3->setCellValue('C'.$rows, strtoupper($datafam[$i]["candidate_family_name"]));	
									$worksheet3->setCellValue('D'.$rows, "NULL");	
									$worksheet3->setCellValue('E'.$rows, (isset($datafam[$i]["candidate_family_birthplace"]) && $datafam[$i]["candidate_family_birthplace"])?getCityCode($datafam[$i]["candidate_family_birthplace"]):"NULL");	
									$worksheet3->setCellValue('F'.$rows, $datafam[$i]["candidate_family_birthdate"]);	
									$worksheet3->setCellValue('G'.$rows, $fmsex);	
									$worksheet3->setCellValue('H'.$rows, "NULL");	
									$worksheet3->setCellValue('I'.$rows, "NULL");	
									$worksheet3->setCellValue('J'.$rows, "NULL");	
									$worksheet3->setCellValue('K'.$rows, "NULL");	
									$worksheet3->setCellValue('L'.$rows, "NULL");	
									$worksheet3->setCellValue('M'.$rows, $degree);	
									$worksheet3->setCellValue('N'.$rows, "NULL");	
									$worksheet3->setCellValue('O'.$rows, strtoupper($datafam[$i]["candidate_family_lastjob"]));	
									$worksheet3->setCellValue('P'.$rows, strtoupper($datafam[$i]["candidate_family_company"]));	
									$worksheet3->setCellValue('Q'.$rows, "NULL");	
									$worksheet3->setCellValue('R'.$rows, (isset($datafam[$i]["candidate_family_rip"]) && $datafam[$i]["candidate_family_rip"]=="Alive")?"Y":"N");	
									$worksheet3->setCellValue('S'.$rows, "NULL");	
									$worksheet3->setCellValue('T'.$rows, "NULL");	
									$worksheet3->setCellValue('U'.$rows, "NULL");	
									$worksheet3->setCellValue('V'.$rows, "NULL");	
									$worksheet3->setCellValue('W'.$rows, "NULL");	
									$worksheet3->setCellValue('X'.$rows, "NULL");	
									$worksheet3->setCellValue('Y'.$rows, "NULL");	
									$worksheet3->setCellValue('Z'.$rows, $datafam[$i]["date_update"]);	
									$worksheet3->setCellValue('AA'.$rows, $recruit_pic);	
									$worksheet3->setCellValue('AB'.$rows, "Y");	
									
									querying("UPDATE m_candidate_family SET export_flag=? WHERE candidate_family_id=?", array('1',$datafam[$i]["candidate_family_id"]));
									
								}
								
			}					
								
								
			foreach(range('A','AB') as $columnID) {
				$worksheet3->getColumnDimension($columnID)
					->setAutoSize(true);
			}			
			
			$styleArray = array(
					  'borders' => array(
						  'allborders' => array(
							  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						  )
					  )
				  );

			$worksheet3->getStyle(
				'A1:' . 
				$worksheet3->getHighestColumn() . 
				$worksheet3->getHighestRow()
			)->applyFromArray($styleArray);	  					
			// Rename worksheet
			$worksheet3->setTitle('CanFamily');
			
			
			/* Sheet CanExperience */
			
			$worksheet4->setCellValue('A1', 'CanId.')
						->setCellValue('B1', 'Sequence')
						->setCellValue('C1', 'CompanyName')
						->setCellValue('D1', 'CompanyAddress')
						->setCellValue('E1', 'CompanyCity')
						->setCellValue('F1', 'CompanyZipCode')			
						->setCellValue('G1', 'CompanyPhone')
						->setCellValue('H1', 'JobStart')			
						->setCellValue('I1', 'JobEnd')			
						->setCellValue('J1', 'JobTitle')			
						->setCellValue('K1', 'SalaryStart')			
						->setCellValue('L1', 'SalaryEnd')			
						->setCellValue('M1', 'TerminationReason')			
						->setCellValue('N1', 'UpdDate')			
						->setCellValue('O1', 'UpdUser')			
						->setCellValue('P1', 'UpdFlag')			
						->setCellValue('Q1', 'Description')			
						->setCellValue('R1', 'FgCase')			
						->setCellValue('S1', 'Performance')			
						->setCellValue('T1', 'SprName')			
						->setCellValue('U1', 'SprPhone')			
						;

			$rows=1;	
			for($j=0;$j<count($datacandidate);$j++) {
				
				$datajobexp=export_DataJobRev($datacandidate[$j]["candidate_id"]);
				$k=0;
				for($i=0;$i<count($datajobexp);$i++) 
				{
					$rows++;
					$k++;
					$worksheet4->setCellValue('A'.$rows, $datajobexp[$i]["candidate_id"]);	
					$worksheet4->setCellValue('B'.$rows, $k);	
					$worksheet4->setCellValue('C'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_company"]));	
					$worksheet4->setCellValue('D'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_address"]));
					$worksheet4->getStyle('D'.$rows)->getAlignment()->setWrapText(true);				
					
					$worksheet4->setCellValue('E'.$rows, "");	
					$worksheet4->setCellValue('F'.$rows, "");	
					$worksheet4->setCellValue('G'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_phone"]));	
					$worksheet4->setCellValue('H'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_start"]));	
					$worksheet4->setCellValue('I'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_end"]));	
					$worksheet4->setCellValue('J'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_spvposition"]));	
					$worksheet4->setCellValue('K'.$rows, "");	
					$worksheet4->setCellValue('L'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_salary"]));	
					$worksheet4->setCellValue('M'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_leaving"]));	
					$worksheet4->getStyle('M'.$rows)->getAlignment()->setWrapText(true);				
					
					$worksheet4->setCellValue('N'.$rows, $datajobexp[$i]["date_update"]);	
					$worksheet4->setCellValue('O'.$rows, $recruit_pic);	
					$worksheet4->setCellValue('P'.$rows, "");	
					
					$worksheet4->setCellValue('Q'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_desc"]));	
					$worksheet4->getStyle('Q'.$rows)->getAlignment()->setWrapText(true);				

					$worksheet4->setCellValue('R'.$rows, "");	
					$worksheet4->setCellValue('S'.$rows, "");	
					$worksheet4->setCellValue('T'.$rows, strtoupper($datajobexp[$i]["candidate_jobexp_spvname"]));	
					$worksheet4->setCellValue('U'.$rows, "");	
					
					querying("UPDATE m_candidate_jobexp SET export_flag=? WHERE candidate_jobexp_id=?", array('1',$datajobexp[$i]["candidate_jobexp_id"]));
				}
			}
			foreach(range('A','U') as $columnID) {
				$worksheet4->getColumnDimension($columnID)
					->setAutoSize(true);
			}			
			
			$styleArray = array(
					  'borders' => array(
						  'allborders' => array(
							  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						  )
					  )
				  );

			$worksheet4->getStyle(
				'A1:' . 
				$worksheet4->getHighestColumn() .  
				$worksheet4->getHighestRow()
			)->applyFromArray($styleArray);	  					
			// Rename worksheet
			$worksheet4->setTitle('CanExperience');			
						
			
			
			
			/* Sheet CandidateIDCard */
			$worksheet5->setCellValue('A1', 'EmpId.')
						->setCellValue('B1', 'EmpCardType')
						->setCellValue('C1', 'EmpCardNumber')
						->setCellValue('D1', 'EmpCardPublisher')
						->setCellValue('E1', 'EmpCardExpired')
						->setCellValue('F1', 'UpdDate')			
						->setCellValue('G1', 'UpdUser')
						->setCellValue('H1', 'UpdFlag')			
						->setCellValue('I1', 'CardDesc')			
						;

			$rows=1;	
			for($i=0;$i<count($datacandidate);$i++) {
				$rows++;
				$worksheet5->setCellValue('A'.$rows, $datacandidate[$i]["candidate_id"]);	
				$worksheet5->setCellValue('B'.$rows, $datacandidate[$i]["candidate_idtype"]);	
				//$worksheet5->setCellValue('C'.$rows, $datacandidate[$i]["candidate_idcard"]);	
				$worksheet5->setCellValueExplicit('C'.$rows, $datacandidate[$i]["candidate_idcard"], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);


				$worksheet5->setCellValue('D'.$rows, "NULL");	
				$worksheet5->setCellValue('E'.$rows, "NULL");	
				$worksheet5->setCellValue('F'.$rows, $datacandidate[$i]["date_update"]);	
				$worksheet5->setCellValue('G'.$rows, $recruit_pic);					
				$worksheet5->setCellValue('H'.$rows, "Y");	
				$worksheet5->setCellValue('I'.$rows, "NULL");	
				
				querying("UPDATE m_candidate SET export_flag=? WHERE candidate_id=?", array('1',$datacandidate[$i]["candidate_id"]));
			}
			foreach(range('A','I') as $columnID) {
				$worksheet5->getColumnDimension($columnID)
					->setAutoSize(true);
			}

			$styleArray = array(
					  'borders' => array(
						  'allborders' => array(
							  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
						  )
					  )
				  );

			$worksheet5->getStyle(
				'A1:' . 
				$worksheet5->getHighestColumn() . 
				$worksheet5->getHighestRow()
			)->applyFromArray($styleArray);	  
				  
					
			// Rename worksheet
			$worksheet5->setTitle('CandidateIDCard');

			
			

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$filepath = sys_get_temp_dir().DIRECTORY_SEPARATOR."Xlsx";
			$writer->save($filepath);
	
			// Mengirimkan file Excel sebagai unduhan
			// ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="' . $file . '"');
			header('Cache-Control: max-age=0');
			// $writer->save('php://output');
			exit;
			
			
			
		}
	}
	
	
	//tambahan shakti 25 Juni 2018
	function getRecruiterPic($logauthid){
		switch ($logauthid) {
			case "32":
				$proint_id="DETA CHRIS";
				break;
			case "29":
				$proint_id="ELISABETH";
				break;
			default:
				$proint_id="DETA CHRIS";
		} 
		return $proint_id;
		
	}


	// DATA CANDIDATE
	function adm_exportCsvDataForProint($isDownload = true) {
		if(isset($_REQUEST["type"]) && $_REQUEST["type"]<>"") {
			$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
	
			$datacandidate = export_DataCandidateJoin();
			$datajobexp=export_DataJob();
	
			$filename1 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") ? "Candidate_Data".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".csv" : "candidate_".$_REQUEST["type"]."_".date("YmdHis").".csv";
			$filepath1 = 'cand_files/csv/Candidate/'.$filename1;
			
			if ($isDownload){
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="'.$filename1.'"');
			header('Pragma: no-cache');
			header('Expires: 0');
	
			}
			
			$file = fopen($filepath1, 'w');
	
			$header = array(
				'CanId.',
				'EmpName',
				'EmpOrganization',
				"EmpJobTitle",
				"EmpJobLevel",
				"EmpType",
				"EmpCompany",
				"EmpLocation",
				"EmpLabour",
				"EmpCostCtre",
				"EmpDateBirth",
				"EmpCityBirth",
				"EmpSex",
				"EmpBloodType",
				"EmpCitizen",
				"EmpRace",
				"EmpReligion",
				"EmpMaritalSt",
				"EmpStartDate",
				"EmpSignDate",
				"EmpJoinDate",
				"EmpDecision",
				"EmpCreateDate",
				"EmpDescription",
				"EmpEffecDate",
				"EmpInitiator",
				"EmpDecStart",
				"EmpDecEnd",
				"EmpPhoto",
				"EmpContractStart",
				"EmpContractEnd",
				"EmpSKType",
				"EmpEmail",
				"EmpLocRecruit",
				"EmpWinLogin",
				"EmpWinPassword",
				"EmpWinLoginFlag",
				"SKCostCtre",
				"UserGroup",
				"FgForeignLabor",
				"OUCode",
				"UpdDate",
				"UpdUser",
				"UpdFlag",
				"RefNmbr",
				"EmpResAddr",
				"EmpResCity",
				"EmpResZipCode",
				"EmpResPhone",
				"EmpResStatus",
				"EmpResStart",
				"EmpOriAddr",
				"EmpOriCity",
				"EmpOriZipCode",
				"EmpOriPhone",
				"EmpOriStatus",
				"EmpOriStart",
				"FgStatus",
				"AuthTemp",
				"RejectBy",
				"RejectDesc",
				"ReportTo",
				"EmpLocRecruitCity",
				"EmpValId",
				"EmpValJobTtl",
				"EmpValOrg",
				"EmpApprId",
				"EmpApprJobTtl",
				"EmpApprOrg",
				"RefSource",
				"RefName"
			);
	
			fputcsv($file, $header);
	
			for ($i = 0; $i < count($datacandidate); $i++) {
				// Gender transformation
				$gender = ($datacandidate[$i]["candidate_gender"] == "male") ? "M" : "F";
			
				// Additional Shakti code
				$candidate_homebase = (isset($datacandidate[$i]["candidate_homebase"]) && $datacandidate[$i]["candidate_homebase"] != "" && $datacandidate[$i]["candidate_homebase"] != null) ? $datacandidate[$i]["candidate_homebase"] : "1411";
			
				// Religion transformation
				$agama = null;
				if ($datacandidate[$i]["candidate_religion"] == "Islam") {
					$agama = "ISLAM";
				} else if ($datacandidate[$i]["candidate_religion"] == "Roman Catholic") {
					$agama = "KATHOLIK";
				} else if ($datacandidate[$i]["candidate_religion"] == "Protestant") {
					$agama = "KRISTEN";
				} else if ($datacandidate[$i]["candidate_religion"] == "Hindu") {
					$agama = "HINDU";
				} else if ($datacandidate[$i]["candidate_religion"] == "Budhist") {
					$agama = "BUDDHA";
				} else if ($datacandidate[$i]["candidate_religion"] == "Confucianism") {
					$agama = "KONG HU CU";
				} else {
					$agama = "LAINNYA";
				}
			
				// Marital status transformation
				$statusnikah = null;
				if ($datacandidate[$i]["candidate_marital"] == "Single") {
					$statusnikah = "BELUM NIKAH";
				}
				if ($datacandidate[$i]["candidate_marital"] == "Married") {
					$statusnikah = "NIKAH";
				}
				if (($datacandidate[$i]["candidate_marital"] == "Divorce" || $datacandidate[$i]["candidate_marital"] == "Separated") && $gender == "M") {
					$statusnikah = "DUDA";
				}
				if (($datacandidate[$i]["candidate_marital"] == "Divorce" || $datacandidate[$i]["candidate_marital"] == "Separated") && $gender == "F") {
					$statusnikah = "JANDA";
				}
			
				// Nationality transformation
				$warganegara = ($datacandidate[$i]["candidate_nationality"] == 'wni') ? 'INA' : 'WNA';
			
				// City code transformations
				$pcity = (isset($datacandidate[$i]["candidate_p_city"]) && $datacandidate[$i]["candidate_p_city"] != "") ? getCityCode($datacandidate[$i]["candidate_p_city"]) : "NULL";
				$ccity = (isset($datacandidate[$i]["candidate_c_city"]) && $datacandidate[$i]["candidate_c_city"] != "") ? getCityCode($datacandidate[$i]["candidate_c_city"]) : "NULL";
				$birthplace=(isset($datacandidate[$i]["candidate_birthplace"]) && $datacandidate[$i]["candidate_birthplace"]!="")?getCityCode($datacandidate[$i]["candidate_birthplace"]):"NULL";

				switch ($datacandidate[$i]["job_vacancy_type"]) {
					case "Daily Worker":
						$emptype="DAILY WORKER";
						break;
					case "Internship":
						$emptype="MAGANG";
						break;
					case "Contract":
						$emptype="KONTRAK";
						break;
					case "Permanent":
						$emptype="TETAP";
						break;
					case "Contract Retirement":
						$emptype="KONTRAK PENSIUN";
						break;
					case "M T P":
						$emptype="M T P";
						break;
					case "Probation":
						$emptype="PERCOBAAN";
						break;
					case "LAKU PANDAI":
						$emptype="LAKU PANDAI";
						break;						
					default:
						$emptype="DAILY WORKER";
				 }
				 
			
			
			foreach ($datacandidate as $row) {
				$csvData = array(
					$row["candidate_id"],
					$row["candidate_name"],
					$row["OrgCode"],
					$row["JobTtlCode"],
					$row["job_vacancy_grade"],
					$emptype,
					"HHPR",
					$row["LocationCode"],
					"NULL",
					"costcenter",
					$row["candidate_birthdate"],
					$birthplace,
					$gender,
					$row["candidate_bloodtype"],
					$warganegara,
					$row["candidate_race"],
					$agama,
					$statusnikah,
					$row["ContractStart"],
					$row["ContractStart"],
					$row["ContractStart"],
					"NULL",
					$row["ContractStart"],
					"NULL",
					$row["ContractStart"],
					$row["employee_nik"],
					$row["ContractStart"],
					"NULL",
					"NULL",
					$row["ContractStart"],
					$row["ContractEnd"],
					'rekrut',
					$row["candidate_email"],
					"901",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					$warganegara=="INA",
					"NULL",
					date("Y-m-d H:i:s"),
					$recruit_pic,
					"Y",
					"NULL",
					$row["candidate_c_address"],
					$ccity,
					$row["candidate_c_postcode"],
					$row["candidate_hp1"],
					"NULL",
					"NULL",
					$row ["candidate_p_address"],	
					$pcity,
					$row["candidate_p_postcode"],
					$candidate_homebase,
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					$candidate_homebase,
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
					"NULL",
				);		
			}
	
				fputcsv($file, $csvData);

			}
	
			fclose($file);
			if ($isDownload) { 
			exit();
			}
		}
	}

	// // CANDIDATE EDUCATION
	// function adm_exportCsvEduForProint ($isDownload = true)
	// {
	// 	if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
	// 		$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
	// 		$datacandidate = export_DataCandidateJoin();
	// 		$dataedu = export_DataEdu();


	// 		$filename2 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Education" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	// 		$filepath2 = 'cand_files/csv/CanEdu/' . $filename2;

	// 		$file = fopen($filepath2, 'w');

	// 		// Write the column headers
	// 		$headers = array(
	// 			'CanId.',
	// 			'EmpEduStatus',
	// 			'EmpEduSeq',
	// 			'EmpEduLevel',
	// 			'EmpEduMajor',
	// 			'EmpEduName',
	// 			'EmpEduIns',
	// 			'EmpEduCity',
	// 			'EmpEduGraduate',
	// 			'EmpEduGrade',
	// 			'EmpEduResult',
	// 			'EmpEduFrontTitle',
	// 			'EmpEduEndTitle',
	// 			'FgDefault',
	// 			'UpdDate',
	// 			'UpdUser',
	// 			'UpdFlag'
	// 		);
	// 		fputcsv($file, $headers);

	// 		// Ambil data edu sesuai dengan list candidate_id nya
	// 		foreach ($datacandidate as $candidate) {
	// 			$dataedu = export_DataEduRev($candidate["candidate_id"]);
	// 			$k = 0;

	// 			foreach ($dataedu as $edu) {
	// 				$lastedu = "N";
	// 				$k++;

	// 				switch ($edu["candidate_edu_degree"]) {
	// 					case "Doctoral - S3":
	// 						$degree = "S3";
	// 						break;
	// 					case "Master - S2":
	// 						$degree = "S2";
	// 						break;
	// 					case "Bachelor - S1":
	// 						$degree = "S1";
	// 						break;
	// 					case "Diploma":
	// 						$degree = "D3";
	// 						break;
	// 					case "Highschool - SMA":
	// 						$degree = "SLTA";
	// 						break;
	// 					case "Junior Highschool - SMP":
	// 						$degree = "SLTP";
	// 						break;
	// 					case "Elementary - SD":
	// 						$degree = "SD";
	// 						break;
	// 					default:
	// 						$degree = "SLTA";
	// 				}

	// 				if ($k === 1) {
	// 					$lastedu = "Y";
	// 				}

	// 				$rowData = array(
	// 					$edu["candidate_id"],
	// 					"F",
	// 					$k,
	// 					$degree,
	// 					strtoupper(isset($edu["candidate_edu_major"]) && $edu["candidate_edu_major"] !== "" ? $edu["candidate_edu_major"] : "NULL"),
	// 					"NULL",
	// 					strtoupper(isset($edu["candidate_edu_institution"]) && $edu["candidate_edu_institution"] !== "" ? $edu["candidate_edu_institution"] : "NULL"),
	// 					strtoupper(isset($edu["candidate_edu_city"]) && $edu["candidate_edu_city"] !== "" ? getCityCode($edu["candidate_edu_city"]) : $edu["candidate_edu_city"]),
	// 					$edu["candidate_edu_end"],
	// 					$edu["candidate_edu_gpa"],
	// 					"BERIJAZAH",
	// 					"NULL",
	// 					"NULL",
	// 					$lastedu,
	// 					$edu["date_update"],
	// 					$recruit_pic,
	// 					"Y"
	// 				);
	// 				fputcsv($file, $rowData);
	// 			}
	// 		}
	// 		fclose($file);

	// 		// Download the CSV file
	// 		if ($isDownload) {
	// 		header('Content-Type: text/csv');
	// 		header('Content-Disposition: attachment; filename="' . $filename2 . '"');
	// 		header('Pragma: no-cache');
	// 		header('Expires: 0');
	// 		readfile($filepath2);
	// 		exit();
	// 		}
			
	// 	}
	// }

	function adm_exportCsvEduForProint($isDownload = true)
	{
		if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
			$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
			$datacandidate = export_DataCandidateJoin();
			$processedEdu = array(); // Array to keep track of processed education records
	
			$filename2 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Education" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
			$filepath2 = 'cand_files/csv/CanEdu/' . $filename2;
	
			$file = fopen($filepath2, 'w');
	
			// Write the column headers
			$headers = array(
				'CanId.',
				'EmpEduStatus',
				'EmpEduSeq',
				'EmpEduLevel',
				'EmpEduMajor',
				'EmpEduName',
				'EmpEduIns',
				'EmpEduCity',
				'EmpEduGraduate',
				'EmpEduGrade',
				'EmpEduResult',
				'EmpEduFrontTitle',
				'EmpEduEndTitle',
				'FgDefault',
				'UpdDate',
				'UpdUser',
				'UpdFlag'
			);
			fputcsv($file, $headers);
	
			foreach ($datacandidate as $candidate) {
				$dataedu = export_DataEduRev($candidate["candidate_id"]);
	
				foreach ($dataedu as $edu) {
					$EduKey = $candidate["candidate_id"] . '_' . $edu["candidate_edu_major"];
	
					if (!isset($processedEdu[$EduKey])) {
						$degree = "SLTA"; // Default value for degree
	
						switch ($edu["candidate_edu_degree"]) {
							case "Doctoral - S3":
								$degree = "S3";
								break;
							case "Master - S2":
								$degree = "S2";
								break;
							case "Bachelor - S1":
								$degree = "S1";
								break;
							case "Diploma":
								$degree = "D3";
								break;
							case "Highschool - SMA":
								$degree = "SLTA";
								break;
							case "Junior Highschool - SMP":
								$degree = "SLTP";
								break;
							case "Elementary - SD":
								$degree = "SD";
								break;
							// Add more cases for other education levels if needed
						}
	
						$rowData = array(
							$edu["candidate_id"],
							"F",
							1, // Set EmpEduSeq to 1 as we are only printing one education record for each candidate
							$degree,
							strtoupper(isset($edu["candidate_edu_major"]) && $edu["candidate_edu_major"] !== "" ? $edu["candidate_edu_major"] : "NULL"),
							"NULL",
							strtoupper(isset($edu["candidate_edu_institution"]) && $edu["candidate_edu_institution"] !== "" ? $edu["candidate_edu_institution"] : "NULL"),
							strtoupper(isset($edu["candidate_edu_city"]) && $edu["candidate_edu_city"] !== "" ? getCityCode($edu["candidate_edu_city"]) : $edu["candidate_edu_city"]),
							$edu["candidate_edu_end"],
							$edu["candidate_edu_gpa"],
							"BERIJAZAH",
							"NULL",
							"NULL",
							"Y", // Set EmpEduFrontTitle to "Y" for the first education record
							$edu["date_update"],
							$recruit_pic,
							"Y"
						);
						fputcsv($file, $rowData);
	
						$processedEdu[$EduKey] = true; // Mark the education record as processed
					}
				}
			}
	
			fclose($file);
	
			// Download the CSV file
			if ($isDownload) {
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="' . $filename2 . '"');
				header('Pragma: no-cache');
				header('Expires: 0');
				readfile($filepath2);
				exit();
			}
		}
	}
	
	
	



	// FAMILY CANDIDATE
	// function adm_exportCsvFamForProint($isDownload=true)
	// {
	// 	if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
	// 		$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
	// 		$datacandidate = export_DataCandidateJoin();

	// 		$filename3 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Family" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	// 		$filepath3 = 'cand_files/csv/CanFamily/' . $filename3;

	// 		$file = fopen($filepath3, 'w');

	// 		// Write the column headers
	// 		$headers = array(
	// 			"CanId.","EmpFamRelation","EmpFamName","EmpFamEmpId","EmpFamCityBirth","EmpFamDateBrith","EmpFamSex","EmpFamAddress","EmpFamResAddr","EmpFamPhone","EmpFamHp","EmpFamIdCard","EmpFamEdu","EmpFamEduIns",
	// 			"EmpFamOccupation","EmpFamComp","EmpCompAddr","EmpFamAlive","EmpFamNo","MaritalSt","EmpFamMaritalDate","EmploymentSt","FgMedical","FgSchool","EmpPTKP","UpdDate","UpdUser","UpdFlag"
	// 		);
	// 		fputcsv($file, $headers);

	// 		$rows=1;	
	// 		for($j=0;$j<count($datacandidate);$j++)
	// 		{
	// 			$datafam=export_DataFamRev($datacandidate[$j]["candidate_id"]);
	// 			$kakak=0;
	// 			$adik=0;
	// 			$anak=0;
	// 			for($i=0;$i<count($datafam);$i++) {
	// 				$rows++;
					
	// 				switch ($datafam[$i]["candidate_family_lastedu"]) {
	// 					case "Doctoral - S3":
	// 						$degree="S3";
	// 						break;
	// 					case "Master - S2":
	// 						$degree="S2";
	// 						break;
	// 					case "Bachelor - S1":
	// 						$degree="S1";
	// 						break;
	// 					case "Diploma":
	// 						$degree="D3";
	// 						break;
	// 					case "Highschool - SMA":
	// 						$degree="SLTA";
	// 						break;
	// 					case "Junior Highschool - SMP":
	// 						$degree="SLTP";
	// 						break;
	// 					case "Elementary - SD":
	// 						$degree="SD";
	// 						break;
	// 					default:
	// 						$degree="SLTA";
	// 				}
					
	// 				//cek jenis kelamin candidate
					// $candidatesex=getCandidateSex($datafam[$i]["candidate_id"]);
					// $candidatedob=getCandidateDob($datafam[$i]["candidate_id"]);
					
													
					// if($candidatesex=="M" && $datafam[$i]["candidate_family_relation"]=="Spouse") 
					// {
					// 	$fmrelation="ISTRI";
					// 	$fmsex="F";
					// }
					// if($candidatesex=="F" && $datafam[$i]["candidate_family_relation"]=="Spouse") 
					// {
					// 	$fmrelation="SUAMI";
					// 	$fmsex="M";
					// }
					// if($candidatedob>$datafam[$i]["candidate_family_birthdate"] && $datafam[$i]["candidate_family_relation"]!="Spouse" && $datafam[$i]["candidate_family_relation"]!="Father" && $datafam[$i]["candidate_family_relation"]!="Mother" && $datafam[$i]["candidate_family_relation"]!="Son" && $datafam[$i]["candidate_family_relation"]!="Daughter") 
					// {
					// 	$kakak++;
					// 	$fmrelation="KAKAK KE-".$kakak;
					// }
					// if($candidatedob<=$datafam[$i]["candidate_family_birthdate"] && $datafam[$i]["candidate_family_relation"]!="Spouse" && $datafam[$i]["candidate_family_relation"]!="Father" && $datafam[$i]["candidate_family_relation"]!="Mother" && $datafam[$i]["candidate_family_relation"]!="Son" && $datafam[$i]["candidate_family_relation"]!="Daughter") 
					// {
					// 	$adik++;
					// 	$fmrelation="ADIK KE-".$adik;
					// }
					// if($datafam[$i]["candidate_family_relation"]=="Son" || $datafam[$i]["candidate_family_relation"]=="Daughter")
					// {
					// 	$anak++;
					// 	$fmrelation="ANAK KE-".$anak;
					// }
					// if($datafam[$i]["candidate_family_relation"]=="Father")
					// {
					// 	$fmrelation="AYAH";
					// }
					// if($datafam[$i]["candidate_family_relation"]=="Mother")
					// {
					// 	$fmrelation="IBU";
					// } else {
					// 	"NULL";
					// }
					
					// if($datafam[$i]["candidate_family_relation"]=="Brother" || $datafam[$i]["candidate_family_relation"]=="Son" || $datafam[$i]["candidate_family_relation"]=="Father")
					// {
					// 	$fmsex="M";
					// }
					// if($datafam[$i]["candidate_family_relation"]=="Sister" || $datafam[$i]["candidate_family_relation"]=="Daughter" || $datafam[$i]["candidate_family_relation"]=="Mother")
					// {
					// 	$fmsex="F";
					// }
										
					
	// 				$rowData = array(
	// 					$datafam[$i]["candidate_id"],
	// 					$fmrelation,
	// 					strtoupper($datafam[$i]["candidate_family_name"]),
	// 					"NULL",
	// 					$datafam[$i]["candidate_family_birthplace"],
	// 					$datafam[$i]["candidate_family_birthdate"],
	// 					$fmsex,
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					$degree,
	// 					"NULL",
	// 					strtoupper($datafam[$i]["candidate_family_lastjob"]),
	// 					strtoupper($datafam[$i]["candidate_family_company"]),
	// 					"NULL",
	// 					(isset($datafam[$i]["candidate_family_rip"]) && $datafam[$i]["candidate_family_rip"] == "Alive") ? "Y" : "N",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					"NULL",
	// 					$datafam[$i]["date_update"],
	// 					$recruit_pic,
	// 					"Y"
	// 				);
	// 				fputcsv($file, $rowData);
	// 			}
	// 		}

	// 		fclose($file);

	// 		// Download the CSV file
			
	// 		if ($isDownload) {
	// 			header('Content-Type: text/csv');
	// 			header('Content-Disposition: attachment; filename="' . $filename3 . '"');
	// 			header('Pragma: no-cache');
	// 			header('Expires: 0');
	// 			readfile($filepath3);
	// 			exit();
	// 			}
	// 	}
	// }

	function adm_exportCsvFamForProint($isDownload = true)
	{
		if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
			$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
			$datacandidate = export_DataCandidateJoin();
	
			$filename3 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Family" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
			$filepath3 = 'cand_files/csv/CanFamily/' . $filename3;
	
			$file = fopen($filepath3, 'w');
	
			// Write the column headers
			$headers = array(
				"CanId.", "EmpFamRelation", "EmpFamName", "EmpFamEmpId", "EmpFamCityBirth", "EmpFamDateBrith", "EmpFamSex", "EmpFamAddress", "EmpFamResAddr", "EmpFamPhone", "EmpFamHp", "EmpFamIdCard", "EmpFamEdu", "EmpFamEduIns",
				"EmpFamOccupation", "EmpFamComp", "EmpCompAddr", "EmpFamAlive", "EmpFamNo", "MaritalSt", "EmpFamMaritalDate", "EmploymentSt", "FgMedical", "FgSchool", "EmpPTKP", "UpdDate", "UpdUser", "UpdFlag"
			);
			fputcsv($file, $headers);
	
			$processedFamIDs = array(); // Array to keep track of processed family members
	
			foreach ($datacandidate as $candidate) {
				$datafam = export_DataFamRev($candidate["candidate_id"]);
	
				foreach ($datafam as $fam) {
					$famKey = $fam["candidate_family_id"]; // Use the family member ID as the key
	
					if (!in_array($famKey, $processedFamIDs)) {
						$degree = "SLTA"; // Default value for degree
	
						switch ($fam["candidate_family_lastedu"]) {
							case "Doctoral - S3":
								$degree = "S3";
								break;
							case "Master - S2":
								$degree = "S2";
								break;
							case "Bachelor - S1":
								$degree = "S1";
								break;
							case "Diploma":
								$degree = "D3";
								break;
							case "Highschool - SMA":
								$degree = "SLTA";
								break;
							case "Junior Highschool - SMP":
								$degree = "SLTP";
								break;
							case "Elementary - SD":
								$degree = "SD";
								break;
						}
	
						// Rest of the family relation handling logic remains unchanged
					$candidatesex=getCandidateSex($fam["candidate_id"]);
					$candidatedob=getCandidateDob($fam["candidate_id"]);
					
													
					if($candidatesex=="M" && $fam["candidate_family_relation"]=="Spouse") 
					{
						$fmrelation="ISTRI";
						$fmsex="F";
					}
					if($candidatesex=="F" && $fam["candidate_family_relation"]=="Spouse") 
					{
						$fmrelation="SUAMI";
						$fmsex="M";
					}
					if($candidatedob>$fam["candidate_family_birthdate"] && $fam["candidate_family_relation"]!="Spouse" && $fam["candidate_family_relation"]!="Father" && $fam["candidate_family_relation"]!="Mother" && $fam["candidate_family_relation"]!="Son" && $fam["candidate_family_relation"]!="Daughter") 
					{
						$kakak = '';
						$kakak++;

						$fmrelation="KAKAK KE-".$kakak;
					}
					if($candidatedob<=$fam["candidate_family_birthdate"] && $fam["candidate_family_relation"]!="Spouse" && $fam["candidate_family_relation"]!="Father" && $fam["candidate_family_relation"]!="Mother" && $fam["candidate_family_relation"]!="Son" && $fam["candidate_family_relation"]!="Daughter") 
					{
						$adik++;
						$fmrelation="ADIK KE-".$adik;
					}
					if($fam["candidate_family_relation"]=="Son" || $fam["candidate_family_relation"]=="Daughter")
					{
						$anak++;
						$fmrelation="ANAK KE-".$anak;
					}
					if($fam["candidate_family_relation"]=="Father")
					{
						$fmrelation="AYAH";
					}
					if($fam["candidate_family_relation"]=="Mother")
					{
						$fmrelation="IBU";
					} else {
						"NULL";
					}
					
					if($fam["candidate_family_relation"]=="Brother" || $fam["candidate_family_relation"]=="Son" || $fam["candidate_family_relation"]=="Father")
					{
						$fmsex="M";
					}
					if($fam["candidate_family_relation"]=="Sister" || $fam["candidate_family_relation"]=="Daughter" || $fam["candidate_family_relation"]=="Mother")
					{
						$fmsex="F";
					}
	
						$rowData = array(
							$fam["candidate_id"],
							$fmrelation,
							strtoupper($fam["candidate_family_name"]),
							"NULL",
							$fam["candidate_family_birthplace"],
							$fam["candidate_family_birthdate"],
							$fmsex,
							"NULL",
							"NULL",
							"NULL",
							"NULL",
							"NULL",
							$degree,
							"NULL",
							strtoupper($fam["candidate_family_lastjob"]),
							strtoupper($fam["candidate_family_company"]),
							"NULL",
							(isset($fam["candidate_family_rip"]) && $fam["candidate_family_rip"] == "Alive") ? "Y" : "N",
							"NULL",
							"NULL",
							"NULL",
							"NULL",
							"NULL",
							"NULL",
							"NULL",
							$fam["date_update"],
							$recruit_pic,
							"Y"
						);
						fputcsv($file, $rowData);
	
						$processedFamIDs[] = $famKey; // Add the family member ID to the processed array
					}
				}
			}
	
			fclose($file);
	
			// Download the CSV file
			if ($isDownload) {
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="' . $filename3 . '"');
				header('Pragma: no-cache');
				header('Expires: 0');
				readfile($filepath3);
				exit();
			}
		}
	}
	


	function adm_exportCsvJobForProint($isDownload = true)
	{
		if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
			$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
			$datacandidate = export_DataCandidateJoin();
	
			$filename4 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Experience" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
			$filepath4 = 'cand_files/csv/CanExperience/' . $filename4;
	
			$file = fopen($filepath4, 'w');
	
			// Write the column headers
			$headers = array(
				'CanId.',
				'Sequence',
				'CompanyName',
				'CompanyAddress',
				'CompanyCity',
				'CompanyZipCode',
				'CompanyPhone',
				'JobStart',
				'JobEnd',
				'JobTitle',
				'SalaryStart',
				'SalaryEnd',
				'TerminationReason',
				'UpdDate',
				'UpdUser',
				'UpdFlag',
				'Description',
				'FgCase',
				'Performance',
				'SprName',
				'SprPhone',
			);
			fputcsv($file, $headers);
	
			$processedJobExp = array(); // Array untuk menyimpan informasi pengalaman kerja yang sudah diproses
	
			foreach ($datacandidate as $candidate) {
				$datajobexp = export_DataJobRev($candidate["candidate_id"]);
				foreach ($datajobexp as $jobexp) {
					$jobExpKey = $candidate["candidate_id"] . '_' . $jobexp["candidate_jobexp_id"];
					
					// Periksa apakah pengalaman kerja sudah diproses sebelumnya
					if (!isset($processedJobExp[$jobExpKey])) {
						$rowData = array(
							$candidate["candidate_id"],
							"",
							$jobexp["candidate_jobexp_company"],
							$jobexp["candidate_jobexp_address"],
							"",
							"",
							$jobexp["candidate_jobexp_phone"],
							$jobexp["candidate_jobexp_start"],
							$jobexp["candidate_jobexp_end"],
							$jobexp["candidate_jobexp_spvposition"],
							"",
							$jobexp["candidate_jobexp_salary"],
							$jobexp["candidate_jobexp_leaving"],
							"",
							$jobexp["date_update"],
							$jobexp["user_update"],
							"",
							$jobexp["candidate_jobexp_desc"],
							"",
							"",
							$jobexp["candidate_jobexp_spvname"],
							""
						);
						fputcsv($file, $rowData);
	
						// Tandai pengalaman kerja sebagai sudah diproses
						$processedJobExp[$jobExpKey] = true;
					}
				}
			}
	
			fclose($file);
	
			// Download the CSV file
			if ($isDownload) {
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="' . $filename4 . '"');
				header('Pragma: no-cache');
				header('Expires: 0');
				readfile($filepath4);
				exit();
			}
		}
	}
	
	
	

// ID CARD CANDIDATE
function adm_exportCsvIDCardForProint($isDownload=true)
{
	if (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") {
		$recruit_pic = getRecruiterPic($_SESSION["log_auth_id"]);
		$datacandidate = export_DataCandidateJoin();
		$dataedu = export_DataEdu();

		$filename5 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_IDCard" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath5 = 'cand_files/csv/CanIDCard/' . $filename5;

		$file = fopen($filepath5, 'w');

		// Write the column headers
		$headers = array(
			"EmpId.",
			'EmpCardType',
			'EmpCardNumber',
			'EmpCardPublisher',
			'EmpCardExpired',
			'UpdDate',			
			'UpdUser',
			'UpdFlag',			
			'CardDesc',			
		);
		fputcsv($file, $headers);

		$rows = 1;
		$csvData = array();
		
		for ($i = 0; $i < count($datacandidate); $i++) {
			$rows++;
		
			$rowData = array(
				$datacandidate[$i]["candidate_id"],
				$datacandidate[$i]["candidate_idtype"],
				$datacandidate[$i]["candidate_idcard"],
				"NULL",
				"NULL",
				$datacandidate[$i]["date_update"],
				$recruit_pic,
				"Y",
				"NULL"
			);
				fputcsv($file, $rowData);
			}

		fclose($file);

		// Download the CSV file
		if ($isDownload) {
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename5 . '"');
			header('Pragma: no-cache');
			header('Expires: 0');
			readfile($filepath5);
			exit();
			}
	}
}

function createZipFile() {
	$zip = new ZipArchive();
	$zipFilename = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") ? "Candidate_Zip".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".zip" : "candidate_".$_REQUEST["type"]."_".date("YmdHis").".zip";
	$tempZipFilename = $zipFilename;

	$filename1 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") ? "Candidate_Data".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".csv" : "candidate_".$_REQUEST["type"]."_".date("YmdHis").".csv";
	$filepath1 = 'cand_files/csv/Candidate/'.$filename1;

	$filename2 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Education" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	$filepath2 = 'cand_files/csv/CanEdu/' . $filename2;

	$filename3 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Family" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	$filepath3 = 'cand_files/csv/CanFamily/' . $filename3;

	$filename4 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Experience" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	$filepath4 = 'cand_files/csv/CanExperience/' . $filename4;

	$filename5 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_IDCard" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	$filepath5 = 'cand_files/csv/CanIDCard/' . $filename5;
	
	adm_exportCsvDataForProint(false);
	adm_exportCsvEduForProint(false);
	adm_exportCsvFamForProint(false);
	adm_exportCsvJobForProint(false);
	adm_exportCsvIDCardForProint(false);

	if ($zip->open($tempZipFilename, ZipArchive::CREATE) === true) {
		// Add the CSV files to the ZIP
		$zip->addFile($filepath1, $filename1);
		$zip->addFile($filepath2, $filename2); 
		$zip->addFile($filepath3, $filename3);
		$zip->addFile($filepath4, $filename4);
		$zip->addFile($filepath5, $filename5);

		$zip->close();

		// Move the temporary ZIP file to a publicly accessible directory
		rename($tempZipFilename, "public_folder/" . $zipFilename);

		// Set headers to download the ZIP file
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
		header('Pragma: no-cache');
		header('Expires: 0');

		// Output the contents of the ZIP file
		readfile("public_folder/" . $zipFilename);
		exit();
	} else {
		echo "Failed to create ZIP file.";
	}
}

function conn(){
	$serverName = "REHANG\\SQLEXPRESS";
	$database = "TestHyper";
	$uid = "";
	$pwd = "";

	$connOptions = array(
		"Database" => $database,
		"UID" => $uid,
		"PWD" => $pwd
	);
	$conn = sqlsrv_connect($serverName, $connOptions);
	if ($conn === false) {
		die("Connection failed: " . print_r(sqlsrv_errors(), true));
	} else {
		echo('koneksi berhasil');
	}
	return $conn;
}

function ImportIDCard() {
	$conn = conn();

	// Validasi input
	$candidate_id = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? $_REQUEST["candidate_id"] : null;
	$type = (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") ? $_REQUEST["type"] : null;

	if (!$candidate_id || !$type) {
		die("Invalid input data.");
	}

	// Generate file name
	$filename5 = "Candidate_IDCard{$type}_" . date("YmdHis") . "_{$candidate_id}.csv";
	$filepath5 = 'cand_files/csv/CanIDCard/' . $filename5;

	$file_handle = fopen($filepath5, "r");
	// $contents = fread($file_handle, filesize($filepath5));
	// $test = str_getcsv($contents, ",", "\n");
	// echo($test[0]);exit;

	if (!$file_handle) {
		die("Failed to open CSV file.");
	}

	// Read the first (and only) row from the CSV file
	// $column = fgetcsv($file_handle);
	$out = array();
	while ($line = fgetcsv($file_handle)) {
		$out = $line;
	}
	
	fclose($file_handle);

	$EmpId = (int) $out[0];
	// echo($EmpId);exit;
	$EmpCardType = $out[1];
	$EmpCardNumber = (int) $out[2]; // Convert to integer
	$EmpCardPublisher = $out[3];
	$EmpCardExpired = date("Y-m-d H:i:s", strtotime($out[4]));
	$UpdDate = date("Y-m-d H:i:s", strtotime($out[5])); // Convert to date format
	$UpdUser = $out[6];
	$UpdFlag = (int) $out[7]; // Convert to integer
	$CardDesc = $out[8];

	// Prepare and execute the SQL query using prepared statement
	$sql = "INSERT INTO dbo.Kartu (EmpId, EmpCardType, EmpCardNumber, EmpCardPublisher, EmpCardExpired, UpdDate, UpdUser, UpdFlag, CardDesc) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$params = array($EmpId, $EmpCardType, $EmpCardNumber, $EmpCardPublisher, $EmpCardExpired, $UpdDate, $UpdUser, $UpdFlag, $CardDesc);

	$stmt = sqlsrv_prepare($conn, $sql, $params);

	if ($stmt === false) {
		die(print_r(sqlsrv_errors(), true));
	}

	if (sqlsrv_execute($stmt)) {
		echo 'Data imported successfully!';
	} else {
		echo 'Failed to import data: ' . print_r(sqlsrv_errors(), true);
		echo '<br>';
		echo 'Problematic Row Data: ' . print_r($out, true);
	}
}
	
// Function to import education data from CSV file
function ImportEdu()
{
    $conn = conn();
    $filename2 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Education" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
    $filepath2 = 'cand_files/csv/CanEdu/' . $filename2;

    $file = $filepath2;
    $file_handle = fopen($file, "r");

    $headerSkipped = false; // Flag to skip the first row (header) in the CSV

    while ($line = fgetcsv($file_handle)) {
        if (!$headerSkipped) {
            $headerSkipped = true;
            continue; // Skip the header row
        }

        $out = $line;

        $CanId = (int) $out[0];
        $EmpEduStatus = $out[1];
        $EmpEduSeq = $out[2]; // Convert to integer
        $EmpEduLevel = $out[3];
        $EmpEduMajor =  $out[4];
        $EmpEduName = $out[5]; // Convert to date format
        $EmpEduIns = $out[6];
        $EmpEduCity = (int) $out[7]; // Convert to integer
        $EmpEduGraduate = (int) $out[8];
        $EmpEduGrade = (float) $out[9];
        $EmpEduResult = $out[10];
        $EmpEduFrontTitle = $out[11]; // Convert to integer
        $EmpEduEndTitle = $out[12];
        $FgDefault = (int) $out[13];
        $UpdDate = date("Y-m-d H:i:s", strtotime($out[14]));
        $UpdUser = $out[15]; // Convert to integer
        $UpdFlag = $out[16];

        $sql = "INSERT INTO dbo.Edukasi (CanId, EmpEduStatus, EmpEduSeq, EmpEduLevel, EmpEduMajor, EmpEduName, EmpEduIns, EmpEduCity, EmpEduGraduate, EmpEduGrade, EmpEduResult, EmpEduFrontTitle, EmpEduEndTitle, FgDefault, UpdDate, UpdUser, UpdFlag) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($CanId, $EmpEduStatus, $EmpEduSeq, $EmpEduLevel, $EmpEduMajor, $EmpEduName, $EmpEduIns, $EmpEduCity, $EmpEduGraduate, $EmpEduGrade, $EmpEduResult, $EmpEduFrontTitle, $EmpEduEndTitle, $FgDefault, $UpdDate, $UpdUser, $UpdFlag);

        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            echo 'Data imported successfully!';
        } else {
            echo 'Failed to import data: ' . print_r(sqlsrv_errors(), true);
            echo '<br>';
            echo 'Problematic Row Data: ' . print_r($out, true);
        }
    }

    fclose($file_handle);
}



function ImportExp() {
	$conn = conn();
	$filename4 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Experience" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
	$filepath4 = 'cand_files/csv/CanExperience/' . $filename4;
    $file = $filepath4;
    $file_handle = fopen($file, "r");

    $headerSkipped = false; // Flag to skip the first row (header) in the CSV

    while ($line = fgetcsv($file_handle)) {
        if (!$headerSkipped) {
            $headerSkipped = true;
            continue; // Skip the header row
        }
		
		$out = $line;

            $CanId = (int) $out[0];
            $Sequence = $out[1];
            $CompanyName = $out[2];
            $CompanyAddress = $out[3];
            $CompanyCity =  $out[4];
            $CompanyZipCode = (int) $out[5];
            $CompanyPhone = (int) $out[6];
            $JobStart = date("Y-m-d H:i:s", strtotime($out[7]));
            $JobEnd = date("Y-m-d H:i:s", strtotime($out[8]));
            $JobTitle = $out[9];
            $SalaryStart = (float) $out[10];
            $SalaryEnd = (float) $out[11];
            $TerminationReason = $out[12];
            $UpdDate = date("Y-m-d H:i:s", strtotime($out[13]));
            $UpdUser = date("Y-m-d H:i:s", strtotime($out[14]));
            $UpdFlag = (int) $out[15];
            $Description = $out[16];
            $FgCase = $out[17];
            $Performance = $out[18];
            $SprName = $out[19];
            $SprPhone = (int) $out[20];
    
            $sql = "INSERT INTO dbo.Pengalaman (CanId, Sequence, CompanyName, CompanyAddress, CompanyCity, CompanyZipCode, CompanyPhone, JobStart, JobEnd, JobTitle, SalaryStart, SalaryEnd, TerminationReason, UpdDate, UpdUser, UpdFlag, Description, FgCase, Performance, SprName, SprPhone) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            $params = array(
                $CanId, $Sequence, $CompanyName, $CompanyAddress, $CompanyCity, $CompanyZipCode, $CompanyPhone, $JobStart, $JobEnd,
                $JobTitle, $SalaryStart, $SalaryEnd, $TerminationReason, $UpdDate, $UpdUser, $UpdFlag, $Description, $FgCase, $Performance, $SprName, $SprPhone
            );
    
            $stmt = sqlsrv_prepare($conn, $sql, $params);
    
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            if (sqlsrv_execute($stmt)) {
                echo 'Data imported successfully!';
            } else {
                echo 'Failed to import data: ' . print_r(sqlsrv_errors(), true);
                echo '<br>';
                echo 'Problematic Row Data: ' . print_r($out, true);
            }
		}
        fclose($file_handle);
}

    function ImportFam() {
		$conn = conn();

		$filename3 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Family" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath3 = 'cand_files/csv/CanFamily/' . $filename3;
        $file = $filepath3;
        $file_handle = fopen($file, "r");
		$out = array();

		$headerSkipped = false; 

		while ($line = fgetcsv($file_handle)) {
			if (!$headerSkipped) {
				$headerSkipped = true;
				continue; // Skip the header row
			}
			
			$out = $line;

		for($i = 0; $i < 5 ; $i++) {
			$CanId = (int) $out[0];
			$EmpFamRelation = $out[1];
			$EmpFamName = $out[2];
			$EmpFamEmpId = (int) $out[3];
			$EmpFamCityBirth =  $out[4];
			$EmpFamDateBrith = date("Y-m-d H:i:s", strtotime($out[5]));
			$EmpFamSex = $out[6];
			$EmpFamAddress = $out[7];
			$EmpFamResAddr = $out[8];
			$EmpFamPhone = (int) $out[9];
			$EmpFamHp = (int) $out[10];
			$EmpFamIdCard = (int) $out[11];
			$EmpFamEdu = $out[12];
			$EmpFamEduIns = $out[13];
			$EmpFamOccupation = $out[14];
			$EmpFamComp = $out[15];
			$EmpCompAddr = $out[16];
			$EmpFamAlive = $out[17];
			$EmpFamNo = (int) $out[18];
			$MaritalSt = $out[19];
			$EmpFamMaritalDate = $out[20];
			$EmploymentSt = $out[21];
			$FgMedical = $out[22];
			$FgSchool = $out[23];
			$EmpPTKP = $out[24];
			$UpdDate = date("Y-m-d H:i:s", strtotime($out[25]));
			$UpdUser = $out[26];
			$UpdFlag = $out[27];

			$sql = "INSERT INTO dbo.Keluarga (CanId, EmpFamRelation, EmpFamName, EmpFamEmpId, EmpFamCityBirth, EmpFamDateBrith, EmpFamSex, EmpFamAddress, EmpFamResAddr, EmpFamPhone, EmpFamHp, EmpFamIdCard, EmpFamEdu, EmpFamEduIns, EmpFamOccupation, EmpFamComp, EmpCompAddr, EmpFamAlive, EmpFamNo, MaritalSt, EmpFamMaritalDate, EmploymentSt, FgMedical, FgSchool, EmpPTKP, UpdDate, UpdUser, UpdFlag) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
			$params = array(
				$CanId, $EmpFamRelation, $EmpFamName, $EmpFamEmpId, $EmpFamCityBirth, $EmpFamDateBrith, $EmpFamSex, $EmpFamAddress, $EmpFamResAddr, $EmpFamPhone, $EmpFamHp, $EmpFamIdCard, $EmpFamEdu, $EmpFamEduIns, $EmpFamOccupation, $EmpFamComp, $EmpCompAddr, $EmpFamAlive, $EmpFamNo, $MaritalSt, $EmpFamMaritalDate, $EmploymentSt, $FgMedical, $FgSchool, $EmpPTKP, $UpdDate, $UpdUser, $UpdFlag
			);
		}
	
			$stmt = sqlsrv_prepare($conn, $sql, $params);
	
			if ($stmt === false) {
				die(print_r(sqlsrv_errors(), true));
			}
	
			if (sqlsrv_execute($stmt)) {
				echo 'Data imported successfully!';
			} else {
				echo 'Failed to import data: ' . print_r(sqlsrv_errors(), true);
				echo '<br>';
				echo 'Problematic Row Data: ' . print_r($out, true);
			}
		}

		fclose($file_handle);
    }   


function ImportData() {		
		$conn = conn();
		$filename1 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") ? "Candidate_Data".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".csv" : "candidate_".$_REQUEST["type"]."_".date("YmdHis").".csv";
		
		$filepath1 = 'cand_files/csv/Candidate/'.$filename1;
		
        $file = $filepath1;

        $file_handle = fopen($file, "r");
		$out = array();
		while ($line = fgetcsv($file_handle)) {
		$out = $line;
		}

		fclose($file_handle);
		$CanId = (int) $out[0];
		$EmpName = $out[1];
		$EmpOrganization = $out[2];
		$EmpJobTitle = (int) $out[3];
		$EmpJobLevel = $out[4];
		$EmpType = $out[5];
		$EmpCompany = $out[6];
		$EmpLocation = $out[7];
		$EmpLabour = $out[8];
		$EmpCostCtre = $out[9];
		$EmpDateBirth = date("Y-m-d H:i:s", strtotime($out[10]));
		$EmpCityBirth = (int) $out[11];
		$EmpSex = $out[12];
		$EmpBloodType = $out[13];
		$EmpCitizen = $out[14];
		$EmpRace = $out[15];
		$EmpReligion = $out[16];
		$EmpMaritalSt = $out[17];
		$EmpStartDate = date("Y-m-d H:i:s", strtotime($out[18]));
		$EmpSignDate = date("Y-m-d H:i:s", strtotime($out[19]));
		$EmpJoinDate = date("Y-m-d H:i:s", strtotime($out[20]));
		$EmpDecision = $out[21];
		$EmpCreateDate = date("Y-m-d H:i:s", strtotime($out[22]));
		$EmpDescription = $out[23];
		$EmpEffecDate = date("Y-m-d H:i:s", strtotime($out[24]));
		$EmpInitiator = $out[25];
		$EmpDecStart = date("Y-m-d H:i:s", strtotime($out[26]));
		$EmpDecEnd = date("Y-m-d H:i:s", strtotime($out[27]));
		$EmpPhoto = $out[28];
		$EmpContractStart = date("Y-m-d H:i:s", strtotime($out[29]));
		$EmpContractEnd = date("Y-m-d H:i:s", strtotime($out[30]));
		$EmpSKType = $out[31];
		$EmpEmail = $out[32];
		$EmpLocRecruit = $out[33];
		$EmpWinLogin = $out[34];
		$EmpWinPassword = $out[35];
		$EmpWinLoginFlag = $out[36];
		$SKCostCtre = $out[37];
		$UserGroup = $out[38];
		$FgForeignLabor = $out[39];
		$OUCode = $out[40];
		$UpdDate = date("Y-m-d H:i:s", strtotime($out[41]));
		$UpdUser = $out[41];
		$UpdFlag = $out[42];
		$RefNmbr = $out[43];
		$EmpResAddr = $out[44];
		$EmpResCity = (int) $out[45];
		$EmpResZipCode = (int) $out[46];
		$EmpResPhone = (int) $out[47];
		$EmpResStatus = $out[48];
		$EmpResStart = $out[49];
		$EmpOriAddr = $out[50];
		$EmpOriCity = (int) $out[51];
		$EmpOriZipCode = (int) $out[52];
		$EmpOriPhone = (int) $out[53];
		$EmpOriStatus = $out[54];
		$EmpOriStart = $out[55];
		$FgStatus = $out[56];
		$AuthTemp = $out[57];
		$RejectBy = $out[58];
		$RejectDesc = $out[59];
		$ReportTo = $out[60];
		$EmpLocRecruitCity = $out[61];
		$EmpValId = $out[62];
		$EmpValJobTtl = $out[63];
		$EmpValOrg = $out[64];
		$EmpApprId = $out[65];
		$EmpApprJobTtl = $out[66];
		$EmpApprOrg = $out[67];
		$RefSource = $out[68];
		$RefName = $out[69];
            
            $sql = "INSERT INTO dbo.Data (CanId,EmpName,EmpOrganization,EmpJobTitle,EmpJobLevel,EmpType,EmpCompany,EmpLocation,EmpLabour,EmpCostCtre,EmpDateBirth,EmpCityBirth,EmpSex,EmpBloodType,EmpCitizen,EmpRace,EmpReligion,EmpMaritalSt,EmpStartDate,EmpSignDate,EmpJoinDate,EmpDecision,EmpCreateDate,EmpDescription,EmpEffecDate,EmpInitiator,EmpDecStart,EmpDecEnd,EmpPhoto,EmpContractStart,EmpContractEnd,EmpSKType,EmpEmail,EmpLocRecruit,EmpWinLogin,EmpWinPassword,EmpWinLoginFlag,SKCostCtre,UserGroup,FgForeignLabor,OUCode,UpdDate,UpdUser,UpdFlag,RefNmbr,EmpResAddr,EmpResCity,EmpResZipCode,EmpResPhone,EmpResStatus,EmpResStart,EmpOriAddr,EmpOriCity,EmpOriZipCode,EmpOriPhone,EmpOriStatus,EmpOriStart,FgStatus,AuthTemp,RejectBy,RejectDesc,ReportTo,EmpLocRecruitCity,EmpValId,EmpValJobTtl,EmpValOrg,EmpApprId,EmpApprJobTtl,EmpApprOrg,RefSource,RefName) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            $params = array(
                $CanId,$EmpName,$EmpOrganization,$EmpJobTitle,$EmpJobLevel,$EmpType,$EmpCompany,$EmpLocation,$EmpLabour,$EmpCostCtre,$EmpDateBirth,$EmpCityBirth,$EmpSex,$EmpBloodType,$EmpCitizen,$EmpRace,$EmpReligion,$EmpMaritalSt,$EmpStartDate,$EmpSignDate,$EmpJoinDate,$EmpDecision,$EmpCreateDate,$EmpDescription,$EmpEffecDate,$EmpInitiator,$EmpDecStart,$EmpDecEnd,$EmpPhoto,$EmpContractStart,$EmpContractEnd,$EmpSKType,$EmpEmail,$EmpLocRecruit,$EmpWinLogin,$EmpWinPassword,$EmpWinLoginFlag,$SKCostCtre,$UserGroup,$FgForeignLabor,$OUCode,$UpdDate,$UpdUser,$UpdFlag,$RefNmbr,$EmpResAddr,$EmpResCity,$EmpResZipCode,$EmpResPhone,$EmpResStatus,$EmpResStart,$EmpOriAddr,$EmpOriCity,$EmpOriZipCode,$EmpOriPhone,$EmpOriStatus,$EmpOriStart,$FgStatus,$AuthTemp,$RejectBy,$RejectDesc,$ReportTo,$EmpLocRecruitCity,$EmpValId,$EmpValJobTtl,$EmpValOrg,$EmpApprId,$EmpApprJobTtl,$EmpApprOrg,$RefSource,$RefName
            );
    
            $stmt = sqlsrv_prepare($conn, $sql, $params);
    
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
    
            if (sqlsrv_execute($stmt)) {
                echo 'Data imported successfully!';
            } else {
                echo 'Failed to import data: ' . print_r(sqlsrv_errors(), true);
                echo '<br>';
                echo 'Problematic Row Data: ' . print_r($out, true);
            }
}
	
		// var_dump (admin_getCandidateAll("hired"));exit;
	function executeExportCsvFunctions() {
		adm_exportCsvDataForProint(false);
		adm_exportCsvEduForProint(false);
		adm_exportCsvFamForProint(false);
		adm_exportCsvJobForProint(false);
		adm_exportCsvIDCardForProint(false);
	}

	function ImportSqlServer() {
		ImportData();
		ImportEdu();
		ImportExp();
		ImportFam();
		ImportIDCard();
	}

	// EKSEKUSI SELURUH FUNCTION YANG TERPANGGIL
	function executeAll() {
		$datacandidate = export_DataCandidateJoin();
		executeExportCsvFunctions();
		ImportSqlServer();
		RemoveFile();
		// createZipFile();
	
		// Loop untuk mengatur "export_flag" untuk setiap kandidat
		foreach ($datacandidate as $candidate) {
			querying("UPDATE m_candidate SET export_flag=? WHERE candidate_id=?", array('1', $candidate["candidate_id"]));
		}
	
		header("Location: " . _PATHURL . "/index.php?mod=applicants&type=hired&mess=" . coded("Berhasil menginput data ke SQL Server."));
		exit(); // Pastikan untuk menggunakan exit() setelah header location
	}
	
	function FilePath() {
		$candidate_id = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? $_REQUEST["candidate_id"] : null;
		$type = (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") ? $_REQUEST["type"] : null;

		$filename1 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") ? "Candidate_Data".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".csv" : "candidate_".$_REQUEST["type"]."_".date("YmdHis").".csv";
		$filepath1 = 'cand_files/csv/Candidate/'.$filename1;
		$filename2 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Education" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath2 = 'cand_files/csv/CanEdu/' . $filename2;
		$filename3 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Family" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath3 = 'cand_files/csv/CanFamily/' . $filename3;
		$filename4 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Experience" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath4 = 'cand_files/csv/CanExperience/' . $filename4;
		$filename5 = "Candidate_IDCard{$type}_" . date("YmdHis") . "_{$candidate_id}.csv";
		$filepath5 = 'cand_files/csv/CanIDCard/' . $filename5;
	}

	function RemoveFile() {

		$candidate_id = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? $_REQUEST["candidate_id"] : null;
		$type = (isset($_REQUEST["type"]) && $_REQUEST["type"] !== "") ? $_REQUEST["type"] : null;
		
		$filename1 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"]<>"") ? "Candidate_Data".$_REQUEST["type"]."_".date("YmdHis")."_".$_REQUEST["candidate_id"].".csv" : "candidate_".$_REQUEST["type"]."_".date("YmdHis").".csv";
		$filepath1 = 'cand_files/csv/Candidate/'.$filename1;
		$filename2 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Education" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath2 = 'cand_files/csv/CanEdu/' . $filename2;
		$filename3 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Family" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath3 = 'cand_files/csv/CanFamily/' . $filename3;
		$filename4 = (isset($_REQUEST["candidate_id"]) && $_REQUEST["candidate_id"] !== "") ? "Candidate_Experience" . $_REQUEST["type"] . "_" . date("YmdHis") . "_" . $_REQUEST["candidate_id"] . ".csv" : "candidate_" . $_REQUEST["type"] . "_" . date("YmdHis") . ".csv";
		$filepath4 = 'cand_files/csv/CanExperience/' . $filename4;
		$filename5 = "Candidate_IDCard{$type}_" . date("YmdHis") . "_{$candidate_id}.csv";
		$filepath5 = 'cand_files/csv/CanIDCard/' . $filename5;

		unlink($filepath1);    
		unlink($filepath2);    
		unlink($filepath3);    
		unlink($filepath4);    
		unlink($filepath5);    
		
	}

// 	function runEvery24Hours() {
// 		$start_time = time(); // Waktu saat ini

// 		// Mengatur interval 24 jam
// 		$interval = 5 * 60;

// 		while (true) {
// 			// Menjalankan fungsi pertama
// 			adm_exportCsvDataForProint();
// 			adm_exportCsvEduForProint();
// 			adm_exportCsvFamForProint();
// 			adm_exportCsvJobForProint();
// 			adm_exportCsvIDCardForProint();

// 			// Menunggu selama 24 jam
// 			sleep($interval);
// 		}
// 	}
}

// runEvery24Hours();
?>