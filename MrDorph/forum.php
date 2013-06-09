<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Forum</title>

		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/typeplate-unminified.css">

		<script>
		function resizeIframe(newHeight) {
			document.getElementById('Iframe').style.height = parseInt(newHeight, 10) + 10 + 'px';
		}
		</script>
	</head>
	<body>
		<?php include('site_parts/header.php'); ?>
		<div id="content">
<!--login--><?php include('login/lock.php'); ?><!--login--><section><h2>Forum</h2></section><!--content-->
<iframe src="phpBB3" id="Iframe" frameborder="0" style="width:100%; overflow-y: hidden"></iframe>
<!--content-->
		</div>
		<?php include('site_parts/footer.php'); ?>
	</body>
</html>