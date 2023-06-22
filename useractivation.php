<?php
	session_start();
	include_once("setconf.php");
	loadAllModules();
	
	if (isset($_GET["a"]) && $_GET["a"] <> "" && isset($_GET["usr"]) && $_GET["usr"] <> "")
		register_executeActivation();
	exit;
?>