<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$time_limit = 24*60*60; // Giving the user a time of 24 hours aprox
$username = mysqli_real_escape_string($link, $username);
$password = mysqli_real_escape_string($link, $password);
        $userQuery = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
        $user = mysqli_query($link, $userQuery);
        if (mysqli_num_rows($user)) {
            $selectUser = mysqli_fetch_array($user, MYSQLI_ASSOC);
            $id = $selectUser['user_id'];
            $user_login_count = $selectUser['user_login_count'];
            $user_last_login_date = $selectUser['user_date'];

            if($user_login_count<1 && time() - strtotime($user_last_login_date) >$time_limit){
                //Suspend the account if new user first time login 1 day after account being created;
                $message = "Your account has been suspended, please contact admin to unlock it!";
                return $message;
            }

            if ($selectUser['user_pass'] === $password) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $selectUser['user_fname'];

                $updatestring = "UPDATE tbl_user SET user_ip = '$ip', user_login_count = user_login_count+1 WHERE user_id={$id}";
                $updatequery = mysqli_query($link, $updatestring);

                if($user_login_count>0){
                    redirect_to("admin_index.php");
                }else{
                    redirect_to("admin_edituser.php");
                }
            }else{
                $message = "Username and or password is incorrect.<br>Please make sure your cap lock key is turned off.";
                return $message;
            }
        }
		mysqli_close($link);
	}


?>
