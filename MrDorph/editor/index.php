<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editor</title>
</head>
<body>
<?php
	$loggedIn = 0;
	$editFile = 0;
	$username = "admin";
	$password = file_get_contents('passwd.md5');

	if (isset($_COOKIE["loginEditor"])) {
		$loggedIn = 1;
	}
	if (isset($_POST['login'])) {
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
			<form method="post">
				<input type="submit" value="Edit" name="edit">
				<input type="text" value="<?=$entry?>" name="entry" hidden>
			</form>
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
		if (isset($_POST['edit'])) {
			$fileContents = file_get_contents('../' . $_POST['entry']);
?>
	<div>
		<h3>Edit file:</h3>
		<form method="post">
			<label>Page title<input type="text" name="title" value="<?
			preg_match('/<title>(.*?)<\/title>/s', $fileContents, $matches);
			echo $matches[1];
?>"></label>
			<textarea name="fileContents">
<?
			preg_match('/<div id="content">(.*?)<\/div>/s', $fileContents, $matches);
			echo $matches[1];
?>
			</textarea>
			<input type="submit" name="editFile" value="Save file">
		</form>
	</div>
<?
		}
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