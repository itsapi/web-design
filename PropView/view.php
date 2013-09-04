<?
	$msg = '';
	include 'include/functions.php';
	if (isset($_GET['pid'])){
		$queryExt = " WHERE id='{$_GET['pid']}'";
	} else {
		if (isset($_GET['uid'])){
			$currUserData = getUserData('id', $_GET['uid']);
			if (isset($userData['admin']) && $userData['admin']){
				$queryExt = " WHERE uid='{$currUserData['id']}'";
			} else {
				$queryExt = " WHERE uid='{$currUserData['id']}' AND approved IS NOT NULL";
			}
		} else {
			if (isset($userData) && $userData['admin']){
				$queryExt = "";
			} else  {
				$queryExt = " WHERE approved IS NOT NULL";
			}
		}
	}
	$result = query_DB("SELECT * FROM properties{$queryExt}");
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<script src="js/view.js"></script>
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
<?
	if (isset($_GET['pid'])) {
		$row = mysqli_fetch_assoc($result);
		$data = json_encode($row);
?>
				<script>var propData = <?=$data ?></script>
				<div id="results">
					<h3><?=$row['name']?></h3>
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
					<?= (!$row['approved'] && $userData['admin']) ? "<form class=\"pure-form pure-form-stacked approveProp\">
						<fieldset>
							<button type=\"submit\" class=\"pure-button\">APPROVE</button>
						</fieldset>
					</form>" : '' ?>
					<?= (isset($userData) && $userData['admin']) ? "<form class=\"pure-form pure-form-stacked deleteProp\">
						<fieldset>
							<button type=\"submit\" class=\"pure-button\">DELETE</button>
						</fieldset>
					</form>" : '' ?>
					<?= (isset($userData) && $userData['admin']) ? "<form class=\"pure-form pure-form-stacked getID\">
						<fieldset>
							<button type=\"submit\" class=\"pure-button\">GET ID</button>
						</fieldset>
					</form>" : '' ?>
					<form class="pure-form pure-form-stacked map">
						<fieldset>
							<button type="submit" class="pure-button">MAP</button>
						</fieldset>
					</form>
					<img class="fullImg" src="<??>">
					<p class="fullView">Date added <?=$row['added']?> | Last updated <?=$row['updated']?></p>
					<p class="fullView">Owner: <?
		$propUser = getUserData('id', $row['uid']);
		echo $propUser['firstname'].' '.$propUser['surname'];
					?></p>
					<h5>Details:</h5>
					<p class="fullView"><?=$row['buildings']?> Buildings | <?=$row['size']?> Sq Ft</p>
					<p class="fullView"><?=$row['address']?></p>
					<h5>Description:</h5>
				</div>
<?
	} else {
?>
				<ul id="results">
<?
		while($row = mysqli_fetch_assoc($result)){
?>
					<li>
						<a href="view.php?pid=<?=$row['id']?>">
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
						<?= (!$row['approved'] && $userData['admin']) ? '<p class="subscription"><em>PENDING</em></p>' : '' ?>
						<p class="first-line"><?=$row['buildings']?> Buildings | <?=$row['size']?> Sq Ft</p>
						<p>Date added <?=$row['added']?> | Last updated <?=$row['updated']?></p>
						<p class="forth-line">Owner: <?
			$propUser = getUserData('id', $row['uid']);
			echo $propUser['firstname'].' '.$propUser['surname'];
						?></p>
					</li>
<?
		}
?>
				</ul>
<?
	}
?>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>
