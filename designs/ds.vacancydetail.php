<style>
  .left5 {
    display: inline-block;
    margin-right: 30px;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;
    max-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border-radius: 4px;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .form-group input {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  .form-group input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
  }

  .form-group input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>


<?php
if (isset($_GET)) $_GET = sanitize_get($_GET);
// var_dump($_GET);
$data=(isset($_GET["job_vacancy_id"]) && $_GET["job_vacancy_id"]<>"")?vacancy_getJobAdv($_GET["job_vacancy_id"],"detail"):vacancy_getJobAdv(0,"detail");

// echo "jv_id=".$_GET["job_vacancy_id"];
// var_dump(is_array($data));
// var_dump(count($data) > 0);
if (is_array($data) && count($data) > 0) {
	
$data=clean_view($data);
?>



<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
	<h2 class="panel-title"><cufonize><i class="fa fa-bookmark"></i>&nbsp;<?php echo $data[0]["job_vacancy_name"];?></cufonize></h2>
	</div>
	<div class="panel-body" style="line-height:150%; text-align:justify;">
		<div class="row top10 bottom30 left30 right30"><?php echo system_showAlert();?></div>

		<?php
		if(isset($data[0]["job_vacancy_city"]) && $data[0]["job_vacancy_city"]<>"") {
		?>
		<div class="row bottom10">
			<div class="col-md-3" style="text-align:right;"><strong>Work Location </strong><i class="caption_indo80 left0">(Lokasi Pekerjaan)</i>:</div>		
			<div class="col-md-7 left10"><?php echo $data[0]["job_vacancy_city"];?></div>	
		</div>
		<?php
		}

		if(isset($data[0]["job_vacancy_desc"]) && $data[0]["job_vacancy_desc"]<>"") {
		?>
		<div class="row bottom10">
			<div class="col-md-3" style="text-align:right;"><strong>Job Description </strong><i class="caption_indo80 left0">(Deskripsi Pekerjaan)</i>:</div>		
			<div class="col-md-7 left10"><?php echo $data[0]["job_vacancy_desc"];?></div>	
		</div>
		<?php
		}

		if(isset($data[0]["job_vacancy_degree"]) && $data[0]["job_vacancy_degree"]<>"") {
		?>
		<div class="row bottom10">
			<div class="col-md-3" style="text-align:right;"><strong>Minimum Degree </strong><i class="caption_indo80 left0">(Pendidikan minimal)</i>:</div>		
			<div class="col-md-7 left10"><?php echo $data[0]["job_vacancy_degree"];?></div>	
		</div>
		<?php
		}

		if(isset($data[0]["job_vacancy_enddate"]) && $data[0]["job_vacancy_enddate"]<>"") {
		?>
		<div class="row bottom10">
			<div class="col-md-3" style="text-align:right;"><strong>Closing Date </strong><i class="caption_indo80 left0">(Penutupan lowongan)</i>:</div>		
			<div class="col-md-7 left10">Please make sure to apply for this position latest on <strong><?php echo date("l, d M Y",strtotime($data[0]["job_vacancy_enddate"]));?></strong></div>	
			<div class="col-md-7 left10 caption_indo80">Mohon kirimkan lamaran Anda selambat-lambatnya tanggal <strong><?php echo date("d M Y",strtotime($data[0]["job_vacancy_enddate"]));?></strong></div>	
		</div>
		<?php
		}
		?>
		
		
		
		<div class="row top30 bottom30">
		
			<?php
			//jika bukan admin
			if(empty($_SESSION["priv_id"]) || (isset($_SESSION["priv_id"]) && $_SESSION["priv_id"]=="candid") ) {
			?>
			<div class="col-md-offset-2 col-md-3 left10">
				<form name="apply" id="apply" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
				<?php
				if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && $_SESSION["log_auth_id"]<>"" && $_SESSION["log_auth_name"]<>"") {
					/* cek kelengkapan data dan status melamar-nya. */
					$numApply=getNumApply("open_project");
					//echo "numApply=".$numApply;
				
					$is_applied=vacancy_isApplied($_SESSION["candidate_id"],$_SESSION["log_auth_name"],$data[0]["job_vacancy_id"]);
					//print_r($_SESSION);
					//echo "is_applied: ".$is_applied[0]["candidate_email"];
					//cek umur vacancy terakhir yg diapply
					//$hariplus1=date('Y-m-d h:i:s',strtotime('tomorrow'));
					//$umur_adv=(isset($applied[0]["adv_id"]) && $applied[0]["adv_id"]<>"")?date_diff(date_create($applied[0]["apply_date"]), date_create($hariplus1))->y:"";
					//echo "<br>hari + 1=".$hariplus1."<br>umuradv=".$umur_adv;
				?>
					<input type="hidden" name="job_vacancy_id" value="<?php echo $data[0]["job_vacancy_id"];?>">				
					<input type="hidden" name="mod" value="vacancy_candidateApply">
					<input type="hidden" name="" value="<?php echo (isset($numApply) && $numApply<>"")?$numApply:"0";?>">
					<?php
					if($is_applied) {
					?>
						<button type="button" class="btn btn-warning btn-md disabled" > 
						You have already applied for this position 
						<div class="caption_indo80 putih">Anda sudah melamar posisi ini</div>
						</button>						
					<?php
					}
					else
					{
						if($numApply<_MAXAPPLY) {
					?>
						<button type="submit" class="btn btn-success btn-md" > 
						APPLY FOR THIS POSITION 
						<div class="caption_indo80 putih">LAMAR POSISI INI</div>
						</button>
					<?php
						}
						else {
					?>
						<button type="button" class="btn btn-warning btn-md disabled" > 
						You had applied for <?php echo _MAXAPPLY;?> position 
						<div class="caption_indo80 putih">Anda telah melamar <?php echo _MAXAPPLY;?> posisi </div>
						</button>						
					<?php
						}
					}

				}
				else {
				?>
					<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#alertLogin">
					APPLY FOR THIS POSITION 
					<div class="caption_indo80 putih">LAMAR POSISI INI</div>
					</button>
				<?php
				}
				?>
				  
				</form>
			</div>
			<div class="left5">
				<a href="<?php echo _PATHURL;?>/vacancy/" class="btn btn-info btn-md"  role="button">
				Return to List of Job Vacancy
				<div class="caption_indo80 putih">Kembali ke list Lowongan</div>
				</a>
			</div>
			<?php
				if (isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"])) {
					// User telah login
						// Tampilkan button "Referall Person"
				?>
				<div class="left5">
					<a href="#" class="btn btn-success btn-md" onclick="openModal()" role="button">
						Referall Person to This Position
						<div class="caption_indo80 putih">Referall Calon Kandidat</div>
					</a>
				</div>
				<?php
				}
				?>
			<?php
			}
			
			if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"]) && 
			in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
			?>
			<div class="col-md-12 right30" align="right">
				<a href="<?php echo _PATHURL;?>/jobadv/" class="btn btn-info btn-md"  role="button">
				Return to List of Job Vacancy
				<div class="caption_indo80 putih">Kembali ke list Lowongan</div>
				</a>
			</div>
			<?php
			}
			?>
			
		</div>
		
		
		
	</div>
