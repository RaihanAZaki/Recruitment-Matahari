<?php
$data=vacancy_getJobAdv("","featured");
//print_r($data);
?>
<div class="top10 bottom10 left10 right10" style="height:350px;">
	<div class="col-md-12">
		<h3 style="margin-bottom:0;"><cufonize><i class="fa fa-bookmark"></i>&nbsp;Latest Vacancies</cufonize></h3>
		<div class="caption_indo"  style="margin-top:0; padding-left:35px; padding-bottom:10px;" >Lowongan kerja terbaru.</div>
	</div>
			
	<div class="col-md-12 list-group">
	<?php
		if(is_countable($data) && count($data) > 0) {
			for($i=0;$i<count($data);$i++) {
			?>
			<div class="col-mod-12 bottom10">
			  <a href="<?php echo _PATHURL;?>/detail/<?php echo $data[$i]["job_vacancy_id"];?>/<?php echo url_slug($data[$i]["job_vacancy_name"])?>/" class="list-group-item linkbiru"><?php echo $data[$i]["job_vacancy_name"];?> - <i><?php echo $data[$i]["job_vacancy_city"];?></i>
			  <span class="badge" style="background-color:#60a0db;"><?php echo date("d M y",strtotime($data[$i]["job_vacancy_enddate"]));?></span>
			  </a>
			</div>
			<?php
				}
		}
	?>
	</div>			
</div>