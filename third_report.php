<?php
//For each loan number, the total number of documents recieved and the average number of documents across all loan numbers. Compare each loan number to the average and state if it is above or below average (100 pts)
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
$avgFiles= round(count($loanArray)/count($loanNumber));
echo '<div>Amount of unique loan numbers: '.$avgFiles.'</div>';


foreach($loanNumber as $key=>$value){
	$sql="Select count(`fileName`) from `documentManagement` where `fileName` like '%$value%' and `dateCreated` between '2022-11-14' and '2022-12-02'";
	$result = $dblink->query($sql) or
		die("Something went wrong with $sql<br>".$dblink->error);
	$tmp=$result->fetch_array(MYSQLI_NUM);
	if($tmp[0] > $avgFiles){
		echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents and is above the average.</div>';
	}
	else if($tmp[0] < $avgFiles){
		echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents and is below average.</div>';
	}
	else if($tmp[0] == $avgFiles){
		echo '<div>Loan Number: '.$value.' has '.$tmp[0].' number of documents and is average.</div>';
	}
}
?>