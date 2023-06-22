<?php
	include_once("../setconf.php");
	$query = querying("SELECT Race FROM Race ORDER BY Race ASC");
	$data = sqlGetData($query);
	echo json_encode($data);
?>