<?php
/*******
	A complete loan is one that has at least one of the following documents: credit, closing, title, financial, personal, internal, legal, other
		-A list of all loan numbers that have all documents (100 pts)
*******/
include("functions.php");
$dblink=db_connect("Documents");

$sql="Select `fileName` from `documentManagement` where `dateCreated` between '2022-11-14' and '2022-12-02'";
$result = $dblink->query($sql) or
	die("Something went wrong with $sql<br>".$dblink->error);
$loanArray=array();
while($data= $result->fetch_array(MYSQLI_ASSOC)){
	$tmp=explode("-", $data['fileName']);
	$loanArray[]=$tmp[0];
}
$loanNumber = array_unique($loanArray);

foreach($loanNumber as $key=>$value){
	$docType=array();
	$sql="Select `fileName` from `documentManagement` where `fileName` like '%$value%' and `dateCreated` between '2022-11-14' and '2022-12-02'";
	$result = $dblink->query($sql) or
		die("Something went wrong with $sql<br>".$dblink->error);
	while($data= $result->fetch_array(MYSQLI_ASSOC)){
		$nameArray= explode("-",$data['fileName']);
		$docType[]=$nameArray[1];
	}
	if(in_array("Credit", $docType) && in_array("Closing", $docType) && in_array("Title", $docType) && in_array("Financial", $docType) && in_array("Personal", $docType) && in_array("Internal", $docType) && in_array("Legal", $docType) && in_array("Other", $docType)){
		echo '<div>Loan Number: '.$value.' has all document types.</div>';
	}
}
?>