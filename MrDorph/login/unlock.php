<?php
	include('login/config.php');
	session_start();

	$notLoggedin = false;
	if (isset($_SESSION['login_user'])) {
		$user_check = $_SESSION['login_user'];

		$ses_sql = mysql_query("SELECT username FROM admin WHERE username='$user_check'");

		$row = mysql_fetch_array($ses_sql);

		$login_session = $row['username'];

		if (isset($login_session)) {
?>
Welcome <?php echo $login_session; ?> <a href="login/logout.php">Logout</a>
<?php
		} else {
			$notLoggedin = true;
		}
	} else {
		$notLoggedin = true;
	}
	if ($notLoggedin) {
?>
<a href="form.php?page=<?php echo basename($_SERVER['PHP_SELF']); ?>">Login</a>
<?php
	}
?>