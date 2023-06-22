<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>MPP :: eRecruitment System</title>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo _PATHURL;?>/includes/js/jquery_1_11_1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo _PATHURL;?>/includes/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/js/cufon-yui.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/js/Futura_Bk_BT_400.font.js"></script>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/validationengine/js/jquery.validationEngine.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/validationengine/js/jquery.validationEngine-<?php echo _DEFAULTLANG;?>.js"></script>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/touchspin/jquery.bootstrap-touchspin.js"></script> 
	
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/magicsuggest/magicsuggest.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/datepicker/js/bootstrap-datepicker.min.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/datepicker/locales/bootstrap-datepicker.id.min.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/summernote/summernote.min.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/js/add_remove_table.js"></script> 
	
	
	<script type="text/javascript">  
		Cufon.replace('cufonize');
	</script>
	
	
    <link href="<?php echo _PATHURL;?>/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/css/primary.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/css/navbar.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/font-awesome-4.4.0/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/css/carousel.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/validationengine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/magicsuggest/magicsuggest.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/touchspin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/summernote/summernote.css" rel="stylesheet" type="text/css">

	
	
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<!-- awal bagian header -->
				<div id="header">
					<div class="col-md-12" class="img-responsive"  style="padding-bottom:10px;"><img src="<?php echo _IMAGEWEBPATH;?>/logoall.jpg"></div>
					<!--<div class="col-md-4"><img src="<?php echo _IMAGEWEBPATH;?>/foodmart.jpg"></div>
					<div class="col-md-4" align="right"><img src="<?php echo _IMAGEWEBPATH;?>/boston_small.jpg"></div>-->
				</div>
				<!-- akhir bagian header -->
			</div>
			<div class="col-md-1"></div>
		</div>
		<div class="row">
				<!-- awal bagian primary menu -->
					<?php 
					include(_PATHDIRECTORY."/designs/ds.primarymenu.php");
					?>
				<!-- akhir bagian primary menu -->
		</div>