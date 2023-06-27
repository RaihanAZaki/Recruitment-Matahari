/* Bagian Update Resume */
function update_candidateResume() {
	
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
		header("location: "._PATHURL."/index.php?mod=resume&gal=".coded("1")."&missteps=".coded($notice));
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