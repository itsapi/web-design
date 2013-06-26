<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Gallery</title>

		<link rel="stylesheet" href="css/anythingslider.css">
		<link rel="stylesheet" href="css/typeplate-unminified.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="js/jquery.anythingslider.js"></script>
		<script>
			function resizeSlider() {
				$('#slider-holder').css('height', ($('#slider-holder').width()*0.365)+'px')
			}
			$(document).ready(function() {
				$(window).resize(resizeSlider);
				resizeSlider();
				$(function() {
					$('#slider').anythingSlider({
						expand: true,
						hashTags: false,

						autoPlay: true,
						delay: 5000
					});
				});
			});
		</script>

	</head>
	<body>
		<?php include('site_parts/header.php'); ?>
		<div id="content">
<!--login--><?php include('login/unlock.php'); ?><!--login--><section><h2>Gallery</h2></section><!--content-->
<section id="slider-holder">
	<ul id="slider">
		<li><img src="http://placehold.it/960x350" alt="" /></li><!-- Change each of these links to the images you want in the slide show. -->
		<li><img src="http://placebear.com/960/350" alt="" /></li><!-- Copy these lines for all the images / videos you want -->
		<li><img src="http://lorempixel.com/960/350" alt="" /></li>
		<li><iframe src="http://www.youtube.com/embed/WATCHCODE" frameborder="0" allowfullscreen></iframe></li><!-- This is a video, replace the 'WATCHCODE' to the watch code of the video. -->
	</ul>
</section>
<!--content-->
		</div>
		<?php include('site_parts/footer.php'); ?>
	</body>
</html>