<?
	$msg = '';
	include 'include/config.php';
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
					<li>
						<a href="#">
							<img src="http://p.rdcpix.com/v01/l1aa82244-m0s.jpg" alt="House">
							<h3>485 S Sunset Dr</h3>
						</a>
						<p class="subscription">Gold</p>
						<p class="first-line">2 Buildings | 3,100 Sq Ft</p>
						<p class="second-line">Last updated 11/05/13</p>
						<p class="forth-line">Brokered by: FIRST PREMIER REALTY, LLC</p>
					</li>
					<li>
						<a href="#">
							<img src="http://p.rdcpix.com/v01/la9121a44-m0s.jpg" alt="House">
							<h3>102A Nesbitt Dr</h3>
						</a>
						<p class="subscription">Executive +</p>
						<p class="first-line">4 Buildings | 5,304 Sq Ft</p>
						<p class="second-line">Last updated 20/05/13</p>
						<p class="forth-line">Brokered by: CENDAK REALTY, INC.</p>
					</li>
					<li>
						<a href="#">
							<img src="http://p.rdcpix.com/v02/le5462544-m0s.jpg" alt="House">
							<h3>391 S Sunset Dr</h3>
						</a>
						<p class="subscription">Platinum</p>
						<p class="first-line">1 Building | 1,960 Sq Ft</p>
						<p class="second-line">Last updated 15/06/13</p>
						<p class="forth-line">Brokered by: FIRST PREMIER REALTY, LLC</p>
					</li>
					<li>
						<a href="#">
							<img src="http://p.rdcpix.com/v01/l4a492044-m0s.jpg" alt="House">
							<h3>284 S Sunset Dr</h3>
						</a>
						<p class="subscription">Silver</p>
						<p class="first-line">2 Buildings | 1,960 Sq Ft</p>
						<p class="second-line">Last updated 05/06/13</p>
						<p class="forth-line">Brokered by: FIRST PREMIER REALTY, LLC</p>
					</li>
					<li>
						<a href="#">
							<img src="http://p.rdcpix.com/v01/l670b2f44-m0s.jpg" alt="House">
							<h3>458 N Sunset Dr</h3>
						</a>
						<p class="subscription">Gold</p>
						<p class="first-line">3 Buildings | 3,138 Sq Ft</p>
						<p class="second-line">Last updated 11/06/13</p>
						<p class="forth-line">Brokered by: COLDWELL BANKER MEHLHOFF ASSOCIATES</p>
					</li>
				</ul>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>