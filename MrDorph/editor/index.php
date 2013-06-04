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

	if (isset($_COOKIE["loginEditor"])) {
		$loggedIn = 1;
	}

	if(isset($_POST['login']) &&  !($loggedIn)) {
		 if($_POST['username'] == $username && md5($_POST['password']) == $password) {
			$loggedIn = 1;
			setcookie("loginEditor", 1);
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
?>
		<h3>Files:</h3>
		<ul>
<?
		while ($entry = readdir($handle)) {
			if (preg_match("/\.(html)$/", $entry)) {
?>
		<li>
			<a href="../<?=$entry?>" target="_blank"><?=$entry?></a>
			<input type="submit" value="Edit" name="edit">
			<input type="text" value="<?=$entry?>" name="entry" hidden>
		</li>
<?
			}
		}
?>
		</ul>
<?
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
		<input type='submit' name='login' />
	</form>
<?php
	}
?>

	
</body>
</html>