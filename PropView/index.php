<?
	$msg = '';
	include 'include/functions.php';
	if (isset($_GET['logout'])){
		setcookie('user', '', time()-60000);
	}
	if (isset($_COOKIE['user'])){
		if ($_COOKIE['user'] == 'admin'){
			header('location: admin.php');
		} else {
			header('location: user.php');
		}
	}
	if (isset($_POST['login'])){
		$username = addslashes($_POST['username']);
		$password = addslashes($_POST['password']);
		$hash = hash('sha512',$username.hash('sha512',$password));
		$result = query_DB("SELECT * FROM users WHERE username='$username'");
		$row = mysqli_fetch_assoc($result);
		if (count($row) == 0){
			$msg .= 'Username incorrect';
		} else {
			if ($row['password'] == $hash){
				setcookie('user', $row['username'], time()+3600*24*30);
				if ($row['username'] == 'admin'){
					header('location: admin.php');
				} else {
					header('location: user.php');
				}
			} else {
				$msg .= 'Password incorrect';
			}
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.php' ?>
		<link rel="stylesheet" href="css/index.css">
	</head>
	<body>
		<div id="container">
			<? include 'include/header.php' ?>
			<section id="right">
				<div id="login_container">
					<figure>
						<a href="index.php"><img src="files/logo.png" id="logo" alt="PropView Logo"></a>
						<figcaption>Virtual Property Supervision</figcaption>
					</figure>
					<form method="post" class="pure-form pure-form-stacked login">
						<?=$msg?>
						<fieldset>
							<div>
								<label for="username-input">Username:</label>
								<input type="text" id="username-input" name="username" placeholder="Username" required>
							</div>
							<div>
								<label for="password-input">Password:</label>
								<input type="password" id="password-input" name="password" placeholder="Password" required>
							</div>
							<button type="submit" name="login" class="pure-button">Login</button>
						</fieldset>
					</form>
				</div>
			</section>
			<? include 'include/footer.php' ?>
		</div>
	</body>
</html>