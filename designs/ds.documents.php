<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

/*candidate_file_id, candidate_id, candidate_file_name, candidate_file_type
*/
//echo "candidate_id ".$_SESSION["candidate_id"]."<br>";
$datadoc=getDataDoc();
$dataothers=getDataOthers();

//print_r($datadoc);
//print_r ($dataothers);

$data=array();
for($i=0;$i<count($datadoc);$i++) {
// $data[$i]["candidate_file_id"]=(isset($_SESSION["session"]["candidate_file_id"][$i]) && $_SESSION["session"]["candidate_file_id"][$i]<>"")?$_SESSION["session"]["candidate_file_id"][$i]:(isset($datadoc[$i]["candidate_file_id"]))?$datadoc[$i]["candidate_file_id"]:"";
// $data[$i]["candidate_file_name"]=(isset($_SESSION["session"]["candidate_file_name"][$i]) && $_SESSION["session"]["candidate_file_name"][$i]<>"")?$_SESSION["session"]["candidate_file_name"][$i]:(isset($datadoc[$i]["candidate_file_name"]))?$datadoc[$i]["candidate_file_name"]:"";
// $data[$i]["candidate_file_type"]=(isset($_SESSION["session"]["candidate_file_type"][$i]) && $_SESSION["session"]["candidate_file_type"][$i]<>"")?$_SESSION["session"]["candidate_file_type"][$i]:(isset($datadoc[$i]["candidate_file_type"]))?$datadoc[$i]["candidate_file_type"]:"";
// $data[$i]["candidate_file_notes"]=(isset($_SESSION["session"]["candidate_file_notes"][$i]) && $_SESSION["session"]["candidate_file_notes"][$i]<>"")?$_SESSION["session"]["candidate_file_notes"][$i]:(isset($datadoc[$i]["candidate_file_notes"]))?$datadoc[$i]["candidate_file_notes"]:"";
$data[$i]["candidate_file_id"] = (isset($_SESSION["session"]["candidate_file_id"][$i]) && $_SESSION["session"]["candidate_file_id"][$i] != "") ? $_SESSION["session"]["candidate_file_id"][$i] : (isset($datadoc[$i]["candidate_file_id"]) ? $datadoc[$i]["candidate_file_id"] : "");
$data[$i]["candidate_file_name"] = (isset($_SESSION["session"]["candidate_file_name"][$i]) && $_SESSION["session"]["candidate_file_name"][$i] != "") ? $_SESSION["session"]["candidate_file_name"][$i] : (isset($datadoc[$i]["candidate_file_name"]) ? $datadoc[$i]["candidate_file_name"] : "");
$data[$i]["candidate_file_type"] = (isset($_SESSION["session"]["candidate_file_type"][$i]) && $_SESSION["session"]["candidate_file_type"][$i] != "") ? $_SESSION["session"]["candidate_file_type"][$i] : (isset($datadoc[$i]["candidate_file_type"]) ? $datadoc[$i]["candidate_file_type"] : "");
$data[$i]["candidate_file_notes"] = (isset($_SESSION["session"]["candidate_file_notes"][$i]) && $_SESSION["session"]["candidate_file_notes"][$i] != "") ? $_SESSION["session"]["candidate_file_notes"][$i] : (isset($datadoc[$i]["candidate_file_notes"]) ? $datadoc[$i]["candidate_file_notes"] : "");
}


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

$dataphoto=getDocFile($data,"php");
$datacoverletter=getDocFile($data,"coverletter");
$dataijazah=getDocFile($data,"ijazah");
$datatranscript=getDocFile($data,"transcript");
$dataidcard=getDocFile($data,"idcard");



//print_r($data);
//exit;


// print_r($datacoverletter);exit;
?>

<div id="part_alert"><?php echo system_showAlert();?></div>

