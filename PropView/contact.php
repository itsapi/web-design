<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<link rel="stylesheet" href="css/contact.css">
	</head>
	<body>
		<div id="container">
			<? include 'include/header.html' ?>
			<section id="right">
				<div id="contact_container">
					<figure>
						<a href="index.php"><img src="files/logo.png" id="logo" alt="PropView Logo"></a>
						<figcaption>Virtual Property Supervision</figcaption>
					</figure>
					<form method="post" class="pure-form pure-form-stacked contact">
						<fieldset>
							<div>
								<label for="name-input">Name:</label>
								<input type="text" id="name-input" placeholder="Your name" required>
							</div>
							<div>
								<label for="email-input">Email address:</label>
								<input type="text" id="email-input" placeholder="Email address" required>
							</div>
							<div>
								<label for="comment-input">Message:</label>
								<textarea id="comment-input" placeholder="Your comment" required></textarea>
							</div>
							<button type="submit" class="pure-button">Submit</button>
						</fieldset>
					</form>
				</div>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>