<?php
echo "<p>Hello World</p>";

$hostname="localhost";
$username="webuser";
$password="Ne0919224+";
$db="Documents";
$mysqli=new mysqli($hostname,$username,$password,$db);

if (mysqli_connect_errno())
{
	die("Error connecting to database: ".mysqli_connect_error()); 
}
	
?>
