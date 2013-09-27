<nav>
				<ul>
					<li><a href="index.php">Home</a></li><? if (isset($_COOKIE['user'])){ ?>
					<li><a href="view.php">View Properties</a></li><? } ?>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
			</nav>
