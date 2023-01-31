<?php
//Total number of unique loan numbers generted with a printout of those loan numbers(100 pts)
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
$loanNumbers = array_unique($loanArray);
echo '<div>Loan Number Total: '.count($loanNumbers).'</div>';
foreach($loanNumbers as $key=>$value){
	echo '<div>Loan Number: '.$value.'</div>';
}
?>

