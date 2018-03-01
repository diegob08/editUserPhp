<?php
	//ini_set('display_errors',1);
	//error_reporting(E_ALL);

	require_once('phpscripts/config.php');

	$ip = $_SERVER['REMOTE_ADDR'];
	//echo $ip;
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		if($username !== "" && $password !== "") {
			$result = logIn($username, $password, $ip);
			$message = $result;
		}else{
			$message = "Please fill in the required fields";
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset ="UTF-8">
<link rel="stylesheet" href="css/main.css">
<title>User Login</title>
</head>
<body>
<div class="loginCont">
  <h1 class="title">Admin Login</h1>
  <section class= "msg"><?php if(!empty($message)){echo $message;} ?></section>
  <section class="formSect">
  <form action="admin_login.php" method="post">
    <label class="hidden">Username:</label>
    <input type="text" name="username" value="" placeholder="username">
    <label class="hidden">Password:</label>
    <input type="password" name="password" value="" placeholder="password">
    <input type="submit" name="submit" value="Sign In">
  </form>
</section>
</div>
</body>
</html>
