<?php
	/* 
		MySQL Configuration and Setting
		by: Shakti Santoso
		date: Sept 04, 2015
	*/

	ini_set("display_errors",1);

	$server = $_SERVER['SERVER_NAME'];

	// echo ($server);exit;

	if($server=="localhost"){
		$_database["sqlhost"] = "localhost";						// local
		$_database["username"] = "root";
		$_database["password"] = "";
		$_database["databasename"] = "hypermart_mpprecruitment"; //develop
		//$_database["databasename"] = "mpprecruitment0419";
		define("_PATHURL","http://localhost/mpprecruitment");
	}
	else{
		// $_database["sqlhost"] = "localhost";						// online
		// $_database["username"] = "mpprecruitment";
		// $_database["password"] = "6e9UYNtDjNCxKPqS";
		// $_database["databasename"] = "hpm_mpprecruitment";
		// define("_PATHURL","http://recruitment.hypermart.co.id");
	}

	define("_PATHDIRECTORY",dirname(__FILE__));
	define("_PATHERRORLOG",_PATHDIRECTORY."/errorlogs");
	define("_DESIGNPATH",_PATHDIRECTORY."/designs");
	define("_DESIGNWEBPATH",_PATHURL."/designs");
	define("_INCLUDEPATH",_PATHURL."/includes");
	define("_INCLUDEDIRECTORY",_PATHDIRECTORY."/includes");
	
	define("_IMAGEWEBPATH",_DESIGNWEBPATH."/images");
	define("_CANDFILES",_PATHURL."/cand_files");
	define("_DIRFILES",_PATHDIRECTORY."/cand_files");

	define("_DATACONNTYPE",2); //1: mysql 2: mysqli

	define("_WITHCAPTCHA","n");
	define("_DEFAULTLANG","en");
	define("_MAXAPPLY",3);

	$connection_type = _DATACONNTYPE; 

	
	function cari_file($directory,$regexp="",$record=0) {
	    $root = scandir($directory);
	    foreach($root as $value)
	    {
	        if($value === '.' || $value === '..') {continue;}
	        if(is_file("$directory/$value")) 
	        {
	        	if ($regexp <> "")
	        	{
		        	preg_match($regexp, $value, $result);
		        	if (isset($result[0]) && is_array($result[0])) 
					{
						if (count($result[0]) > 0)	$hasil[]="$value";
					}
					else $hasil[]="$value";
	        	}
	        	else if ($regexp == "") $hasil[]="$value";
	        	continue;
	        }
	        if ($record == 1) foreach(cari_file("$directory/$value") as $value) $hasil[]=$value;
	    }
	    return $hasil;
	}

	//function for loading all modules from directory modules
	function loadAllModules() {
		$mod = cari_file(_PATHDIRECTORY."/modules",'/module\.([a-zA-Z0-9-_]+)\.php/');
		//print_r($module);
		for ($i=0;$i<count($mod);$i++) 
		{
			include_once(_PATHDIRECTORY."/modules/".$mod[$i]); 
			//echo _PATHDIRECTORY."/modules/".$mod[$i].'<br/>';
		}	
		
	}
	
	function connect_database($variable=array(), $connection_type=null) {
		if (!isset($connection_type) || $connection_type=="") {  
			global $connection_type;
		}
		$sql_host=(isset($variable["sqlhost"]) && $variable["sqlhost"]<>"")?$variable["sqlhost"]:$sql_host;
		$user_name=(isset($variable["username"]) && $variable["username"]<>"")?$variable["username"]:$user_name;
		$passwd = "";
		$passwd=(isset($variable["password"]) && $variable["password"]<>"")?$variable["password"]:$passwd;
		$dbname=(isset($variable["databasename"]) && $variable["databasename"]<>"")?$variable["databasename"]:$dbname;
		
		$error_message="<h2><b>Can not connect to server. Please try again later.</b></h2>";
		switch ($connection_type)
		{
			//case 2:	$connection=new mysqli($sql_host,$user_name,$passwd,$dbname) or die($error_message);break;
			case 2: $connection=mysqli_connect($sql_host,$user_name,$passwd,$dbname) or die ($error_message);break;
			
			default:$connection=mysql_connect($sql_host,$user_name,$passwd)or die($error_message);
								mysql_select_db($dbname,$connection) or die($error_message);break;
		}
		return $connection;
		
	}

	
	function query_closed($connection_type)	{
		if (!isset($connection_type)) global $connection_type;

		if ($connection_type==2) mysqli_close();
		else mysql_close();
	}
	
	
	// function querying($query_statement, $parameters=array()) {
	// 	global $connection_type;
	// 	global $activate_connection;
	// 	if ($connection_type==2) {
	// 		// echo "using mysqli";
	// 		// exit;
	// 		if ($parameters) { foreach ($parameters as &$val) { $val = mysqli_real_escape_string($activate_connection, $val); } $querying = vsprintf( str_replace("?","'%s'",$query_statement), $parameters );} 
	// 		else {$querying = $query_statement;}
	// 		$result = mysqli_query($activate_connection,$querying);
	// 		if (!$result) write_errorlogs(mysqli_error($activate_connection),2);
			
	// 	}
	// 	else {
	// 		if ($parameters) { foreach ($parameters as &$val) { $val = mysql_real_escape_string($val); } $querying = vsprintf( str_replace("?","'%s'",$query_statement), $parameters );} 
	// 		else {$querying = $query_statement;}
	// 		$result = mysql_query($querying,$activate_connection);
	// 		if (!$result) write_errorlogs(mysql_error(),2);
	// 		//echo"<br>".$query_statement;
	// 	}
	// 	return $result;	
		
	// }

	function querying($query_statement, $parameters = array()) {
		global $connection_type;
		global $activate_connection;
		
		if ($connection_type == 2) {
			if ($parameters) {
				foreach ($parameters as &$val) {
					$val = mysqli_real_escape_string($activate_connection, $val);
				}
				$querying = vsprintf(str_replace("?", "'%s'", $query_statement), $parameters);
			} else {
				$querying = $query_statement;
			}
			
			$result = mysqli_query($activate_connection, $querying);
			if (!$result) {
				write_errorlogs(mysqli_error($activate_connection), 2);
			}
		} else {
			if ($parameters) {
				foreach ($parameters as &$val) {
					$val = mysql_real_escape_string($val);
				}
				$querying = vsprintf(str_replace("?", "'%s'", $query_statement), $parameters);
			} else {
				$querying = $query_statement;
			}
			
			$result = mysql_query($querying, $activate_connection);
			if (!$result) {
				write_errorlogs(mysql_error(), 2);
			}
		}
		
		return $result;
	}
	
	
	function querexec($query_statement,$parameters=array())	{
		global $connection_type;
		global $activate_connection;
		if ($stmt = $activate_connection -> prepare($query_statement))
		{
			if (count($parameters) > 0) sql_bindVars($stmt, $parameters);
			
			$stmt-> execute();
			$stmt-> close();
			return true;
		}
		else
		{
			if($connection_type=="2")
			{
				write_errorlogs(mysqli_error($activate_connection),2);
			}
			else
			{
				write_errorlogs(mysql_error(),2);
			}

			return false;
		}
  	
	}
	
	function write_errorlogs($error_notes="",$type_logs=0)	{
		$h="";
		$array_logs = array("NOTICE","SQL","ERROR");
		$uri = (isset($_SERVER["REQUEST_URI"]))?$_SERVER["REQUEST_URI"]:"";
		$ipaddress = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
		if (isset($_SESSION["log_auth_id"]) && $_SESSION["log_auth_id"] <> "") $email = $_SESSION["log_auth_id"]; else $email = "NOTLOGIN";

		$noted = date("Y-m-d h:i:s")."\t[".$array_logs[$type_logs]."]\t$error_notes\t$uri\t$ipaddress";
		$noted = str_replace("\r\n"," ",$noted);
		$noted .= "\r\n";
		
		if ($type_logs == 2 || $type_logs == 0) {if ($h = fopen(_PATHERRORLOG."/".$email.".".date("Ymd").".error.txt","a+")) fwrite($h,$noted);}
		fclose($h);
	}
	

	function querying_numrows($result)	{
		global $connection_type;
		if ($connection_type==2) return mysqli_num_rows($result);
		else return mysql_num_rows($result);
	}
	
	function sqlGetData($result, $connection_type = null) {
		if (!isset($connection_type)) {
			global $connection_type;
		}
	
		$data = array();
		if ($connection_type == 2) {
			while ($row = $result->fetch_array(MYSQLI_BOTH)) {
				$data[] = $row;
			}
		} else {
			while ($row = mysql_fetch_array($result)) {
				$data[] = $row;
			}
		}
	
		return $data;
	}
	
	
	
	// Launch Connection
	$activate_connection = connect_database($_database);
?>
