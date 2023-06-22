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
<div class="panel panel-default" style="margin-bottom:30px;">
	<div class="panel-heading">
		<h2 class="panel-title"><cufonize><i class="fa fa-user"></i>&nbsp;Registration Form: Basic Information</cufonize></h2>
	</div>
	
	<!-- awal panel body -->
	<div class="panel-body" style="line-height:150%; text-align:justify;">		
	
		<div><?php echo system_showAlert();?></div>
		
		<form class="form-horizontal" name="registerform" id="registerform" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" role="form" accept-charset="utf-8">
		
			<div class="form-group">
				<div style="text-align:right;" class="col-md-12 top30 asterisk">* <i><b>is required (mandatory field)</b></i> </div>
			</div>
		

			<div class="form-group">
				<label class="control-label col-md-3" for="email1">Email address: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="email" class="form-control validate[required,custom[email]]" name="email1" id="email1" placeholder="Enter candidate valid email" value="<?php echo (isset($_SESSION["session"]["email1"]))?$_SESSION["session"]["email1"]:"";?>" >
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="email1">Retype Email address: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="email" class="form-control validate[required,custom[email],equals[email1]]" name="email2" id="email2" placeholder="Retype candidate valid email" value="<?php echo (isset($_SESSION["session"]["email2"]))?$_SESSION["session"]["email2"]:"";?>">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="full_name">Full name: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="text" class="form-control validate[required]" name="full_name" id="full_name" placeholder="Enter candidate Full Name as shown on candidate ID Card" value="<?php echo (isset($_SESSION["session"]["full_name"]))?$_SESSION["session"]["full_name"]:"";?>">
				</div>
				<span><small class="text-info"><i>(As shown on ID Card)</i></small></span>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="pwd1">Password: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="password" class="form-control validate[required,minSize[6]]" name="pwd1" id="pwd1" placeholder="Minimum 6 characters">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3" for="pwd2">Retype password: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="password" class="form-control validate[required,equals[pwd1]]" name="pwd2" id="pwd2" placeholder="Retype password">
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="birthplace">Place of birth: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<div class="button-group">
						<input name="place_of_birth" id="birthplace" class="form-control validate[required]">
					</div>
				</div>
				<span><small class="text-info"><i>(As shown on ID Card)</i></small></span>

			</div>

			<div class="form-group">
				<label class="control-label col-md-3" for="birthdate">Date of birth: &nbsp;<span class="asterisk">*</span></label>

				<div class="col-md-4">
					<input type="text" id="birthdate" placeholder="dd-mm-yyyy" name="birthdate" class="form-control validate[required,funcCall[checkLEGAL]] date" value="<?php echo (isset($_SESSION["session"]["birthdate"]))?$_SESSION["session"]["birthdate"]:"";?>">
				</div>
				<span><small class="text-info"><i>(As shown on ID Card)</i></small></span>

			</div>
			
			<div class="form-group">
				<label class="control-label col-md-3" for="sex">Gender: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<label class="radio-inline"><input type="radio" name="sex" id="male" value="male" class="validate[required]"  <?php echo (isset($_SESSION["session"]["sex"]) && $_SESSION["session"]["sex"]=="male")?"checked":"";?> >Male</label>
					<label class="radio-inline"><input type="radio" name="sex" id="female" value="female" class="validate[required]" <?php echo (isset($_SESSION["session"]["sex"]) && $_SESSION["session"]["sex"]=="female")?"checked":"";?>>Female</label>
				</div>
			</div>
			

			<div class="form-group">
				<label class="control-label col-md-3" for="full_name">Nationality: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<label class="radio-inline"><input type="radio" name="nationality" id="wni" value="wni" class="validate[required]" <?php echo (isset($_SESSION["session"]["nationality"]) && $_SESSION["session"]["nationality"]=="wni")?"checked":"";?>>Indonesian</label>
					<label class="radio-inline"><input type="radio" name="nationality" id="wna" value="wna" class="validate[required]" <?php echo (isset($_SESSION["session"]["nationality"]) && $_SESSION["session"]["nationality"]=="wna")?"checked":"";?>>Expatriat</label>
				</div>
			</div>
			<!-- muncul jika pilih WNI -->
			<div id="partwni" class="form-group" style="<?php echo (isset($_SESSION["session"]["nationality"]) && $_SESSION["session"]["nationality"]=="wni")?"":"display:none";?>">
				<label class="control-label col-md-3" for="nomor_ktp">ID Number (KTP): &nbsp;<span class="asterisk"></span></label>
				<div class="col-md-4">
				<input type="text" class="form-control " name="nomor_ktp" id="nomor_ktp" pattern="\d{16}" title="masukkan nomor KTP Anda yang masih berlaku" placeholder="Please enter your valid ID Number" value="<?php echo (isset($_SESSION["session"]["nomor_ktp"]) && $_SESSION["session"]["nomor_ktp"]<>"")?$_SESSION["session"]["nomor_ktp"]:"";?>">
				</div>
			</div>

			<!-- muncul jika pilih WNA -->
			<div id="partwna" class="form-group" style="<?php echo (isset($_SESSION["session"]["nationality"]) && $_SESSION["session"]["nationality"]=="wna")?"":"display:none";?>">
				<label class="control-label col-md-3" for="country">Country: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="text" class="form-control" name="country" id="country" placeholder="Country of origin" value="<?php echo (isset($_SESSION["session"]["country"]))?$_SESSION["session"]["country"]:"";?>">
				</div>
			
				<label class="control-label col-md-2" for="nomor_passport">Passport Number: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-3">
					<input type="text" class="form-control" name="nomor_passport" id="nomor_passport" placeholder="Please enter candidate valid Passport Number" value="<?php echo (isset($_SESSION["session"]["nomor_passport"]))?$_SESSION["session"]["nomor_passport"]:"";?>">
				</div>
			</div>
			<!-- akhir part WNA -->
			
			<div class="form-group">
				<label class="control-label col-md-3" for="cellphone1">Cellular number: &nbsp;<span class="asterisk">*</span></label>
				<div class="col-md-4">
					<input type="text" class="form-control validate[required, custom[phone]]" name="cellphone1" id="cellphone1" placeholder="Enter candidate cellular phone number" value="<?php echo (isset($_SESSION["session"]["cellphone1"]))?$_SESSION["session"]["cellphone1"]:"";?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3" for="cellphone2">Cellular number 2:</label>
				<div class="col-md-4">
					<input type="text" class="form-control validate[custom[phone]]" name="cellphone2" id="cellphone2" placeholder="Enter candidate secondary cellular number" value="<?php echo (isset($_SESSION["session"]["cellphone2"]))?$_SESSION["session"]["cellphone2"]:"";?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3" for="homephone">Home phone number:</label>
				<div class="col-md-4">
					<input type="text" class="form-control validate[custom[phone]]" name="homephone" id="homephone" placeholder="Enter candidate home phone number" value="<?php echo (isset($_SESSION["session"]["homephone"]))?$_SESSION["session"]["homephone"]:"";?>">
				</div>
			</div>

			<input type="hidden" name="mod" value="admin_registerCandidate"/>
			
			
			<div class="form-group"> 
				<div class="col-md-offset-3 col-md-4">
					<button type="submit" class="btn btn-success">REGISTER</button>
				</div>
				<div class="col-md-5" style="text-align:right;"><a href="<?php echo _PATHURL;?>/index.php?mod=candidatebyrecruiter" class="btn btn-warning"><i class="fa fa-undo">&nbsp;</i>&nbsp; Candidate registered by Recruiter</a>
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

<!--
<script>
$(document).ready(function(){
    $("#registerform").validationEngine();
   });
</script>
-->

<script type="text/javascript">
$(document).ready(function(){
	
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="wni"){
            $("#partwni").show();
			/*$("#nomor_ktp").addClass(" validate[required,minSize[16],maxSize[16]]");*/
			$("#nomor_ktp").removeAttr("disabled");
			
            $("#partwna").hide();
			$("#nomor_passport").attr("disabled", "disabled");
			$("#country").attr("disabled", "disabled");			
			
        }
        if($(this).attr("value")=="wna"){
            $("#partwni").hide();
			$("#nomor_ktp").attr("disabled", "disabled")
			
            $("#partwna").show();
			/*$("#nomor_passport").addClass(" validate[required]");*/
			$("#country").addClass(" validate[required]");			
			$("#nomor_passport").removeAttr("disabled");
			$("#country").removeAttr("disabled");			
			
        }
    });
});
</script>

<script type="text/javascript">
var nomorKTP = $("#nomor_ktp").val();
if (!nomorKTP.match(/^\d{16}$/)) {
    // Menampilkan pesan error atau tindakan lainnya
}
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
