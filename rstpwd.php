<?php
	session_start();
	include_once("setconf.php");
	loadAllModules();

	if (isset($_GET["a"]) && $_GET["a"] <> "" && isset($_GET["usr"]) && $_GET["usr"] <> "")
			header("location: "._PATHURL."/index.php?mod=rstpwd&usr=".$_GET["usr"]."&a=".$_GET["a"]);
	else {
			header("location: "._PATHURL."/index.php");
	}
	exit;
?>
