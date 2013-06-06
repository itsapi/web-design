<!DOCTYPE html>
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
	if (isset($_GET['msg'])) {
		$message = $_GET['msg'];
	} else {
		$message = '';
	}
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
		$message .= "Username or password was incorrect";
		}
	}
	if (isset($_POST['logout'])) {
		setcookie("loginEditor", '', time()-10);
		$loggedIn = 0;
		$message .= "Logged out successfully";
	}
	if (isset($_POST['changePass'])) {
		if ($_POST['oldPass'] && $_POST['newPass'] && $_POST['verifyPass']) {
			if (md5($_POST['oldPass']) == file_get_contents('passwd.md5')) {
				if ($_POST['newPass'] == $_POST['verifyPass']) {
					if (file_put_contents('passwd.md5', md5($_POST['newPass']))) {
						$message .= 'Password changed successfully';
					} else {
						$message .= 'Password change failed';
					}
				} else {
					$message .= 'Passwords do not match';
				}
			} else {
				$message .= 'Old password does not match';
			}
		} else {
			$message .= 'Fields cannot be left blank';
		}
	}
	if (isset($_POST['newFile'])) {
		$editFile = 1;
	}
	if (isset($_REQUEST['entry'])) {
		if (file_exists($_REQUEST['entry'])) {
			$fileContents = file_get_contents($_REQUEST['entry']);				
		} else {
			$fileContents = file_get_contents('template.html');
		}
		// $contentSplit = explode('<!--content-->', $fileContents);
		// $titleSplit = explode('<title>', $fileContents);
		// $titleSplit = [$titleSplit[0], explode('</title>', $titleSplit[1])[0]];
		// $html = [$titleSplit[0], $titleSplit[1], explode('</title>', $contentSplit[0])[1], $contentSplit[1], $contentSplit[2]];
		$html = [
				 explode('<title>', $fileContents)[0], // START ~~> <title>
				 explode('</title>', explode('<title>', $fileContents)[1])[0], // title
				 explode('<section><h2>', explode('</title>', $fileContents)[1])[0], // </title> ~~> <section><h2>
				 explode('</section></h2>', explode('<section><h2>', $fileContents)[1])[0], // heading
				 explode('<!--content-->', $fileContents)[1], // content
				 explode('<!--content-->', $fileContents)[2] // <!--content--> ~~> END
		];
	}
	if (isset($_POST['save'])) {
		if (($_POST['title']) && ($_POST['fileContents'])) {
			$contents = $html[0] . '<title>' . $_POST['title'] . '</title>' . $html[2] . '<section><h2>' . $_POST['title'] . "</h2></section><!--content-->\n" . $_POST['fileContents'] . '<!--content-->' . $html[5];
			if (file_put_contents($_REQUEST['entry'], $contents)) {
				$message .= 'File saved successfully';
			} else {
				$message .= 'File save failed';
			}
		} else {
			$message .= 'Title and file contents cannot be empty';
		}
		header('location:' . $_SERVER['PHP_SELF'] . '?editFile&entry=' . $_REQUEST['entry'] . '&msg=' . $message);
	}
	if (isset($_POST['deleteFile'])) {
		unlink($_POST['entry']);
		header('location:' . $_SERVER['PHP_SELF'] . '?msg=' . $message);
	}
	if (isset($_FILES['file']['name'])) {
		if (!$_FILES['file']['error']) {
			move_uploaded_file($_FILES['file']['tmp_name'], '../media/'.strtolower($_FILES['file']['name']));
			$message .= 'File successfully uploaded';
		} else {
			$message .= 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
		}
	}

	if ($loggedIn) {
?>
		<h1>Welcome to the wepage editor</h1>
		<section>
			<h3>Settings:</h3>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<h4>Change password:</h4>
				<label>Old password: <input type="password" name="oldPass"></label>
				<label>New password: <input type="password" name="newPass"></label>
				<label>Verify password: <input type="password" name="verifyPass"></label>
				<input type="submit" name="changePass" value="Change password">
				<input type="submit" name="logout" value="Logout">
			</form>
		</section>
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
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<input type="submit" value="Edit" name="editFile">
					<input type="submit" value="Delete" name="deleteFile">
					<input type="text" value="../<?=$entry?>" name="entry" hidden>
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
				if ($entry != '.' && $entry != '..') {
?>
			<li>
				<a href="../media/<?=$entry?>" target="_blank"><?=$entry?></a>
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
					<input type="submit" value="Delete" name="deleteFile">
					<input type="text" value="../media/<?=$entry?>" name="entry" hidden>
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
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
				Upload media file: <input type="file" name="file">
				<input type="submit" name="submit" value="Upload File">
			</form>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label>New file: <input type="text" name="entry"></label>
				<input type="submit" name="newFile" value="Create file">
			</form>
		</section>
<?
		if (isset($_REQUEST['editFile'])) {
?>
		<div>
			<h3>Edit file:</h3>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label>Page title<input type="text" name="title" value="<?=$html[1]?>"></label>
				<textarea name="fileContents" cols="60" rows="20"><?=$html[4]?></textarea>
				<input type="text" value="<?=$_POST['entry']?>" name="entry" hidden>
				<input type="submit" name="save" value="Save file">
				<input type="submit" value="Close">
			</form>
		</div>
<?
		}
	} else {
?>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			Username: <input type="text" name="username" /><br />
			Password: <input type="password" name="password" />
			<input type='submit' name='login' />
		</form>
<?php
	}
	echo $message;
	$message = '';
?>
	</body>
</html>