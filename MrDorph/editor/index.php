<?
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
	if (isset($_REQUEST['login'])) {
		if($_REQUEST['username'] == $username && md5($_REQUEST['password']) == $password) {
			$loggedIn = 1;
			setcookie("loginEditor", 1);
		} else {
			$message .= "Username or password was incorrect";
		}
	}
	if (isset($_REQUEST['logout'])) {
		setcookie("loginEditor", '', time()-10);
		$loggedIn = 0;
		$message .= "Logged out successfully";
	}
	if (isset($_REQUEST['changePass'])) {
		if ($_REQUEST['oldPass'] && $_REQUEST['newPass'] && $_REQUEST['verifyPass']) {
			if (md5($_REQUEST['oldPass']) == file_get_contents('passwd.md5')) {
				if ($_REQUEST['newPass'] == $_REQUEST['verifyPass']) {
					if (file_put_contents('passwd.md5', md5($_REQUEST['newPass']))) {
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
	if (isset($_REQUEST['newFile'])) {
		header('location:' . $_SERVER['PHP_SELF'] . '?editFile&entry=../' . $_REQUEST['entry'] . '&msg=' . $message);
	}
	if (isset($_REQUEST['entry'])) {
		if (file_exists($_REQUEST['entry'])) {
			$fileContents = file_get_contents($_REQUEST['entry']);
		} else {
			$fileContents = file_get_contents('template.php');
		}
		$html = [
				 explode('<title>', $fileContents)[0], // START ~~> <title>
				 explode('</title>', explode('<title>', $fileContents)[1])[0], // title
				 explode('<!--login-->', explode('</title>', $fileContents)[1])[0], // </title> ~~> <!--login-->
				 explode('<!--login-->', $fileContents)[1], // login
				 explode('<!--content-->', $fileContents)[1], // content
				 explode('<!--content-->', $fileContents)[2] // <!--content--> ~~> END
		];
	}
	if (isset($_REQUEST['save'])) {
		if (($_REQUEST['title']) && ($_REQUEST['fileContents'])) {
			if ($_REQUEST['needLogin'] == 'on') {
				$passInc = '<?php include(\'login/lock.php\'); ?>';
			} else {
				if ($html[3] == '<?php include(\'login/lock.php\'); ?>') {
					$passInc = '<?php include(\'login/unlock.php\'); ?>';
				} else {
					$passInc = $html[3];
				}
			}
			$contents = $html[0] . 
						'<title>' . 
						$_REQUEST['title'] . 
						'</title>' . 
						$html[2] . 
						'<!--login-->' . 
						$passInc . 
						'<!--login--><section><h2>' . 
						$_REQUEST['title'] . 
						"</h2></section><!--content-->\n" . 
						$_REQUEST['fileContents'] . 
						'<!--content-->' . 
						$html[5];
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
	if (isset($_REQUEST['deleteFile'])) {
		unlink($_REQUEST['entry']);
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
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Editor</title>

		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="../typeplate-unminified.css">
	</head>
	<body>
<?
	if ($loggedIn) {
?>
		<h1>Welcome to the wepage editor</h1>
		<section>
			<h3>Settings:</h3>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="REQUEST">
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
				if (preg_match("/\.(php)$/", $entry)) {
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
				<p>Files should end in .php (eg: 'index.php')</p>
			</form>
		</section>
<?
		if (isset($_REQUEST['editFile'])) {
?>
		<section>
			<h3>Edit file:</h3>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<label>Page title: <input type="text" name="title" value="<?=$html[1]?>"></label>
				<label>Require Login: <input type="checkbox" name="needLogin" <?php if ($html[3] == '<?php include(\'login/lock.php\'); ?>') { echo 'checked'; } ?>></label>
				<textarea name="fileContents" cols="60" rows="20"><?=$html[4]?></textarea>
				<input type="text" value="<?=$_REQUEST['entry']?>" name="entry" hidden><br>
				<input type="submit" name="save" value="Save file">
				<input type="submit" value="Close">
			</form>
		</section>
		<section>
			<h4>Image:</h4>
			<pre class="code" title="Image">
&lt;img src="Enter URL of image here" alt="Enter image description here"&gt;
</pre>
			<h4>Link:</h4>
			<pre class="code" title="Link">
&lt;a href="Enter link URL here"&gt;Enter text to be displayed here&lt;/a&gt;
</pre>
			<h4>Section:</h4>
			<pre class="code" title="Section">
&lt;section&gt;
	Enter content of section here
&lt;/section&gt;
</pre>
			<h4>Heading:</h4>
			<pre class="code" title="Heading">
&lt;h3&gt;Enter heading content here&lt;/h3&gt;
</pre>
			<h4>Secondary Heading:</h4>
			<pre class="code" title="Secondary heading">
&lt;h4&gt;Enter heading content here&lt;/h4&gt;
</pre>
			<h4>Paragraph:</h4>
			<pre class="code" title="Paragraph">
&lt;p&gt;Enter paragraph content here&lt;/p&gt;
</pre>
			<h4>Bold Text:</h4>
			<pre class="code" title="Bold">
&lt;b&gt;Enter text to be bold here&lt;/b&gt;
</pre>
			<h4>Ordered List:</h4>
			<pre class="code" title="Ordered List">
&lt;ol&gt;
	&lt;li&gt;Enter list item here&lt;/li&gt;
	&lt;li&gt;Enter list item here&lt;/li&gt;
&lt;/ol&gt;
</pre>
			<h4>Unordered List:</h4>
			<pre class="code" title="Unordered List">
&lt;ul&gt;
	&lt;li&gt;Enter list item here&lt;/li&gt;
	&lt;li&gt;Enter list item here&lt;/li&gt;
&lt;/ul&gt;
</pre>
			<h4>Abbreviation:</h4>
			<pre class="code" title="Abbreviation">
&lt;abbr title="enter expanded phrase here"&gt;Enter abbreviation here&lt;/abbr&gt;
</pre>
			</div>
			<h4>Blockquote:</h4>
			<pre class="code" title="Blockquote">
&lt;blockquote cite="Enter author's name here"&gt;
	&lt;p&gt;&Prime;Enter quote here&Prime;&lt;/p&gt;
	&lt;cite&gt;
		&lt;small&gt;&lt;a href="Enter authour's URL here"&gt;Enter author's name here&lt;/a&gt;&lt;/small&gt;
	&lt;/cite&gt;
&lt;/blockquote&gt;
</pre>
			<h4>Pull Quote:</h4>
			<pre class="code" title="Pull Quote">
&lt;aside class="pull-quote"&gt;
	&lt;blockquote&gt;
		&lt;p&gt;Enter quote here&lt;/p&gt;
	&lt;/blockquote&gt;
&lt;/aside&gt;
</pre>
		</section>
<?
		}
	} else {
?>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
			<label>Username: <input type="text" name="username"></label>
			<label>Password: <input type="password" name="password"></label>
			<input type="submit" name="login" value="Login">
		</form>
<?
	}
	echo $message;
?>
	</body>
</html>