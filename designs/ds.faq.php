<?
	function faq_getdata()
	{
		$qup = querying("SELECT faq_id, faq_question, faq_answer FROM m_faq ORDER BY faq_id ASC", array());
		$data = sqlGetData($qup);
		return $data;
	}
?>
<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/vallenato/vallenato.js"></script>
<link rel="stylesheet" href="<?php echo _PATHURL;?>/includes/vallenato/vallenato.css" type="text/css" media="screen">

<div id="accordion-container" style="margin-bottom:30px;">
					<?php
					$datafaq=faq_getdata();
					for($i=0;$i<count($datafaq);$i++) {
					?>
						<h5 class="accordion-header"><?php echo $datafaq[$i]["faq_question"];?></h5>
						<div class="accordion-content"><?php echo $datafaq[$i]["faq_answer"];?></div>
						<div style="height:10px;"></div>
					<?php
					}
					?>
</div> <!-- end Accordion 2 -->