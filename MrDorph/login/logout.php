<?php
	session_start();
	if (session_destroy()) {
		header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
	}
?>