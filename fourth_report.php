<?php
/*******
	A complete loan is one that has at least one of the following documents: credit, closing, title, financial, personal, internal, legal, other
		-A list of all loan numbers that are missing at least one of these documents and which document(s) is missing (100 pts)
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
	$documentType=array();
	$sql="Select `fileName` from `documentManagement` where `fileName` like '%$value%' and `dateCreated` between '2022-11-14' and '2022-12-02'";
	$result = $dblink->query($sql) or
		die("Something went wrong with $sql<br>".$dblink->error);
	while($data= $result->fetch_array(MYSQLI_ASSOC)){
		$nameArray= explode("-",$data['fileName']);
		$docType[]=$nameArray[1];
	}
	if(!in_array("Credit", $docType) || !in_array("Closing", $docType) || !in_array("Title", $docType) || !in_array("Financial", $docType) || !in_array("Personal", $docType) || !in_array("Internal", $docType) || !in_array("Legal", $docType) || !in_array("Other", $docType)){
		if(!in_array("Credit", $docType))
			echo '<div>Loan Number: '.$value.' Credit document type is missing</div>';
		if(!in_array("Closing", $docType))
			echo '<div>Loan Number: '.$value.' Closing document type is missing</div>';
		if(!in_array("Title", $docType))
			echo '<div>Loan Number: '.$value.' Title document type is missing</div>';
		if(!in_array("Financial", $docType))
			echo '<div>Loan Number: '.$value.' Financial document type is missing</div>';
		if(!in_array("Personal", $docType))
			echo '<div>Loan Number: '.$value.' Personal document type is missing</div>';
		if(!in_array("Internal", $docType))
			echo '<div>Loan Number: '.$value.' Internal document type is missing</div>';
		if(!in_array("Legal", $docType))
			echo '<div>Loan Number: '.$value.' Legal document type is missing</div>';
		if(!in_array("Other", $docType))
			echo '<div>Loan Number: '.$value.' Other document type is missing</div>';
	}
}
?>