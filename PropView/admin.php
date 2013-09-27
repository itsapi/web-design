<?
	$msg = '';
	include 'include/functions.php';
	if (isset($_COOKIE['user']) && $userData['admin']){
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<script><?='var userData = '.json_encode($userData).';'?></script>
		<script src="js/admin.js"></script>
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
				<a id="editAccount" href="javascript:void(0)"><button class="pure-button">Edit account</button></a>
				<a id="addUser" href="javascript:void(0)"><button class="pure-button">Add user</button></a>
				<a href="index.php?logout"><button class="pure-button">Logout</button></a>
				<form class="pure-form pure-form-stacked viewUser">
					<fieldset>
						<label for="user">User:</label>
						<select id="user">
						</select>
						<button type="submit" class="pure-button viewButton">Edit user</button>
						<button type="submit" class="pure-button resetPassword">Reset password</button>
						<button type="submit" class="pure-button viewPropButton">View properties</button>
						<button type="submit" class="pure-button deleteButton">Delete user</button>
					</fieldset>
				</form>
			</section>
			<section id="right">
				<form class="pure-form pure-form-stacked editUser">
					<fieldset>
						<legend>Add user:</legend>
						<div class="pure-g-r">
							<div class="pure-u-1-3">
								<label for="username">Username:</label>
								<input type="text" id="username" name="username" required>
								<label for="email">Email address:</label>
								<input type="email" id="email" name="email" required>
								<label for="firstname">First name:</label>
								<input type="text" id="firstname" name="firstname" required>
								<label for="surname">Surname:</label>
								<input type="text" id="surname" name="surname" required>
							</div>
							<div class="pure-u-1-3">
								<label for="address">Business address:</label>
								<textarea id="address" name="address" required></textarea>
								<label for="addressb">Billing address:</label>
								<textarea id="addressb" name="addressb" required></textarea>
							</div>
							<div class="pure-u-1-3">
								<label for="payment">Payment:</label>
								<select id="payment" name="payment">
									<option value="1">Monthly</option>
									<option value="2">Quarterly (5% discount)</option>
									<option value="3">Yearly (10% discount)</option>
								</select>
								<button type="submit" class="pure-button">Update</button>
							</div>
						</div>
					</fieldset>
				</form>
				<form class="pure-form pure-form-stacked editAccount">
					<fieldset>
						<legend>Edit account:</legend>
						<div class="pure-g-r">
							<div class="pure-u-1-2">
								<label for="email">Email address:</label>
								<input type="email" id="email" name="email" required>
								<label for="firstname">First name:</label>
								<input type="text" id="firstname" name="firstname" required>
								<label for="surname">Surname:</label>
								<input type="text" id="surname" name="surname" required>
							</div>
							<div class="pure-u-1-2">
								<label for="password">Password:</label>
								<input type="password" id="password" name="password">
								<label for="passwordc">Confirm password:</label>
								<input type="password" id="passwordc" name="passwordc">
								<button type="submit" class="pure-button">Update</button>
							</div>
						</div>
					</fieldset>
				</form>
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
