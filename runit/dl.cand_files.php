<?php
session_start();
include_once("../setconf.php");
loadAllModules();
$usrRequest = array();
$usrRequest = system_initiateRequest();
	
$the_folder = _PATHURL."/cand_files";

//echo basename($the_folder);exit;



function recurse_zip($src,&$zip,$path_length) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    recurse_zip($src . '/' . $file,$zip,$path_length);
                }
                else {
                    $zip->addFile($src . '/' . $file,substr($src . '/' . $file,$path_length));
                }
            }
        }
        closedir($dir);
}
//Call this function with argument = absolute path of file or directory name.
function compress($src)
{
	$zip_file_name = "cand_files_".date("YmdHis").".zip";

        if(substr($src,-1)==='/'){$src=substr($src,0,-1);}
        $arr_src=explode('/',$src);
        $filename=end($arr_src);
        unset($arr_src[count($arr_src)-1]);
        $path_length=strlen(implode('/',$arr_src).'/');
        $f=explode('.',$filename);
        $filename=$f[0];
        $filename=(($filename=='')? 'backup.zip' : $filename.'.zip');
		
        $zip = new ZipArchive;
        $res = $zip->open($zip_file_name, ZipArchive::CREATE);
        if($res !== TRUE){
                echo 'Error: Unable to create zip file';
                exit;}
        if(is_file($src)){$zip->addFile($src,substr($src,$path_length));}
        else{
                if(!is_dir($src)){
                     $zip->close();
                     @unlink($zip_file_name);
                     echo 'Error: File not found';
                     exit;}
        recurse_zip($src,$zip,$path_length);}
        $zip->close();
		/*
        header("Location: $zip_file_name");
		*/
		echo "<a href='"._PATHURL."/runit/".$zip_file_name."'>"._PATHURL."/cand_files/".$zip_file_name."</a>";

        exit;
	
}
compress(_DIRFILES);
?>