<?
	$msg = '';
	include 'include/functions.php';
	if (isset($_GET['user'])){
		$currUserData = getUserData($_GET['user']);
		$result = query_DB("SELECT * FROM properties WHERE uid='{$currUserData['id']}'");
	} else {
		$result = query_DB("SELECT * FROM properties");
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<link rel="stylesheet" href="css/view.css">
	</head>
	<body>
		<div id="container">
			<? include 'include/header.html' ?>
			<section id="left">
				<figure>
					<a href="index.php"><img src="files/logo.png" id="logo" alt="PropView Logo"></a>
					<figcaption>Virtual Property Supervision</figcaption>
				</figure>
			</section>
			<section id="right">
				<ul id="results">
<?
	while($row = mysqli_fetch_assoc($result)){
?>
					<li>
						<a href="<??>">
							<img src="<??>">
							<h3><?=$row['name']?></h3>
						</a>
						<p class="subscription"><?=$row['subscription']?></p>
						<p class="first-line"><?=$row['buildings']?> Buildings | <?=$row['size']?> Sq Ft</p>
						<p class="second-line">Date added <?=$row['added']?> | Last updated <?=$row['updated']?></p>
						<p class="forth-line">Owner: <??></p>
					</li>
<?
	}
?>
				</ul>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>