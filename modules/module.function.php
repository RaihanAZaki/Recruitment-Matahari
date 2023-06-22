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
	//echo $hashed; exit;
	return $hashed;	
}

/* deprecated 
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
*/

/* update 24 September 2019 karena mcrypt_encrypt dan mcrypt_decrypt sudah deprecated */
function coded ($keyword, $pwd="shaktimpp") {
	//$codedkey = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, md5($pwd), $keyword, MCRYPT_MODE_CBC, md5(md5($pwd))));
	//$codedkey = base64_encode($codedkey);

	//$codedkey = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, md5($pwd), $keyword, MCRYPT_MODE_CBC, md5(md5($pwd)));
    $codedkey = base64_encode(openssl_encrypt($keyword, 'AES-128-CBC', md5($pwd), OPENSSL_RAW_DATA, md5(md5($pwd),TRUE)));
	$codedkey = base64_encode($codedkey);	
	return $codedkey;
}

function decoded($keyword,$pwd="shaktimpp")	{
	$keyword = base64_decode(strval($keyword));
	$decodedkey=openssl_decrypt(base64_decode($keyword), 'AES-128-CBC', md5($pwd), OPENSSL_RAW_DATA, md5(md5($pwd),TRUE));
	return $decodedkey;
}


function sanitize_get($input) {
	global $connection_type;
	global $activate_connection;
		
	$output=array();
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize_post($val);
		}
	}
	else {
		$input  = clean_post($input);
		if($connection_type=="2")
		{
			$output = mysqli_real_escape_string($activate_connection,$input);
		}
		else
		{
			$output = mysql_real_escape_string($input);
		}
	}
	return $output;
}



/* end of update related to deprecated mcrypt */

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
	global $connection_type;
	global $activate_connection;
		
	$output=array();
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize_post($val);
		}
	}
	else {
		$input  = clean_post($input);
		if($connection_type=="2")
		{
			$output = mysqli_real_escape_string($activate_connection,$input);
		}
		else
		{
			$output = mysql_real_escape_string($input);
		}
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
//original works well by shakti, disabled on 2017_09_10
// function getCity() {
	// $query=querying("SELECT city_id, city_province, city_name FROM m_city ORDER BY city_name ASC");
	// $data=sqlGetData($query);
	// return $data;
// }

function getCity() {
	 $query=querying("SELECT CityCode as city_id, CityState as city_province, CityName as city_name FROM City ORDER BY CityName ASC");
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

if ($new_w <= 0) {
    $new_w = 100; // Nilai default jika $new_w tidak valid
}

if ($new_h <= 0) {
    $new_h = 100; // Nilai default jika $new_h tidak valid
}

// Lanjutan kode untuk membuat dan mengubah ukuran gambar

if ($img_type == "2") {
    $src_img = imagecreatefromjpeg($gambar);
    $dst_img = imagecreatetruecolor($new_w, $new_h);
    imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, imagesx($src_img), imagesy($src_img));
    imagejpeg($dst_img, $gambar, 100);
} elseif ($img_type == "3") {
    $dst_img = imagecreatetruecolor($new_w, $new_h);
    $src_img = imagecreatefrompng($gambar);
    imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, imagesx($src_img), imagesy($src_img));
    imagepng($dst_img, $gambar, 100);
} elseif ($img_type == "1") {
    $dst_img = imagecreatetruecolor($new_w, $new_h);
    $src_img = imagecreatefromgif($gambar);
    imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, imagesx($src_img), imagesy($src_img));
    imagegif($dst_img, $gambar, 100);
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

// function function_sending_email($variable) {
// // 	// require(_INCLUDEDIRECTORY."/class.phpmailer.php");
// require './vendor/autoload.php';
	
// // 	//print_r($variable);exit;
	
// $mailer = new PHPMailer\PHPMailer\PHPMailer();
// $mailer->IsSMTP();
// // //    $mailer->IsQmail();
// //     $mailer->CharSet      = 'utf-8';
	
	
//     $mailer->Host = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_HOST_);
//     if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_USER_) != "") $mailer->Username     = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_USER_);
//     if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_PWD_) != "") $mailer->Password     = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_PWD_);
//     if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_AUTH_) != "") $mailer->SMTPAuth     = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_AUTH_);
//     if($config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_SECURE_) != "") $mailer->SMTPSecure   = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_SECURE_);
//     $mailer->Port         = $config->retrieveValue(_CONFIG_EMAIL_, _CONFIG_EMAIL_SMTP_PORT_);
//     //$mailer->SMTPDebug    = 2;
	
	
// 	$mailer->Host         = "localhost";
//     $mailer->Username     = "root";
//     $mailer->Password     = "";
//     $mailer->SMTPAuth     = "true";
//     $mailer->SMTPSecure   = "";
//     $mailer->Port         = "25";	
	
