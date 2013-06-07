<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>title</title>

		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="typeplate-unminified.css">

		<script>
		function resizeIframe(newHeight) {
			document.getElementById('Iframe').style.height = parseInt(newHeight, 10) + 10 + 'px';
		}
		</script>
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
<?php include('login/lock.php'); ?>
<section><h2>Forum</h2></section>
<!--content-->
<iframe src="phpBB3" id="Iframe" frameborder="0" style="width:100%; overflow-y: hidden"></iframe>
<!--content-->
		</div>
		<footer>
			<p>Copyright &copy; 2013</p>
			<p>Designed and built by <a href="dvbris.no-ip.org">Dvbris Web Design</a></p>
		</footer>
	</body>
</html>