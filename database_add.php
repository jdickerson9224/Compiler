<?php
include('functions.php');
$dblink=db_connect("Documents");

$directory = '/var/www/html/pull';
$scanned_directory = array_slice(scandir($directory), 2);
foreach($scanned_directory as $key=>$value){
	$sql="Select `fileName` from `documentManagement` where `fileName` like '%$value%'";
	$result=$dblink->query($sql) or
		die("Something went wrong with $sql<br>".$dblink->error);
	if(mysqli_num_rows($result) > 0){
		echo 'File is already in';
	}
	else{
		$directory="/var/www/html/pull/";
		$fp=fopen($directory.$value, 'r');
		$content=fread($fp, filesize($directory.$value));
		fclose($fp);
		$contentsClean=addslashes($content);
		$directory="/var/www/html/pull/";
		$tmp= explode("-", $value);
		$date= explode("_",$tmp[2]);
		$stringDate = strtotime(substr($date[0], 0, 4)."-".substr($date[0], 4, 2)."-".substr($date[0], 6, 2)." ".$date[1].":".$date[2].":".substr($date[3], 0, 2));
		$uploadDate= date("Y-m-d H:i:s",$stringDate);
		$sql="Insert into `documentManagement` (`fileName`, `dateCreated`, `fileType`, `directory`, `status`, `uploadBy`, `content`) values ('$value', '$uploadDate', 'pdf', '$directory', 'active', 'webuser', '$contentsClean')";
		$dblink->query($sql) or
			die("Something went wrong: $sql<br>".$dblink->erorr);
	}
}	
?>