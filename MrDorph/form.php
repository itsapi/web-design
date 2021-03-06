<?php
	include('login/config.php');
	session_start();

	$notLoggedIn = false;
	if (isset($_SESSION['login_user'])) {
		$user_check = $_SESSION['login_user'];

		$ses_sql = mysql_query("SELECT username FROM admin WHERE username='$user_check'");

		$row = mysql_fetch_array($ses_sql);

		$login_session = $row['username'];
		if (isset($login_session)) {
			if (isset($_SERVER['HTTP_REFERER'])) {
				header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
			} else {
				header('Location: index.php');
			}
		} else {
			$notLoggedIn = true;
		}
	} else {
		$notLoggedIn = true;
	}
	if ($notLoggedIn) {
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>

		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/typeplate-unminified.css">
	</head>
	<body>
		<?php include('site_parts/header.php'); ?>
		<div id="content"><!--login--><!--login--><section><h2>Login</h2></section><!--content-->
<section>
	<p><b>Sign in</b> to our website to access the forum and other member restricted pages. <a href="signup.php">Become a member</a>.</p>
	<form action="login/login.php" method="post" class="pure-form pure-form-aligned">
		<input type="hidden" value="<?=$_GET['page']?>" name="page">
		<fieldset>
			<div class="pure-control-group"><label for="username">Username</label><input type="text" required focus id="username" name="username"></div>
			<div class="pure-control-group"><label for="password">Password</label><input type="password" required id="password" name="password"></div>
			<div class="pure-controls"><button class="pure-button" type="submit">Sign In</button></div>
		</fieldset>
	</form>
</section>
<!--content-->
		</div>
		<?php include('site_parts/footer.php'); ?>
	</body>
</html>
<?php
	}
?>