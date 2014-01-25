<?php
	$mysql_hostname = "localhost";
	$mysql_user = "{webDesign_MrDorphMysqlUser}";
	$mysql_password = "{webDesign_MrDorphMysqlPassword}";
	$mysql_database = "{webDesign_MrDorphDb}";
	$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
	or die("Opps some thing went wrong");
	mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
?>
