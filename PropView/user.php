<?
	$msg = '';
	include 'include/functions.php';
	if (isset($_COOKIE['user'])){
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<script><?='var userData = '.json_encode($userData).';'?></script>
		<script src="js/user.js"></script>
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
				<a id="editAccount" href="javascript:void(0)"><button class="pure-button">Edit account</button></a>
				<a id="addProperty" href="javascript:void(0)"><button class="pure-button">Add property</button></a>
				<a href="index.php?logout"><button class="pure-button">Logout</button></a>
				<form class="pure-form pure-form-stacked viewProperty">
					<fieldset>
						<label for="property">Property:</label>
						<select id="property">
						</select>
						<button type="submit" class="pure-button viewButton">View property</button>
						<button type="submit" class="pure-button deleteButton">Delete property</button>
					</fieldset>
				</form>
			</section>
			<section id="right">
				<form class="pure-form pure-form-stacked editProperty">
					<fieldset>
						<legend>Add property:</legend>
						<div class="pure-g-r">
							<div class="pure-u-1-2">
								<input type="text" id="id" name="id" style="display:none">
								<label for="name">Name:</label>
								<input type="text" id="name" name="name" required>
								<label for="address">Address:</label>
								<textarea id="address" name="address" required></textarea>
							</div>
							<div class="pure-u-1-2">
								<label for="size">Size (square feet):</label>
								<input type="number" id="size" name="size" required>
								<label for="buildings">No. of buildings:</label>
								<input type="number" id="buildings" name="buildings" required>
								<label for="subscription">Subscription:</label>
								<select id="subscription" name="subscription">
									<option value="1">Premium PLUS: 2 weeks/300+ photos</option>
									<option value="2">Premium: 4 weeks/200 photos</option>
									<option value="3">Executive: 6 weeks/150 photos</option>
									<option value="4">Basic: 12 weeks/100 photos</option>
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