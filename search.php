<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/bootstrap-fileupload.min.css" rel="stylesheet" />
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.12.4.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/bootstrap-fileupload.js"></script>
<?php
include("functions.php");
$dblink=db_connect("Documents");
echo '<div id="page-inner">';
echo '<h1 class="page-head-line">Search Files on DB</h1>';
echo '<div class="panel-body">';
if (!isset($_POST['submit']))
{
	echo '<form action="" method="post">';
	echo '<div class="form-group">';
	echo '<label>Search String:</label>';
	echo '<input type="text" class="form-control" name="searchString">';
	echo '</div>';
	echo '<select name="searchType">';
	echo '<option value="name">Name</option>';
	echo '<option value="uploadBy">Uploaded By</option>';
	echo '<option value="uploadDate">Date</option>';
	echo '<option value="all">All</option>';
	echo '</select>';
	echo '<hr>';
	echo '<button type="submit" name="submit" value="submit">Search</button>';
	echo '</form>';
}
if (isset($_POST['submit']))
{
	$searchType=$_POST['searchType'];
	$searchString=addslashes($_POST['searchString']);
	switch($searchType)
	{
		case "name":
			$sql="Select `fileName`,`dateCreated`,`uploadBy`,`fileID` from `documentManagement` where `name` like '%$searchString%'";
			break;
		case "uploadBy":
			$sql="Select `fileName`,`dateCreated`,`uploadBy`,`fileID` from `documentManagement` where `upload_by` like '%$searchString%'";
			break;
		case "uploadDate":
			$sql="Select `fileName`,`dateCreated`,`uploadBy`,`fileID` from `documentManagement` where `dateCreated` like '%$searchString%'";
			break;
		case "all":
			$sql="Select `fileName`,`dateCreated`,`uploadBy`,`fileID` from `documentManagement`";
			break;
		default:
			redirect("search.php?msg=searchTypeError");
			break;
	}
	$result=$dblink->query($sql) or
		die("Something went wrong with $sql<br>".$dblink->error);
	echo '<table>';
	while ($data=$result->fetch_array(MYSQLI_ASSOC))
	{
		echo '<tr>';
		echo '<td>'.$data['fileName'].'</td>';
		echo '<td>'.$data['dateCreated'].'</td>';
		echo '<td><a href="view.php?fid='.$data['fileID'].'">View</a></td>';
		echo '</tr>';
	}
	echo '</table>';
}
echo '</div>';//end panel-body
echo '</div>';//end page-inner
?>