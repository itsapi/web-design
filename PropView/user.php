<?
	$msg = '';
	include 'include/config.php';
	if (isset($_COOKIE['user'])){
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<link rel="stylesheet" href="css/user.css">
	</head>
	<body>
		<div id="container">
			<? include 'include/header.html' ?>
			<section id="left">
				<figure>
					<a href="index.php"><img src="files/logo.png" id="logo" alt="PropView Logo"></a>
					<figcaption>Virtual Property Supervision</figcaption>
				</figure>
				<h4>My Account:</h4>
				<a href="#"><button class="pure-button">Edit account</button></a>
				<a href="#"><button class="pure-button">Add property</button></a>
				<a href="index.php?logout"><button class="pure-button">Logout</button></a>
			</section>
			<section id="right">
				
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>

<?
	} else {
		header('location: index.php');
	}
?>