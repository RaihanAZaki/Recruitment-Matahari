<?php
session_start();
	
include("../setconf.php");

if(!isset($_SESSION["log_auth_id"]) || !isset($_SESSION["log_auth_name"]) || empty($_SESSION["log_auth_id"]) || 
empty($_SESSION["log_auth_name"]) || empty($_SESSION["priv_id"]) || !in_array($_SESSION["priv_id"],array("admin","hrd","pic")) ) {
	//header("location:index.php");
	//exit;
	include_once(_PATHDIRECTORY."/system.needlogin.php");
	exit;
}

else {
	loadAllModules();

	if(isset($_GET["candidate_id"]) && $_GET["candidate_id"]<>"") {
		
				$datachapter=getDataChapter();
				//print_r($datachapter);

				$dataquestion=getDataQuestion();
				//print_r($dataquestion);

				$dataanswer=admin_getDataAnswer(decoded($_GET["candidate_id"]));
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

				//print_r($dataquestion);

				?>

						<div><?php echo system_showAlert();?></div>
					
						<form class="form-horizontal" name="questionfrm" id="questionfrm" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form">

						<?php
						for($c=0;$c<count($datachapter);$c++) {
						?>	
						<!-- tampilkan chapternya -->
						<div id="chapter_<?php echo $c;?>">
							<span style="text-align:right; color:#aaaaaa;"><cufonize><h2>part #<?php echo $datachapter[$c]["question_chapter"];?></h2></cufonize></span>
						
							<!-- tampilkan question based on chapter -->
							
							<div class="form-group">
								<table class="table table-no-bordered">
							
							<?php
							$urut=1;
							for($q=0;$q<count($dataquestion);$q++) {
								if($datachapter[$c]["question_chapter"]==$dataquestion[$q]["question_chapter"]) {
								
								$required=($dataquestion[$q]["question_type"]=="txt_box_int" || $dataquestion[$q]["question_type"]=="txt_box_cur")?"validate[required, custom[integer],min[0],max[1000000000]]":"validate[required]";
									
									
							?>
								<tr>
									<td align="right"><?php echo $urut;?>.</td>
									<td width="50%"><?php echo clean_view($dataquestion[$q]["question_desc"]);?></td>
									<td width="45%">
									<?php					
										if($dataquestion[$q]["question_type"]=="yn_desc") {
									?>
										<div class="form-group">
											<div class="col-md-5 left30">
												<input type="radio" class="<?php echo ($dataquestion[$q]["question_required"]=="y")?$required:"";?>" name="answer[<?php echo $q;?>]" id="y_<?php echo $q;?>" value="y" <?php echo (isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="y")?"checked":"";?> >						
												<label for="y_<?php echo $q;?>">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="radio" class="<?php echo ($dataquestion[$q]["question_required"]=="y")?$required:"";?>" name="answer[<?php echo $q;?>]" id="n_<?php echo $q;?>" value="n" <?php echo (isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]=="n")?"checked":"";?>>
												<label for="n_<?php echo $q;?>">No</label>	
											</div>
											<div class="col-md-7">
												<textarea name="answer_desc[<?php echo $q;?>]" class="form-control textarea50" placeholder="Describe"><?php echo (isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"";?></textarea>
												<input type="hidden" name="answer_id[<?php echo $q;?>]" value="<?php echo (isset($dataquestion[$q]["answer_yn"]) && $dataquestion[$q]["answer_yn"]<>"")?$dataquestion[$q]["answer_id"]:"0";?>">
											</div>
										</div>
									<?php
										}
										else if($dataquestion[$q]["question_type"]=="txt_area") {
										?>
											<div class="col-md-8">
												<textarea name="answer_desc[<?php echo $q;?>]" class="form-control textarea50 <?php echo ($dataquestion[$q]["question_required"]=="y")?$required:"";?>" placeholder="Describe"><?php echo (isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"";?></textarea>
												<input type="hidden" name="answer_id[<?php echo $q;?>]" value="<?php echo (isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_id"]:"0";?>">
											</div>						
										<?php
										}
										else if($dataquestion[$q]["question_type"]=="txt_box_int" || $dataquestion[$q]["question_type"]=="txt_box_cur") {
										?>
											<div class="col-md-8">
												<input type="text" name="answer_desc[<?php echo $q;?>]" class="form-control <?php echo ($dataquestion[$q]["question_required"]=="y")?$required:"";?>" placeholder="Describe" value="<?php echo (isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_desc"]:"";?>">
												<input type="hidden" name="answer_id[<?php echo $q;?>]" value="<?php echo (isset($dataquestion[$q]["answer_desc"]) && $dataquestion[$q]["answer_desc"]<>"")?$dataquestion[$q]["answer_id"]:"0";?>">
											</div>						
										<?php
										}
										
										
									?>	
										<input type="hidden" name="question_type[<?php echo $q;?>]" value="<?php echo $dataquestion[$q]["question_type"];?>">
										<input type="hidden" name="question_id[<?php echo $q;?>]" value="<?php echo $dataquestion[$q]["question_id"];?>">
										<input type="hidden" name="question_desc[<?php echo $q;?>]" value="<?php echo $dataquestion[$q]["question_desc"];?>">
									</td>
								</tr>
									
							<?php
								$urut++;
								}
							}
							?>
								</table>
							</div>
						</div>					
						<?php	
						}
						?>
							<input type="hidden" name="mod" value="admin_editQuestionaire"/>
							<input type="hidden" name="job_vacancy_id" value="<?php echo (isset($_GET["job_vacancy_id"]))?decoded($_GET["job_vacancy_id"]):"";?>" />
							<input type="hidden" name="candidate_apply_stage" value="<?php echo (isset($_GET["candidate_apply_stage"]))?decoded($_GET["candidate_apply_stage"]):"";?>" />
							<input type="hidden" name="candidate_id" value="<?php echo (isset($_GET["candidate_id"]))?decoded($_GET["candidate_id"]):"";?>" />
							<input type="hidden" name="menu_name" value="<?php echo (isset($_GET["menu_name"]))?$_GET["menu_name"]:"";?>" />
							
							
							<div class="form-group"> 
								<div class="col-md-offset-2 col-md-4">
									<button type="submit" class="btn btn-success">SAVE AND NEXT</button>
								</div>
							</div>
						
						</form>
<?php
	}
}
?>

<script type="text/javascript">
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#questionfrm").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
</script>