//     $strFromEmail       = $variable["from"];
//     $strFromName        = $variable["fromname"];

//     if(isset($variable["replyTo"]) && $variable["replyTo"]<>"")
//         $strReplyEmail      = $variable["replyTo"];
//     else
//         $strReplyEmail      = "shakti.santoso@hypermart.co.id";

//     if(isset($variable["replyName"]) && $variable["replyName"]<>"")
//         $strReplyName       = $variable["replyName"];
//     else
//         $strReplyName      = "Shakti Santoso";

	
// 	if(isset($variable["cc"])) {
// 		$arrCCEmail = $variable["cc"];
// 	}
// 	else {
// 		$arrCCEmail = "";
// 	}
	
// 	$arrBCCEmail=array();
// 	//print_r($variable["bcc"]);exit;
// 	if(isset($variable["bcc"])) {
// 		$arrBCCEmail = $variable["bcc"];
// 	}
// 	else {
// 		$arrBCCEmail=array();
// 	}

//     $mailer->SetFrom($strFromEmail, $strFromName);
//     $mailer->ClearReplyTos();
//     $mailer->AddReplyTo($strReplyEmail, $strReplyName);
	
// 	if(isset($variable["to"]) && is_array($variable["to"])) {
// 		foreach($variable["to"] as $emailtujuan) {
// 			$mailer->AddAddress($emailtujuan,$variable["toName"]);
// 		}
// 	}
// 	else {
// 		$mailer->AddAddress($variable["to"], $variable["toName"]);
// 	}
	
//     $mailer->AddCC($arrCCEmail);
	
// 	if (is_array($arrBCCEmail)) {
// 		for ($i = 0; $i < count($arrBCCEmail); $i++) {
// 			$mailer->AddBCC($arrBCCEmail[$i]);
// 		}
// 	}
	
// 	if(isset($variable["attachment"]) && is_array($variable["attachment"])) {
// 		foreach($variable["attachment"] as $lampiran) {
// 			$mailer->addAttachment($variable["pathfiledir"]."/".$lampiran);
// 		}
// 	}
	    
//     $mailer->Subject =  $variable["subject"];
	
//     preg_match_all("|<[Ii][Mm][Gg][\\s]+(.*)[Ss][Rr][Cc][=][\"']([^\"'].*)[\"'][\\s]*(.*)[\\/]>|U", $content, $matches, PREG_PATTERN_ORDER);
//     $replacedImg = array();
//     foreach($matches[2] as $key => $imgPath) {
//         if(strpos($imgPath, "http://") !== false) continue;
//         if(in_array($imgPath, $replacedImg)) continue;
//         $replacedImg[] = $imgPath;
//         $filename = substr($imgPath, strrpos($imgPath, "/") + 1);
//         $cid = generateRandomString(10);
//         $mailer->AddEmbeddedImage($imgPath, $cid, $filename);
//         $content = str_replace($imgPath, "cid:" . $cid, $content);
//     }
	
//     $mailer->IsHTML(true);
//     $mailer->MsgHTML($variable["content"]);

//     if ($mailer->Send()) return true; 
// 	else return false; 
// }

