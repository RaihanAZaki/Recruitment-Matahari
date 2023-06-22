<?php
if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {
	/*
	echo "muncul ini";
	print_r($_GET);exit;*/
	
	$job_vacancy_id=(isset($_GET["job_vacancy_id"]) && $_GET["job_vacancy_id"]<>"")?decoded($_GET["job_vacancy_id"]):"";
	$candidate_apply_stage=(isset($_GET["candidate_apply_stage"]) && $_GET["candidate_apply_stage"]<>"")?decoded($_GET["candidate_apply_stage"]):"";
	$send_for_screening=(isset($_GET["send_for_screening"]) && $_GET["send_for_screening"]<>"")?explode("|",decoded($_GET["send_for_screening"])):"";
	
	$datavacancy=admin_getJobAdv($job_vacancy_id,"detail");
	
	//print_r($send_for_screening);exit;
?>
<div class="top10 bottom10 left10 right10">

	<div class="col-md-12"><?php echo system_showAlert();?></div>
	
	<div class="col-md-12">
		<form name="frmsendtouser" id="frmsendtouser" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
		<?php	
		$urut=1;
		$adafile=0;
		for($i=0;$i<count($send_for_screening);$i++) {
			$dataresume=admin_getDetailCandidate($send_for_screening[$i]);
			//$namafile=str_replace(" ","_",$dataresume[$i]["candidate_name"])."_FullResume.pdf";
			if(file_exists (_DIRFILES."/cand_cv_to_user/".str_replace(" ","_",$dataresume[0]["candidate_name"])."_FullResume.pdf")) {						
		?>
		<div class="form-group">
			<label for="filecv[<?php echo $i;?>]" class="control-label col-md-3">Attached File <?php echo $urut;?>: </label>				
			<div class="col-md-5">
			  <input type="text" name="filecv[<?php echo $i;?>]" class="form-control col-md-12 validate[required]" value="<?php echo str_replace(" ","_",$dataresume[0]["candidate_name"])."_FullResume.pdf";?>" readonly="readonly">
			</div>
		</div>	
		<?php
			$adafile++;
			}
		$urut++;
		}
		
		if(file_exists (_DIRFILES."/cand_cv_to_user/Candidate_".$datavacancy[0]["job_vacancy_name"]."_".$job_vacancy_id.".xls")) {
		?>
		<div class="form-group">
			<label for="filecv[<?php echo $i-1;?>]" class="control-label col-md-3">Attached File <?php echo $urut-1;?>: </label>				
			<div class="col-md-5">
			  <input type="text" name="filecv[<?php echo $i-1;?>]" class="form-control col-md-12 validate[required]" value="Candidate_<?php echo $datavacancy[0]["job_vacancy_name"]."_".$job_vacancy_id.".xls";?>" readonly="readonly">
			</div>
		</div>	
		<?php
		}
		?>
		
		<div class="form-group">
			<label class="control-label col-md-3">Send to user</label>
			<div class="col-md-8">
								<table  class="table small-text" id="tb_user">
									<tr class="tr-header">
										<th>Barcode</th>
										<th>Name</th>
										<th>Email</th>
										<th><button type="button" class="btn btn-success btn-xs" id="user_add"><i class="fa fa-plus"></i> Add</button></th>
									</tr>
									<tr style="display:none;">
										<td><input type="text" name="user_barcode[]" class="form-control"></td>
										<td><input type="text" name="user_name[]" class="form-control"></td>
										<td><input type="text" name="user_email[]" class="form-control"></td>
										<td><a href='javascript:void(0);'  class='user_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
									</tr>
									
									<tr>
										<td><input type="text" name="user_barcode[]" class="form-control"></td>
										<td><input type="text" name="user_name[]" class="form-control"></td>
										<td><input type="text" name="user_email[]" class="form-control"></td>
										<td><a href='javascript:void(0);'  class='user_rem'><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button></a></td>
									</tr>
								</table>
									
									
									
			</div>
		</div>
		
		<div class="form-group">
			<label for="message" class="control-label col-md-3">Additional message: </label>		
			<div class="col-md-8">
				  <textarea name="message" id="message" class="form-control col-md-12 validate[required]" placeholder="Additional Message here" aria-describedby="message" class="summernote">
					Dear Sirs/ Madams,<br>
					We need your consideration to suggest whether or not our shortlisted candidate be invited to the further process (psychotest).<br>
					Attached are CV(s) and an excel files. Kindly review the CV(s) and give your reccomendation using the attached excel file.<br>
					Simply type <b>Y</b> on column <i>&quot; Pass to the next step? (Y/N) &quot;</i> if you think that the corresponding candidate is eligible for further process, and type <b>N</b> if you believe that the corresponding candidate is not qualified for further process.<br>
					Please send the excel file back to us when You have completed the file with your reccomendation.<br><br>
					Sincerely yours,<br>
					Recruiter Team.
				  </textarea>
			</div>
		</div>		
				
		<div class="form-group bottom10">
			<div class="col-md-offset-3 col-md-8">
				<div class="input-group">
					<input type="hidden" name="mod" value="adm_emailCvToUser">
					<input type="hidden" name="job_vacancy_id" value="<?php echo $job_vacancy_id;?>">
					<input type="hidden" name="candidate_apply_stage" value="<?php echo $candidate_apply_stage;?>">
					
					<?php
					if($adafile>0) {
					?>
					<button type="submit" class="btn btn-success btn-md"><i class="fa fa-paper-plane fa-fw"></i> Send</button>
					<?php
					}
					else {
					?>
					<a href="<?php echo _PATHURL;?>/index.php?mod=listperstage&job_vacancy_id=<?php echo coded($job_vacancy_id);?>&candidate_apply_stage=<?php echo coded($candidate_apply_stage);?>&mess=<?php echo coded("CV is not ready. Please try again later.");?>" class="btn btn-danger btn-md" >COULD NOT FIND CV OF THE SHORTLISTED CANDIDATE. BACK TO THE LIST</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>


		</form>
	</div>
	
</div>
<script>
$(function(){
    $('#user_add').on('click', function() {
              var data = $("#tb_user tr:eq(1)").clone(true).show().appendTo("#tb_user");
              data.find("input").val('');
     });
     $(document).on('click', '.user_rem', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>2) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#message').summernote({
	  toolbar: [
		//[groupname, [button list]]
		['para', ['ul', 'ol']]
	  ],
	  height: 150,
	  width: 700
	});
});
</script>

<script>
$(document).ready(function(){
    $("#frmsendtouser").validationEngine();
   });
</script>	
<?php	
}
?>