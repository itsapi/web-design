<?php
	include('config.php');
	session_start();
	if (isset($_POST['username'])) {
		// username and password sent from Form

		$myusername = addslashes($_POST['username']);
		$mypassword = md5($_POST['password']);
		$page = addslashes($_POST['page']);

		$sql = "SELECT id FROM admin WHERE username='$myusername' and passcode='$mypassword'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);

		// If result matched $myusername and $mypassword, table row must be 1 row
		if ($count == 1) {
			$_SESSION['login_user'] = $myusername;
			header("Location: ../$page");
		} else {
			echo "Your Login Name or Password is incorrect. <a href='../form.php?page=$page'>Back.</a>";
		}
	} else {
		header("Location: /");
	}
?>