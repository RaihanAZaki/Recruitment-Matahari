<?php
	include_once("../setconf.php");
	$query = querying("SELECT EduMjrName FROM EduMajor ORDER BY EduMjrName ASC");
	$data = sqlGetData($query);
	echo json_encode($data);
?>