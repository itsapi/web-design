<?
	include 'config.php';

	switch ($_GET['func']) {
		case 'getInfo':
			$result = query_DB("SELECT * FROM users WHERE username='{$_GET['user']}'");
			echo json_encode(mysqli_fetch_assoc($result));
			break;
		case 'editUser':
			$query = "SELECT * FROM users WHERE username='{$_GET['user']}'"
			foreach ($_GET['formData'] as $key => $value) {
				if $
			}
			break;
		case 'getUsers':
			$result = query_DB("SELECT username FROM users WHERE subscription!='0'");
			while($row = mysqli_fetch_assoc($result)){
			     $json[] = $row;
			}
			echo json_encode($json);
			break;
	}