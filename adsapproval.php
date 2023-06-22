<?php
	session_start();
	include_once("setconf.php");
	loadAllModules();
	
	if (isset($_GET["usr"]) && $_GET["usr"] <> "")
		vacancy_updateApproval();
	exit;
?>