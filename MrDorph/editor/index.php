<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Editor</title>
	</head>
	<body>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	$loggedIn = 0;
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
		<section>
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
					<input type="submit" value="Edit" name="editFile">
					<input type="submit" value="Delete" name="deleteFile">
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
		</section>
		<section>
<?
		if ($handle = opendir('../media')) {
?>
			<h3>Media:</h3>
			<ul>
<?
			while ($entry = readdir($handle)) {
				// if (preg_match("/\.(html)$/", $entry)) {
?>
			<li>
				<a href="../<?=$entry?>" target="_blank"><?=$entry?></a>
				<!-- <form method="post">
					<input type="submit" value="Edit" name="edit">
					<input type="text" value="<?=$entry?>" name="entry" hidden>
				</form> -->
			</li>
<?
				// }
			}
?>
			</ul>
<?
			closedir($handle);
		}
?>
			<form method="post">
				<label>New file: <input type="text" name="entry"></label>
				<input type="submit" name="newFile" value="Create file">
			</form>
		</section>
<?
		if (isset($_POST['newFile'])) {
			$editFile = 1;
		}
		if (isset($_POST['entry'])) {
			if (file_exists('../' . $_POST['entry'])) {
				$fileContents = file_get_contents('../' . $_POST['entry']);				
			} else {
				$fileContents = file_get_contents('template.html');
			}
			$contentSplit = explode('<!--content-->', $fileContents);
			$titleSplit = explode('<title>', $fileContents);
			$titleSplit = [$titleSplit[0], explode('</title>', $titleSplit[1])[0]];
			$html = [$titleSplit[0], $titleSplit[1], explode('</title>', $contentSplit[0])[1], $contentSplit[1], $contentSplit[2]];
		}
		if (isset($_POST['save'])) {
			if (($_POST['title']) && ($_POST['fileContents'])) {
				$contents = $html[0] . '<title>' . $_POST['title'] . '</title>' . $html[2] . "<!--content-->\n" . $_POST['fileContents'] . '<!--content-->' . $html[4];
				if (file_put_contents('../' . $_POST['entry'], $contents)) {
					echo 'File saved successfully';
				} else {
					echo 'File save failed';
					$editFile = 1;
				}
			} else {
				echo 'Title and file contents cannot be empty';
				$editFile = 1;
			}
			header('location:' . $_SERVER['PHP_SELF']);
		}
		if (isset($_POST['deleteFile'])) {
			unlink('../' . $_POST['entry']);
			header('location:' . $_SERVER['PHP_SELF']);
		}
		if (isset($_POST['editFile']) || isset($editFile)) {
?>
		<div>
			<h3>Edit file:</h3>
			<form method="post">
				<label>Page title<input type="text" name="title" value="<?=$html[1]?>"></label>
				<textarea name="fileContents"><?=$html[3]?></textarea>
				<input type="text" value="<?=$_POST['entry']?>" name="entry" hidden>
				<input type="submit" name="save" value="Save file">
				<input type="submit" value="Cancel">
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