function function_sending_email($variable) {
    require './vendor/autoload.php';
    $mailer = new PHPMailer\PHPMailer\PHPMailer(true);
    $mailer->IsSMTP();
	
    
    // Konfigurasi SMTP
    $mailer->Host = "smtp.gmail.com";
    $mailer->Username = "rehantesterr@gmail.com";
    $mailer->Password = "nktjuhougpfkudms";
    $mailer->SMTPAuth = true;
    $mailer->SMTPSecure = "";
    $mailer->Port = 587;
    
    $strFromEmail = $variable["from"];
    $strFromName = $variable["fromname"];

    if(isset($variable["replyTo"]) && $variable["replyTo"] != "") {
        $strReplyEmail = $variable["replyTo"];
    } else {
        $strReplyEmail = "shakti.santoso@hypermart.co.id";
    }

    if(isset($variable["replyName"]) && $variable["replyName"] != "") {
        $strReplyName = $variable["replyName"];
    } else {
        $strReplyName = "Shakti Santoso";
    }

    if(isset($variable["cc"])) {
        $arrCCEmail = $variable["cc"];
    } else {
        $arrCCEmail = "";
    }
    
    $arrBCCEmail = array();
    if(isset($variable["bcc"])) {
        $arrBCCEmail = $variable["bcc"];
    } else {
        $arrBCCEmail = array();
    }

    $mailer->SetFrom($strFromEmail, $strFromName);
    $mailer->ClearReplyTos();
    $mailer->AddReplyTo($strReplyEmail, $strReplyName);

    if(isset($variable["to"]) && is_array($variable["to"])) {
        foreach($variable["to"] as $emailtujuan) {
            $mailer->AddAddress($emailtujuan, $variable["toName"]);
        }
    } else {
        $mailer->AddAddress($variable["to"], $variable["toName"]);
    }
	// $mailer->AddCC($arrCCEmail);

    if(is_array($arrBCCEmail)) {
        for($i = 0; $i < count($arrBCCEmail); $i++) {
            $mailer->AddBCC($arrBCCEmail[$i]);
        }
    }

    if(isset($variable["attachment"]) && is_array($variable["attachment"])) {
        foreach($variable["attachment"] as $lampiran) {
            $mailer->addAttachment($variable["pathfiledir"]."/".$lampiran);
        }
    }

    $mailer->Subject = $variable["subject"];

    preg_match_all("|<[Ii][Mm][Gg][\\s]+(.*)[Ss][Rr][Cc][=][\"']([^\"'].*)[\"'][\\s]*(.*)[\\/]>|U", $variable["content"], $matches, PREG_PATTERN_ORDER);
    $replacedImg = array();
    foreach($matches[2] as $key => $imgPath) {
        if(strpos($imgPath, "http://") !== false) continue;
        if(in_array($imgPath, $replacedImg)) continue;
        $replacedImg[] = $imgPath;
        $filename = substr($imgPath, strrpos($imgPath, "/") + 1);
        $cid = generateRandomString(10);
        $mailer->AddEmbeddedImage($imgPath, $cid, $filename);
        $variable["content"] = str_replace($imgPath, "cid:" . $cid, $variable["content"]);
    }
	
    
    $mailer->IsHTML(true);
    $mailer->MsgHTML($variable["content"]);
// 	try{
		
// 	 $mailer->Send();
// 	}catch (phpmailerException $e) {
// 		echo "asdsadasdsad";exit;
//   echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
// } catch (Exception $e) {
// 	echo "asdsadSDsd";exit;
//   echo $e->getMessage();exit; //Boring error messages from anything else!
// }

	
   if($mailer->Send()) {
        return true;
    } else {
        return false;
    }
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
    if(isset($stage) && $stage=="background-check") $show="Background Checking";
	if(isset($stage) && $stage=="offering") $show="Offering";
	
	return $show;
}


