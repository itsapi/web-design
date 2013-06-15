<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div id="container">
			<? include 'include/header.html' ?>
			<section id="right">
				<div id="login_container">
					<figure>
						<a href="index.php"><img src="files/logo.png" id="logo" alt="PropView Logo"></a>
						<figcaption>Virtual Property Supervision</figcaption>
					</figure>
					<form action="user.php" method="post" class="pure-form pure-form-stacked login">
						<fieldset>
							<div>
								<label for="username-input">Username:</label>
								<input type="text" id="username-input" placeholder="Username" required>
							</div>
							<div>
								<label for="password-input">Password:</label>
								<input type="password" id="password-input" placeholder="Password" required>
							</div>
							<button type="submit" class="pure-button">Login</button>
						</fieldset>
					</form>
				</div>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>