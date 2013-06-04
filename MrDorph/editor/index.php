<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editor</title>
</head>
<body>
<?php
	$loggedIn = 0;
	$username = "admin";
	$password = file_get_contents('passwd.md5');

	if(isset($_POST['submit'])) {
		 if($_POST['username'] == $username && md5($_POST['password']) == $password) {
			$loggedIn = 1;
		} else {
		echo "Username or password was incorrect.";
		}
	}
	if ($loggedIn) {
?>
	<h1>Welcome to the wepage editor</h1>
	<div>
<?
	if ($handle = opendir('../')) {
		echo "Entries:\n<br>\n<ul>\n";

		while ($entry = readdir($handle)) {
			if (preg_match("/\.(html)$/", $entry)) {
				echo "<li>$entry</li>\n";
			}
		}

		echo "</ul>";

	    closedir($handle);
	}
?>
	</div>
<?
	} else {
?>
	<form method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" />
		<input type='submit' name='submit' />
	</form>
<?php
	}
?>

	
</body>
</html>