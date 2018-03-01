<?php
	//ini_set('display_errors',1);
	//error_reporting(E_ALL);
	require_once('phpscripts/config.php');
	//confirm_logged_in();

 $tbl = "tbl_user";
 $users = getAll($tbl);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/main.css">
<title>CMS Portal</title>
</head>
<body>
	<div class="loginCont">
	<h1>Welcome to your edit account</h1>
<?php
	while($row = mysqli_fetch_array($users)){
		echo "{$row['user_fname']}<a href=\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">Delete User</a><br>";
	}
 ?>

</div>
</body>
</html>
