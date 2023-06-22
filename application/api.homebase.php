<?php
	include_once("../setconf.php");
	$query = querying("SELECT city_name FROM m_homebase ORDER BY city_name ASC");
	$data = sqlGetData($query);
	echo json_encode($data);
?>