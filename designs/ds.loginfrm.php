<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
</script> 



	
	<div class="col-md-12">
		<form name="loginfrm" id="loginfrm" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
		
		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="username" id="username"><i class="fa fa-envelope"></i></span>
				  <input type="text" name="usrname" id="usrname" class="form-control col-md-12 validate[required,custom[email]]" onchange="checkmail()" placeholder="email" aria-describedby="username">
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-10">
				<div class="input-group input-group-sm">
				  <span class="input-group-addon" name="password" id="password"><i class="fa fa-key"></i></span>
				  <input type="password" name="passwd" id="passwd" class="form-control col-md-12 validate[required]" placeholder="password" aria-describedby="password">
				</div>
			</div>
		</div>

		<div id="partnik" style="display:none;">
			<div class="form-group">
				<div class="col-md-10">
					<div class="input-group input-group-sm">
					  <span class="input-group-addon" name="nik" id="nik"><i class="fa fa-barcode"></i></span>
					  <input type="text" name="emp_nik" id="emp_nik" class="form-control col-md-12" placeholder="NIK" disabled="disabled" aria-describedby="nik">
					</div>
				</div>
			</div>
		</div>
		
		
		<?php
		if(_WITHCAPTCHA=="y") {
		?>	
		<div class="form-group">

			<div class="col-sm-12">
				<!-- ini jalan ok 
				<div id="recaptcha1">
								<script type="text/javascript">
											 var RecaptchaOptions = {
												theme : 'white'
											 };
								</script>
								  <?php /* ini harus dibuka kalo mo pake captcha */
									include_once(_PATHDIRECTORY."/includes/recaptcha/recaptchalib.php");
									$publickey = "6Lcrf8YSAAAAAOjXnxbByfFZC7vOAhv3eWD3T4-8"; // you got this from the signup page
									echo recaptcha_get_html($publickey,NULL,1);
									/**/
								  ?>
				</div>
				-->
				
				<div id="recaptcha_widget" style="display:none">

					<div id="recaptcha_image"></div>
					<div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again <i>(Kode salah, silakan coba lagi)</i></div>

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
		<input type="hidden" name="mod" value="system.usrlogin"/>
		<div class="form-group bottom10">
			<div class="col-md-12">
				<div class="input-group">
				  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-sign-in fa-fw"></i> LOGIN</button>&nbsp;&nbsp;<a href="<?php echo _PATHURL;?>/forgotpwd/" type="button" class="btn btn-warning btn-sm"><i class="fa fa-question-circle"></i> Forgot Password</a>
				</div>
			</div>
			<div class="col-md-12 top30">Don't have an account? <a href="<?php echo _PATHURL;?>/register/">Register Here.</a></div>
			<div class="caption_indo" style="padding-left:15px;">Belum mempunyai akun? Silakan <a href="<?php echo _PATHURL;?>/register/">Daftar di sini.</a></div>
		</div>


		</form>
	</div>


<script type="text/javascript">
function checkmail() {
	var emailnya = document.getElementById("usrname").value;
	var res = emailnya.split("@");
	
	if(res[1]=="hypermart.co.id") {
		//alert("karyawan");
		document.getElementById("partnik").style.display = "block";
		document.getElementById("emp_nik").disabled = false;
		document.getElementById("emp_nik").className += "validate[required]";		
	}
	else {
		//alert("Bukan karyawan");
		document.getElementById("partnik").style.display = "none";
		document.getElementById("emp_nik").disabled = true;
	}

};
</script>

<script>
$(document).ready(function(){
    $("#loginfrm").validationEngine();
   });
</script>