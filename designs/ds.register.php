<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
 };
</script> 
<?php
/* register_id, candidate_name, candidate_email, candidate_passwd, candidate_birthplace, candidate_birthdate, candidate_nationality, 
candidate_country, candidate_idtype, candidate_idcard, candidate_hp1, candidate_hp2, candidate_phone, register_date, register_activation_code
*/
//$datacity=getCity();
//print_r($_SESSION["session"]);

//$place_of_birth=(isset($_SESSION["session"]["place_of_birth"][0]))?$_SESSION["session"]["place_of_birth"][0]:"";
?>
<div class="panel panel-info" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-user"></i>&nbsp;Basic Information</cufonize></h2>
		<div class="caption_indo">Informasi dasar</div>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">		
	
		<div><?php echo system_showAlert();?></div>
		
		<form class="form-horizontal" name="registerform" id="registerform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" accept-charset="utf-8">

			<div class="form-group">
				<div class="col-md-12 top10">
				<ul>
					<li>Make sure to <b>input all data correctly</b>. Once submitted, the information you fill in this registration form <b>IS NOT EDITABLE</b>.</li>
						<div class="caption_indo80 italic novpadding left0">Pastikan untuk memasukkan semua data dengan benar. Anda <b>TIDAK DAPAT MELAKUKAN REVISI DATA setelah menekan tombol REGISTER ( DAFTAR )</b>.</div>
					<li class="top10">Ensure that the email address is correct and accessible so that account activation is possible.</li>
						<div class="caption_indo80 italic novpadding left0">Pastikan Alamat Email yang Anda daftarkan dalam form ini ditulis dengan benar dan masih aktif, sehingga proses aktivasi akun dapat dilakukan.</div>
				</ul>
				</div>
				
			</div>
		
			<div class="form-group">
				<div style="text-align:right;" class="col-md-12 top30 asterisk">* <i><b>is required (wajib diisi)</b></i> </div>
			</div>
		

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Email address &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Alamat email</div>
				</div>
				<div class="col-md-4">
					<input type="email" class="form-control validate[required,custom[email]]" name="email1" id="email1" title="Masukkan alamat email Anda yang masih aktif" placeholder="Enter your valid email" value="<?php echo (isset($_SESSION["session"]["email1"]))?$_SESSION["session"]["email1"]:"";?>" >
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Retype email address &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Tulis ulang alamat email Anda</div>
				</div>
				<div class="col-md-4">
					<input type="email" class="form-control validate[required,custom[email],equals[email1]]" name="email2" id="email1" placeholder="Retype your valid email" title="Tulis ulang alamat email Anda yang masih aktif" value="<?php echo (isset($_SESSION["session"]["email2"]))?$_SESSION["session"]["email2"]:"";?>">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Full name &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Nama lengkap sesuai KTP</div>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control validate[required]" name="full_name" title="Masukkan nama lengkap Anda" id="full_name" placeholder="Enter your Full Name as shown on your ID Card" value="<?php echo (isset($_SESSION["session"]["full_name"]))?$_SESSION["session"]["full_name"]:"";?>">
				</div>
				<span><small class="text-info"><i>(As shown on ID Card)</i></small></span>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Password &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Kata kunci</div>
				</div>
				<div class="col-md-4">
					<input type="password" class="form-control validate[required,minSize[6]]" name="pwd1" id="pwd1" title="Minimal 6 karakter" placeholder="Minimum 6 characters">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Retype password &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Tulis ulang kata kunci</div>
				</div>
				<div class="col-md-4">
					<input type="password" class="form-control validate[required,equals[pwd1]]" name="pwd2" id="pwd2" title="Tulis ulang kata kunci" placeholder="Retype password">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Cellular number &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Nomor telepon genggam</div>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control validate[required, custom[phone]]" name="cellphone1" id="cellphone1" title="Masukkan nomor telepon genggam Anda" placeholder="Enter your cellular phone number" value="<?php echo (isset($_SESSION["session"]["cellphone1"]))?$_SESSION["session"]["cellphone1"]:"";?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3">
					<div class="right bold">Curriculum vitae &nbsp;<span class="asterisk">*</span></div>
					<div class="right caption_indo80 novpadding" style="padding-right:15px;">Riwayat hidup</div>
				</div>
				<div class="col-md-4">
				<input type="file" class="form-control" name="curriculum" id="curriculum" accept=".pdf" value="<?php echo (isset($_SESSION["session"]["curriculum"]))?$_SESSION["session"]["curriculum"]:"";?>">
				</div>
			</div>

		

			<?php
			if(_WITHCAPTCHA=="y") {
			?>	
			<div class="form-group">

					<div class="col-md-3">
						<div class="right bold">Security code &nbsp;<span class="asterisk">*</span></div>
						<div class="right caption_indo80 novpadding" style="padding-right:15px;">Kode keamanan</div>
					</div>
					
					<div class="col-md-4">
					
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
			}?>
			
			<div class="form-group"> 
				<div class="col-md-offset-3 col-md-4">
				<input type="hidden" name="mod" value="register_signUp"/>
					<button type="submit" class="btn btn-success" onclick="confirm('Are you sure to save the data now? You can not modify once you submit the data.\n Apakah semua data telah Anda masukkan dengan benar? Semua data yang Anda masukkan tidak bisa diubah setelah Anda klik OK.');">REGISTER ( DAFTAR )</button>
				</div>
			</div>
		</form>				
	</div>
	<!-- akhir panel body -->
	
