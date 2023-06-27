<?php
if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	
	function date_compare($a, $b)
	{
		$t1 = strtotime($a['candidate_family_birthdate']);
		$t2 = strtotime($b['candidate_family_birthdate']);
		return $t1 - $t2;
	}    

	function adm_downloadResume() {
		//echo "module download";
		if(isset($_POST["candidate_id"]) && $_POST["candidate_id"]<>"") {
			$datacity=getCity();
			$datalob=getDataLob();
			
			$dataresume=admin_getDetailCandidate($_POST["candidate_id"]);

			$dataedu=admin_getDataEdu($_POST["candidate_id"]);
			$datajob=admin_getDataJob($_POST["candidate_id"]);		
			$datatraining=admin_getDataTraining($_POST["candidate_id"]);
			$dataorg=admin_getDataOrg($_POST["candidate_id"]);
			$dataskills=admin_getDataSkills($_POST["candidate_id"]);
			$datalang=admin_getDataLanguage($_POST["candidate_id"]);
			$datafam=admin_getDataFam($_POST["candidate_id"]);
			
			if(count($dataedu)>0) $dataedu=clean_show($dataedu);
			if(count($datajob)>0) $datajob=clean_show($datajob);
			if(count($datatraining)>0) $datatraining=clean_show($datatraining);
			if(count($dataorg)>0) $dataorg=clean_show($dataorg);
			if(count($dataskills)>0) $dataskills=clean_show($dataskills);
			if(count($datalang)>0) $datalang=clean_show($datalang);
			if(count($datafam)>0) $datafam=clean_show($datafam);
			
			
			$dataapply=admin_getDataApply("open_project",$_POST["candidate_id"]);

			$datachapter=getDataChapter();
			//print_r($datachapter);

			$dataquestion=getDataQuestion();
			//print_r($dataquestion);

			$dataanswer=admin_getDataAnswer($_POST["candidate_id"]);
			//print_r($dataanswer);

			for($q=0;$q<count($dataquestion);$q++) {
				for($a=0;$a<count($dataanswer);$a++) {
					if($dataanswer[$a]["question_id"]==$dataquestion[$q]["question_id"]) {
						$dataquestion[$q]["answer_yn"]=$dataanswer[$a]["answer_yn"];
						$dataquestion[$q]["answer_desc"]=$dataanswer[$a]["answer_desc"];
						$dataquestion[$q]["answer_id"]=$dataanswer[$a]["answer_id"];
					}
				}
			}



			
			$datadoc=admin_getDataDoc($_POST["candidate_id"]);
			$dataothers=admin_getDataOthers($_POST["candidate_id"]);


			$data=array();
			for($i=0;$i<count($datadoc);$i++) {
			$data[$i]["candidate_file_id"]=(isset($_SESSION["session"]["candidate_file_id"][$i]) && $_SESSION["session"]["candidate_file_id"][$i]<>"")?$_SESSION["session"]["candidate_file_id"][$i]:((isset($datadoc[$i]["candidate_file_id"]))?$datadoc[$i]["candidate_file_id"]:"");
			$data[$i]["candidate_file_name"]=(isset($_SESSION["session"]["candidate_file_name"][$i]) && $_SESSION["session"]["candidate_file_name"][$i]<>"")?$_SESSION["session"]["candidate_file_name"][$i]:((isset($datadoc[$i]["candidate_file_name"]))?$datadoc[$i]["candidate_file_name"]:"");
			$data[$i]["candidate_file_type"]=(isset($_SESSION["session"]["candidate_file_type"][$i]) && $_SESSION["session"]["candidate_file_type"][$i]<>"")?$_SESSION["session"]["candidate_file_type"][$i]:((isset($datadoc[$i]["candidate_file_type"]))?$datadoc[$i]["candidate_file_type"]:"");
			$data[$i]["candidate_file_notes"]=(isset($_SESSION["session"]["candidate_file_notes"][$i]) && $_SESSION["session"]["candidate_file_notes"][$i]<>"")?$_SESSION["session"]["candidate_file_notes"][$i]:((isset($datadoc[$i]["candidate_file_notes"]))?$datadoc[$i]["candidate_file_notes"]:"");
			}

			/*
			function getDocFile($dat, $type) {
				$datafile=array();
				for($i=0;$i<count($dat);$i++) {
					if($dat[$i]["candidate_file_type"]==$type) {
						$datafile["id"]=$dat[$i]["candidate_file_id"];
						$datafile["name"]=$dat[$i]["candidate_file_name"];			
						return $datafile;
						break;
					}
				}
			}*/

			$dataphoto=getDocFileDownload($data,"php");
			//print_r($dataphoto);exit;
			
			
			$margin_left=15;
			$margin_right=10;
			$margin_top=2;
			$margin_bottom=5;
			$margin_header=3;
			$margin_footer=5;
			
			
			/* start of part pdf */
			require_once("./includes/mpdf/vendor/autoload.php");		
			
			// $mpdf=new Mpdf\Mpdf('', 'A4', '', '', $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer);
			$mpdf = new Mpdf\Mpdf([
				'mode' => '',
				'format' => 'A4',
				'default_font_size' => '',
				'default_font' => '',
				'margin_left' => 15,
				'margin_right' => 10,
				'margin_top' => 20,
				'margin_bottom' => 5,
				'margin_header' => 3,
				'margin_footer' => 5
			]);
			$mpdf->SetHTMLHeader('<div align="right" style="width:100%; margin-bottom:20px; padding-bottom:3px;"><img src="'._IMAGEWEBPATH.'/header_mppa.png"></div>'); 
			$mpdf->SetHTMLFooter('<div align="right" style="width:100%; margin-bottom:10px; padding-top:5px;"><img src="'._IMAGEWEBPATH.'/footer_mppa.png"></div><div align="right">{PAGENO} <!--/ {nbpg}--></div>'); 
			$mpdf->defaultheaderfontsize=10;
			$mpdf->defaultheaderfontstyle='B';
			$mpdf->defaultheaderline=0;
			$mpdf->defaultfooterfontsize=8;
			$mpdf->defaultfooterfontstyle='I';
			$mpdf->defaultfooterline=0;
			$mpdf->setAutoTopMargin = 'stretch';
			$mpdf->setAutoBottomMargin = 'stretch';
			
			// Buffer the following html with PHP so we can store it to a variable later
			ob_start();

			// This is where your script would normally output the HTML using echo or print
			?>
					<html>
					<style>
						.fontawesome { font-family: fontawesome; };
					</style>
					
						<table border=0 cellspacing="7px;" width="800px" border=0 style="line-height:150%; overflow: wrap">
							<tr>
								<td colspan="4" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Personal Data</h2></td>
							</tr>
							<tr>
								<td rowspan="21" valign="top">
									<?php
									if(isset($dataphoto["id"]) && isset($dataphoto["name"]) && $dataphoto["name"]<>"") {
									?>
										<img src="<?php echo _CANDFILES;?>/cand_photo/<?php echo $dataphoto["name"];?>" width="150px" style="border: 3px solid #cecece;">
									<?php
									}
									else {
									?>	
										<img src="<?php echo _IMAGEWEBPATH;?>/no_image.png" width="150px">	
									<?php
									}
									?>
									<br><br>
										<table width="155px;" style="border:1px solid #cccccc;">
											<tr>
												<td style="background-color:#dddddd; padding:5px;"><b>APPLIED POSITION:</b></td>
											</tr>
											<tr>
												<td style="background-color:#ffffff; padding:5px;">
										<?php
										if(count($dataapply)>0) {
											$urut=1;
											for($i=0;$i<count($dataapply);$i++) {
											echo $urut.'. '.$dataapply[$i]["job_vacancy_name"].'<br />';
											$urut++;
											}
										}
										?>
												</td>
											</tr>
										</table>
									
								</td>
								<td valign="top" style="width:150px; text-align:left;">Name</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_name"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">E-mail</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_email"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Place, Birthdate</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_birthplace"];?>, <?php echo (isset($dataresume[0]["candidate_birthdate"]) && $dataresume[0]["candidate_birthdate"]<>"")?date("M d, Y",strtotime($dataresume[0]["candidate_birthdate"])):"";?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Gender</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo ucfirst($dataresume[0]["candidate_gender"]);?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Marital Status</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo ucfirst($dataresume[0]["candidate_marital"]);?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Nationality</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_country"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">ID Card Number</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_idcard"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Phone Number</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;">
									<?php
									echo '<i class="fontawesome fa fa-phone">&#xf095;</i> '. $dataresume[0]["candidate_hp1"];
									if(isset($dataresume[0]["candidate_hp2"]) && $dataresume[0]["candidate_hp2"]<>"") echo '<br> <i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_hp2"];
									if(isset($dataresume[0]["candidate_phone"]) && $dataresume[0]["candidate_phone"]<>"") echo '<br> <i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_phone"];
									?>
								</td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Religion</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_religion"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Race/ Ethnicity</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_race"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Body Height/ Weight</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_bodyheight"];?> cm / <?php echo $dataresume[0]["candidate_bodyweight"];?> kg</td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Bloodtype</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_bloodtype"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Permanent Address</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo (($dataresume[0]["candidate_p_address"]<>"")?clean_show($dataresume[0]["candidate_p_address"]):"");?><br><?php echo $dataresume[0]["candidate_p_city"];?>, <?php echo $dataresume[0]["candidate_p_postcode"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Mailing Address</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo (($dataresume[0]["candidate_c_address"]<>"")?clean_show($dataresume[0]["candidate_c_address"]):"");?><br><?php echo $dataresume[0]["candidate_c_city"];?>, <?php echo $dataresume[0]["candidate_c_postcode"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Driver License (SIM A)</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_sim_a"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Driver License (SIM C)</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_sim_c"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">NPWP</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo $dataresume[0]["candidate_npwp"];?></td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Expected Salary</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo (isset($dataresume[0]["candidate_expected_salary"]) && $dataresume[0]["candidate_expected_salary"]<>"" && $dataresume[0]["candidate_expected_salary"]>0)?showRupiah($dataresume[0]["candidate_expected_salary"]):"";?></td>
							</tr>
							
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Contact Person</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;">
									CP #1 : <?php echo $dataresume[0]["candidate_cp_name1"];?> <i>(<?php echo $dataresume[0]["candidate_cp_relation1"];?>)</i><br>
									Phone : <?php echo $dataresume[0]["candidate_cp_phone1"];?>
									<?php
									if(isset($dataresume[0]["candidate_cp_name1"]) && $dataresume[0]["candidate_cp_name1"]<>"") {
									?>
									<br><br>CP #2 : <?php echo $dataresume[0]["candidate_cp_name2"];?> <i>(<?php echo $dataresume[0]["candidate_cp_relation2"];?>)</i>
									<br>Phone : <?php echo $dataresume[0]["candidate_cp_phone2"];?><br>									
									<?php
									}
									?>
								</td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Reference</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;">
									<?php echo $dataresume[0]["candidate_ref_name"];?><br>
									Division: <?php echo $dataresume[0]["candidate_ref_division"];?><br>
									Position: <?php echo $dataresume[0]["candidate_ref_position"];?><br>
								</td>
							</tr>
							<tr>
								<td valign="top" style="width:150px; text-align:left;">Hobby/ Interest</td>
								<td valign="top" style="width:10px; text-align:center;">:</td>
								<td valign="top" style="width:350px; text-align:left;"><?php echo (($dataresume[0]["candidate_hobby"]<>"")?clean_show($dataresume[0]["candidate_hobby"]):"");?></td>
							</tr>
							
																	
						</table>
						
						<pagebreak />

			<!-- part detail personal -->
			<?php
			showEducationTable($dataedu);
			showExperienceTable($datajob);
			showOrganizationTable($dataorg);
			showTrainingTable($datatraining);
			showSkillsTable($dataskills);
			showLanguageTable($datalang);
			showFamTable($datafam);
			echo '<pagebreak />';
			showQuestionaireTable($datachapter,$dataquestion);
			?>
			<!-- end of part detail personal -->
			</html>
			<?php
			
			// Now collect the output buffer into a variable
			$html = ob_get_contents();
			ob_end_clean();

			// send the captured HTML from the output buffer to the mPDF class for processing
			$mpdf->WriteHTML($html);
			//$mpdf->AddPage();

			$mpdf->Output(str_replace(" ","_",$dataresume[0]["candidate_name"]).'_FullResume.pdf','D');
			exit;			
			/* end of pdf part */
			
		}
	}
	
	function showEducationTable($dataedu) {
		echo '
			<table cellspacing="0" cellpadding="5" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="4" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Education Record</h2></td>
				</tr>
				<tr><td valign="top" colspan="4" style="height:5px;"></td></tr>
		
			';
		for($i=0;$i<count($dataedu);$i++) {
		echo '
				<tr>
					<td valign="top" style="width:100px; background-color:#cecece; padding:5px; border-bottom: 1px solid #aaaaaa; color:#333333;"><b>'.$dataedu[$i]["candidate_edu_start"].' - '.$dataedu[$i]["candidate_edu_end"].'</b></td>
					<td valign="top" colspan="3" style="background-color:#ffffff; padding:5px 5px 5px 15px; border-bottom: 1px solid #aaaaaa; color:#333333;"><b>'.$dataedu[$i]["candidate_edu_degree"].'</b></td>
				<tr>
				';
			if(isset($dataedu[$i]["candidate_edu_major"]) && $dataedu[$i]["candidate_edu_major"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Major</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$dataedu[$i]["candidate_edu_major"].'</td>
				</tr>
			';
			}
			if(isset($dataedu[$i]["candidate_edu_institution"]) && $dataedu[$i]["candidate_edu_institution"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Institution</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$dataedu[$i]["candidate_edu_institution"].', '.$dataedu[$i]["candidate_edu_city"].'</td>
				</tr>
			';
			}
			if(isset($dataedu[$i]["candidate_edu_gpa"]) && $dataedu[$i]["candidate_edu_gpa"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">GPA</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$dataedu[$i]["candidate_edu_gpa"].'</td>
				</tr>
			';
			}
			if(isset($dataedu[$i]["candidate_edu_notes"]) && $dataedu[$i]["candidate_edu_notes"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Notes</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$dataedu[$i]["candidate_edu_notes"].'</td>
				</tr>
			';
			}
			
			
		echo '<tr><td valign="top" colspan="4" style="height:20px;"></td></tr>';
		}	
		echo '
			</table>
			';
	}

	function showExperienceTable($datajob) {
		echo '
			<table cellspacing="0" cellpadding="5" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="4" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Working Experiences</h2></td>
				</tr>
				<tr><td valign="top" colspan="4" style="height:5px;"></td></tr>
		
			';
		for($i=0;$i<count($datajob);$i++) {
		echo '
				<tr>
					<td valign="top" style="width:150px; background-color:#cecece; padding:5px; border-bottom: 1px solid #aaaaaa; color:#333333;"><b>'.((isset($datajob[$i]["candidate_jobexp_start"]) && $datajob[$i]["candidate_jobexp_start"]<>"" )?date("M Y", strtotime($datajob[$i]["candidate_jobexp_start"])):"").' - '.((isset($datajob[$i]["candidate_jobexp_end"]) && $datajob[$i]["candidate_jobexp_end"]<>"")?date("M Y", strtotime($datajob[$i]["candidate_jobexp_end"])):"").'</b></td>
					<td valign="top" colspan="3" style="background-color:#ffffff; padding:5px 5px 5px 15px; border-bottom: 1px solid #aaaaaa; color:#333333;"><b>'.$datajob[$i]["candidate_jobexp_company"].'</b> <i>('.$datajob[$i]["candidate_jobexp_position"].')</i></td>
				<tr>
				';
			if(isset($datajob[$i]["candidate_jobexp_address"]) && $datajob[$i]["candidate_jobexp_address"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Address</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_address"].'</td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_phone"]) && $datajob[$i]["candidate_jobexp_phone"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Phone</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_phone"].'</td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_lob"]) && $datajob[$i]["candidate_jobexp_lob"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Industry</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_lob"].'</td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_desc"]) && $datajob[$i]["candidate_jobexp_desc"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Job Description</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_desc"].'</td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_salary"]) && $datajob[$i]["candidate_jobexp_salary"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Salary</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.((isset($datajob[$i]["candidate_jobexp_salary"]) && $datajob[$i]["candidate_jobexp_salary"]<>"" && $datajob[$i]["candidate_jobexp_salary"]>0)?showRupiah($datajob[$i]["candidate_jobexp_salary"]):"<i>no data</i>" ).'</td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_numemployee"]) && $datajob[$i]["candidate_jobexp_numemployee"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;"># Employee</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_numemployee"].'</td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_subposition"]) && $datajob[$i]["candidate_jobexp_subposition"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Subordinate</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_subposition"].' <i>( '.$datajob[$i]["candidate_jobexp_subnumber"].' person(s) )</i></td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_spvposition"]) && $datajob[$i]["candidate_jobexp_spvposition"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Supervisor</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_spvname"].' <i>( '.$datajob[$i]["candidate_jobexp_spvposition"].' )</i></td>
				</tr>
			';
			}
			if(isset($datajob[$i]["candidate_jobexp_leaving"]) && $datajob[$i]["candidate_jobexp_leaving"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Leaving Reason</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datajob[$i]["candidate_jobexp_leaving"].'</td>
				</tr>
			';
			}
			
			
		echo '<tr><td valign="top" colspan="4" style="height:20px;"></td></tr>';
		}	
		echo '
			</table>
			';
	}


	function showOrganizationTable($dataorg) {
		echo '
			<table cellpadding="5" cellspacing="0" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="3" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Organizational Experiences</h2></td>
				</tr>
				<tr><td valign="top" colspan="3" style="height:5px;"></td></tr>
			</table>
			<table cellpadding="5" cellspacing="1" bgcolor="#666666" width="800px" style="overflow: wrap;">
				
				<tr>
					<td valign="middle" align="left" style="width:300px; background-color:#cecece; padding:3px;">Organization Name</td>
					<td valign="middle" align="left" style="width:150px; background-color:#cecece; padding:3px;">Periode</td>
					<td valign="middle" align="left" style="width:100px; background-color:#cecece; padding:3px;">Role</td>
				</tr>
				
		
			';
		for($i=0;$i<count($dataorg);$i++) {
			echo '		
				<tr>
					<td valign="top" style="width:300px; background-color:#ffffff; padding:3px;">'.$dataorg[$i]["candidate_organization_name"].'</td>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;">'.$dataorg[$i]["candidate_organization_start"].' - '.$dataorg[$i]["candidate_organization_end"].'</td>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;">'.$dataorg[$i]["candidate_organization_role"].'</td>
				</tr>
			';
			
		}	
		echo '
			</table>
			<br><br>
			';
	}

	function showTrainingTable($datatraining) {
		echo '
			<table cellpadding="5" cellspacing="0" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="3" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Training Experiences</h2></td>
				</tr>
				<tr><td valign="top" colspan="3" style="height:5px;"></td></tr>
			</table>
			<table cellspacing="1" bgcolor="#666666" width="800px" style="overflow: wrap;">
				
				<tr>
					<td valign="middle" align="left" style="width:180px; background-color:#cecece; padding:3px;">Training Name</td>
					<td valign="middle" align="left" style="width:180px; background-color:#cecece; padding:3px;">Institution</td>
					<td valign="middle" align="left" style="width:100px; background-color:#cecece; padding:3px;">Year</td>
					<td valign="middle" align="left" style="width:100px; background-color:#cecece; padding:3px;">Duration</td>
					<td valign="middle" align="left" style="width:150px; background-color:#cecece; padding:3px;">Sponsor</td>
				</tr>
				
		
			';
		for($i=0;$i<count($datatraining);$i++) {
			echo '		
				<tr>
					<td valign="top" style="width:180px; background-color:#ffffff; padding:3px;">'.$datatraining[$i]["candidate_training_name"].'</td>
					<td valign="top" style="width:180px; background-color:#ffffff; padding:3px;">'.$datatraining[$i]["candidate_training_institution"].'<br><i>('.$datatraining[$i]["candidate_training_city"].')</i></td>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;">'.$datatraining[$i]["candidate_training_year"].'</td>
					<td valign="top" align="left" style="width:100px; background-color:#ffffff; padding:3px;">'.$datatraining[$i]["candidate_training_duration"].'</td>
					<td valign="top" align="left" style="width:150px; background-color:#ffffff; padding:3px;">'.$datatraining[$i]["candidate_training_sponsor"].'</td>
				</tr>
			';
			
		}	
		echo '
			</table>
			<br><br>
			';
	}

	function showSkillsTable($dataskills) {
		echo '
			<table cellpadding="5" cellspacing="0" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="3" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Skills</h2></td>
				</tr>
				<tr><td valign="top" colspan="3" style="height:5px;"></td></tr>
			</table>
			<table cellpadding="5" cellspacing="1" bgcolor="#666666" width="800px" style="overflow: wrap;">
				
				<tr>
					<td valign="middle" align="left" style="width:300px; background-color:#cecece; padding:3px;">Skills</td>
					<td valign="middle" align="left" style="width:150px; background-color:#cecece; padding:3px;">Level</td>
					<td valign="middle" align="left" style="width:100px; background-color:#cecece; padding:3px;">Notes</td>
				</tr>
				
		
			';
		for($i=0;$i<count($dataskills);$i++) {
			echo '		
				<tr>
					<td valign="top" style="width:300px; background-color:#ffffff; padding:3px;">'.$dataskills[$i]["candidate_skill_name"].'</td>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;">'.$dataskills[$i]["candidate_skill_level"].'</td>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;">'.$dataskills[$i]["candidate_skill_notes"].'</td>
				</tr>
			';
			
		}	
		echo '
			</table>
			<br><br>
			';
	}

	
	function showLanguageTable($datalang) {
		echo '
			<table cellpadding="5" cellspacing="0" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="3" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Language Proficiency</h2></td>
				</tr>
				<tr><td valign="top" colspan="3" style="height:5px;"></td></tr>
			</table>
			<table cellpadding="5" cellspacing="1" bgcolor="#666666" width="800px" style="overflow: wrap;">
				
				<tr>
					<td valign="middle" align="left" style="width:300px; background-color:#cecece; padding:3px;">Language</td>
					<td valign="middle" align="left" style="width:150px; background-color:#cecece; padding:3px;">Reading</td>
					<td valign="middle" align="left" style="width:100px; background-color:#cecece; padding:3px;">Writing</td>
					<td valign="middle" align="left" style="width:100px; background-color:#cecece; padding:3px;">Conversation</td>
				</tr>
				
		
			';
		for($i=0;$i<count($datalang);$i++) {
			echo '		
				<tr>
					<td valign="top" style="width:300px; background-color:#ffffff; padding:3px;">'.$datalang[$i]["candidate_language_name"].'</td>
					<td valign="top" style="width:150px; background-color:#ffffff; padding:3px;">'.$datalang[$i]["candidate_language_read"].'</td>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;">'.$datalang[$i]["candidate_language_write"].'</td>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;">'.$datalang[$i]["candidate_language_conversation"].'</td>
				</tr>
			';
			
		}	
		echo '
			</table>
			<br><br>
			';
	}
	
	function showFamTable($datafam) {
		echo '
			<table cellspacing="0" cellpadding="5" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" colspan="4" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Family Background</h2></td>
				</tr>
				<tr><td valign="top" colspan="4" style="height:5px;"></td></tr>
		
			';
		for($i=0;$i<count($datafam);$i++) {
		echo '
				<tr>
					<td valign="top" style="width:100px; background-color:#cecece; padding:5px; border-bottom: 1px solid #aaaaaa; color:#333333;"><b>'.$datafam[$i]["candidate_family_relation"].'</b>'.(($datafam[$i]["candidate_family_rip"]=="Alive")?"":" <i>RIP</i>").'</td>
					<td valign="top" colspan="3" style="background-color:#ffffff; padding:5px 5px 5px 15px; border-bottom: 1px solid #aaaaaa; color:#333333;"><b>'.$datafam[$i]["candidate_family_name"].'</b></td>
				<tr>
				';
			if(isset($datafam[$i]["candidate_family_birthplace"]) && $datafam[$i]["candidate_family_birthplace"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Birth</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datafam[$i]["candidate_family_birthplace"].', '.((isset($datafam[$i]["candidate_family_birthdate"]) && $datafam[$i]["candidate_family_birthdate"]<>"")?date("M d, Y",strtotime($datafam[$i]["candidate_family_birthdate"])):"").'</td>
				</tr>
			';
			}
			if(isset($datafam[$i]["candidate_family_lastjob"]) && $datafam[$i]["candidate_family_lastjob"]<>"") {	
			echo '		
				<tr>
					<td valign="top" style="width:100px; background-color:#ffffff; padding:3px;"></td>
					<td valign="top" style="width:120px; background-color:#ffffff; padding:3px 3px 3px 15px;">Last job</td>
					<td valign="top" style="width:10px; background-color:#ffffff; padding:3px;">:</td>
					<td valign="top" style="background-color:#ffffff; padding:3px;">'.$datafam[$i]["candidate_family_lastjob"].' <i>('.$datafam[$i]["candidate_family_company"].')</i></td>
				</tr>
			';
			}
			
			
		echo '<tr><td valign="top" colspan="4" style="height:20px;"></td></tr>';
		}	
		echo '
			</table>
			';
	}


	function showQuestionaireTable($datachapter,$dataquestion) {
		//print_r($dataquestion); exit;
		echo '
			<table cellspacing="0" width="800px" style="overflow: wrap;">
				<tr>
					<td valign="top" align="right" style="border-bottom: 1px dotted #333333; color:#333333;"><h2>Questionaire</h2></td>
				</tr>
			</table>
		';
		for($c=0;$c<count($datachapter);$c++) {
			echo '
			<div>
				<span style="text-align:right; color:#aaaaaa;"><h3>part #'.$datachapter[$c]["question_chapter"].'</h3></span>
			
				<table width="800px" border="0" cellspacing="1" bgcolor="#666666;" cellpadding="5px;">
								<tr>
									<td style="background-color:#cecece;" align="center">No</td>
									<td style="background-color:#cecece;">Question</td>
									<td style="background-color:#cecece;">Yes</td>
									<td style="background-color:#cecece;">No</td>
									<td style="background-color:#cecece;">Description</td>
								</tr>
				
				
				';
							
							$urut=1;
							for($q=0;$q<count($dataquestion);$q++) {
								if($datachapter[$c]["question_chapter"]==$dataquestion[$q]["question_chapter"]) {
								echo '
								<tr>
									<td align="center" style="background-color:#ffffff;">'.$urut.'</td>
									<td width="50%" style="background-color:#ffffff;">'.clean_view($dataquestion[$q]["question_desc"]).'<br><smaller><i>'.clean_view($dataquestion[$q]["question_deskripsi"]).'</i></smaller></td>
									';				
									if($dataquestion[$q]["question_type"]=="yn_desc") {
									echo '
											<td style="background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="y")?'Yes':"").'</td>				
											<td style="background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="n")?'No':"").'</td>
											<td style="background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"").'</td>
										';
										}
									else if($dataquestion[$q]["question_type"]=="txt_area" || $dataquestion[$q]["question_type"]=="txt_box_int") {
									echo '
											<td colspan="3" style="background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"").'</td>';
										}
									else if($dataquestion[$q]["question_type"]=="txt_box_cur") {
									echo '
											<td colspan="3" style="background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?showRupiah($dataquestion[$q]["answer_desc"]):"").'</td>';
										}
								echo '</tr>';
									
								$urut++;
								}
							}
							
				echo '</table>';
			
			
			
			
			echo '
			</div>
			';		
			echo '
			<div style="height:10px;"></div>
			';
			
		}
		
	}
	


	/* versi tabel */
	function adm_downloadFullTabel() {

		if(isset($_POST["candidate_id"]) && $_POST["candidate_id"]<>"") {
			
			/* start pengambilan data */
			$mulainya= "Mulai pengambilan data detail karyawan ".$_POST["candidate_id"]." dari database: ".date("Y-m-d  H:i:s");
			write_errorlogs($mulainya,0);
			
			$datacity=getCity();
			$datalob=getDataLob();
			
			$dataresume=admin_getDetailCandidate($_POST["candidate_id"]);
			
			$dataedu=admin_getDataEdu($_POST["candidate_id"]);
			$datajob=admin_getDataJob($_POST["candidate_id"]);		
			$datatraining=admin_getDataTraining($_POST["candidate_id"]);
			$dataorg=admin_getDataOrg($_POST["candidate_id"]);
			$dataskills=admin_getDataSkills($_POST["candidate_id"]);
			$datalang=admin_getDataLanguage($_POST["candidate_id"]);
			$datafam=admin_getDataFam($_POST["candidate_id"]);
			
			if(count($dataedu)>0) $dataedu=clean_show($dataedu);
			if(count($datajob)>0) $datajob=clean_show($datajob);
			if(count($datatraining)>0) $datatraining=clean_show($datatraining);
			if(count($dataorg)>0) $dataorg=clean_show($dataorg);
			//if(count($dataskills)>0) $dataskills=clean_show($dataskills);
			if(count($datalang)>0) $datalang=clean_show($datalang);
			if(count($datafam)>0) $datafam=clean_show($datafam);
			
			$dataapply=admin_getDataApply("open_project",$_POST["candidate_id"]);

			$datachapter=getDataChapter();
			//print_r($datachapter);

			$dataquestion=getDataQuestion();
			//print_r($dataquestion);

			$dataanswer=admin_getDataAnswer($_POST["candidate_id"]);
			//print_r($dataanswer);

			//print_r($datajob);
			
			
			for($q=0;$q<count($dataquestion);$q++) {
				for($a=0;$a<count($dataanswer);$a++) {
					if($dataanswer[$a]["question_id"]==$dataquestion[$q]["question_id"]) {
						$dataquestion[$q]["answer_yn"]=$dataanswer[$a]["answer_yn"];
						$dataquestion[$q]["answer_desc"]=$dataanswer[$a]["answer_desc"];
						$dataquestion[$q]["answer_id"]=$dataanswer[$a]["answer_id"];
					}
				}
			}



			
			$datadoc=admin_getDataDoc($_POST["candidate_id"]);
			$dataothers=admin_getDataOthers($_POST["candidate_id"]);


			$data=array();
			for($i=0;$i<count($datadoc);$i++) {
			$data[$i]["candidate_file_id"]=(isset($_SESSION["session"]["candidate_file_id"][$i]) && $_SESSION["session"]["candidate_file_id"][$i]<>"")?$_SESSION["session"]["candidate_file_id"][$i]:((isset($datadoc[$i]["candidate_file_id"]))?$datadoc[$i]["candidate_file_id"]:"");
			$data[$i]["candidate_file_name"]=(isset($_SESSION["session"]["candidate_file_name"][$i]) && $_SESSION["session"]["candidate_file_name"][$i]<>"")?$_SESSION["session"]["candidate_file_name"][$i]:((isset($datadoc[$i]["candidate_file_name"]))?$datadoc[$i]["candidate_file_name"]:"");
			$data[$i]["candidate_file_type"]=(isset($_SESSION["session"]["candidate_file_type"][$i]) && $_SESSION["session"]["candidate_file_type"][$i]<>"")?$_SESSION["session"]["candidate_file_type"][$i]:((isset($datadoc[$i]["candidate_file_type"]))?$datadoc[$i]["candidate_file_type"]:"");
			$data[$i]["candidate_file_notes"]=(isset($_SESSION["session"]["candidate_file_notes"][$i]) && $_SESSION["session"]["candidate_file_notes"][$i]<>"")?$_SESSION["session"]["candidate_file_notes"][$i]:((isset($datadoc[$i]["candidate_file_notes"]))?$datadoc[$i]["candidate_file_notes"]:"");
			}

			/*	
			function getDocFile($dat, $type) {
				$datafile=array();
				for($i=0;$i<count($dat);$i++) {
					if($dat[$i]["candidate_file_type"]==$type) {
						$datafile["id"]=$dat[$i]["candidate_file_id"];
						$datafile["name"]=$dat[$i]["candidate_file_name"];			
						return $datafile;
						break;
					}
				}
			}
			*/

			$dataphoto=getDocFileDownload($data,"passphoto");
			
			/* akhir menyiapkan semua data dari database dan disimpan ke array */
			$selesai= "Akhir pengambilan data detail karyawan ".$_POST["candidate_id"]." dari database dan diinput ke array: ".date("Y-m-d  H:i:s");
			write_errorlogs($selesai,0);
			
			/* mulai setting pdf */
			$mulainya="mulai setting pdf karyawan ".$_POST["candidate_id"]." : ".date("Y-m-d  H:i:s");
			write_errorlogs($mulainya,0);
			
			// include(_INCLUDEDIRECTORY."/mpdf/mpdf.php");
			require_once("./includes/mpdf/vendor/autoload.php");	
			// $mpdf = new Mpdf\Mpdf('win-1252',    // mode - default ''
			// 				 'A4',    // format - A4, for example, default ''
			// 				 0,     // font size - default 0
			// 				 '',    // default font family
			// 				 10,    // margin_left
			// 				 10,    // margin right
			// 				 10,     // margin top
			// 				 10,    // margin bottom
			// 				 0,     // margin header
			// 				 0,     // margin footer
			// 				 'P');  // L - landscape, P - portrait

			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'win-1252',
				'format' => 'A4',
				'default_font_size' => 0,
				'default_font' => '',
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 10,
				'margin_bottom' => 10,
				'margin_header' => 0,
				'margin_footer' => 0,
				'orientation' => 'P',
				]);
			
			//$mpdf=new mPDF('win-1252','A4','','',20,15,10,25,10,10); 
			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("Data Pelamar");
			$mpdf->SetAuthor("Hypermart");
			$mpdf->SetWatermarkText("Hypermart");
			$mpdf->showWatermarkText = false;
			$mpdf->watermark_font = 'DejaVuSansCondensed';
			$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			/* end setting pdf */
			$selesai="selesai setting pdf karyawan ".$_POST["candidate_id"]." : ".date("Y-m-d  H:i:s");
			write_errorlogs($selesai,0);
			
			
			/* mulai create table html buat pdf */
			$mulainya="mulai create table html karyawan ".$_POST["candidate_id"]." : ".date("Y-m-d  H:i:s");
			write_errorlogs($mulainya,0);
			
			$html = '
			<html>
			<head>
			<style>
			body {font-family: sans-serif;
				font-size: 10pt;
			}
			p {    margin: 0pt;
			}
			
			.fontawesome { font-family: fontawesome; }
			</style>
			
			 
			</head>
			<body>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="35%" height="105" align="left" valign="top">
				<table width="180px" cellpadding="3" cellspacing="0" >
				  <tr>
					<td style="border: 0.1px solid black;padding:5px;" valign="top">
					
					<span style="color:black;font-size:9px;">
					<u>POSISI YANG DILAMAR</u><br />
					Post of which you are applying<br /><br />';
				
				$urut=1;
				for($i=0;$i<count($dataapply);$i++) {
				$html .= $urut.". ".$dataapply[$i]["job_vacancy_name"].'<br />';
				$urut++;
				}
				
				$html .= '
					</span></td>
				  </tr>
				</table>
				
				
				</td>
				<td width="40%" align="center" height="45">
				<span style="color:black;font-size:14px;"><u><b>FORMULIR LAMARAN KERJA</b></u></span><br />
				<span style="color:black;font-size:14px;"><b><i>EMPLOYMENT APPLICATION FORM</i></b></span>
				</td>
				<td width="25%" align="right">';
				
				if(isset($dataphoto["id"]) && isset($dataphoto["name"]) && $dataphoto["name"]<>"") {
					$html .= '<img src="'._CANDFILES.'/cand_photo/'.$dataphoto["name"].'" width="80px" style="border: 3px solid #efefef;">';
				}
				else {
					$html .= '<img src="'._IMAGEWEBPATH.'/no_image.png" width="80px">';
				}
				
				$html .='
				</td>
			  </tr>
			  <tr>
				<td height="14" colspan="3"><hr /></td>
			  </tr>
			  
			</table>


			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="2" cellspacing="0">
				<tr>
					<td width="350px" height="15px" style="border: 1px solid black;" align="left">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="140px" height="15">NAMA LENGKAP/ Full name</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_name"].'</td>
							</tr>
						</table>
					</td>
					<td width="200px" style="border: 0.1mm solid black;" align="left">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="120px" height="15">JENIS KELAMIN/ Gender</td>
								<td width="10px">:</td>
								<td>
								';
									if($dataresume[0]["candidate_gender"]=='male')
									{$html.='Lk / Male';}
									else
									if($dataresume[0]["candidate_gender"]=='female')
									{$html.='Pr / Female';}
				
								$html .=' </td>
							</tr>
						</table>
					</td>
					<td style="border: 0.1mm solid black;" align="left">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="80px" height="15">AGAMA/ Religion</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_religion"].' </td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
			<tr>
				<td width="190px" height="15px" style="border: 0.1mm solid black;" align="left">
					<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
							<td width="110px" height="15">TGL LAHIR/ Birth date</td>
							<td width="10px">:</td>
							<td>'.reverseDate($dataresume[0]["candidate_birthdate"]).'</td>
						</tr>
					</table>
				</td>
				<td width="300px" style="border: 0.1mm solid black;" align="left">
					<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
							<td width="150px" height="15">TEMPAT LAHIR/ Place of birth</td>
							<td width="10px">:</td>
							<td>'.$dataresume[0]["candidate_birthplace"].' </td>
						</tr>
					</table>
				</td>
				<td style="border: 0.1mm solid black;" align="left">
					<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
						<tr>
							<td width="140px" height="15">WARGA NEGARA/ Nationality</td>
							<td width="10px">:</td>
							<td>'.strtoupper($dataresume[0]["candidate_nationality"]).' '.$dataresume[0]["candidate_country"].'</td>
						</tr>
					</table>
				</td>
			</tr>
			</table>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="270px" height="15px" style="border: 0.1mm solid black;">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="130px" height="15">TINGGI BADAN/ Height</td>
								<td width="10px">:</td>
								<td width="100px">'.$dataresume[0]["candidate_bodyheight"].' Cm</td>
							</tr>
						</table>			  
					</td>
					<td width="270px" height="15px" style="border: 0.1mm solid black;">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="130px" height="15">BERAT BADAN/ Weight</td>
								<td width="10px">:</td>
								<td width="60px">'.$dataresume[0]["candidate_bodyweight"].' Kg</td>
							</tr>
						</table>			  
					</td>
					<td height="15px" style="border: 0.1mm solid black;">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="170px" height="15">GOLONGAN DARAH/ Blood type</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_bloodtype"].'</td>
							</tr>
						</table>
					</td>
					
				</tr>
			</table>

			
			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="220px" style="border: 0.1mm solid black;">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100px" height="15">No. KTP/ IDs Number</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_idcard"].' </td>
							</tr>
						</table>
					</td>
					<td width="250px" style="border: 0.1mm solid black;">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="155px" height="15">SIM A/ Driver License Number:</td>
								<td>'.$dataresume[0]["candidate_sim_a"].'</td>
							</tr>
						</table>
					</td>									
					<td style="border: 0.1mm solid black;">
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="155px" height="15">SIM C/ Driver License Number:</td>
								<td>'.$dataresume[0]["candidate_sim_c"].'</td>
							</tr>
						</table>
					</td>				
				</tr>
			</table>
			
			
			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="320px" height="15px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="70px" height="15">E-mail</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_email"].'</td>
							</tr>
						</table>
					</td>
					<td width="190px" height="15px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100px" height="15">STATUS SIPIL/ Civil</td>
								<td width="10px">:</td>								
								<td>'.$dataresume[0]["candidate_marital"].'</td>
							</tr>
						</table>
					</td>
					<td height="15px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="60px" height="15">Suku/ Race</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_race"].'</td>
							</tr>
						</table>
					</td>
					
					
				</tr>
			</table>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500px" height="20px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="120px" height="20">ALAMAT SEKARANG :<br />Current Address</td>
								<td width="380px">'.(($dataresume[0]["candidate_c_address"]<>"")?clean_show($dataresume[0]["candidate_c_address"]):"").' - '.$dataresume[0]["candidate_c_city"].' - '.$dataresume[0]["candidate_c_postcode"].'</td>
							</tr>
						</table>
					</td>
					<td width="200px" height="20px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="80px" height="20">HANDPHONE : <br />Mobile</td>
								<td width="120px"><i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_hp1"].(($dataresume[0]["candidate_hp2"]<>"")?"<br><i class=\"fontawesome fa fa-phone\">&#xf095;</i> ".$dataresume[0]["candidate_hp2"]:"").'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="500px" height="20px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="150px" height="20">ALAMAT TETAP (Sesuai KTP) :<br />Permanent Address</td>
								<td width="350px">'.(($dataresume[0]["candidate_p_address"]<>"")?clean_show($dataresume[0]["candidate_p_address"]):"").' - '.$dataresume[0]["candidate_p_city"].' - '.$dataresume[0]["candidate_p_postcode"].'</td>
							</tr>
						</table>
					</td>
					<td width="200px" height="20px" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="80px" height="20">TELEPON :<br />Telephone</td>
								<td width="120px">'.$dataresume[0]["candidate_phone"].'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>


			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="100%" style="border: 0.1mm solid black;" >
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
								<td width="130px" height="20">KONTAK DARURAT 1<br />Emergency Contact 1</td>
								<td width="10px">:</td>
								<td width="200px">'.$dataresume[0]["candidate_cp_name1"].' - '.$dataresume[0]["candidate_cp_relation1"].'<br><i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_cp_phone1"].'</td>
								<td width="130px" height="20">KONTAK DARURAT 2<br />Emergency Contact 1</td>
								<td width="10px">:</td>
								<td>'.$dataresume[0]["candidate_cp_name2"].' - '.$dataresume[0]["candidate_cp_relation2"].'<br><i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_cp_phone2"].'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>';

			
			
			/* Pendidikan */
			$html .= '
			<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>PENDIDIKAN (SEBUTKAN SEMUA PENDIDIKAN YANG DIIKUTI)</b></div>
			<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Education (list all school attended)</i></div>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<th width="2%" height="35px" style="border: 0.1mm solid black;background-color:#cecece;" >
					No.</th>
					<th width="15%" height="35px" style="border: 0.1mm solid black;background-color:#cecece;" >
					SEKOLAH <br /><i>School</i></th>

					<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
					NAMA SEKOLAH <br /><i>Name of School</i></th>

					<th width="15%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
					KOTA <br /><i>City</i></th>

					<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
					JURUSAN <br /><i>Area of specialization</i></th>

					<th width="13%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
					THN AKADEMIK<br /><i>Education year</i><hr style="color:black; padding:0px; margin:0px;"/>Dari / Sampai<br /><i>From / Until</i></th>

					<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
					KETERANGAN <br /><i>Explanation</i></th>
				</tr>';
				
				$urut = 1;
				for ($i = 0; $i < 4; $i++) {
					if (isset($dataedu[$i])) {
						$html .= '
						<tr>
							<td width="2%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;">' . $urut . '</td>
							<td width="15%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;">
								' . $dataedu[$i]["candidate_edu_degree"] . '
							</td>
							<td width="20%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;">
								' . $dataedu[$i]["candidate_edu_institution"] . '
							</td>
							<td width="15%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;" align="center">
								' . $dataedu[$i]["candidate_edu_city"] . '
							</td>
							<td width="20%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;">
								' . $dataedu[$i]["candidate_edu_major"] . '
							</td>
							<td width="13%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;" align="center">
								' . $dataedu[$i]["candidate_edu_start"] . ' / ' . $dataedu[$i]["candidate_edu_end"] . '
							</td>
							<td width="15%" height="40px" style="border: 0.1mm solid black; padding-top:1px; padding-bottom:1px;">
								' . $dataedu[$i]["candidate_edu_notes"] . '
							</td>
						</tr>';
						$urut++;
					}
				}
				$html .= '</table>';
				
			
			/* training dan pelatihan */
			$html .='
			<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>PELATIHAN / KURSUS</b></div>
			<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Training / Course</i></div>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
			<tr>

				<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
				BIDANG <br /><i>Subject</i>
				</th>

				<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
				LEMBAGA <br /><i>Institute</i>
				</th>

				<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
				KOTA <br /><i>City</i>
				</th>

				<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
				Tahun (Durasi)<br /><i>Year (Duration)</i>
				</th>

				<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
				DIBIAYAI OLEH <br /><i>Financed by</i>
				</th>
			</tr>';
			// for($i=0;$i<4;$i++) {
			// $html.='
			// <tr>
			// 	<td width="20%" height="33px" style="border: 0.1mm solid black;" >
			// 	'.$datatraining[$i]["candidate_training_name"].'
			// 	</td>

			// 	<td width="20%" height="33px" style="border: 0.1mm solid black;" align="left">
			// 	'.$datatraining[$i]["candidate_training_institution"].'
			// 	</td>


			// 	<td width="20%" height="33px" style="border: 0.1mm solid black;" align="center">
			// 	'.$datatraining[$i]["candidate_training_city"].'
			// 	</td>

			// 	<td width="15%" height="33px" style="border: 0.1mm solid black;" align="center">
			// 	'.$datatraining[$i]["candidate_training_year"].' <i>('.$datatraining[$i]["candidate_training_duration"].')</i>
			// 	</td>

			// 	<td width="25%" height="33px" style="border: 0.1mm solid black;" >
			// 	'.$datatraining[$i]["candidate_training_sponsor"].'
			// 	</td>
			// </tr>';
			// }
			// $html.='</table>';
			if (count($datatraining) >= 4) {
				for ($i = 0; $i < 4; $i++) {
					$html .= '
					<tr>
						<td width="20%" height="33px" style="border: 0.1mm solid black;" >
						'.$datatraining[$i]["candidate_training_name"].'
						</td>
			
						<td width="20%" height="33px" style="border: 0.1mm solid black;" align="left">
						'.$datatraining[$i]["candidate_training_institution"].'
						</td>
			
						<td width="20%" height="33px" style="border: 0.1mm solid black;" align="center">
						'.$datatraining[$i]["candidate_training_city"].'
						</td>
			
						<td width="15%" height="33px" style="border: 0.1mm solid black;" align="center">
						'.$datatraining[$i]["candidate_training_year"].' <i>('.$datatraining[$i]["candidate_training_duration"].')</i>
						</td>
			
						<td width="25%" height="33px" style="border: 0.1mm solid black;" >
						'.$datatraining[$i]["candidate_training_sponsor"].'
						</td>
					</tr>';
				}
				$html .= '</table>';
			} else {
				// Handle the case when the array doesn't have enough elements
				// Display an error message or take appropriate action
			}
			
			
			/* bahasa */
			
			$html .='
			<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>BAHASA ASING</b></div>
			<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Foreign languages</i></div>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>

					<th width="25%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
					BAHASA <br /><i>Foreign Language</i>
					</th>

					<th width="25%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
					Membaca <br /><i>Read</i>
					</th>

					<th width="25%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
					Bicara <br /><i>Speak</i>
					</th>

					<th width="25%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
					Menulis <br /><i>Write</i>
					</th>

				</tr>';
			// INI BARU
			for ($i = 0; $i <= 3; $i++) {
				if (isset($datalang[$i])) {
					$html .= '
					<tr>
						<td width="20%" height="20px" style="border: 0.1mm solid black;">'.$datalang[$i]["candidate_language_name"].'</td>
						<td width="20%" height="20px" style="border: 0.1mm solid black;">'.$datalang[$i]["candidate_language_read"].'</td>
						<td width="20%" height="20px" style="border: 0.1mm solid black;">'.$datalang[$i]["candidate_language_conversation"].'</td>
						<td width="20%" height="20px" style="border: 0.1mm solid black;">'.$datalang[$i]["candidate_language_write"].'</td>
					</tr>';
				}
			}
			$html .= '</table>';
			
			
			// /* Skills */
			// $html .='
			// <div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>KETRAMPILAN LAIN</b></div>
			// <div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Other skilss</i></div>

			// <table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
			// <tr>
			// 	<td width="50%" height="20px" style="border: 0.1mm solid black;" >1. '.$dataskills[0]["candidate_skill_name"].' <i>('.$dataskills[0]["candidate_skill_level"].')</i></td>
			// 	<td width="50%" height="20px" style="border: 0.1mm solid black;" >3. '.$dataskills[2]["candidate_skill_name"].' <i>('.$dataskills[2]["candidate_skill_level"].')</i></td>
			// </tr>
			// <tr>
			// 	<td width="50%" height="20px" style="border: 0.1mm solid black;" >2. '.$dataskills[1]["candidate_skill_name"].' <i>('.$dataskills[1]["candidate_skill_level"].')</i></td>
			// 	<td width="50%" height="20px" style="border: 0.1mm solid black;" >4. '.$dataskills[3]["candidate_skill_name"].' <i>('.$dataskills[3]["candidate_skill_level"].')</i></td>
			// </tr>';
			
			// $html .='</table>';

			$html .= '
			<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>KETRAMPILAN LAIN</b></div>
			<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Other skills</i></div>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>
					<td width="50%" height="20px" style="border: 0.1mm solid black;">1. ' . (isset($dataskills[0]["candidate_skill_name"]) ? $dataskills[0]["candidate_skill_name"] : "") . ' <i>(' . (isset($dataskills[0]["candidate_skill_level"]) ? $dataskills[0]["candidate_skill_level"] : "") . ')</i></td>
					<td width="50%" height="20px" style="border: 0.1mm solid black;">3. ' . (isset($dataskills[2]["candidate_skill_name"]) ? $dataskills[2]["candidate_skill_name"] : "") . ' <i>(' . (isset($dataskills[2]["candidate_skill_level"]) ? $dataskills[2]["candidate_skill_level"] : "") . ')</i></td>
				</tr>
				<tr>
					<td width="50%" height="20px" style="border: 0.1mm solid black;">2. ' . (isset($dataskills[1]["candidate_skill_name"]) ? $dataskills[1]["candidate_skill_name"] : "") . ' <i>(' . (isset($dataskills[1]["candidate_skill_level"]) ? $dataskills[1]["candidate_skill_level"] : "") . ')</i></td>
					<td width="50%" height="20px" style="border: 0.1mm solid black;">4. ' . (isset($dataskills[3]["candidate_skill_name"]) ? $dataskills[3]["candidate_skill_name"] : "") . ' <i>(' . (isset($dataskills[3]["candidate_skill_level"]) ? $dataskills[3]["candidate_skill_level"] : "") . ')</i></td>
				</tr>
			</table>';

			$html .= '</div>';

			
			/* family */
			$html .='
			<pagebreak />
			<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>LATAR BELAKANG KELUARGA</b></div>
			<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Family Background</i></div>

			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">

			<tr>
				<th width="3%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">No.</th>
				<th width="10%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
				KELUARGA <br /><i>Family</i>
				</th>
				<th width="17%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
				NAMA <br /><i>Name</i>
				</th>
				<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
				TEMPAT TGL LAHIR <br /><i>Place & Date of birth</i>
				</th>
				<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
				PENDIDIKAN TERAKHIR <br /><i>Latest Education
				</th>
				<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
				JABATAN <br /><i>Position
				</th>
				<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;">
				PERUSAHAAN <br /><i>Company
				</th>
			</tr>
			';
			
						
			$dataparents=admin_getDataFamByType($_POST["candidate_id"],"parents");
			$datasiblings=admin_getDataFamByType($_POST["candidate_id"],"siblings");
			$dataspouse=admin_getDataFamByType($_POST["candidate_id"],"spouse");
			$datachildren=admin_getDataFamByType($_POST["candidate_id"],"children");
						
			/* part parents */
			// $ur=1;
			// for($i=0;$i<2;$i++) {
			// $html.='
			// <tr>
			// 	<td width="3%" height="35px" style="border: 0.1mm solid black;" >'.$ur.'</td>
				
			// 	<td width="10%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$dataparents[$i]["candidate_family_relation"].'
			// 	</td>

			// 	<td width="17%" height="35px" style="border: 0.1mm solid black;" align="left">
			// 	'.((isset($dataparents[$i]["candidate_family_rip"]) && $dataparents[$i]["candidate_family_rip"]=="Alive")?"":"<i>[RIP]</i>").' '.$dataparents[$i]["candidate_family_name"].'
			// 	</td>


			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" align="center">
			// 	'.$dataparents[$i]["candidate_family_birthplace"].' , '.((isset($dataparents[$i]["candidate_family_birthdate"]) && $dataparents[$i]["candidate_family_birthdate"]<>"")?reverseDate($dataparents[$i]["candidate_family_birthdate"]):"").'
			// 	</td>


			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$dataparents[$i]["candidate_family_lastedu"].'
			// 	</td>

			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$dataparents[$i]["candidate_family_lastjob"].'
			// 	</td>

			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$dataparents[$i]["candidate_family_company"].'
			// 	</td>
			// </tr>';
			// $ur++;
			// }

			$ur = 1;
			for ($i = 0; $i < 2; $i++) {
				if (isset($dataparents[$i])) {
					$html .= '
					<tr>
						<td width="3%" height="35px" style="border: 0.1mm solid black;">'.$ur.'</td>
						<td width="10%" height="35px" style="border: 0.1mm solid black;">'.$dataparents[$i]["candidate_family_relation"].'</td>
						<td width="17%" height="35px" style="border: 0.1mm solid black;" align="left">'.((isset($dataparents[$i]["candidate_family_rip"]) && $dataparents[$i]["candidate_family_rip"] == "Alive") ? "" : "<i>[RIP]</i>").' '.$dataparents[$i]["candidate_family_name"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;" align="center">'.$dataparents[$i]["candidate_family_birthplace"].' , '.((isset($dataparents[$i]["candidate_family_birthdate"]) && $dataparents[$i]["candidate_family_birthdate"] <> "") ? reverseDate($dataparents[$i]["candidate_family_birthdate"]) : "").'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$dataparents[$i]["candidate_family_lastedu"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$dataparents[$i]["candidate_family_lastjob"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$dataparents[$i]["candidate_family_company"].'</td>
					</tr>';
					$ur++;
				}
			}
			
			/* siblings */
			/* tambahkan diri sendiri ke array datasiblings */
			$jmlsiblings=count($datasiblings);
			$datasiblings[$jmlsiblings]["candidate_family_relation"]="Self";
			$datasiblings[$jmlsiblings]["candidate_family_name"]=$dataresume[0]["candidate_name"];
			$datasiblings[$jmlsiblings]["candidate_family_birthplace"]=$dataresume[0]["candidate_birthplace"];
			$datasiblings[$jmlsiblings]["candidate_family_birthdate"]=$dataresume[0]["candidate_birthdate"];
			$datasiblings[$jmlsiblings]["candidate_family_lastedu"]=$dataedu[0]["candidate_edu_degree"];
			$datasiblings[$jmlsiblings]["candidate_family_lastjob"]=$datajob[0]["candidate_jobexp_position"];
			$datasiblings[$jmlsiblings]["candidate_family_company"]=$datajob[0]["candidate_jobexp_company"];
			
			usort($datasiblings, 'date_compare');
			
			function myfunction($datasiblings, $field, $value)
			{
			   foreach($datasiblings as $key => $relasi)
			   {
				  if ( $relasi[$field] === $value )
					 return $key;
			   }
			   return false;
			}		

			$anakke=myfunction($datasiblings,"candidate_family_relation","Self");
			$anakke++;
			
			
			
			$html.='
			<tr>
				<td colspan="7" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;" >
					Saudara Kandung (termasuk diri sendiri) / <i>Brother and Sister (including yourself)</i><br>
					Anak ke '.$anakke.' dari '.count($datasiblings).' / <i>Number '.$anakke.' of '.count($datasiblings).'</i>
				</td>
			</tr>
			';
			


			// $ur=1;
			// for($i=0;$i<8;$i++) {
			// $html.='
			// <tr>
			// 	<td width="3%" height="35px" style="border: 0.1mm solid black;" >'.$ur.'</td>
				
			// 	<td width="10%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$datasiblings[$i]["candidate_family_relation"].'
			// 	</td>

			// 	<td width="17%" height="35px" style="border: 0.1mm solid black;" align="left">
			// 	'.((isset($datasiblings[$i]["candidate_family_rip"]) && $datasiblings[$i]["candidate_family_rip"]=="RIP")?"<i>[RIP]</i>":"").' '.$datasiblings[$i]["candidate_family_name"].'
			// 	</td>


			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" align="center">
			// 	'.$datasiblings[$i]["candidate_family_birthplace"].' , '.((isset($datasiblings[$i]["candidate_family_birthdate"]) && $datasiblings[$i]["candidate_family_birthdate"]<>"")?reverseDate($datasiblings[$i]["candidate_family_birthdate"]):"").'
			// 	</td>


			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$datasiblings[$i]["candidate_family_lastedu"].'
			// 	</td>

			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$datasiblings[$i]["candidate_family_lastjob"].'
			// 	</td>

			// 	<td width="15%" height="35px" style="border: 0.1mm solid black;" >
			// 	'.$datasiblings[$i]["candidate_family_company"].'
			// 	</td>
			// </tr>';
			// $ur++;
			// }

			$ur = 1;
			for ($i = 0; $i < 8; $i++) {
				if (isset($datasiblings[$i])) {
					$html .= '
					<tr>
						<td width="3%" height="35px" style="border: 0.1mm solid black;">'.$ur.'</td>
						<td width="10%" height="35px" style="border: 0.1mm solid black;">'.$datasiblings[$i]["candidate_family_relation"].'</td>
						<td width="17%" height="35px" style="border: 0.1mm solid black;" align="left">'.((isset($datasiblings[$i]["candidate_family_rip"]) && $datasiblings[$i]["candidate_family_rip"] == "RIP") ? "<i>[RIP]</i>" : "").' '.$datasiblings[$i]["candidate_family_name"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;" align="center">'.$datasiblings[$i]["candidate_family_birthplace"].' , '.((isset($datasiblings[$i]["candidate_family_birthdate"]) && $datasiblings[$i]["candidate_family_birthdate"] <> "") ? reverseDate($datasiblings[$i]["candidate_family_birthdate"]) : "").'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$datasiblings[$i]["candidate_family_lastedu"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$datasiblings[$i]["candidate_family_lastjob"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$datasiblings[$i]["candidate_family_company"].'</td>
					</tr>';
					$ur++;
				}
			}

			
			/* part spouse */
			for ($i = 0; $i < 1; $i++) {
				if (isset($dataspouse[$i])) {
					$html .= '
					<tr>
						<td width="3%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;"></td>
						<td width="10%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;">'.$dataspouse[$i]["candidate_family_relation"].'</td>
						<td width="17%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;" align="left">'.((isset($dataspouse[$i]["candidate_family_rip"]) && $dataspouse[$i]["candidate_family_rip"] == "RIP") ? "<i>[RIP]</i>" : "").' '.$dataspouse[$i]["candidate_family_name"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;" align="center">'.$dataspouse[$i]["candidate_family_birthplace"].' , '.((isset($dataspouse[$i]["candidate_family_birthdate"]) && $dataspouse[$i]["candidate_family_birthdate"] <> "") ? reverseDate($dataspouse[$i]["candidate_family_birthdate"]) : "").'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;">'.$dataspouse[$i]["candidate_family_lastedu"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;">'.$dataspouse[$i]["candidate_family_lastjob"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;">'.$dataspouse[$i]["candidate_family_company"].'</td>
					</tr>';
				}
			}		

			/* children */
			$html.='
			<tr>
				<td colspan="7" height="35px" style="border: 0.1mm solid black; background-color:#eeeeee;" >Anak / <i>Children</i></td>
			</tr>
			';
			
			
				usort($datachildren, 'date_compare');


				$ur = 1;
				for ($i = 0; $i < count($datachildren); $i++) {
					$html .= '
					<tr>
						<td width="3%" height="35px" style="border: 0.1mm solid black;">'.$ur.'</td>
						<td width="10%" height="35px" style="border: 0.1mm solid black;">'.$datachildren[$i]["candidate_family_relation"].'</td>
						<td width="17%" height="35px" style="border: 0.1mm solid black;" align="left">'.((isset($datachildren[$i]["candidate_family_rip"]) && $datachildren[$i]["candidate_family_rip"] == "RIP") ? "<i>[RIP]</i>" : "").' '.$datachildren[$i]["candidate_family_name"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;" align="center">'.$datachildren[$i]["candidate_family_birthplace"].' , '.((isset($datachildren[$i]["candidate_family_birthdate"]) && $datachildren[$i]["candidate_family_birthdate"] <> "") ? reverseDate($datachildren[$i]["candidate_family_birthdate"]) : "").'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$datachildren[$i]["candidate_family_lastedu"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$datachildren[$i]["candidate_family_lastjob"].'</td>
						<td width="15%" height="35px" style="border: 0.1mm solid black;">'.$datachildren[$i]["candidate_family_company"].'</td>
					</tr>';
					$ur++;
				}
				
				$html .= '</table>';
				
			
			/* hobi */
			$html .='
			<div style="float:left;width:200px;"> 
				<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>HOBI / MINAT</b></div>
				<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Hobbies / Interest</i></div>
				<table width="200px" style="font-family: serif;font-size:10px;" cellpadding="5" cellspacing="0">
					<tr>
						<td width="100%" height="91px" style="border: 0.1mm solid black;" valign="top">'.(($dataresume[0]["candidate_hobby"]<>"")?clean_show($dataresume[0]["candidate_hobby"]):"").'</td>
					</tr>
				</table>			
			</div>
			
			';
			
			/* organisasi */
			$html .='
			<div style="float:left;width:30px;">&nbsp;</div>
			<div style="float:left;width:470px;"> 
				<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>KEANGGOTAAN BIDANG PROFESI DAN SOSIAL</b></div>
				<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Membership of professional or social club</i></div>
				<table width="470px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>

					<th width="60%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
					Nama Kelompok <br /><i>Club\'s Name</i>
					</th>
					<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
					Period <br /><i>Periode</i>
					</th>
					<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
					Jabatan <br /><i>Position</i>
					</th>

				</tr>
				';
				for ($i = 0; $i < count($dataorg); $i++) {
					$html .= '
					<tr>
						<td width="60%" height="20px" style="border: 0.1mm solid black;">
							'.substr($dataorg[$i]["candidate_organization_name"], 0, 50).'
						</td>
						<td width="20%" height="20px" style="border: 0.1mm solid black;">
							'.$dataorg[$i]["candidate_organization_start"].' - '.$dataorg[$i]["candidate_organization_end"].'
						</td>
						<td width="20%" height="20px" style="border: 0.1mm solid black;">
							'.$dataorg[$i]["candidate_organization_role"].'
						</td>
					</tr>';
				}
				
				$html .= '</table></div><div style="clear:both;"></div>';
				
			
				/* questionaire chapter 1 */
				$html .='
				<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>BERI TANDA SILANG (X) PADA KOTAK YANG DIPILIH</b></div>
				<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Give cross (X) in the chosen box</i></div>

				<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<th width="7%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >No.</th>
							<th width="59%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							APAKAH ANDA PRIBADI : <br /><i>Do You Personally :</i>
							</th>
							<th width="7%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							YA <br /><i>Yes</i>
							</th>
							<th width="7%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							TIDAK <br /><i>No</i>
							</th>
							<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							PENJELASAN <br /><i>Remarks</i>
							</th>
						</tr>
					';
								
								$urut=1;
								for($q=0;$q<count($dataquestion);$q++) {
									if($dataquestion[$q]["question_chapter"]=="1") {
									$html .= '
									<tr>
										<td height="20px" align="center" style="border: 0.1mm solid black; background-color:#ffffff;">'.$urut.'</td>
										<td height="20px" style="border: 0.1mm solid black; background-color:#ffffff;">'.clean_view($dataquestion[$q]["question_deskripsi"]).'<br><i>'.clean_view($dataquestion[$q]["question_desc"]).'</i></td>
										';				
										if($dataquestion[$q]["question_type"]=="yn_desc") {
										$html .= '
												<td height="20px" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="y")?'Yes':"").'</td>				
												<td height="20px" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="n")?'No':"").'</td>
												<td height="20px" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"").'</td>
											';
											}
										else if($dataquestion[$q]["question_type"]=="txt_area" || $dataquestion[$q]["question_type"]=="txt_box_int") {
										$html .= '
												<td height="20px" colspan="3" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"").'</td>';
											}
										else if($dataquestion[$q]["question_type"]=="txt_box_cur") {
										$html .= '
												<td height="20px" colspan="3" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?showRupiah($dataquestion[$q]["answer_desc"]):"").'</td>';
											}
											
									$html .= '</tr>';
										
									$urut++;
									}
								}
								
				$html .= '</table>';
								
			
			
			/* working experiences */
			$html .='
				<pagebreak />
				<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>RIWAYAT PEKERJAAN (Tuliskan riwayat pekerjaan Anda dengan lengkap dan benar, dimulai dari pekerjaan / jabatan terakhir)</b></div>
				<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Employement History (Please detail your employment history, starting with last position</i></div>
				';

			$html .='
			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
				<tr>

					<th width="50%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
					IDENTITAS PERUSAHAAN <br /><i>Company Identity</i>
					</th>
					<th width="10%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" colspan="2">
					MASA KERJA <br /><i>Service Year</i>
					</th>
					<th width="40%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" colspan="2">
					KETERANGAN <br /><i>Remarks</i>
					</th>

				</tr>
			';
			//print_r($datajob);exit;
			
			
			// for($i=0;$i<3;$i++) {
			// 	$alamat=str_replace("<br>", ", ", $datajob[$i]["candidate_jobexp_address"]);
			// 	$alamat=substr($alamat,0,100);
			// 	//echo "alamat ".$alamat[$i]."<br>";
			// 	$html .='
			// 	<tr>
			// 		<td width="50%" rowspan="2" height="220px" style="border: 0.1mm solid black;" valign="top"><b>Nama :</b> '.$datajob[$i]["candidate_jobexp_company"].'<br />
			// 		<b>Alamat :</b> '.$alamat.'<br />
			// 		<b>Telepon :</b> '.$datajob[$i]["candidate_jobexp_phone"].'<br />
			// 		<b>Jenis usaha :</b> '.$datajob[$i]["candidate_jobexp_lob"].'<br />
			// 		<b>Atasan:</b> '.$datajob[$i]["candidate_jobexp_spvname"].' <i>('.$datajob[$i]["candidate_jobexp_spvposition"].')</i><br>
			// 		<b>Bawahan:</b> '.$datajob[$i]["candidate_jobexp_subposition"].' <i>('.$datajob[$i]["candidate_jobexp_subnumber"].' orang)</i><br><br>
			// 		<b>Deskripsi Pekerjaan :</b>
			// 		<br>'.substr($datajob[$i]["candidate_jobexp_desc"],0,250).'

			// 		</td>
			// 		<td width="5%" rowspan="2" height="25px" style="border: 0.1mm solid black;" valign="top">
			// 		'.((isset($datajob[$i]["candidate_jobexp_start"]) && $datajob[$i]["candidate_jobexp_start"]<>"" )?date("M Y", strtotime($datajob[$i]["candidate_jobexp_start"])):"").'
			// 		</td>
			// 		<td width="5%" rowspan="2" height="25px" style="border: 0.1mm solid black;" valign="top">
			// 		'.((isset($datajob[$i]["candidate_jobexp_end"]) && $datajob[$i]["candidate_jobexp_end"]<>"" )?date("M Y", strtotime($datajob[$i]["candidate_jobexp_end"])):"").'
			// 		</td>
			// 		<td width="15%" height="110px" style="border: 0.1mm solid black;" valign="top">
			// 		<b>JABATAN</b><br />
			// 		'.$datajob[$i]["candidate_jobexp_position"].'

			// 		</td>
			// 		<td width="25%" rowspan="2" height="220px" style="border: 0.1mm solid black;" valign="top">
			// 		<b>Alasan Pengunduran diri :</b>
			// 		<br />'.substr($datajob[$i]["candidate_jobexp_leaving"],0,250).'

			// 		</td>

			// 	</tr>
			// 	<tr>
			// 		<td height="110px" style="border: 0.1mm solid black;" valign="top">
			// 		<b>GAJI BERSIH /BLN</b><br /><br />
			// 		'.((isset($datajob[$i]["candidate_jobexp_salary"]) && $datajob[$i]["candidate_jobexp_salary"]<>"" && $datajob[$i]["candidate_jobexp_salary"]>0)?showRupiah($datajob[$i]["candidate_jobexp_salary"]):"<i>no data</i>" ).'
			// 		<br /><br />
			// 		<b>Jumlah Karyawan :</b>
			// 		<br />'.$datajob[$i]["candidate_jobexp_numemployee"].'
			// 		</td>
			// 	</tr>
			// 	';
			// }

			for ($i = 0; $i < count($datajob); $i++) {
				if ($i < 2) {
					$alamat = str_replace("<br>", ", ", $datajob[$i]["candidate_jobexp_address"]);
					$alamat = substr($alamat, 0, 100);
					$html .= '
						<tr>
							<td width="50%" rowspan="2" height="220px" style="border: 0.1mm solid black;" valign="top">
								<b>Nama :</b> '.$datajob[$i]["candidate_jobexp_company"].'<br />
								<b>Alamat :</b> '.$alamat.'<br />
								<b>Telepon :</b> '.$datajob[$i]["candidate_jobexp_phone"].'<br />
								<b>Jenis usaha :</b> '.$datajob[$i]["candidate_jobexp_lob"].'<br />
								<b>Atasan:</b> '.$datajob[$i]["candidate_jobexp_spvname"].' <i>('.$datajob[$i]["candidate_jobexp_spvposition"].')</i><br>
								<b>Bawahan:</b> '.$datajob[$i]["candidate_jobexp_subposition"].' <i>('.$datajob[$i]["candidate_jobexp_subnumber"].' orang)</i><br><br>
								<b>Deskripsi Pekerjaan :</b><br>'.substr($datajob[$i]["candidate_jobexp_desc"], 0, 250).'
							</td>
							<td width="5%" rowspan="2" height="25px" style="border: 0.1mm solid black;" valign="top">
								'.((isset($datajob[$i]["candidate_jobexp_start"]) && $datajob[$i]["candidate_jobexp_start"] <> "") ? date("M Y", strtotime($datajob[$i]["candidate_jobexp_start"])) : "").'
							</td>
							<td width="5%" rowspan="2" height="25px" style="border: 0.1mm solid black;" valign="top">
								'.((isset($datajob[$i]["candidate_jobexp_end"]) && $datajob[$i]["candidate_jobexp_end"] <> "") ? date("M Y", strtotime($datajob[$i]["candidate_jobexp_end"])) : "").'
							</td>
							<td width="15%" height="110px" style="border: 0.1mm solid black;" valign="top">
								<b>JABATAN</b><br />
								'.$datajob[$i]["candidate_jobexp_position"].'
							</td>
							<td width="25%" rowspan="2" height="220px" style="border: 0.1mm solid black;" valign="top">
								<b>Alasan Pengunduran diri :</b><br />'.substr($datajob[$i]["candidate_jobexp_leaving"], 0, 250).'
							</td>
						</tr>
						<tr>
							<td height="110px" style="border: 0.1mm solid black;" valign="top">
								<b>GAJI BERSIH /BLN</b><br /><br />
								'.((isset($datajob[$i]["candidate_jobexp_salary"]) && $datajob[$i]["candidate_jobexp_salary"] <> "" && $datajob[$i]["candidate_jobexp_salary"] > 0) ? showRupiah($datajob[$i]["candidate_jobexp_salary"]) : "<i>no data</i>").'
								<br /><br />
								<b>Jumlah Karyawan :</b><br />'.$datajob[$i]["candidate_jobexp_numemployee"].'
							</td>
						</tr>
					';
				}
			}
			
			
			
			$html .='</table>';
			
			
			
			/* struktur organisasi */
			$html .='<br>
			<div style="font-family: serif;font-size:11px;margin-top:15px;margin-bottom:0px;padding-bottom:0px; line-height:100%;"><b>GAMBARKAN STRUKTUR ORGANISASI SEDERHANA YANG MEMPERLIHATKAN POSISI ANDA SAAT INI/ YANG TERAKHIR</b></div>
			<div style="font-family: serif;font-size:10px;margin-bottom:5px;margin-top:0px;padding-top:0px; line-height:100%;"><i>Please draw a simple chart showing the post of your present appointment in the organization</i></div>

			<p><div width="800px" height:"250px;" style="border:1px solid #333333; height:250px;">&nbsp;</div></p>
			<pagebreak />
			';
			
			
			
			/* questionaire */
				$html .='

				<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<th width="7%" height="60px" style="border: 0.1mm solid black;background-color:#cecece;" >No.</th>
							<th width="59%" height="60px" style="border: 0.1mm solid black;background-color:#cecece;" >
							BERI TANDA SILANG (X) PADA KOTAK YANG SESUAI : <br /><i>Give cross mark (x) in the correct response box</i>
							</th>
							<th width="7%" height="60px" style="border: 0.1mm solid black;background-color:#cecece;" >
							YA <br /><i>Yes</i>
							</th>
							<th width="7%" height="60px" style="border: 0.1mm solid black;background-color:#cecece;" >
							TIDAK <br /><i>No</i>
							</th>
							<th width="20%" height="60px" style="border: 0.1mm solid black;background-color:#cecece;" >
							PENJELASAN <br /><i>Remarks</i>
							</th>
						</tr>
					';
								
								$urut=1;
								for($q=0;$q<count($dataquestion);$q++) {
									if($dataquestion[$q]["question_chapter"]=="2") {
									$html .= '
									<tr>
										<td align="center" style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.$urut.'</td>
										<td style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.clean_view($dataquestion[$q]["question_deskripsi"]).'<br><i>'.clean_view($dataquestion[$q]["question_desc"]).'</i></td>
										';				
										if($dataquestion[$q]["question_type"]=="yn_desc") {
										$html .= '
												<td style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="y")?'Yes':"").'</td>				
												<td style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="n")?'No':"").'</td>
												<td style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?substr($dataquestion[$q]["answer_desc"],0,50):"").'</td>
											';
											}
										else if($dataquestion[$q]["question_type"]=="txt_area" || $dataquestion[$q]["question_type"]=="txt_box_int") {
										$html .= '
												<td colspan="3" style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?substr($dataquestion[$q]["answer_desc"],0,50):"").'</td>';
											}
										else if($dataquestion[$q]["question_type"]=="txt_box_cur") {
										$html .= '
												<td colspan="3" style="border: 0.1mm solid black; background-color:#ffffff;" height="30px">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?showRupiah($dataquestion[$q]["answer_desc"]):"").'</td>';
											}
											
									$html .= '</tr>';
										
									$urut++;
									}
								}
								
				$html .= '</table>';

			
			/* pernyataan */
			$html.='
			<table width="800px" style="font-family: serif;font-size:10px;" cellpadding="10" cellspacing="0">
				<tr>
					 <td style="border: 0.1mm solid black; line-height:170%" valign="top" height="250px;">
					DENGAN INI SAYA MENYATAKAN BAHWA KETERANGAN YANG SAYA BERIKAN DI ATAS ADALAH BENAR.
					APABILA DI KEMUDIAN HARI &nbsp;DITEMUAKN KETIDAKSESUAIAN, SAYA BERTANGGUNG JAWAB PENUH ATAS SEGALA AKIBATNYA<br /><br />
					&nbsp;<i>I hereby verify that the informations given above is true. And if under any circumstances any misrepresentation or omission of information 
					is &nbsp;found. I understand and that I shall fully be held responsible.</i>
					<br /><br /><br /><br />
					'.date("d-M-Y").'
					<br /><br /><br /><br /><br />
					( '.$dataresume[0]["candidate_name"].' )
					</td>
				</tr>
			</table>
			';
			
			/* end of creating html table */
			$selesai="selesai creating table html karyawan ".$_POST["candidate_id"]." : ".date("Y-m-d  H:i:s");
			write_errorlogs($selesai,0);
			
			//echo $html;
			//exit;	
			
			/* mulai convert ke pdf */
			
			$mulainya="mulai convert ke pdf karyawan ".$_POST["candidate_id"]." : ".date("Y-m-d  H:i:s");
			write_errorlogs($mulainya,0);
			
			
			$mpdf->WriteHTML($html);

			$mpdf->Output(str_replace(" ","_",$dataresume[0]["candidate_name"]).'_FullResume.pdf','D');
			
			/* end of convert ke pdf */
			$selesai="selesai convert ke pdf karyawan ".$_POST["candidate_id"]." : ".date("Y-m-d  H:i:s");
			write_errorlogs($selesai,0);
			
			// echo $html;
			// exit;			
			
		}
		
	}

	
	function getDocFileDownload($dat, $type) {
		$datafile=array();
		for($i=0;$i<count($dat);$i++) {
			if($dat[$i]["candidate_file_type"]==$type) {
				$datafile["id"]=$dat[$i]["candidate_file_id"];
				$datafile["name"]=$dat[$i]["candidate_file_name"];			
				return $datafile;
				break;
			}
		}
	}	

	function adm_sendCvToUser() {
		//echo $_POST["send_for_screening"];
		//print_r($_POST);
		//exit;
		//get proposed candidate whose cv's will be sent to the user
		
		$send_for_screening=(isset($_POST["send_for_screening"]) && $_POST["send_for_screening"]<>"")?explode("|",$_POST["send_for_screening"]):"";
		$job_vacancy_id=(isset($_POST["job_vacancy_id"]) && $_POST["job_vacancy_id"]<>"")?$_POST["job_vacancy_id"]:"";
		
		$datavacancy=admin_getJobAdv($job_vacancy_id,"detail");
		
		//print_r($send_for_screening);
		if(is_array($send_for_screening)) {
			//generate cv untuk masing-masing kandidate, kemudian kirimkan ke user
			$failedgen=0;
			$idfailed="";
			$successgen=0;
			$idsuccess="";
			for($i=0;$i<count($send_for_screening);$i++) {
				if(generate_fullResume($send_for_screening[$i])) {
					$successgen++;
					$idsuccess.=$send_for_screening[$i]."|";

				}	
				else {
					$failedgen++;
					$idfailed.=$send_for_screening[$i]."|";
				}
			}
			
			//generate excel file
			require_once(_INCLUDEDIRECTORY."/excel/PHPExcel.php");


			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();

			$objPHPExcel->getProperties()->setCreator("MPPA Recruitment")
										 ->setLastModifiedBy("MPPA Recruitment")
										 ->setTitle("Titlenya")
										 ->setSubject("Subjectnya")
										 ->setDescription("Generate by system.")
										 ->setKeywords("proposed candidate")
										 ->setCategory("User Screening");


			// Add some data
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'No.')
						->setCellValue('B1', 'Vacant Position Applied')
						->setCellValue('C1', 'Vacancy ID')
						->setCellValue('D1', 'Job Title')
						->setCellValue('E1', 'ID Candidate')
						->setCellValue('F1', 'Name of Candidate')			
						->setCellValue('G1', 'Pass to the next step? (Y/N)');

			$rows=1;	
			$no=1;	
			

			for($i=0;$i<count($send_for_screening);$i++) {
				$dataresume[$i]=admin_getDetailCandidate($send_for_screening[$i]);
				
				$rows++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rows, $no);	
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rows)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rows, $datavacancy[0]["job_vacancy_name"]);	
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rows)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rows, $datavacancy[0]["job_vacancy_id"]);	
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rows)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rows, $datavacancy[0]["job_vacancy_titlename"]);	
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rows)->getAlignment()->setWrapText(true);

				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rows, $dataresume[$i][0]["candidate_id"]);	
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rows)->getAlignment()->setWrapText(true);
				
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rows, $dataresume[$i][0]["candidate_name"]);	
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rows)->getAlignment()->setWrapText(true);
				$no++;
			}
			foreach(range('A','G') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}

			$styleArray = array(
					  'borders' => array(
						  'allborders' => array(
							  'style' => PHPExcel_Style_Border::BORDER_THIN
						  )
					  )
				  );

			$objPHPExcel->getActiveSheet()->getStyle(
				'A1:' . 
				$objPHPExcel->getActiveSheet()->getHighestColumn() . 
				$objPHPExcel->getActiveSheet()->getHighestRow()
			)->applyFromArray($styleArray);	  
				  
					
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Proposed Candidate');


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);


			// Save Excel 95 file
			$callStartTime = microtime(true);

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save(str_replace(__FILE__,_DIRFILES."/cand_cv_to_user/Candidate_".$datavacancy[0]["job_vacancy_name"]."_".$_POST["job_vacancy_id"].".xls",__FILE__));
			$callEndTime = microtime(true);
			$callTime = $callEndTime - $callStartTime;
			
			
			
			
			//end of generate excel file
		
			
			/*echo $successgen."<br>";
			echo $failedgen."<br>";
			exit;*/
			
			if($successgen>0) {
				header("location: "._PATHURL."/index.php?mod=admsendtouser&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&send_for_screening=".coded($idsuccess)."&mess=".coded("Please send generated CV to the user."));
				exit;
			}
			else {
				header("location: "._PATHURL."/index.php?mod=listperstage&job_vacancy_id=".coded($_POST["job_vacancy_id"])."&candidate_apply_stage=".coded($_POST["candidate_apply_stage"])."&mess=".coded("Generate cv failed."));
				exit;
			}
		}
	}
	
	
	function generate_fullResume($send_for_screening) {
				$datacity=getCity();
					$datalob=getDataLob();
					
					$dataresume=admin_getDetailCandidate($send_for_screening);
					
					$dataedu=admin_getDataEdu($send_for_screening);
					$datajob=admin_getDataJob($send_for_screening);		
					$datatraining=admin_getDataTraining($send_for_screening);
					$dataorg=admin_getDataOrg($send_for_screening);
					$dataskills=admin_getDataSkills($send_for_screening);
					$datalang=admin_getDataLanguage($send_for_screening);
					$datafam=admin_getDataFam($send_for_screening);
					
					if(count($dataedu)>0) $dataedu=clean_show($dataedu);
					if(count($datajob)>0) $datajob=clean_show($datajob);
					if(count($datatraining)>0) $datatraining=clean_show($datatraining);
					if(count($dataorg)>0) $dataorg=clean_show($dataorg);
					if(count($dataskills)>0) $dataskills=clean_show($dataskills);
					if(count($datalang)>0) $datalang=clean_show($datalang);
					if(count($datafam)>0) $datafam=clean_show($datafam);
					
					$dataapply=admin_getDataApply("open_project",$send_for_screening);

					$datachapter=getDataChapter();
					//print_r($datachapter);

					$dataquestion=getDataQuestion();
					//print_r($dataquestion);

					$dataanswer=admin_getDataAnswer($send_for_screening);
					//print_r($dataanswer);

					for($q=0;$q<count($dataquestion);$q++) {
						for($a=0;$a<count($dataanswer);$a++) {
							if($dataanswer[$a]["question_id"]==$dataquestion[$q]["question_id"]) {
								$dataquestion[$q]["answer_yn"]=$dataanswer[$a]["answer_yn"];
								$dataquestion[$q]["answer_desc"]=$dataanswer[$a]["answer_desc"];
								$dataquestion[$q]["answer_id"]=$dataanswer[$a]["answer_id"];
							}
						}
					}



					
					$datadoc=admin_getDataDoc($send_for_screening);
					$dataothers=admin_getDataOthers($send_for_screening);


					$data=array();
					for($i=0;$i<count($datadoc);$i++) {
					$data[$i]["candidate_file_id"]=(isset($_SESSION["session"]["candidate_file_id"][$i]) && $_SESSION["session"]["candidate_file_id"][$i]<>"")?$_SESSION["session"]["candidate_file_id"][$i]:((isset($datadoc[$i]["candidate_file_id"]))?$datadoc[$i]["candidate_file_id"]:"");
					$data[$i]["candidate_file_name"]=(isset($_SESSION["session"]["candidate_file_name"][$i]) && $_SESSION["session"]["candidate_file_name"][$i]<>"")?$_SESSION["session"]["candidate_file_name"][$i]:((isset($datadoc[$i]["candidate_file_name"]))?$datadoc[$i]["candidate_file_name"]:"");
					$data[$i]["candidate_file_type"]=(isset($_SESSION["session"]["candidate_file_type"][$i]) && $_SESSION["session"]["candidate_file_type"][$i]<>"")?$_SESSION["session"]["candidate_file_type"][$i]:((isset($datadoc[$i]["candidate_file_type"]))?$datadoc[$i]["candidate_file_type"]:"");
					$data[$i]["candidate_file_notes"]=(isset($_SESSION["session"]["candidate_file_notes"][$i]) && $_SESSION["session"]["candidate_file_notes"][$i]<>"")?$_SESSION["session"]["candidate_file_notes"][$i]:((isset($datadoc[$i]["candidate_file_notes"]))?$datadoc[$i]["candidate_file_notes"]:"");
					}

					$dataphoto=getDocFileDownload($data,"passphoto");
					
					require_once("./includes/mpdf/vendor/src/Mpdf.php");
					$mpdf = new Mpdf\Mpdf([
						'mode' => 'win-1252',
						'format' => 'A4',
						'default_font_size' => 0,
						'default_font' => '',
						'margin_left' => 10,
						'margin_right' => 10,
						'margin_top' => 10,
						'margin_bottom' => 10,
						'margin_header' => 0,
						'margin_footer' => 0,
						'orientation' => 'P',
						'useOnlyCoreFonts' => true
					]);
		
					
					//$mpdf=new mPDF('win-1252','A4','','',20,15,10,25,10,10); 
					// $mpdf->useOnlyCoreFonts = true;    // false is default
					$mpdf->SetProtection(array('print'));
					$mpdf->SetTitle("Data Pelamar");
					$mpdf->SetAuthor("Hypermart");
					$mpdf->SetWatermarkText("Hypermart");
					$mpdf->showWatermarkText = false;
					$mpdf->watermark_font = 'DejaVuSansCondensed';
					$mpdf->watermarkTextAlpha = 0.1;
					$mpdf->SetDisplayMode('fullpage');
					
					
					// $mpdf=new mPDF('win-1252','A4','','',20,15,10,25,10,10); 
					// $mpdf->useOnlyCoreFonts = true;    // false is default
					// $mpdf->SetProtection(array('print'));
					// $mpdf->SetTitle("Data Pelamar");
					// $mpdf->SetAuthor("Hypermart");
					// $mpdf->SetWatermarkText("Hypermart");
					// $mpdf->showWatermarkText = false;
					// $mpdf->watermark_font = 'DejaVuSansCondensed';
					// $mpdf->watermarkTextAlpha = 0.1;
					// $mpdf->SetDisplayMode('fullpage');

					
					$html = '
					<html>
					<head>
					<style>
					body {font-family: sans-serif;
						font-size: 10pt;
					}
					p {    margin: 0pt;
					}
					
					.fontawesome { font-family: fontawesome; }
					</style>
					
					 <link rel="stylesheet" type="text/css" href="css/print.css" />
					</head>
					<body>

					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="35%" height="105" align="left" valign="top">
						<table width="180px" cellpadding="3" cellspacing="0" >
						  <tr>
							<td style="border: 0.1px solid black;padding:5px;" valign="top">
							
							<span style="color:black;font-size:9px;">
							<u>POSISI YANG DILAMAR</u><br />
							Post of which you are applying<br /><br />';
						
						$urut=1;
						for($i=0;$i<count($dataapply);$i++) {
						$html .= $urut.". ".$dataapply[$i]["job_vacancy_name"].'<br />';
						$urut++;
						}
						
						$html .= '
							</span></td>
						  </tr>
						</table>
						
						<table width="180px" cellpadding="3" cellspacing="0" >
							<tr>
								<td style="border: 0.1px solid black;padding:5px;" valign="top">
							
							<span style="color:black;font-size:9px;">
							<u>GAJI YANG DIHARAPKAN</u><br />
							Expected Salary<br /><br />';
							$html .= (isset($dataresume[0]["candidate_expected_salary"]) && $dataresume[0]["candidate_expected_salary"]<>"" && $dataresume[0]["candidate_expected_salary"]>0)?showRupiah($dataresume[0]["candidate_expected_salary"]):"";
							$html .='
							</td>
							</tr>
						</table>
						
						</td>
						<td width="40%" align="center" height="45">
						<span style="color:black;font-size:14px;"><u><b>FORMULIR LAMARAN KERJA</b></u></span><br />
						<span style="color:black;font-size:14px;"><b><i>EMPLOYMENT APPLICATION FORM</i></b></span>
						</td>
						<td width="25%" align="right">';
						
						if(isset($dataphoto["id"]) && isset($dataphoto["name"]) && $dataphoto["name"]<>"") {
							$html .= '<img src="'._CANDFILES.'/cand_photo/'.$dataphoto["name"].'" height="150px" style="border: 3px solid #efefef;">';
						}
						else {
							$html .= '<img src="'._IMAGEWEBPATH.'/no_image.png" width="150px">';
						}
						
						$html .='
						</td>
					  </tr>
					  <tr>
						<td height="14" colspan="3"><hr /></td>
					  </tr>
					  
					</table>


					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="300px" height="20px" style="border: 0.1mm solid black;" align="left">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="100px" height="30">NAMA LENGKAP<br />Full name</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_name"].'</td>
									</tr>
								</table>
							</td>
							<td width="200px" style="border: 0.1mm solid black;" align="left">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="90px" height="30">JENIS KELAMIN<br />Gender</td>
										<td width="10px">:</td>
										<td>
										';
											if($dataresume[0]["candidate_gender"]=='male')
											{$html.='<input type="checkbox" name="kelamin" value="laki" checked="checked"/> Lk / Male
											<br /><input type="checkbox" name="kelamin" value="perempuan" /> Pr / Female';}
											else
											if($dataresume[0]["candidate_gender"]=='female')
											{$html.='<input type="checkbox" name="kelamin" value="laki" /> Lk / Male
											<br /><input type="checkbox" name="kelamin" value="perempuan" checked="checked"/> Pr / Female';}
						
										$html .=' </td>
									</tr>
								</table>
							</td>
							<td style="border: 0.1mm solid black;" align="left">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="50px" height="30">AGAMA<br />Religion</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_religion"].' </td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
					<tr>
						<td width="170px" height="20px" style="border: 0.1mm solid black;" align="left">
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100px" height="20">TANGGAL LAHIR<br />Date of birth</td>
									<td width="10px">:</td>
									<td>'.reverseDate($dataresume[0]["candidate_birthdate"]).'</td>
								</tr>
							</table>
						</td>
						<td width="250px" style="border: 0.1mm solid black;" align="left">
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td width="80px" height="20">TEMPAT LAHIR<br />Place of birth</td>
									<td width="10px">:</td>
									<td>'.$dataresume[0]["candidate_birthplace"].' </td>
								</tr>
							</table>
						</td>
						<td style="border: 0.1mm solid black;" align="left">
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td width="110px" height="20">KEWARGANEGARAAN<br />Nationality</td>
									<td width="10px">:</td>
									<td>'.strtoupper($dataresume[0]["candidate_nationality"]).' '.$dataresume[0]["candidate_country"].'</td>
								</tr>
							</table>
						</td>
					</tr>
					</table>

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="400px" height="20px" style="border: 0.1mm solid black;">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="90px" height="20">TINGGI BADAN<br />Height</td>
										<td width="10px">:</td>
										<td width="100px">'.$dataresume[0]["candidate_bodyheight"].' Cm</td>
										<td width="90px" height="20">BERAT BADAN<br />Weight</td>
										<td width="10px">:</td>
										<td width="60px">'.$dataresume[0]["candidate_bodyweight"].' Kg</td>
									</tr>
								</table>			  
							</td>
							<td height="20px" style="border: 0.1mm solid black;">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="120px" height="20">GOLONGAN DARAH<br />Blood type</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_bloodtype"].'</td>
									</tr>
								</table>
							</td>
							
						</tr>
					</table>

					
					<table width="700px" style="font-family: serif;font-size:10px; border: 0.1mm solid black;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="350px" style="border: 0.1mm solid black;">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="80px" height="20">No. KTP<br />IDs Number</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_idcard"].' </td>
									</tr>
								</table>
							</td>
							<td style="border: 0.1mm solid black;">
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="150px" height="20">No. SIM<br />Driver License Number</td>
										<td>A : '.$dataresume[0]["candidate_sim_a"].'<br />C : '.$dataresume[0]["candidate_sim_c"].'</td>
									</tr>
								</table>
							</td>				
						</tr>
					</table>
					
					
					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="270px" height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="40px" height="20">SurEl<br />E-mail</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_email"].'</td>
									</tr>
								</table>
							</td>
							<td width="190px" height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="80px" height="20">STATUS SIPIL<br />Civil</td>
										<td width="10px">:</td>								
										<td>'.$dataresume[0]["candidate_marital"].'</td>
									</tr>
								</table>
							</td>
							<td height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="30px" height="20">Suku<br />Race</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_race"].'</td>
									</tr>
								</table>
							</td>
							
							
						</tr>
					</table>

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="70%" height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="45%" height="20">ALAMAT SEKARANG :<br />Current Address</td>
										<td width="55%">'.(($dataresume[0]["candidate_c_address"]<>"")?clean_show($dataresume[0]["candidate_c_address"]):"").' - '.$dataresume[0]["candidate_c_city"].' - '.$dataresume[0]["candidate_c_postcode"].'</td>
									</tr>
								</table>
							</td>
							<td width="30%" height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="45%" height="20">HANDPHONE : <br />Mobile</td>
										<td width="55%"><i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_hp1"].(($dataresume[0]["candidate_hp2"]<>"")?"<br><i class=\"fontawesome fa fa-phone\">&#xf095;</i> ".$dataresume[0]["candidate_hp2"]:"").'</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="70%" height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="55%" height="20">ALAMAT TETAP (Sesuai KTP) :<br />Permanent Address</td>
										<td width="45%">'.(($dataresume[0]["candidate_p_address"]<>"")?clean_show($dataresume[0]["candidate_p_address"]):"").' - '.$dataresume[0]["candidate_p_city"].' - '.$dataresume[0]["candidate_p_postcode"].'</td>
									</tr>
								</table>
							</td>
							<td width="30%" height="20px" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="55%" height="20">TELEPON :<br />Telephone</td>
										<td width="45%">'.$dataresume[0]["candidate_phone"].'</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>


					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<td width="100%" style="border: 0.1mm solid black;" >
								<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td width="130px" height="20">KONTAK DARURAT 1<br />Emergency Contact 1</td>
										<td width="10px">:</td>
										<td width="200px">'.$dataresume[0]["candidate_cp_name1"].' - '.$dataresume[0]["candidate_cp_relation1"].'<br><i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_cp_phone1"].'</td>
										<td width="130px" height="20">KONTAK DARURAT 2:<br />Emergency Contact 1</td>
										<td width="10px">:</td>
										<td>'.$dataresume[0]["candidate_cp_name2"].' - '.$dataresume[0]["candidate_cp_relation2"].'<br><i class="fontawesome fa fa-phone">&#xf095;</i> '.$dataresume[0]["candidate_cp_phone2"].'</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>';

					
					
					/* Pendidikan */
					$html .= '
					<br />
					<h4 style="margin-bottom:0px;">PENDIDIKAN</h4>
					<i>Education</i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>
							<th width="15%" height="35px" style="border: 0.1mm solid black;background-color:#cecece;" >
							SEKOLAH <br /><i>School</i></th>

							<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
							NAMA SEKOLAH <br /><i>Name of School</i></th>

							<th width="15%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
							KOTA <br /><i>City</i></th>

							<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							JURUSAN <br /><i>Area of specialization</i></th>

							<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							TAHUN PENDIDIKAN <br /><i>Year of education</i><hr style="color:black;"/>Dari / Sampai<br /><i>From / Until</i></th>

							<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
							KETERANGAN <br /><i>Explanation</i></th>
						</tr>';
						
						for($i=0;$i<count($dataedu);$i++) {
						$html.='
						<tr>
							<td width="15%" height="35px" style="border: 0.1mm solid black;" >
								'.$dataedu[$i]["candidate_edu_degree"].'
							</td>

							<td width="20%" height="25px" style="border: 0.1mm solid black;" >
								'.$dataedu[$i]["candidate_edu_institution"].'
							</td>

							<td width="15%" height="25px" style="border: 0.1mm solid black;" align="center">
								'.$dataedu[$i]["candidate_edu_city"].'
							</td>

							<td width="20%" height="20px" style="border: 0.1mm solid black;" >
								'.$dataedu[$i]["candidate_edu_major"].'
							</td>

							<td width="15%" height="20px" style="border: 0.1mm solid black;" align="center">
								'.$dataedu[$i]["candidate_edu_start"].' / '.$dataedu[$i]["candidate_edu_end"].'
							</td>

							<td width="15%" height="20px" style="border: 0.1mm solid black;" >
								'.$dataedu[$i]["candidate_edu_notes"].'
							</td>
						</tr>';
						}
					$html.='</table>';
					
					/* training dan pelatihan */
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">PELATIHAN / KURSUS</h4>
					<i>Training / Course </i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
					<tr>

						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						BIDANG <br /><i>Subject</i>
						</th>

						<th width="15%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						LEMBAGA <br /><i>Institute</i>
						</th>

						<th width="20%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
						KOTA <br /><i>City</i>
						</th>

						<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Tahun (Durasi)<br /><i>Year (Duration)</i>
						</th>

						<th width="15%" height="20px" style="border: 0.1mm solid black;background-color:#cecece;" >
						DIBIAYAI OLEH <br /><i>Financed by</i>
						</th>
					</tr>';
					for($i=0;$i<count($datatraining);$i++) {
					$html.='
					<tr>
						<td width="20%" height="35px" style="border: 0.1mm solid black;" >
						'.$datatraining[$i]["candidate_training_name"].'
						</td>

						<td width="20%" height="20px" style="border: 0.1mm solid black;" align="left">
						'.$datatraining[$i]["candidate_training_institution"].'
						</td>


						<td width="20%" height="25px" style="border: 0.1mm solid black;" align="center">
						'.$datatraining[$i]["candidate_training_city"].'
						</td>

						<td width="15%" height="25px" style="border: 0.1mm solid black;" align="center">
						'.$datatraining[$i]["candidate_training_year"].' <i>('.$datatraining[$i]["candidate_training_duration"].')</i>
						</td>

						<td width="25%" height="20px" style="border: 0.1mm solid black;" >
						'.$datatraining[$i]["candidate_training_sponsor"].'
						</td>
					</tr>';
					}
					$html.='</table>';
					
					/* bahasa */
					
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">BAHASA</h4>
					<i>Language </i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>

							<th width="25%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
							BAHASA <br /><i>Foreign Language</i>
							</th>

							<th width="25%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
							Membaca <br /><i>Read</i>
							</th>

							<th width="25%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
							Bicara <br /><i>Speak</i>
							</th>

							<th width="25%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
							Menulis <br /><i>Write</i>
							</th>

						</tr>
					';
					for($i=0;$i<count($datalang);$i++){
					$html .='
						<tr>

							<td width="20%" height="35px" style="border: 0.1mm solid black;" >'.$datalang[$i]["candidate_language_name"].'
							</td>

							<td width="20%" height="35px" style="border: 0.1mm solid black;" >'.$datalang[$i]["candidate_language_read"].'
							</td>

							<td width="20%" height="35px" style="border: 0.1mm solid black;" >'.$datalang[$i]["candidate_language_conversation"].'
							</td>

							<td width="20%" height="35px" style="border: 0.1mm solid black;" >'.$datalang[$i]["candidate_language_write"].'
							</td>

						</tr>			
					';
					}
					$html.='</table>';
					
					/* Skills */
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">KETRAMPILAN</h4>
					<i>Other skills </i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
					<tr>
						<th width="30%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Ketrampilan <br /><i>Skills</i>
						</th>
						<th width="30%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Level <br /><i>Tingkat</i>
						</th>
						<th width="40%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Keterangan <br /><i>Notes</i>
						</th>
					</tr>';
					for($i=0;$i<count($dataskills);$i++) {
					$html .='
						<tr>
							<td width="30%" height="35px" style="border: 0.1mm solid black;" >'.$dataskills[$i]["candidate_skill_name"].'
							</td>

							<td width="30%" height="35px" style="border: 0.1mm solid black;" >'.$dataskills[$i]["candidate_skill_level"].'
							</td>

							<td width="40%" height="35px" style="border: 0.1mm solid black;" >'.$dataskills[$i]["candidate_skill_notes"].'
							</td>
						</tr>
					';			
					}
					$html .='</table>';
					
					/* family */
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">LATAR BELAKANG KELUARGA</h4>
					<i>Family Background </i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">

					<tr>
						<th width="10%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
						KELUARGA <br /><i>Family</i>
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
						NAMA <br /><i>Name</i>
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
						TEMPAT TGL LAHIR <br /><i>Place & Date of birth</i>
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
						PENDIDIKAN TERAKHIR <br /><i>Latest Education
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
						JABATAN <br /><i>Position
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;">
						PERUSAHAAN <br /><i>Company
						</th>
					</tr>
					';
					for($i=0;$i<count($datafam);$i++) {
					$html.='
					<tr>
						<td width="10%" height="35px" style="border: 0.1mm solid black;" >
						'.$datafam[$i]["candidate_family_relation"].'
						</td>

						<td width="20%" height="20px" style="border: 0.1mm solid black;" align="left">
						'.((isset($datafam[$i]["candidate_family_rip"]) && $datafam[$i]["candidate_family_rip"]=="Alive")?"":"<i>[RIP]</i>").' '.$datafam[$i]["candidate_family_name"].'
						</td>


						<td width="15%" height="25px" style="border: 0.1mm solid black;" align="center">
						'.$datafam[$i]["candidate_family_birthplace"].' , '.((isset($datafam[$i]["candidate_family_birthdate"]) && $datafam[$i]["candidate_family_birthdate"]<>"")?reverseDate($datafam[$i]["candidate_family_birthdate"]):"").'
						</td>


						<td width="15%" height="20px" style="border: 0.1mm solid black;" >
						'.$datafam[$i]["candidate_family_lastedu"].'
						</td>

						<td width="15%" height="20px" style="border: 0.1mm solid black;" >
						'.$datafam[$i]["candidate_family_lastjob"].'
						</td>

						<td width="15%" height="20px" style="border: 0.1mm solid black;" >
						'.$datafam[$i]["candidate_family_company"].'
						</td>
					</tr>';
					}
					$html .='</table>';
					
					/* hobi */
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">HOBI / MINAT</h4>
					<i>Hobbies / Interest </i>
					<br />
					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="5" cellspacing="0">
						<tr>
							<td width="100%" height="20px" style="border: 0.1mm solid black;">'.(($dataresume[0]["candidate_hobby"]<>"")?clean_show($dataresume[0]["candidate_hobby"]):"").'</td>
						</tr>
					</table>
					';
					
					/* organisasi */
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">KEANGGOTAAN BIDANG PROFESI DAN SOSIAL</h4>
					<i>Membership of profesional or social club</i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
					<tr>

						<th width="60%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Nama Kelompok <br /><i>Club\'s Name</i>
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Period <br /><i>Periode</i>
						</th>
						<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
						Jabatan <br /><i>Position</i>
						</th>

					</tr>
					';
					for($i=0;$i<count($dataorg);$i++) {
					$html .='
					<tr>
						<td width="60%" height="20px" style="border: 0.1mm solid black;" >
						'.$dataorg[$i]["candidate_organization_name"].'
						</td>

						<td width="20%" height="20px" style="border: 0.1mm solid black;" >
						'.$dataorg[$i]["candidate_organization_start"].' - '.$dataorg[$i]["candidate_organization_end"].'
						</td>

						<td width="20%" height="20px" style="border: 0.1mm solid black;" >
						'.$dataorg[$i]["candidate_organization_role"].'
						</td>
					</tr>
					';
						
					}
					$html .='</table>';
					
					/* working experiences */
					$html .='
					<br />
					<h4 style="margin-bottom:0px;">RIWAYAT PEKERJAAN</h4>
					<i>Employment History</i>
					<br /><br />

					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
						<tr>

							<th width="50%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
							IDENTITAS PERUSAHAAN <br /><i>Company Identity</i>
							</th>
							<th width="10%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" colspan="2">
							MASA KERJA <br /><i>Service Year</i>
							</th>
							<th width="40%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" colspan="2">
							KETERANGAN <br /><i>Remarks</i>
							</th>

						</tr>
					';
					for($i=0;$i<count($datajob);$i++) {
						$html .='
						<tr>
							<td width="50%" rowspan="2" height="25px" style="border: 0.1mm solid black;"><b>Nama :</b> '.$datajob[$i]["candidate_jobexp_company"].'<br /><br />
							<b>Alamat :</b> '.$datajob[$i]["candidate_jobexp_address"].'<br /><br />
							<b>Telepon :</b> '.$datajob[$i]["candidate_jobexp_phone"].'<br /><br />
							<b>Jenis usaha :</b> '.$datajob[$i]["candidate_jobexp_lob"].'<br /><br />
							<b>Atasan:</b> '.$datajob[$i]["candidate_jobexp_spvname"].' <i>('.$datajob[$i]["candidate_jobexp_spvposition"].')</i><br><br>
							<b>Bawahan:</b> '.$datajob[$i]["candidate_jobexp_subposition"].' <i>('.$datajob[$i]["candidate_jobexp_subnumber"].' orang)</i>

							</td>
							<td width="5%" rowspan="2" height="25px" style="border: 0.1mm solid black;">
							'.((isset($datajob[$i]["candidate_jobexp_start"]) && $datajob[$i]["candidate_jobexp_start"]<>"" )?date("M Y", strtotime($datajob[$i]["candidate_jobexp_start"])):"").'
							</td>
							<td width="5%" rowspan="2" height="25px" style="border: 0.1mm solid black;">
							'.((isset($datajob[$i]["candidate_jobexp_end"]) && $datajob[$i]["candidate_jobexp_end"]<>"" )?date("M Y", strtotime($datajob[$i]["candidate_jobexp_end"])):"").'
							</td>
							<td width="20%" height="25px" style="border: 0.1mm solid black;">
							<b>JABATAN</b><br />
							'.$datajob[$i]["candidate_jobexp_position"].'

							</td>
							<td width="20%" rowspan="2" height="25px" style="border: 0.1mm solid black;">
							<b>Deskripsi Pekerjaan :</b>
							<br>'.$datajob[$i]["candidate_jobexp_desc"].'<br><br>
							<b>Alasan Pengunduran diri :</b>
							<br />'.$datajob[$i]["candidate_jobexp_leaving"].'<br /><br />
							<b>Jumlah Karyawan :</b>
							<br />'.$datajob[$i]["candidate_jobexp_numemployee"].'

							</td>

						</tr>
						<tr>
							<td height="25px" style="border: 0.1mm solid black;">
							<b>GAJI BERSIH /BLN</b><br /><br />
							'.((isset($datajob[$i]["candidate_jobexp_salary"]) && $datajob[$i]["candidate_jobexp_salary"]<>"" && $datajob[$i]["candidate_jobexp_salary"]>0)?showRupiah($datajob[$i]["candidate_jobexp_salary"]):"<i>no data</i>" ).'
							</td>
						</tr>
						';
					}
					$html .='</table>';
					
					
					
					/* struktur organisasi */
					$html .='<br>
					<h4 style="margin-bottom:0px;">GAMBARKAN STRUKTUR ORGANISASI SEDERHANA YANG MEMPERLIHATKAN POSISI ANDA SAAT INI/ YANG TERAKHIR</h4>
					<i>Please draw a simple chart showing the post of your present appointment in the organization</i><br><br>
					<p><div width="700px" height:"250px;" style="border:1px solid #333333; height:250px;">&nbsp;</div></p>
					';
					
					
					
					/* questionaire */
					$html .='
					<pagebreak />

					<h4 style="margin-bottom:0px;">Kuesioner</h4>
					<i>Questionaire</i>
					<br /><br />
					';
					for($c=0;$c<count($datachapter);$c++) {
						$html .='
						<div>
							<span style="text-align:right; color:#aaaaaa;"><h3>part #'.$datachapter[$c]["question_chapter"].'</h3></span>
						
							<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="3" cellspacing="0">
								<tr>
									<th width="7%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >No.</th>
									<th width="59%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
									PERTANYAAN <br /><i>Questions</i>
									</th>
									<th width="7%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
									YA <br /><i>Yes</i>
									</th>
									<th width="7%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
									TIDAK <br /><i>No</i>
									</th>
									<th width="20%" height="25px" style="border: 0.1mm solid black;background-color:#cecece;" >
									PENJELASAN <br /><i>Remarks</i>
									</th>
								</tr>
							';
										
										$urut=1;
										for($q=0;$q<count($dataquestion);$q++) {
											if($datachapter[$c]["question_chapter"]==$dataquestion[$q]["question_chapter"]) {
											$html .= '
											<tr>
												<td align="center" style="border: 0.1mm solid black; background-color:#ffffff;">'.$urut.'</td>
												<td style="border: 0.1mm solid black; background-color:#ffffff;">'.clean_view($dataquestion[$q]["question_deskripsi"]).'<br><i>'.clean_view($dataquestion[$q]["question_desc"]).'</i></td>
												';				
												if($dataquestion[$q]["question_type"]=="yn_desc") {
												$html .= '
														<td style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="y")?'Yes':"").'</td>				
														<td style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="n")?'No':"").'</td>
														<td style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"").'</td>
													';
													}
												else if($dataquestion[$q]["question_type"]=="txt_area" || $dataquestion[$q]["question_type"]=="txt_box_int") {
												$html .= '
														<td colspan="3" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"").'</td>';
													}
												else if($dataquestion[$q]["question_type"]=="txt_box_cur") {
												$html .= '
														<td colspan="3" style="border: 0.1mm solid black; background-color:#ffffff;">'.((isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?showRupiah($dataquestion[$q]["answer_desc"]):"").'</td>';
													}
													
											$html .= '</tr>';
												
											$urut++;
											}
										}
										
							$html .= '</table>';
						
						
						
						
						$html .= '
						</div>
						';		
						$html .= '
						<div style="height:10px;"></div>
						';
						
					}
					
					
					/* pernyataan */
					$html.='
					<table width="700px" style="font-family: serif;font-size:10px;" cellpadding="10" cellspacing="0">
						<tr>
							 <td style="border: 0.1mm solid black;">
							DENGAN INI SAYA MENYATAKAN BAHWA KETERANGAN YANG SAYA BERIKAN DI ATAS ADALAH BENAR.
							APABILA DI KEMUDIAN HARI &nbsp;DITEMUAKN KETIDAKSESUAIAN, SAYA BERTANGGUNG JAWAB PENUH ATAS SEGALA AKIBATNYA<br />
							&nbsp;<i>I hereby verify that the informations given above is true. And if under any circumstances any misrepresentation or omission of information 
							is &nbsp;found. I understand and that I shall fully be held responsible.</i>
							<br /><br />
							'.date("d-M-Y").'
							<br /><br /><br /><br />
							( '.$dataresume[0]["candidate_name"].' )
							</td>
						</tr>
					</table>
					';
					
					
					$mpdf->WriteHTML($html);
					
					$mpdf->Output(_DIRFILES.'/cand_cv_to_user/'.str_replace(" ","_",$dataresume[0]["candidate_name"]).'_FullResume.pdf', 'F');
					return true;
	}
	
	
} // end of authorized area.
?>