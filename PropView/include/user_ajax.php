<?
	include 'config.php';

	switch ($_GET['func']) {
		case 'getInfo':
			$id = addslashes($_GET['id']);
			$result = query_DB("SELECT * FROM properties WHERE id='{$id}'");
			echo json_encode(mysqli_fetch_assoc($result));
			break;
		case 'getAccount':
			$uid = addslashes($_GET['user']);
			$result = query_DB("SELECT * FROM users WHERE id='{$uid}'");
			echo json_encode(mysqli_fetch_assoc($result));
			break;
		case 'deleteProperty':
			$username = addslashes($_GET['user']);
			$result = query_DB("DELETE FROM users WHERE username='{$username}'");
			if ($result){
				echo 'success';
			}
			break;
		case 'editProperty':
			$id = $_GET['id'];
			$result = query_DB("SELECT id, approved FROM properties WHERE id='{$id}'");
			$userData = mysqli_fetch_assoc(query_DB("SELECT * FROM users WHERE username='{$_COOKIE['user']}'"));
			$formData = json_decode($_GET['formData']);
			$data = [];
			foreach ($formData as $item){
				if ($item->value != ''){
					$name = addslashes($item->name);
					$value = addslashes($item->value);
					$data[$name] = $value;
				}
			}
			if (mysqli_num_rows($result) > 0){
				$query = "UPDATE properties SET {updateString} WHERE id='{$id}'";
				$updateString = '';
				foreach ($data as $name => $value){
					$updateString .= "{$name} = '{$value}', ";
				}
				$query = str_replace('{updateString}',substr($updateString, 0, -2),$query);
				if (mysqli_fetch_assoc($result)['approved']){
					echo $data['name'].':approved:';
				} else {
					echo $data['name'].':pending:';
				}
			} else {
				$query = "INSERT INTO properties ({cols}) VALUES ({vals})";
				$cols = '';
				$vals = '';
				foreach ($data as $name => $value){
					$cols .= "{$name}, ";
					$vals .= "'{$value}', ";
				}
				$cols .= 'uid';
				$vals .= $userData['id'];
				$query = str_replace(['{cols}','{vals}'],[$cols,$vals],$query);
				$to = [
					'email' => $userData['email'],
					'name' => ($userData['firstname'].' '.$userData['surname'])
				];
				$from = $mailUser;
				$subject = 'You have created a property called '.$data['name'];
				$message = <<<END
Hello {$to['name']},

You have successfully created a property called {$data['name']} on PropView.
It will soon be approved by the admin and will be visible to the public. You will be notified when it is approved.

Regards,
The PropView Team.
END;
				email($to, $from, $subject, $message);
				echo $data['name'].':new:';
			}
			$result = query_DB($query);
			if ($result){
				echo 'success';
			}
			break;
		case 'editAccount':
			$uid = addslashes($_GET['user']);
			$query = "UPDATE users SET {updateString} WHERE id='{$uid}'";
			$updateString = '';
			$formData = json_decode($_GET['formData']);
			foreach ($formData as $item){
				if ($item->value != ''){
					if ($item->name == 'password'){
						$value = hash('sha512',addslashes($_GET['user']).hash('sha512',addslashes($item->value)));
					} else {
						$value = addslashes($item->value);
					}
					$name = addslashes($item->name);
					$updateString .= "{$name}='{$value}',";
				}
			}
			$query = str_replace('{updateString}',substr($updateString, 0, -1),$query);
			$result = query_DB($query);
			if ($result){
				echo 'success';
			}
			break;
		case 'getProperties':
			$uid = addslashes($_GET['user']);
			$result = query_DB("SELECT * FROM properties WHERE uid='{$uid}'");
			while($row = mysqli_fetch_assoc($result)){
				 $json[] = $row;
			}
			echo json_encode($json);
			break;
	}