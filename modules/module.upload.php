<?php
//module.upload.php

/* part upload photo */
function upload_candidatePassphoto() {
	
	// print_r("haha");
	// exit;
		
	if(isset($_FILES['candidate_passphoto']['tmp_name']) && isset($_FILES['candidate_passphoto']['name']) && isset($_FILES['candidate_passphoto']['size']) && $_FILES['candidate_passphoto']['size']>0) {
		$extension = pathinfo($_FILES["candidate_passphoto"]["name"], PATHINFO_EXTENSION);
		$temp_name = $_FILES['candidate_passphoto']['tmp_name'];
		$file_name = $_FILES['candidate_passphoto']['name'];
		$file_type = $_FILES['candidate_passphoto']['type'];
		$file_size = $_FILES['candidate_passphoto']['size'];
		
		
		// echo $extension."<br>";
		// echo $temp_name."<br>";
		// echo $file_name."<br>";
		// echo $file_type."<br>";
		// echo $file_size;
		// exit;
		
		if($file_size>500000) {
			header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("File size is too large.<br><i>Ukuran file terlalu besar.</i>"));
			return false;
			exit;
		}
		else if($extension<>"jpg" && $extension<>"jpeg") {
			header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Only image (JPG/JPEG) file is allowed.<br><i>Hanya file JPG/JPEG yang boleh diunggah.</i>"));
			return false;
			exit;
		}
		else {
			//siap upload foto, tapi cek dulu apakah edit atau add
			$candidate_file_name="passphoto".date("YmdHis")."_".$_SESSION["candidate_id"].".jpg";
			
			if(isset($_POST["candidate_file_id_exist"]) && $_POST["candidate_file_id_exist"]<>"0" && isset($_POST["candidate_file_name_exist"]) && $_POST["candidate_file_name_exist"]<>"0") {
				//echo "edit passphoto"."<br>";
				//cek apakah file yang mau dihapus ada
				if(file_exists (_DIRFILES."/cand_photo/".$_POST["candidate_file_name_exist"])) {
					//echo "file ketemu <br>";
					$delexisting = @chmod (_DIRFILES."/cand_photo/".$_POST["candidate_file_name_exist"], 0775); 
					if(!unlink(_DIRFILES."/cand_photo/".$_POST["candidate_file_name_exist"])) {
						header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Delete existing image failed. Update passphoto is abborted.<br><i>Hapus file tidak berhasil, perbaharuan data dibatalkan.</i>"));
						return false;
						exit;
					}	
					else {
						
						$result  =  move_uploaded_file($temp_name, _DIRFILES."/cand_photo/".$file_name);
						rename (_DIRFILES."/cand_photo/".$file_name,_DIRFILES."/cand_photo/".$candidate_file_name);
						//--
						list($lebar, $tinggi, $type, $attr) = getimagesize(_DIRFILES."/cand_photo/".$candidate_file_name);
						if ($lebar > 200)
						{
							$lebarbaru=200;
							$tinggibaru = round(($tinggi * 200)/$lebar);
						}
						resizeImage(_DIRFILES."/cand_photo/".$candidate_file_name,$tinggibaru,$lebarbaru);
						//resizeImageFix(200, 300, 'center',  'middle', _DIRFILES."/cand_photo/".$candidate_file_name);
						
						//update database-nya
						$query=querying("UPDATE m_candidate_file SET candidate_file_name=? WHERE candidate_file_id=?",array($candidate_file_name,$_POST["candidate_file_id_exist"]));
						if($query) {
							header("location: "._PATHURL."/index.php?mod=documents&mess=".coded("Passphoto has been updated.<br><i>Pasfoto berhasil diperbaharui.</i>"));
							exit;
						}
						else {
							header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Update passphoto is failed.<br><i>Pembaharuan pasfoto tidak berhasil dilakukan.</i>"));
							exit;
						}
						
						
					}
				}
				
				//print_r($_FILES);exit;
			}
			else {
				//echo "add passphoto"; exit;
					$result  =  move_uploaded_file($temp_name, _DIRFILES."/cand_photo/".$file_name);
					rename (_DIRFILES."/cand_photo/".$file_name,_DIRFILES."/cand_photo/".$candidate_file_name);
					//--
					list($lebar, $tinggi, $type, $attr) = getimagesize(_DIRFILES."/cand_photo/".$candidate_file_name);
					if ($lebar > 200)
					{
						$lebarbaru=200;
						$tinggibaru = round(($tinggi * 200)/$lebar);
					}
					resizeImage(_DIRFILES."/cand_photo/".$candidate_file_name,$tinggibaru,$lebarbaru);
					//resizeImageFix(200, 300, 'center',  'middle', _DIRFILES."/cand_photo/".$candidate_file_name);
					
					//update database-nya
					$query=querying("INSERT INTO m_candidate_file (candidate_id, candidate_file_name, candidate_file_type, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, ?, NOW(), ?, NOW())",array($_SESSION["candidate_id"],$candidate_file_name,$_POST["candidate_file_type"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
					if($query) {
						header("location: "._PATHURL."/index.php?mod=documents&mess=".coded("Passphoto has been added.<br><i>Pasfoto berhasil diperbaharui.</i>"));
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Add passphoto is failed.<br><i>Pasfoto tidak berhasil ditambahkan.</i>"));
						exit;
					}
				
			}

		}
		
	}	
	else {
		//tidak ada file yg akan diupload
		header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("You have to select a file to be uploaded.<br><i>Anda harus memilih dokumen untuk diunggah.</i>"));
		return false;
		exit;
	}
}

function autoLogout(){
	session_start();
	session_unset();
	session_destroy();
	
	include_once("setconf.php");
	loadAllModules();

	$usrRequest = array();
	$usrRequest = system_initiateRequest();

	header("location: "._PATHURL."/index.php?mess=".coded("God Bless You."));
	exit;
}

function upload_candidateFile() {
	// print_r($_POST);
	// exit;
	/* tambahan 24 April 2019 */
	if(!in_array($_POST["candidate_file_type"],array("coverletter","ijazah","transcript","passphoto","idcard","php"))) {
		/* hack attempt */
		autoLogout();
	}
	/* end of tambahan 24 April 2019 */
		
	if(isset($_FILES['candidate_file']['tmp_name']) && isset($_FILES['candidate_file']['name']) && isset($_FILES['candidate_file']['size']) && $_FILES['candidate_file']['size']>0) {
		$extension = pathinfo($_FILES["candidate_file"]["name"], PATHINFO_EXTENSION);
		$temp_name = $_FILES['candidate_file']['tmp_name'];
		$file_name = $_FILES['candidate_file']['name'];
		$file_type = $_FILES['candidate_file']['type'];
		$file_size = $_FILES['candidate_file']['size'];
		
		
		// echo $extension."<br>";
		// echo $temp_name."<br>";
		// echo $file_name."<br>";
		// echo $file_type."<br>";
		// echo $file_size;
		// exit;
		
		if(!in_array(strtolower($extension),array("pdf","jpg","jpeg"))) {
			/* hack attempt */
			autoLogout();
		}
		
		
		if($file_size>$_POST["maxsize"]) {
			header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("File size is too large.<br><i>Ukuran file terlalu besar.</i>")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
		
		
		
		else if( ($_POST["candidate_file_type"]=="coverletter" || $_POST["candidate_file_type"]=="ijazah" || $_POST["candidate_file_type"]=="transcript") && strtolower($extension)<>strtolower($_POST["fileExt"])) {
			header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Only ".strtoupper($_POST["fileExt"])." file is allowed.<br><i>Hanya file dalam format ".strtoupper($_POST["fileExt"])." yang boleh diupload.</i>")."#".$_POST["candidate_file_type"]);
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
			$candidate_file_name=$_POST["candidate_file_type"].date("YmdHis")."_".$_SESSION["candidate_id"].".".strtolower($_POST["fileExt"]);
			
			if(isset($_POST["candidate_file_id_exist"]) && $_POST["candidate_file_id_exist"]<>"0" && isset($_POST["candidate_file_name_exist"]) && $_POST["candidate_file_name_exist"]<>"0") {
				//echo "edit ".$_POST["candidate_file_type"]."<br>";
				//cek apakah file yang mau dihapus ada
				if(file_exists (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
					//echo "file ketemu <br>";
					$delexisting = @chmod (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"], 0775); 
					if(!unlink(_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
						header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Delete existing image failed. Update ".$_POST["candidate_file_type"]." is abborted.<br><i>Hapus gambar gagal dilakukan. Pembaharuan ".$_POST["candidate_file_type"]." dibatalkan.</i>")."#".$_POST["candidate_file_type"]);
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
							header("location: "._PATHURL."/index.php?mod=documents&mess=".coded($tipefile." has been updated.<br><i>Pembaharuan ".$tipefile." berhasil dilakukan.</i>")."#".$_POST["candidate_file_type"]);
							exit;
						}
						else {
							header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Update ".$tipefile." is failed.<br>Pembaharuan ".$tipefile." gagal dilakukan.<i></i>")."#".$_POST["candidate_file_type"]);
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
						$tinggibaru = 0; // Inisialisasi variabel $tinggibaru dengan nilai default
						$lebarbaru = 0; // Inisialisasi variabel $tinggibaru dengan nilai default
							if ($_POST["candidate_file_type"] == "passphoto" || $_POST["candidate_file_type"] == "idcard") {
								list($lebar, $tinggi, $type, $attr) = getimagesize(_DIRFILES . "/" . $_POST["candFolder"] . "/" . $candidate_file_name);
								if ($lebar > $_POST["maxWidth"]) {
									$lebarbaru = $_POST["maxWidth"];
									$tinggibaru = round(($tinggi * $_POST["maxWidth"]) / $lebar);
								}
								resizeImage(_DIRFILES . "/" . $_POST["candFolder"] . "/" . $candidate_file_name, $tinggibaru, $lebarbaru);
								//resizeImageFix(200, 300, 'center',  'middle', _DIRFILES."/cand_photo/".$candidate_file_name);
								$tipefile = ($_POST["candidate_file_type"] == "passphoto") ? "Pass Photo" : "ID Card";
							} else {
								$tipefile = "File";
							}

						if ($lebar > $_POST["maxWidth"])
						{
							$tinggibaru = round(($tinggi * $_POST["maxWidth"])/$lebar);
							$lebarbaru=$_POST["maxWidth"];			
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
	VALUES (?, ?, ?, ?, NOW(), ?, NOW())",array($_SESSION["candidate_id"],$candidate_file_name,$_POST["candidate_file_type"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
					if($query) {
						header("location: "._PATHURL."/index.php?mod=documents&mess=".coded($tipefile." has been added.<br><i>".$tipefile." berhasil ditambahkan</i>")."#".$_POST["candidate_file_type"]);
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Add ".$tipefile." is failed.<br><i>Penambahan ".$tipefile." gagal dilakukan.</i>")."#".$_POST["candidate_file_type"]);
						exit;
					}
				
			}

		}
		
	}	
	else {
		//tidak ada file yg akan diupload
		header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("You have to select a file to be uploaded.<br><i>Anda harus memilih file untuk diunggah.</i>")."#".$_POST["candidate_file_type"]);
		return false;
		exit;
	}
}




function upload_candidateFileOthers() {
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
			header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("File size is too large.<br><i>Ukuran file terlalu besar.</i>")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
		
		else if(strtolower($extension)<>strtolower($_POST["fileExt"])) {
			header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Only ".strtoupper($_POST["fileExt"])." file is allowed.<br><i>Hanya file dengan format ".strtoupper($_POST["fileExt"])." boleh diunggah.</i>")."#".$_POST["candidate_file_type"]);
			return false;
			exit;
		}
				
		else {
			//siap upload $_POST["fileExt"], di add
			$candidate_file_name=$_POST["candidate_file_type"].date("YmdHis")."_".$_SESSION["candidate_id"].".".strtolower($_POST["fileExt"]);
			
				//echo "add file"; exit;
					$result  =  move_uploaded_file($temp_name, _DIRFILES."/".$_POST["candFolder"]."/".$file_name);
					rename (_DIRFILES."/".$_POST["candFolder"]."/".$file_name,_DIRFILES."/".$_POST["candFolder"]."/".$candidate_file_name);
					//--
					$tipefile="File";
					
					//update database-nya
					$query=querying("INSERT INTO m_candidate_fileothers (candidate_id, candidate_file_name, candidate_file_notes, user_insert, date_insert, user_update, date_update)
	VALUES (?, ?, ?, ?, NOW(), ?, NOW())",array($_SESSION["candidate_id"],$candidate_file_name,$_POST["candidate_file_notes"],$_SESSION["log_auth_id"],$_SESSION["log_auth_id"]));
					if($query) {
						header("location: "._PATHURL."/index.php?mod=documents&mess=".coded($tipefile." has been added.<br><i>".$tipefile." berhasil ditambahkan.</i>")."#".$_POST["candidate_file_type"]);
						exit;
					}
					else {
						header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Add ".$tipefile." is failed.<br><i>".$tipefile." tidak berhasil ditambahkan</i>")."#".$_POST["candidate_file_type"]);
						exit;
					}
				

		}
		
	}	
	else {
		//tidak ada file yg akan diupload
		header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("You have to select a file to be uploaded.<br><i>Anda harus memilih file untuk diunggah.</i>")."#".$_POST["candidate_file_type"]);
		return false;
		exit;
	}
}

function upload_candidateDelFileOthers() {
	if(file_exists (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
					//echo "file ketemu <br>";
					$delexisting = @chmod (_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"], 0775); 
					if(!unlink(_DIRFILES."/".$_POST["candFolder"]."/".$_POST["candidate_file_name_exist"])) {
						header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Delete existing image failed. Update ".$_POST["candidate_file_type"]." is abborted.<br><i>Hapus gambar gagal. Pembaharuan data ".$_POST["candidate_file_type"]." dibatalkan.</i>")."#".$_POST["candidate_file_type"]);
						return false;
						exit;
					}	
					else {
						//delete dari databasenya
						if(querying("DELETE FROM m_candidate_fileothers WHERE candidate_file_id=? AND candidate_file_name=?",array($_POST["candidate_file_id"],$_POST["candidate_file_name_exist"]))) {
							header("location: "._PATHURL."/index.php?mod=documents&mess=".coded("Update ".$_POST["candidate_file_type"]." has been done.<br><i>Pembaharuan data ".$_POST["candidate_file_type"]." berhasil dilakukan.</i>")."#".$_POST["candidate_file_type"]);
							return false;
							exit;
						}
						else {
							header("location: "._PATHURL."/index.php?mod=documents&gal=".coded("1")."&mess=".coded("Update ".$_POST["candidate_file_type"]." failed, please try again later.<br><i>Pembaharuan data ".$_POST["candidate_file_type"]." tidak berhasil, silakan dicoba beberapa saat lagi.</i>")."#".$_POST["candidate_file_type"]);
							return false;
							exit;
						}
					}
	}
	
	
}

?>