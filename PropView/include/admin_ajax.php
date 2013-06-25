<?
	include 'config.php';

	switch ($_GET['func']) {
		case 'getInfo':
			$username = addslashes($_GET['user']);
			$result = query_DB("SELECT * FROM users WHERE username='{$username}'");
			echo json_encode(mysqli_fetch_assoc($result));
			break;
		case 'deleteUser':
			$username = addslashes($_GET['user']);
			$result = query_DB("DELETE FROM users WHERE username='{$username}'");
			if ($result){
				echo 'success';
			}
			break;
		case 'editUser':
			$query = "INSERT INTO users ({cols}) VALUES ({vals}) ON DUPLICATE KEY UPDATE {updateString}";
			$cols = '';
			$vals = '';
			$updateString = '';
			$formData = json_decode($_GET['formData']);
			foreach ($formData as $item){
				if ($item->name != 'passwordc' && $item->value != ''){
					$name = addslashes($item->name);
					if ($item->name == 'password'){
						$value = hash('sha512',addslashes($_GET['user']).hash('sha512',addslashes($item->value)));
					} else {
						$value = addslashes($item->value);
					}
					$cols .= "{$name},";
					$vals .= "'{$value}',";
					$updateString .= "{$name}=values({$name}),";
				}
			}
			$query = str_replace(
				['{cols}','{vals}','{updateString}'],
				[substr($cols, 0, -1),
				substr($vals, 0, -1),
				substr($updateString, 0, -1)],
				$query
			);
			$result = query_DB($query);
			if ($result){
				echo 'success';
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