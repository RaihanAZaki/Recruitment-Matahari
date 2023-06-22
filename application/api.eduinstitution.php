<?php
	include_once("../setconf.php");
	//$query = querying("SELECT city_name FROM m_city ORDER BY city_id ASC"); //original, disabled by shakti on 2017_09_10
	$query = querying("SELECT university_name FROM m_university ORDER BY university_name ASC");
	$data = sqlGetData($query);
	echo json_encode($data);
?>