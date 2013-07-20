<?
	$msg = '';
	include 'include/functions.php';
	if (isset($_GET['id'])){
		$currUserData = getUserData('id', $_GET['id']);
		if ($userData['admin']){
			$queryExt = " WHERE uid='{$currUserData['id']}'";
		} else {
			$queryExt = " WHERE uid='{$currUserData['id']}' AND approved IS NOT NULL";
		}
	} else {
		if ($userData['admin']){
			$queryExt = "";
		} else  {
			$queryExt = " WHERE approved IS NOT NULL";
		}
	}
	$result = query_DB("SELECT * FROM properties{$queryExt}");
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
						<p class="subscription"><?
							switch ($row['subscription']) {
								case 1:
									echo 'Premium PLUS';
									break;
								case 2:
									echo 'Premium';
									break;
								case 3:
									echo 'Executive';
									break;
								case 4:
									echo 'Basic';
									break;
							}
						?></p>
						<p class="first-line"><?=$row['buildings']?> Buildings | <?=$row['size']?> Sq Ft</p>
						<p class="second-line">Date added <?=$row['added']?> | Last updated <?=$row['updated']?></p>
						<p class="forth-line">Owner: <?
							$propUser = getUserData('id', $row['uid']);
							echo $propUser['firstname'].' '.$propUser['surname'];
						?></p>
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