</div>
<script type="text/javascript">
$(function() {

	$('#birthplace').magicSuggest({
	    resultAsString: true,
		required: true,
	    maxSelection: 1,
	    data: '<?php echo _PATHURL;?>/application/api.city.php',
		name: 'place_of_birth',
		<?php
		if(isset($_SESSION["session"]["place_of_birth"]) && $_SESSION["session"]["place_of_birth"]<>"") {
		?>
		value: ['<?php echo $_SESSION["session"]["place_of_birth"];?>'],
		<?php
		}
		else {
		?>
		placeholder: 'Please choose from the available list',
		<?php
		}
		?>		
		valueField: 'city_name',
	    displayField: 'city_name'
	});	
	
	$('#birthdate').datepicker({
		format:"dd-mm-yyyy"
	});
	

});
</script>


<script>
$(document).ready(function(){
    $("#registerform").validationEngine();
   });
</script>


<script type="text/javascript">
$(document).ready(function(){
	
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="wni"){
            $("#partwni").show();
			$("#nomor_ktp").addClass(" validate[required,minSize[16],maxSize[16]]");
			$("#nomor_ktp").removeAttr("disabled");
			
            $("#partwna").hide();
			$("#nomor_passport").attr("disabled", "disabled");
			$("#country").attr("disabled", "disabled");			
			
        }
        if($(this).attr("value")=="wna"){
            $("#partwni").hide();
			$("#nomor_ktp").attr("disabled", "disabled")
			
            $("#partwna").show();
			$("#nomor_passport").addClass(" validate[required]");
			$("#country").addClass(" validate[required]");			
			$("#nomor_passport").removeAttr("disabled");
			$("#country").removeAttr("disabled");			
			
        }
    });
});
</script>


<script>
	/**/
	jQuery(document).ready(function(){
		// binds form submission and fields to the validation engine
		jQuery("#registerform").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true});
	});
	/**/
	var dateFormat = /^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.]((?:19|20)\d\d)$/

	function checkLEGAL(field, rules, i, options){
		var match = field.val().match(dateFormat)
		console.log(match)
		if (!match) return "Please enter valid date (dd-mm-yyyy)"
		var bd=new Date(match[3], match[2]-1, match[1])
		console.log(bd)
		var diff = Math.floor((new Date).getTime() - bd.getTime());
		var day = 1000* 60 * 60 * 24

		var days = Math.floor(diff/day)
		var months = Math.floor(days/31)
		var years = Math.floor(months/12)
		console.log(days,months,years)
		if (years<16) return "You have to be at least 17 year old to register"
	}
</script>
