<?php
if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {

	function adm_searchCandidate() {
		//print_r($_POST);

		$chk_candidate_name=(isset($_POST["chk_candidate_name"]) && $_POST["chk_candidate_name"]=="1")?"1":"0";
		$chk_candidate_email=(isset($_POST["chk_candidate_email"]) && $_POST["chk_candidate_email"]=="1")?"1":"0";
		$chk_candidate_edu_degree=(isset($_POST["chk_candidate_edu_degree"]) && $_POST["chk_candidate_edu_degree"]=="1")?"1":"0";
		$chk_candidate_edu_major=(isset($_POST["chk_candidate_edu_major"]) && $_POST["chk_candidate_edu_major"]=="1")?"1":"0";
		$chk_graduate=(isset($_POST["chk_graduate"]) && $_POST["chk_graduate"]=="1")?"1":"0";
		
		$chk_candidate_jobexp_lob=(isset($_POST["chk_candidate_jobexp_lob"]) && $_POST["chk_candidate_jobexp_lob"]=="1")?"1":"0";
		$chk_candidate_jobexp_position=(isset($_POST["chk_candidate_jobexp_position"]) && $_POST["chk_candidate_jobexp_position"]=="1")?"1":"0";
		$chk_candidate_c_city=(isset($_POST["chk_candidate_c_city"]) && $_POST["chk_candidate_c_city"]=="1")?"1":"0";
		$chk_candidate_religion=(isset($_POST["chk_candidate_religion"]) && $_POST["chk_candidate_religion"]=="1")?"1":"0";
		$chk_candidate_gender=(isset($_POST["chk_candidate_gender"]) && $_POST["chk_candidate_gender"]=="1")?"1":"0";

		
		$candidate_name=(isset($_POST["candidate_name"]) && $_POST["candidate_name"]<>"")?$_POST["candidate_name"]:"";
		$candidate_email=(isset($_POST["candidate_email"]) && $_POST["candidate_email"]<>"")?$_POST["candidate_email"]:"";
		$candidate_edu_degree=(isset($_POST["candidate_edu_degree"]) && $_POST["candidate_edu_degree"]<>"")?$_POST["candidate_edu_degree"]:"";
		$candidate_edu_major=(isset($_POST["candidate_edu_major"]) && $_POST["candidate_edu_major"]<>"")?$_POST["candidate_edu_major"]:"";
		$candidate_edu_end1=(isset($_POST["candidate_edu_end1"]) && $_POST["candidate_edu_end1"]<>"")?$_POST["candidate_edu_end1"]:"";
		$candidate_edu_end2=(isset($_POST["candidate_edu_end2"]) && $_POST["candidate_edu_end2"]<>"")?$_POST["candidate_edu_end2"]:"";

		$candidate_jobexp_lob=(isset($_POST["candidate_jobexp_lob"]) && $_POST["candidate_jobexp_lob"]<>"")?$_POST["candidate_jobexp_lob"][0]:"";
		$candidate_jobexp_position=(isset($_POST["candidate_jobexp_position"]) && $_POST["candidate_jobexp_position"]<>"")?$_POST["candidate_jobexp_position"]:"";
		$candidate_c_city=(isset($_POST["candidate_c_city"]) && $_POST["candidate_c_city"]<>"")?$_POST["candidate_c_city"][0]:"";
		$candidate_religion=(isset($_POST["candidate_religion"]) && $_POST["candidate_religion"]<>"")?$_POST["candidate_religion"]:"";
		$candidate_gender=(isset($_POST["candidate_gender"]) && $_POST["candidate_gender"]<>"")?$_POST["candidate_gender"]:"";
		
		$query="SELECT a.candidate_id, a.log_auth_id, a.candidate_name, a.candidate_email, a.candidate_gender, a.candidate_religion, a.candidate_birthdate, 
						a.candidate_c_address, a.candidate_c_city, a.candidate_c_postcode, a.candidate_hp1, a.candidate_expected_salary";
						
		if($chk_candidate_edu_degree=="1" && $candidate_edu_degree<>"") {
			$query .= ", b.candidate_edu_id, b.candidate_edu_degree, b.candidate_edu_institution, b.candidate_edu_gpa";
		}

		if($chk_candidate_edu_major=="1" && $candidate_edu_major<>"") {
			$query .= ", b.candidate_edu_major";
		}

		if($chk_graduate=="1" && $chk_graduate<>"") {
			$query .= ", b.candidate_edu_end";
		}
		
		if( ($chk_candidate_jobexp_lob=="1" && $candidate_jobexp_lob<>"") || ($chk_candidate_jobexp_position=="1" && $candidate_jobexp_position<>"") ) {		
			$query .= ", c.candidate_jobexp_id, c.candidate_jobexp_lob, c.candidate_jobexp_position";				
		}
		
		$query .= " FROM m_candidate a";

		if($chk_candidate_edu_degree=="1" && $candidate_edu_degree<>"") {
			$query .=" LEFT JOIN m_candidate_edu b ON a.candidate_id=b.candidate_id";
		}
		
		if( ($chk_candidate_jobexp_lob=="1" && $candidate_jobexp_lob<>"") || ($chk_candidate_jobexp_position=="1" && $candidate_jobexp_position<>"") ) {	
			$query .=" LEFT JOIN m_candidate_jobexp c ON a.candidate_id=c.candidate_id";
		}

		$query .= " WHERE a.status_id='active'";

		if($chk_candidate_name=="1" && $candidate_name<>"") {
			$query .=" AND a.candidate_name LIKE '".$candidate_name."'";
		}
		if($chk_candidate_email=="1" && $candidate_email<>"") {
			$query .=" AND a.candidate_email LIKE '".$candidate_email."'";
		}
		
		if($chk_candidate_edu_degree=="1" && $candidate_edu_degree<>"") {
			$query .=" AND b.candidate_edu_degree = '".$candidate_edu_degree."'";
		}
		
		if($chk_candidate_edu_major=="1" && $candidate_edu_major<>"") {
			$query .=" AND b.candidate_edu_major like '".$candidate_edu_major."'";
		}
		
		if($chk_graduate=="1" && $candidate_edu_end1<>"" && $candidate_edu_end2<>"") {
			$query .=" AND b.candidate_edu_end BETWEEN ('".$candidate_edu_end1."' AND '".$candidate_edu_end2."') ";
		}
		
		if($chk_candidate_jobexp_lob=="1" && $candidate_jobexp_lob<>"") {
			$query .=" AND c.candidate_jobexp_lob = '".$candidate_jobexp_lob."'";
		}
		if($chk_candidate_jobexp_position=="1" && $candidate_jobexp_position<>"") {
			$query .=" AND c.candidate_jobexp_position = '".$candidate_jobexp_position."'";
		}
		if($chk_candidate_c_city=="1" && $candidate_c_city<>"") {
			$query .=" AND c.candidate_c_city = '".$candidate_c_city."'";
		}
		if($chk_candidate_religion=="1" && $candidate_religion<>"") {
			$query .=" AND c.candidate_religion = '".$candidate_religion."'";
		}
		if($chk_candidate_gender=="1" && $candidate_gender<>"") {
			$query .=" AND c.candidate_gender = '".$candidate_gender."'";
		}
		
		//echo $query;
		$sql=querying($query,array());
		
		if($sql) {
			$data=sqlGetData($sql);
		}
		else {
			$data=array();
		}
		
		return $data;

	}
	//end of adm_searchCandidate;
		

	function adm_search() {
		$chk_candidate_name=(isset($_POST["chk_candidate_name"]) && $_POST["chk_candidate_name"]=="1")?"1":"0";
		$chk_candidate_email=(isset($_POST["chk_candidate_email"]) && $_POST["chk_candidate_email"]=="1")?"1":"0";
		$chk_candidate_edu_degree=(isset($_POST["chk_candidate_edu_degree"]) && $_POST["chk_candidate_edu_degree"]=="1")?"1":"0";
		$chk_candidate_edu_major=(isset($_POST["chk_candidate_edu_major"]) && $_POST["chk_candidate_edu_major"]=="1")?"1":"0";
		$chk_graduate=(isset($_POST["chk_graduate"]) && $_POST["chk_graduate"]=="1")?"1":"0";
		$chk_candidate_jobexp_lob=(isset($_POST["chk_candidate_jobexp_lob"]) && $_POST["chk_candidate_jobexp_lob"]=="1")?"1":"0";
		$chk_candidate_jobexp_position=(isset($_POST["chk_candidate_jobexp_position"]) && $_POST["chk_candidate_jobexp_position"]=="1")?"1":"0";
		$chk_candidate_c_city=(isset($_POST["chk_candidate_c_city"]) && $_POST["chk_candidate_c_city"]=="1")?"1":"0";
		$chk_candidate_religion=(isset($_POST["chk_candidate_religion"]) && $_POST["chk_candidate_religion"]=="1")?"1":"0";
		$chk_candidate_gender=(isset($_POST["chk_candidate_gender"]) && $_POST["chk_candidate_gender"]=="1")?"1":"0";

		
		$candidate_name=(isset($_POST["candidate_name"]) && $_POST["candidate_name"]<>"")?$_POST["candidate_name"]:"";
		$candidate_email=(isset($_POST["candidate_email"]) && $_POST["candidate_email"]<>"")?$_POST["candidate_email"]:"";
		$candidate_edu_degree=(isset($_POST["candidate_edu_degree"]) && $_POST["candidate_edu_degree"]<>"")?$_POST["candidate_edu_degree"]:"";
		$candidate_edu_major=(isset($_POST["candidate_edu_major"]) && $_POST["candidate_edu_major"]<>"")?$_POST["candidate_edu_major"]:"";
		$candidate_edu_end1=(isset($_POST["candidate_edu_end1"]) && $_POST["candidate_edu_end1"]<>"")?$_POST["candidate_edu_end1"]:"";
		$candidate_edu_end2=(isset($_POST["candidate_edu_end2"]) && $_POST["candidate_edu_end2"]<>"")?$_POST["candidate_edu_end2"]:"";

		$candidate_jobexp_lob=(isset($_POST["candidate_jobexp_lob"]) && $_POST["candidate_jobexp_lob"]<>"")?$_POST["candidate_jobexp_lob"][0]:"";
		$candidate_jobexp_position=(isset($_POST["candidate_jobexp_position"]) && $_POST["candidate_jobexp_position"]<>"")?$_POST["candidate_jobexp_position"]:"";
		$candidate_c_city=(isset($_POST["candidate_c_city"]) && $_POST["candidate_c_city"]<>"")?$_POST["candidate_c_city"][0]:"";
		$candidate_religion=(isset($_POST["candidate_religion"]) && $_POST["candidate_religion"]<>"")?$_POST["candidate_religion"]:"";
		$candidate_gender=(isset($_POST["candidate_gender"]) && $_POST["candidate_gender"]<>"")?$_POST["candidate_gender"]:"";

		//echo $candidate_c_city;
		//print_r($_POST);
		
		
		//$limit=2;
		$link="index.php?mod=admsearch";


		if($chk_candidate_name=="1" && $candidate_name<>"") {
			$link .="&candidate_name=".base64_encode($candidate_name);
		}
		if($chk_candidate_email=="1" && $candidate_email<>"") {
			$link .="&candidate_email=".base64_encode($candidate_email);
		}
		
		if($chk_candidate_edu_degree=="1" && $candidate_edu_degree<>"") {
			$link .="&candidate_edu_degree=".$candidate_edu_degree;
		}		

		if($chk_candidate_edu_major=="1" && $candidate_edu_major<>"") {
			$link .="&candidate_edu_major=".base64_encode($candidate_edu_major);
		}

		if($chk_graduate=="1" && $candidate_edu_end1<>"" && $candidate_edu_end2<>"") {
			$link .="&candidate_edu_end1=".$candidate_edu_end1;
			$link .="&candidate_edu_end2=".$candidate_edu_end2;
		}

		if($chk_candidate_jobexp_lob=="1" && $candidate_jobexp_lob<>"") {
			$link .="&candidate_jobexp_lob=".base64_encode($candidate_jobexp_lob);
		}
		if($chk_candidate_jobexp_position=="1" && $candidate_jobexp_position<>"") {
			$link .="&candidate_jobexp_position=".base64_encode($candidate_jobexp_position);
		}
		if($chk_candidate_c_city=="1" && $candidate_c_city<>"") {
			$link .="&candidate_c_city=".base64_encode($candidate_c_city);
		}
		if($chk_candidate_religion=="1" && $candidate_religion<>"") {
			$link .="&candidate_religion=".$candidate_religion;
		}
		if($chk_candidate_gender=="1" && $candidate_gender<>"") {
			$link .="&candidate_gender=".$candidate_gender;
		}
		
		$link .="&status_id=active";
		
		//echo $link; exit;
		
		header("location: "._PATHURL."/".$link);
		return true;
		exit;			
	}	
		
		
	function adm_getSearchResult($start,$limit) {
		global $activate_connection;
		//echo "ini start=".$start." dan limit=".$limit."<br><br>";
		
		// mysqli_query($activate_connection, "DROP TABLE edu_tmp");
		// mysql_query("DROP TABLE edu_tmp");
		// print_r($_GET); exit;
		// $maketemp ="CREATE TEMPORARY TABLE edu_tmp(
		// 			candidate_edu_id int PRIMARY KEY, 
		// 			candidate_id int,
		// 			degree_id int,
		// 			degree_name varchar(25),
		// 			edu_major varchar(80), 
		// 			candidate_edu_institution varchar(100), 
		// 			candidate_edu_gpa varchar(4),
		// 			candidate_edu_end int
		// 			)";
					
		// //echo $maketemp;
		// //exit;
		
		
		// if(mysqli_query($activate_connection, $maketemp)) {
		// //if(mysql_query($maketemp)) {	
		// 	$query_candidate_edu_id=querying("SELECT candidate_edu_id FROM m_candidate_edu ORDER BY candidate_id, field( candidate_edu_degree, 'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD' )");
		// 	$candidate_edu_id = sqlGetData($query_candidate_edu_id);
			
		// 	for($iedu=0;$iedu<count($candidate_edu_id);$iedu++)
		// 	{
		// 		querying("INSERT INTO edu_tmp(candidate_edu_id, candidate_id, degree_name, edu_major, candidate_edu_institution, candidate_edu_gpa, candidate_edu_end) 
		// 			SELECT a.candidate_edu_id, a.candidate_id, a.candidate_edu_degree, a.candidate_edu_major, a.candidate_edu_institution, a.candidate_edu_gpa, a.candidate_edu_end
		// 			FROM m_candidate_edu a
		// 			WHERE candidate_edu_id = '".$candidate_edu_id[$iedu]["candidate_edu_id"]."'
		// 			LIMIT 1"); 
		// 	}
			
			
			
		// 	mysqli_query($activate_connection, "UPDATE edu_tmp x, m_degree y SET x.degree_id=y.degree_id WHERE x.degree_name=y.degree_name");
		// 	//mysql_query("UPDATE edu_tmp x, m_degree y SET x.degree_id=y.degree_id WHERE x.degree_name=y.degree_name");
		// }
		// else{
		// 	echo "failed create temp table edu_tmp";
		// }
			
			mysqli_query($activate_connection, "DROP TABLE IF EXISTS edu_tmp");
			
			$maketemp = "CREATE TEMPORARY TABLE edu_tmp (
				candidate_edu_id int PRIMARY KEY, 
				candidate_id int,
				degree_id int,
				degree_name varchar(25),
				edu_major varchar(80), 
				candidate_edu_institution varchar(100), 
				candidate_edu_gpa varchar(4),
				candidate_edu_end int
			)";
			
			if (mysqli_query($activate_connection, $maketemp)) {
				$query_candidate_edu_id = querying("SELECT candidate_edu_id FROM m_candidate_edu ORDER BY candidate_id, field(candidate_edu_degree, 'Doctoral - S3', 'Master - S2', 'Bachelor - S1', 'Diploma', 'Highschool - SMA', 'Junior Highschool - SMP', 'Elementary - SD')");
				$candidate_edu_id = sqlGetData($query_candidate_edu_id);
				
				for ($iedu = 0; $iedu < count($candidate_edu_id); $iedu++) {
					querying("INSERT INTO edu_tmp(candidate_edu_id, candidate_id, degree_name, edu_major, candidate_edu_institution, candidate_edu_gpa, candidate_edu_end) 
						SELECT a.candidate_edu_id, a.candidate_id, a.candidate_edu_degree, a.candidate_edu_major, a.candidate_edu_institution, a.candidate_edu_gpa, a.candidate_edu_end
						FROM m_candidate_edu a
						WHERE candidate_edu_id = '".$candidate_edu_id[$iedu]["candidate_edu_id"]."'
						LIMIT 1");
				}
				
				mysqli_query($activate_connection, "UPDATE edu_tmp x, m_degree y SET x.degree_id = y.degree_id WHERE x.degree_name = y.degree_name");
			} else {
				echo "Failed to create temp table edu_tmp";
			}
		
		
		//exit;
		//$query=querying("SELECT * FROM edu_tmp", array());
		//$data=sqlGetData($query);
		//echo "data=";
		//print_r($data);exit;
		
		$candidate_name=(isset($_GET["candidate_name"]) && $_GET["candidate_name"]<>"")?$_GET["candidate_name"]:"";
		$candidate_email=(isset($_GET["candidate_email"]) && $_GET["candidate_email"]<>"")?$_GET["candidate_email"]:"";
		$candidate_edu_degree=(isset($_GET["candidate_edu_degree"]) && $_GET["candidate_edu_degree"]<>"")?$_GET["candidate_edu_degree"]:"";
		$candidate_edu_major=(isset($_GET["candidate_edu_major"]) && $_GET["candidate_edu_major"]<>"")?$_GET["candidate_edu_major"]:"";
		$candidate_jobexp_lob=(isset($_GET["candidate_jobexp_lob"]) && $_GET["candidate_jobexp_lob"]<>"")?$_GET["candidate_jobexp_lob"]:"";
		$candidate_jobexp_position=(isset($_GET["candidate_jobexp_position"]) && $_GET["candidate_jobexp_position"]<>"")?$_GET["candidate_jobexp_position"]:"";
		$candidate_c_city=(isset($_GET["candidate_c_city"]) && $_GET["candidate_c_city"]<>"")?$_GET["candidate_c_city"]:"";
		$candidate_religion=(isset($_GET["candidate_religion"]) && $_GET["candidate_religion"]<>"")?$_GET["candidate_religion"]:"";
		$candidate_gender=(isset($_GET["candidate_gender"]) && $_GET["candidate_gender"]<>"")?$_GET["candidate_gender"]:"";
		$candidate_edu_end1=(isset($_GET["candidate_edu_end1"]) && $_GET["candidate_edu_end1"]<>"")?$_GET["candidate_edu_end1"]:"";
		$candidate_edu_end2=(isset($_GET["candidate_edu_end2"]) && $_GET["candidate_edu_end2"]<>"")?$_GET["candidate_edu_end2"]:"";


		
		$query="SELECT a.candidate_id, a.log_auth_id, a.candidate_name, a.candidate_email, a.candidate_gender, a.candidate_religion, a.candidate_birthdate, 
						a.candidate_c_address, a.candidate_c_city, a.candidate_c_postcode, a.candidate_hp1, a.candidate_expected_salary";
						
		if($candidate_edu_degree<>"" || $candidate_edu_major<>"" || ($candidate_edu_end1<>"" && $candidate_edu_end2<>"") ) {
			$query .= ", d.candidate_edu_id, d.candidate_edu_institution, d.candidate_edu_gpa, d.degree_id, d.degree_name, d.edu_major, d.candidate_edu_end ";
		}
				
		

		if( ($candidate_jobexp_lob<>"") || ($candidate_jobexp_position<>"") ) {		
			$query .= ", c.candidate_jobexp_id, c.candidate_jobexp_lob, c.candidate_jobexp_position";				
		}
		
		$query .= " FROM m_candidate a";

		if($candidate_edu_degree<>"" || $candidate_edu_major<>"" || ($candidate_edu_end1<>"" && $candidate_edu_end2<>"") ) {
			$query .=" LEFT JOIN edu_tmp d ON a.candidate_id=d.candidate_id";
		}
				
				
		if( ($candidate_jobexp_lob<>"") || ($candidate_jobexp_position<>"") ) {	
			$query .=" LEFT JOIN m_candidate_jobexp c ON a.candidate_id=c.candidate_id";
		}

		$query .= " WHERE a.status_id='active'";

		if($candidate_name<>"") {
			$query .=" AND a.candidate_name LIKE '".base64_decode($candidate_name)."'";
		}
		if($candidate_email<>"") {
			$query .=" AND a.candidate_email LIKE '".base64_decode($candidate_email)."'";
		}
		
		if($candidate_edu_degree<>"") {
			$query .=" AND d.degree_name = '".$candidate_edu_degree."'";
			$query .=" AND d.candidate_id = a.candidate_id";
		}
		
		if($candidate_edu_major<>"") {
			$query .=" AND d.edu_major LIKE '".base64_decode($candidate_edu_major)."'";
		}

		if ($candidate_edu_end1<>"" && $candidate_edu_end2<>"") {
			$query .=" AND (d.candidate_edu_end BETWEEN '".$candidate_edu_end1."' AND '".$candidate_edu_end2."') ";
		}
		
		if($candidate_jobexp_lob<>"") {
			$query .=" AND c.candidate_jobexp_lob LIKE '".base64_decode($candidate_jobexp_lob)."'";
		}
		if($candidate_jobexp_position<>"") {
			$query .=" AND c.candidate_jobexp_position LIKE '".base64_decode($candidate_jobexp_position)."'";
		}
		if($candidate_c_city<>"") {
			$query .=" AND a.candidate_c_city LIKE '".base64_decode($candidate_c_city)."'";
		}
		if($candidate_religion<>"") {
			$query .=" AND a.candidate_religion = '".$candidate_religion."'";
		}
		if($candidate_gender<>"") {
			$query .=" AND a.candidate_gender = '".$candidate_gender."'";
		}
		
		$query .=" GROUP BY a.candidate_id ";
		$query .=" ORDER BY a.candidate_name ASC";
		
		//echo "start_from=".$start." dan limitnya = ".$limit."<br><br>";
		
		if($start >= 0 && $limit > 0) {
			$query .=" LIMIT ".$start.", ".$limit;
		}
		
		 //echo $query;
		 //exit;
		
		$sql=querying($query,array());
		
		if($sql) {
			$data=sqlGetData($sql);
		}
		else {
			$data=array();
		}
		
		return $data;
		
	}
	
	
	
		
} // end of authorized area.
?>