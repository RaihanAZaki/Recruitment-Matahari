<?php
	if (!isset($_GET["a"]) || $_GET["a"] == "" || !isset($_GET["usr"]) || $_GET["usr"] == "") {
	include_once(_PATHDIRECTORY."/system.unauthorized.php");
	exit;
	}
?>
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
</script> 
<div class="top10 bottom10 left10 right10">

	<div class="col-md-12"><?php echo system_showAlert();?></div>
	
	<div class="col-md-12">
		<form name="resetpasswd" id="resetpasswd" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
						
		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="passwd" id="passwd"><i class="fa fa-key"></i></span>
				  <input type="password" name="newpass" id="newpass" class="form-control col-md-12 validate[required]" placeholder="New password" aria-describedby="passwd">
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="passwd2" id="passwd2"><i class="fa fa-key"></i></span>
				  <input type="password" name="newpass2" id="newpass2" class="form-control col-md-12 validate[required,equals[newpass]]" placeholder="Retype new password" aria-describedby="passwd2">
				</div>
			</div>
		</div>
		
		
		<?php
		if(_WITHCAPTCHA=="y") {
		?>	
		<div class="form-group">

			<div class="col-sm-12">
				<div id="recaptcha_widget" style="display:none">

					<div id="recaptcha_image"></div>
					<div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>

					<!-- <span class="recaptcha_only_if_image">Enter the words above:</span>
					<span class="recaptcha_only_if_audio">Enter the numbers you hear:</span> -->
					<div class="row">
						<div class="col-md-10">
							<div class="input-group input-group-sm">
								<span class="input-group-addon" name="captcha" id="captcha"><i class="fa fa-exclamation-circle"></i></span>
								<input type="text" class="form-control col-md-12" placeholder="Enter the words above" id="recaptcha_response_field" name="recaptcha_response_field"  aria-describedby="captcha" />
							</div>
						</div>
					</div>
					
					<div><a href="javascript:Recaptcha.reload()">Reload Code</a> &nbsp; &nbsp; &nbsp; <!-- <a href="javascript:Recaptcha.showhelp()">Help</a> --></div>
					<!-- <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div> 
					<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div> -->


				</div>

				<script type="text/javascript"
					src="http://www.google.com/recaptcha/api/challenge?k=6Lcrf8YSAAAAAOjXnxbByfFZC7vOAhv3eWD3T4-8">
				</script>
				<noscript>
					<iframe src="http://www.google.com/recaptcha/api/noscript?k=6Lcrf8YSAAAAAOjXnxbByfFZC7vOAhv3eWD3T4-8"
						width="100%" frameborder="0"></iframe><br>
					<textarea name="recaptcha_challenge_field" rows="3" cols="40">
					</textarea>
					<input type="hidden" name="recaptcha_response_field"
						value="manual_challenge">
				</noscript>
				
				
				
			</div>


		</div>
		<?php
		}
		?>
		
		<div class="form-group bottom10">
			<div class="col-md-6">
				<div class="input-group">
					<input type="hidden" name="mod" value="candidate_resetPasswd">
					<input type="hidden" name="register_activation_date" value="<?php echo decoded($_GET["a"]);?>"/>
					<input type="hidden" name="log_auth_name" value="<?php echo decoded($_GET["usr"]);?>"/>
				  
				  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-sign-in fa-fw"></i> RESET PASSWORD</button>
				</div>
			</div>
		</div>


		</form>
	</div>
</div>
<script>
$(document).ready(function(){
    $("#resetpasswd").validationEngine();
   });
</script>