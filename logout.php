<?php
	session_start();
	session_unset();
	session_destroy();
	
	include_once("setconf.php");
	loadAllModules();

	$usrRequest = array();
	$usrRequest = system_initiateRequest();

	header("location: "._PATHURL."/index.php?mess=".coded("You have logged out from the system. Thank You."));
	exit;
?>