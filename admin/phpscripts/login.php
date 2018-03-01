<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$time_limit = 24*60*60; // Giving the user a time of 24 hours aprox
$username = mysqli_real_escape_string($link, $username);
$password = mysqli_real_escape_string($link, $password);
        $userQuery = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
        $user = mysqli_query($link, $userQuery);
        if (mysqli_num_rows($user)) {
            $founduser = mysqli_fetch_array($user, MYSQLI_ASSOC);
            $id = $founduser['user_id'];
            $user_login_count = $founduser['user_login_count'];
            $user_last_login_date = $founduser['user_date'];

            if($user_login_count<1 && time() - strtotime($user_last_login_date) >$time_limit){
                //Suspend the account if new user first time login 1 day after account being created;
                $message = "Your account has been suspended, please contact admin to unlock it!";
                return $message;
            }

        }
		mysqli_close($link);
	}


?>
