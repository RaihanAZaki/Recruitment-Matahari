<?php
$data=vacancy_getJobAdv("","all");
?>
<div><?php echo system_showAlert();?></div>

<div class="panel panel-default">
	<!-- Table -->
	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				<td class="col-md-1"><strong>No.</strong></td>
				<td class="col-md-2">
					<strong>Vacant Position</strong>
					<div class="caption_indo80 novpadding left0 bottom10">Lowongan untuk posisi</div>
				</td>
				<td class="col-md-2">
					<strong>Location</strong>
					<div class="caption_indo80 novpadding left0 bottom10">Lokasi</div>
				</td>
				<td class="col-md-4 hidden-xs hidden-sm">
					<strong>Brief Description</strong>
					<div class="caption_indo80 novpadding left0 bottom10">Deskripsi singkat</div>
				</td>
				<td class="col-md-2">
					<strong>Closing date</strong>
					<div class="caption_indo80 novpadding left0 bottom10">Tanggal penutupan</div>
				</td>
			</tr>
		</thead>
		<tbody>

			<?php
			$urut=1;
			for($i=0;$i<count($data);$i++) {
				$brief=strip_tags($data[$i]["job_vacancy_brief"]);
			?>
			<tr>
				<td><?php echo $urut;?></td>
				<td><a href="<?php echo _PATHURL;?>/detail/<?php echo $data[$i]["job_vacancy_id"];?>/<?php echo url_slug($data[$i]["job_vacancy_name"])?>/" class="linkbiru"><?php echo $data[$i]["job_vacancy_name"];?></a></td>
				<td><?php echo $data[$i]["job_vacancy_city"];?></td>
				<!--<td class="hidden-xs hidden-sm"> <?php echo substr($brief,0,150);?> ...</td>-->
				<td class="hidden-xs hidden-sm"> <?php echo $brief;?></td>
				<td><?php echo date("D, d M Y",strtotime($data[$i]["job_vacancy_enddate"]));?></td>
			</tr>
			<?php
				$urut++;
			}
			?>
		</tbody>
	</table>
</div>