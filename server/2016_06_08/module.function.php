<?php
//module.function.php
function url_slug($v)
{
	$slug = preg_replace('/[^A-Za-z0-9-]+/','-',$v);
	return strtolower($slug);	
}

function sha256mod($keyword,$salt="shaktirec") {
	$hashed = crypt($keyword,'$5$rounds=5000$'.$salt.'$');
	//echo $hashed."<br><br>";
	$hashed = str_replace('$5$rounds=5000$'.$salt.'$',"",$hashed);
	//echo $hashed;
	return $hashed;	
}

function coded($keyword, $pwd="shaktimpp")	{
	$codedkey = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($pwd), $keyword, MCRYPT_MODE_CBC, md5(md5($pwd))));
	$codedkey = base64_encode($codedkey);
	return $codedkey;
}

function decoded($keyword,$pwd="shaktimpp")	{
	$keyword = base64_decode(strval($keyword));
	$decodedkey = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($pwd), base64_decode($keyword), MCRYPT_MODE_CBC, md5(md5($pwd))), "\0");
	return $decodedkey;
}


function letshashit($keyword,$pwd="shaktihashed")	{
	return crypt($keyword,'$5$rounds=5000$'.md5($pwd).'$');
}


function clean_post($input) {

	$search = array(
	'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
	'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
	'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
	'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	);

	$output = preg_replace($search, '', $input);
	return $output;
}

function sanitize_post($input) {
	$output="";
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize_post($val);
		}
	}
	else {
		$input  = clean_post($input);
		$output = mysql_real_escape_string($input);
	}
	return $output;
}

function clean_view($output) {
	if (is_array($output)) {
		foreach($output as $var=>$val) {
			$view[$var] = clean_view($val);
		}
	}
	else {
		$view=str_replace('\r',"\r",str_replace('\n',"\n",$output));
	}
	return $view;
	
}

function clean_show($output) {
	if (is_array($output)) {
		foreach($output as $var=>$val) {
			$view[$var] = clean_show($val);
		}
	}
	else {
		$view=str_replace('\r\n',"<br>",$output);
	}
	return $view;
	
}

function getCity() {
	$query=querying("SELECT city_id, city_province, city_name FROM m_city ORDER BY city_name ASC");
	$data=sqlGetData($query);
	return $data;
}

function resizeImage($gambar,$tinggi,$lebar){

$image_stats = getimagesize($gambar); 
$imagewidth = $image_stats[0]; 
$imageheight = $image_stats[1]; 
$img_type = $image_stats[2]; 
$new_w = $lebar; 
$new_h = $tinggi;
		
if ($img_type=="2") {	
	$src_img = imagecreatefromjpeg($gambar); 
	$dst_img = imagecreatetruecolor($new_w,$new_h); 
	imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
	imagejpeg($dst_img, $gambar, 100); 
	
} elseif  ($img_type=="3") {

	$dst_img=imagecreatetruecolor($new_w,$new_h); 
	$src_img=imagecreatefrompng($gambar); 						
	imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
	imagepng($dst_img, $gambar, 100); 

	} elseif  ($img_type=="1") {			
			$dst_img=imagecreatetruecolor($new_w,$new_h); 
			$src_img=imagecreatefromgif($gambar); 	
			imagecopyresized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 
			imagegif($dst_img,$gambar, 100); 
			} 
}

/*
function function_sending_email($variable) {
	require(_INCLUDEDIRECTORY."/class.phpmailer.php");
	ini_set("display_errors",1);
	$mail = new PHPMailer();
	$mail->Sender 		= $variable["sender"];
	$mail->From 		= $variable["from"];
	$mail->FromName 	= $variable["fromname"];
	$mail->AddAddress($variable["to"]);
	$mail->AddCC($variable["cc"]);
	$mail->AddBCC($variable["bcc"]);
	$mail->Subject 		= $variable["subject"];
	$mail->Body 			= $variable["content"];
	$mail->IsHTML(true);     // set email format to HTML
  //print_r($variable);exit;
  //echo "dirpath: "._INCLUDEDIRECTORY; exit;
  if ($mail->Send()) return true; 
  else return false; 
}
*/