function referall() {
    // echo("haihai");exit;

    $server = $_SERVER['SERVER_NAME'];
    if (isset($_POST["nama_usulan"])) $_POST["nama_usulan"] = sanitize_post($_POST["nama_usulan"]);
    if (isset($_POST["email_usulan"])) $_POST["email_usulan"] = sanitize_post($_POST["email_usulan"]);
    if (isset($_POST["posisi"])) $_POST["posisi"] = sanitize_post($_POST["posisi"]);
    if (isset($_POST["email"])) $_POST["email"] = sanitize_post($_POST["email"]);
    if (isset($_POST["telp"])) $_POST["telp"] = sanitize_post($_POST["telp"]);

    if (isset($_GET)) $_GET = sanitize_post($_GET);

$query = querying("INSERT INTO m_calonusulan (usulan_name, usulan_email, email_pengusul	, posisi, telp_pengusul) VALUES (?, ?, ?, ?, ?)", array($_POST["nama_usulan"], $_POST["email_usulan"], $_POST["email"], $_POST["posisi"], $_POST["telp"]));



    if ($query) {
        // echo "masuk sini";exit;

        $variablemail = array();
        $variablemail["sender"]     = 'recruitment@hypermart.co.id';
        $variablemail["from"]       = "recruitment@hypermart.co.id";
        $variablemail["fromname"]   = "Registration PT. Matahari Putra Prima";
        $variablemail["to"]         = $_POST["email_usulan"];
        $variablemail["toName"]     = $_POST["nama_usulan"];
        $variablemail["bcc"]        = "shakti.santoso@hypermart.co.id";
        $variablemail["bcc"]        = "recruitment@hypermart.co.id";

        $variablemail["subject"]    = "[PT. Matahari Putra Prima] Email Activation";
        $variablemail["content"]    = "
        <p>Dear ".$_POST["nama_usulan"].", <br>Thank you for registering via our on-line recruitment website.<br>In order to activate your account, kindly click the link below, not later than <b>".date("d M y",strtotime($expiry_date))."</b>.<br><br>
        <a href="._PATHURL."/useractivation.php?usr=".coded($_POST["email_usulan"]."|".$expiry_date)."&a=".$register_activation_code.">
        Activate my account</a><br><br>
        or simply copy and then paste the link below to your web browser,<br><br>
         "._PATHURL."/useractivation.php?usr=".coded($_POST["email_usulan"]."|".$expiry_date)."&a=".$register_activation_code."
        <br><br>In case our email has been delivered into your SPAM / Bulk / Trash, kindly click \"Not Spam\" button to make sure that every single email from us is not going to your SPAM / Bulk / Trash folder.<br><br><br><br>
        <b>Best Regards,<br><br/>Matahari Putra Prima<br>Recruitment Team</b></p><hr>
        <p>Yang terhormat ".$_POST["name_usulan"].", <br>Terimakasih telah melakukan pendaftaran melalui situs pendaftaran online kami.<br>Untuk mengaktifkan akun Anda, silahkan klik link di bawah ini selambatnya pada tanggal <b>".date("d M y",strtotime($expiry_date))."</b>.<br><br>
        <a href="._PATHURL."/useractivation.php?usr=".coded($_POST["email_usulan"]."|".$expiry_date)."&a=".$register_activation_code.">
        Aktifkan akun saya</a><br><br>
        atau buka link berikut ini di perambah situs Anda,<br><br>
         "._PATHURL."/useractivation.php?usr=".coded($_POST["email_usulan"]."|".$expiry_date)."&a=".$register_activation_code."
        <br><br>Jika email kami masuk ke folder SPAM/ Bulk/ Trash, mohon klik tombol \"Not Spam\" agar selanjutnya email kami dapat terkirim langsung ke inbox Anda.<br><br><br><br>
        <b>Hormat kami,<br><br/>Tim Rekrutmen Matahari Putra Prima</b></p>
        ";
        
        //echo $variablemail["content"];exit;
        
        if (function_sending_email($variablemail))
        {
            unset($_SESSION["session"]);
            unset($variablemail);
            header("location: "._PATHURL."/index.php?mod=vacancy&mess=".coded("Terimakasih sudah mengirimkan calon kandidat yang layak.</i>"));
            exit;	
        }
        else
        {
            header("location: "._PATHURL."/index.php?mod=vacancy&gal=".coded("1")."&mess=".coded("Sending activation email failed. Please try again later.<br><i>Proses pengiriman email aktifasi tidak berhasil dilakukan. Silahkan ulangi beberapa saat lagi.</i>"));
            exit;	
        }	
    }
    else {
            header("location: "._PATHURL."/index.php?mod=vacancy&gal=".coded("1")."&mess=".coded("Error happen. We found difficulties in registering your account. Please try again later.<br><i>Terjadi kesalahan dalam proses pendaftaran akun Anda. Silahkan ulangi bebearpa saat lagi.</i>"));
            exit;	
    }
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


//tambahan shakti 18 oct 2017
function code4csharp($textnya) {
	$iv = "45287112549354892144548565456541";
	$key = "anjueolkdiwpoida";
	$text = $textnya;

	// to append string with trailing characters as for PKCS7 padding scheme
	$block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
	$padding = $block - (strlen($text) % $block);
	$text .= str_repeat(chr($padding), $padding);

	$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $iv);

	// this is not needed here            
	//$crypttext = urlencode($crypttext);

	$crypttext64=base64_encode($crypttext);
	return $crypttext64;
}

//tambahan shakti 25 September 2019

?>