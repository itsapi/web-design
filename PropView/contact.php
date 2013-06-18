<?
	$msg = '';
	include 'include/config.php';
	if (isset($_POST['submit'])){
		if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['message'] == ''){
			$msg .= 'Inputs must not be empty';
		} else {
			$to = $GLOBALS['mailUser'];
			$from = [
				'email' => htmlspecialchars($_POST['email']),
				'name' => htmlspecialchars($_POST['name']),
			];
			$subject = 'PropView Contact Form';
			$message = htmlspecialchars($_POST['message']);
			if (email($to, $from, $subject, $message)) {
				$msg .= 'Message sent';
			} else {
				$msg .= 'Message failed to send';
			}
		}
	}
?>

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
						<?=$msg?>
						<fieldset>
							<div>
								<label for="name-input">Name:</label>
								<input type="text" id="name-input" name="name" placeholder="Your name" required>
							</div>
							<div>
								<label for="email-input">Email address:</label>
								<input type="text" id="email-input" name="email" placeholder="Email address" required>
							</div>
							<div>
								<label for="message-input">Message:</label>
								<textarea id="message-input" name="message" placeholder="Your message" required></textarea>
							</div>
							<button type="submit" name="submit" class="pure-button">Submit</button>
						</fieldset>
					</form>
				</div>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>