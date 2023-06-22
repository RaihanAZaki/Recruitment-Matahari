<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<title>MPP :: eRecruitment System</title>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo _PATHURL;?>/includes/js/jquery_1_11_1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo _PATHURL;?>/includes/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/js/cufon-yui.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/js/Futura_Bk_BT_400.font.js"></script>

	<script type="text/javascript" src="<?php echo _PATHURL;?>/incadm/js/scripts.js"></script>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/magicsuggest/magicsuggest.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/validationengine/js/jquery.validationEngine.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/validationengine/js/jquery.validationEngine-<?php echo _DEFAULTLANG;?>.js"></script>
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/datepicker/js/bootstrap-datepicker.min.js"></script> 

	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/touchspin/jquery.bootstrap-touchspin.js"></script> 
	<script type="text/javascript" src="<?php echo _PATHURL;?>/includes/summernote/summernote.min.js"></script> 
	
	<script type="text/javascript">  
		Cufon.replace('cufonize');
	</script>

    
    <link href="<?php echo _PATHURL;?>/includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/css/primary.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/css/navbar.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/incadm/css/styles.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/font-awesome-4.4.0/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo _PATHURL;?>/includes/magicsuggest/magicsuggest.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/validationengine/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo _PATHURL;?>/includes/summernote/summernote.css" rel="stylesheet" type="text/css">
	
	
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="#">MPP eRecruitment</a>
			</div>
			<div class="navbar-collapse collapse">			  
				<ul class="nav navbar-nav navbar-right nopadding">
				<?php
				if(isset($_SESSION["log_auth_id"]) && isset($_SESSION["log_auth_name"]) && isset($_SESSION["priv_id"]) && $_SESSION["priv_id"]=="admin" ) {
					$sprmenu=admin_getSprMenu();
					for($i=0;$i<count($sprmenu);$i++) {
						echo "<li ".((isset($_GET["mod"]) && $_GET["mod"]==$sprmenu[$i]["menu_name"])?" class='active' ":"")."><a href=\""._PATHURL."/".url_slug($sprmenu[$i]["menu_name"])."/\"><i class=\"fa ".$sprmenu[$i]["menu_icon"]." fa-fw\"></i>&nbsp;".$sprmenu[$i]["menu_title"]."</a></li>";
					}
				}
				?>
					<li class="dropdown">
						<a href="#" style="background-color:#fe8992; color:#ffffff;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $_SESSION["log_auth_name"];?><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo _PATHURL;?>/admchangepwd/">Change Password</a></li>
							<li><a href="<?php echo _PATHURL;?>/logout.php">LOGOUT</a></li>
						</ul>
					</li>
					
				</ul>			  
			</div>
		  </div>
	</nav>

	<div class="container-fluid">
		  
		<div class="row row-offcanvas row-offcanvas-left">
			
			<div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
					<!-- awal bagian adm primary menu -->
						<?php 
						include(_PATHDIRECTORY."/designadm/adm.primarymenu.php");
						?>
					<!-- akhir bagian adm primary menu -->
			</div>