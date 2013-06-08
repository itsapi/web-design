<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>MrDorph</title>

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
<?php include 'login/unlock.php'; ?>
<section><h2>Sign Up</h2></section>
<!--content-->
<section>
	<p>
		<b>Sign up</b> to our website to access the forum and other member restricted pages.
	</p>
	<form action="login/register.php" method="post" class="pure-form pure-form-aligned">
		<fieldset>
			<div class="pure-control-group"><label for="username">Username</label><input type="text" required focus id="username" name="username"></div>
			<div class="pure-control-group"><label for="username">Email</label><input type="email" required id="email" name="email"></div>
			<div class="pure-control-group"><label for="password">Password</label><input type="password" required id="password" name="password"></div>
			<div class="pure-control-group"><label for="password2">Password Again</label><input type="password" required id="password2" name="password2"></div>
			<div class="pure-controls"><button class="pure-button" type="submit">Sign Up</button></div>
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