<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-upload"></i>&nbsp;Please upload required document(s).</cufonize></h2>
		<div class="caption_indo">Mohon upload dokumen-dokumen  yang dibutuhkan.</div>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">		
		
		<ul class="nav nav-tabs">
			<li class="active">
				<a data-toggle="tab" href="#passphoto">
					Pass Photo
					<div class="caption_indo80 novpadding left" style="padding-left:0px;margin-left:0px;">Passfoto</div>
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#coverletter">
					Application Letter
					<div class="caption_indo80 novpadding left" style="padding-left:0px;margin-left:0px;">Surat Lamaran</div>
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#ijazah">
					Diploma Certificate
					<div class="caption_indo80 novpadding left" style="padding-left:0px;margin-left:0px;">Ijazah</div>
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#transcript">
					Transcript
					<div class="caption_indo80 novpadding left" style="padding-left:0px;margin-left:0px;">Transkrip</div>
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#idcard">
					ID Card
					<div class="caption_indo80 novpadding left" style="padding-left:0px;margin-left:0px;">KTP</div>
				</a>
			</li>
			<li>
				<a data-toggle="tab" href="#others">
					Others
					<div class="caption_indo80 novpadding left" style="padding-left:0px;margin-left:0px;">Lain-lain</div>
				</a>
			</li>
		</ul>

		<div class="tab-content" style="padding:20px;">
		
			<!-- part pass photo -->
			<div id="passphoto" class="tab-pane fade in active">
				<h3 style="margin-bottom:0;"><cufonize>Pass Photo</cufonize></h3>
				<div class="caption_indo80 top0" style="padding-left:0px;margin-left:0px;">Pasfoto</div>
				<div class="row">
				
					<div class="col-md-4">
						<div class="form-group col-md-8 thumbnail">
						<?php
						if(isset($dataphoto["id"]) && isset($dataphoto["name"]) && $dataphoto["name"]<>"" ){
							echo "<img src=\""._CANDFILES."/cand_photo/".$dataphoto["name"]."\">";
							$pros="edit";
						}
						else {
							echo "<i class=\"fa fa-user fa-8x fa-border fontAbu top10 bottom10 left10 right10\"></i>";
							$pros="add";
						}
						?>
						</div>
					</div>
					<div class="col-md-8">
						<form name="photofrm" id="photofrm" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
									<b>Requirements:</b>
									<ul>
										<li>Maximum dimension is 200px * 300px (portrait)</li>
										<li>Image will be cropped if its dimension is bigger than 200px * 300px</li>
										<li>File in JPEG/JPG format, Maximum size is 500 KB</li>
										<li>Formal pass photo with blue background</li>
									</ul>
								</div>
								<div class="row caption_indo80" style="padding-left:0px;">
									<b>Ketentuan:</b>
									<ul>
										<li>Ukuran tidak boleh melebihi lebar 200px * tinggi 300px</li>
										<li>Gambar akan terpotong jika ukuran melebihi 200px * 300px</li>
										<li>File dalam format JPEG/JPG dengan ukuran maksimal 500 KB</li>
										<li>Pasfoto formal dengan warna latar belakang biru</li>
									</ul>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-9">
									<input type="file" name="candidate_file" id="candidate_passphoto" class="form-control">
									<input type="hidden" name="candidate_file_type" value="passphoto">
									<input type="hidden" name="candidate_file_type" value="php">
									<input type="hidden" name="candidate_file_id_exist" value="<?php echo ($pros=="edit")?$dataphoto["id"]:"0";?>">
									<input type="hidden" name="candidate_file_name_exist" value="<?php echo ($pros=="edit")?$dataphoto["name"]:"0";?>">
									<input type="hidden" name="mod" value="upload_candidateFile">
									<input type="hidden" name="maxsize" value="512000">
									<input type="hidden" name="fileExt" value="jpg">
									<input type="hidden" name="candFolder" value="cand_photo">
									<input type="hidden" name="maxWidth" value="200">
								</div>
							</div>
							
							<div class="form-group"> 
								<div class="col-md-4">
									<button type="submit" class="btn btn-success"><i class="fa fa-upload"> &nbsp; Upload/Unggah</i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			  
			</div>
			<!-- end of part pass photo -->
			
			<!-- part cover letter -->
			<div id="coverletter" class="tab-pane fade active">
				<h3 style="margin-bottom:0;"><cufonize>Application Letter</cufonize></h3>
				<div class="caption_indo80 top0" style="padding-left:0px;margin-left:0px;">Surat Lamaran</div>
				<div class="row">
				
					<div class="col-md-6">
						<?php
						if(isset($datacoverletter["id"]) && isset($datacoverletter["name"]) && $datacoverletter["name"]<>"" ){
							$pros="edit";
						?>
							<div>
								<object data="<?php echo _CANDFILES."/cand_coverletter/".$datacoverletter["name"];?>" type="application/pdf">
								alt : <a href="<?php echo _CANDFILES."/cand_coverletter/".$datacoverletter["name"];?>" target="_blank"><?php echo $datacoverletter["name"];?></a>
								</object>
							</div>
						<?php	
						}
						else {
							echo "<i class=\"fa fa-file-pdf-o fa-8x fa-border fontAbu top10 bottom10 left10 right10\"></i>";
							$pros="add";
						}
						?>
					</div>
					<div class="col-md-6">
						<form name="coverletterfrm" id="coverletterfrm" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
									<b>Requirements:</b>
									<ul>
										<li>Formal application letter not longer than 1 page A4.</li>
										<li>File in PDF format, Maximum size is 1 MB</li>
									</ul>
								</div>
								<div class="row caption_indo80" style="padding-left:0px;">
									<b>Ketentuan:</b>
									<ul>
										<li>Surat Lamaran Kerja formal tidak lebih dari 1 halaman A4.</li>
										<li>File dalam format PDF dengan ukuran maksimal 1 MB</li>
									</ul>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-9">
									<input type="file" name="candidate_file" class="form-control">
									<input type="hidden" name="candidate_file_type" value="coverletter">
									<input type="hidden" name="candidate_file_id_exist" value="<?php echo ($pros=="edit")?$datacoverletter["id"]:"0";?>">
									<input type="hidden" name="candidate_file_name_exist" value="<?php echo ($pros=="edit")?$datacoverletter["name"]:"0";?>">
									<input type="hidden" name="mod" value="upload_candidateFile">
									<input type="hidden" name="maxsize" value="1048576">
									<input type="hidden" name="fileExt" value="pdf">
									<input type="hidden" name="candFolder" value="cand_coverletter">

								</div>
							</div>
							
							<div class="form-group"> 
								<div class="col-md-4">
									<button type="submit" class="btn btn-success"><i class="fa fa-upload"> &nbsp; Upload/Unggah</i></button>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
			<!-- end of cover letter -->
			
			<!-- part certificate -->
			<div id="ijazah" class="tab-pane fade">
				<h3 style="margin-bottom:0;"><cufonize>Diploma Certificate</cufonize></h3>
				<div class="caption_indo80 top0" style="padding-left:0px;margin-left:0px;">Ijazah</div>

				<div class="row">
				
					<div class="col-md-6">
						<?php
						if(isset($dataijazah["id"]) && isset($dataijazah["name"]) && $dataijazah["name"]<>"" ){
							$pros="edit";
						?>
							<div>
								<object data="<?php echo _CANDFILES."/cand_ijazah/".$dataijazah["name"];?>" type="application/pdf">
								alt : <a href="<?php echo _CANDFILES."/cand_ijazah/".$dataijazah["name"];?>" target="_blank"><?php echo $dataijazah["name"];?></a>
								</object>
							</div>
						<?php	
						}
						else {
							echo "<i class=\"fa fa-file-pdf-o fa-8x fa-border fontAbu top10 bottom10 left10 right10\"></i>";
							$pros="add";
						}
						?>
					</div>
					<div class="col-md-6">
						<form name="ijazahfrm" id="ijazahfrm" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
									<b>Requirements:</b>
									<ul>
										<li>File in PDF format, Maximum size is 1 MB.</li>
										<li>Good quality scanned and ready to print.</li>
									</ul>
								</div>
								<div class="row caption_indo80" style="padding-left:0px;">
									<b>Ketentuan:</b>
									<ul>
										<li>File dalam format PDF dengan ukuran maksimal 1 MB.</li>
										<li>Kualitas hasil scan jelas dibaca dan siap cetak.</li>
									</ul>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-9">
									<input type="file" name="candidate_file" class="form-control">
									<input type="hidden" name="candidate_file_type" value="ijazah">
									<input type="hidden" name="candidate_file_id_exist" value="<?php echo ($pros=="edit")?$dataijazah["id"]:"0";?>">
									<input type="hidden" name="candidate_file_name_exist" value="<?php echo ($pros=="edit")?$dataijazah["name"]:"0";?>">
									<input type="hidden" name="mod" value="upload_candidateFile">
									<input type="hidden" name="maxsize" value="1048576">
									<input type="hidden" name="fileExt" value="pdf">
									<input type="hidden" name="candFolder" value="cand_ijazah">
								</div>
							</div>
							
							<div class="form-group"> 
								<div class="col-md-4">
									<button type="submit" class="btn btn-success"><i class="fa fa-upload"> &nbsp; Upload/Unggah</i></button>
								</div>
							</div>
						</form>
					</div>
				</div>

			  
			</div>
			<!-- end of part certificate -->
			
			
			<!-- part transcript -->
			<div id="transcript" class="tab-pane fade">
				<h3 style="margin-bottom:0;"><cufonize>Transcript</cufonize></h3>
				<div class="caption_indo80 top0" style="padding-left:0px;margin-left:0px;">Transkrip</div>

				<div class="row">
				
					<div class="col-md-6">
						<?php
						if(isset($datatranscript["id"]) && isset($datatranscript["name"]) && $datatranscript["name"]<>"" ){
							$pros="edit";
						?>
							<div>
								<object data="<?php echo _CANDFILES."/cand_transcript/".$datatranscript["name"];?>" type="application/pdf">
								alt : <a href="<?php echo _CANDFILES."/cand_transcript/".$datatranscript["name"];?>" target="_blank"><?php echo $datatranscript["name"];?></a>
								</object>
							</div>
						<?php	
						}
						else {
							echo "<i class=\"fa fa-file-pdf-o fa-8x fa-border fontAbu top10 bottom10 left10 right10\"></i>";
							$pros="add";
						}
						?>
					</div>
					<div class="col-md-6">
						<form name="transcriptfrm" id="transcriptfrm" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
									<b>Requirements:</b>
									<ul>
										<li>File in PDF format, Maximum size is 1 MB.</li>
										<li>Good quality scanned and ready to print.</li>
									</ul>
								</div>
								<div class="row caption_indo80" style="padding-left:0px;">
									<b>Ketentuan:</b>
									<ul>
										<li>File dalam format PDF dengan ukuran maksimal 1 MB.</li>
										<li>Kualitas hasil scan jelas dibaca dan siap cetak.</li>
									</ul>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-9">
									<input type="file" name="candidate_file" class="form-control">
									<input type="hidden" name="candidate_file_type" value="transcript">
									<input type="hidden" name="candidate_file_id_exist" value="<?php echo ($pros=="edit")?$datatranscript["id"]:"0";?>">
									<input type="hidden" name="candidate_file_name_exist" value="<?php echo ($pros=="edit")?$datatranscript["name"]:"0";?>">
									<input type="hidden" name="mod" value="upload_candidateFile">
									<input type="hidden" name="maxsize" value="1048576">
									<input type="hidden" name="fileExt" value="pdf">
									<input type="hidden" name="candFolder" value="cand_transcript">
								</div>
							</div>
							
							<div class="form-group"> 
								<div class="col-md-4">
									<button type="submit" class="btn btn-success"><i class="fa fa-upload"> &nbsp; Upload/Unggah</i></button>
								</div>
							</div>
						</form>
					</div>
				</div>

			  
			</div>
			<!-- end of part transcript -->
			
			<!-- part idcard -->
			<div id="idcard" class="tab-pane fade">
				<h3 style="margin-bottom:0;"><cufonize>ID Card</cufonize></h3>
				<div class="caption_indo80 top0" style="padding-left:0px;margin-left:0px;">KTP</div>
				
				<div class="row">
				
					<div class="col-md-5">
						<div class="form-group col-md-10 thumbnail">
						<?php
						if(isset($dataidcard["id"]) && isset($dataidcard["name"]) && $dataidcard["name"]<>"" ){
							echo "<img src=\""._CANDFILES."/cand_id/".$dataidcard["name"]."\">";
							$pros="edit";
						}
						else {
							echo "<i class=\"fa fa-credit-card fa-8x fa-border fontAbu top10 bottom10 left10 right10\"></i>";
							$pros="add";
						}
						?>
						</div>
					</div>
					<div class="col-md-7">
						<form name="idcardfrm" id="idcardfrm" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<div class="row">
									<b>Requirements:</b>
									<ul>
										<li>Dimension more or less 500px width (Landscape)</li>
										<li>File in JPEG/JPG format or PDF, Maximum size is 500 KB</li>
										<li>Good quality scanned and ready to print</li>
									</ul>
								</div>
								<div class="row caption_indo80" style="padding-left:0px;">
									<b>Ketentuan:</b>
									<ul>
										<li>Ukuran tidak boleh melebihi lebar 500px dengan tinggi tidak melebihi lebar-nya</li>
										<li>File dalam format JPEG/JPG atau PDF dengan ukuran maksimal 500 KB</li>
										<li>Kualitas hasil scan jelas dibaca dan siap cetak.</li>
									</ul>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-9">
									<input type="file" name="candidate_file" id="candidate_idcard" class="form-control">
									<input type="hidden" name="candidate_file_type" value="idcard">
									<input type="hidden" name="candidate_file_id_exist" value="<?php echo ($pros=="edit")?$dataidcard["id"]:"0";?>">
									<input type="hidden" name="candidate_file_name_exist" value="<?php echo ($pros=="edit")?$dataidcard["name"]:"0";?>">
									<input type="hidden" name="mod" value="upload_candidateFile">
									<input type="hidden" name="maxsize" value="512000">
									<input type="hidden" name="fileExt" value="jpg">
									<input type="hidden" name="candFolder" value="cand_id">
									<input type="hidden" name="maxWidth" value="500">
								</div>
							</div>
							
							<div class="form-group"> 
								<div class="col-md-4">
									<button type="submit" class="btn btn-success"><i class="fa fa-upload"> &nbsp; Upload/Unggah</i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			  
			</div>		
			<!-- end of part idcard -->
			
			<!-- part others -->
			<div id="others" class="tab-pane fade">
				<h3 style="margin-bottom:0;"><cufonize>Others</cufonize></h3>
				<div class="caption_indo80 top0" style="padding-left:0px;margin-left:0px;">Lain-lain</div>
				
					<div class="row col-md-12 bottom30">
						<table class="table">
							<thead>
								<tr>
									<td>
										File
										<div class="caption_indo80 novpadding" style="padding-left:0px;margin-left:0px;">File</div>
									</td>
									<td>
										Description
										<div class="caption_indo80 novpadding" style="padding-left:0px;margin-left:0px;">Keterangan</div>
									</td>
									<td>
										Action
										<div class="caption_indo80 novpadding" style="padding-left:0px;margin-left:0px;">Aksi</div>
									</td>
								</tr>
							</thead>
							<tbody>
							<?php
							for($d=0;$d<count($dataothers);$d++) {
							?>
								<form name="delfrm<?php echo $d;?>" id="delfrm<?php echo $d;?>" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
								<tr>
									<td><a href="<?php echo _CANDFILES."/cand_others/".$dataothers[$d]["candidate_file_name"];?>" target="_blank"><?php echo $dataothers[$d]["candidate_file_name"];?></a></td>
									<td><?php echo $dataothers[$d]["candidate_file_notes"];?></td>
									<td>
										<input type="hidden" name="candidate_file_id" value="<?php echo $dataothers[$d]["candidate_file_id"];?>">
										<input type="hidden" name="candidate_file_name_exist" value="<?php echo $dataothers[$d]["candidate_file_name"];?>">
										<input type="hidden" name="candFolder" value="cand_others">
										<input type="hidden" name="mod" value="upload_candidateDelFileOthers">
										<input type="hidden" name="candidate_file_type" value="others">
										<button type="submit" class="btn btn-danger btn-xs">&nbsp;<i class="fa fa-trash-o"></i>&nbsp;Delete/Hapus</button>
									</td>
								</tr>
								</form>
							<?php
							}
							?>
							</tbody>
						
						</table>
					</div>
					
					<hr>
					
					<div class="row col-md-12">
						<form name="othersfrm" id="othersfrm" class="form-horizontal" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" enctype="multipart/form-data">
							<div class="form-group">
									<b>Requirements:</b>
									<ul>
										<li>You may upload additional files to support your resume (such as: certificates of course or seminar, letter of recommendation, or letter of reference).</li>
										<li>File in PDF format, Maximum size is 1 MB.</li>
										<li>Good quality scanned and ready to print.</li>
									</ul>
							</div>
							
							<div class="form-group caption_indo80" style="padding-left:0px;">
									<b>Ketentuan:</b>
									<ul>
										<li>Anda diperbolehkan mengunggah dokumen tambahan untuk mendukung resume Anda (misalnya: sertifikat kursus atau seminar, surat rekomendasi, atau surat referensi kerja).</li>
										<li>File dalam format PDF dengan ukuran maksimal 1 MB</li>
										<li>Kualitas hasil scan jelas dibaca dan siap cetak.</li>
									</ul>
							</div>
							
							<div class="form-group">
								<div class="col-md-5">
									<div class="right bold">Browse File &nbsp;<span class="asterisk">*</span></div>
									<div class="right caption_indo80 novpadding" style="padding-right:15px;">Cari dokumen</div>
								</div>
								<div class="col-md-7">
									<input type="file" name="candidate_file" class="form-control">
									<input type="hidden" name="mod" value="upload_candidateFileOthers">
									<input type="hidden" name="candidate_file_type" value="others">
									<input type="hidden" name="maxsize" value="1048576">
									<input type="hidden" name="fileExt" value="pdf">
									<input type="hidden" name="candFolder" value="cand_others">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-5">
									<div class="right bold">File Description &nbsp;&nbsp;&nbsp;</div>
									<div class="right caption_indo80 novpadding" style="padding-right:15px;">Deskripsi dokumen</div>
								</div>
								<div class="col-md-7">
									<input type="text" name="candidate_file_notes" class="validate[required] form-control">
								</div>
							</div>
							
							<div class="form-group"> 
								<div class="col-md-offset-5 col-md-4">
									<button type="submit" class="btn btn-success"><i class="fa fa-upload"> &nbsp; Upload/Unggah</i></button>
								</div>
							</div>
						</form>
					</div>

			  
			</div>
			<!-- end of part others -->
			
			
			
			
		</div>


		
	</div>
	<!-- akhir panel body -->
	
</div>

<script type="text/javascript">
        $(function() {
          // Javascript to enable link to tab
          var hash = document.location.hash;
          if (hash) {
            console.log(hash);
            $('.nav-tabs a[href='+hash+']').tab('show');
          }

          // Change hash for page-reload
          $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            window.location.hash = e.target.hash;
			document.getElementById("part_alert").style.display = "none";
          });
        });
</script>
<!--
<script>
$(document).ready(function(){
    $("#registerform").validationEngine();
   });
</script>
-->