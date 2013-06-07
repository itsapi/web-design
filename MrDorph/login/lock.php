<?php
	include('login/config.php');
	session_start();
	$user_check = $_SESSION['login_user'];

	$ses_sql = mysql_query("SELECT username FROM admin WHERE username='$user_check'");

	$row = mysql_fetch_array($ses_sql);

	$login_session = $row['username'];

	if (isset($login_session)) {
?>
Welcome <?php echo $login_session; ?> <a href="login/logout.php">Logout</a>
<?php
	} else {
		header('Location: form.php?page=' . basename($_SERVER['PHP_SELF']));
	}
?>