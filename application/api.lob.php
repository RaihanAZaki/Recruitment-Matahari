<?php
	include_once("../setconf.php");
	$query = querying("SELECT lob_name FROM m_lob ORDER BY lob_name ASC");
	$data = sqlGetData($query);
	echo json_encode($data);
?>