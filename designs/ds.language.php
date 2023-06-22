<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || empty($_SESSION["log_auth_name"])) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

/*candidate_language_id, candidate_id, candidate_language_name, candidate_language_read, candidate_language_write, candidate_language_conversation
*/
//echo "candidate_id ".$_SESSION["candidate_id"]."<br>";
$datalang=getDataLanguage();


$data=array();
for($i=0;$i<count($datalang);$i++) {
// $data[$i]["candidate_language_id"]=(isset($_SESSION["session"]["candidate_language_id"][$i]) && $_SESSION["session"]["candidate_language_id"][$i]<>"")?$_SESSION["session"]["candidate_language_id"][$i]:(isset($datalang[$i]["candidate_language_id"]))?$datalang[$i]["candidate_language_id"]:"";
// $data[$i]["candidate_language_name"]=(isset($_SESSION["session"]["candidate_language_name"][$i]) && $_SESSION["session"]["candidate_language_name"][$i]<>"")?$_SESSION["session"]["candidate_language_name"][$i]:(isset($datalang[$i]["candidate_language_name"]))?$datalang[$i]["candidate_language_name"]:"";
// $data[$i]["candidate_language_read"]=(isset($_SESSION["session"]["candidate_language_read"][$i]) && $_SESSION["session"]["candidate_language_read"][$i]<>"")?$_SESSION["session"]["candidate_language_read"][$i]:(isset($datalang[$i]["candidate_language_read"]))?$datalang[$i]["candidate_language_read"]:"";
// $data[$i]["candidate_language_write"]=(isset($_SESSION["session"]["candidate_language_write"][$i]) && $_SESSION["session"]["candidate_language_write"][$i]<>"")?$_SESSION["session"]["candidate_language_write"][$i]:(isset($datalang[$i]["candidate_language_write"]))?$datalang[$i]["candidate_language_write"]:"";
// $data[$i]["candidate_language_conversation"]=(isset($_SESSION["session"]["candidate_language_conversation"][$i]) && $_SESSION["session"]["candidate_language_conversation"][$i]<>"")?$_SESSION["session"]["candidate_language_conversation"][$i]:(isset($datalang[$i]["candidate_language_conversation"]))?$datalang[$i]["candidate_language_conversation"]:"";
$data[$i]["candidate_language_id"] = (isset($_SESSION["session"]["candidate_language_id"][$i]) && $_SESSION["session"]["candidate_language_id"][$i] != "") ? $_SESSION["session"]["candidate_language_id"][$i] : (isset($datalang[$i]["candidate_language_id"]) ? $datalang[$i]["candidate_language_id"] : "");
$data[$i]["candidate_language_name"] = (isset($_SESSION["session"]["candidate_language_name"][$i]) && $_SESSION["session"]["candidate_language_name"][$i] != "") ? $_SESSION["session"]["candidate_language_name"][$i] : (isset($datalang[$i]["candidate_language_name"]) ? $datalang[$i]["candidate_language_name"] : "");
$data[$i]["candidate_language_read"] = (isset($_SESSION["session"]["candidate_language_read"][$i]) && $_SESSION["session"]["candidate_language_read"][$i] != "") ? $_SESSION["session"]["candidate_language_read"][$i] : (isset($datalang[$i]["candidate_language_read"]) ? $datalang[$i]["candidate_language_read"] : "");
$data[$i]["candidate_language_write"] = (isset($_SESSION["session"]["candidate_language_write"][$i]) && $_SESSION["session"]["candidate_language_write"][$i] != "") ? $_SESSION["session"]["candidate_language_write"][$i] : (isset($datalang[$i]["candidate_language_write"]) ? $datalang[$i]["candidate_language_write"] : "");
$data[$i]["candidate_language_conversation"] = (isset($_SESSION["session"]["candidate_language_conversation"][$i]) && $_SESSION["session"]["candidate_language_conversation"][$i] != "") ? $_SESSION["session"]["candidate_language_conversation"][$i] : (isset($datalang[$i]["candidate_language_conversation"]) ? $datalang[$i]["candidate_language_conversation"] : "");
}
/*
print_r($data);
exit;
*/
if(count($data)>0) $data=clean_view($data);
?>
<div><?php echo system_showAlert();?></div>