</div>
<?php
}
else {
	echo "Data Not Found";
}
?>

<!-- Modal -->
<div id="alertLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notice</h4>
      </div>t/og
        You have to <a href="<?php echo _PATHURL;?>/login/" class="btn btn-success btn-sm"  role="button">LOGIN</a> and complete your resume in order to apply for this position.
		<div class="caption_indo80 left0 top10">Anda harus <a href="<?php echo _PATHURL;?>/login/"  role="button">LOGIN</a> dan melengkapi data diri/ resume Anda agar dapat melamar pekerjaan.</div>
      </div>
	  <!--
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
	  -->
    </div>

  </div>
</div>


<?php
$dataresume=getDataResume();
?>
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 style="margin-bottom: 20px;">Referral Person</h2>
	<form method="post" action="<?php echo _PATHURL;?>/letsprocess.php">

	<div class="form-group">
		<div>
			<label for="nama_pengusul">Nama:</label>
		</div>
			<input type="nama_pengusul" class="form-control" name="nama_pengusul" id="nama_pengusul" value="<?php echo (isset($dataresume[0]["candidate_name"]) && $dataresume[0]["candidate_name"]<>"")?$dataresume[0]["candidate_name"]:"";?>" readonly="readonly">
	</div>

	<div class="form-group">
		<div>
			<label for="email">Email:</label>
		</div>
			<input type="email" class="form-control" name="email" id="email" value="<?php echo (isset($dataresume[0]["candidate_email"]) && $dataresume[0]["candidate_email"]<>"")?$dataresume[0]["candidate_email"]:"";?>" readonly="readonly">
	</div>

	<div class="form-group">
		<div>
			<label for="posisi">Posisi</label>
		</div>
			<input type="posisi" class="form-control" name="posisi" id="posisi" value="<?php echo (isset( $data[0]["job_vacancy_name"]) &&  $data[0]["job_vacancy_name"]<>"")? $data[0]["job_vacancy_name"]:"";?>" readonly="readonly">
	</div>

      <div class="form-group">
        <label for="nama">Nama Calon Rekomendasi:</label>
        <input type="nama" id="nama_usulan" name="nama_usulan" required>
      </div>

      <div class="form-group">
        <label for="email">Email Calon Rekomendasi:</label>
        <input type="email" id="email_usulan" name="email_usulan" required>
      </div>

	  <div class="form-group">
        <label for="hp">No. Handphone Calon Rekomendasi:</label>
        <input type="hp" id="telp" name="telp" required>
      </div>

      <div class="form-group">
		<input type="hidden" name="mod" value="referall">
		<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-sign-in fa-fw"></i> Submit Referall</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
  }

  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }
</script>

