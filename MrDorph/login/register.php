<?php
	if (isset($_POST['username'])) {
		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$password = md5($_POST['password']);
		$password2 = md5($_POST['password2']);

		if ($password == $password2) {
			include('config.php');

			$sql = "INSERT INTO admin (username, email, passcode) VALUES ('$username', '$email', '$password')";
			$result = mysql_query($sql);
			if ($result) {
				echo 'Registered! <a href="../form.php?page=index.php">Login.</a>';
			} else {
				echo 'Unsuccessful. Your username may have been taken. <a href="../signup.php">Back.</a>';
			}
		} else {
			echo 'Passwords don\'t match. (Or to long.) <a href="../signup.php">Back.</a>';
		}
	} else {
		header('Location ../index.php');
	}
?>