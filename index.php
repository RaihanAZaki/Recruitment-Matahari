<?php
	ini_set("display_errors",1);
	session_start();
	// System
	//include( dirname(__FILE__) . "/includes/phpschdlr/firepjs.php");
	//exit;
	include_once("setconf.php");
	loadAllModules();

	$usrRequest = array();
	$usrRequest = system_initiateRequest();
	
	
	//exit;

	//print_r($_SESSION);
	// template admin
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==1 && isset($_SESSION["priv_id"]) && in_array($_SESSION["priv_id"],array("admin","hrd","pic"))) //admin template
	{
		$menuadm = system_getMenu();
		$titleadm = (isset($menuadm[0]["menu_title"]) && $menuadm[0]["menu_title"]<>"" )?$menuadm[0]["menu_title"]." | ":"";

		include_once(_PATHDIRECTORY."/designadm/adm.head.php");
		include_once(_PATHDIRECTORY."/designadm/adm.body.php");
		include_once(_PATHDIRECTORY."/designadm/adm.footer.php");
	}
	else //template candidate
	{ 
		// tampilkan menu yang dipilih
		$menu = system_getMenu();
		//print_r($menu);
		//print_r($_SESSION);
		$title = (isset($menu[0]["menu_title"]) && $menu[0]["menu_title"]<>"" )?$menu[0]["menu_title"]." | ":"";
			
		include(_DESIGNPATH."/ds.head.php");
		include(_DESIGNPATH."/ds.body.php");
		include(_DESIGNPATH."/ds.footer.php");
	}
?>