<?php
//The total size of all documents recieved from the API and the average size of all documents across all loans (100 pts)
include("functions.php");
$dblink=db_connect("Documents");
$sql="Select length(`content`) from `documentManagement` where `dateCreated` between '2022-11-14' and '2022-12-02'";
$result = $dblink->query($sql) or
	die("Something went wrong with $sql<br>".$dblink->error);
$contentArray=array();
$total=0;
while($data= $result->fetch_array(MYSQLI_NUM)){
	$contentArray[]=$data[0];
	$total+=$data[0];
}
echo '<div>Total size of '.count($contentArray).' files: '.$total.' </div>';
echo '<div>Average size of files: '.($total/(count($contentArray))).'</div>';
?>