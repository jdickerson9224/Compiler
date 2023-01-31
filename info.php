<?php
$userID=$_GET['userid'];
$email=$_GET['email'];
$firstName=$_GET['firstName'];
echo '<h4>Results from previous page: </h4>';
echo '<p>user id: '.$userid.'</p>';
echo "<p>email: $email</p>";
echo "<p>First name: $firstName</p>";
?>