<?php
/*******
	A complete loan is one that has at least one of the following documents: credit, closing, title, financial, personal, internal, legal, other
		-List the total number of each document received across all loan numbers (100 pts)
*******/
include("functions.php");
$dblink=db_connect("Documents");

$sql="Select `fileName` from `documentManagement` where `dateCreated` between '2022-11-14' and '2022-12-02'";
$result = $dblink->query($sql) or
	die("Something went wrong with $sql<br>".$dblink->error);
$documentTypes=array();
while($data= $result->fetch_array(MYSQLI_ASSOC)){
	$tmp=explode("-", $data['fileName']);
	$docTypes[]=$tmp[1];
}
$docTypes= array_count_values($docTypes);
foreach($docTypes as $key=>$value){
	echo '<div>'.$key.' had '.$value.' documents.</div>';
}
?>