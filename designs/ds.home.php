<?php
	$dbanner=designGetBanner();
	//print_r($dbanner);
?>
<div class="row top10 bottom10">
	<!-- part slideshow -->
	<div class="col-md-12">
		<!-- mulai carousel -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
			  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			  <?php
			  for($i=1;$i<count($dbanner);$i++) {
			  ?>
			  <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>"></li>
			  <?php
			  }
			  ?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
			<?php
			$i=0;
			?>
			
			  <div class="item active">
				<img src="<?php echo _IMAGEWEBPATH;?>/<?php echo $dbanner[$i]["banner_name"]; ?>" alt="1" width="1000" height="200">
			  </div>
			<?php
			for($i=1;$i<count($dbanner);$i++) {
			?>
			  <div class="item">
				<img src="<?php echo _IMAGEWEBPATH;?>/<?php echo $dbanner[$i]["banner_name"]; ?>" alt="<?php echo $i; ?>" width="1000" height="200">
			  </div>
			<?php
			}
			?>
			</div>

			<!-- Left and right controls 
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			  <span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			  <span class="sr-only">Next</span>
			</a>
			-->
		</div>	
		<!-- end of carousel -->
	
	</div>
	<!-- end of slideshow -->	
</div>

<div class="row top10 bottom10">
	<?php
	/* bagian home ketika sudah login */
	if(isset($_SESSION["log_auth_id"]) && $_SESSION["log_auth_id"]<>"") {
	?>

<?php
    $datapplication = getDataApply();
    // Memeriksa kondisi tahap "offering"
    if (is_array($datapplication) && count($datapplication) > 0) {
        // Memeriksa kondisi tahap "offering"
        if ($datapplication[0]["candidate_apply_stage"] == "offering") {
            // Jika belum mencapai tahap "offering", tampilkan pesan dalam modal popup
            echo '<div class="modal fade" id="completionModal" tabindex="-1" role="dialog" aria-labelledby="completionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="completionModalLabel">Peringatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Anda sudah memasuki tahap Offering, silahkan lengkapi seluruh data. <a href="http://localhost/mpprecruitment/resume/" class="alert-link">Klik disini</a> untuk melengkapi.
                            </div>
                        </div>
                    </div>
                </div>';

            // Tampilkan script untuk menampilkan modal saat halaman dimuat
            echo '<script>
                    $(document).ready(function() {
                        $("#completionModal").modal("show");
                    });
                </script>';
        }
    }
?>


	<div class="col-md-8">
		<div style="background-color:#ffffff;">
			<div class="col-md-12">
			<?php
			include_once(_PATHDIRECTORY."/designs/ds.candidatestatus.php");
			?>
			</div>
		</div>
	</div>
	<div class="col-md-4" style="margin-bottom:30px;">
		<div class="container-fluid bottom10" style="background-color:#efefef;">
			<div class="row">
					<?php
						include_once(_DESIGNPATH."/ds.changepasswd.php");
					?>
			</div>
		</div>
	</div>
	<?php
	}
	else {
	/* bagian home ketika belum login */
	?>
	<div class="col-md-4">
		<div style="background-color:#ffffff;">
			<div class="col-md-12"><h3><cufonize>PT. MATAHARI PUTRA PRIMA</cufonize></h3></div>
			<div class="col-md-12">
				<p style="line-height:135%; font-size:90%; text-align:justify; margin-bottom:10px;">PT Matahari Putra Prima Tbk, together with its subsidiaries, operates a chain of retail stores. The company operates hypermarts, foodmarts, and Boston health and beauty stores. As of December 31, 2014, it operated 267 locations in Jakarta and other cities in Indonesia. The company was founded in 1958 and is headquartered in Tangerang, Indonesia. PT Matahari Putra Prima Tbk is a subsidiary of PT Multipolar Tbk.</p>
				<p class="caption_indo80 italic left0" style="line-height:135%; text-align:justify;">PT. Matahari Putra Prima Tbk, bersama anak perusahaannya, menjalankan rantai bisnis <i>retail</i>. MPPA mengoperasikan bisnis hypermarts, foodmarts, dan toko obat/kecantikan Boston. Berdasarkan data per 31 Desember 2014, MPPA mengoperasikan 267 toko di Jakarta dan beberapa kota di Indonesia. MPPA didirikan pada tahun 1958, berkantor pusat di Tangerang, Indonesia. PT. Matahari Putra Prima Tbk adalah salah satu anak perusahaan dari PT. Multipolar Tbk. </p>
			</div>
		</div>
	</div>
	<div class="col-md-4" style="margin-bottom:30px;">
		<div class="container-fluid bottom10" style="background-color:#f4fdff; border:#cccccc 1px dashed;">
			<div class="row">
					<?php
						include_once(_DESIGNPATH."/ds.featurevacancy.php");
					?>
			</div>
		</div>
	</div>
	<div class="col-md-4" style="margin-bottom:30px;">
		<div class="container-fluid bottom10" style="background-color:#fafafa; border:#cccccc 1px dashed;">
			<div class="row">
				<div class="top10 bottom10 left10 right10" style="height:350px;">
					<div class="col-md-12">
						<h3><cufonize><i class="fa fa-lock"></i>&nbsp;LOGIN</cufonize></h3>
					</div>
						
					<div class="col-md-12"><?php echo system_showAlert();?></div>
					<?php
						include_once(_DESIGNPATH."/ds.loginfrm.php");
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>