function function_sending_email($variable) {
	require(_INCLUDEDIRECTORY."/class.phpmailer.php");
	
	//print_r($variable);exit;
	
	$mailer = new PHPMailer();
    $mailer->IsSMTP();
//    $mailer->IsQmail();
    $mailer->CharSet      = 'utf-8';
	
	/*
    $mailer->Host         = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_HOST_);
    if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_USER_) != "") $mailer->Username     = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_USER_);
    if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_PWD_) != "") $mailer->Password     = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_PWD_);
    if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_AUTH_) != "") $mailer->SMTPAuth     = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_AUTH_);
    if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_SECURE_) != "") $mailer->SMTPSecure   = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_SECURE_);
    $mailer->Port         = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_PORT_);
    //$mailer->SMTPDebug    = 2;
	*/
	
	$mailer->Host         = "localhost";
    $mailer->Username     = "root";
    $mailer->Password     = "";
    $mailer->SMTPAuth     = "true";
    $mailer->SMTPSecure   = "";
    $mailer->Port         = "25";	
	
    $strFromEmail       = $variable["from"];
    $strFromName        = $variable["fromname"];

    if(isset($variable["replyTo"]) && $variable["replyTo"]<>"")
        $strReplyEmail      = $variable["replyTo"];
    else
        $strReplyEmail      = "shakti.santoso@hypermart.co.id";

    if(isset($variable["replyName"]) && $variable["replyName"]<>"")
        $strReplyName       = $variable["replyName"];
    else
        $strReplyName      = "Shakti Santoso";

	
    //$arrCCEmail = $variable["cc"];
	if(isset($variable["cc"])) {
		$arrCCEmail = $variable["cc"];
	}
	else {
		$arrCCEmail = "";
	}
	
	$arrBCCEmail=array();
	if(isset($variable["bcc"])) {
		$arrBCCEmail = $variable["bcc"];
	}
	else {
		$arrBCCEmail=array();
	}
	
    $mailer->SetFrom($strFromEmail, $strFromName);
    $mailer->ClearReplyTos();
    $mailer->AddReplyTo($strReplyEmail, $strReplyName);
	
	if(isset($variable["to"]) && is_array($variable["to"])) {
		foreach($variable["to"] as $emailtujuan) {
			$mailer->AddAddress($emailtujuan,$variable["toName"]);
		}
	}
	else {
		$mailer->AddAddress($variable["to"], $variable["toName"]);
	}
	
    $mailer->AddCC($arrCCEmail);
	
	for($i=0;$i<count($arrBCCEmail);$i++) {
    $mailer->AddBCC($arrBCCEmail[$i]);
	}
	
	if(isset($variable["attachment"]) && is_array($variable["attachment"])) {
		foreach($variable["attachment"] as $lampiran) {
			$mailer->addAttachment($variable["pathfiledir"]."/".$lampiran);
		}
	}
	    
    $mailer->Subject =  $variable["subject"];
	/*
    preg_match_all("|<[Ii][Mm][Gg][\\s]+(.*)[Ss][Rr][Cc][=][\"']([^\"'].*)[\"'][\\s]*(.*)[\\/]>|U", $content, $matches, PREG_PATTERN_ORDER);
    $replacedImg = array();
    foreach($matches[2] as $key => $imgPath) {
        if(strpos($imgPath, "http://") !== false) continue;
        if(in_array($imgPath, $replacedImg)) continue;
        $replacedImg[] = $imgPath;
        $filename = substr($imgPath, strrpos($imgPath, "/") + 1);
        $cid = generateRandomString(10);
        $mailer->AddEmbeddedImage($imgPath, $cid, $filename);
        $content = str_replace($imgPath, "cid:" . $cid, $content);
    }
	*/
    $mailer->IsHTML(true);
    $mailer->MsgHTML($variable["content"]);

    if ($mailer->Send()) return true; 
	else return false; 
}

function showAsButton($type) {
	if(isset($type) && $type=="ongoing") echo "<span class=\"btn btn-info btn-xs\">ON GOING</span>";
	if(isset($type) && $type=="pending") echo "<span class=\"btn btn-warning btn-xs\">PENDING</span>";
	if(isset($type) && $type=="reject") echo "<span class=\"btn btn-danger btn-xs\">REJECT</span>";
	if(isset($type) && $type=="join") echo "<span class=\"btn btn-success btn-xs\">JOIN</span>";
	if(isset($type) && $type=="disjoin") echo "<span class=\"btn btn-warning btn-xs\">DISJOIN</span>";
	if(isset($type) && $type=="pass") echo "<span class=\"btn btn-success btn-xs\">PASS</span>";
}


function showStageName($stage) {
	if(isset($stage) && $stage=="cv-screening") $show="HR Screening";
	if(isset($stage) && $stage=="user-screening") $show="User Screening";
	if(isset($stage) && $stage=="psychotest") $show="Psycho Test";
	if(isset($stage) && $stage=="hr-interview") $show="HR Interview";
	if(isset($stage) && $stage=="user-interview") $show="User Interview";
	if(isset($stage) && $stage=="background-check") $show="Background Check";
	if(isset($stage) && $stage=="offering") $show="Offering";
	
	return $show;
}

function showRoleName($role) {
	if(isset($role) && $role=="candid") $show="Candidate";
	if(isset($role) && $role=="pic") $show="PIC Recruiter";
	if(isset($role) && $role=="admin") $show="Administrator";
	if(isset($role) && $role=="hrd") $show="Approval Manager";
	
	return $show;
}


function reverseDate($date) {
	$pecah=explode("-",$date);
	$revdate=$pecah[2]."-".$pecah[1]."-".$pecah[0];
	return $revdate;
}

function showRupiah($angka) {
	$rp = "Rp " . number_format($angka,0,'','.');
	return $rp;
}
?>