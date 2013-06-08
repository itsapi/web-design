<?php
	include('login/config.php');
	session_start();
	$user_check = $_SESSION['login_user'];

	$ses_sql = mysql_query("SELECT username FROM admin WHERE username='$user_check'");

	$row = mysql_fetch_array($ses_sql);

	$login_session = $row['username'];

	if (isset($login_session)) {
		header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
	} else {
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
		<header>
			<h1>ENGLISH ARMOURED BRIGADE</h1>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Welcome</a></li>
				<li><a href="info.php">Info</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="forum.php">Forum</a></li>
				<li><a href="downloads.php">Downloads</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
		<div id="content">
<section><h2>Login</h2></section>
<!--content-->
<section>
	<p><b>Sign in</b> to our website to access the forum and other member restricted pages. <a href="signup.php">Become a member</a>.</p>
	<form action="login/login.php" method="post" class="pure-form pure-form-aligned">
		<input type="hidden" value="<?php echo $_GET['page']; ?>" name="page">
		<fieldset>
			<div class="pure-control-group"><label for="username">Username</label><input type="text" required focus id="username" name="username"></div>
			<div class="pure-control-group"><label for="password">Password</label><input type="password" required id="password" name="password"></div>
			<div class="pure-controls"><button class="pure-button" type="submit">Sign In</button></div>
		</fieldset>
	</form>
</section>
<!--content-->
		</div>
		<footer>
			<p>Copyright &copy; 2013</p>
			<p>Designed and built by <a href="dvbris.no-ip.org">Dvbris Web Design</a></p>
		</footer>
	</body>
</html>
<?php
	}
?>