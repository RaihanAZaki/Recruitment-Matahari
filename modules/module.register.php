<?php
function register_checkEmail() {
	$query=querying("SELECT register_id FROM m_register WHERE candidate_email=? ORDER BY register_id ASC LIMIT 1",array($_POST["email1"]));
	$data1 = sqlGetData($query);
	
	$query=querying("SELECT log_auth_id FROM log_auth WHERE log_auth_name=? ORDER BY log_auth_id ASC LIMIT 1",array($_POST["email1"]));
	$data2 = sqlGetData($query);
	
	if(count($data1)==0 && count($data2)==0) return false;	else return true;
}

function register_checkMobile() {
	$query=querying("SELECT register_id FROM m_register WHERE candidate_hp1=? or candidate_hp2=? ORDER BY register_id ASC LIMIT 1",array($_POST["cellphone1"],$_POST["cellphone1"]));
	$data1 = sqlGetData($query);
	
	$query=querying("SELECT a.register_id FROM log_auth a LEFT JOIN m_candidate b ON a.log_auth_id=b.log_auth_id WHERE b.candidate_hp1=? or b.candidate_hp2=? ORDER BY a.register_id ASC LIMIT 1",array($_POST["cellphone1"],$_POST["cellphone1"]));
	$data2 = sqlGetData($query);
			
	if( count($data1)==0 && count($data2)==0 ) return false;	else return true;
}

// function register_checkIDCard() {
// 	$query = querying("SELECT register_id FROM m_register WHERE candidate_idcard = ? ORDER BY register_id ASC LIMIT 1",array($_POST["nomor_ktp"]));
// 	$d_id_reg = sqlGetData($query);

// 	$query=querying("SELECT candidate_id FROM m_candidate WHERE candidate_idcard = ? ORDER BY candidate_id ASC LIMIT 1",array($_POST["nomor_ktp"]));
// 	$d_id_candidate = sqlGetData($query);
// 	if(count($d_id_reg)==0 && count($d_id_candidate)==0) return false; else return true;
// }
function register_checkIDCard() {
    if (isset($_POST["nomor_ktp"])) {
        $query = querying("SELECT register_id FROM m_register WHERE candidate_idcard = ? ORDER BY register_id ASC LIMIT 1", array($_POST["nomor_ktp"]));
        if ($query) {
            $d_id_reg = sqlGetData($query);
            if (count($d_id_reg) == 0) {
                $query = querying("SELECT candidate_id FROM m_candidate WHERE candidate_idcard = ? ORDER BY candidate_id ASC LIMIT 1", array($_POST["nomor_ktp"]));
                if ($query) {
                    $d_id_candidate = sqlGetData($query);
                    if (count($d_id_candidate) == 0) {
                        return false;
                    }
                } else {
                    // Penanganan error jika query kedua gagal
                    write_errorlogs(mysqli_error($activate_connection), 2);
                }
            }
        } else {
            // Penanganan error jika query pertama gagal
            write_errorlogs(mysqli_error($activate_connection), 2);
        }
    }

    return true;
}
	
/*tambahan check tgl Lahir di IDCard 23 Sept 2019 */	
function register_checkBirthDateID($postedbirthdate,$jeniskelamin,$postedidcard) {
	//echo "posted birthdate=".$postedbirthdate."<br>";
	$explodetgl=explode("-",$postedbirthdate);
	
	//echo "jenis kelamin=".$jeniskelamin."<br>";
	
	if($jeniskelamin=="male") $ddfix=$explodetgl[0];
	if($jeniskelamin=="female") $ddfix=$explodetgl[0]+40;
	
	$tgllahirid=substr($postedidcard,6,6);
	$tgllahirexplode=$ddfix.$explodetgl[1].substr($explodetgl[2],2,2);
	//echo "ddfix based on sex=".$ddfix."<br>";
	//echo "tgl lahir di ktp=".$tgllahirid."<br>";
	//echo "tgl lahir konversi posted=".$tgllahirexplode."<br>";
	
	if($tgllahirid==$tgllahirexplode) return false; else return true;
	//exit();
}
	