<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-language"></i>&nbsp;Please list your Language Proficiency.</cufonize></h2>
		<div class="caption_indo">Mohon tuliskan kemampuan Bahasa Asing yang Anda kuasai.</div>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">
	
		<form name="langskills" id="langskills" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" enctype="multipart/form-data">
			 <div class="row clearfix">
				<div class="col-md-12 column">
					<table  class="table small-text" id="tb_lang">
						<tr class="tr-header">
							<th>
								Language
								<div class="caption_indo80 nopadding">Bahasa</div>
							</th>
							<th>
								Reading
								<div class="caption_indo80 nopadding">Membaca</div>
							</th>
							<th>
								Writing
								<div class="caption_indo80 nopadding">Menulis</div>
							</th>
							<th>
								Conversation
								<div class="caption_indo80 nopadding">Percakapan</div>
							</th>
							<th><button type="button" class="btn btn-success btn-xs" id="lang_add"><i class="fa fa-plus"></i> Add/Tambah</button></th>
						</tr>
						<tr style="display:none;">
							<td><input type="text" name="candidate_language_name[]" class="form-control"></td>
							<td>
								<select name="candidate_language_read[]" class="form-control">
									<option value="Beginner">Beginner/ Pemula</option>
									<option value="Elementary">Elementary/ Dasar</option>
									<option value="Intermediate">Intermediate/ Menengah</option>
									<option value="Upper Intermediate">Upper Intermediate/ Menengah atas</option>
									<option value="Advance">Advance/ Tingkat lanjut</option>
									<option value="Master">Master/ Ahli</option>
								</select>
							</td>
							<td>
								<select name="candidate_language_write[]" class="form-control">
									<option value="Beginner">Beginner/ Pemula</option>
									<option value="Elementary">Elementary/ Dasar</option>
									<option value="Intermediate">Intermediate/ Menengah</option>
									<option value="Upper Intermediate">Upper Intermediate/ Menengah atas</option>
									<option value="Advance">Advance/ Tingkat lanjut</option>
									<option value="Master">Master/ Ahli</option>
								</select>
							</td>
							<td>
								<select name="candidate_language_conversation[]" class="form-control">
									<option value="Beginner">Beginner/ Pemula</option>
									<option value="Elementary">Elementary/ Dasar</option>
									<option value="Intermediate">Intermediate/ Menengah</option>
									<option value="Upper Intermediate">Upper Intermediate/ Menengah atas</option>
									<option value="Advance">Advance/ Tingkat lanjut</option>
									<option value="Master">Master/ Ahli</option>
								</select>
								<input type="hidden" name="candidate_language_id[]" value="0">
							</td>
							<td><a href='javascript:void(0);'  class='lang_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
						</tr>
						
						<?php
						if(isset($data) && count($data)>0) {
							for($l=0;$l<count($data);$l++) {
						?>
							<tr>
								<td><input type="text" name="candidate_language_name[]" class="form-control" value="<?php echo (isset($data[$l]["candidate_language_name"]) && $data[$l]["candidate_language_name"]<>"")?$data[$l]["candidate_language_name"]:"";?>"></td>
								<td>
									<select name="candidate_language_read[]" class="form-control">
										<option value="Beginner" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Beginner")?"selected":"";?>>Beginner/ Pemula</option>
										<option value="Elementary" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Elementary")?"selected":"";?>>Elementary/ Dasar</option>
										<option value="Intermediate" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Intermediate")?"selected":"";?>>Intermediate/ Menengah</option>
										<option value="Upper Intermediate" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Upper Intermediate")?"selected":"";?>>Upper Intermediate/ Menengah atas</option>
										<option value="Advance" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Advance")?"selected":"";?>>Advance/ Tingkat lanjut</option>
										<option value="Master" <?php echo (isset($data[$l]["candidate_language_read"]) && $data[$l]["candidate_language_read"]=="Master")?"selected":"";?>>Master/ Ahli</option>
									</select>
								</td>
								<td>
									<select name="candidate_language_write[]" class="form-control">
										<option value="Beginner" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Beginner")?"selected":"";?>>Beginner/ Pemula</option>
										<option value="Elementary" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Elementary")?"selected":"";?>>Elementary/ Dasar</option>
										<option value="Intermediate" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Intermediate")?"selected":"";?>>Intermediate/ Menengah</option>
										<option value="Upper Intermediate" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Upper Intermediate")?"selected":"";?>>Upper Intermediate/ Menengah atas</option>
										<option value="Advance" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Advance")?"selected":"";?>>Advance/ Tingkat lanjut</option>
										<option value="Master" <?php echo (isset($data[$l]["candidate_language_write"]) && $data[$l]["candidate_language_write"]=="Master")?"selected":"";?>>Master/ Ahli</option>
									</select>
								</td>								
								<td>
									<select name="candidate_language_conversation[]" class="form-control">
										<option value="Beginner" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Beginner")?"selected":"";?>>Beginner/ Pemula</option>
										<option value="Elementary" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Elementary")?"selected":"";?>>Elementary/ Dasar</option>
										<option value="Intermediate" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Intermediate")?"selected":"";?>>Intermediate/ Menengah</option>
										<option value="Upper Intermediate" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Upper Intermediate")?"selected":"";?>>Upper Intermediate/ Menengah atas</option>
										<option value="Advance" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Advance")?"selected":"";?>>Advance/ Tingkat lanjut</option>
										<option value="Master" <?php echo (isset($data[$l]["candidate_language_conversation"]) && $data[$l]["candidate_language_conversation"]=="Master")?"selected":"";?>>Master/ Ahli</option>
									</select>
									<input type="hidden" name="candidate_language_id[]" value="<?php echo $data[$l]["candidate_language_id"]?>">
								</td>
								<td><a href='javascript:void(0);'  class='lang_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
							</tr>
						<?php
							}
						}
						else {
						?>
							<tr>
								<td><input type="text" name="candidate_language_name[]" class="form-control"></td>
								<td>
									<select name="candidate_language_read[]" class="form-control">
										<option value="Beginner">Beginner/ Pemula</option>
										<option value="Elementary">Elementary/ Dasar</option>
										<option value="Intermediate">Intermediate/ Menengah</option>
										<option value="Upper Intermediate">Upper Intermediate/ Menengah atas</option>
										<option value="Advance">Advance/ Tingkat lanjut</option>
										<option value="Master">Master/ Ahli</option>
									</select>
								</td>
								<td>
									<select name="candidate_language_write[]" class="form-control">
										<option value="Beginner">Beginner/ Pemula</option>
										<option value="Elementary">Elementary/ Dasar</option>
										<option value="Intermediate">Intermediate/ Menengah</option>
										<option value="Upper Intermediate">Upper Intermediate/ Menengah atas</option>
										<option value="Advance">Advance/ Tingkat lanjut</option>
										<option value="Master">Master/ Ahli</option>
									</select>
								</td>
								<td>
									<select name="candidate_language_conversation[]" class="form-control">
										<option value="Beginner">Beginner/ Pemula</option>
										<option value="Elementary">Elementary/ Dasar</option>
										<option value="Intermediate">Intermediate/ Menengah</option>
										<option value="Upper Intermediate">Upper Intermediate/ Menengah atas</option>
										<option value="Advance">Advance/ Tingkat lanjut</option>
										<option value="Master">Master/ Ahli</option>
									</select>
									<input type="hidden" name="candidate_language_id[]" value="0">
								</td>
								<td><a href='javascript:void(0);'  class='lang_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove/Hapus</button></a></td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			
			<input type="hidden" name="mod" value="update_candidateLang"/>
			
			
			<div class="form-group"> 
				<div class="col-md-4">
					<button type="submit" class="btn btn-success">SAVE ( SIMPAN )</button>
				</div>
			</div>
		</form>				
	</div>
	<!-- akhir panel body -->
	
</div>