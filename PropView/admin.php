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
						<button type="submit" class="pure-button viewButton">View user</button>
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
								<label for="subscription">Subscription:</label>
								<select id="subscription" name="subscription">
									<option value="1">Premium PLUS: 2 weeks/300+ photos</option>
									<option value="2">Premium: 4 weeks/200 photos</option>
									<option value="3">Executive: 6 weeks/150 photos</option>
									<option value="4">Basic: 12 weeks/100 photos</option>
								</select>
								<label for="payment">Payment:</label>
								<select id="payment" name="payment">
									<option value="1">Invoice</option>
									<option value="2">Cash</option>
									<option value="3">Credit</option>
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
								<input type="text" id="username" name="username" required style="display:none">
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