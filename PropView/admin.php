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
		<link rel="stylesheet" href="css/admin.css">
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
				<ul>
					<li><a href="#">Edit account</a></li>
					<li><a href="index.php?logout">Logout</a></li>
				</ul>
				<form class="pure-form pure-form-stacked">
    				<fieldset>
						<label for="user">User:</label>
						<select id="user">
							<option>user1</option>
							<option>user2</option>
							<option>user3</option>
						</select>
						<button type="submit" class="pure-button">View user</button>
					</fieldset>
				</form>
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