function register_samePerson($candidate_name,$candidate_birthdate) {
	$query = querying("SELECT candidate_id, candidate_email, candidate_name, candidate_birthdate, log_auth_id FROM m_candidate WHERE candidate_name=? AND candidate_birthdate=? ORDER BY candidate_id ASC LIMIT 1",array($candidate_name,$candidate_birthdate));
	$data = sqlGetData($query);
	if(count($data) > 0) 
	{
		$same_id=$data[0]["log_auth_id"];
		return $same_id;	
	}
	else return false;
}
	

function register_signUp() {

	if(isset($_POST["place_of_birth"]) && is_array($_POST["place_of_birth"])){
			$_POST["place_of_birth"]=$_POST["place_of_birth"][0];
	}
	
	$server = $_SERVER['SERVER_NAME'];
	
	if(_WITHCAPTCHA=="y") {
		include_once(_PATHDIRECTORY."/includes/recaptcha/recaptchalib.php");
		$privatekey = "6Lcrf8YSAAAAAH-uRUwTCScklNp_0ppd6dWD3WlN";
		$response = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if(isset($response->is_valid) && $response->is_valid != true) {			
			system_log_badattempt();
			header("location: "._PATHURL."/index.php?mod=register&gal=".coded("1")."&mess=".coded("Security Code (captcha) is incorrect <br><i>Kode pengaman (captcha) salah</i>"));
			return false;
			exit;	
		}
	}

		if (isset($_POST["full_name"])) $_POST["full_name"] = sanitize_post($_POST["full_name"]);
		if (isset($_POST["email1"])) $_POST["email1"] = sanitize_post($_POST["email1"]);
		// if (isset($_POST["sex"])) $_POST["sex"] = sanitize_post($_POST["sex"]);
		// if (isset($_POST["place_of_birth"])) $_POST["place_of_birth"] = sanitize_post($_POST["place_of_birth"]);
		// if (isset($_POST["birthdate"])) $_POST["birthdate"] = sanitize_post($_POST["birthdate"]);
		// if (isset($_POST["nationality"])) $_POST["nationality"] = sanitize_post($_POST["nationality"]);
		// if (isset($_POST["country"])) $_POST["country"] = sanitize_post($_POST["country"]);
		// if (isset($_POST["nomor_passport"])) $_POST["nomor_passport"] = sanitize_post($_POST["nomor_passport"]);
		// if (isset($_POST["nomor_ktp"])) $_POST["nomor_ktp"] = sanitize_post($_POST["nomor_ktp"]);
		if (isset($_POST["email2"])) $_POST["email2"] = sanitize_post($_POST["email2"]);
		if (isset($_POST["pwd1"])) $_POST["pwd1"] = sanitize_post($_POST["pwd1"]);
		if (isset($_POST["pwd2"])) $_POST["pwd2"] = sanitize_post($_POST["pwd2"]);
		if (isset($_POST["cellphone1"])) $_POST["cellphone1"] = sanitize_post($_POST["cellphone1"]);
		// if (isset($_POST["cellphone2"])) $_POST["cellphone2"] = sanitize_post($_POST["cellphone2"]);
		if (isset($_POST["curriculum"])) $_POST["curriculum"] = sanitize_post($_POST["curriculum"]);
		

		if (isset($_GET)) $_GET = sanitize_post($_GET);		
		

		// $pob="";
		// if(isset($_POST["place_of_birth"]) ) {
		// 	if(is_array($_POST["place_of_birth"])){
		// 		$pob=$_POST["place_of_birth"][0];
		// 	}
		// 	else {
		// 		$pob=$_POST["place_of_birth"];
		// 	}
		// }
	
		
	$missteps = array();
	if (!isset($_POST["full_name"]) || $_POST["full_name"] == "") {
		$missteps[] = '0';
	}
	
	if (!isset($_POST["email1"]) or $_POST["email1"] == "") 		$missteps[] = 1;
	// if (!isset($_POST["sex"]) or $_POST["sex"] == "") 		$missteps[] = 2;
	// if (!isset($pob) or $pob == "") 		$missteps[] = 4;
	// if (!isset($_POST["birthdate"]) or $_POST["birthdate"] == "") 		$missteps[] = 5;
	// if (!isset($_POST["nationality"]) or $_POST["nationality"] == "") 		$missteps[] = 7;
	// if (isset($_POST["nationality"]) && $_POST["nationality"]=="wna" && $_POST["country"] == "") 		$missteps[] = 8;
	// if (isset($_POST["nationality"]) && $_POST["nationality"]=="wna" && (!isset($_POST["nomor_passport"]) || $_POST["nomor_passport"] == "") ) 		$missteps[] = 10;
	// if (isset($_POST["nationality"]) && $_POST["nationality"]=="wni" && (!isset($_POST["nomor_ktp"]) || $_POST["nomor_ktp"] == ""  || (strlen($_POST["nomor_ktp"]) < 15) || (strlen($_POST["nomor_ktp"]) > 16) )) 		$missteps[] = 37;
	
	/* tambahan untuk cek KTP 23 Sept 2019 */
	// if (isset($_POST["nationality"]) && $_POST["nationality"]=="wni" && isset($_POST["nomor_ktp"]) && $_POST["nomor_ktp"]<>"" && isset($_POST["birthdate"]) && $_POST["birthdate"]<>"" && (register_checkBirthDateID($_POST["birthdate"],$_POST["sex"],$_POST["nomor_ktp"]) )) 		$missteps[] = 37;
	// if (isset($_POST["nomor_ktp"]) && register_checkIDCard($_POST["nomor_ktp"])) {
	// 	if (!in_array(37, $missteps)) {
	// 		$missteps[] = 38;
	// 	}
	// }
	
	
	if (isset($_POST["email1"]) && !filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL))	$missteps[] = 34;
	if (!isset($_POST["email2"]) or $_POST["email2"] == "") $missteps[] = 35;
	if (isset($_POST["email2"]) && $_POST["email2"] <> $_POST["email1"]) $missteps[] = 36;
			
	if (!isset($_POST["pwd1"]) or strlen($_POST["pwd1"]) < 6) $missteps[] = 39;
	
	if (isset($_POST["email1"]) && isset($_POST["email1"]) && register_checkEmail())  $missteps[] = 42;
	
	if (!isset($_POST["cellphone1"]) or $_POST["cellphone1"] == "") $missteps[] = 43;
		
	if (isset($_POST["cellphone1"]) && register_checkMobile())  $missteps[] = 44;
	if (_WITHCAPTCHA=="y" && isset($response->is_valid) && $response->is_valid != true) $missteps[] = 45;

	
	// print_r($missteps);
	// echo "<br>".count($missteps);
	// exit;
	

	if (count($missteps)>0)
	{
		for ($i=0;$i<count($missteps);$i++) {
			$notice[] = error_notice($missteps[$i]);
		}
		//print_r($notice);exit;
		$notice = json_encode($notice);
		
		$_SESSION["session"] = $_POST;
		
		
		
		if(isset($pob) && $pob<>"") {
				$_SESSION["session"]["place_of_birth"]=$pob;
		}
		
		//print_r ($_SESSION["session"]);exit;
		
		header("location: "._PATHURL."/index.php?mod=register&gal=".coded("1")."&missteps=".coded($notice));
		exit;
	}
	else
	{
		//echo "ga ada error"; exit;
		//echo $_POST["birthdate"];
		//exit;
		// $birthdate=explode("-",$_POST["birthdate"]);
					
		$expiry_date=date('Y-m-d', strtotime("+2 week"));

		$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
		
		// $candidate_birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
		
		$register_activation_code = letshashit($_POST["email1"],"activatereg");

		// print_r($_POST);
		
// 		echo $_POST["full_name"]."<br>". $_POST["email1"]."<br>". $_POST["pwd1"]."<br>". $_POST["place_of_birth"][0]."<br>".$candidate_birthdate."<br>". 
// 		$_POST["sex"]."<br>".$_POST["nationality"]."<br>".((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?"Indonesia":$_POST["country"])."<br>". 
// ((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?"KTP":"Passport")."<br>".((isset($_POST["nationality"]) && $_POST["nationality"]=="wni")?$_POST["nomor_ktp"]:$_POST["nomor_passport"])."<br>". 
// $_POST["cellphone1"]."<br>". $_POST["cellphone2"]."<br>".$_POST["homephone"]."<br>".$register_activation_code;
// 		exit;
		
		
		$query = querying("INSERT INTO m_register
(candidate_name, candidate_email, candidate_passwd,candidate_hp1, curriculum, register_date, register_expiry_date, register_activation_code)
VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)", array($_POST["full_name"], $_POST["email1"], $_POST["pwd1"],
$_POST["cellphone1"], $_POST["curriculum"], $expiry_date, $register_activation_code ) );
		

		if ($query)
		{
			// echo "masuk sini";exit;
			
			$variablemail = array();
			$variablemail["sender"] 		= 'recruitment@hypermart.co.id';
			$variablemail["from"] 		= "recruitment@hypermart.co.id";
			$variablemail["fromname"] 	= "Registration PT. Matahari Putra Prima";
			$variablemail["to"] 			= $_POST["email1"];
			$variablemail["toName"]		= $POST["full_name"];
			$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
			$variablemail["bcc"] 		= "recruitment@hypermart.co.id";
			
			$variablemail["subject"] 	= "[PT. Matahari Putra Prima] Email Activation";
			$variablemail["content"] 	= "
			<p>Dear ".$_POST["full_name"].", <br>Thank you for registering via our on-line recruitment website.<br>In order to activate your account, kindly click the link below, not later than <b>".date("d M y",strtotime($expiry_date))."</b>.<br><br>
			<a href="._PATHURL."/useractivation.php?usr=".coded($_POST["email1"]."|".$expiry_date)."&a=".$register_activation_code.">
			Activate my account</a><br><br>
			or simply copy and then paste the link below to your web browser,<br><br>
			 "._PATHURL."/useractivation.php?usr=".coded($_POST["email1"]."|".$expiry_date)."&a=".$register_activation_code."
			<br><br>In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
			<b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></p><hr>
			<p>Yang terhormat ".$_POST["full_name"].", <br>Terimakasih telah melakukan pendaftaran melalui situs pendaftaran online kami.<br>Untuk mengaktifkan akun Anda, silahkan klik link di bawah ini selambatnya pada tanggal <b>".date("d M y",strtotime($expiry_date))."</b>.<br><br>
			<a href="._PATHURL."/useractivation.php?usr=".coded($_POST["email1"]."|".$expiry_date)."&a=".$register_activation_code.">
			Aktifkan akun saya</a><br><br>
			atau buka link berikut ini di perambah situs Anda,<br><br>
			 "._PATHURL."/useractivation.php?usr=".coded($_POST["email1"]."|".$expiry_date)."&a=".$register_activation_code."
			<br><br>Jika email kami masuk ke folder SPAM/ Bulk/ Trash, mohon klik tombol \"Not Spam\" agar selanjutnya email kami dapat terkirim langsung ke inbox Anda.<br><br><br><br>
			<b>Hormat kami,<br><br/>Tim Rekrutmen Matahari Putra Prima</b></p>
			";
			
			//echo $variablemail["content"];exit;
			
			if (function_sending_email($variablemail))
			{
				unset($_SESSION["session"]);
				unset($variablemail);
				header("location: "._PATHURL."/index.php?mod=register&mess=".coded("Please login to your registered email. We have sent an activation link to your registered email. Thank You.<br><i>Silahkan login ke email yang Anda daftarkan. Kami telah mengirimkan email aktivasi ke email Anda. Terimakasih.</i>"));
				exit;	
			}
			else
			{
				header("location: "._PATHURL."/index.php?mod=register&gal=".coded("1")."&mess=".coded("Sending activation email failed. Please try again later.<br><i>Proses pengiriman email aktifasi tidak berhasil dilakukan. Silahkan ulangi beberapa saat lagi.</i>"));
				exit;	
			}	
		}
		else {
				header("location: "._PATHURL."/index.php?mod=register&gal=".coded("1")."&mess=".coded("Error happen. We found difficulties in registering your account. Please try again later.<br><i>Terjadi kesalahan dalam proses pendaftaran akun Anda. Silahkan ulangi bebearpa saat lagi.</i>"));
				exit;	
		}
	}
}
	
	
function register_executeActivation() {
	// echo("tes");exit;
	$usrfull = (isset($_GET["usr"]))?explode("|",decoded($_GET["usr"])):"";
	$usr=$usrfull[0];
	$expiry_date=$usrfull[1];
	$a = (isset($_GET["a"]))?$_GET["a"]:"";
	
	/*echo $a."<br>".$usr."<br>".$expiry_date;
	exit;
	*/
	//check apakah masih valid kode aktifasi-nya
	
	if($expiry_date<date("Y-m-d")) {
		header("location: "._PATHURL."/index.php?mod=resendactivation&gal=".coded("1")."&mess=".coded("Expired activation code, please use our Resend Activation Feature to retrieve new activation code.<br><i>Kode aktifasi telah kadaluarsa, silahkan gunakan fasilitas Kirim Ulang Aktifasi untuk mendapatkan kode aktifasi yang baru.</i>"));
		exit;		
	}
	
	//check apakah dia sudah ada di tabel log_auth(udah teraktivasi)
	$query = querying("SELECT log_auth_id, employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code
	FROM log_auth WHERE log_auth_name= ? ORDER BY log_auth_id DESC LIMIT 1",array($usr));
	$data = sqlGetData($query);
	if(count($data)>0) {
		//echo "udah pernah aktivasi dan sudah dapat user pass"; //exit;
		header("location: "._PATHURL."/index.php?gal=".coded("1")."&mess=".coded("You are trying to activate an active account. Kindly use your login account to access  your member area.<br><i>Anda mencoba mengaktifkan akun yang sudah aktif. Silahkan login menggunakan akun Anda.</i>"));
		exit;
	}
	
	$query = querying("SELECT register_id, candidate_name, candidate_email, candidate_passwd, candidate_hp1, register_date, register_activation_code
	FROM m_register WHERE candidate_email= ? ORDER BY register_id ASC LIMIT 1",array($usr));
	$data = sqlGetData($query);
	$galat = 1;
	//echo "usr= ".$usr."<br>";
	//print_r($data);exit;
	
	if (count($data) > 0)
	{
		
		if($usr == $data[0]["candidate_email"] and $a == letshashit($data[0]["candidate_email"],"activatereg") ) 
		{
			$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
			
			// echo "data usernm: ".$data[0]["candidate_email"]."<br>";
			// echo "data password: ".$data[0]["candidate_passwd"]."<br>";
			// echo "coded: ". sha256mod($data[0]["register_id"].$data[0]["candidate_email"].$data[0]["candidate_passwd"]);
			// echo "full_name: ".$data[0]["candidate_name"]."<br>";
			// // echo "birth_date: ".$data[0]["candidate_birthdate"]."<br>";
			// echo "a: ".$a."<br>";
			// echo "usernm: ".$usr."<br>";
			// echo "passwd: ".letshashit($data[0]["register_id"].$data[0]["candidate_passwd"])."<br>";
			// echo "reg_date: ".$data[0]["register_date"]."<br>";
			// echo "curr_ip: ".$ipaddress."<br>";
			// echo "activation_date: <br>";
			// echo "date_update: <br>";
			// echo "register_id: ".$data[0]["register_id"];
			// exit;
			

				$query2 = querying("INSERT INTO log_auth
	(employee_id, log_auth_name, log_auth_passwd, log_auth_role, log_auth_lastlogin, log_auth_lastip, register_id, register_date, register_activation_code, 
	register_activation_date, status_id, user_insert, date_insert, user_update, date_update)
	VALUES (0, ?, ?, ?, NOW(), ?, ?, ?, ?, NOW(), ?, ?, NOW(), ?, NOW())",
	array($data[0]["candidate_email"], sha256mod($data[0]["register_id"].$data[0]["candidate_email"].$data[0]["candidate_passwd"]), "candid", $ipaddress, 
	$data[0]["register_id"], $data[0]["register_date"], $a, "active", "0", "0"));

			if($query2) {
				$query = querying("SELECT log_auth_id FROM log_auth WHERE log_auth_name=? ORDER BY log_auth_id DESC LIMIT 1", array($usr));
				$logauth = sqlGetData($query);
				if (count($logauth) > 0) {
					$log_auth_id = $logauth[0]["log_auth_id"];
					$datalog = $data[0];
					$datalog["log_auth_id"] = $log_auth_id;
					if(register_insertToMCandidate($datalog))	{
						querying("DELETE FROM m_register WHERE register_id = ?",array($data[0]["register_id"]));
						$galat = 0;
					}
				}
			}
		}
	}
	
	if ($galat == 0) {
		unset($_SESSION["session"]);
		header("location: "._PATHURL."/index.php?mess=".coded("Activation succeed. Please log in using your account.<br><i>Aktifasi berhasil. Silakan login menggunakan akun Anda</i>"));
	}
	else
		header("location: "._PATHURL."/index.php?mod=resendactivation&gal=".coded("1")."&mess=".coded("Activation failed, please try again later.<br><i>Aktifasi gagal, silahkan ulangi beberapa saat lagi.</i>"));
	exit;
}
	

function register_resendAct() {
	$server = $_SERVER['SERVER_NAME'];
	$_POST = sanitize_post($_POST);
	
	if(_WITHCAPTCHA=="y") {
		include_once(_PATHDIRECTORY."/includes/recaptcha/recaptchalib.php");
		$privatekey = "6Lcrf8YSAAAAAH-uRUwTCScklNp_0ppd6dWD3WlN";
		$response = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if(isset($response->is_valid) && $response->is_valid != true) {			
			system_log_badattempt();
			header("location: "._PATHURL."/index.php?mod=resendactivation&gal=".coded("1")."&mess=".coded("Security Code (captcha) is incorrect<br><i>Kode pengaman (captcha) salah.</i>"));
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
		
		header("location: "._PATHURL."/index.php?mod=resendactivation&gal=".coded("1")."&missteps=".coded($notice));
		exit;
	}
	else {
			//check apakah sudah ada di log_auth
			$query = querying("SELECT log_auth_id FROM log_auth WHERE log_auth_name= ? ORDER BY log_auth_id DESC LIMIT 1", array($_POST["email"]));
			$data = sqlGetData($query);
			if(count($data)>0) {
				header("location: "._PATHURL."/index.php?mess=".coded("Your account has already been activated, please login using your account.<br><i>Akun Anda telah diaktifasi, silahkan login menggunakan akun Anda.</i>"));
				exit;
			}
		
			//check apakah ada di tabel m_register
			$query = querying("SELECT * FROM m_register WHERE candidate_email= ? ORDER BY register_id ASC LIMIT 1",array($_POST["email"]));
			$data = sqlGetData($query);
			
			if (count($data) > 0)
			{

				$expiry_date=date('Y-m-d', strtotime("+2 week"));

				$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
				
				$candidate_birthdate = $data[0]["candidate_birthdate"];
				
				$register_activation_code = letshashit($_POST["email"].$candidate_birthdate,"activatereg");
				
				
				$variablemail = array();
				$variablemail["sender"] 	= 'recruitment@hypermart.co.id';
				$variablemail["from"] 		= "recruitment@hypermart.co.id";
				$variablemail["fromname"] 	= "Registration PT. Matahari Putra Prima";
				$variablemail["to"] 		= $_POST["email"];
				$variablemail["toName"]		= $data[0]["candidate_name"];
				$variablemail["bcc"][0] 	= "shakti.santoso@hypermart.co.id";
				$variablemail["bcc"][1]		= "recruitment@hypermart.co.id";
				$variablemail["subject"] 	= "[PT. Matahari Putra Prima] Email Activation";
				$variablemail["content"] 	= "
				<p>Dear ".$data[0]["candidate_name"].",<br>In order to activate your account, kindly click the link below, not later than <b>".date("d M y",strtotime($expiry_date))."</b>.<br><br>
				<a href="._PATHURL."/useractivation.php?usr=".coded($_POST["email"]."|".$expiry_date)."&a=".$register_activation_code.">
				Activate my account</a><br><br>
				or simply copy and then paste the link below to your web browser,<br><br>
				 "._PATHURL."/useractivation.php?usr=".coded($_POST["email"]."|".$expiry_date)."&a=".$register_activation_code."
				<br><br>In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
				<b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></p><hr>
				<p>Yth. ".$data[0]["candidate_name"].",<br>Untuk mengaktifkan akun Anda, silahkan klik tautan berikut ini sebelum tanggal <b>".date("d M y",strtotime($expiry_date))."</b>.<br><br>
				<a href="._PATHURL."/useractivation.php?usr=".coded($_POST["email"]."|".$expiry_date)."&a=".$register_activation_code.">
				Aktifasi akun saya.</a><br><br>
				atau buka tautan di bawah ini melalui browser Anda,<br><br>
				 "._PATHURL."/useractivation.php?usr=".coded($_POST["email"]."|".$expiry_date)."&a=".$register_activation_code."
				<br><br>Jika email kami masuk ke folder SPAM/ Bulk/ Trash, mohon klik tombol \"Not Spam\" agar selanjutnya email kami dapat terkirim langsung ke inbox Anda.<br><br><br><br>
			<b>Hormat kami,<br><br/>Tim Rekrutmen Matahari Putra Prima</b></p>";
				
				//echo $variablemail["content"];exit;
				
				if (function_sending_email($variablemail))
				{
					unset($_SESSION["session"]);
					unset($variablemail);
					header("location: "._PATHURL."/index.php?mod=resendactivation&mess=".coded("Please kindly check your email and find the activation link we had sent.<br><i>Silahkan periksa email Anda. Kami telah mengirimkan link aktifasi ke email Anda. Klik link yang diberikan untuk melengkapi data diri Anda.</i>"));
					exit;	
				}
				else
				{
					header("location: "._PATHURL."/index.php?mod=resendactivation&gal=".coded("1")."&mess=".coded("We find difficulties in sending your activation link. Please try again later.<br><i>System tidak berhasil mengirim email aktifasi ke email Anda, silahkan ulangi beberapa saat lagi.</i>"));
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
	
	
	
function register_insertToMCandidate($data) {
	
		if (querying("INSERT INTO m_candidate
	(log_auth_id, candidate_name, candidate_email, candidate_birthplace, candidate_birthdate, candidate_gender, candidate_nationality, candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, status_id, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, NOW())",
		array($data["log_auth_id"], $data["candidate_name"], $data["candidate_email"], $data["candidate_birthplace"], $data["candidate_birthdate"], $data["candidate_gender"], $data["candidate_nationality"], $data["candidate_country"], $data["candidate_idtype"], $data["candidate_idcard"], $data["candidate_hp1"], $data["candidate_hp2"], $data["candidate_phone"], "active", $data["log_auth_id"], $data["log_auth_id"]) )) return true;
		else return false;	
}
	
?>