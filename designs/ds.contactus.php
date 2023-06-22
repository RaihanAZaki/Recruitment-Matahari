<script type="text/javascript">
  var RecaptchaOptions = {
    theme: 'custom',
    custom_theme_widget: 'recaptcha_widget'
  };
</script>

<!--
<div>
  <p><?php echo sha256mod("5004Giovanni_Uchiha@live.comKiRa777");?></p>
</div>
-->

<div class="top10 bottom10 left10 right10">
  <div class="col-md-12"><?php echo system_showAlert();?></div>

  <div class="col-md-7">
  <form name="frmcontact" id="frmcontact" method="post" action="<?php echo _PATHURL;?>/letsprocess.php" class="form-horizontal" role="form">
      <div class="form-group">
        <div class="col-md-4">
          <div class="right bold">Registered email</div>
          <div class="right caption_indo80">Email yang terdaftar</div>
        </div>
        <div class="col-md-8">
          <input type="text" name="email" id="email" class="form-control col-md-12 validate[required,custom[email]]" placeholder="Your registered email" aria-describedby="email" value="<?php echo (isset($_SESSION["log_auth_name"]) && $_SESSION["log_auth_name"]<>"") ? $_SESSION["log_auth_name"] : ""; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-4">
          <div class="right bold">Subject</div>
          <div class="right caption_indo80">Subyek/tema</div>
        </div>
        <div class="col-md-8">
          <div class="input-group input-group-md" id="subject">
            <ul class="list-group">
              <li class="list-group-item">
                <div style="float:left; width:20px"><input type="checkbox" name="a" value="a"></div>
                <div style="float:left; width:300px">Can not modify basic information on personal page.</div>
                <div style="clear:both;"></div>
                <div style="float:left; width:20px;">&nbsp;</div>
                <div style="float:left; width:300px; text-align:left; font-size:80%; font-style:italic;">Tidak dapat mengubah informasi di halaman personal</div>
                <div style="clear:both;"></div>
              </li>
              <li class="list-group-item">
                <div style="float:left; width:20px"><input type="checkbox" name="b" value="b"></div>
                <div style="float:left; width:300px">Can not upload files on "Upload documents" page.</div>
                <div style="clear:both;"></div>
                <div style="float:left; width:20px;">&nbsp;</div>
                <div style="float:left; width:300px; text-align:left; font-size:80%; font-style:italic;">Tidak dapat mengunggah dokumen di halaman Unggah documents</div>
                <div style="clear:both;"></div>
              </li>
              <li class="list-group-item">
                <div style="float:left; width:20px"><input type="checkbox" name="c" value="c"></div>
                <div style="float:left; width:300px">Application status Reject, does it mean that I am not qualified for the position?</div>
                <div style="clear:both;"></div>
                <div style="float:left; width:20px;">&nbsp;</div>
                <div style="float:left; width:300px; text-align:left; font-size:80%; font-style:italic;">Status aplikasi ditolak, apakah ini berarti saya tidak memenuhi syarat?</div>
                <div style="clear:both;"></div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-4">
          <div class="right bold">Message</div>
          <div class="right caption_indo80">Pesan</div>
        </div>
        <div class="col-md-8">
          <textarea name="message" id="message" class="form-control col-md-12 validate[required]" rows="7" placeholder="Your message"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-4">
          <div class="right bold">&nbsp;</div>
          <div class="right caption_indo80">&nbsp;</div>
        </div>
        <div class="col-md-8">
          <div id="recaptcha_widget" style="display:none">
            <div id="recaptcha_image"></div>
            <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect. Please try again.</div>

            <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="form-control col-md-12" placeholder="Recaptcha" autocomplete="off">

            <div><a href="javascript:Recaptcha.reload()">Reload</a> | <a class="recaptcha_only_if_image" href="javascript:Recaptcha.switch_type('audio')">Audio</a> | <a class="recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')">Image</a> | <a href="javascript:Recaptcha.showhelp()">Help</a></div>
          </div>

          <script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6Lcrf8YSAAAAAOjXnxbByfFZC7vOAhv3eWD3T4-8"></script>
          <noscript>
            <iframe src="https://www.google.com/recaptcha/api/noscript?k=6Lcrf8YSAAAAAOjXnxbByfFZC7vOAhv3eWD3T4-8" height="300" width="500" frameborder="0"></iframe><br>
            <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
            <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
          </noscript>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
        <input type="hidden" name="mod" value="system_contactUs">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="col-md-1"></div>
	<div class="col-md-4">
		<div style="line-height:150%">
			<h3>PT. Matahari Putra Prima Tbk</h3>
			<div>17th Floor Menara Matahari<br>Jl. Boulevard Palem Raya No. 7<br>Lippo Karawaci 1200<br>Tangerang 15811<br><i class="fa fa-phone fa-fw"></i> (021) 546 9333 / 547 9333<br><i class="fa fa-fax fa-fw"></i> (021) 547 5673</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $("#frmcontact").validationEngine();
   });
</script>
