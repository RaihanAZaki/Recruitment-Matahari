<?php
if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	
		function admin_getSprMenu() {
			$query = querying("SELECT * FROM m_menu WHERE menu_show = ? and menu_type = ? and status_id = ? ORDER BY menu_order ASC",array("y","superadm","active"));
			$data = sqlGetData($query);
			return $data;
		}
	
		function admin_getMenuTabs() {
			$query=querying("SELECT menu_id, menu_name, menu_title, menu_text, menu_filename, menu_home, menu_type, menu_show, menu_order, menu_parent_id, menu_icon, menu_color, menu_module, menu_show_inner, status_id
	FROM m_menu WHERE menu_type=? AND menu_show=? AND status_id=? ORDER BY menu_order ASC", array("admtab","y","active"));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getHowTo() {
			$query=querying("SELECT howto_id, howto_desc
	FROM m_howto LIMIT 1", array());
			$data=sqlGetData($query);
			return $data;
		}

		
		function admin_getDivision($division_id="") {
			if(isset($division_id) && $division_id<>"") {
				$query=querying("SELECT division_id, directorate_id, division_name, division_code, status_id FROM m_division WHERE status_id=? AND division_id=?",array("active",$division_id));
			}
			else {
				$query=querying("SELECT division_id, directorate_id, division_name, division_code, status_id FROM m_division WHERE status_id=?",array("active"));
			}
			$data=sqlGetData($query);
			return $data;
		}
	
		function adm_getNextStage($current_stage) {
			switch ($current_stage) {
				case "cv-screening":
					$nextstage="user-screening"; break;
				case "user-screening":
					$nextstage="psychotest"; break;					
				case "psychotest":
					$nextstage="hr-interview"; break;
				case "hr-interview":
					$nextstage="user-interview"; break;
				case "user-interview":
					$nextstage="background-check"; break;
				case "offering":
					$nextstage="offering"; break;
				case "offering":
					$nextstage="final"; break;
					
				default:
					$nexstage="cv-screening";
			}
			
			return $nextstage;
		}
	
		function admin_getEmployee($role="",$log_auth_id="") {
			if(isset($log_auth_id) && $log_auth_id<>"" && isset($role) && $role<>"") {
				$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_role, 
								a.log_auth_passwd, a.log_auth_lastlogin, a.log_auth_lastip, a.register_id, a.register_date, 
								a.register_activation_code, a.register_activation_date, a.status_id, 
								b.employee_name, b.employee_nik, b.division_id, b.employee_email, 
								c.division_name 
								FROM log_auth a LEFT JOIN m_employee b ON a.employee_id=b.employee_id 
								LEFT JOIN m_division c ON b.division_id=c.division_id
								WHERE a.log_auth_name=b.employee_email 
								AND a.log_auth_role=? AND a.status_id=? AND log_auth_id=?",array($role,"active",$log_auth_id));
			}
			else if (isset($log_auth_id) && $log_auth_id<>"" && $role=="") {
				$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_role, 
								a.log_auth_passwd, a.log_auth_lastlogin, a.log_auth_lastip, a.register_id, a.register_date, 
								a.register_activation_code, a.register_activation_date, a.status_id, 
								b.employee_name, b.employee_nik, b.division_id, b.employee_email, 
								c.division_name 
								FROM log_auth a LEFT JOIN m_employee b ON a.employee_id=b.employee_id 
								LEFT JOIN m_division c ON b.division_id=c.division_id 
								WHERE a.log_auth_name=b.employee_email 
								AND a.status_id=? AND log_auth_id=?",array("active",$log_auth_id));
			}
			else {
				$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_role, 
								a.log_auth_passwd, a.log_auth_lastlogin, a.log_auth_lastip, a.register_id, a.register_date, 
								a.register_activation_code, a.register_activation_date, a.status_id, 
								b.employee_name, b.employee_nik, b.division_id, b.employee_email, 
								c.division_name  
								FROM log_auth a LEFT JOIN m_employee b ON a.employee_id=b.employee_id 
								LEFT JOIN m_division c ON b.division_id=c.division_id 
								WHERE a.log_auth_name=b.employee_email AND a.log_auth_role=?
								AND a.status_id=?",array($role,"active"));
			}
			$data=sqlGetData($query);
			return $data;
		}
		
		function admin_getUser($start="",$limit="") {
			
			if($start=="" && $limit=="") {
				$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_role, b.employee_name, b.employee_nik, b.employee_email
								FROM log_auth a LEFT JOIN m_employee b ON a.employee_id=b.employee_id WHERE a.log_auth_name=b.employee_email 
								AND a.status_id=? ORDER BY b.employee_name ASC",array("active"));
			}
			else {
				$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_role, b.employee_name, b.employee_nik, b.employee_email
								FROM log_auth a LEFT JOIN m_employee b ON a.employee_id=b.employee_id WHERE a.log_auth_name=b.employee_email 
								AND a.status_id=? ORDER BY b.employee_name ASC LIMIT ".$start.", ".$limit,array("active"));
			}
			$data=sqlGetData($query);
			return $data;
		}
	
		function admin_getCandidateAll($type="") {
			if(isset($type) && $type=="register") {
				$query=querying("SELECT register_id, candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_expiry_date, register_activation_code
			FROM m_register nolock ORDER BY register_id DESC",
				array());
			}
			else if (isset($type) && $type=="activate"){
				$query=querying("SELECT log_auth_id, employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code, register_activation_date, status_id
			FROM log_auth nolock WHERE status_id=? and log_auth_role=? ORDER BY log_auth_id DESC",
				array("active","candid"));
			}
			else if (isset($type) && $type=="apply") {
				$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
		a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
		b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
		b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
		b.job_vacancy_enddate, b.log_auth_id
		FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id
		WHERE b.status_id=? GROUP BY a.candidate_id ORDER BY a.candidate_id",
				array("open"));
			}
			else if (isset($type) && $type=="hired") {
				$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
		a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
		b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
		b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
		b.job_vacancy_enddate, b.log_auth_id
		FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id
		WHERE b.status_id=? AND a.candidate_apply_status=? GROUP BY a.candidate_id ORDER BY a.candidate_id",
				array("open","join"));
			}
			
			
			$data=sqlGetData($query);
			return $data;
		}

		
		

		
		function admin_getListCandidate($type,$start,$limit) {
			if(isset($type) && $type=="register") {
				if($start=="" && $limit=="") {
					$query=querying("SELECT register_id, candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_expiry_date, register_activation_code
				FROM m_register ORDER BY register_id DESC",
					array());
				}
				else {
					$query=querying("SELECT register_id, candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_expiry_date, register_activation_code
				FROM m_register ORDER BY register_id DESC LIMIT ".$start.", ".$limit,
				array());
					
				}
				
			}
			else if (isset($type) && $type=="activate"){
				if($start=="" && $limit=="") {					
					$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name as candidate_email, a.log_auth_passwd, a.log_auth_role, a.log_auth_lastlogin, a.log_auth_lastip, a.register_id, 
									a.register_date, a.register_activation_code, a.register_activation_date, a.status_id, b.*
									FROM log_auth a LEFT JOIN m_candidate b ON a.log_auth_id=b.log_auth_id WHERE a.status_id=? AND a.log_auth_role=? ORDER BY a.log_auth_id DESC",
									array("active","candid"));

				}
				else {
					$query=querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name as candidate_email, a.log_auth_passwd, a.log_auth_role, a.log_auth_lastlogin, a.log_auth_lastip, a.register_id, 
									a.register_date, a.register_activation_code, a.register_activation_date, a.status_id, b.*
									FROM log_auth a LEFT JOIN m_candidate b ON a.log_auth_id=b.log_auth_id WHERE a.status_id=? AND a.log_auth_role=? ORDER BY a.log_auth_id DESC LIMIT ".$start.", ".$limit,
									array("active","candid"));
				}
			}
			else if (isset($type) && $type=="apply") {
				if($start=="" && $limit=="") {			
					
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, c.candidate_name, c.export_flag 
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? GROUP BY a.candidate_id ORDER BY a.candidate_id DESC",
					array("open"));

				}
				else {
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, c.candidate_name, c.log_auth_id, c.export_flag  
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? GROUP BY a.candidate_id ORDER BY a.candidate_id DESC LIMIT  ".$start.", ".$limit,
					array("open"));
				}
			}
			
			
			else if (isset($type) && $type=="hired") {
				if($start=="" && $limit=="") {			
					
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, c.candidate_name, c.export_flag 
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? AND a.candidate_apply_status=? GROUP BY a.candidate_id ORDER BY a.candidate_id DESC",
					array("open","join"));

				}
				else {
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, 
			a.candidate_apply_date, a.candidate_apply_stage, a.candidate_apply_status,
			b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, 
			b.job_vacancy_brief, b.job_vacancy_degree, b.job_vacancy_type, b.job_vacancy_startdate, 
			b.job_vacancy_enddate, b.log_auth_id, c.candidate_name, c.log_auth_id, c.export_flag  
			FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id 
			LEFT JOIN m_candidate c ON a.candidate_id=c.candidate_id 
			WHERE b.status_id=? AND a.candidate_apply_status=? GROUP BY a.candidate_id ORDER BY a.candidate_id DESC LIMIT  ".$start.", ".$limit,
					array("open","join"));
				}
			}

			
			
			$data=sqlGetData($query);
			return $data;
		}
		

		function admin_getJobAdv($job_vacancy_id="",$type="",$start="",$limit="",$status_id="open") {
			
			
			if($job_vacancy_id=="" && $type=="" && $start=="" && $limit=="") {
				$query=querying("SELECT a.job_vacancy_id, a.job_vacancy_name, a.job_vacancy_city, a.job_vacancy_desc, a.job_vacancy_brief, 
				a.job_vacancy_degree, a.job_vacancy_gender, a.job_vacancy_agemax, a.job_vacancy_marital, a.job_vacancy_experience, a.job_vacancy_type, 
				a.job_vacancy_startdate, a.job_vacancy_enddate, a.job_vacancy_requestby, a.job_vacancy_minsalary,
				a.job_vacancy_maxsalary, a.job_vacancy_grade, a.job_vacancy_headcount, a.job_vacancy_titlecode, a.job_vacancy_titlename, a.log_auth_id, a.job_vacancy_approver, 
				a.status_id, b.employee_id, c.employee_name, c.employee_nik, 
				c.employee_email FROM m_job_vacancy a LEFT JOIN log_auth b ON a.log_auth_id=b.log_auth_id
				LEFT JOIN m_employee c ON b.employee_id=c.employee_id
				WHERE a.status_id=? ORDER BY job_vacancy_enddate ASC",array($status_id));
				$dipake=1;
			}
			//ini part untuk liat detil job vacancy
			else if($job_vacancy_id<>"" && $type=="detail" && $start=="" && $limit=="") {
				$query=querying("SELECT job_vacancy_id, job_vacancy_name, job_vacancy_city, job_vacancy_desc, job_vacancy_brief, job_vacancy_degree, 
				job_vacancy_gender, job_vacancy_agemax, job_vacancy_marital, job_vacancy_experience, job_vacancy_type, 
				job_vacancy_startdate, job_vacancy_enddate, job_vacancy_requestby, job_vacancy_minsalary,
				job_vacancy_maxsalary, job_vacancy_grade, job_vacancy_headcount, job_vacancy_titlecode, job_vacancy_titlename, log_auth_id, job_vacancy_approver, status_id FROM m_job_vacancy WHERE job_vacancy_id=? ORDER BY job_vacancy_id DESC LIMIT 1", array($job_vacancy_id));	
				$dipake=2;
			}
			else{
				$query=querying("SELECT a.job_vacancy_id, a.job_vacancy_name, a.job_vacancy_city, a.job_vacancy_desc, a.job_vacancy_brief, 
				a.job_vacancy_degree, a.job_vacancy_gender, a.job_vacancy_agemax, a.job_vacancy_marital, a.job_vacancy_experience, a.job_vacancy_type, 
				a.job_vacancy_startdate, a.job_vacancy_enddate, a.job_vacancy_requestby, a.job_vacancy_minsalary,
				a.job_vacancy_maxsalary, a.job_vacancy_grade, a.job_vacancy_headcount, a.job_vacancy_titlecode, a.job_vacancy_titlename, a.log_auth_id, a.job_vacancy_approver, 
				a.status_id, b.employee_id, c.employee_name, c.employee_nik, 
				c.employee_email FROM m_job_vacancy a LEFT JOIN log_auth b ON a.log_auth_id=b.log_auth_id
				LEFT JOIN m_employee c ON b.employee_id=c.employee_id
				WHERE a.status_id=? ORDER BY job_vacancy_enddate ASC LIMIT ".$start.", ".$limit,array($status_id));
				$dipake=3;
			}
			
			//echo "dipake ".$dipake;
			$hasil=sqlGetData($query);
			if($hasil && count($hasil)>0) {
					$data=$hasil;
			}
			else {
					$data=array();				
			}
			return $data;
			
		}


		function admin_getCandidateByRecruiter($start_from,$limit) {
			if($start_from<>"" && $limit<>"") {
				$query=querying("SELECT a.candidate_id, a.log_auth_id, a.candidate_name, a.candidate_email, 
				b.log_auth_role, b.register_id, b.register_date, b.user_insert, b.date_insert
				FROM m_candidate a LEFT JOIN log_auth b ON a.log_auth_id=b.log_auth_id
				WHERE b.employee_id=? AND b.log_auth_role=? AND b.user_insert<>? ORDER BY a.candidate_name ASC LIMIT ".$start_from.", ".$limit,array(0,"candid",0));
			}
			else {
				$query=querying("SELECT a.candidate_id, a.log_auth_id, a.candidate_name, a.candidate_email, 
				b.log_auth_role, b.register_id, b.register_date, b.user_insert, b.date_insert
				FROM m_candidate a LEFT JOIN log_auth b ON a.log_auth_id=b.log_auth_id
				WHERE b.employee_id=? AND b.log_auth_role=? AND b.user_insert<>? ORDER BY a.candidate_name ASC",array(0,"candid",0));
			}
			$data=sqlGetData($query);
			return $data;
		}
		
		
		function admin_getAppliedVacancy($job_vacancy_id, $candidate_apply_stage) {
			if(isset($job_vacancy_id) && $job_vacancy_id<>"" && isset($candidate_apply_stage) && $candidate_apply_stage<>"") {
				$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, 
				a.candidate_apply_stage, a.candidate_apply_status, b.candidate_name
			FROM t_candidate_apply a LEFT JOIN m_candidate b ON a.candidate_id=b.candidate_id WHERE a.job_vacancy_id=? AND a.candidate_apply_stage=? AND a.candidate_apply_status<>? ORDER BY a.job_vacancy_id DESC", array($job_vacancy_id, $candidate_apply_stage, "reject"));
			}
			else if(isset($job_vacancy_id) && $job_vacancy_id<>"") {
				$query=querying("SELECT candidate_apply_id, candidate_id, candidate_email, job_vacancy_id, candidate_apply_date, candidate_apply_stage, candidate_apply_status
			FROM t_candidate_apply WHERE job_vacancy_id=? ORDER BY job_vacancy_id DESC", array($job_vacancy_id));
			}
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getStatusCandidate($job_vacancy_id, $candidate_apply_status) {
			$query=querying("SELECT candidate_apply_id, candidate_id, candidate_email, job_vacancy_id, candidate_apply_date, candidate_apply_stage, candidate_apply_status
			FROM t_candidate_apply WHERE job_vacancy_id=? and candidate_apply_status=? ORDER BY job_vacancy_id DESC", array($job_vacancy_id, $candidate_apply_status));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDetailCandidate($candidate_id) {
			$query=querying("SELECT candidate_id, log_auth_id, candidate_name, candidate_email, candidate_gender, candidate_religion, candidate_birthplace, 
			candidate_birthdate, candidate_race, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_bodyheight, 
			candidate_bodyweight, candidate_bloodtype, candidate_sim_a, candidate_sim_c, candidate_npwp, candidate_marital, candidate_p_address, 
			candidate_p_city, candidate_p_postcode, candidate_c_address, candidate_c_city, candidate_c_postcode, candidate_hp1, candidate_hp2, 
			candidate_phone, candidate_cp_name1, candidate_cp_relation1, candidate_cp_phone1, candidate_cp_name2, candidate_cp_relation2, candidate_cp_phone2, 
			candidate_ref_name, candidate_ref_division, candidate_ref_position, candidate_expected_salary, candidate_hobby
			FROM m_candidate WHERE candidate_id=? AND status_id=? ORDER BY candidate_id DESC LIMIT 1", array($candidate_id,"active"));
			if($data=sqlGetData($query)){
				return $data;
			}
			else {
				return false;
			}
		}

		function admin_getDataEdu($candidate_id) {
			$query=querying("SELECT candidate_edu_id, candidate_id, candidate_edu_degree, candidate_edu_institution, candidate_edu_major, candidate_edu_gpa, candidate_edu_city, candidate_edu_start, candidate_edu_end, candidate_edu_notes
			FROM m_candidate_edu WHERE candidate_id=? ORDER BY FIELD (candidate_edu_degree,'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD')", 
			array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataJob($candidate_id) {
			$query=querying("SELECT candidate_jobexp_id, candidate_id, candidate_jobexp_company, candidate_jobexp_address, candidate_jobexp_phone, candidate_jobexp_lob, candidate_jobexp_numemployee, candidate_jobexp_position, candidate_jobexp_start, candidate_jobexp_end, candidate_jobexp_desc, candidate_jobexp_salary, candidate_jobexp_spvname, candidate_jobexp_spvposition, candidate_jobexp_subposition, candidate_jobexp_subnumber, candidate_jobexp_leaving
			FROM m_candidate_jobexp WHERE candidate_id=? ORDER BY candidate_jobexp_end DESC", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}
		
		function admin_getDataOrg($candidate_id) {
			$query=querying("SELECT candidate_organization_id, candidate_id, candidate_organization_name, candidate_organization_role, candidate_organization_start, candidate_organization_end
			FROM m_candidate_organization WHERE candidate_id=? ORDER BY candidate_organization_end DESC", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataTraining($candidate_id) {
			$query=querying("SELECT candidate_training_id, candidate_id, candidate_training_name, candidate_training_institution, candidate_training_city, candidate_training_year, candidate_training_duration, candidate_training_sponsor
			FROM m_candidate_training WHERE candidate_id=? ORDER BY candidate_training_year DESC", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataSkills($candidate_id) {
			$query=querying("SELECT candidate_skill_id, candidate_id, candidate_skill_name, candidate_skill_level, candidate_skill_notes
			FROM m_candidate_skill WHERE candidate_id=? ORDER BY candidate_skill_id ASC", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataLanguage($candidate_id) {
			$query=querying("SELECT candidate_language_id, candidate_id, candidate_language_name, candidate_language_read, candidate_language_write, candidate_language_conversation
			FROM m_candidate_language WHERE candidate_id=? ORDER BY candidate_language_id ASC", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}
		
		function admin_getDataFam($candidate_id) {
			$query=querying("SELECT candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
			FROM m_candidate_family WHERE candidate_id=? ORDER BY FIELD(candidate_family_relation,'Father','Mother','Brother','Sister','Spouse','Son','Daughter')", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataFamByType($candidate_id,$type) {
			if($type=="parents") {
				$query=querying("SELECT candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
				FROM m_candidate_family WHERE candidate_id=? AND (candidate_family_relation=? OR candidate_family_relation=?) ORDER BY FIELD(candidate_family_relation,'Father','Mother')", array($candidate_id,'Father','Mother'));
			}
			if($type=="siblings") {
				$query=querying("SELECT candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
				FROM m_candidate_family WHERE candidate_id=? AND (candidate_family_relation=? OR candidate_family_relation=?) ORDER BY candidate_family_birthdate", array($candidate_id,'Brother','Sister'));
			}
			if($type=="spouse") {
				$query=querying("SELECT candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
				FROM m_candidate_family WHERE candidate_id=? AND candidate_family_relation=?", array($candidate_id,'Spouse'));
			}
			if($type=="children") {
				$query=querying("SELECT candidate_family_id, candidate_id, candidate_family_relation, candidate_family_name, candidate_family_birthplace, candidate_family_birthdate, candidate_family_lastedu, candidate_family_lastjob, candidate_family_company, candidate_family_rip
				FROM m_candidate_family WHERE candidate_id=? AND (candidate_family_relation=? OR candidate_family_relation=?)", array($candidate_id,'Son','Daughter'));
			}
			
			$data=sqlGetData($query);
			return $data;
		}
		
		function admin_getDataDoc($candidate_id) {
			$query=querying("SELECT candidate_file_id, candidate_id, candidate_file_name, candidate_file_type, candidate_file_notes
			FROM m_candidate_file WHERE candidate_id=?", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataOthers($candidate_id) {
			$query=querying("SELECT candidate_file_id, candidate_id, candidate_file_name, candidate_file_notes
			FROM m_candidate_fileothers WHERE candidate_id=?", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}

		function admin_getDataAnswer($candidate_id) {
			$query=querying("SELECT answer_id, candidate_id, question_id, answer_yn, answer_desc
			FROM t_answer WHERE candidate_id=? ORDER BY question_id ASC", array($candidate_id));
			$data=sqlGetData($query);
			return $data;
		}




		function admin_changePassword() {
			//print_r($_POST);exit;
			$query=querying("SELECT log_auth_passwd, register_id, log_auth_name FROM log_auth WHERE log_auth_id=? ORDER BY log_auth_id ASC LIMIT 1", array($_SESSION["log_auth_id"]));
			$data=sqlGetData($query);
			$curpasswd=sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["curpasswd"]);

			//print_r($data);exit;
			//echo $curpasswd;exit;
			
			if($data[0]["log_auth_passwd"]==$curpasswd) {
				if($_POST["newpass"]==$_POST["newpass2"]) {			
					if(querying("UPDATE log_auth SET log_auth_passwd=? WHERE log_auth_id=?",array(sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["newpass"]),$_SESSION["log_auth_id"]))) {
						header("location: "._PATHURL."/index.php?mess=".coded("Your password had been updated."));
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=admchangepwd&gal=".coded("1")."&mess=".coded("Update password failed."));
						return false;
						exit;
					}
				}
				else {
						header("location: "._PATHURL."/index.php?mod=admchangepwd&gal=".coded("1")."&mess=".coded("Field retype password do not match."));
						return false;
						exit;			
				}
			}
			else {
				system_log_badattempt();
				header("location: "._PATHURL."/index.php?mod=admchangepwd&gal=".coded("1")."&mess=".coded("You have entered an invalid password"));
				return false;
				exit;	
			}
		}




		
		function adm_updateJobAdv() {
			
			global $connection_type;
			global $activate_connection;
			//echo "masuk";exit;
			//$_POST = sanitize_post($_POST);
			//print_r($_POST);
			/* job_vacancy_name, job_vacancy_city, job_vacancy_desc, job_vacancy_brief, job_vacancy_degree, job_vacancy_type, job_vacancy_startdate, 
			job_vacancy_enddate, log_auth_id, status_id, user_insert, date_insert, user_update, date_update */
			
			$expiry_date=date('Y-m-d', strtotime("+2 week"));

			$missteps = array();
			
			if (!isset($_POST["job_vacancy_name"]) or $_POST["job_vacancy_name"] == "") 	$missteps[] = 47;
			if (!isset($_POST["job_vacancy_city"]) or $_POST["job_vacancy_city"] == "") 		$missteps[] = 48;
			if (!isset($_POST["job_vacancy_desc"]) or $_POST["job_vacancy_desc"] == "") 		$missteps[] = 49;
			if (!isset($_POST["job_vacancy_brief"]) or $_POST["job_vacancy_brief"] == "") 		$missteps[] = 50;
			if (!isset($_POST["job_vacancy_degree"]) or $_POST["job_vacancy_degree"] == "") 		$missteps[] = 51;
			if (!isset($_POST["job_vacancy_type"]) or $_POST["job_vacancy_type"] == "") 		$missteps[] = 52;
			if (!isset($_POST["job_vacancy_startdate"]) or $_POST["job_vacancy_startdate"] == "") 		$missteps[] = 53;
			if (!isset($_POST["job_vacancy_enddate"]) or $_POST["job_vacancy_enddate"] == "") 		$missteps[] = 54;
			if (!isset($_POST["status_id"]) or $_POST["status_id"] == "") 		$missteps[] = 55;
			if (!isset($_POST["job_vacancy_pic"]) or $_POST["job_vacancy_pic"] == "") 		$missteps[] = 56;
			if (!isset($_POST["job_vacancy_approver"]) or $_POST["job_vacancy_approver"] == "") 		$missteps[] = 57;
			
			if (count($missteps)>0)
			{
				for ($i=0;$i<count($missteps);$i++) {
					$notice[] = error_notice($missteps[$i]);
				}
				$notice = json_encode($notice);
				
				$_SESSION["session"] = $_POST;	
								
				//print_r($_SESSION);exit;
				if(isset($_POST["upd_type"]) && $_POST["upd_type"]=="edit") {
					header("location: "._PATHURL."/index.php?mod=updateadv&gal=".coded("1")."&type=".$_POST["upd_type"]."&job_vacancy_id=".$_POST["job_vacancy_id"]."&missteps=".coded($notice));
					exit;
				}
				else {
					header("location: "._PATHURL."/index.php?mod=updateadv&gal=".coded("1")."&type=".$_POST["upd_type"]."&missteps=".coded($notice));
					exit;
				}
			}
			
			else {
				$job_vacancy_startdate=reverseDate($_POST["job_vacancy_startdate"]);
				$job_vacancy_enddate=reverseDate($_POST["job_vacancy_enddate"]);
				//jalankan proses update
				//print_r($_POST);
				//echo "<br>type=".$_POST["upd_type"];
				$job_vacancy_city=(isset($_POST["job_vacancy_city"]) && is_array($_POST["job_vacancy_city"]))?$_POST["job_vacancy_city"][0]:"";
				if(isset($_POST["upd_type"]) && $_POST["upd_type"]=="edit") {
					/*
					echo $_POST["job_vacancy_name"]."<br>".
						$job_vacancy_city."<br>".$_POST["job_vacancy_desc"]."<br>".$_POST["job_vacancy_brief"]."<br>".$_POST["job_vacancy_degree"]."<br>".
						$_POST["job_vacancy_gender"]."<br>".$_POST["job_vacancy_agemax"]."<br>".$_POST["job_vacancy_marital"]."<br>".$_POST["job_vacancy_experience"]."<br>".
						$_POST["job_vacancy_type"]."<br>".$_POST["job_vacancy_requestby"]."<br>".$_POST["job_vacancy_minsalary"]."<br>".$_POST["job_vacancy_maxsalary"]."<br>".
						$_POST["job_vacancy_grade"]."<br>".$_POST["job_vacancy_pic"]."<br>".$_POST["job_vacancy_approver"]."<br>".$_POST["status_id"]."<br>".
						$_SESSION["log_auth_id"]."<br>".$_POST["job_vacancy_id"]; exit; */

					$query=querying("UPDATE m_job_vacancy SET job_vacancy_name=?, job_vacancy_city=?, job_vacancy_desc=?, job_vacancy_brief=?, 
								job_vacancy_degree=?, job_vacancy_gender=?, job_vacancy_agemax=?, job_vacancy_marital=?, job_vacancy_experience=?, 
								job_vacancy_type=?, job_vacancy_startdate=?, job_vacancy_enddate=?, job_vacancy_requestby=?, job_vacancy_minsalary=?,
								job_vacancy_maxsalary=?, job_vacancy_grade=?, job_vacancy_headcount=?, job_vacancy_titlecode=?, job_vacancy_titlename=?, 
								log_auth_id=?, job_vacancy_approver=?, status_id=?, 
								user_update=?, date_update=now()	WHERE job_vacancy_id=?", 
								array($_POST["job_vacancy_name"], $job_vacancy_city, $_POST["job_vacancy_desc"], $_POST["job_vacancy_brief"], 
								$_POST["job_vacancy_degree"], $_POST["job_vacancy_gender"], $_POST["job_vacancy_agemax"], $_POST["job_vacancy_marital"], $_POST["job_vacancy_experience"], 
								$_POST["job_vacancy_type"], $job_vacancy_startdate, $job_vacancy_enddate, $_POST["job_vacancy_requestby"], $_POST["job_vacancy_minsalary"], 
								$_POST["job_vacancy_maxsalary"], $_POST["job_vacancy_grade"], $_POST["job_vacancy_headcount"], $_POST["job_vacancy_titlecode"], $_POST["job_vacancy_titlename"], $_POST["job_vacancy_pic"], $_POST["job_vacancy_approver"], $_POST["status_id"], 
								$_SESSION["log_auth_id"], $_POST["job_vacancy_id"]));	
						
					//echo $query;exit;
						
					if($query) {
						//kirim notifikasi ke HR Admin
						$division=admin_getDivision($_POST["job_vacancy_requestby"]);
						$pic=admin_getEmployee("pic",$_POST["job_vacancy_pic"]);
						$hrd=admin_getEmployee("hrd",$_POST["job_vacancy_approver"]);
						$user_update=admin_getEmployee("",$_SESSION["log_auth_id"]);
						//print_r($hrd);
						
						$variablemail = array();
						$variablemail["sender"] 		= 'recruitment@hypermart.co.id';
						$variablemail["from"] 		= "recruitment@hypermart.co.id";
						$variablemail["fromname"] 	= "MPP Online Recruitment: Job Advertisement Notification";
						$variablemail["to"] 			= $hrd[0]["log_auth_name"];
						$variablemail["toName"]		= $hrd[0]["employee_name"];
						$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
						$variablemail["subject"] 	= "Job Advertisement need for approval";
						$variablemail["content"] 	= "
						<style type='text/css'>
							.button {
								padding: 5px 10px;
								display: inline;
								background: #777 url(button.png) repeat-x bottom;
								border: none;
								color: #fff;
								cursor: pointer;
								font-weight: bold;
								border-radius: 5px;
								-moz-border-radius: 5px;
								-webkit-border-radius: 5px;
								text-shadow: 1px 1px #666;
								text-decoration: none;
								}
						</style>
						<div style='font-family:Arial;'>
						<div>
						Dear ".$hrd[0]["employee_name"].", There is a job advertisement has been edited by ".$user_update[0]["employee_name"]." that need to be approved before published it to the internet.
						Kindly find the detail below:</div><br><br>
						
							<div style='float:left; width:200px;'><b>Position :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_name"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Placement city :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$job_vacancy_city."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Job description :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_desc"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Brief description :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_brief"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Degree :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_degree"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Gender :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_gender"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Max age :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_agemax"]." years old</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Marital status :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_marital"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Experience :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_experience"]." years</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Employment type :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_type"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Advertisement date :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'><b>".date("d M Y",strtotime($job_vacancy_startdate))."</b> - <b>".date("d M Y",strtotime($job_vacancy_enddate))."</b></div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Requested by :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$division[0]["division_name"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Salary range :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".showRupiah($_POST["job_vacancy_minsalary"])." up to ".showRupiah($_POST["job_vacancy_maxsalary"])."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Grade :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_grade"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Recruiter PIC :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$pic[0]["employee_name"]."</div>
							<div style='clear:both; height:15px;'></div>
							

						<div>Please login to your account in order to review the job advertisement. Or you may simply click the button below to process the advertisement without login in to your account.<br><br></div>
						<div>
							<table border='none' cellspacing='0' cellpading='0'>
								<tr>
									<td style='width:250px; padding-left:10px; padding-right:10px;'><a class='button' href="._PATHURL."/adsapproval.php?usr=".coded($_POST["job_vacancy_approver"]."|open|".$_POST["job_vacancy_id"]."|".$expiry_date).">
								APPROVE and PUBLISH</a></td>
									<td style='width:250px; padding-left:10px; padding-right:10px;'><a class='button' href="._PATHURL."/adsapproval.php?usr=".coded($_POST["job_vacancy_approver"]."|pending|".$_POST["job_vacancy_id"]."|".$expiry_date).">
								PENDING</a></td>
									<td style='width:250px; padding-left:10px; padding-right:10px;'><a class='button' href="._PATHURL."/adsapproval.php?usr=".coded($_POST["job_vacancy_approver"]."|finish|".$_POST["job_vacancy_id"]."|".$expiry_date).">
								FINISH</a></td>
								</tr>
							</table>
							
						</div>
						<br><br>
						<div>In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
						<b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></div></div>";
						
						//echo $variablemail["content"];exit;
						
						if (function_sending_email($variablemail))
						{
							unset($_SESSION["session"]);
							unset($variablemail);
							header("location: "._PATHURL."/index.php?mod=jobadv&mess=".coded("Data has been updated and sent to the approval manager to be reviewed."));
							exit;	
						}
						else
						{
							header("location: "._PATHURL."/index.php?mod=jobadv&gal=".coded("1")."&mess=".coded("Sending notification email failed. Please try again later."));
							exit;	
						}	
						
					}
					else {
						header("location: "._PATHURL."/index.php?mod=updateadv&type=edit&job_vacancy_id=".$_POST["job_vacancy_id"]."&view=".coded($_POST["status_id"])."&page=".$page."&gal=".coded("1")."&mess=".coded("Error happen. We found difficulties in updating the job advertisement. Please try again later."));
						exit;	
					}
					
				}
				else {
					//proses input
					$query=querying("INSERT INTO m_job_vacancy (job_vacancy_name, job_vacancy_city, job_vacancy_desc, job_vacancy_brief, 
								job_vacancy_degree, job_vacancy_gender, job_vacancy_agemax, job_vacancy_marital, job_vacancy_experience, 
								job_vacancy_type, job_vacancy_startdate, job_vacancy_enddate, job_vacancy_requestby, job_vacancy_minsalary,
								job_vacancy_maxsalary, job_vacancy_grade, job_vacancy_headcount, job_vacancy_titlecode, job_vacancy_titlename, 
								log_auth_id, job_vacancy_approver, status_id, user_insert,
								date_insert, user_update, date_update) VALUES(?, ?, ?, ?, 
								?, ?, ?, ?, ?, 
								?, ?, ?, ?, ?,
								?, ?, ?, ?, ?, 
								?, ?, ?,
								?, now(), ?, now())", 
								array($_POST["job_vacancy_name"], $job_vacancy_city, $_POST["job_vacancy_desc"], $_POST["job_vacancy_brief"], 
								$_POST["job_vacancy_degree"], $_POST["job_vacancy_gender"], $_POST["job_vacancy_agemax"], $_POST["job_vacancy_marital"], $_POST["job_vacancy_experience"], 
								$_POST["job_vacancy_type"], $job_vacancy_startdate, $job_vacancy_enddate, $_POST["job_vacancy_requestby"], $_POST["job_vacancy_minsalary"], 
								$_POST["job_vacancy_maxsalary"], $_POST["job_vacancy_grade"], $_POST["job_vacancy_headcount"], $_POST["job_vacancy_titlecode"], $_POST["job_vacancy_titlename"],
								$_POST["job_vacancy_pic"], $_POST["job_vacancy_approver"], $_POST["status_id"], 
								$_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));	
								
					if($query) {
						//kirim notifikasi ke HR Admin
						if($connection_type=="2")
						{
							$job_vacancy_id=mysqli_insert_id($activate_connection); 
						}
						else 
						{
							$job_vacancy_id=mysql_insert_id();
						}
						
						
						$division=admin_getDivision($_POST["job_vacancy_requestby"]);
						$pic=admin_getEmployee("pic",$_POST["job_vacancy_pic"]);
						$hrd=admin_getEmployee("hrd",$_POST["job_vacancy_approver"]);
						$user_update=admin_getEmployee("",$_SESSION["log_auth_id"]);
						//print_r($hrd);
						
						$variablemail = array();
						$variablemail["sender"] 		= 'recruitment@hypermart.co.id';
						$variablemail["from"] 		= "recruitment@hypermart.co.id";
						$variablemail["fromname"] 	= "MPP Online Recruitment: Job Advertisement Notification";
						$variablemail["to"] 			= $hrd[0]["log_auth_name"];
						$variablemail["toName"]		= $hrd[0]["employee_name"];
						$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
						$variablemail["subject"] 	= "Job Advertisement need for approval";
						$variablemail["content"] 	= "
						<style type='text/css'>
							.button {
								padding: 5px 10px;
								display: inline;
								background: #777 url(button.png) repeat-x bottom;
								border: none;
								color: #fff;
								cursor: pointer;
								font-weight: bold;
								border-radius: 5px;
								-moz-border-radius: 5px;
								-webkit-border-radius: 5px;
								text-shadow: 1px 1px #666;
								text-decoration: none;
								}
						</style>
						<div style='font-family:Arial;'>
						<div>
						Dear ".$hrd[0]["employee_name"].", There is a job advertisement has been input by ".$user_update[0]["employee_name"]." that need to be approved before published it to the internet.
						Kindly find the detail below:</div><br><br>
						
							<div style='float:left; width:200px;'><b>Position :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_name"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Placement city :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$job_vacancy_city."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Job description :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_desc"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Brief description :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_brief"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Degree :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_degree"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Gender :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_gender"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Max age :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_agemax"]." years old</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Marital status :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_marital"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Experience :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_experience"]." years</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Employment type :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_type"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Advertisement date :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'><b>".date("d M Y",strtotime($job_vacancy_startdate))."</b> - <b>".date("d M Y",strtotime($job_vacancy_enddate))."</b></div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Requested by :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$division[0]["division_name"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Salary range :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".showRupiah($_POST["job_vacancy_minsalary"])." up to ".showRupiah($_POST["job_vacancy_maxsalary"])."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>Grade :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_grade"]."</div>
							<div style='clear:both; height:15px;'></div>
							<div style='float:left; width:200px;'><b>MPP/ Headcount :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$_POST["job_vacancy_headcount"]."</div>
							<div style='clear:both; height:15px;'></div>
							
							
							
							<div style='float:left; width:200px;'><b>Recruiter PIC :</b></div>
							<div style='float:left; width:400px; padding-left:20px;'>".$pic[0]["employee_name"]."</div>
							<div style='clear:both; height:15px;'></div>
							

						<div>Please login to your account in order to review the job advertisement. Or you may simply click the button below to process the advertisement without login in to your account.<br><br></div>
						<div>
							<table border='none' cellspacing='0' cellpading='0'>
								<tr>
									<td style='width:250px; padding-left:10px; padding-right:10px;'><a class='button' href="._PATHURL."/adsapproval.php?usr=".coded($_POST["job_vacancy_approver"]."|open|".$job_vacancy_id."|".$expiry_date).">
								APPROVE and PUBLISH</a></td>
									<td style='width:250px; padding-left:10px; padding-right:10px;'><a class='button' href="._PATHURL."/adsapproval.php?usr=".coded($_POST["job_vacancy_approver"]."|pending|".$job_vacancy_id."|".$expiry_date).">
								PENDING</a></td>
									<td style='width:250px; padding-left:10px; padding-right:10px;'><a class='button' href="._PATHURL."/adsapproval.php?usr=".coded($_POST["job_vacancy_approver"]."|finish|".$job_vacancy_id."|".$expiry_date).">
								FINISH</a></td>
								</tr>
							</table>
						</div>
						<br><br>
						<div>In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
						<b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></div></div>";
						
						//echo $variablemail["content"];exit;
						
						if (function_sending_email($variablemail))
						{
							unset($_SESSION["session"]);
							unset($variablemail);
							header("location: "._PATHURL."/index.php?mod=jobadv&mess=".coded("Data has been updated and sent to the approval manager to be reviewed."));
							exit;	
						}
						else
						{
							header("location: "._PATHURL."/index.php?mod=jobadv&gal=".coded("1")."&mess=".coded("Sending notification email failed. Please try again later."));
							exit;	
						}	
						
					}
					else {
						header("location: "._PATHURL."/index.php?mod=updateadv&view=".coded($_POST["status_id"])."&page=".$page."&gal=".coded("1")."&mess=".coded("Error happen. We found difficulties in updating the job advertisement. Please try again later."));
						exit;	
					}
					
					
				}
				
			}
			
		}
		
		
		
		function adm_delJobAdv() {
			$job_vacancy_id=(isset($_POST["job_vacancy_id"]) && $_POST["job_vacancy_id"]<>"")?$_POST["job_vacancy_id"]:"";
			
			if($job_vacancy_id<>"") {
				$query1=querying("DELETE FROM m_job_vacancy WHERE job_vacancy_id=?",array($job_vacancy_id));
				$query2=querying("DELETE FROM t_candidate_apply WHERE job_vacancy_id=?",array($job_vacancy_id));
				$query3=querying("DELETE FROM t_apply_history WHERE job_vacancy_id=?",array($job_vacancy_id));
				
				if($query1 && $query2 && $query3) {
					header("location: "._PATHURL."/index.php?mod=jobadv&mess=".coded("Delete vacancy success."));
					exit;						
				}
				else {
					header("location: "._PATHURL."/index.php?mod=jobadv&gal=".coded("1")."&mess=".coded("Delete vacancy failed."));
					exit;	
				}
			}
			else {
				header("location: "._PATHURL."/index.php?mod=jobadv&gal=".coded("1")."&mess=".coded("Make sure to choose an existing vacancy."));
				exit;					
			}
		}
		
		
		/* Bagian Update Resume */
		function admin_editResume() {
			
			$_POST = sanitize_post($_POST);
			$_GET  = sanitize_get($_GET);
			
			
			//print_r($_POST); exit;
			/* candidate_name, candidate_email, candidate_gender, candidate_religion, candidate_birthplace, candidate_birthdate, 
		candidate_race, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_bodyheight, candidate_bodyweight, 
		candidate_bloodtype, candidate_sim_a, candidate_sim_c, candidate_npwp, candidate_marital, candidate_p_address, candidate_p_city, candidate_p_postcode, 
		candidate_c_address, candidate_c_city, candidate_c_postcode, candidate_hp1, candidate_hp2, candidate_phone, candidate_cp_name1, candidate_cp_relation1, 
		candidate_cp_phone1, candidate_cp_name2, candidate_cp_relation2, candidate_cp_phone2, 
		candidate_ref_name, candidate_ref_division, candidate_ref_position, candidate_expected_salary, candidate_hobby */
			
			$missteps = array();
			if (!isset($_POST["full_name"]) or $_POST["full_name"] == "") 	$missteps[] = 0;
			if (!isset($_POST["email1"]) or $_POST["email1"] == "") 		$missteps[] = 1;
			if (!isset($_POST["candidate_gender"]) or $_POST["candidate_gender"] == "") 		$missteps[] = 2;
			if (!isset($_POST["candidate_religion"]) or $_POST["candidate_religion"] == "") 		$missteps[] = 3;
			if (!isset($_POST["place_of_birth"]) or $_POST["place_of_birth"] == "") 		$missteps[] = 4;
			if (!isset($_POST["birthdate"]) or $_POST["birthdate"] == "") 		$missteps[] = 5;
			//if (!isset($_POST["candidate_race"]) or $_POST["candidate_race"] == "") 		$missteps[] = 6;
			if (!isset($_POST["candidate_nationality"]) or $_POST["candidate_nationality"] == "") 		$missteps[] = 7;
			if (isset($_POST["candidate_nationality"]) && $_POST["candidate_nationality"]=="wna" && $_POST["candidate_country"] == "") 		$missteps[] = 8;
			//if (isset($_POST["candidate_nationality"]) && $_POST["candidate_nationality"]=="wna" && (!isset($_POST["nomor_passport"]) || $_POST["nomor_passport"] == "") ) 		$missteps[] = 10;
			//if (isset($_POST["candidate_nationality"]) && $_POST["candidate_nationality"]=="wni" && (!isset($_POST["nomor_ktp"]) || $_POST["nomor_ktp"] == ""  || (strlen($_POST["nomor_ktp"]) < 15) || (strlen($_POST["nomor_ktp"]) > 16) )) 		$missteps[] = 37;
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
			if (!isset($_POST["candidate_cp_phone1"]) or $_POST["candidate_cp_phone1"] == "") 		$missteps[] = 29;
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
				if(isset($_POST["candidate_religion"]) && is_array($_POST["candidate_religion"])) {
						$_SESSION["session"]["candidate_religion"]=$_POST["candidate_religion"][0];
				}
				if(isset($_POST["candidate_bloodtype"]) && is_array($_POST["candidate_bloodtype"])) {
						$_SESSION["session"]["candidate_bloodtype"]=$_POST["candidate_bloodtype"][0];
				}
				if(isset($_POST["candidate_cp_relation1"]) && is_array($_POST["candidate_cp_relation1"])) {
						$_SESSION["session"]["candidate_cp_relation1"]=$_POST["candidate_cp_relation1"][0];
				}
				if(isset($_POST["candidate_cp_relation2"]) && is_array($_POST["candidate_cp_relation2"])) {
						$_SESSION["session"]["candidate_cp_relation2"]=$_POST["candidate_cp_relation2"][0];
				}
				//tambahan shakti untuk milih race 2017_09_10
				if(isset($_POST["candidate_race"]) && is_array($_POST["candidate_race"])) {
						$_SESSION["session"]["candidate_race"]=$_POST["candidate_race"][0];
				}

				//print_r($_SESSION);exit;
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&missteps=".coded($notice)."#".$_POST["menu_name"]);
				exit;
			}	
			
			else {
				$data=array();
				$data["candidate_birthplace"]=(isset($_POST["place_of_birth"]) && is_array($_POST["place_of_birth"]))?$_POST["place_of_birth"][0]:"";
				$data["candidate_c_city"]=(isset($_POST["candidate_c_city"]) && is_array($_POST["candidate_c_city"]))?$_POST["candidate_c_city"][0]:"";
				$data["candidate_p_city"]=(isset($_POST["candidate_p_city"]) && is_array($_POST["candidate_p_city"]))?$_POST["candidate_p_city"][0]:"";
				$data["candidate_marital"]=(isset($_POST["candidate_marital"]) && is_array($_POST["candidate_marital"]))?$_POST["candidate_marital"][0]:"";
				$data["candidate_religion"]=(isset($_POST["candidate_religion"]) && is_array($_POST["candidate_religion"]))?$_POST["candidate_religion"][0]:"";
				$data["candidate_bloodtype"]=(isset($_POST["candidate_bloodtype"]) && is_array($_POST["candidate_bloodtype"]))?$_POST["candidate_bloodtype"][0]:"";
				$data["candidate_cp_relation1"]=(isset($_POST["candidate_cp_relation1"]) && is_array($_POST["candidate_cp_relation1"]))?$_POST["candidate_cp_relation1"][0]:"";
				$data["candidate_cp_relation2"]=(isset($_POST["candidate_cp_relation2"]) && is_array($_POST["candidate_cp_relation2"]))?$_POST["candidate_cp_relation2"][0]:"";
				//tambahan shakti untuk pilih race 2017_09_10
				$data["candidate_race"]=(isset($_POST["candidate_race"]) && is_array($_POST["candidate_race"]))?$_POST["candidate_race"][0]:"";

				
				
				$birthdate=reverseDate($_POST["birthdate"]);
				//proses update database
				$query=querying("UPDATE m_candidate
					SET
					candidate_name=?,
					candidate_email=?,
					candidate_gender=?,
					candidate_birthplace=?,
					candidate_birthdate=?,
					candidate_nationality=?,
					candidate_country=?,
					candidate_idtype=?,
					candidate_idcard=?,
						candidate_religion=?,
						candidate_race=?,
						candidate_marital=?,
						candidate_bodyheight=?,
						candidate_bodyweight=?,
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
						candidate_hp2=?,
						candidate_phone=?,
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
					WHERE candidate_id=?", array($_POST["full_name"], $_POST["email1"], $_POST["candidate_gender"], $data["candidate_birthplace"], $birthdate, $_POST["candidate_nationality"],
					((isset($_POST["candidate_nationality"]) && $_POST["candidate_nationality"]=="wni")?"Indonesia":$_POST["candidate_country"]), ((isset($_POST["candidate_nationality"]) && $_POST["candidate_nationality"]=="wni")?"KTP":"Passport"), 
					((isset($_POST["candidate_nationality"]) && $_POST["candidate_nationality"]=="wni")?$_POST["nomor_ktp"]:$_POST["nomor_passport"]), $data["candidate_religion"], $data["candidate_race"], $data["candidate_marital"], $_POST["candidate_bodyheight"], 
					$_POST["candidate_bodyweight"], $data["candidate_bloodtype"], $_POST["candidate_sim_a"], $_POST["candidate_sim_c"], $_POST["candidate_npwp"], $_POST["candidate_p_address"], 
					$data["candidate_p_city"], $_POST["candidate_p_postcode"], $_POST["candidate_c_address"], $data["candidate_c_city"], $_POST["candidate_c_postcode"], 
					$_POST["candidate_hp1"], $_POST["candidate_hp2"], $_POST["candidate_phone"], $_POST["candidate_cp_name1"], $data["candidate_cp_relation1"], $_POST["candidate_cp_phone1"], 
					$_POST["candidate_cp_name2"], $data["candidate_cp_relation2"], $_POST["candidate_cp_phone2"], $_POST["candidate_ref_name"]
					, $_POST["candidate_ref_division"], $_POST["candidate_ref_position"], $_POST["candidate_expected_salary"], $_POST["candidate_hobby"], $_SESSION["log_auth_id"], $_POST["candidate_id"]));
				
				//echo $query;exit;
				
				if($query) {
					unset($_SESSION["session"]);
					header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Personal Data has been updated.")."#".$_POST["menu_name"]);
					exit;
				}
				else {
					header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Personal Data update failed.")."#".$_POST["menu_name"]);
					exit;
				}
				
			}
		}
		

//part update Education
	function admin_editEdu() {

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
			$query = querying("SELECT candidate_edu_id FROM m_candidate_edu WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
						array($_POST["candidate_id"], ${"candidate_edu_degree_" . $i}, ${"candidate_edu_start_" . $i}, 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Education history has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Education history update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}
		
		
//part update Job Experiences
	function admin_editJobexp() {

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
			$query = querying("SELECT candidate_jobexp_id FROM m_candidate_jobexp WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
						array($_POST["candidate_id"], ${"candidate_jobexp_phone_" . $i}, ${"candidate_jobexp_start_" . $i}, 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Working experience(s) has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Working experience(s) update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}

	
//part update organization
	function admin_editOrg() {

		$candidate_organization_start = (isset($_POST["candidate_organization_start"]) AND $_POST["candidate_organization_start"] <> "") ? $_POST["candidate_organization_start"] : "";
		$candidate_organization_end = (isset($_POST["candidate_organization_end"]) AND $_POST["candidate_organization_end"] <> "") ? $_POST["candidate_organization_end"] : "";
		$candidate_organization_role = (isset($_POST["candidate_organization_role"]) AND $_POST["candidate_organization_role"] <> "") ? $_POST["candidate_organization_role"] : "";
		$candidate_organization_id = (isset($_POST["candidate_organization_id"]) AND $_POST["candidate_organization_id"] <> "") ? $_POST["candidate_organization_id"] : "";
		$candidate_organization_name = (isset($_POST["candidate_organization_name"]) AND $_POST["candidate_organization_name"] <> "") ? $_POST["candidate_organization_name"] : "";
		
		//print_r($candidate_organization_name);exit;
		// Search candidate_organization_id in DB, insert to array id_found
			$query = querying("SELECT candidate_organization_id FROM m_candidate_organization WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
						array($_POST["candidate_id"], $candidate_organization_name[$i], $candidate_organization_role[$i], $candidate_organization_start[$i], 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Organizational Experiences has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Organizational Experiences update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}



//part update Training
	function admin_editTraining() {

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
			$query = querying("SELECT candidate_training_id FROM m_candidate_training WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
						array($_POST["candidate_id"], ${"candidate_training_name_" . $i}, ${"candidate_training_year_" . $i}, 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Training experience(s) has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Training experience(s) update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}
	

	
//part update skills
	function admin_editSkill() {
		/* candidate_skill_id, candidate_id, candidate_skill_name, candidate_skill_level, candidate_skill_notes, user_insert, date_insert, user_update, date_update */
		$candidate_skill_notes = (isset($_POST["candidate_skill_notes"]) AND $_POST["candidate_skill_notes"] <> "") ? $_POST["candidate_skill_notes"] : "";
		$candidate_skill_level = (isset($_POST["candidate_skill_level"]) AND $_POST["candidate_skill_level"] <> "") ? $_POST["candidate_skill_level"] : "";
		$candidate_skill_id = (isset($_POST["candidate_skill_id"]) AND $_POST["candidate_skill_id"] <> "") ? $_POST["candidate_skill_id"] : "";
		$candidate_skill_name = (isset($_POST["candidate_skill_name"]) AND $_POST["candidate_skill_name"] <> "") ? $_POST["candidate_skill_name"] : "";
		
		//print_r($candidate_skill_name);exit;
		// Search candidate_skill_id in DB, insert to array id_found
			$query = querying("SELECT candidate_skill_id FROM m_candidate_skill WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
						array($_POST["candidate_id"], $candidate_skill_name[$i], $candidate_skill_level[$i], 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Skills has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Skills update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}

	
//part update language
	function admin_editLang() {

		/* candidate_language_id, candidate_id, candidate_language_name, candidate_language_read, candidate_language_write, candidate_language_conversation, 
		user_insert, date_insert, user_update, date_update */
		$candidate_language_read = (isset($_POST["candidate_language_read"]) AND $_POST["candidate_language_read"] <> "") ? $_POST["candidate_language_read"] : "";
		$candidate_language_write = (isset($_POST["candidate_language_write"]) AND $_POST["candidate_language_write"] <> "") ? $_POST["candidate_language_write"] : "";
		$candidate_language_conversation = (isset($_POST["candidate_language_conversation"]) AND $_POST["candidate_language_conversation"] <> "") ? $_POST["candidate_language_conversation"] : "";
		$candidate_language_id = (isset($_POST["candidate_language_id"]) AND $_POST["candidate_language_id"] <> "") ? $_POST["candidate_language_id"] : "";
		$candidate_language_name = (isset($_POST["candidate_language_name"]) AND $_POST["candidate_language_name"] <> "") ? $_POST["candidate_language_name"] : "";
		
		//print_r($candidate_language_name);exit;
		// Search candidate_language_id in DB, insert to array id_found
			$query = querying("SELECT candidate_language_id FROM m_candidate_language WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
					/*
					echo "<pre>";
					print_r($candidate_language_id);
					print_r($candidate_language_name);
					echo "</pre>";exit;
					*/
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
						array($_POST["candidate_id"], $candidate_language_name[$i], $candidate_language_conversation[$i], $candidate_language_read[$i], 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Language Profeciency has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Language Profeciency update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}

	
	

//part update Family
	function admin_editFam() {

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
			$query = querying("SELECT candidate_family_id FROM m_candidate_family WHERE candidate_id = ?", array($_POST["candidate_id"]));
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
						array($_POST["candidate_id"], $candidate_family_name[$i], $candidate_family_birthdate[$i], $candidate_family_relation[$i], 
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
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Family member has been updated.")."#".$_POST["menu_name"]);
				exit;
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Family member update failed.")."#".$_POST["menu_name"]);
				exit;
			}
			
	}
	


function admin_editQuestionaire() {
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
				answer_yn=?, answer_desc=?, user_update=?, date_update=NOW() WHERE answer_id=?", array($answered_yn[$i], sanitize_post($answered_desc[$i]), $_SESSION["log_auth_id"], $answer_id[$i]));
			}
		}
		else {
			if( ($question_type[$i]=="yn_desc" && $answered_yn[$i]<>"") || ($question_type[$i]=="txt_area" && $answer_desc[$i]<>"") || ($question_type[$i]=="txt_box_int" && $answer_desc[$i]<>"") || ($question_type[$i]=="txt_box_cur" && $answer_desc[$i]<>"") ) {
			
				$query=querying("INSERT INTO t_answer
				(candidate_id, question_id, answer_yn, answer_desc, answer_date, user_insert, date_insert, user_update, date_update)
				VALUES (?, ?, ?, ?, NOW(), ?, NOW(), ?, NOW())", array($_POST["candidate_id"], $question_id[$i],
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
		header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("There's ".$gagal." item failed to be updated.")."#".$_POST["menu_name"]);				
		exit;
	}
	else
	{
		header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Your answers has been updated.")."#".$_POST["menu_name"]);
		exit;
	}
	
}	
	
	
	
	
	
	
//part upload admin
function admin_upload_candidateFile() {
	//print_r($_POST);
	//exit;
		
	if(isset($_FILES['candidate_file']['tmp_name']) && isset($_FILES['candidate_file']['name']) && isset($_FILES['candidate_file']['size']) && $_FILES['candidate_file']['size']>0) {
		$extension = pathinfo($_FILES["candidate_file"]["name"], PATHINFO_EXTENSION);
		$temp_name = $_FILES['candidate_file']['tmp_name'];
		$file_name = $_FILES['candidate_file']['name'];
		$file_type = $_FILES['candidate_file']['type'];
		$file_size = $_FILES['candidate_file']['size'];
		
		/*
		echo $extension."<br>";
		echo $temp_name."<br>";
		echo $file_name."<br>";
		echo $file_type."<br>";
		echo $file_size;
		exit;
		*/
		if($file_size>$_POST["maxsize"]) {
			header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("File size is too large.")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
		else if( ($_POST["candidate_file_type"]=="coverletter" || $_POST["candidate_file_type"]=="ijazah" || $_POST["candidate_file_type"]=="transcript") && strtolower($extension)<>strtolower($_POST["fileExt"])) {
			header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Only ".strtoupper($_POST["fileExt"])." file is allowed.")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
		
		else if( ($_POST["candidate_file_type"]=="passphoto" || $_POST["candidate_file_type"]=="idcard") && strtolower($extension)<>"jpg" && strtolower($extension)<>"jpeg") {
			header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Only ".strtoupper($_POST["fileExt"])." file is allowed.")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
		
		
		
		else {
			//siap upload $_POST["fileExt"], tapi cek dulu apakah edit atau add
			$candidate_file_name=$_POST["candidate_file_type"].date("YmdHis")."_".$_POST["candidate_id"].".".strtolower($_POST["fileExt"]);
			
			if(isset($_POST["candidate_file_id_exist"]) && $_POST["candidate_file_id_exist"]<>"0" && isset($_POST["candidate_file_name_exist"]) && $_POST["candidate_file_name_exist"]<>"0") {
				//echo "edit ".$_POST["candidate_file_type"]."<br>";
				//cek apakah file yang mau dihapus ada
				if(file_exists (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
					//echo "file ketemu <br>";
					$delexisting = @chmod (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"], 0775); 
					if(!unlink(_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
						header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Delete existing image failed. Update ".$_POST["candidate_file_type"]." is abborted.")."#".$_POST["candidate_file_type"]);
						return false;
						exit;
					}	
					else {
						
						$result  =  move_uploaded_file($temp_name, _DIRFILES."/".$_POST["candFolder"]."/".$file_name);
						rename (_DIRFILES."/".$_POST["candFolder"]."/".$file_name,_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
						
						if($_POST["candidate_file_type"]=="passphoto" || $_POST["candidate_file_type"]=="idcard") {
							list($lebar, $tinggi, $type, $attr) = getimagesize(_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
							if ($lebar > $_POST["maxWidth"])
							{
								$lebarbaru=$_POST["maxWidth"];
								$tinggibaru = round(($tinggi * $_POST["maxWidth"])/$lebar);
							}
							resizeImage(_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name,$tinggibaru,$lebarbaru);
							//resizeImageFix(200, 300, 'center',  'middle', _DIRFILES."/cand_photo/".$candidate_file_name);
							$tipefile=($_POST["candidate_file_type"]=="passphoto")?"Pass Photo":"ID Card";
						}
						else {
							$tipefile="File";
						}
						//update database-nya
						$query=querying("UPDATE m_candidate_file SET candidate_file_name=? WHERE candidate_file_id=?",array($candidate_file_name,$_POST["candidate_file_id_exist"]));
						if($query) {
							header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded($tipefile." has been updated.")."#".$_POST["candidate_file_type"]);
							exit;
						}
						else {
							header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Update ".$tipefile." is failed.")."#".$_POST["candidate_file_type"]);
							exit;
						}
						
						
					}
				}
				
				//print_r($_FILES);exit;
			}
			else {
				//echo "add file"; exit;
					$result  =  move_uploaded_file($temp_name, _DIRFILES."/".$_POST["candFolder"]."/".$file_name);
					rename (_DIRFILES."/".$_POST["candFolder"]."/".$file_name,_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
					//--
					list($lebar, $tinggi, $type, $attr) = getimagesize(_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
					
					if($_POST["candidate_file_type"]=="passphoto" || $_POST["candidate_file_type"]=="idcard") {
						list($lebar, $tinggi, $type, $attr) = getimagesize(_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
						if ($lebar > $_POST["maxWidth"])
						{
							$lebarbaru=$_POST["maxWidth"];
							$tinggibaru = round(($tinggi * $_POST["maxWidth"])/$lebar);
						}
						resizeImage(_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name,$tinggibaru,$lebarbaru);
						//resizeImageFix(200, 300, 'center',  'middle', _DIRFILES."/cand_photo/".$candidate_file_name);
						$tipefile=($_POST["candidate_file_type"]=="passphoto")?"Pass Photo":"ID Card";
					}
					else {
						$tipefile="File";
					}
					
					//update database-nya
					$query=querying("INSERT INTO m_candidate_file (candidate_id, candidate_file_name, candidate_file_type, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, ?, NOW(), ?, NOW())",array($_POST["candidate_id"],$candidate_file_name,$_POST["candidate_file_type"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
					if($query) {
						header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded($tipefile." has been added.")."#".$_POST["candidate_file_type"]);
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Add ".$tipefile." is failed.")."#".$_POST["candidate_file_type"]);
						exit;
					}
				
			}

		}
		
	}	
	else {
		//tidak ada file yg akan diupload
		header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("You have to select a file to be uploaded.")."#".$_POST["candidate_file_type"]);
		return false;
		exit;
	}
}



function admin_upload_candidateFileOthers() {
	//print_r($_POST);
	//exit;
		
	if(isset($_FILES['candidate_file']['tmp_name']) && isset($_FILES['candidate_file']['name']) && isset($_FILES['candidate_file']['size']) && $_FILES['candidate_file']['size']>0) {
		$extension = pathinfo($_FILES["candidate_file"]["name"], PATHINFO_EXTENSION);
		$temp_name = $_FILES['candidate_file']['tmp_name'];
		$file_name = $_FILES['candidate_file']['name'];
		$file_type = $_FILES['candidate_file']['type'];
		$file_size = $_FILES['candidate_file']['size'];
		
		/*
		echo $extension."<br>";
		echo $temp_name."<br>";
		echo $file_name."<br>";
		echo $file_type."<br>";
		echo $file_size;
		exit;
		*/
		if($file_size>$_POST["maxsize"]) {
			header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("File size is too large.")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
		
		else if(strtolower($extension)<>strtolower($_POST["fileExt"])) {
			header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Only ".strtoupper($_POST["fileExt"])." file is allowed.")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
				
		else {
			//siap upload $_POST["fileExt"], di add
			$candidate_file_name=$_POST["candidate_file_type"].date("YmdHis")."_".$_POST["candidate_id"].".".strtolower($_POST["fileExt"]);
			
				//echo "add file"; exit;
					$result  =  move_uploaded_file($temp_name, _DIRFILES."/".$_POST["candFolder"]."/".$file_name);
					rename (_DIRFILES."/".$_POST["candFolder"]."/".$file_name,_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
					//--
					$tipefile="File";
					
					//update database-nya
					$query=querying("INSERT INTO m_candidate_fileothers (candidate_id, candidate_file_name, candidate_file_notes, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, ?, NOW(), ?, NOW())",array($_POST["candidate_id"],$candidate_file_name,$_POST["candidate_file_notes"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
					if($query) {
						header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded($tipefile." has been added.")."#".$_POST["candidate_file_type"]);
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Add ".$tipefile." is failed.")."#".$_POST["candidate_file_type"]);
						exit;
					}
				

		}
		
	}	
	else {
		//tidak ada file yg akan diupload
		header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("You have to select a file to be uploaded.")."#".$_POST["candidate_file_type"]);
		return false;
		exit;
	}
}

function admin_upload_candidateDelFileOthers() {
	if(file_exists (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
					//echo "file ketemu <br>";
					$delexisting = @chmod (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"], 0775); 
					if(!unlink(_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
						header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Delete existing image failed. Update ".$_POST["candidate_file_type"]." is abborted.")."#".$_POST["candidate_file_type"]);
						return false;
						exit;
					}	
					else {
						//delete dari databasenya
						if(querying("DELETE FROM m_candidate_fileothers WHERE candidate_file_id=? AND candidate_file_name=?",array($_POST["candidate_file_id"],$_POST["candidate_file_name_exist"]))) {
							header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&mess=".coded("Update ".$_POST["candidate_file_type"]." has been done.")."#".$_POST["candidate_file_type"]);
							return false;
							exit;
						}
						else {
							header("location: "._PATHURL."/index.php?mod=detailcandidate&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&candidate_id=".coded($_POST["candidate_id"])."&gal=".coded("1")."&mess=".coded("Update ".$_POST["candidate_file_type"]." failed, please try again later.")."#".$_POST["candidate_file_type"]);
							return false;
							exit;
						}
					}
	}
	
	
}
	
	
	
	
//end of part upload admin	
		
		function adm_processCandidate() {
			//print_r($_POST);
			//exit;
			
			$candidate_apply_id=(isset($_POST["candidate_apply_id"]) && $_POST["candidate_apply_id"]<>"")?$_POST["candidate_apply_id"]:"";
			$existing_apply_stage=(isset($_POST["existing_apply_stage"]) && $_POST["existing_apply_stage"]<>"")?$_POST["existing_apply_stage"]:"";
			$job_vacancy_id=(isset($_POST["job_vacancy_id"]) && $_POST["job_vacancy_id"]<>"")?$_POST["job_vacancy_id"]:"";
			$existing_apply_status=(isset($_POST["existing_apply_status"]) && $_POST["existing_apply_status"]<>"")?$_POST["existing_apply_status"]:"";
			$candidate_id=(isset($_POST["candidate_id"]) && $_POST["candidate_id"]<>"")?$_POST["candidate_id"]:"";

			$candidate_apply_status=(isset($_POST["candidate_apply_status"]) && $_POST["candidate_apply_status"]<>"")?$_POST["candidate_apply_status"]:"";
			$apply_history_notes=(isset($_POST["apply_history_notes"]) && $_POST["apply_history_notes"]<>"")?$_POST["apply_history_notes"]:"";
			
			$candidate_completed_date=(isset($_POST["candidate_completed_date"]) && $_POST["candidate_completed_date"]<>"")?$_POST["candidate_completed_date"]:"";
			$candidate_schedule_date=(isset($_POST["candidate_schedule_date"]) && $_POST["candidate_schedule_date"]<>"")?$_POST["candidate_schedule_date"]:"";
			$candidate_schedule_date_cvscreening=(isset($_POST["candidate_schedule_date_cvscreening"]) && $_POST["candidate_schedule_date_cvscreening"]<>"")?$_POST["candidate_schedule_date_cvscreening"]:"";
			
			//tambahan shakti 08 september 2017
			$OrgCode=(isset($_POST["OrgCode"]) && $_POST["OrgCode"]<>"")?$_POST["OrgCode"]:"";
			$JobTtlCode=(isset($_POST["JobTtlCode"]) && $_POST["JobTtlCode"]<>"")?$_POST["JobTtlCode"]:"";
			$LocationCode=(isset($_POST["LocationCode"]) && $_POST["LocationCode"]<>"")?$_POST["LocationCode"]:"";
			$ContractStart=(isset($_POST["ContractStart"]) && $_POST["ContractStart"]<>"")?$_POST["ContractStart"]:"0000-00-00 00:00:00";
			$ContractEnd=(isset($_POST["ContractEnd"]) && $_POST["ContractEnd"]<>"")?$_POST["ContractEnd"]:"0000-00-00 00:00:00";
			
			//tambahan shakti 21 Juni 2018
			$candidate_homebase=(isset($_POST["candidate_homebase"]) && $_POST["candidate_homebase"]<>"")?$_POST["candidate_homebase"]:"";
			
			// echo "orgcode=".$OrgCode."<br>";
			// echo "jobttlcode=".$JobTtlCode."<br>";
			// echo "locationcode=".$LocationCode."<br>";
			// echo "contractstart=".$ContractStart."<br>";
			// echo "contractend=".$ContractEnd."<br>";
			// exit;
			//jika status-nya join, tapi variable di atas ada yg kosong, maka harus diisi dulu.
			if($candidate_apply_status=="join" && ($OrgCode=="" || $JobTtlCode=="" || $LocationCode=="" || $ContractStart=="0000-00-00 00:00:00" || $ContractEnd=="0000-00-00 00:00:00"))
			{
				header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($existing_apply_stage)."&gal=".coded("1")."&mess=".coded("Organization, Job Title, Location, and Date Start/End are required."));
				exit;
			}
			
			$send_invitation=(isset($_POST["send_invitation"]) && $_POST["send_invitation"]<>"")?$_POST["send_invitation"]:"n";
			$mail_template_title=(isset($_POST["mail_template_title"]) && $_POST["mail_template_title"]<>"")?$_POST["mail_template_title"]:"";
			$test_location=(isset($_POST["test_location"]) && $_POST["test_location"]<>"")?$_POST["test_location"]:"";
			$mail_template_content=(isset($_POST["mail_template_content"]) && $_POST["mail_template_content"]<>"")?html_entity_decode($_POST["mail_template_content"]):"";
			$job_vacancy_pic=(isset($_POST["job_vacancy_pic"]) && $_POST["job_vacancy_pic"]<>"")?$_POST["job_vacancy_pic"]:"";
			
			$candidate_email=(isset($_POST["candidate_email"]) && $_POST["candidate_email"]<>"")?$_POST["candidate_email"]:"";
			$candidate_name=(isset($_POST["candidate_name"]) && $_POST["candidate_name"]<>"")?$_POST["candidate_name"]:"";
			/*
			echo $send_invitation."<br>".$mail_template_title."<br>".$test_location."<br>".$mail_template_content;
			exit;
			*/
			
				if($candidate_apply_status==$existing_apply_status && $apply_history_notes=="" && $candidate_completed_date=="" && $candidate_schedule_date=="") {
					//do nothing, karena ga berubah
					header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($existing_apply_stage)."&mess=".coded("No change has made."));
					exit;
				}
				else if ($candidate_apply_status==$existing_apply_status && ($apply_history_notes<>"" || $candidate_completed_date<>"" || $candidate_schedule_date<>"")){
					//cukup update tabel history
					
					
					$query=querying("INSERT INTO t_apply_history
	(candidate_id, candidate_email, job_vacancy_id, apply_history_date, apply_history_stage, apply_history_status, apply_history_notes, candidate_completed_date, candidate_schedule_date, send_invitation, mail_template_title, test_location, stage_pic, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, NOW())",array($candidate_id, $_POST["candidate_email"], $job_vacancy_id, $existing_apply_stage, $candidate_apply_status, $apply_history_notes, $candidate_completed_date, $candidate_schedule_date, $send_invitation, $mail_template_title, $test_location, $job_vacancy_pic, $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
					if($query){
						header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($existing_apply_stage)."&mess=".coded("Apply history has been updated."));
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($existing_apply_stage)."&gal=".coded("1")."&mess=".coded("Update history failed."));
						exit;
					}
				}
				else {
					//cek dulu apakah lulus atau yg lainnya
					if($candidate_apply_status=="pass"){
						//tentukan stage selanjutnya
						$candidate_apply_stage=adm_getNextStage($existing_apply_stage);
						$candidate_apply_status1="ongoing";
						
						$candidate_schedule_date_next=adm_getExistingSchedule($existing_apply_stage,$existing_apply_status,$candidate_id,$job_vacancy_id);
						$candidate_completed_date_next="0000-00-00 00:00:00";
							
					}
					else{
						$candidate_apply_stage=$existing_apply_stage;
						$candidate_apply_status1=$candidate_apply_status;
						$candidate_schedule_date_next=$candidate_schedule_date;
						$candidate_completed_date_next=$candidate_completed_date;
					}
					//update tabel candidate_apply dan insert tabel history
					
					/*print_r($_POST);
					echo "candidate_apply_stage: ".$candidate_apply_stage; 
					echo "<br>candidate_apply_status1: ".$candidate_apply_status1; 
					echo "masuk bagian ini<br>homebase= ".$candidate_homebase."<br>";

					exit;*/
					
					$query1=querying("UPDATE t_candidate_apply
									SET
										candidate_apply_stage=?,
										candidate_apply_status=?,
										candidate_completed_date=?,
										candidate_schedule_date=?,
										user_update=?,
										date_update=NOW(),
										OrgCode=?,
										JobTtlCode=?,
										LocationCode=?,
										ContractStart=?,
										ContractEnd=?,
										candidate_homebase=?
									WHERE candidate_apply_id=? AND candidate_email=?",array($candidate_apply_stage, $candidate_apply_status1, 
									$candidate_completed_date_next, $candidate_schedule_date,
									$_SESSION["log_auth_id"], $OrgCode, $JobTtlCode, $LocationCode, $ContractStart, $ContractEnd, $candidate_homebase, $candidate_apply_id, $_POST["candidate_email"]));
									
					/*$query1="UPDATE t_candidate_apply
									SET
										candidate_apply_stage=".$candidate_apply_stage.",
										candidate_apply_status=".$candidate_apply_status1.",
										candidate_completed_date=".$candidate_completed_date_next.",
										candidate_schedule_date=".$candidate_schedule_date.",
										user_update=".$_SESSION["log_auth_id"].",
										date_update=NOW(),
										OrgCode=".$OrgCode.",
										JobTtlCode=".$JobTtlCode.",
										LocationCode=".$LocationCode.",
										ContractStart=".$ContractStart.",
										ContractEnd=".$ContractEnd.",
										candidate_homebase=".$candidate_homebase."
									WHERE candidate_apply_id=".$candidate_apply_id." AND candidate_email=".$_POST["candidate_email"];
					
					echo $query1;
					exit;*/
					
					/*
					$query3=querying("UPDATE t_apply_history
									SET
										apply_history_status=?,
										candidate_completed_date=?,
										candidate_schedule_date=?,
										user_update=?,
										date_update=NOW()
									WHERE candidate_email=? AND job_vacancy_id=? AND apply_history_stage=?", array($candidate_apply_status,
										$candidate_completed_date, $candidate_schedule_date,
									$_SESSION["log_auth_id"], $_POST["candidate_email"], $job_vacancy_id, $existing_apply_stage));
					*/
					
					//echo "candidate_schedule_date_cvscreening = ".$candidate_schedule_date_cvscreening."<br>";
					//exit;
					
					if($candidate_schedule_date_cvscreening<>"") {
					$query3=querying("INSERT INTO t_apply_history
									(candidate_id, candidate_email, job_vacancy_id, apply_history_date, apply_history_stage, apply_history_status, apply_history_notes,
										candidate_completed_date, candidate_schedule_date, send_invitation, mail_template_title, test_location, stage_pic, user_insert, date_insert, user_update, date_update)
									VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, NOW())",array($candidate_id, $_POST["candidate_email"], $job_vacancy_id, $existing_apply_stage, $candidate_apply_status, 
										$apply_history_notes, $candidate_completed_date, $candidate_schedule_date_cvscreening, $send_invitation, $mail_template_title, $test_location, $job_vacancy_pic, $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
					}
					else {
						
					$query3=querying("INSERT INTO t_apply_history
									(candidate_id, candidate_email, job_vacancy_id, apply_history_date, apply_history_stage, apply_history_status, apply_history_notes,
										candidate_completed_date, candidate_schedule_date, send_invitation, mail_template_title, test_location, stage_pic, user_insert, date_insert, user_update, date_update, OrgCode, JobTtlCode, LocationCode, ContractStart, ContractEnd, candidate_homebase)
									VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, NOW(), ?, ?, ?, ?, ?, ?)",array($candidate_id, $_POST["candidate_email"], $job_vacancy_id, $existing_apply_stage, $candidate_apply_status, 
										$apply_history_notes, $candidate_completed_date, $candidate_schedule_date_next, $send_invitation, $mail_template_title, $test_location, $job_vacancy_pic, $_SESSION["log_auth_id"], $_SESSION["log_auth_id"], $OrgCode, $JobTtlCode, $LocationCode, $ContractStart, $ContractEnd, $candidate_homebase));	
					}
					
					if($candidate_apply_status=="pass") {
						$query2=querying("INSERT INTO t_apply_history
									(candidate_id, candidate_email, job_vacancy_id, apply_history_date, apply_history_stage, apply_history_status, apply_history_notes,
										candidate_completed_date, candidate_schedule_date, send_invitation, mail_template_title, test_location, stage_pic, user_insert, date_insert, user_update, date_update)
									VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, NOW())",array($candidate_id, $_POST["candidate_email"], $job_vacancy_id, $candidate_apply_stage, $candidate_apply_status1, $apply_history_notes,
										$candidate_completed_date_next, $candidate_schedule_date, $send_invitation, $mail_template_title, $test_location, $job_vacancy_pic, $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
					}
					else {
						$query2=true;
					}
					
					$adaerror=0;
					if($query1 && $query3) {
						$msg1="Update candidate status is success";
					}
					else {
						$msg1="Update candidate status failed";
						$adaerror++;
					}
					
					if($query2) {
						$msg2="Add to history is success ";
					}
					else {
						$msg2="Add to history failed ";
						$adaerror++;
					}
					
					if($adaerror>0) {
						header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($existing_apply_stage)."&gal=".coded("1")."&mess=".coded($msg1.", ".$msg2));
						exit;						
					}
					else {
						if(isset($send_invitation) && $send_invitation=="y") {
							/* kirim email ke candidate */
							$variablemail = array();
							$variablemail["sender"] 		= 'recruitment@hypermart.co.id';
							$variablemail["from"] 		= "recruitment@hypermart.co.id";
							$variablemail["fromname"] 	= "MPP Online Recruitment: Processing Status";
							$variablemail["to"] 			= $candidate_email;
							$variablemail["toName"]		= $candidate_name;
							$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
							$variablemail["subject"] 	= $mail_template_title;
							$variablemail["content"] 	= $mail_template_content;
							
							// print_r($variablemail);exit;
							// echo $variablemail["content"];exit;
							
							if (function_sending_email($variablemail))
							{
								unset($_SESSION["session"]);
								unset($variablemail);
								header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($candidate_apply_stage)."&mess=".coded("Data has been updated and a notification email has been sent to the candidate."));
								exit;	
							}
							else
							{							
								header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($candidate_apply_stage)."&mess=".coded("Sending notification email failed. Please try again later."));
								exit;	
							}	
						}
						else {
							header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($candidate_apply_stage)."&mess=".coded($msg1.", ".$msg2));
							exit;		
						}						
					}
					
				}
			
			}
			
			
			function adm_getExistingSchedule($existing_apply_stage,$existing_apply_status,$candidate_id,$job_vacancy_id) {
				$query=querying("SELECT candidate_schedule_date FROM t_apply_history WHERE apply_history_stage=? AND apply_history_status=? AND candidate_id=? AND job_vacancy_id=? ORDER BY date_update DESC LIMIT 1", array($existing_apply_stage,$existing_apply_status,$candidate_id,$job_vacancy_id));
				$data=sqlGetData($query);
				$candidate_schedule_date=$data[0]["candidate_schedule_date"];
				return $candidate_schedule_date;
			}
			
			//registrasi by admin
			function admin_registerCandidate() {
				
				if (isset($_POST)) $_POST = sanitize_post($_POST);
				if (isset($_GET)) $_GET = sanitize_post($_GET);

				//print_r($_POST);//exit;
				
				$server = $_SERVER['SERVER_NAME'];
				
				$pob=(isset($_POST["place_of_birth"]) && is_array($_POST["place_of_birth"]))?$_POST["place_of_birth"][0]:"";
					
				$missteps = array();
				if (!isset($_POST["full_name"]) or $_POST["full_name"] == "") 	$missteps[] = '0';
				if (!isset($_POST["email1"]) or $_POST["email1"] == "") 		$missteps[] = 1;
				if (!isset($_POST["sex"]) or $_POST["sex"] == "") 		$missteps[] = 2;
				if (!isset($pob) or $pob == "") 		$missteps[] = 4;
				if (!isset($_POST["birthdate"]) or $_POST["birthdate"] == "") 		$missteps[] = 5;
				if (!isset($_POST["nationality"]) or $_POST["nationality"] == "") 		$missteps[] = 7;
				if (isset($_POST["nationality"]) && $_POST["nationality"]=="wna" && $_POST["country"] == "") 		$missteps[] = 8;
				//if (isset($_POST["nationality"]) && $_POST["nationality"]=="wna" && (!isset($_POST["nomor_passport"]) || $_POST["nomor_passport"] == "") ) 		$missteps[] = 10;
				//if (isset($_POST["nationality"]) && $_POST["nationality"]=="wni" && (!isset($_POST["nomor_ktp"]) || $_POST["nomor_ktp"] == ""  || (strlen($_POST["nomor_ktp"]) < 15) || (strlen($_POST["nomor_ktp"]) > 16) )) 		$missteps[] = 37;
				
				if (isset($_POST["email1"]) && !filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL))	$missteps[] = 34;
				if (!isset($_POST["email2"]) or $_POST["email2"] == "") $missteps[] = 35;
				if (isset($_POST["email2"]) && $_POST["email2"] <> $_POST["email1"]) $missteps[] = 36;
						
				//if (isset($_POST["nomor_ktp"]) && register_checkIDCard($_POST["nomor_ktp"])) $missteps[] = 38;
				//if (isset($_POST["nomor_passport"]) && register_checkIDCard($_POST["nomor_passport"])) $missteps[] = 38;
						
				if (!isset($_POST["pwd1"]) or strlen($_POST["pwd1"]) < 6) $missteps[] = 39;
				if (!isset($_POST["pwd2"]) or $_POST["pwd2"] == "") $missteps[] = 40;
				if (isset($_POST["pwd2"]) && $_POST["pwd2"] <> $_POST["pwd1"]) $missteps[] = 41;
				
				if (isset($_POST["email1"]) && isset($_POST["email1"]) && register_checkEmail())  $missteps[] = 42;
				
				if (!isset($_POST["cellphone1"]) or $_POST["cellphone1"] == "") $missteps[] = 43;
					
				if (isset($_POST["cellphone1"]) && register_checkMobile())  $missteps[] = 44;

				/*
				print_r($missteps);
				echo "<br>".count($missteps);
				exit;
				*/

				if (count($missteps)>0)
				{
					//echo "ada error";
					for ($i=0;$i<count($missteps);$i++) {
						$notice[] = error_notice($missteps[$i]);
					}
					//print_r($notice);exit;
					$notice = json_encode($notice);
					
					$_SESSION["session"] = $_POST;
					
					if(isset($_POST["place_of_birth"]) && is_array($_POST["place_of_birth"])) {
							$_SESSION["session"]["place_of_birth"]=$_POST["place_of_birth"][0];
					}
								
					header("location: "._PATHURL."/index.php?mod=registeringcandidate&gal=".coded("1")."&missteps=".coded($notice));
					exit;
				}
				else
				{
					//echo "ga ada error"; exit;
					//echo $_POST["birthdate"];
					//exit;
					$birthdate=explode("-",$_POST["birthdate"]);
								
					$expiry_date=date('Y-m-d', strtotime("+2 week"));

					$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
					
					$candidate_birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
					
					$register_activation_code = letshashit($_POST["email1"].$candidate_birthdate,"activatereg");

					//print_r($_POST);
					/*
					echo $_POST["full_name"]."<br>". $_POST["email1"]."<br>". $_POST["pwd1"]."<br>". $_POST["place_of_birth"][0]."<br>".$candidate_birthdate."<br>". 
					$_POST["sex"]."<br>".$_POST["nationality"]."<br>".((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?"Indonesia":$_POST["country"])."<br>". 
			((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?"KTP":"Passport")."<br>".((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?$_POST["nomor_ktp"]:$_POST["nomor_passport"])."<br>". 
			$_POST["cellphone1"]."<br>". $_POST["cellphone2"]."<br>".$_POST["homephone"]."<br>".$register_activation_code;
					exit;
					*/
					
					$query = querying("INSERT INTO m_register
			(candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, 
			candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_expiry_date, register_activation_code)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)", array($_POST["full_name"], $_POST["email1"], $_POST["pwd1"], $_POST["place_of_birth"][0], 
			$candidate_birthdate, $_POST["sex"], $_POST["nationality"], ((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?"Indonesia":$_POST["country"]), 
			((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?"KTP":"Passport"), ((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?$_POST["nomor_ktp"]:$_POST["nomor_passport"]), 
			$_POST["cellphone1"], $_POST["cellphone2"], $_POST["homephone"], $expiry_date, $register_activation_code ) );
					

					if ($query)
					{
						//langsung diaktifasi
						//check apakah dia sudah ada di tabel log_auth(udah teraktivasi)
						$query = querying("SELECT log_auth_id, employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code
						FROM log_auth WHERE log_auth_name= ? ORDER BY log_auth_id DESC LIMIT 1",array($_POST["email1"]));
						$data = sqlGetData($query);
						if(count($data)>0) {
							//echo "udah pernah aktivasi dan sudah dapat user pass"; //exit;
							header("location: "._PATHURL."/index.php?mod=registeringcandidate&gal=".coded("1")."&mess=".coded("You are trying to registering an active account. Kindly use your login account to access  your member area."));
							exit;
						}
						
						$query = querying("SELECT register_id, candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_activation_code
						FROM m_register WHERE candidate_email= ? ORDER BY register_id ASC LIMIT 1",array($_POST["email1"]));
						$data = sqlGetData($query);
						$galat = 1;
						//echo "usr= ".$usr."<br>";
						//print_r($data);exit;
						
						if (count($data) > 0)
						{
							
							if($_POST["email1"] == $data[0]["candidate_email"] ) 
							{
								$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";

									$query2 = querying("INSERT INTO log_auth
						(employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code, 
						register_activation_date, status_id, user_insert, date_insert, user_update, date_update)
						VALUES (0, ?, ?, ?, NOW(), ?, ?, ?, ?, NOW(), ?, ?, NOW(), ?, NOW())",
						array($data[0]["candidate_email"], sha256mod($data[0]["register_id"].$data[0]["candidate_email"].$data[0]["candidate_passwd"]), "candid", $ipaddress, 
						$data[0]["register_id"], $data[0]["register_date"], $register_activation_code, "active", $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));

								if($query2) {
									$query = querying("SELECT log_auth_id FROM log_auth WHERE log_auth_name=? ORDER BY log_auth_id DESC LIMIT 1", array($_POST["email1"]));
									$logauth = sqlGetData($query);
									if (count($logauth) > 0) {
										$log_auth_id = $logauth[0]["log_auth_id"];
										$datalog = $data[0];
										$datalog["log_auth_id"] = $log_auth_id;
										if(admin_insertToMCandidate($datalog))	{
											querying("DELETE FROM m_register WHERE register_id = ?",array($data[0]["register_id"]));
											$galat = 0;
										}
									}
								}
							}
						}
						
						if ($galat == 0) {
							unset($_SESSION["session"]);
							header("location: "._PATHURL."/index.php?mod=candidatebyrecruiter&mess=".coded("Create candidate success. You may complete all data needed for this candidate."));
						}
						else
							header("location: "._PATHURL."/index.php?mod=candidatebyrecruiter&gal=".coded("1")."&mess=".coded("Create candidate failed, please try again later."));
						exit;
						
					}
					else {
							header("location: "._PATHURL."/index.php?mod=registeringcandidate&gal=".coded("1")."&mess=".coded("Error happen. We found difficulties in registering your account. Please try again later."));
							exit;	
					}
				}
				
				
			}
			//end of registrasi by admin
			
			function admin_insertToMCandidate($data) {
				
					if (querying("INSERT INTO m_candidate
				(log_auth_id, candidate_name, candidate_email, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, status_id, user_insert, date_insert, user_update, date_update)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, NOW())",
					array($data["log_auth_id"], $data["candidate_name"], $data["candidate_email"], $data["candidate_birthplace"], $data["candidate_birthdate"], $data["candidate_gender"], $data["candidate_nationality"], $data["candidate_country"], $data["candidate_idtype"], $data["candidate_idcard"], $data["candidate_hp1"], $data["candidate_hp2"], $data["candidate_phone"], "active", $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]) )) return true;
					else return false;	
			}
			
			
			//part history candidate
			function admin_getHistory($candidate_id, $job_vacancy_id="") {
				if(isset($job_vacancy_id) && $job_vacancy_id<>"") {
					$query=querying("SELECT a.apply_history_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.apply_history_date, 
								a.apply_history_stage, a.apply_history_status, a.apply_history_notes, a.user_insert, a.date_insert, a.date_update, a.user_update, a.candidate_schedule_date, a.candidate_completed_date,
								b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc
								FROM t_apply_history a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=?
								AND a.job_vacancy_id=?
								ORDER BY FIELD (apply_history_stage, 'final','offering','user-interview','background-check','hr-interview','psychotest','user-screening','cv-screening'), date_update DESC", array($candidate_id, $job_vacancy_id));
				}
				else {
					$query=querying("SELECT a.apply_history_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.apply_history_date, 
								a.apply_history_stage, a.apply_history_status, a.apply_history_notes, a.user_insert, a.date_insert, a.date_update, a.user_update, a.candidate_schedule_date, a.candidate_completed_date,
								b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc
								FROM t_apply_history a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=?
								ORDER BY FIELD (apply_history_stage, 'final','offering','user-interview','background-check','hr-interview','psychotest','user-screening','cv-screening'), date_update DESC", array($candidate_id));
				}
				$data=sqlGetData($query);
				return $data;

			}
			
			
			//part get applied vacancy by candidate
			function admin_getVacancyByCandidate($candidate_id,$job_vacancy_id="") {
				if(isset($job_vacancy_id) && $job_vacancy_id<>"") {
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, a.candidate_apply_stage, 
									a.candidate_apply_status, a.user_insert, a.date_insert, a.user_update, a.date_update, a.candidate_schedule_date, a.candidate_completed_date,
									b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc
									FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=?
									AND a.job_vacancy_id=?
									ORDER BY a.date_update DESC", array($candidate_id,$job_vacancy_id));
				}
				else {
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, a.candidate_apply_stage, 
									a.candidate_apply_status, a.user_insert, a.date_insert, a.user_update, a.date_update, a.candidate_schedule_date, a.candidate_completed_date,
									b.job_vacancy_id, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc
									FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=?
									ORDER BY a.date_update DESC", array($candidate_id));
				}
				$data=sqlGetData($query);
				return $data;
			}
			
			function admin_getDataApply($type="",$candidate_id) {
				if(isset($type) && $type=="open_project") {
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, a.candidate_apply_stage, a.candidate_schedule_date, a.candidate_completed_date, 
					a.candidate_apply_status, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, b.job_vacancy_brief, b.job_vacancy_degree, 
					b.job_vacancy_type, b.job_vacancy_startdate, b.job_vacancy_enddate, b.log_auth_id
					FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=? AND a.candidate_apply_status<>? ORDER BY b.job_vacancy_enddate DESC",
					array($candidate_id,"reject"));
				}
				else {
					$query=querying("SELECT a.candidate_apply_id, a.candidate_id, a.candidate_email, a.job_vacancy_id, a.candidate_apply_date, a.candidate_apply_stage, a.candidate_schedule_date, a.candidate_completed_date, 
					a.candidate_apply_status, b.job_vacancy_name, b.job_vacancy_city, b.job_vacancy_desc, b.job_vacancy_brief, b.job_vacancy_degree, 
					b.job_vacancy_type, b.job_vacancy_startdate, b.job_vacancy_enddate, b.log_auth_id
					FROM t_candidate_apply a LEFT JOIN m_job_vacancy b ON a.job_vacancy_id=b.job_vacancy_id WHERE a.candidate_id=? ORDER BY b.job_vacancy_enddate DESC",
					array($candidate_id));
				}
				$data=sqlGetData($query);
				return $data;
			}

			function admin_getNumApply($type,$candidate_id) {
				$datApply=admin_getDataApply($type,$candidate_id);
				$numApply=count($datApply);
				return $numApply;
			}
			
			function adm_activateRegistrant() {
				//print_r($_POST);
				
				//langsung diaktifasi
				//check apakah dia sudah ada di tabel log_auth(udah teraktivasi)
				$query = querying("SELECT log_auth_id, employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code
				FROM log_auth WHERE log_auth_name= ? ORDER BY log_auth_id DESC LIMIT 1",array($_POST["candidate_email"]));
				$data = sqlGetData($query);
				if(count($data)>0) {
					//echo "udah pernah aktivasi dan sudah dapat user pass"; //exit;
					header("location: "._PATHURL."/index.php?mod=applicants&type=register&gal=".coded("1")."&mess=".coded("You are trying to registering an active account. Kindly use your login account to access  your member area."));
					exit;
				}
				
				$query = querying("SELECT register_id, candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_activation_code
				FROM m_register WHERE register_id=? AND candidate_email= ? ORDER BY register_id ASC LIMIT 1",array($_POST["register_id"],$_POST["candidate_email"]));
				$data = sqlGetData($query);
				$galat = 1;
				//echo "usr= ".$usr."<br>";
				//print_r($data);exit;
				
				if (count($data) > 0)
				{
					
					if($_POST["candidate_email"] == $data[0]["candidate_email"] ) 
					{
						$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";	
						$candidate_birthdate = reverseDate($data[0]["candidate_birthdate"]);
						
						$register_activation_code = letshashit($_POST["candidate_email"].$candidate_birthdate,"activatereg");

						
						
							$query2 = querying("INSERT INTO log_auth
				(employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code, 
				register_activation_date, status_id, user_insert, date_insert, user_update, date_update)
				VALUES (0, ?, ?, ?, NOW(), ?, ?, ?, ?, NOW(), ?, ?, NOW(), ?, NOW())",
				array($data[0]["candidate_email"], sha256mod($data[0]["register_id"].$data[0]["candidate_email"].$data[0]["candidate_passwd"]), "candid", $ipaddress, 
				$data[0]["register_id"], $data[0]["register_date"], $register_activation_code, "active", $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));

						if($query2) {
							$query = querying("SELECT log_auth_id FROM log_auth WHERE log_auth_name=? ORDER BY log_auth_id DESC LIMIT 1", array($_POST["candidate_email"]));
							$logauth = sqlGetData($query);
							if (count($logauth) > 0) {
								$log_auth_id = $logauth[0]["log_auth_id"];
								$datalog = $data[0];
								$datalog["log_auth_id"] = $log_auth_id;
								if(admin_insertToMCandidate($datalog))	{
									querying("DELETE FROM m_register WHERE register_id = ?",array($data[0]["register_id"]));
									$galat = 0;
								}
							}
						}
					}
				}
				
				if ($galat == 0) {
					unset($_SESSION["session"]);
					header("location: "._PATHURL."/index.php?mod=applicants&type=register&mess=".coded("Activate candidate success. You may complete all data needed for this candidate."));
				}
				else
					header("location: "._PATHURL."/index.php?mod=applicants&type=register&gal=".coded("1")."&mess=".coded("Activate candidate failed, please try again later."));
				exit;
				
				
				
			}

			
			function adm_applyForCandidate() {
				//print_r($_POST);exit;
				$is_applied=vacancy_isApplied($_POST["candidate_id"],$_POST["candidate_email"],$_POST["job_vacancy_id"]);
				if($is_applied) {
					header("location: "._PATHURL."/index.php?mod=candidatebyrecruiter&gal=".coded("1")."&mess=".coded("Candidate has been applied for the position."));
					exit;						
				}
				else {
					$query1=querying("INSERT INTO t_candidate_apply
	(candidate_id, candidate_email, job_vacancy_id, candidate_apply_date, candidate_apply_stage, candidate_apply_status, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, NOW(), ?, ?, ?, NOW(), ?, NOW())", array($_POST["candidate_id"],$_POST["candidate_email"],$_POST["job_vacancy_id"],"cv-screening","ongoing", $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
					
					$query2=querying("INSERT INTO t_apply_history
									(candidate_id, candidate_email, job_vacancy_id, apply_history_date, apply_history_stage, apply_history_status, apply_history_notes, user_insert, date_insert, user_update, date_update)
									VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, NOW(), ?, NOW())",array($_POST["candidate_id"], $_POST["candidate_email"], $_POST["job_vacancy_id"], "cv-screening", "ongoing", $_POST["apply_history_notes"], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
									
					$adaerror=0;
					if($query1) {
						$msg1="Applying for the candidate is success";
					}
					else {
						$msg1="Applying for the candidate is failed";
						$adaerror++;
					}
					
					if($query2) {
						$msg2="Add to history is success ";
					}
					else {
						$msg2="Add to history failed ";
						$adaerror++;
					}
					
					if($adaerror>0) {
						header("location: "._PATHURL."/index.php?mod=candidatebyrecruiter&gal=".coded("1")."&mess=".coded($msg1.", ".$msg2));
						exit;						
					}
					else {
						header("location: "._PATHURL."/index.php?mod=candidatebyrecruiter&mess=".coded($msg1.", ".$msg2));
						exit;						
					}
					
				
				}
			}
			


			function admin_checkDuplicateUser($email) {
				$query=querying("SELECT employee_id FROM m_employee WHERE employee_email=? ORDER BY employee_id ASC LIMIT 1",array($email));
				$data1 = sqlGetData($query);
				
				$query=querying("SELECT log_auth_id FROM log_auth WHERE log_auth_name=? ORDER BY log_auth_id ASC LIMIT 1",array($email));
				$data2 = sqlGetData($query);
				
				if(count($data1)==0 && count($data2)==0) return false;	else return true;
			}

			function admin_checkDuplicateNik($nik) {
				$query=querying("SELECT employee_id FROM m_employee WHERE employee_nik=? ORDER BY employee_id ASC LIMIT 1",array($nik));
				$data1 = sqlGetData($query);
								
				if(count($data1)==0) return false;	else return true;
			}

			
			function admin_updateUser() {
				//print_r($_POST);
				//check dulu sebelum diinput ke tabel log_auth dan tabel m_employee, kalo sudah terdaftar tidak boleh diinputkan lagi.
				//employee_name, employee_nik, log_auth_name, log_auth_role, division_id, status_id, log_auth_id, mod, page, upd_type
				$type=(isset($_POST["upd_type"]) && $_POST["upd_type"]=="edit")?"edit":"add";
				
				$missteps = array();
				if (!isset($_POST["employee_name"]) or $_POST["employee_name"] == "") 	$missteps[] = '0';
				if (!isset($_POST["log_auth_name"]) or $_POST["log_auth_name"] == "") 		$missteps[] = 1;
				if (!isset($_POST["employee_nik"]) or $_POST["employee_nik"] == "") 		$missteps[] = 57;
				if (!isset($_POST["log_auth_role"]) or $_POST["log_auth_role"] == "") 		$missteps[] = 58;
				if (!isset($_POST["division_id"]) or $_POST["division_id"] == "") 		$missteps[] = 59;
				
				if(isset($_POST["upd_type"]) && $_POST["upd_type"]<>"edit") {
					if (isset($_POST["log_auth_name"]) && isset($_POST["log_auth_name"]) && admin_checkDuplicateUser($_POST["log_auth_name"]))  $missteps[] = 42;
					if (isset($_POST["employee_nik"]) && isset($_POST["employee_nik"]) && admin_checkDuplicateNik($_POST["employee_nik"]))  $missteps[] = 60;
				}
				
				if (count($missteps)>0)
				{
					//echo "ada error";
					for ($i=0;$i<count($missteps);$i++) {
						$notice[] = error_notice($missteps[$i]);
					}
					//print_r($notice);exit;
					$notice = json_encode($notice);
					
					$_SESSION["session"] = $_POST;
													
					header("location: "._PATHURL."/index.php?mod=updateuser&type=".$type."&log_auth_id=".coded($_POST["log_auth_id"])."&view=".coded($_POST["log_auth_role"])."&page=".$_POST["page"]."&gal=".coded("1")."&missteps=".coded($notice));
					exit;
				}
				else
				{
					//echo "ga ada error"; exit;
					//jika upd_type="edit"
					if(isset($_POST["upd_type"]) && $_POST["upd_type"]=="edit") {
						//edit user
						$query1=querying("UPDATE log_auth SET log_auth_role=?, status_id=?, user_update=?, date_update=NOW()
										WHERE log_auth_id=?",array($_POST["log_auth_role"], $_POST["status_id"], $_SESSION["log_auth_id"], $_POST["log_auth_id"]));
						
						$query2=querying("UPDATE m_employee SET division_id=?, employee_name=?, status_id=?, 
										user_update=?, date_update=NOW() WHERE employee_id=?",array($_POST["division_id"], $_POST["employee_name"], 
										$_POST["status_id"], $_SESSION["log_auth_id"], $_POST["employee_id"]));
										
						$adaerror=0;
						if($query1) {
							$msg1="Update user account succeed";
						}
						else {
							$msg1="Update user account is failed";
							$adaerror++;
						}
						
						if($query2){
							$msg2="Update employee detail succeed";
						}
						else {
							$msg1="Update employee detail is failed";
							$adaerror++;
						}
						
						if($adaerror>0) {
							header("location: "._PATHURL."/index.php?mod=adminmgmt&page=".$_POST["page"]."&gal=".coded("1")."&mess=".coded($msg1.", ".$msg2));
							exit;						
						}
						else {
							unset($_SESSION["session"]);
							header("location: "._PATHURL."/index.php?mod=adminmgmt&page=".$_POST["page"]."&mess=".coded($msg1.", ".$msg2));
							exit;						
						}

						
					}
					else {
						$query1=querying("INSERT INTO m_employee
							(division_id, employee_name, employee_nik, employee_email, status_id, user_insert, date_insert, user_update, date_update)
							VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, NOW())",array($_POST["division_id"], $_POST["employee_name"], $_POST["employee_nik"], $_POST["log_auth_name"], $_POST["status_id"], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
						if($query1){
							$query=querying("SELECT employee_id, employee_email, employee_nik FROM m_employee WHERE employee_email=?",array($_POST["log_auth_name"]));
							$dat=sqlGetData($query);
							if(count($dat)>0){
								$password=sha256mod("0".$dat[0]["employee_email"].$dat[0]["employee_nik"]);
								$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
								$query2=querying("INSERT INTO log_auth
									(employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code, 
									register_activation_date, status_id, user_insert, date_insert, user_update, date_update)
									VALUES (?, ?, ?, ?, NOW(), ?, ?, NOW(), ?, NOW(), ?, ?, NOW(), ?, NOW())",array($dat[0]["employee_id"], $_POST["log_auth_name"], $password, $_POST["log_auth_role"], 
									$ipaddress, "0", "activationcode", $_POST["status_id"], $_SESSION["log_auth_id"], $_SESSION["log_auth_id"]));
								if($query2){
									//berhasil diinput dan create account user
									unset($_SESSION["session"]);
									header("location: "._PATHURL."/index.php?mod=updateuser&mess=".coded("New user account has been created successfully."));
									exit;						
									
								}
								else{
									header("location: "._PATHURL."/index.php?mod=updateuser&gal=".coded("1")."&mess=".coded("Insert to table employee is succeed but user account can not created."));
									exit;						
								}
									
							}
							else{
								header("location: "._PATHURL."/index.php?mod=updateuser&gal=".coded("1")."&mess=".coded("Insert to table employee is succeed with an error."));
								exit;						
							}
						}								
						else {
							header("location: "._PATHURL."/index.php?mod=updateuser&gal=".coded("1")."&mess=".coded("Add new user failed."));
							exit;						
						}						
							
					}
					
				}
						
			}
			
			
			function adm_delUser() {
				$employee_id=(isset($_POST["employee_id"]) && $_POST["employee_id"]<>"")?$_POST["employee_id"]:"";
				
				if($employee_id<>"") {
					//inactive user
					$query1=querying("UPDATE log_auth SET status_id=?, user_update=?, date_update=NOW()
									WHERE employee_id=?",array("inactive", $_SESSION["log_auth_id"], $employee_id));
					
					$query2=querying("UPDATE m_employee SET status_id=?, 
									user_update=?, date_update=NOW() WHERE employee_id=?",array("inactive", $_SESSION["log_auth_id"], $employee_id));

										
					if($query1 && $query2) {
						header("location: "._PATHURL."/index.php?mod=adminmgmt&mess=".coded("Delete user success."));
						exit;						
					}
					else {
						header("location: "._PATHURL."/index.php?mod=adminmgmt&gal=".coded("1")."&mess=".coded("Delete user failed."));
						exit;	
					}
				}
				else {
					header("location: "._PATHURL."/index.php?mod=adminmgmt&gal=".coded("1")."&mess=".coded("Make sure to choose an existing user."));
					exit;					
				}
			}
			
			function adm_updateHowTo() {
				//print_r($_POST);exit;
				$missteps = array();
				if (!isset($_POST["howto_desc"]) or $_POST["howto_desc"] == "") 	$missteps[] = '61';
				
				if (count($missteps)>0)
				{
					//echo "ada error";
					for ($i=0;$i<count($missteps);$i++) {
						$notice[] = error_notice($missteps[$i]);
					}
					//print_r($notice);exit;
					$notice = json_encode($notice);
					
					$_SESSION["session"] = $_POST;
													
					header("location: "._PATHURL."/index.php?mod=admhowto&gal=".coded("1")."&missteps=".coded($notice));
					exit;
				}
				else
				{
					$query=querying("UPDATE m_howto
									SET
										howto_desc=?,
										user_update=?,
										date_update=NOW()
									WHERE howto_id=?", array($_POST["howto_desc"],$_SESSION["log_auth_id"],$_POST["howto_id"]));
									
					if($query){
						//berhasil update howto
						unset($_SESSION["session"]);
						header("location: "._PATHURL."/index.php?mod=admhowto&mess=".coded("How to description has been updated successfully."));
						exit;						
						
					}
					else{
						header("location: "._PATHURL."/index.php?mod=admhowto&gal=".coded("1")."&mess=".coded("How to description update failed."));
						exit;						
					}
					
				}
				
			}
			
			function admin_getBanner() {
				$query = querying("SELECT banner_id, banner_name, banner_active FROM m_banner", array());
				$banner = sqlGetData($query);
				return $banner;
			}
			
			function admin_getMailTemplate() {
				$query = querying("SELECT mail_template_id, mail_template_title, mail_template_content, mail_template_status FROM m_mail_template WHERE mail_template_active=?", array("y"));
				$template = sqlGetData($query);
				return $template;
			}
			
			function admin_getMailContent($mail_template_title) {
				$query = querying("SELECT mail_template_id, mail_template_title, mail_template_content FROM m_mail_template WHERE mail_template_active=? and mail_template_title=?", array("y",$mail_template_title));
				$template = sqlGetData($query);
				$mail_template_content=$template[0]["mail_template_content"];
				return $mail_template_content;
			}

			function adm_editBanner() {
				//echo "dink";
				$banner_id=(isset($_POST["banner_id"]) && $_POST["banner_id"]<>"")?$_POST["banner_id"]:"";
				$banner_active=(isset($_POST["banner_active"]) && $_POST["banner_active"]<>"")?$_POST["banner_active"]:"";
				//print_r($banner_active);exit;
				
				$sukses=0;
				for($i=0;$i<count($banner_id);$i++){
					$query = querying("UPDATE m_banner SET banner_active=? WHERE banner_id=?", array($banner_active[$i],$banner_id[$i]));
					if($query){
						$sukses++;
					}
				}
				if($sukses<count($banner_id)) {
					header("location: "._PATHURL."/index.php?mod=admbanner&gal=".coded("1")."&mess=".coded("Banner update failed."));
					exit;
				}
				else {
					header("location: "._PATHURL."/index.php?mod=admbanner&mess=".coded("Pictures of Banner has been updated."));
					exit;
				}
			}
			
			function adm_addBanner() {
				//print_r($_POST);
				//exit;
					
				if(isset($_FILES['banner_name']['tmp_name']) && isset($_FILES['banner_name']['name']) && isset($_FILES['banner_name']['size']) && $_FILES['banner_name']['size']>0) {
					$extension = pathinfo($_FILES["banner_name"]["name"], PATHINFO_EXTENSION);
					$temp_name = $_FILES['banner_name']['tmp_name'];
					$file_name = $_FILES['banner_name']['name'];
					$file_type = $_FILES['banner_name']['type'];
					$file_size = $_FILES['banner_name']['size'];
					
					/*
					echo $extension."<br>";
					echo $temp_name."<br>";
					echo $file_name."<br>";
					echo $file_type."<br>";
					echo $file_size;
					exit;
					*/
					if($file_size>$_POST["maxsize"]) {
						header("location: "._PATHURL."/index.php?mod=admbanner&gal=".coded("1")."&mess=".coded("File size is too large."));
						return false;
						exit;
					}
					else if( strtolower($extension)<>"jpeg" && strtolower($extension)<>"jpg" && strtolower($extension)<>"png"  ) {
						header("location: "._PATHURL."/index.php?mod=admbanner&gal=".coded("1")."&mess=".coded("Only jpg/jpeg or png file is allowed."));
						return false;
						exit;
					}
										
					
					
					else {
						//siap upload add			
						//echo "siap Upload";exit;
						$new_file_name=date("YmdHis").".".strtolower($extension);
						$result  =  move_uploaded_file($temp_name, _DESIGNPATH."/images/".$file_name);
						
						if($result) {
							rename (_DESIGNPATH."/images/".$file_name,_DESIGNPATH."/images/".$new_file_name);
							//--
							list($lebar, $tinggi, $type, $attr) = getimagesize(_DESIGNPATH."/images/".$new_file_name);
													
								if ($lebar > $_POST["maxWidth"])
								{
									$lebarbaru=$_POST["maxWidth"];
									$tinggibaru = round(($tinggi * $_POST["maxWidth"])/$lebar);
								}
								else {
									$lebarbaru=1000;
									$tinggibaru = 200;
									
								}
								resizeImage(_DESIGNPATH."/images/".$new_file_name,$tinggibaru,$lebarbaru);
								//resizeImageFix(200, 300, 'center',  'middle', _DIRFILES."/cand_photo/".$candidate_file_name);
							
							
							//update database-nya
							$query=querying("INSERT INTO m_banner (banner_name, banner_active, user_insert, date_insert, user_update, date_update)
			VALUES (?, ?, ?, NOW(), ?, NOW())",array($new_file_name,"n",$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
							if($query) {
								header("location: "._PATHURL."/index.php?mod=admbanner&mess=".coded("Picture has been added."));
								exit;
							}
							else {
								header("location: "._PATHURL."/index.php?mod=admbanner&gal=".coded("1")."&mess=".coded("Add Picture is failed."));
								exit;
							}
						}
						else {
							header("location: "._PATHURL."/index.php?mod=admbanner&gal=".coded("1")."&mess=".coded("Add Picture is failed."));
							exit;							
						}
					}
				}	
				else {
					//tidak ada file yg akan diupload
					header("location: "._PATHURL."/index.php?mod=admbanner&gal=".coded("1")."&mess=".coded("You have to select a file to be uploaded."));
					return false;
					exit;
				}
			}
			
			function adm_emailCvToUser() {
				//print_r($_POST);
				/* kirim email ke candidate */
				
				$mail_template_content=$_POST["message"];
				
				$job_vacancy_id=(isset($_POST["job_vacancy_id"]) && $_POST["job_vacancy_id"]<>"")?$_POST["job_vacancy_id"]:"";
				$candidate_apply_stage=(isset($_POST["candidate_apply_stage"]) && $_POST["candidate_apply_stage"]<>"")?$_POST["candidate_apply_stage"]:"";
				
				
				$variablemail = array();
				$variablemail["sender"] 		= 'recruitment@hypermart.co.id';
				$variablemail["from"] 		= "recruitment@hypermart.co.id";
				$variablemail["fromname"] 	= "MPP Online Recruitment";
				$variablemail["to"] 			= $_POST["user_email"];
				$variablemail["toName"]		= $_POST["user_name"];
				$variablemail["attachment"] = $_POST["filecv"];
				$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
				$variablemail["subject"] 	= "Shortlisted CV need to be reviewed";
				$variablemail["content"] 	= $mail_template_content;
				
				$variablemail["pathfiledir"] = _DIRFILES."/cand_cv_to_user";
				//print_r($variablemail);exit;
				//echo $variablemail["content"];exit;
				
				if (function_sending_email($variablemail))
				{
					unset($_SESSION["session"]);
					unset($variablemail);
					foreach($_POST["filecv"] as $filecv) {
						if(file_exists (_DIRFILES."/cand_cv_to_user/".$filecv)) {
							unlink(_DIRFILES."/cand_cv_to_user/".$filecv);
						}
					}
					header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($candidate_apply_stage)."&mess=".coded("Shortlisted candidate has been sent to be reviewed by users."));
					exit;	
				}
				else
				{							
					header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($job_vacancy_id)."&candidate_apply_stage=".coded($candidate_apply_stage)."&mess=".coded("Sending email of shortlisted candidate has failed. Please try again later."));
					exit;	
				}
				
				
			}
			
			function admin_getHomeBase() {
				$query=querying("SELECT city_code, city_name FROM m_homebase ORDER BY city_name ASC", array());
				$data=sqlGetData($query);
				return $data;
			}
			
} // end of authorized area.
?>